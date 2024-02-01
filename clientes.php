<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <style>
        /* Estilos CSS aquí */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Lista de Clientes</h2>
    <table>
        <tr>
            <th>CustomerID</th>
            <th>CustomerName</th>
            <th>CustomerPhone</th>
            <th>CustomerIC</th>
            <th>CustomerEmail</th>
            <th>CustomerAddress</th>
            <th>CustomerGender</th>
            <th>UserID</th>
        </tr>
        <?php
        // Configuración de la conexión a la base de datos
        require ('connectDB.php');

        // Crear una conexión PDO
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta SQL para seleccionar todos los clientes
            $sql = "SELECT * FROM Customer";
            $stmt = $pdo->query($sql);

            // Iterar sobre los resultados y mostrarlos en la tabla
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['CustomerID']}</td>";
                echo "<td>{$row['CustomerName']}</td>";
                echo "<td>{$row['CustomerPhone']}</td>";
                echo "<td>{$row['CustomerIC']}</td>";
                echo "<td>{$row['CustomerEmail']}</td>";
                echo "<td>{$row['CustomerAddress']}</td>";
                echo "<td>{$row['CustomerGender']}</td>";
                echo "<td>{$row['UserID']}</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        ?>
    </table>
</body>
</html>