<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location:../Login/login.php');
    exit;
}
include ("menu.html");

$usuario_logged =  $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario De Licencias</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease, width 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="date"],
        input[type="email"],
        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .readonly-field {
            background-color: #e9ecef;
            color: #495057;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding-top: 20px;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            margin-bottom: 10px;
        }

        .user-info {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="main-content">
    <div class="header">
        <h2>SERVICIOS INDUSTRIALES GONZÁLEZ</h2>
        <div class="user-info">
            <img src="../imagenes/INICO.png" alt="User Avatar">
            <span>BIENVENIDO:</span>
            <span style="padding: 10px;"><b><?php echo htmlspecialchars($usuario_logged) ?></b></span>
        </div>
    </div>
    <div class="container">
        <h2>Formulario De Licencias</h2>
        <form id="subscriptionForm" action="process_subscription.php" method="post">
            <label for="licencia">Licencia:</label>
            <select id="licencia" name="licencia" class="form-select">
                <option value="1">Seleccione su licencia</option>
                <option value="autocad">AutoCAD</option>
                <option value="solidworks">SolidWorks</option>
                <option value="windows">Windows</option>
                <option value="internet">Internet</option>
            </select><br>

            <label for="start_date">Fecha de Inicio:</label>
            <input type="date" id="start_date" name="start_date" required><br>

            <label for="end_date">Fecha de Término:</label>
            <input type="date" id="end_date" name="end_date" required><br>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="sender_email">Correo Electrónico del Remitente:</label>
            <input type="email" id="sender_email" name="sender_email" value="Alan_Avalos@sig.com.mx" readonly class="readonly-field"><br>

            <label for="sender_name">Nombre del Remitente:</label>
            <input type="text" id="sender_name" name="sender_name" value="Servicios Industriales Gonzalez" readonly class="readonly-field"><br>

            <input type="submit" value="Enviar">
        </form>
        <div id="alert-success" class="alert alert-success" style="display: none; margin-top: 20px;">
            Correo Enviado
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#subscriptionForm').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'process_subscription.php',
                type: 'post',
                data: $(this).serialize(),
                success: function(response) {
                    $('#alert-success').show();
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            });
        });
    });
</script>
<script>
    function cerrarSesion() {
      fetch('../Login/cierre.php', {
        method: 'POST'
      }).then(response => {
        if (response.ok) {
          window.location.href = '../Login/login.php';
        } else {
          alert('Error al cerrar sesión.');
        }
      }).catch(error => {
        console.error('Error al cerrar sesión:', error);
        alert('Ocurrió un error al cerrar sesión.');
      });
    }
</script>
</body>
</html>
