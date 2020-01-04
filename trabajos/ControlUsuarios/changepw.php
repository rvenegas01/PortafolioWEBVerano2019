<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Change Password</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='controlusuarios.css'>
    <script src='main.js'></script>
</head>

<body>

    <form id="inicio" action="changepw.php" method="post">
        <div>
            <h1 id="t1">Cambiar Contraseña</h1>
            <section id="input">
                <input id="email" class="txtfield" name="email" placeholder="example@e-mail.com" type="email" maxlength="40" size="40" require/><br><br>
                <input id="oldpw" class="txtfield" name="oldpw" placeholder="Curent password" type="password" minlength="8" size="20" require/><br><br>
                <input id="newpw1" class="txtfield" name="newpw1" placeholder="New password" type="password" minlength="8" size="20" require/><br><br>
                <input id="newpw2" class="txtfield" name="newpw2" placeholder="New password" type="password" minlength="8" size="20" require/>&nbsp;
                <input id="button" name="cpw" type="submit" value="Enviar" />
            </section>
        </div>
    </form>
</body>
</html>

<?php 
require('conn.php');
$conn = Conn();

if(isset($_POST['cpw'])) {
    $mail = mysqli_real_escape_string($conn,$_POST['email']);
    $old = mysqli_real_escape_string($conn,$_POST['oldpw']);
    $old = base64_encode($old);
    $n1 = mysqli_real_escape_string($conn,$_POST['newpw1']);
    $n2 = mysqli_real_escape_string($conn,$_POST['newpw2']);
    $query = "SELECT * from usuario WHERE email = '$mail' AND password = '$old'";
    $query_res = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($query_res);
    CloseCon($conn);
    if ($n1 == $n2) {
        if ($rows>=1){
            $conn = Conn();
            $n1 = base64_encode($n1);
            $update = "UPDATE usuario SET password='$n1' WHERE email='$mail'";
            $res = mysqli_query($conn,$update);
            // echo "<script type='text/javascript'>alert($res);window.location='changepw.php'</script>";
            if($res>=1) {
                // header("Location:signin.php");
                echo "<script type='text/javascript'>alert('Cambio de contraseña realizado con éxito!!');window.location='signin.php'</script>";
            }
            else{
                echo "<script type='text/javascript'>alert('No funciona!!');window.location='changepw.php'</script>";
            }
        }
        else{        
            echo "<script type='text/javascript'>alert('Email o contraseña incorrectos');window.location='changepw.php'</script>";
        }
    }
    else {
        echo "<script type='text/javascript'>alert('Las constraseñas no coinciden');window.location='changepw.php'</script>";
    }
}
CloseCon($conn);
?>