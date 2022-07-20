<?php

namespace App\Utils;
use Carbon\Carbon;

class MessageError {

    public static function messageDescriptionError($typeMessage, $descriptionMessage) {
        return  [
            "message" => $typeMessage,
            "descriptionMessage" => $descriptionMessage,
            "dateMessage" => Carbon::now()
        ];
    }


    public static function returnResponse($responseBool) {
        if($responseBool) {
            return MessageError::messageDescriptionError("Ok", "Guardado correctamente");
        } else {
            return MessageError::messageDescriptionError("Error", "El guardado falló");
        }
    }
}