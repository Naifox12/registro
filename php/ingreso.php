<?php

session_start();

include 'conexion.php';

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$contraseña = hash('sha512',$contraseña);

$validar_paso = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contraseña='$contraseña'");

if(mysqli_num_rows($validar_paso) > 0){
  $_SESSION['usuario'] = $correo;
  header("location: ../bienvenida.php");
  exit;
}else{
  echo '
      <script>
           alert("Usuario no existe, por favor verifique los datos de ingreso");
           window.location = "../registro.php";
      </script>
  ';
  exit;
}
?>
