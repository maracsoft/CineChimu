<?php

namespace App;

use Carbon\Carbon;
use DateTime;

class Fecha
{
    
    var $fechaEnSQL; /* Valor  de la fecha en formato SQL  YYYY-MM-DD*/
    var $fechaEnLegible;/* Valor de la fecha en formato legible perú DD/MM/YYYY */
    


    public function nuevaFechaSQL($legible){
        $this->fechaEnLegible = $legible ;
        
        $sql = substr($legible,6,4).'-'.substr($legible,3,2).'-'.substr($legible,0,2);
        $this->fechaEnSQL = $sql;
    }


    /* funcion tipo libreria
    ingresa una fecha en formato peruano DD/MM/YYYY
    sale una fecha en formato sql YYYY-MM-DD

    */
    public static function formatoParaSQL($fecha){

        // date('d/m/Y', strtotime($this->fechaInicio));
        /*              año                 mes                 dia*/
        return substr($fecha,6,4).'-'.substr($fecha,3,2).'-'.substr($fecha,0,2);
    }
    

    /* funcion tipo libreria 
        ingresa una fecha en formato sql YYYY-MM-DD
        sale una fecha en formato peruano DD/MM/YYYY
    */
    public static function formatoParaVistas($fecha){
        return date('d/m/Y', strtotime($fecha));

    }

    public static function formatoFechaHoraParaVistas($fecha){
      return date('d/m/Y H:i:s', strtotime($fecha));
    }



    public static function formatoFechaHoraEscrita($fecha){
      return Fecha::formatoFechaEscrita($fecha)." a las ". Fecha::formatoSoloHora($fecha);
    }


    public static function formatoFechaEscrita($fecha){
      return Fecha::traducirAEspañol(date('l d \d\e F Y', strtotime($fecha)));
    }

    public static function formatoFechaEscritaSinAño($fecha){
      return Fecha::traducirAEspañol(date('l d \d\e F', strtotime($fecha)));
    }

    

    public static function formatoSoloHora($fecha){
      return date('h:i a', strtotime($fecha));
    }
    public static function formatoSoloHora_hora($fecha){
      return date('H', strtotime($fecha));
    }
    public static function formatoSoloHora_minuto($fecha){
      return date('i', strtotime($fecha));
    }
    
    


    public static function traducirAEspañol($string_fecha){
      $string_fecha = str_replace("Monday","Lunes",$string_fecha);
      $string_fecha = str_replace("Tuesday","Martes",$string_fecha);
      $string_fecha = str_replace("Wednesday","Miércoles",$string_fecha);
      $string_fecha = str_replace("Thursday","Jueves",$string_fecha);
      $string_fecha = str_replace("Friday","Viernes",$string_fecha);
      $string_fecha = str_replace("Saturday","Sábado",$string_fecha);
      $string_fecha = str_replace("Sunday","Domingo",$string_fecha);

      $string_fecha = str_replace("January","Enero",$string_fecha);
      $string_fecha = str_replace("February","Febrero",$string_fecha);
      $string_fecha = str_replace("March","Marzo",$string_fecha);
      $string_fecha = str_replace("April","Abril",$string_fecha);
      $string_fecha = str_replace("May","Mayo",$string_fecha);
      $string_fecha = str_replace("June","Junio",$string_fecha);
      $string_fecha = str_replace("July","Julio",$string_fecha);
      $string_fecha = str_replace("August","Agosto",$string_fecha);
      $string_fecha = str_replace("September","Septiembre",$string_fecha);
      $string_fecha = str_replace("Octuber","Octubre",$string_fecha);
      $string_fecha = str_replace("November","Noviembre",$string_fecha);
      $string_fecha = str_replace("December","Diciembre",$string_fecha);

      return $string_fecha;


    }

    

    public static function formatoFechaParaVistas($fecha){
      return date('d/m/Y', strtotime($fecha));


    }
    public static function formatoHoraParaVistas($fecha){
      return date('H:i:s', strtotime($fecha));
    }
 


    public static function getFechaHoraActual(){
        $fecha = Carbon::now();
        return Fecha::formatoFechaHoraParaVistas($fecha);
    }


    public static function getFechaAntigua(){
        return "01/01/2000";

    }


    /* 
        funcion para IndicadorActividadController registrarMetaProgramada
        compara 2 fechas que llegan en vectores 
        $fecha1 = 
        [
            'año'=>2000,
            'mes'=>5
        ]
    */
    public static function compararFechas($fecha1,$fecha2){


    }

    //llega string y objeto proyecto
    // 2020-01-20
    public static function dentroDeFechasProyecto($fechaMetaString,$proyecto){
        $fechaMinima = strtotime(substr($proyecto->fechaInicio,0,8)."01");
        $fechaMaxima = strtotime(substr($proyecto->fechaFinalizacion,0,8)."31");



        $fechaMeta = strtotime($fechaMetaString);
 
    
        //Debug::mensajeSimple($proyecto->fechaInicio." () ".$proyecto->fechaFinalizacion);
        

        return ($fechaMeta <= $fechaMaxima && $fechaMeta >= $fechaMinima);

    }


    /* Se le pasa una String de fecha en formato SQL y retorna la fecha escrita tipo "4 de Enero de 2019" */
    public static function escribirEnTexto($fecha){

        
        $dia = date('d', strtotime($fecha));
        $mes = date('m', strtotime($fecha));
        $año = date('Y', strtotime($fecha));
        

        $nombreMes = Mes::findOrFail($mes)->nombre;
        return $dia." de ".$nombreMes." de ".$año;

    }

}
