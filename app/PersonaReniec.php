<?php

namespace App;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

class PersonaReniec implements Jsonable
{
    
  public string $apellidos;
  public string $nombres;
  public string $dni;


  public function __construct($dni){

    $objPersona = static::ConsultarAPISunatDNI($dni);
    
    if($objPersona['ok']=="1"){
      $datos = $objPersona['datos'];
      $this->apellidos = $datos['apellidoPaterno'] . " " . $datos['apellidoMaterno'];
      $this->nombres = $datos['nombres'];
      $this->dni = $dni;

    }else{
      
    }

  }

  function toJson($options = 0){
    return [
      'apellidos' => $this->apellidos,
      'nombres'=>$this->nombres
    ];
  }

  /* Returns array with apellidoPaterno ,apellidoMaterno ,nombres */
  public static function ConsultarAPISunatDNI($dni) : array {
    try {
        $token = Configuracion::getTokenParaAPISunat();
        $linkConsulta = "https://dniruc.apisperu.com/api/v1/dni/".$dni."?token=".$token;
        
        $respuestaGET = file_get_contents($linkConsulta);
        //return $respuestaGET;
        $resultado = json_decode($respuestaGET);
         
        if(str_contains($respuestaGET,'"success":false')){
            return RespuestaAPI::respuestaDatosError("No se encontró a la persona con el dni $dni");
        }
        
        $resObj = [];
        $resObj['apellidoPaterno'] = ucwords(mb_strtolower($resultado->apellidoPaterno)); 
        $resObj['apellidoMaterno'] = ucwords(mb_strtolower($resultado->apellidoMaterno));  
        $resObj['nombres'] = ucwords(mb_strtolower($resultado->nombres)); 
        $nombreCompleto =  $resObj['nombres'] . " " . $resObj['apellidoPaterno'] . " ". $resObj['apellidoMaterno'];

        return RespuestaAPI::respuestaDatosOk("Persona con DNI $dni '$nombreCompleto' encontrada exitosamente.",$resObj);                
         
    } catch (\Throwable $th) {
        Debug::mensajeError('PERSONA POBLACION CONTROLLER ConsultarAPISunatDNI' , $th);
         
        throw $th;
        return RespuestaAPI::respuestaError("Ocurrió un error inesperado ");
    }

  }

  

}
