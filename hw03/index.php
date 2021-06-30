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


if(isset($_POST['submit']) ){

    // get data
    // имена
    if(isset($_POST['names']) AND strlen(trim($_POST['names']))>0){
        $data['names'] = trim($_POST['names']);

    }else {
        $error[] = 'Няма попълнени имена';
    }
    // пот. име
    if(isset($_POST['username']) AND strlen(trim($_POST['username']))>0){
        $data['username'] = trim($_POST['username']);

    }else {
        $error[] = 'Няма попълнено потребителско име';
    }
    // парола
    if(isset($_POST['password']) AND strlen(trim($_POST['password']))>0){
        $data['password'] = trim($_POST['password']);

    }else {
        $error[] = 'Няма попълнена парола';
    }

    // проверка за грешки
    if(!count($error)>0){
        $data['active'] = 1;

        


        

       
        // $data['names'] = mysqli_real_escape_string($conn, $data['names']);

        foreach($data AS $key=>$val){
            $data[$key] = mysqli_real_escape_string($conn,$data[$key]);
        }

        $sql = " INSERT INTO users( names, username, password, active) VALUES ( '". $data['names']. "' , '".$data['username']."' , '".$data['password']."' , '".$data['active']."') ";

        echo $sql.'<br>';
        $result = mysqli_query($conn, $sql);
        if(!$result){
            echo 'Error on INSERT';
        }else {
            echo 'Потребител с имена '.$data['names'].' беше записан успешно!';
        }
    }

    // data
    // $data = array(
    //     'names' => 'Super Admin',
    //     'username' => 'admin',
    //     'password' => 'admin',
    //     'active' => 1,
    // );

    // connection data
    
}
// and if POST
// load users

$sql = "SELECT id, names, username FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0 ) {
    $users = '';
    while($row = mysqli_fetch_assoc($result)){
        $users .= '<li>id: '.$row['id'].' - '.$row['names'].' ('.$row['username'].' )'. '<a href="edit.php?file='.$sql.'"<button class="btn-upd">EDIT</button></a>'. '<a href="delete.php?file='.$sql.'"<button class="btn-del">DELETE</button></a></li>';
        
    
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    
    <style>


.btn-del, .btn-upd  {
    border: 1px solid gray;
    border-radius: 5px;
    padding: 6px;
    margin-left: 10px;
    font-size: 13px;
    cursor: pointer;
    text-decoration: none;
}

li {
    margin-bottom: 20px;
}
    
    </style>
</head>
<body>
    <form action="" method="POST">
        <p>Name: <input type="text" name="names" id="" placeholder="Name: " required /></p>
        <p>Username: <input type="text" name="username" placeholder="Username: " id="" required /></p>
        <p>Password: <input type="text" name="password" placeholder="Password: " id="" required /></p>
        <input type="submit" name="submit" value="Submit" />
    </form>
    <hr>
    <ul>
        <?= $users ?>
        
    </ul>
</body>
</html>

