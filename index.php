<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php require_once'process.php';?>
    <?php
    $database = new mysqli('localhost','root','','database') or die(mysqli_error($database));
    $result = $database->query("SELECT * FROM users") or die($database->error);

    ?>
    <div class="container" style="margin-top:100px">
    <?php
        if(isset($_SESSION['message'])) : 
    ?>
    <div class="alert alert-<?=$_SESSION['msg_type']?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif?>
    <h1>Welcome Bro!</h1>
    <form action="process.php" method="POST">
        
        <div class="mb-2">
       
         <input type="hidden" class="form-control" value="<?php echo $id;?>" name="id">
       
    </div>
    <div class="mb-2">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" value="<?php echo $name;?>" name="name">
       
    </div>
    <div class="mb-2">
        <label for="exampleInputPassword1" class="form-label">Location</label>
        <input type="text" class="form-control" value="<?php echo $location;?>" name="location" >
    </div>
    <?php 
        if($update == true):
    ?>

    <button type="submit" class="btn btn-info" name="update">Update</button>

    <?php else: ?>

       <button type="submit" class="btn btn-primary" name="save">Save</button> 

    <?php endif;?> 
    </form>
    <div class="card" style="margin-top: 20px">
        <div class="mb-2">
            <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
       
        
        <tbody>
             <?php while ($row = $result->fetch_assoc()): ?>
                <tr> 
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['location'];?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
        </div>
    </div>
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
  </body>
</html>