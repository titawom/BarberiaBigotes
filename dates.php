<?php
session_start();
require ('connectDB.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $reason = $_POST['reason'];
    
    $conn = new mysqli($servername, $username, $password); 
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    $sql = "USE BookStore";
    $conn->query($sql);
    
    $sql = "INSERT INTO Dates(fullname, email, phone, date, reason) VALUES('".$fullname."', '".$email."', '".$phone."', '".$date."', '".$reason."')";
    $conn->query($sql);

    header('Location: index.php');
}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
<body>
<header>
<blockquote>
    <a href="index.php"><img class="logo" src="image/logo.png"></a>
</blockquote>
</header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cita Médica</title>
    <style>
        /* Estilos CSS aquí */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        textarea {
            height: 100px; /* Altura ajustable según tus necesidades */
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            align-self: flex-end; /* Alinea el botón a la derecha */
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .titulo {
            margin: auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 class="titulo">Solicitud de Cita Previa</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="fullname">Nombre Completo:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Teléfono de Contacto:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="date">Fecha de la Cita:</label>
        <input type="date" id="date" name="date" required>

        <label for="reason">Motivo de la Cita:</label>
        <textarea id="reason" name="reason" rows="4" required></textarea>

        <input type="submit" value="Solicitar Cita">
    </form>
</body>
</html>