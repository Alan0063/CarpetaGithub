<?php
session_start();
if (isset($_POST['pass_but']) && isset($_SESSION['userId'])) {
    require '../helpers/init_conn_db.php';  
    $mobile_flag = false;
    $flight_id = $_POST['flight_id'];
    $passengers = $_POST['passengers'];
    $mob_len = count($_POST['mobile']);
    
    // Validación de números de teléfono a 10 dígitos
    for ($i = 0; $i < $mob_len; $i++) {
        // Validar que el número contenga solo dígitos y tenga exactamente 10 dígitos
        if (!preg_match('/^\d{10}$/', $_POST['mobile'][$i])) {
            $mobile_flag = true;
            break;            
        }
    }

    if ($mobile_flag) {
        header('Location: ../pass_form.php?error=moblen');
        exit();         
    }

    $date_len = count($_POST['date']);
    $current_year = (int)date('Y'); // Obtener el año actual

    for ($i = 0; $i < $date_len; $i++) {
        $dob = $_POST['date'][$i];
        $year = (int)substr($dob, 0, 4); // Obtener el año
        $month = (int)substr($dob, 5, 2); // Obtener el mes
        $day = (int)substr($dob, 8, 2); // Obtener el día

        // Validar que el año esté entre 1950 y el año actual
        if ($year < 1950 || $year > $current_year) {
            header('Location: ../pass_form.php?error=yearoutofrange');
            exit();
        }

        // Validar que la fecha no sea futura
        $input_date = DateTime::createFromFormat('Y-m-d', $dob);
        if ($input_date === false) {
            header('Location: ../pass_form.php?error=invdate'); // Error si la fecha no es válida
            exit();
        }

        $current_date = new DateTime();
        if ($input_date > $current_date) {
            header('Location: ../pass_form.php?error=futuredob'); // Error si la fecha es futura
            exit();
        }
    }        

    $stmt = mysqli_stmt_init($conn);
    $sql = 'SELECT * FROM pasajero WHERE id_vuelo = ? AND id_usuario = ?';
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../pass_form.php?error=sqlerror');
        exit();            
    } else {
        $flight_id = intval($flight_id);
        $uid = intval($_SESSION['userId']);
        mysqli_stmt_bind_param($stmt, 'ii', $flight_id, $uid);            
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $pass_id = null;
        while ($row = mysqli_fetch_assoc($result)) {
            $pass_id = $row['id_pasajero'];
        }
    } 
    
    if (is_null($pass_id)) {
        $pass_id = 0;
        $stmt = mysqli_stmt_init($conn);
        $sql = 'ALTER TABLE pasajero AUTO_INCREMENT = 1';
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../pass_form.php?error=sqlerror');
            exit();            
        } else {         
            mysqli_stmt_execute($stmt);
        }        
    }
    
    $stmt = mysqli_stmt_init($conn);
    $flag = false;
    for ($i = 0; $i < $date_len; $i++) {
        $sql = 'INSERT INTO pasajero (id_usuario, telefono, dob, f_name, m_name, l_name, id_vuelo) VALUES (?, ?, ?, ?, ?, ?, ?)';            
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../pass_form.php?error=sqlerror');
            exit();            
        } else {
            mysqli_stmt_bind_param($stmt, 'iissssi', $_SESSION['userId'], $_POST['mobile'][$i], $_POST['date'][$i], $_POST['firstname'][$i], $_POST['midname'][$i], $_POST['lastname'][$i], $flight_id);                           
            mysqli_stmt_execute($stmt);  
            $flag = true;        
        }
    }   
    //penddd
    if ($flag) {
        $_SESSION['flight_id'] = $flight_id;
        $_SESSION['class'] = $_POST['class'];
        $_SESSION['passengers'] = $passengers;
        $_SESSION['price'] = $_POST['price'];
        $_SESSION['type'] = $_POST['type'];
        $_SESSION['ret_date'] = $_POST['ret_date'];
        $_SESSION['pass_id'] = $pass_id + 1;
        header('Location: ../payment.php');
        exit();          
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);    

} else {
    header('Location: ../pass_form.php');
    exit();  
}
