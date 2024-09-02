<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "AdminSIG2024";
$dbname = "subscriptions";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$email = $_POST['email'];

// Obtener datos de la licencia para el correo especificado
$sql = "SELECT licencia, start_date, end_date, sender_email, sender_name FROM subscriptions WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $licencia = $row['licencia'];
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
    $sender_email = $row['sender_email'];
    $sender_name = $row['sender_name'];

    // Enviar correo
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'mail.sig.com.mx';
        $mail->SMTPAuth = true;
        $mail->Username = 'alan_avalos@sig.com.mx';
        $mail->Password = 'fe$4n#DKq!a^';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        // Remitente y destinatario
        $mail->setFrom($sender_email, $sender_name);
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Aviso de Expiracion de Licencia';
        $mail->Body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Notifiacion De Licencias</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    color: #333;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 2px solid #131212;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    box-sizing: border-box;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header img {
                    max-width: 150px;
                    height: auto;
                }
                .header h1 {
                    font-size: 22px;
                    color: #0056b3;
                    margin: 10px 0;
                }
                .content {
                    font-size: 16px;
                    line-height: 1.6;
                }
                .content ul {
                    padding-left: 20px;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                    font-size: 14px;
                    color: #777;
                }
                .footer .contact-info {
                    margin-bottom: 10px;
                }
                .footer .contact-info p {
                    margin: 0;
                }
                @media (max-width: 600px) {
                    .container {
                        padding: 10px;
                    }
                    .header h1 {
                        font-size: 20px;
                    }
                    .content {
                        font-size: 14px;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img src="https://d2q79iu7y748jz.cloudfront.net/s/_squarelogo/256x256/40eaaf07809383661b86952525c5b78d" alt="Logotipo de la Empresa">
                    <h1>Notificación de Licencia</h1>
                </div>
                <div class="content">
                    <p>Estimado Usuario,</p>
                    <p>Queremos recordarte que tu licencia <strong>' . htmlspecialchars($licencia) . '</strong> esta proxima a vencer. A continuacion, te proporcionamos los detalles:</p>
                    <ul>
                        <li><strong>Fecha de inicio:</strong> ' . htmlspecialchars($start_date) . '</li>
                        <li><strong>Fecha de vencimiento:</strong> ' . htmlspecialchars($end_date) . '</li>
                    </ul>
                    <p>Por favor, realiza las gestiones necesarias para renovarla a tiempo.</p>
                    <p>Gracias por tu atencion.</p>
                    <p>Saludos cordiales,</p>
                    <p>El equipo de Sistemas de Servicios Industriales Gonzalez</p>
                </div>
                <div class="footer">
                    <div class="contact-info">
                        <p><strong>Servicios Industriales Gonzalez</strong></p>
                        <p>Direccion: Av. del Parque 2115, 66657 Pesqueria, N.L.</p>
                        <p>Telefono: 81 2222 5400</p>
                    </div>
                    <p>Este es un mensaje automatico. Por favor, no respondas a este correo.</p>
                </div>
            </div>
        </body>
        </html>';

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Correo reenviado correctamente"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Error al enviar el correo: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No se encontró ninguna licencia para el correo especificado."]);
}

$conn->close();
?>
