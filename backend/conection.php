<?php
//code by breykerd of Tecnoblack

//Conexion 
//error_reporting(0);
class Conexion extends mysqli {

    public function __construct(){
        parent::__construct('localhost','root','','corporio_corporac_chan');
        $this->query("SET NAMES 'utf8';");
        $this->connect_errno ? die('Error con la conexion') : $mysqli = 'Conectado';
        unset ($mysqli);

    }
}

//parte de la url de las imagenes para concatenar
//$urlImg='../../adminchamluci/img/';

$urlImg='adminchamluci/img/';