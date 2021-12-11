<?php
    // se encarga de manejar todo lo relacionado a login del usuario desde el cliente
	// se incluye el archivo de manejo de la base de datos que contiene la clase
    include("../MySQL/MySQL.php");
    include("ApiResponse.php");
    const OPENSSL_CIPHER_NAME = "aes-128-cbc";
    const CIPHER_KEY_LEN = 16; //128 bits

	try 
	{
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $Texto=$_POST["Texto"];
            $operacion=$_POST["OPERACION"];
            if($operacion=="encriptar")
            {
                $Encriptado=encrypt('0123456789abcdef','mT34SaFD5678QAZX',$Texto);//decrypt('0123456789abcdef', $Texto);
            }
            if($operacion=="desencriptar")
            {
                $Encriptado=$Texto;
                $Texto=decrypt('0123456789abcdef', $Texto);
            }
            
            $r=new CApiResponse();
            $r->error_200();
            $r->Add_Response("texto",$Texto);
            $r->Add_Response("encriptado",$Encriptado);

           // $r->Add_Response("salt",$salt);
           // $r->Add_Response("iv",$iv);
           // $r->Add_Response("key",$key);



            echo $r->Json_Response();
        }	
        else
        {
            $r=new CApiResponse();
            $r->error_405();
            echo $r->Json_Response();
        }
  }
	catch (Exception $e) 
	{
      $r=new CApiResponse();
      $r->error_500($e->getMessage());
      echo $r->Json_Response();
    }
    
    //-----------------------------------------------------------------------------------------------------------------------
    function fixKey($key) 
    {
        if (strlen($key) < CIPHER_KEY_LEN) 
        {
            //0 pad to len 16
            return str_pad("$key", CIPHER_KEY_LEN, "0"); 
        }
        if (strlen($key) > CIPHER_KEY_LEN) {
            //truncate to 16 bytes
            return substr($key, 0, CIPHER_KEY_LEN); 
        }
        return $key;
    }
    function encrypt($key, $iv, $data) 
    {
        $encodedEncryptedData = base64_encode(openssl_encrypt($data, OPENSSL_CIPHER_NAME,fixKey($key), OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData.":".$encodedIV;
        return $encryptedPayload;
    }
    function decrypt($key, $data) 
    {
      $parts = explode(':', $data); //Separate Encrypted data from iv.
        $encrypted = $parts[0];
        $iv = $parts[1];
        $decryptedData = openssl_decrypt(base64_decode($encrypted), OPENSSL_CIPHER_NAME, fixKey($key), OPENSSL_RAW_DATA, base64_decode($iv));
        return $decryptedData;
    }

?>
