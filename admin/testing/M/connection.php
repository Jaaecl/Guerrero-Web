<?php

class Conectar{

    public static function conexion(){

        try{

            $conn=new PDO('mysql:host=localhost; dbname=test', 'root', '');
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $conn->exec("SET CHARACTER SET utf8");      
                
        }catch(Exception $e){           
            
            echo "Error" . $e->getMessage();
            echo "Línea del error: " . $e->getLine();
        }

        return $conn;

    }
    public function close(){
    $conn=null;
    }

}

?>