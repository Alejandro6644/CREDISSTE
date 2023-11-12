<?php
use Illuminate\Support\Facades\Validator;
function responseGeneral($success,$message,$code, $data) {
    return response([
        "success" => $success,
        "message"=> $message,
        "data" => $data
    ],$code);
}
