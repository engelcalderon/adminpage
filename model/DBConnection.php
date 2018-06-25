<?php

class DBConnection {
    
    public function connect() {
        try {
            $link = new PDO("mysql:host=localhost;dbname=adminlte","root","");
            return $link;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
}

?>