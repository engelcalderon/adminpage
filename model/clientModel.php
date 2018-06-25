<?php

class clientModel extends DBConnection {

    public static function newClient($data) {
        try {
            $stmt = DBConnection::connect()->prepare("INSERT INTO client(identificacion, tipoID, nombre, nombre_fantasia, telefono, email, provincia, canton, distrito, barrio, direccion) 
                VALUES (:identificacion, :tipo_identificacion, :nombre, :nfantasia, :telefono, :email, :provincia, :canton, :distrito, :barrio, :direccion)");
        
              $stmt -> bindParam(":identificacion",$data["ID"], PDO::PARAM_STR);
              $stmt -> bindParam(":tipo_identificacion",$data["tipoID"], PDO::PARAM_STR);
              $stmt -> bindParam(":nombre",$data["nombre"], PDO::PARAM_STR);
              $stmt -> bindParam(":nfantasia",$data["nfantasia"], PDO::PARAM_STR);
              $stmt -> bindParam(":telefono",$data["telefono"], PDO::PARAM_STR);
              $stmt -> bindParam(":email",$data["email"], PDO::PARAM_STR);
              $stmt -> bindParam(":provincia",$data["provincia"], PDO::PARAM_STR);
              $stmt -> bindParam(":canton",$data["canton"], PDO::PARAM_STR);
              $stmt -> bindParam(":distrito",$data["distrito"], PDO::PARAM_STR);
              $stmt -> bindParam(":barrio",$data["barrio"], PDO::PARAM_STR);
              $stmt -> bindParam(":direccion",$data["direccion"], PDO::PARAM_STR);
              
              if ($stmt -> execute()) {
                    return array(
                        "status" => "success"
                    );
              }
            
              return array(
                "status" => "error",
                "message" => "Unknown"
            );
        }
        catch (PDOExecption $e) {
            return array(
                "status" => "error",
                "message" => $e->getMessage()
            );
        }
    }

    public static function getClients() {
        try {
            $stmt = DBConnection::connect()->prepare("SELECT * FROM client");

            if ($stmt->execute()) {
                return array(
                    "status"=> "success",
                    "data" => $stmt->fetchAll()
                );
            }

            return array(
                "status" => "error",
                "message" => "Unknown"
            );
            
        }
        catch (PDOExecption $e) {
            return array(
                "status" => "error",
                "message" => $e->getMessage()
            );
        }
    }

    public static function getClient($identificacion) {
        try {
            $stmt = DBConnection::connect()->prepare("SELECT * FROM client WHERE identificacion = :identificacion");
            $stmt->bindParam(":identificacion",$identificacion,PDO::PARAM_STR);

            if ($stmt->execute()) {
                return array(
                    "status"=> "success",
                    "data" => $stmt->fetch()
                );
            }

            return array(
                "status" => "error",
                "message" => "Unknown"
            );
            
        }
        catch (PDOExecption $e) {
            return array(
                "status" => "error",
                "message" => $e->getMessage()
            );
        }
    }
    

}

?>