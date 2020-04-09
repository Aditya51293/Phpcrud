<?php

include "action.php";

?>

<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<title>CRUD</title>

</head>


<body>



<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">CRUD App</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Feature</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Let us know</a>
      </li>
    </ul>
  </div>

  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
</nav>

<div class="container-fluid">
    <div class="row justfy-content-center">

        <div class="col-md-10">
            <h3 class="text-center text-dark">
            CRUD
            </h3>
            <?php if(isset($_SESSION['response'])){?>
            <div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
                <button type="button" class="close" data-dismiss="alert"></button>
                <?= $_SESSION['response'];?>
                
            </div>
            <?php } unset($_SESSION['response']);?>
            
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">

        <h3 class="text-center text-info">Add Record</h3>
        <form action="action.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id; ?>">

            <div class="form-group">
                <input type="text" name="name" class="form-control" value="<?= $name; ?>" place-holder="enter a name"> required>
            </div>
            <div class="form-group">
                <input type="email" name="email" value="<?= $email; ?>" class="form-control" place-holder="enter a email"> required>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" class="form-control" value="<?= $phone; ?>" place-holder="enter contact"> required>
            </div>
            <div class="form-group">
                <input type="hidden" name="oldimage" value="<?= $photo; ?>">
                <input type="file"  name="image" value="<?= $photo; ?>" class="custom-file" >
                <img src="<?= $photo; ?>" width="120" class="img-thumbnail">
            </div>
            
            

            <div class="form-group">
            <?php if($update==true){ ?>
                <input type="submit" name="update" class="custom-file" class="btn btn-success btn-block" value="update Record">
            <?php } else { ?>
                <input type="submit" name="add" class="custom-file" class="btn btn-primary btn-block" value="add Record">
            <?php } ?>
            </div>


        
        </form>

        </div>

        <div class="col-md-8">
        <?php
            $query="SELECT * FROM crud";
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $result=$stmt->get_result();

        ?>
            <h3 class="text-center text-info">Data present in DB</h3>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>image</th>
                        <th>name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row=$result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $row['id'];?></td>
                        <td><img src="<?= $row['photo'];?>"></td>
                        <td><?= $row['name'];?></td>
                        <td><?= $row['email'];?></td>
                        <td><?= $row['phone'];?></td>
                        <td><a href="details.php?details=<?= $row['id']; ?>" class="badge badge-primary">Details</a>|
                        <a href="action.php?delete=<?= $row['id']; ?>" class="badge badge-danger" onclick="return confirm('are you sure you want to delete?');">Delete</a>|
                        <a href="index.php?edit=<?= $row['id']; ?>" class="badge badge-success">Edit</a></td>
                    </tr>
                </tbody>
                    <?php } ?>
            </table>
        </div>

    </div>

</div>


</body>


</html>