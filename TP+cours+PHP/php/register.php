<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css" />
</head>
<body>
<?php
session_start();

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'] )){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = new mysqli('localhost', 'root', '', 'test');

    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error );
    }else{

        $stmt = $conn->prepare("insert into users(username, email, password) values(?, ?, ?)");

        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();



//    $stmt = $conn->prepare("insert into users(username, email, password)
//        values(?, ?, ?)");
//
//    $stmt->bind_param("sss", $username, $email, $password);
//    $stmt->execute();
        $_SESSION['prenom'] = $username;
        $_SESSION['nom'] = $email;
        $_SESSION['password'] = $password;
        if(mysqli_affected_rows($conn) > 0 ){
            header('Location: login.php');
            exit;
        }else{
            echo 'ca na pas marcher';
        }


        $stmt->close();
        $conn->close();
    }
}













// $mysqli = new mysqli("localhost", "root", "", "test_connexion");
//
// $res =  $mysqli->prepare('INSERT INTO user (prenom, nom, password ) values ("'.$_POST['name'].'","'.$_POST['nom'].'", "'.$_POST['password'].'" ')


?>
<form class="box" action="" method="post" name="register">
    <h1 class="box-title">Inscription</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
    <input type="email" class="box-input" name="email" placeholder="Email">
    <input type="password" class="box-input" name="password" placeholder="Mot de passe">
    <input type="submit" value="Inscription " name="submit" class="box-button">
    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
</body>
</html>

