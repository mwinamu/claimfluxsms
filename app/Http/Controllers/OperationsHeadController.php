<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Sms_names;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Sms_Templates;
use App\Sms_Messages;
use App\Classes\AfricasTalkingGateway;

class OperationsHeadController extends Controller
{
    //api variables
    // for africa's talking
    private $username = "quest_hlds";
    private $apikey = "afe72a819654809461ab9734cf75c827dc33924364966339a415fec17be6106a";
    private $SMS_from = "QUEST_HLDS"; // sms originator
    //infobip
    private $infobipUsername = "QUESTLTD";
    private $infobipAuthKey = "e60e178167fb080e142532c32c13e83f-80685be3-e456-49f2-8b61-f7bb0cab57c9";


    public function awaitingDispatch(){
        return view('operationsHead.awaitingDispatch');
    }
    public function rejected(){
        return view('operationsHead.rejected');
    }
    public function dispatched(){
        return view('operationsHead.dispatched');
    }
    public function dashboard(){

        return view( 'operationsHead.dashboard' );
    }
    public function postDispatchedSMS( Request $request){
        /* get sms names date and user dispatching*/
        $id = $request->sms_names_id;
        $date = date('Y_m_d-H-i-s');
        $user = Auth::user()->id;
        /* find the row and update entries*/
        $sms_names = Sms_names::find($id);
        $sms_names ->dispatched = 1;
        $sms_names ->dispatch_time = $date;
        $sms_names ->user_dispatching = $user;
        $sms_names->save();

        /* get the sms templates for sending*/
        $sms_names_id = $sms_names->id;
        $sms_messages  = SMS_Messages::where('sms_names_id',$sms_names_id)->get()->all();
        /* send sms-templates to api and update db with sent on unsent*/
        $sendRes = $this->sendSMS($sms_messages);
        return redirect()->back()->with('res', "Dispatched succesfully")->with('sendRes',"$sendRes");


    }
    //function to get dispatched smsnames
    public function getDispatched(){
        $sms_names = Sms_Names::where([['dispatched',1],['rejected',0]])->get()->all();
        $sms_name = app('App\Http\Controllers\TeamLeaderController')->rejectDispatchConvert($sms_names);
        $smsName = $this->userConvert($sms_name);
        return $smsName;
    }
    //function to get rejected sms names
    public function getRejected(){
        $sms_names = Sms_Names::where([['rejected',1],['dispatched',0]])->get()->all();
        $sms_name = app('App\Http\Controllers\TeamLeaderController')->rejectDispatchConvert($sms_names);
        $smsName = $this->userConvert($sms_name);
        return $smsName;
    }
    //fucntion to get sms names that are not dispatched
    public function awaiting(){
        $sms_names = Sms_Names::where([['dispatched',0],['rejected',0]])->get()->all();
        $sms_name = app('App\Http\Controllers\TeamLeaderController')->rejectDispatchConvert($sms_names);
        $smsName = $this->userConvert($sms_name);
        return $smsName;
    }
    //use for other uses e.g for supervisor
    public function smsNames(){
        //$user = Auth::user()->id;
        $sms_names = Sms_Names::get()->all();
        $sms_name = app('App\Http\Controllers\TeamLeaderController')->rejectDispatchConvert($sms_names);
        $smsName = $this->userConvert($sms_name);
        return $smsName;

    }
    //convert rejected and dispatched from 0 and 1 to yes and no
    public function userConvert($sms_names){
        $sms_names = json_decode($sms_names);
        //return $sms_names;
        $smsName = new Collection();
        foreach ( $sms_names as $sms_names){
            $user_id = $sms_names->user_id;
            $user = User::where('id',$user_id)->first();
            $user_name = $user->name;
            $smsName->push([
                    "id" => $sms_names->id,
                    "name" => $sms_names->name,
                    "user_id" =>$sms_names->user_id,
                    "created_at" =>$sms_names->created_at,
                    "updated_at" =>$sms_names->updated_at,
                    "dispatched" =>$sms_names->dispatched,
                    "rejected" =>$sms_names->rejected,
                    "dispatch_time" =>$sms_names->dispatch_time,
                    "network" =>$sms_names->network,
                    "user" => $user_name

                ]);

        }
        return json_encode($smsName);
    }
    //africa s talking
    public function sendSMS($sms_messages){
        $rs = "";
        $saved = "";
        $res = new Collection();
        $gateway = new AfricasTalkingGateway($this->username, $this->apikey);
        foreach ( $sms_messages as $sms_message){
            $recipient = $sms_message->debtor_number;
            $message = $sms_message->message_string;
            $id = $sms_message->id;
            try {
                $results = $gateway->sendMessage($recipient, $message, $this->SMS_from);
                //return $results;

                foreach ($results as $result) {
                    if ($result->status == "Success") {
                        $r_s = $result->cost;
                        //update
                        $rs = Sms_Messages::find($id);
                        $rs ->error_message =  "";
                        $rs ->external_id =  $result->messageId;
                        $rs ->sent = 1;
                        $rs ->cost = $r_s;
                        $saved = $rs->save();
                        if ( $saved ) {
                            $res->push([
                                'message' => 'Dispatched and saved succesfully',
                                'status' => 'succesful'
                            ]);
                        }

                    } else {
                        //update
                        $rs = Sms_Messages::find($id);

                        $rs ->error_message =  $result->status;
                        $rs ->sent = 0;
                        $rs ->cost = "";
                        $rs->save();
                        $res->push([
                            'message' => $result->status,
                            'status' => "failed",
                        ]);
                    }
                }
            } catch (AfricasTalkingGatewayException $e) {
               // echo "Encountered an error while sending: " . $e->getMessage();
                $rs = Sms_Messages::find($id);
                $rs ->sent = 0;
                $rs ->error_message = "Encountered an error while sending: " . $e->getMessage();
                $saved = $rs ->save();
                $error_message = "Encountered an error while sending: " . $e->getMessage();
                if( $saved ){
                    $res->push([
                        'message' => $error_message,
                        'status' => 'failed'
                    ]);
                }

            }


        }
        return $res;
    }
    public function sendEquitelSMS(){

    }
}
