<?php
require '../../helpers/init_conn_db.php'; // Asegúrate de tener la ruta correcta

$admin_id = 1;
$arrival = '2024-12-01 12:00:00';
$departure = '2024-12-01 10:00:00';
$arr_city = 'Ciudad_Destino';
$dep_city = 'Ciudad_Origen';
$airline_name = 'Aerolínea_Prueba';
$seats = 100;
$dura = '2:00';
$price = 200.00;

$sql = "INSERT INTO vuelo (id_admin, fecha_llegada, fecha_salida, destino, salida, aerolinea, asientos, duration, precio, status, issue) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '', '')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('isssssisi', $admin_id, $arrival, $departure, $arr_city, $dep_city, $airline_name, $seats, $dura, $price);

if ($stmt->execute()) {
    echo "Inserción exitosa.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
