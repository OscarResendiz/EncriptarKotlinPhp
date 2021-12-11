<?php
//clase que encapsula las respuestas de la api
class CApiResponse
{
    //arreglo que encapsula la respuesta
    protected  $response = [
        'status' => "OK",
        'response_id' => "200",
        'menssage' => "Solicitud aceptada",
        "extras" => array()
    ];
    //Solicitud aceptada; la respuesta contiene el resultado. Este es un código de respuesta general a cualquier solicitud. 
    //En las solicitudes GET, el recurso o datos solicitados están en el cuerpo de la respuesta. 
    //En las solicitudes PUT o DELETE, la solicitud fue satisfactoria y la información acerca del resultado 
    //(como los identificadores de recursos nuevo o los cambios en el estado del recurso) se puede encontrar en el cuerpo de la respuesta
    public function error_200($mensaje="Solicitud aceptada")
    {
        $this->response['status'] = "OK";
        $this->response['response_id'] = "200";
        $this->response['menssage'] = $mensaje;
    }
    /**Las operaciones PUT o POST devuelven este código de respuesta e indica que se ha creado un recurso de forma satisfactoria. 
     * El cuerpo de la respuesta podría, por ejemplo, contener información acerca de un nuevo recurso o información de validación
     *  (por ejemplo, cuándo se actualiza un activo).*/
    public function error_201($mensaje="se ha creado un recurso de forma satisfactoria")
    {
        $this->response['status'] = "CREATED";
        $this->response['response_id'] = "201";
        $this->response['menssage'] = $mensaje;

    }
    /**Indica que se ha aceptado la solicitud, pero no había datos para devolver. 
     * Esta respuesta se devuelve cuando se ha procesado la solicitud, pero no se ha devuelto ninguna información adicional acerca de los resultados. */
    public function error_204($mensaje="se ha aceptado la solicitud, pero no había datos para devolver")
    {
        $this->response['status'] = "NO_CONTENT";
        $this->response['response_id'] = "204";
        $this->response['menssage'] = $mensaje;

    }
    /**La solicitud no fue válida. Este código se devuelve cuando el servidor ha intentado procesar la solicitud, 
     * pero algún aspecto de la solicitud no es válido; 
     * por ejemplo, un recurso formateado de forma incorrecta o un intento de despliegue de un proyecto de sucesos no válido en el tiempo de ejecución de sucesos.
     * La información acerca de la solicitud se proporciona en el cuerpo de la respuesta e incluye un código de error y un mensaje de error. */
    public function error_400($mensaje="La solicitud no fue válida")
    {
        $this->response['status'] = "BAD_REQUEST";
        $this->response['response_id'] = "400";
        $this->response['menssage'] = $mensaje;

    }
    /**El servidor de aplicaciones devuelve este código de respuesta cuando está habilitada la seguridad y faltaba la información de autorización en la solicitud. */
    public function error_401($mensaje="No autorizado")
    {
        $this->response['status'] = "UNAUTHORIZED";
        $this->response['response_id'] = "401";
        $this->response['menssage'] = $mensaje;

    }
    /**Indica que el cliente ha intentado acceder a un recurso al que no tiene acceso. 
     * Podría producirse si el usuario que accede al recurso remoto no tiene privilegios suficientes; 
     * por ejemplo, con el rol WBERestApiUsers o WBERestApiPrivilegedUsers. 
     * Los usuarios que intenten acceder a proyectos de sucesos privados que son propiedad de otros podrían recibir también este error, 
     * pero solo si tienen el rol WBERestApiUsers en lugar de WBERestApiPrivilegedUsers. */
    public function error_403($mensaje="ha intentado acceder a un recurso al que no tiene acceso")
    {
        $this->response['status'] = "FORBIDDEN";
        $this->response['response_id'] = "403";
        $this->response['menssage'] = $mensaje;

    }
    /**Indica que el recurso de destino no existe. Esto podría deberse a que el URI no está bien formado o a que se ha suprimido el recurso. */
    public function error_404($mensaje="el recurso de destino no existe")
    {
        $this->response['status'] = "NOT_FOUND";
        $this->response['response_id'] = "404";
        $this->response['menssage'] = $mensaje;

    }
    /**Se produce cuando el recurso de destino no admite el método HTTP solicitado; por ejemplo, el recurso de funciones solo permite operaciones GET. */
    public function error_405($mensaje="recurso de destino no admite el metodo HTTP solicitado")
    {
        $this->response['status'] = "METHOD_NOT_ALLOWED";
        $this->response['response_id'] = "405";
        $this->response['menssage'] = $mensaje;

    }
    /**El recurso de destino no admite el formato de datos solicitado en la cabecera de Accept o el parámetro accept. 
     * Es decir, el cliente ha solicitado la devolución de los datos en un determinado formato, pero el servidor no puede devolver datos en ese formato. */
    public function error_406($mensaje="El recurso de destino no admite el formato de datos solicitado en la cabecera de Accept o el parámetro accept")
    {
        $this->response['status'] = "NOT_ACCEPTABLE";
        $this->response['response_id'] = "406";
        $this->response['menssage'] = $mensaje;

    }
    /**Indica que se ha detectado un cambio conflictivo durante un intento de modificación de un recurso. El cuerpo de la respuesta contiene más información. */
    public function error_409($mensaje="se ha detectado un cambio conflictivo durante un intento de modificación de un recurso")
    {
        $this->response['status'] = "CONFLICT";
        $this->response['response_id'] = "409";
        $this->response['menssage'] = $mensaje;

    }
    /**El recurso solicitado ya no está disponible en el servidor */
    public function error_410($mensaje="El recurso solicitado ya no está disponible en el servidor")
    {
        $this->response['status'] = "REMOVED";
        $this->response['response_id'] = "410";
        $this->response['menssage'] = $mensaje;

    }
    /**Se requiere un encabezado Content-Length en la solicitud. */
    public function error_411($mensaje="Se requiere un encabezado Content-Length en la solicitud.")
    {
        $this->response['status'] = "REQUIRED_LENGTH";
        $this->response['response_id'] = "411";
        $this->response['menssage'] = $mensaje;

    }
    /**Una condición previa proporcionada en la solicitud (por ejemplo, un encabezado If-Match) no coincide con el estado actual del recurso */
    public function error_412($mensaje="Error en la condición previa")
    {
        $this->response['status'] = "PRECONDITION_ERROR";
        $this->response['response_id'] = "412";
        $this->response['menssage'] = $mensaje;
    }
    /**El tamaño de la solicitud supera el límite máximo */
    public function error_413($mensaje="El tamaño de la solicitud supera el límite máximo")
    {
        $this->response['status'] = "REQUEST_ENTITY_TOO_LONG";
        $this->response['response_id'] = "413";
        $this->response['menssage'] = $mensaje;

    }
    /**El recurso de destino no admite el formato de datos del cuerpo de la solicitud especificado en la cabecera de Content-Type. */
    public function error_415($mensaje="El recurso de destino no admite el formato de datos del cuerpo de la solicitud especificado en la cabecera de Content-Type.")
    {
        $this->response['status'] = "UNSUPPORTED_MEDIA_TYPE";
        $this->response['response_id'] = "415";
        $this->response['menssage'] = $mensaje;

    }
    /**El intervalo de bytes especificado no es válido o no está disponible */
    public function error_416($mensaje="El intervalo de bytes especificado no es válido o no está disponible")
    {
        $this->response['status'] = "THE_REQUESTED_INTERVAL_CANNOT_BE_SATISFIED";
        $this->response['response_id'] = "416";
        $this->response['menssage'] = $mensaje;
    }
    /**No se puede procesar la solicitud porque tiene un formato que no es correcto semánticamente. */
    public function error_422($mensaje="No se puede procesar la solicitud porque tiene un formato que no es correcto semánticamente.")
    {
        $this->response['status'] = "UNPROCESSABLE_ENTITY";
        $this->response['response_id'] = "422";
        $this->response['menssage'] = $mensaje;
    }
    /**El recurso al que se va a acceder está bloqueado. */
    public function error_423($mensaje="El recurso al que se va a acceder está bloqueado.")
    {
        $this->response['status'] = "LOCKED";
        $this->response['response_id'] = "423";
        $this->response['menssage'] = $mensaje;

    }
    /**La aplicación cliente se limitó y no debe tratar de repetir la solicitud hasta que haya transcurrido un intervalo de tiempo. */
    public function error_429($mensaje="La aplicación cliente se limitó y no debe tratar de repetir la solicitud hasta que haya transcurrido un intervalo de tiempo.")
    {
        $this->response['status'] = "TOO_MANY_REQUESTS";
        $this->response['response_id'] = "429";
        $this->response['menssage'] = $mensaje;

    }

    /**Se ha producido un error interno en el servidor. Esto podría indicar un problema con la solicitud o un problema en el código del lado del servidor. 
     * Se puede encontrar información acerca del error en el cuerpo de respuesta. */
    public function error_500($mensaje="Se ha producido un error interno en el servidor")
    {
        $this->response['status'] = "INTERNAL_SERVER_ERROR";
        $this->response['response_id'] = "500";
        $this->response['menssage'] = $mensaje;

    }
    /**La característica solicitada no está implementada. */
    public function error_501($mensaje="La característica solicitada no está implementada.")
    {
        $this->response['status'] = "NOT_IMPLEMENTED";
        $this->response['response_id'] = "501";
        $this->response['menssage'] = $mensaje;

    }
    /**El servicio no está disponible temporalmente debido a que está en mantenimiento o sobrecargado. 
     * Puede repetir la solicitud después de un retraso, cuya longitud puede especificarse en un encabezado Retry-After. */
    public function error_503($mensaje="El servicio no está disponible")
    {
        $this->response['status'] = "SERVICE_NOT_AVAILABLE";
        $this->response['response_id'] = "503";
        $this->response['menssage'] = $mensaje;
    }
    /**El servidor, mientras actuaba como proxy, no recibió una respuesta puntual del servidor que precede en la cadena al que necesitaba acceder para
     *  completar la solicitud. Puede aparecer junto con el error 503. */
    public function error_504($mensaje="GATEWAY_TIMEOUT")
    {
        $this->response['status'] = "GATEWAY_TIMEOUT";
        $this->response['response_id'] = "504";
        $this->response['menssage'] = $mensaje;

    }
    /**Se alcanzó la cuota de almacenamiento máxima. */
    public function error_507($mensaje="Se alcanzó la cuota de almacenamiento máxima.")
    {
        $this->response['status'] = "INSUFFICIENT_STORAGE";
        $this->response['response_id'] = "507";
        $this->response['menssage'] = $mensaje;
    }
    /**La aplicación se limitó para superar el límite máximo de ancho de banda. La aplicación puede volver a intentar la solicitud después de que haya transcurrido más tiempo. */
    public function error_509($mensaje="La aplicación se limitó para superar el límite máximo de ancho de banda")
    {
        $this->response['status'] = "BANDWIDTH_LIMIT_EXCEEDED";
        $this->response['response_id'] = "509";
        $this->response['menssage'] = $mensaje;

    }
    /**Agrega un vaor al mensaje */
    public function Add_Response($key,$value)
    {
        $this->response['extras'][$key]=$value;
    }
    public function Json_Response()
    {
        return json_encode($this->response);
    }
}
?>