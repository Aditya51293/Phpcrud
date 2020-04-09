<?php include "db.php";?>

<?php


function showAll(){
    global $connection;
    $query= "SELECT * FROM users";

    $result=mysqli_query($connection,$query);

    if(!$result){
        die("query failed".mysqli_error);
    }

    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];

        echo "<option value='$id'>$id</option>";

    }
}

function updateTable(){
    global $connection;
    if(isset($_POST['update'])){

        $username=$_POST['username'];
        $password=$_POST['password'];
        $id=$_POST['id'];
        $username=mysqli_real_escape_strings($connection,$username);
        $password=mysqli_real_escape_strings($connection,$password);
        $query1="UPDATE users SET ";
        $query1.="username='$username',password='$password'";
        $query1.="WHERE id=$id";
    
        $result=mysqli_query($connection,$query1);
    
        if(!$result){
            die("error".mysqli_error($connection));
        }
        else{
            echo "record updated";
        }
    
    }
}

function deleteTable(){
    global $connection;
    if(isset($_POST['delete'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $id=$_POST['id'];
        $query1="DELETE FROM users ";
        $query1.="WHERE id=$id";
    
        $result=mysqli_query($connection,$query1);
    
        if(!$result){
            die("error".mysqli_error($connection));
        }
        else{
            echo "record Deleted";
        }
    
    }
}

function Create(){
    global $connection;
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=$_POST['password'];

        $username=mysqli_real_escape_strings($connection,$username);
        $password=mysqli_real_escape_strings($connection,$password);

        $hashformat="$2y$10$";
        $salt="iusesomecrazystrings22";
        $hashandsalt=$hashformat.$salt;
        
        $encrypt=crypt($password,$hashandsalt);
        
        $query= "INSERT INTO users(username,password)";
        $query.="VALUES ('$username','$password')";
        
        $result=mysqli_query($connection,$query);
        
        if(!$result){
            die("query failed");
        }
        else{
            echo "record created";
        }
        
        
        /*if($username && $password){
            echo $username;
            echo $password;
        }
        else{
            echo "no username and password was submitted";
        }*/
        
        
    }
}

function readall(){

    global $connection;
    $query= "SELECT * FROM users";

    $result=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($result)){
        print_r($row);
    }

    if(!$result){
        die("query failed".mysqli_error);
    }

}


?>