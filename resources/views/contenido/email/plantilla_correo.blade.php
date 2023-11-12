<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>correo perrón</title>

    <style type="text/css">
        .container-fluid {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: red;
            background-color: #a4faab;
            flex-direction: column
        }

        .cabecera {
            text-align: center;
            display: flex;
            align-self: center;
            justify-content: center;
            width: 100%;
            flex: 0 1 4.5rem;
        }

        .contenido {
            flex: 1 1 auto;
            display: flex;
            align-items: flex-start;
            overflow: auto;
            flex-direction: column;
            width: 100%;
            height: 100%;
            font-size: 1.5rem;
            box-shadow: 10px 10px 15px 0px rgba(2, 182, 137, 0.372);
            border: 5px solid rgb(0, 118, 35);
        }

        .pie {
            flex: 0 1 4.5rem;
            background-color: #81e089ad;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0000ee;
        }
    </style>




</head>

<body class="clean-body u_body" >
    <div class="container-fluid">
        <div class="cabecera">
            <h1>ESTE ES UN CORREO ENVIADO DESDE ALEJANDRO GONZALEZ XD</h1>
        </div>
        <div class="contenido">
            <h2>MENSAJE: </h2>
            <?= $contenido ?>
        </div>
        <div class="pie">
            Saludos
            <br>
            Próximo ING. en Sistemas Computacionales Alejandro Emmanuel Gonzalez
            Ramirez
            <br>
            Puros corridos tumbados SIUUUUUUUUUUUUU!!!!
            <br>
            Tecnológico Nacional de México
            <br>
            Instituto tecnológico de Toluca
        </div>
    </div>
   
</body>

</html>
