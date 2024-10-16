<?php
if(isset($_POST['login_but'])) {
    require '../../helpers/init_conn_db.php';
    $email_id = $_POST['id_usuario'];
    $password = $_POST['user_pass'];
    $sql = 'SELECT * FROM Admin WHERE nombre_admin=? OR email_admin=?';    
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,'ss',$email_id,$email_id);            
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);    
    if($row = mysqli_fetch_assoc($result)) {        
        $pwd_check = password_verify($password,$row['pwd_admin']);
        if($pwd_check == false) {
            header('Location: ../../admin/login.php?error=wrongpwd');
            exit();
        }
        else if($pwd_check == true) {
            session_start();
            $_SESSION['adminId'] = $row['id_admin'];
            $_SESSION['adminUname'] = $row['nombre_admin'];
            $_SESSION['adminEmail'] = $row['email_admin'];
            header('Location: ../../admin/index.php?login=success');
            exit();
        } else {
            header('Location: ../../admin/login.php?error=sqlerror');
            exit();
        }
    } else {
        header('Location: ../../admin/login.php?error=invalidcred');
        exit();
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('Location: ../../index.php');
    exit();
}
