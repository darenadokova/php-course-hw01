<?php
 $error = array();
session_start();
if(!isset($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$sent=false;
$to = $subject = $message = '';
if(isset($_POST['send'])){ //we have POST data
    //protect
    if(isset($_POST['protect']) AND $_POST['protect'] == $_SESSION['protect']){
        //we need check
        $is_ok = true;
        // To
        if(isset($_POST['to']) AND filter_var($_POST['to'],FILTER_VALIDATE_EMAIL) !==false){
            $to = filter_var($_POST['to'],FILTER_VALIDATE_EMAIL);
        }else{
            $is_ok = false;
            $error[] = 'Моля, въведете валиден email';
        }

        //Subject
        if(isset($_POST['subject']) AND strlen(trim($_POST['subject']))>0){
            $subject = trim($_POST['subject']);
        }else{
            $is_ok = false;
            $error[] = 'Моля, въведете тема';
        }
        // Message
        if(isset($_POST['message']) AND strlen(trim($_POST['message']))>0){
            $message = trim($_POST['message']);
        }else{
            $is_ok = false;
            $error[] = 'Моля, въведете вашето съобщение';
        }

        //SEND MAIL
        if($is_ok ){
            $message = wordwrap($message, 70, "\r\n");
            if($_SESSION['count']>5){
                exit('Надвишен лимит');
            }

            if(!mail ($to , $subject , $message ) ){
                exit('съобщението не е изпратено');
            }else{
                $sent  = true;
                $to = $subject = $message = '';
                $_SESSION['count'] ++;
            }

        }


    }else{
        exit('Този начин е забранен ');
    }
}



$_SESSION['protect'] = md5(rand(23000, 50000).date('YmdHis'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <title>Send e-mail</title>
</head>
<body>
    <div class="container">
        <?php if($sent){ ?>
            <div class="alert alert-success">
                <strong>Успех!</strong> Съобщението беше изпратено.
            </div>

        <?php } ?>
        
        <h1>Изпращане на имейл</h1>
        <form action="" method="post">
            <input type="hidden" name="protect" value="<?=$_SESSION['protect'];?>">
            <div class="form-group">
                <label for="to">To:</label>
                <input name="to" type="email" class="form-control" id="to" value="<?=$to;?>" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input name="subject" type="text" class="form-control" id="subject"  value="<?=$subject;?>" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="message" class="form-control" rows="5" id="comment" required><?=$message;?></textarea>
            </div>
            <button type="submit" name="send" class="btn btn-success">Изпрати!</button>




        </form>
        <hr>
        <pre>
            <?php var_dump($_POST); ?>
            <?php var_dump($_SESSION); ?>

    </div>
</body>
</html>