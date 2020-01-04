<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sign Up</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='controlusuarios.css'>
    <script src='main.js'></script>
</head>

<body>
    <form id="formsu" action="signup.php" method="post">
        <div>
            <h1 id="reg_title">Registro</h1>
            <input id="nombre" class="txtfield" name="nombre" placeholder="Nombre" type="text" maxlength="20" size="20" required/><br><br>
            <input id="ap1" class="txtfield" name="ap1" placeholder="Primer Apellido" type="text" maxlength="20" size="20" required/><br><br>
            <input id="ap2" class="txtfield" name="ap2" placeholder="Segundo Apellido" type="text" maxlength="20" size="20" required/><br><br>
            <input id="username" class="txtfield" name="username" placeholder="UserName" type="text" maxlength="20" size="20" required/><br><br>
            <input id="pw" class="txtfield" name="pw" placeholder="password" type="password" minlength="8" size="20" required/><br><br>
            <input id="email" class="txtfield" name="email" placeholder="example@e-mail.com" type="email" maxlength="40" size="40" /><br><br>
            <input id="number" class="txtfield" name="number" placeholder="Número de teléfono" type="number" maxlength="20" size="20" /><br><br>
            <input id="date" class="txtfield" name="date" placeholder="Fecha de nacimiento" type="date" maxlength="10" size="10" />
            <input id="button_reg" type="submit" name="su" value="Sign Up!" />
        </div>
    </form>
</body>

</html>

<?php 
require('conn.php');
$conn = Conn();

if(isset($_POST['su'])) {
    $name = mysqli_real_escape_string($conn,$_POST['nombre']);
    $a1 = mysqli_real_escape_string($conn,$_POST['ap1']);
    $a2 = mysqli_real_escape_string($conn,$_POST['ap2']);
    $usr = mysqli_real_escape_string($conn,$_POST['username']);
    $pass = mysqli_real_escape_string($conn,$_POST['pw']);
    $mail = mysqli_real_escape_string($conn,$_POST['email']);
    $num = mysqli_real_escape_string($conn,$_POST['number']);
    $birth = mysqli_real_escape_string($conn,$_POST['date']);
    $pass = base64_encode($pass);

    $insert = "INSERT INTO usuario(nombre,ap1,ap2,usr_name,password,email,phone,birth_date)
    VALUES('$name','$a1','$a2','$usr','$pass','$mail','$num','$birth')";
    $res = mysqli_query($conn,$insert);

    if ($res){
        // header("Location:signin.php");
        echo "<script type='text/javascript'>alert('Registro Completado');window.location='signin.php'</script>";
    }
    else{        
        echo "<script type='text/javascript'>alert('La cuenta ya Existe');window.location='signup.php'</script>";
    }
}
CloseCon($conn);
?>