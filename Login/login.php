<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Inicio De Sesión</title>
    <link rel="shortcut icon" href="../imagenes/cuenta.png" type="image/png">
</head>
<style>
/* Estilos generales */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial Narrow Bold', sans-serif;
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
}

.container {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 90%;
    max-width: 1250px;
    padding: 30px;
    background: rgba(255, 251, 251, 0.95);
    box-shadow: 0 8px 32px 0 rgba(0, 17, 255, 0.37);
    backdrop-filter: blur(8.5px);
    border-radius: 20px;
    transition: all 0.3s ease;
}

.landing-page h1 {
    font-size: 2.5rem;
    color: #595252;
    margin: 0;
    animation: fadeInLeft 1.5s ease-in-out;
}

.landing-page img {
    width: 180px;
    border-radius: 50%;
    margin-top: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.landing-page img:hover {
    transform: scale(1.1);
}

.login-box {
    width: 100%;
    max-width: 450px;
    padding: 40px;
    background: #ffffff;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    animation: fadeInRight 1.5s ease-in-out;
    transition: all 0.3s ease;
}

.login-box form {
    display: flex;
    flex-direction: column;
}

.login-box h2 {
    margin-bottom: 30px;
    color: #333;
    text-align: center;
    font-size: 1.8rem;
}

.input-group {
    margin-bottom: 25px;
}

.input-group label {
    display: block;
    margin-bottom: 8px;
    color: #777;
    font-weight: bold;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.input-group input:focus {
    border-color: #6c63ff;
    outline: none;
}

.button {
    padding: 12px;
    background: #6c63ff;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1.2rem;
    transition: background 0.3s ease, transform 0.3s ease;
}

.button:hover {
    background: #5750d6;
    transform: scale(1.05);
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@media (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
        padding: 15px;
    }

    .landing-page h1 {
        font-size: 2rem;
        text-align: center;
    }

    .landing-page img {
        width: 120px;
    }

    .login-box {
        width: 100%;
        max-width: 400px;
        margin-top: 20px;
        padding: 30px;
    }

    .button {
        font-size: 1rem;
    }
}
</style>
<body>
    <main class="main">
        <div class="container">
            <section class="landing-page">
                <h1>BIENVENIDOS A SIG-INVENTORY</h1>
                <center>
                    <img src="https://uploads1.craft.co/uploads/company/logo/17084xx/1708482/normal_b0e44d6ead6897ac.jpg" alt="Company Logo">
                </center>
            </section>
            <aside class="login-box">
                <form action="autenticacion.php" method="post">
                    <h2>INICIO DE SESIÓN</h2>
                    <div class="input-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" autocomplete="username">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="pass" name="pass" autocomplete="current-password">
                    </div>
                    <input type="submit" value="Iniciar" name="validar" class="button">
                </form>
            </aside>
        </div>
    </main>
</body>
</html>
