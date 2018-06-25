<?php

class DBConnection {
    
    public function connect() {
        $link = new PDO("mysql:host=localhost;dbname=adminlte","root","");
        return $link;
    }
}

?>