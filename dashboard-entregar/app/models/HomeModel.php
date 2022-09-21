<?php

class HomeModel extends MainModel{
    public function input($dataInput){
        $sql="SELECT date, value FROM moviment where type='input' ORDER BY date=".$dataInput;
        $retorno=$this->db->query($sql);
        return $retorno;
    }

    public function output(){
        $sql="SELECT date FROM moviment where type='output' ORDER BY date";
        $retorno=$this->db->query($sql);
        return $retorno;
    }
    public function valoresLer(){
        $sql='SELECT type, date, value FROM moviment ORDER BY date';
        $retorno=$this->db->query($sql);
        return $retorno;
    }
}