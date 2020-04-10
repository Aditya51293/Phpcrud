<?php

include "config.php";

$query="SELECT * FROM crud";
$result=$conn->query($query);

$array=$result->fetch_assoc();

$json=json_encode($array,true);

var_dump($json);

$fo=fopen("myjson.json","w");

$fr=fwrite($fo,$json);

?>