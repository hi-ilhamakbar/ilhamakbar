<?php
session_start();
$user='gdx'; $pass='Kontol100%';
if($_POST){
 if($_POST['u']==$user && $_POST['p']==$pass){
  $_SESSION['admin']=true; header('Location: dashboard.php'); exit;
 } else { $err='Invalid';}
}
?>
<form method="post">
<input name="u"><input name="p" type="password"><button>Login</button>
<?php if(isset($err)) echo $err; ?>
</form>
