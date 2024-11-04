<?php
    include("bdd2.php");
        

    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUIA</title>
<style>
    /* Estilos generales */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f6f8;
        color: #333;
    }

    /* Contenedor principal */
    .container {
        max-width: 1000px;
        margin: 40px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
    }
    
    /* Título */
    h1 {
        font-size: 2em;
        text-align: center;
        color: #4a90e2;
        margin-bottom: 20px;
    }

    /* Sección */
    .section {
        margin-bottom: 30px;
    }

    /* Texto y párrafos */
    p {
        line-height: 1.6;
        color: #555;
    }

    p strong {
        color: #4a90e2;
    }

    /* Contenedor de imágenes */
    .image-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin-top: 15px;
    }

    /* Imágenes individuales */
    .image-container img,
    .section img {
        width: auto;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: transform 0.2s ease-in-out;
        cursor: pointer;
    }

    /* Efecto de vista previa ampliada */
    .image-container img:hover,
    .section img:hover {
        transform: scale(1.5); /* Aumenta el tamaño de la imagen al pasar el cursor */
        position: relative;
        z-index: 10;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    /* Botones */
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #e74c3c;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #c0392b;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        h1 {
            font-size: 1.8em;
        }

        .image-container img,
        .section img {
            max-width: 100%;
            height: auto;
        }
    }
</style>

</head>
<body>
    <div class="container">
        

        <!-- Sección de Texto -->
        <div class="section">
            <h1>GUIA PARA USUARIOS NUEVOS</h1>
            <p>
            Poner en su navegador lo siguiente:
            </p>
            <p>
            <strong>“ museook.free.nf “</strong>
            </p>
            <p>
            Les aparecerá la pagina:
            </p>
            <img src="fotos/Imagen2.png " >
            <p>
            En el caso de querer ingresar como ”invitado” no va a ser necesario ingresar una cuenta y verás lo siguiente:
            </p>
            <img src="fotos/Imagen3.png " >
            <p>
            Para poder ver todos los elementos deberas tocas el boton “buscar” de color rojo y asi poder ver todos los elementos del museo. 
            </p>
            <img src="fotos/Imagen4.png " >
            <p>
            Para poder buscar un elemento en especial deberás buscar en la barra blanca de arriba e ingresa el nombre del elemento o el id del mismo.
            </p>
            <img src="fotos/Imagen5.png " >
                        <p>
            Al tocar el elemento vas a poder ver la historia y mas detalles de el mismo, en el caso que el elemento esté dado de baja, no podrá ser visto por el invitado. 
            </p>
            <img src="fotos/Imagen6.png " >
                        <p>
            Si quieres ingresar a la pagina y iniciar sesión te aparecerá lo siguiente:
            </p>
            <img src="fotos/Imagen7.png " >
                        <p>
            Si tienes cuenta, deberás poner el nombre y la contraseña y así podrás iniciar sesión.
            En caso de no tener cuenta deberás registrarte, tendrás que apretar el botón registrarse y ahí deberás ingresar tus datos.  
            </p>
            <img src="fotos/Imagen8.png " >
                        <p>
            A continuación deberás iniciar sesión con los datos de la cuenta que acabas de registrar.
            </p>
            <img src="fotos/Imagen9.png " >
            <img src="fotos/Imagen10.png " >
                        <p>
            Ahí ya podrán visitar toda la página como les hemos explicado anteriormente.
            SI SOS ADMINISTRADOR te va a aparecer lo siguiente .

            </p>
            <img src="fotos/Imagen11.png " >
            <img src="fotos/Imagen12.png " >

            <p>
            Con el siguiente botón podrás agregar elementos y así poder ver más elementos del museo.
            </p>
            <img src="fotos/Imagen13.png " >
            <p>
            Ahí deberías agregar información del elemento y las fotos. 
            </p>
            <img src="fotos/Imagen14.png " >
                        <p>
            Ingresando a ese botón vas a poder ver todos los usuarios de la página. también cambiarle el estado de ”invitado”a”administrador”.
            </p>
            <img src="fotos/Imagen15.png " >
                        <p>
            Desde ahí vas a poder cambiarle el estado de” invitado”a”administrador” y así poder desde otra cuenta modificar los elementos.
            </p>
                        <p>
            En el caso de los elementos vas a poder modificarlos y también darlos de alta y baja con tan solo apretar el botón “ver” .
            </p>
            <img src="fotos/Imagen16.png " >
            <img src="fotos/Imagen17.png " >

            <p>
            Y así podrás cambiar o actualizar los elementos.
            </p>
            <img src="fotos/Imagen18.png " >

            <p>
            En el apartado de elementos del museo les aparecer con color amarillo los elementos dados de baja.
            </p>
            <img src="fotos/Imagen19.png " >
            <p>
            Y para dar de alta deberás tocar en botón dar de alta y te aparecerá lo siguiente.
            </p>
            <img src="fotos/Imagen20.png " >
            <p>
            Donde tendras que poner la nueva ubicacion del elemento seleccionado.
            </p>
        </div>

        
        
    </div>

</body>
</html>