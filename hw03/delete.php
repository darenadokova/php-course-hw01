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

if(isset($_POST['delete']) ){

    // get data
    // правим проверка ID
    if(isset($_POST['id']) AND strlen(trim($_POST['id']))>0){
        $data['id'] = trim($_POST['id']);

    }else {
        $error[] = 'Няма попълненo ID';
    }
    

    // правим проверка за грешки
    if(!count($error)>0){
        $data['active'] = 1;

        

        foreach($data AS $key=>$val){
            $data[$key] = mysqli_real_escape_string($conn,$data[$key]);
        }

        $sql = " DELETE FROM users WHERE id='$_POST[id]' ";

        echo $sql.'<br>';
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo 'Error on Delete';
        }else {
            // echo '<script type="text/javascript"> alert("Сигурни ли сте, че искате да изтриете файла?") </script>';
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
    <title>Delete data</title>
    
    
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
            margin-bottom: 10px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }
    
    </style>
</head>
<body>
<h1>Delete data</h1>
    <form action="" method="POST">
        <input type="text" name="id" placeholder="ID" required/><br>
        

        <input type="submit" name="delete" value="DELETE" />
    </form>
    
    
</body>
</html>