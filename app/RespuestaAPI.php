<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaAPI
{
    //
    /* Todos los metodos retornan un JSON de formato
    [
        'ok' => '1', //o 0 si falló
        'body' => 'Se ha creado el objetivo exitosamente', //cuerpo de la respuesta, aqui entraría el mensaje retornado
        'httpCode' => '200' // o 500 en caso de falla
    ]


    CÓDIGOS HTTP
        Respuestas informativas (100–199),
        Respuestas satisfactorias (200–299),
        Redirecciones (300–399),
        Errores de los clientes (400–499),
        y errores de los servidores (500–599).

    */
    //CUERPO debe ser un STRING
    public static function respuestaOk($mensaje){
        return ([
            'ok'=>'1',
            'mensaje'=> $mensaje,
            'titulo' => 'Enhorabuena',
            'tipoWarning' => 'success',
            'httpCode'=>'200'
        ]);
    }

    public static function respuestaError($mensaje){
        return ([
            'ok'=>'0',
            'mensaje'=> $mensaje,
            'titulo' => 'ERROR',
            'tipoWarning' => 'error',
            'httpCode'=>'500'
        ]);
    }




    public static function respuestaDatosOk($mensaje,$datos){
        return ([
            'ok'=>'1',
            'mensaje'=> $mensaje,
            'datos' => $datos,
            'titulo' => 'Enhorabuena',
            'tipoWarning' => 'success',
            'httpCode'=>'200'
        ]);
    }

    public static function respuestaDatosError($mensaje){
        return ([
            'ok'=>'0',
            'mensaje'=> $mensaje,
            'datos' => "",
            'titulo' => 'ERROR',
            'tipoWarning' => 'error',
            'httpCode'=>'500'
        ]);
    }

 

}
