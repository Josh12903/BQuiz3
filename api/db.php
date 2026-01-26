<?php

session_start();

class DB{
    protected $dsn="mysql:host=localhost;dbname=db03;charset=utf8";
    protected $pdo
    protected $table


function __construct($table){
    $this->table=$table;
    $this>pdo=new PDO(dsn,'root','');
}

function find($id){
    $sql="SELECT * FROM $this->table ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


function save($array){
    $sql="SELECT * FROM $this->table ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


function del($id){
    $sql="SELECT * FROM $this->table ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


function count(...$arg){
    $sql="SELECT * FROM $this->table ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


function sum($col,...$arg){
    $sql="SELECT * FROM $this->table ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


private function array2sql($array){
    $sql="SELECT * FROM $this->table ";

    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

}


function q($array){
    $dsn="mysql:host=localhost;dbname=db03;charset=utf8";
    $pdo=new PDO($this->dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}


function to($url){
    header("location:".$url);
}


$Title=new DB['title'];
$Mvim=new DB['mvim'];
$=new DB[''];
$=new DB[''];
$=new DB[''];
$=new DB[''];
$=new DB[''];
$=new DB[''];