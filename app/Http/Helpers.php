<?php


/**
 * return Errors Messages
 * 
 * @return \Illuminate\Http\Response
 */
function getErrorsMessages($validation)
{
    $messages = array();
    foreach (json_decode($validation->messages()) as $msg) {
        array_push($messages, $msg[0]);
    }
    return $messages;
}