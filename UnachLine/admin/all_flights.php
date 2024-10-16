<?php include_once 'header.php'; ?>
<?php include_once 'footer.php';
require '../helpers/init_conn_db.php';?>
<?php
if(isset($_POST['del_flight']) and isset($_SESSION['adminId'])) {
  $id_vuelo = $_POST['id_vuelo'];
  $sql = 'DELETE FROM vuelo WHERE id_vuelo=?';
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt,$sql)) {
      header('Location: ../index.php?error=sqlerror');
      exit();            
  } else {  
    mysqli_stmt_bind_param($stmt,'i',$id_vuelo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo("<script>location.href = 'all_flights.php';</script>");
    exit();
  }
}
?>

<style>
table {
  background-color: white;
}
h1 {
  margin-top: 20px;
  margin-bottom: 20px;
  font-family: 'product sans';  
  font-size: 45px !important; 
  font-weight: lighter;
}
a:hover {
  text-decoration: none;
}
body {
  background-color: #efefef;
}
th {
  font-size: 22px;
}
td {
  margin-top: 10px !important;
  font-size: 16px;
  font-weight: bold;
  font-family: 'Assistant', sans-serif !important;
}
</style>

<main>
    <?php if(isset($_SESSION['adminId'])) { ?>
      <div class="container-md mt-2">
        <h1 class="display-4 text-center text-secondary">LISTA DE VUELOS</h1>
        <table class="table table-sm table-bordered">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Llegada</th>
              <th scope="col">Salida</th>
              <th scope="col">Origen</th>
              <th scope="col">Destino</th>
              <th scope="col">Aerolínea</th>
              <th scope="col">Asientos</th>
              <th scope="col">Precio</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <tbody>
            
            <?php
            $sql = 'SELECT * FROM vuelo ORDER BY id_vuelo DESC';
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);                
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "
              <tr class='text-center'>                  
                <td scope='row'>
                  <a href='pass_list.php?id_vuelo=".$row['id_vuelo']."'>
                  ".$row['id_vuelo']." </a> </td>
                <td>".$row['fecha_llegada']."</td>
                <td>".$row['fecha_salida']."</td>
                <td>".$row['salida']."</td>
                <td>".$row['destino']."</td>
                <td>".$row['aerolinea']."</td>
                <td>".$row['asientos']."</td>
                <td>$ ".$row['precio']."</td>
                <td>
                <form action='all_flights.php' method='post'>
                  <input name='id_vuelo' type='hidden' value=".$row['id_vuelo'].">
                  <button  class='btn' type='submit' name='del_flight'>
                  <i class='text-danger fa fa-trash'></i></button>
                </form>
                </td>                  
              </tr>
              ";
            }
            ?>

          </tbody>
        </table>

      </div>
    <?php } ?>
</main>
