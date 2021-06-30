<?php
// connect data
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_database = 'webdev_cms';

// connect
$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());

}




$error = array();


if(isset($_POST['edit']) ){

    // get data
    // правим проверка на имената
    if(isset($_POST['names']) AND strlen(trim($_POST['names']))>0){
        $data['names'] = trim($_POST['names']);

    }else {
        $error[] = 'Няма попълнени имена';
    }
    // правим проверка на username
    if(isset($_POST['username']) AND strlen(trim($_POST['username']))>0){
        $data['username'] = trim($_POST['username']);

    }else {
        $error[] = 'Няма попълнено потребителско име';
    }
    // правим проверка на парола
    if(isset($_POST['password']) AND strlen(trim($_POST['password']))>0){
        $data['password'] = trim($_POST['password']);

    }else {
        $error[] = 'Няма попълнена парола';
    }

    // правим проверка за грешки
    if(!count($error)>0){
        $data['active'] = 1;


        foreach($data AS $key=>$val){
            $data[$key] = mysqli_real_escape_string($conn,$data[$key]);
        }

        $sql = " UPDATE users SET id='$_POST[id]', names='$_POST[names]', username='$_POST[username]', password='$_POST[password]', active='$_POST[active]' where id='$_POST[id]' ";

        echo $sql.'<br>';
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo 'Error on EDIT';
        }else {
            header('Location: index.php');
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update data</title>
    
    
    <style>
      body {
        font-family: sans-serif;
    }

    h1 {
        font-weight: 200;
        margin-left: 10px;
    }
  
        input {
            border: 1px solid gray;
            border-radius: 5px;
            padding: 6px;
            margin-left: 10px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }
    
    </style>
</head>
<body>
<h1>Update data</h1>
    <form action="" method="POST">
        <p><input type="text" name="id" id="" placeholder="ID:" required /></p>
        <p><input type="text" name="names" id="" placeholder="Name: " required /></p>
        <p><input type="text" name="username" id="" placeholder="Username: " required /></p>
        <p><input type="text" name="password" id="" placeholder="Password: " required /></p>
        <p><input type="number" name="active" placeholder="Active status: " id="" required /></p>

        <input type="submit" name="edit" value="EDIT" />
    </form>
    
    
</body>
</html>