<?php
session_start();
if (isset($_POST['flight_but']) and isset($_SESSION['adminId'])) {
    require '../../helpers/init_conn_db.php';

    $source_date = $_POST['source_date'];
    $source_time = $_POST['source_time'];
    $dest_date = $_POST['dest_date'];
    $dest_time = $_POST['dest_time'];
    $dep_city = $_POST['salida'];
    $arr_city = $_POST['destino'];
    $price = $_POST['precio'];
    $air_id = $_POST['airline_name'];
    $dura = $_POST['dura'];

    if ($dep_city === $arr_city || $arr_city === 'To' || $arr_city === 'From') {
        header('Location: ../../admin/flight.php?error=same');
        exit();
    }

    // Validar fechas y horas
    $arrival = $dest_date . ' ' . $dest_time . ':00';
    $departure = $source_date . ' ' . $source_time . ':00';
    $flag = strtotime($arrival) > strtotime($departure);

    if (!$flag) {
        header('Location: ../../admin/flight.php?error=destless');
        exit();
    } else {
        $sql = "SELECT * FROM aerolinea WHERE id_aerolinea = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            error_log("Error preparando consulta SELECT: " . mysqli_error($conn));
            echo "Error preparando consulta SELECT: " . mysqli_error($conn);
            exit();
        }
        mysqli_stmt_bind_param($stmt, 'i', $air_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $seats = $row['asientos'];
            $airline_name = $row['nombre'];

            $sql = "INSERT INTO vuelo (id_admin, fecha_llegada, fecha_salida, destino, salida, aerolinea, asientos, duration, precio, status, issue) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, '', '')";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                error_log("Error preparando consulta INSERT: " . mysqli_error($conn));
                echo "Error preparando consulta INSERT: " . mysqli_error($conn);
                exit();
            } else {
                $admin_id = $_SESSION['adminId'];
                mysqli_stmt_bind_param($stmt, 'isssssisi', $admin_id, $arrival, $departure, $arr_city, $dep_city, $airline_name, $seats, $dura, $price);
                if (mysqli_stmt_execute($stmt)) {
                    header('Location: ../../admin/flight.php?flight=success');
                    exit();
                } else {
                    error_log("Error ejecutando consulta INSERT: " . mysqli_error($conn));
                    echo "Error ejecutando consulta INSERT: " . mysqli_error($conn);
                    exit();
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            error_log("Error obteniendo datos de aerolinea: " . mysqli_error($conn));
            echo "Error obteniendo datos de aerolinea: " . mysqli_error($conn);
            exit();
        }
    }
} else {
    header('Location: ../../index.php');
    exit();
}
?>
