<?php
require '../../helpers/init_conn_db.php';
session_start();
if(isset($_SESSION['adminId'])) {
    if(isset($_POST['dep_but'])) {
        $flight_id = $_POST['id_vuelo'];
        $sql = "UPDATE vuelo SET status='dep' WHERE id_vuelo=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,'i',$flight_id);         
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header('Location: ../../admin/index.php');
        exit();
    }else if(isset($_POST['issue_but'])) {
        $flight_id = $_POST['id_vuelo'];
        $issue = $_POST['issue'];
        $delay_time = gmdate('h:i:s',(int)$issue*60);
        $sql = 'SELECT * FROM Flight WHERE id_vuelo=?';
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);              
        mysqli_stmt_bind_param($stmt,'i',$flight_id);         
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            $date_time_dep = $row['fecha_salida'];
            $date_dep = substr($date_time_dep,0,10);
            $time_dep = substr($date_time_dep,10,6) ;    
            $date_time_arr = $row['fecha_llegada'];
            $date_arr = substr($date_time_arr,0,10);
            $time_arr = substr($date_time_arr,10,6) ; 
            $time_dep = new DateTime($date_time_dep);
            $time_dep->add(new DateInterval('PT' . $issue . 'M'));            
            $stamp_dep = $time_dep->format('Y-m-d H:i:s');         
            $time_arr = new DateTime($date_time_arr);
            $time_arr->add(new DateInterval('PT' . $issue . 'M'));            
            $stamp_arr = $time_arr->format('Y-m-d H:i:s');                               
            $sql = "UPDATE vuelo SET status='issue',issue=?,fecha_salida=?,fecha_llegada=?
                WHERE id_vuelo=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,'sssi',$issue,$stamp_dep,$stamp_arr,$flight_id);         
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);;
            header('Location: ../../admin/index.php');
            exit();            
        }        
    } else if(isset($_POST['issue_soved_but'])) {
      $flight_id = $_POST['id_vuelo'];
      $sql = "UPDATE vuelo SET status='',issue='solved' WHERE id_vuelo=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,'i',$flight_id);         
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header('Location: ../../admin/index.php');
      exit();
    } else if(isset($_POST['arr_but'])) {
      $flight_id = $_POST['id_vuelo'];
      $issue = $_POST['issue'];
      $sql = "UPDATE vuelo SET status='arr'WHERE id_vuelo=?";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt,$sql);
      mysqli_stmt_bind_param($stmt,'i',$flight_id);         
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header('Location: ../../admin/index.php');
      exit();
    } else {
        header('Location: ../../admin/index.php');
        exit();
    }
}else {
    header('Location: ../../admin/index.php');
    exit();
}
