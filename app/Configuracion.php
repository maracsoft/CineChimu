<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Util\Configuration;

class Configuracion extends Model
{
    const estamosEnMantenimiento = false;
    

    const pesoMaximoArchivoMB = 10;
   
    

    //FORMULARIO EMPLEADO
    const tamañoMaximoUsuario= 100;
    const tamañoMaximoContra= 200;
    const tamañoMaximoCodigoCedepas= 50;
    const tamañoMaximoNombres= 300;
    const tamañoMaximoApellidos= 300;
    const tamañoMaximoCorreo= 60;
    const tamañoMaximoNombreCargo= 100;
    const tamañoMaximoTelefono=20;

    //ENTIDAD FINANCIERA
    const tamañoMaximoNombreEF= 200;


    //Actividad Principal
    const tamañoMaximoDescripcionAP=100;

    //PARA PROYECTO
    const tamañoMaximoNombreP=200;
    const tamañoMaximoCodigoPresupuestalP=2;
    const tamañoMaximoNombreLargoP=300;
    const tamañoMaximoObjetivoGeneralP=300;

    //en caracteres

    const tamañoMaximoCodigoPresupuestal= 11;//detalles

    const tamañoMaximoConcepto= 60;//detalles
    const tamañoMaximoDescripcion= 100;//detalle requerimiento

    const tamañoMaximoNroEnRendicion= 100;
    const tamañoMaximoNroEnReposicion= 100;
    const valorMaximoNroItem= 100;//solicitud-rendicion (tiny Int)


    const tamañoMaximoNroComprobante= 20;
    
    const tamañoMaximoResumenDeActividad= 300;//rendicion
    const tamañoMaximoResumen= 300;//rendicion
    const tamañoMaximoJustificacion= 300;//solicitud
    
    const tamañoMaximoObservacion= 200;
    const valorMaximoCantArchivos= 100;//(tiny Int)


    //ultimas
    const tamañoMaximoGiraraAOrdenDe= 50;//solicitud
    const tamañoMaximoNroCuentaBanco= 50;//solicitud-reposicion

    const tamañoMaximoDomicilio= 200;//

    



    /* Medio verificacion resultado */
    const tamañoMaximoDescripcionesLargasProyecto = 600;

    const tamañoMaximoDescripcionesMedianas = 200;/* descripciones de Actividades e indicadores */
  

    /* El tamaño limite en la bd es 600, pongo 20 menos por si ponen saltos de linea */
    const tamañoMaximoResultadoEsperado = 580;
    const tamañoMaximoIndicadorResultado = 580;
    const tamañoMaximoMedioVerificacion = 580;

    const tamañoMaximoActividadResultado = 580;
    const tamañoMaximoIndicadorActividad = 580;

    const maximoDiasEdicionMetas = 3;

    //TABLA: lugar_ejecucion
    const tamañoZona=180;

    //TABLA: poblacion_beneficiaria
    const tamañoDescripcionPB=480;

    //TABLA: indicador_objespecifico
    const tamañoDescripcionIBE=580;

    /**PARA DJs */
    const tamañoMaximoLugar=180;
    const tamañoMaximoDetaleDJ=180;
    const tamañoMaximoConceptoDJ=180;


    /* SEDE */
    const tamañoMaximoNombreSede=200;

    /* PARA PERSONAS NATURALES Y JURIDICAS */
    const edadMinimaPermitida = 18;
    const tamañoMaxRazonSocial =100;
    const tamañoMaxActividadPrincipal = 100;
    const tamañoMaximoDireccion = 300;

    const tamañoMaximoNombreApellidoNA=180;
    const tamañoMaximoTelefonoNA=20;

    const tamañoMaximoRepresentante = 100;

    //TABLA : orden_compra
    const tamañoSeñoresOC=100;
    const tamañoAtencionOC=200;
    const tamañoReferenciaOC=200;
    const tamañoObservacionOC=300;

    //TABLA: detalle_orden_compra
    const tamañoDescripcionOC=200;


    /*  */
    const maximoDiasEdicionOrdenCompra = 3;


    /*
        Para que laravel use el .env directamente , correr
    php atisan config:clear */

    public static function enProduccion(){
        return env('EN_PRODUCCION') == true;
    } 


    //campo necesario en true para correr tests
    //define si se muestran o no algunos inputs que usamos como Hidden para almacenar variables
    
    public static function mostrarInputsEscondidos(){
        return env('MOSTRAR_INPUTS_ESCONDIDOS') == true;
    } 


     
    /* Define a donde se enviará el mensaje de error generado SÉ
        TRUE : se envia al grupo de produccion 
        false: se envia al grupo de pruebas
    */
    public static function direccionDelMensaje(){
        return env('DIRECCION_DEL_MENSAJE') == true;
    } 

    //https://dniruc.apisperu.com/api/v1/ruc/
    public static function getTokenParaAPISunat(){

        return env('TOKEN_API_SUNAT');
    }  


    


    public static function estaEnProduccionTexto(){

        return Configuracion::enProduccion() ? "SI ": "NO";

    }

    


    //para que solo se inyecte si estamos en local
    public static function inyectarCodigoLiveServer(){
        return !Configuracion::enProduccion();
    }

    public static function getInputTextOHidden(){
        if(!Configuracion::mostrarInputsEscondidos())
            return "hidden";
    
        return "text";

    } 

    public static function getDisplayNone(){
        if(!Configuracion::mostrarInputsEscondidos())
            return "display: none;";

    }
    

    public static function getRutaImagenCedepasPNG(){
        if(Configuracion::enProduccion())
            return "https://gestion.cedepas.org/img/LogoCedepas.png";
       
        return "/../../../img/LogoCedepas.png";
    }
    
    
    
    const mensajeErrorEstandar = "Ha ocurrido un error inesperado. Contacte con el administrador del sistema brindándole el Código de error ";
    public static function getMensajeError($codError){

        //pasamos el error a formato con 4 cifras
        $formateado = $codError;
        return Configuracion::mensajeErrorEstandar.$formateado." .";

    }


    //CUANDO ESTÁ EN TRUE y alguien ingresa con una IP extraña o no registrada, se le niega el acceso
    public static function activarSeguridadIPs(){

        /* Aquí debería jalar de Parametros */
        return ParametroSistema::getParametroSistema('activarSeguridadExtraIPs')->valor=="true";
        
    }

    public static function activarAyuda(){

        $par = ParametroSistema::getParametroSistema('activarAyuda');
        if(is_null($par)){
            return false;
        }
        return $par->valor == "true";
    }
    


    public static function getUrlManual(){
        if(Configuracion::enProduccion())
            return "https://manual.cedepas.org/";

        return "http://localhost:8081/Manual/";
        
    }

}
