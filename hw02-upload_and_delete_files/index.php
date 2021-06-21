<?php
 $error = array();
if(isset($_POST['submit']) && $_POST['submit']=="Upload File"){
    if(strlen($_FILES['fileToUpload']['name']) > 4){

        $is_ok = true;
        //проверка дали е картинка
        $check = getimagesize($_FILES['fileToUpload']['tmp_name']);

        if($check === false){
            $is_ok = false;
            $error[] = 'Файлът не е изображение.';
        }
  

      //проверяваме дали файлът съществува
      if(file_exists('upload/'.$_FILES['fileToUpload']['name'])){
            $is_ok = false;
            $error[] = 'Файл с такова име вече съществува.';
    }

        //проверка за големината на файла 1024b - 1Kb
        //50Kb
        if($_FILES['fileToUpload']['size'] > 51200){
            $is_ok = false;
            $error[] = 'Файлът не трябва да е по-голям от 50Kb.';
        }

        //проверка на тип на файла
        $ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        if($ext != 'jpg' && $ext !='jpeg' && $ext !='png' && $ext !='gif'){
            $is_ok = false;
            $error[] = 'Само JPG, JPEG, PNG и GIF са позволени формати';
        }

        //финална проверка
        if($is_ok){
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], 'upload/'.$_FILES['fileToUpload']['name'])){
                $success = 'Файлът е успешно качен!';
            }
        } else{
            $error[] = 'Проблем при качването на файла';
        }

    }
 else {
    $error[] = 'Няма прикачен файл';
}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
<body>
    <h1>Качване на изображение</h1>
   
    <?= (count($error)>0)? '<div style="color:red;">'.implode('<br>',$error).'</div>'."\r\n": ''; ?>
    <?= (isset($success))? '<div style="color:green;">'.$success.'</div>'."\r\n":''; ?>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="">
    <input type="submit" name="submit" value="Upload File">
    <input type="submit" name="delete" value="Delete"/>
    </form>
    <hr>
    

 
    <?php 
        $target_dir = "upload/";
        $button = '<button type="button" class="btn-close px-2 py-2" style="float:right;" disabled aria-label="Close"></button>';
        $info = '<p>Това е каченото изображение</p>';
        foreach(glob($target_dir.'*.{jpg,jpeg,png,gif}',GLOB_BRACE) AS $filename){

            if(isset($_POST['delete']) && $_POST['delete']=="X"){
                unlink($filename);
            } else {
                echo '<div class="img"><a href="https://disney.bg/" target="_blank"><img src="'.$filename.'"></a>'.basename($filename).
                '<form action="" method="post" enctype="multipart/form-data">
                <input type="submit" name="delete" value="X"/></form></div>';
            }
        }

        
    ?>
 

   <!-- php var_dump($success)
    <hr>
    <pre>
    php var_dump($_FILES) -->
</body>
</html>