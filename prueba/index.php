<?php
// Conexión a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'empresa';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si el formulario fue enviado, agregar el nuevo empleado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $puesto = $_POST['puesto'];
    $salario = $_POST['salario'];

    $sql = "INSERT INTO empleados (nombre, puesto, salario) VALUES ('$nombre', '$puesto', $salario)";
    if ($conn->query($sql) === TRUE) 
        echo "Empleado agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consulta para obtener los nombres de los empleados y el total de horas trabajadas
$sql = "
    SELECT e.nombre, COALESCE(SUM(p.horas_trabajadas), 0) AS total_horas_trabajadas
    FROM empleados e
    LEFT JOIN proyectos p ON e.id = p.empleado_id
    GROUP BY e.nombre
    ORDER BY total_horas_trabajadas DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados y Horas Trabajadas</title>
</head>
<body>
    <h2>Lista de Empleados y Total de Horas Trabajadas</h2>
    
    <table border="1">
        <tr>
            <th>Nombre del Empleado</th>
            <th>Total de Horas Trabajadas</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["total_horas_trabajadas"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No hay empleados</td></tr>";
        }
        ?>
    </table>

    <h2>Agregar Nuevo Empleado</h2>
    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="puesto">Puesto:</label>
        <input type="text" id="puesto" name="puesto" required><br>

        <label for="salario">Salario:</label>
        <input type="number" id="salario" name="salario" step="0.01" required><br>

        <input type="submit" value="Agregar Empleado">
    </form>

</body>
</html>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>
