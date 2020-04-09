<?php

$conn=new mysqli("localhost:3309","root","","phpcrud");

if($conn->connect_error){
    die("could not connect to the database".$conn->connect_error);
}

?>