<?php
session_start();
include "config.php";

$update=false;
$name="";
$email="";
$phone="";
$photo="";
$upload="";

if(isset($_POST['add'])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $photo=$_FILES['image']['name'];
    $upload="uploads/".$photo;

    $query="INSERT INTO crud(name,email,phone,photo) VALUES (?,?,?,?)";

    $stmt=$conn->prepare($query);
    $stmt->bind_param("ssss",$name,$email,$phone,$upload);
    $stmt->execute();
    move_uploaded_file($_FILES['image']['tmp_name'],$upload);
    header('location:index.php');
    $_SESSION['response']="sucessfully the record is inserted";
    $_SESSION['res_type']="Success";

}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];

    $sql="SELECT photo FROM crud WHERE id=?";

    $stmt2=$conn->prepare($sql);
    $stmt2->bind_param("i",$id);
    $stmt2->execute();

    $result=$stmt2->get_result();
    $row=$result->fetch_assoc();

    $imagepath=$row['photo'];
    unlink($imagepath);

    $query="DELETE FROM crud WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    header('location:index.php');
    $_SESSION['response']="sucessfully the record is deleted";
    $_SESSION['res_type']="danger";
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];

    $query="SELECT * FROM crud WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();

    $result=$stmt->get_result();
    $row=$result->fetch_assoc();

    $id=$row['id'];
    $name=$row['name'];
    $email=$row['email'];
    $phone=$row['phone'];
    $photo=$row['photo'];

    $update=true;
}

if(isset($_POST['update'])){
    
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $oldimage=$_FILES['image']['name'];
    if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
        $newimage="uploads/".$_FILES['image']['name'];
        unlink($oldimage);
        move_uploaded_file($_FILES['image']['tmp_name'],$newiamge);
    }

    else{
        $newimage=$oldimage;
    }
    $query="UPDATE crud SET name=?,email=?,phone=?,photo=? WHERE id=?";
    $stmt=$conn->prepare($query);
    $stmt->bind_param("ssssi",$name,$email,$phone,$newimage,$id);
    $stmt->execute();

    $_SESSION['response']="Updated successfully";
    $_SESSION['res_type']="success";

    header("location:index.php");


}

?>