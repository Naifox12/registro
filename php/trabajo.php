<?php

include ("conexion.php");

if (isset($_POST['registro'])){
    if (strlen($_POST['nombre_completo']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['usuario']) >= 1 && strlen($_POST['contraseña']) >= 1) {
       $nombre_completo = $_POST['nombre_completo'];
       $correo = $_POST['correo'];
       $usuario = $_POST['usuario'];
       $contraseña = $_POST['contraseña'];
       //Encriptamiento de contraseña
       $contraseña = hash('sha512',$contraseña);

       $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contraseña) VALUES ('$nombre_completo','$correo','$usuario','$contraseña')";
       $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

       //verifica que el correo no este repetido en la base de datos
       if(mysqli_num_rows($verificar_correo) > 0){
         echo '
             <script>
                 alert("¡Este correo ya esta registrado, intenta con otro diferente!");
                 window.location = "../registro.php";
             </script>
         ';
         exit();
       }

       $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");

       if(mysqli_num_rows($verificar_usuario) > 0){
         echo '
             <script>
                 alert("¡Este usuario ya esta registrado, intenta con otro diferente!");
                 window.location = "../registro.php";
             </script>
         ';
         exit();
       }

       $ejecutar = mysqli_query($conexion, $query);

       if($ejecutar){
         echo '
             <script>
                 alert("¡Usuario registrado exitosamente!");
                 window.location = "../registro.php";
             </script>
       ';
       }else{
          echo '
              <script>
                  alert("¡Intentalo de nuevo, usuario no almacenado!");
                  window.location = "../registro.php";
              </script>
        ';
      }
    }else{
        echo '
      <script>
          alert("¡Espacios vacios, por favor completelos!");
          window.location = "../registro.php";
      </script>
  ';
 }
}
?>
