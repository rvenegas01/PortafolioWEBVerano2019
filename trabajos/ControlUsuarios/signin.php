<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sign In</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='controlusuarios.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src='main.js'></script>
</head>

<body>
    <form id="inicio" action="signin.php" method="get">
        <div>
            <h1 id="t1">Sign In</h1>
            <section id="input">
                <input id="username" class="txtfield" name="username" placeholder="UserName" type="text" maxlength="20" size="20" aria-describedby="usr"/><br><br>
                <input id="pw" class="txtfield" type="password" name="pw" placeholder="password" minlength="8" size="20" />&nbsp;
                <input id="button" class="txtfield" type="submit" name="si" value="Log In!" />
            </section>
            <section id="ref">
                <a id="reg" href="signup.php" target="_blank">Regístrate ahora!</a><br>
                <a id="cp" href="changepw.php" target="_blank">Cambiar Contraseña</a><br>
                <a id="fp" href="forgot.html" target="_blank">Olvidé mi contraseña</a>
            </section>
        </div>
    </form>
</body>
</html>

<?php 
require('conn.php');
$conn = Conn();

if(isset($_GET['si'])) {
    $usr = mysqli_real_escape_string($conn,$_GET['username']);
    $password = mysqli_real_escape_string($conn,$_GET['pw']); 
    $password = base64_encode($password);

    $query = "SELECT * from usuario WHERE usr_name = '$usr' AND password = '$password'";
    $query_res = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($query_res);

    if ($rows){
        header("Location:lobby.php");
    }
    else{        
        echo "<script type='text/javascript'>alert('Usuario o contraseña incorrectos.');window.location='signin.php'</script>";
    }
}
CloseCon($conn);
?>