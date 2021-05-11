<?php

	session_start();
	
    $database = new mysqli('localhost','root','','database') or die(mysqli_error($database));
    $id=0;
    $name = '';
	$location ='';
	$update = false;

    if(isset($_POST['save'])){
    	$name= $_POST['name'];
    	$location= $_POST['location'];
    	
    	$database->query("INSERT INTO users (name,location) VALUES ('$name','$location')") or die($database->error);

    	$_SESSION['message'] = "Record has been saved";
    	$_SESSION['msg_type'] = "success";
    	header("location: index.php");
    }

    if(isset($_GET['delete'])){
    	$id= $_GET['delete'];
    	
    	$database->query("DELETE FROM users WHERE id=$id") or die($database->error);

    	$_SESSION['message'] = "Record has been deleted";
    	$_SESSION['msg_type'] = "danger";
    	header("location: index.php");
    }
    if(isset($_GET['edit'])){
    	$id= $_GET['edit'];
    	$update = true;
    	$results = $database->query("SELECT * FROM users WHERE id=$id") or die($database->error);
    	if($results->num_rows > 0){
    		$row = $results->fetch_array();
    		    	$name= $row['name'];
    				$location= $row['location'];
    	}

    	
    }
    if(isset($_POST['update'])){
    	$id= $_POST['id'];
    	$name= $_POST['name'];
    	$location= $_POST['location'];

    	$database->query("UPDATE users SET name='$name',location='$location' WHERE id=$id") or die($database->error);
    	$_SESSION['message'] = "Record has been Updated";
    	$_SESSION['msg_type'] = "warning";
    	header("location: index.php");

    	
    }
?>