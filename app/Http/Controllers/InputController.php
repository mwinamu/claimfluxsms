<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Option;
use Auth;
use App\Answer;
use App\Question;

class InputController extends Controller
{
    //

    public function index( $input_type  , $question_id  ){


        if( $input_type == "option" ){
            $type = "radio";
            $checked = "";
            $options = Option::where('question_id', $question_id)->get()->all();
            $user_id = Auth::user()->id;
            $answer = Answer::where([['user_id','=',$user_id],['question_id','=',$question_id]])->get()->all();

            /* use answer to pre check values*/
            if($answer == []){
                $checked = "";
                return $this->option($type,$options,$checked);
            }else{
                foreach ( $answer as $answer1 ){
                    $checked = $answer1->string;
                    return $this->option($type,$options,$checked);

                }
            }

        }else if( $input_type == "multiple" ){

            return $this->checkBox($question_id);

        }else if( $input_type == "text" ){
            $type = "text";
            $value = "";
            $user_id = Auth::user()->id;
            $answer = Answer::where([['user_id','=',$user_id],['question_id','=',$question_id]])->get()->all();
            if($answer == []){
                $value = '';
               return $this->text($type,$value);
            }else{
                foreach ( $answer as $answer1 ){
                    $value = $answer1->string;
                   return $this->text($type,$value);
                }
            }
        }
        else{
            $error = "error";
            return $error;
        }
    }
    public function option($type,$options,$checked){
        $html = "";
        foreach( $options as $option){
            $html .= '<div class = "container">
                     <input type="'.$type.'"  name="option" id="option" value="'.$option->options_string.'" '.($option->pre_checked == 1? "checked": $option->options_string == $checked? "checked":"" ).'>'.$option->options_string.'<br>
                     </div>';
        }
        return $html;
    }
    public function checkBox($question_id){
        $checkBoxValue = '<div class="container"></div><input type="checkbox" name="vehicle" value="Bike"> I have a bike<br>
                          <input type="checkbox" name="vehicle" value="Car" checked> I have a car<br>
                          <input type="checkbox" name="vehicle" value="Truck" checked> I have a truck<br></div>';
        return $checkBoxValue;
    }
    public function text($type,$value){
        $html = "";
        $html .= '<div class = "container">
                  <input type="'.$type.'" name="text" value="'.$value.'" id="textVal" >
                  <div>';
        return $html;
    }public function text1($type,$value){
        $html = "";
        $html .= '<div class = "container">
                  <input type="'.$type.'" name="text" value="'.$value.'" >
                  <div>';
        return $html;
    }
    public function textArea(){
        $textAreaValue = "get text area value";
        return $textAreaValue;
    }
}
