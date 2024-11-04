<?php

    include 'bdd.php';
    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña
    $query = "INSERT INTO personal(nombre_completo, correo, usuario, password) 
    
                values('$nombre_completo', '$correo', '$usuario', '$password')";
    /*if (mysqli_query($conexion, $query)) {
    echo "Registro insertado correctamente";           
    }   
    else {
    echo "Error: " . mysqli_error($conexion);
    }
    */
    //verificar que el correo no se repita
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM personal WHERE correo ='$correo' ");
	
    $id = 1;
        $permiso = 1;


    $sql = "UPDATE personal SET permiso = $permiso WHERE id = $id";
    
    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro diferente");
                window.location = "registrarse.php";
            </script>
        ';
        exit();
        mysqli_close($conexion);
    }

     //verificar que el usuario no se repita
     $verificar_usuario = mysqli_query($conexion, "SELECT * FROM personal WHERE usuario ='$usuario' ");
    
     if(mysqli_num_rows($verificar_usuario) > 0){
         echo '
             <script>
                 alert("Este usuario ya esta registrado, intenta con otro diferente");
                 window.location = "registrarse.php";
             </script>
         ';
         exit();
         mysqli_close($conexion);
     }

        
 

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");

                window.location = "login.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Inténtalo de nuevo, usuario no almacenado");
                window.location = "registrarse.php";
            </script>
        ';
    }

    mysqli_close($conexion);
?>