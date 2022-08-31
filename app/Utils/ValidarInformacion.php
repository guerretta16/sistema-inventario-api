<?php

namespace App\Utils;

use App\Utils\MessageError;

class ValidarInformacion
{

    public static function validarInformacionProducto($data)
    {   
        if (is_null($data->input('idCategoria')) || $data->input('idCategoria') === "") {
            return MessageError::messageDescriptionError(
                'Error',
                'La categoria es obligatoria'
            );
        }
        if (is_null($data->input('nombre_prod'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El nombre es obligatorio'
            );
        }
        if (is_null($data->input('codigo_prod'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El codigo es obligatorio'
            );
        }
        if (is_null($data->input('descripcion_prod'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'La descripcion es obligatorio'
            );
        }
        if (is_null($data->input('precio'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El precio es obligatorio'
            );
        }
        if (is_null($data->input('stock'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El stock es obligatorio'
            );
        }
        return [];
    }

    public static function validarInformacionProductoUp($data)
    {
        if (is_null($data->input('idCategoria')) || $data->input('idCategoria') === "") {
            return MessageError::messageDescriptionError(
                'Error',
                'La categoria es obligatoria'
            );
        }
        if (is_null($data->input('nombre_prod'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El nombre es obligatorio'
            );
        }
        if (is_null($data->input('descripcion_prod'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'La descripcion es obligatorio'
            );
        }
        if (is_null($data->input('precio'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El precio es obligatorio'
            );
        }
        if (is_null($data->input('stock'))) {
            return MessageError::messageDescriptionError(
                'Error',
                'El stock es obligatorio'
            );
        }
        return [];
    }
}
