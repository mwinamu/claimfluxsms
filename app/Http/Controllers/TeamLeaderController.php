<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Schema;
use Illuminate\Support\Facades\Auth;
use App\Sms_Templates;
use App\Sms_Names;
use App\Sms_Messages;
use Symfony\Component\HttpFoundation\Session\Session;

class TeamLeaderController extends Controller
{
    //
    public $smsTemplateValue;
    public $cfid ;
    public $debtor_name ;
    public $debtor_number;
    public $ptp_amount;
    public $ptp_date;
    public $client;
    public $account_number;
    public $paybill_number;
    public $acm_name;
    public $acm_number;
    public $acm_email;
    public $balance;
    public $waiver_amount;
    public $waived_amount;

    public function parameterValues(){
        return [
            '$cfid',
            '$debtor_name',
            '$debtor_number',
            '$ptp_amount',
            '$ptp_date',
            '$client',
            '$account_number',
            '$paybill_number',
            '$acm_name',
            '$acm_number',
            '$acm_email',
            '$balance',
            '$waiver_amount',
            '$waived_amount',];
    }

    public function sms_templates_values(){
        return [
            'cfid',
            'debtor_name',
            'debtor_number',
            'ptp_amount',
            'ptp_date',
            'client',
            'account_number',
            'paybill_number',
            'acm_name',
            'acm_number',
            'acm_email',
            'balance',
            'waiver_amount',
            'waived_amount',];
    }
    public function dashboard(){

        return view( 'teamLeader.dashboard' );
    }
    public function upload(){

        return view('teamLeader.upload');
    }
    public function excel(){
        //The name of the CSV file that will be downloaded by the user.
        $fileName = 'sms.csv';

        //Set the Content-Type and Content-Disposition headers.
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        //A multi-dimensional array containing our CSV data.
        $data = array($this->sms_templates_values());

        //Open up a PHP output stream using the function fopen.
        $fp = fopen('php://output', 'w');

        //Loop through the array containing our CSV data.
        foreach ($data as $row) {
            //fputcsv formats the array into a CSV format.
            //It then writes the result to our output stream.
            fputcsv($fp, $row);
        }

        //Close the file handle.
        fclose($fp);

    }
    public function postUpload( Request $request)
    {
        //get current user id
        $sms_name_id = "";
        $debtor_number = "";
        $user_id = Auth::user()->id;

        $validate = $this->validate($request, [
            'name' => 'required|unique:sms_names',
            'network' =>'required'
        ]);
        //timestamp
        $date = date('Y_m_d-H-i-s');
        $sms_name = $request->name."$date";
        $network = $request->network;
        //insert to sms names  .
        try{
            $sms_names = Sms_Names::create([
                //insert user entries
                'name' => $sms_name,
                'user_id' => $user_id,
                'dispatched' => 0,
                'rejected' => 0,
                'network' => $network,
            ]);
            //return $sms_names;
            $sms_names_id = $sms_names->id;
        }
        catch (QueryException $ex){
            echo($ex->getMessage());
        }
        $sms_template = $request->file('sms_template');
        $path = $request->file('sms_template')->getRealPath();
        $sms_template_value = new Collection();
        if($request->hasFile('sms_template')) {
            if ($request->file('sms_template')->isValid()) {
                //
                //Open our CSV file using the fopen function.
                $fh = fopen($sms_template, "r");

                //Setup a PHP array to hold our CSV rows.
                $csvData = array();

                //Loop through the rows in our CSV file and add them to
                //the PHP array that we created above.
                while (($row = fgetcsv($fh, 0, ",")) !== FALSE) {
                    $csvData[] = $row;
                }

                //Finally, encode our array into a JSON string format so that we can print it out.

                foreach ( $csvData as $value){
                    $sms_template_value->push([
                        'cfid' => $value[0],
                        'debtor_name' => $value[1],
                        'debtor_number' => $value[2],
                        'ptp_amount' => $value[3],
                        'ptp_date' => $value[4],
                        'client' => $value[5],
                        'account_number' => $value[6],
                        'paybill_number' => $value[7],
                        'acm_name' => $value[8],
                        'acm_number' => $value[9],
                        'acm_email' => $value[10],
                        'balance' => $value[11],
                        'waiver_amount' => $value[12],
                        'waived_amount' => $value[13],
                        'user_id' => $user_id,//session user id
                        'sms_names_id' => $sms_names_id,//get value of this after submiting sms name to db
                    ]);
                }
                $sms_template_value->shift($sms_template_value[1]);
                $sms_template_value = json_decode($sms_template_value);
                sizeof($sms_template_value);
                //insert sms templates value to db
                $sms_values = "";
                for( $i=0; $i<sizeof($sms_template_value); $i++ ){

                    if( strlen($sms_template_value[$i]->debtor_number) == 9 ){
                        $zero = 0;
                        $number = $sms_template_value[$i]->debtor_number;
                        $debtor_number = $zero.$number;
                    }else {
                        $debtor_number = $sms_template_value[$i]->debtor_number;
                    }
                    //return $debtor_number;
                    try{
                        $sms_values  = Sms_Templates::create([
                            'cfid' => $sms_template_value[$i]->cfid,
                            'debtor_name' => $sms_template_value[$i]->debtor_name,
                            'debtor_number' => $debtor_number,
                            'ptp_amount' => $sms_template_value[$i]->ptp_amount,
                            'ptp_date' => $sms_template_value[$i]->ptp_date,
                            'client' => $sms_template_value[$i]->client,
                            'account_number' => $sms_template_value[$i]->account_number,
                            'paybill_number' => $sms_template_value[$i]->paybill_number,
                            'acm_name' => $sms_template_value[$i]->acm_name,
                            'acm_number' => $sms_template_value[$i]->acm_number,
                            'acm_email' => $sms_template_value[$i]->acm_email,
                            'balance' => $sms_template_value[$i]->balance,
                            'waiver_amount' => $sms_template_value[$i]->waiver_amount,
                            'waived_amount' => $sms_template_value[$i]->waived_amount,
                            'user_id' => $sms_template_value[$i]->user_id,
                            'sms_names_id' => $sms_template_value[$i]->sms_names_id,
                        ]);

                    }catch (QueryException $ex){
                        return $ex->getMessage();
                    }
                }
                $smsTemplate = Sms_Templates::where('sms_names_id','=',$sms_names_id)->get()->all();
                $smsTemplate = json_encode($smsTemplate);
                $tabListener = "handle";
                $tabListener = json_encode($tabListener);
                return redirect()->back()->with('uploaded', "$smsTemplate")->with('names',"$sms_names")
                    ->with('tablistener',"$tabListener")
                    ->with('msg',"Click uploaded template to confirm the just uploaded value ")
                    ->with('status', "Click  Uploaded Templates to continue with upload ");
                //TODO:return datatables view of the uploaded sms tempates
                //with sms name as the header and some option params used for sms message text area
                //use $sms_name_id to fetch the data
            }else{
                return Redirect::back()->with('status', "provide a csv format file");
            }


        }else{
            return Redirect::back()->with('status', "No file");
        }
    }
    public function postMessages(Request $request){
        $this->validate($request,[
            'sms_names_id' => 'required',
        ]);
        $place_holders = array(
            '{$cfid}',
            '{$debtor_name}',
            '{$ptp_amount}',
            '{$ptp_date}',
            '{$client}',
            '{$account_number}',
            '{$paybill_number}',
            '{$acm_name}',
            '{$acm_number}',
            '{$acm_email}',
            '{$balance}',
            '{$waiver_amount}',
            '{$waived_amount}'
        );
        $user_id = Auth::user()->id;
        //validation goes here
        $sms_names_id = $request->sms_names_id;
        $sms_templates_val = Sms_Templates::where('sms_names_id', $sms_names_id )->get()->all();
        $messageTemplate = new Collection;
        foreach ( $sms_templates_val as $sms_templates_val ){
            $param_arr = array(
                $sms_templates_val->cfid,
                $sms_templates_val->debtor_name,
                $sms_templates_val->ptp_amount,
                $sms_templates_val->ptp_date,
                $sms_templates_val->client,
                $sms_templates_val->account_number,
                $sms_templates_val->paybill_number,
                $sms_templates_val->acm_name,
                $sms_templates_val->acm_number,
                $sms_templates_val->acm_email,
                $sms_templates_val->balance,
                $sms_templates_val->waiver_amount,
                $sms_templates_val->waived_amount,
            );
            //replace placeholders
            $message = str_replace($place_holders, $param_arr, $request->sms_message);
            $sms_messages = Sms_Messages::create([
                'cfid' => $sms_templates_val->cfid,
                'message_string' => $message,
                'user_id' => $user_id,
                'sms_names_id' => $sms_names_id,
                'debtor_number' => $sms_templates_val->debtor_number,
            ]);
            $messageTemplate -> push(
                $sms_messages
            );
            //redirect back with message
            //

        }


        return Redirect::back()->with('status', "Uploaded succesfully");
    }
    public function awaitingDispatch(){
        return view('teamLeader.awaitingDispatch');
    }
    public function rejected(){
        return view('teamLeader.rejected');
    }
    public function dispatched(){
        return view('teamLeader.dispatched');
    }
    //convert rejected and dispatched from 0 and 1 to yes and no
    public function rejectDispatchConvert($sms_names){
        $sms_name = new Collection();
        foreach ( $sms_names as $sms_names){
            if( $sms_names->dispatched == 0 && $sms_names->rejected == 0 ){

                $sms_name->push([
                    "id" => $sms_names->id,
                    "name" => $sms_names->name,
                    "user_id" =>$sms_names->user_id,
                    "created_at" =>$sms_names->created_at,
                    "updated_at" =>$sms_names->updated_at,
                    "dispatched" =>"No",
                    "rejected" =>"No",
                    "dispatch_time" =>$sms_names->dispatch_time,
                    "network" =>$sms_names->network,

                ]);
            }else if( $sms_names->dispatched == 1 && $sms_names->rejected == 1 ){
                $sms_name->push([
                    "id" => $sms_names->id,
                    "name" => $sms_names->name,
                    "user_id" =>$sms_names->user_id,
                    "created_at" =>$sms_names->created_at,
                    "updated_at" =>$sms_names->updated_at,
                    "dispatched" =>"Yes",
                    "rejected" =>"Yes",
                    "dispatch_time" =>$sms_names->dispatch_time,
                    "network" =>$sms_names->network,

                ]);
            }
            else if( $sms_names->dispatched == 0 && $sms_names->rejected == 1 ){
                $sms_name->push([
                    "id" => $sms_names->id,
                    "name" => $sms_names->name,
                    "user_id" =>$sms_names->user_id,
                    "created_at" =>$sms_names->created_at,
                    "updated_at" =>$sms_names->updated_at,
                    "dispatched" =>"No",
                    "rejected" =>"Yes",
                    "dispatch_time" =>$sms_names->dispatch_time,
                    "network" =>$sms_names->network,

                ]);
            }
            else if( $sms_names->dispatched == 1 && $sms_names->rejected == 0 ){
                $sms_name->push([
                    "id" => $sms_names->id,
                    "name" => $sms_names->name,
                    "user_id" =>$sms_names->user_id,
                    "created_at" =>$sms_names->created_at,
                    "updated_at" =>$sms_names->updated_at,
                    "dispatched" =>"Yes",
                    "rejected" =>"No",
                    "dispatch_time" =>$sms_names->dispatch_time,
                    "network" =>$sms_names->network,

                ]);
            }
            else {
                $sms_name->push([
                    "id" => $sms_names->id,
                    "name" => $sms_names->name,
                    "user_id" =>$sms_names->user_id,
                    "created_at" =>$sms_names->created_at,
                    "updated_at" =>$sms_names->updated_at,
                    "dispatched" =>$sms_names->dispatched,
                    "rejected" =>$sms_names->rejected,
                    "dispatch_time" =>$sms_names->dispatch_time,
                    "network" =>$sms_names->network,

                ]);
            }
        }
        return json_encode($sms_name);
    }
    //function to get dispatched smsnames
    public function getDispatched(){
        $user = Auth::user()->id;
        $sms_names = Sms_Names::where([['user_id',$user],['dispatched',1],['rejected',0]])->get()->all();
        $sms_name = $this->rejectDispatchConvert($sms_names);
        return $sms_name;
    }
    //function to get rejected sms names
    public function getRejected(){
        $user = Auth::user()->id;
        $sms_names = Sms_Names::where([['user_id',$user],['rejected',1],['dispatched',0]])->get()->all();
        $sms_name = $this->rejectDispatchConvert($sms_names);
        return $sms_name;
    }
    //fucntion to get sms names that are not dispatched
    public function awaiting(){
        $user = Auth::user()->id;
        $sms_names = Sms_Names::where([['user_id',$user],['dispatched',0],['rejected',0]])->get()->all();
        $sms_name = $this->rejectDispatchConvert($sms_names);
        return $sms_name;
    }
    //function to get sms names per user use on dashboard
    public function userSmsNames(){
        $user = Auth::user()->id;
        $sms_names = Sms_Names::where('user_id',$user)->get()->all();
        $sms_name = $this->rejectDispatchConvert($sms_names);
        return $sms_name;
    }
    //use for other uses e.g for supervisor
    public function smsNames(){
        //$user = Auth::user()->id;
        $sms_names = Sms_Names::get()->all();
        $sms_name = $this->rejectDispatchConvert($sms_names);
        return $sms_name;

    }
    public function GetSmsTemplate( Request $request){
        $data = ( json_decode( $request->getContent(), true ) );
        $keys = array_keys( $data );
        $sms_names_id = $data[$keys[0]];
        $user_id = $data[$keys[2]];

        $sms_messages = Sms_Messages::where([['sms_names_id',$sms_names_id],['user_id',$user_id]])->get()->all();
        $smsMessages = $this->sentGetSmsTemplateConvert($sms_messages);
        return $smsMessages;

    }
    public function sentGetSmsTemplateConvert($sms_messages){
        $smsMessages = new Collection();
        foreach ( $sms_messages as $sms_message ){
            if( $sms_message->sent == 1 ){
                $smsMessages->push([
                    'id' => $sms_message->id ,
                    'cfid'=> $sms_message->cfid,
                    'message_string'=> $sms_message->message_string,
                    'user_id'=> $sms_message->user_id,
                    'sms_names_id'=> $sms_message->sms_names_id,
                    'dispatched'=> $sms_message->dispatched,
                    'dispatch_time'=> $sms_message->dispatch_time,
                    'created_at'=> $sms_message->created_at,
                    'updated_at'=> $sms_message->updated_at,
                    'debtor_number'=> $sms_message->debtor_number,
                    'external_id'=> $sms_message->external_id,
                    'cost'=> $sms_message->cost,
                    'sent'=> "SENT",
                    'error_message'=> $sms_message->error_message

                ]);

            }else if( $sms_message->sent == 0 ){
                $smsMessages->push([
                    'id' => $sms_message->id ,
                    'cfid'=> $sms_message->cfid,
                    'message_string'=> $sms_message->message_string,
                    'user_id'=> $sms_message->user_id,
                    'sms_names_id'=> $sms_message->sms_names_id,
                    'dispatched'=> $sms_message->dispatched,
                    'dispatch_time'=> $sms_message->dispatch_time,
                    'created_at'=> $sms_message->created_at,
                    'updated_at'=> $sms_message->updated_at,
                    'debtor_number'=> $sms_message->debtor_number,
                    'external_id'=> $sms_message->external_id,
                    'cost'=> $sms_message->cost,
                    'sent'=> "UNSENT",
                    'error_message'=> $sms_message->error_message

                ]);

            }


        }
        return json_encode($smsMessages);

    }
}
