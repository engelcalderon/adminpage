<?php

class userModel extends DBConnection {

    public static function insert($data) {
        try {
            $stmt = DBConnection::connect()->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

            $stmt -> bindParam(":name",$data["name"], PDO::PARAM_STR);
            $stmt -> bindParam(":email",$data["email"], PDO::PARAM_STR);
            $stmt -> bindParam(":password",$data["password"], PDO::PARAM_STR);
    
            return $stmt -> execute();
        }
        catch (Exception $e) {
            return $e;
        }
    }

    public static function verifyData($data) {
        try {
            $stmt = DBConnection::connect()->prepare("SELECT email, password FROM users WHERE email = :email");
            $stmt->bindParam(":email",$data["email"],PDO::PARAM_STR);
            $stmt->execute();
    
            return [
                "state"=> "ok",
                "data" => $stmt->fetch()
            ];
        }
        catch (Exception $e) {
            return [
                "state"=> "error",
                "data" => $e
            ];
        }
    }
    

}

?>