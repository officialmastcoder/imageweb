<?php
if(!isset($_SESSION))  { session_start(); }
include ("imagex_func.php");

$erro="";
if (isset($_POST['login_token'])) {
if ($_POST['login_token'] == $login_token) {	
 
 
    if (md5($_POST['ImageX_PW']) == $ImageX_PW && $_POST['c'] == $_SESSION['c']) {
 
        $_SESSION['ImageX_PW'] =  $ImageX_PW;
        header('Location: imagex.php');
        exit;
    }elseif (md5($_POST['ImageX_PW']) != $ImageX_PW || $_POST['c'] != $_SESSION['c']) {
        $erro='<div class="alert alert-danger"> <strong>Wrong password or wrong captcha!</strong></div> ';
    } 	
	 
}else{$erro='<div class="alert alert-danger"> <strong>The Session is expired. Please reload your Browser</strong></div> ';}		
}

   
	$a = rand(1,10);
    $b = rand(1,10);
    $c = $a + $b;	
	$_SESSION['c']= $c;
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ImageX Image and Fotos Upload & Management Script">
    <meta name="keywords" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">

    <title><?php echo _('ImageX Image and Fotos Upload & Management for your website');?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/imagex-notificacoes.css" />
    <link rel="stylesheet" href="assets/css/efeitos.css" />
    <link rel="stylesheet" href="assets/css/core.css?a=<?php echo time();?>" />
  </head>
	
	
	
	
<body>

 
	<div class="container top50">
	<div class="container__item" style="text-align: center">
		<img src="assets/img/Logo-pequeno.png" class="top20">
		 <form action="imagex-login.php" method="post" class="top20">
			 <?php echo $erro;?>
			<input type="text" class="form__field" placeholder="<?php echo $a.' + '.$b;?>" name="c" required style="max-width: 100px;">
			<input type="password" class="form__field" placeholder="Type your password" name="ImageX_PW" required>
			 <input type="hidden" name="login_token" value="<?php echo $login_token;?>">
			<button type="submit" class="btn btn--primary btn--inside uppercase"><?php echo _('Send');?></button>
			<br>

		</form>
			
	</div>
</div>

 
	
	
	
<style type="text/css">
body{ background: #F5F5F5;}	
.container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
}

.uppercase {
  text-transform: uppercase;
}

.btn {
  display: inline-block;
  background: transparent;
  color: inherit;
  font: inherit;
  border: 0;
  outline: 0;
  padding: 0;
  -webkit-transition: all 200ms ease-in;
  transition: all 200ms ease-in;
  cursor: pointer;
}
.btn--primary {
  background: #EB8889;
  color: #fff;
  box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.1);
  border-radius: 2px;
  padding: 12px 36px;
}
.btn--primary:hover {
  background: #e87778;
}
.btn--primary:active {
  background: #EB8889;
  box-shadow: inset 0 0 10px 2px rgba(0, 0, 0, 0.2);
}
.btn--inside {
  margin-left: -96px;
}

.form__field {
  width: 360px;
  background: #fff;
  color: #a3a3a3;
  font: inherit;
  box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.1);
  border: 0;
  outline: 0;
  padding: 22px 18px;
}
</style>	
	
 
	</body>
</html>