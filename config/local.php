<?php 

class Conection extends PDO{
    public function __construct(){
        $dsn = "mysql:host=localhost; dbname=catalogo";
        parent::__construct($dsn,"root","");
    }
}
?>