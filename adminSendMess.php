<?php
require_once 'libdb.php';
DB::init("guesthouse");
session_start();

$name=$_POST['name'];
$surname=$_POST['surname'];
$email=$_POST['email'];
$text=$_POST['text'];

$sql=sprintf("INSERT INTO mess SET date=NOW(), name=%s, surname=%s, email=%s, text=%s",
     DB::toSql($name),
     DB::toSql($surname),
     DB::toSql($email),
     DB::tosql($text)
       );
DB::doSql($sql);