<?php

namespace App\Utils;

use App\Utils\MessageError;

class ValidarInformacion
{

    public static function validarInformacionProducto($data)
    {
        if (!isset($data['idCategoria'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'La categoria es obligatoria'
            );
        }
        if (!isset($data['nombre_prod'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El nombre es obligatorio'
            );
        }
        if (!isset($data['codigo_prod'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El codigo es obligatorio'
            );
        }
        if (!isset($data['descripcion_prod'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'La descripcion es obligatorio'
            );
        }
        if (!isset($data['precio'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El precio es obligatorio'
            );
        }
        if (!isset($data['stock'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El stock es obligatorio'
            );
        }
        return [];
    }

    public static function validarInformacionProductoUp($data)
    {
        if (!isset($data['idCategoria'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'La categoria es obligatoria'
            );
        }
        if (!isset($data['nombre_prod'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El nombre es obligatorio'
            );
        }
        if (!isset($data['descripcion_prod'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'La descripcion es obligatorio'
            );
        }
        if (!isset($data['precio'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El precio es obligatorio'
            );
        }
        if (!isset($data['stock'])) {
            return MessageError::messageDescriptionError(
                'Error',
                'El stock es obligatorio'
            );
        }
        return [];
    }
}
