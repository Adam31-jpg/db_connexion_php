<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php

$conn = new mysqli('localhost', 'root', '', 'test');

//require('config.php');
session_start();
if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
//    $email = stripslashes($_REQUEST['email']);
//    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
    $result = mysqli_query($conn,$query) or die(mysqli_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['username'] = $username;
        header("Location: ../connecter.html");
    }else{
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?>
<form class="box" action="" method="post" name="login">
    <h1 class="box-title">Connexion</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
<!--    <input type="email" class="box-input" name="email" placeholder="Nom d'utilisateur">-->
    <input type="password" class="box-input" name="password" placeholder="Mot de passe">
    <input type="submit" value="Connexion " name="submit" class="box-button">
    <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
</body>
</html>
