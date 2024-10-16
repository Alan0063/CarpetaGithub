<?php include_once 'header.php'; 
require '../helpers/init_conn_db.php';?>

<link rel="stylesheet" href="../assets/css/admin.css">
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300&family=Poiret+One&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cinzel&display=swap" rel="stylesheet">
<style>
  body {
    /* background-color: #B0E2FF; */
    background-color: #efefef;
  }
  td {
    /* font-family: 'Assistant', sans-serif !important; */
    font-size: 18px !important;
  }
  p {
  font-size: 35px;
  font-weight: 100;
  font-family: 'product sans';  
  }  

  .main-section{
	width:100%;
	margin:0 auto;
	text-align: center;
	padding: 0px 5px;
}
.dashbord{
	width:23%;
	display: inline-block;
	background-color:#34495E;
	color:#fff;
	margin-top: 50px; 
}
.icon-section i{
	font-size: 30px;
	padding:10px;
	border:1px solid #fff;
	border-radius:50%;
	margin-top:-25px;
	margin-bottom: 10px;
	background-color:#34495E;
}
.icon-section p{
	margin:0px;
	font-size: 20px;
	padding-bottom: 10px;
}
.detail-section{
	background-color: #2F4254;
	padding: 5px 0px;
}
.dashbord .detail-section:hover{
	background-color: #5a5a5a;
	cursor: pointer;
}
.detail-section a{
	color:#fff;
	text-decoration: none;
}
.dashbord-2 .icon-section,.dashbord-2 .icon-section i{
	background-color: #9CB4CC;
}
.dashbord-2 .detail-section{
	background-color: #149077;
}

.dashbord-1 .icon-section,.dashbord-1 .icon-section i{
	background-color: #2980B9;
}
.dashbord-1 .detail-section{
	background-color:#2573A6;
}
.dashbord-3 .icon-section,.dashbord-3 .icon-section i{
	background-color:#316B83;
}
.dashbord-3 .detail-section{
	background-color:#CF4436;
}
  
</style>
<main>
    <?php if(isset($_SESSION['adminId'])) { ?>
      <div class="container">

        <div class="main-section">
          <div class="dashbord dashbord-1">
            <div class="icon-section">
              <i class="fa fa-users" aria-hidden="true"></i><br>
             Total de Pasajeros
              <p><?php include 'psngrcnt.php';?></p>
            </div>
           
          </div>
          <div class="dashbord dashbord-2">
            <div class="icon-section">
              <i class="fa fa-money" aria-hidden="true"></i><br>
             Cantidad
              <p>$ <?php include 'amtcnt.php';?></p>
            </div>
           
          </div>
          <div class="dashbord dashbord-3">
            <div class="icon-section">
              <i class="fa fa-plane" aria-hidden="true"></i><br>
             Vuelos
              <p><?php include 'flightscnt.php';?></p>
            </div>
           
          </div>     
          
          <div class="dashbord">
            <div class="icon-section">
              <i class="fa fa-plane fa-rotate-180" aria-hidden="true"></i><br>
             Aerolíneas Disponibles
              <p><?php include 'airlcnt.php';?></p>
            </div>
           
          </div>  
          
        </div>

        
      <div class="card mt-4" id="flight">
  <div class="card-body">
      <div class="dropdown" style="float: right;">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-filter"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#flight">Vuelos de Hoy</a>
          <a class="dropdown-item" href="#issue">Problemas de Vuelo de Hoy</a>
          <a class="dropdown-item" href="#dep">Vuelos que Salieron Hoy</a>
          <a class="dropdown-item" href="#arr">Vuelos que Llegaron Hoy</a>
        </div>
      </div>        
    <p class="text-secondary">Vuelos de Hoy</p>
    <table class="table-sm table table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Llegada</th>
          <th scope="col">Salida</th>
          <th scope="col">Destino</th>
          <th scope="col">Origen</th>
          <th scope="col">Aerolínea</th>
          <th></th>
        </tr>
      </thead>
      <tbody>              
          <?php
            $curr_date = (string)date('y-m-d');
            $curr_date = '20'.$curr_date;
            $sql = "SELECT * FROM vuelo WHERE DATE(fecha_salida)=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,'s',$curr_date);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
              if($row['status']== '') {
                echo '     
            <td scope="row">
              <a href="pass_list.php?flight_id='.$row['id_vuelo'].'" style="text-decoration:underline;">
              '.$row['id_vuelo'].' </a> </td>
            <td>'.$row['fecha_llegada'].'</td>
            <td>'.$row['fecha_salida'].'</td>
            <td>'.$row['destino'].'</td>
            <td>'.$row['salida'].'</td>
            <td>'.$row['aerolinea'].'</td> 
            <th class="options">
              <div class="dropdown">
                <a class="text-reset text-decoration-none" href="#" 
                  id="dropdownMenuButton" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                  
                  <i class="fa fa-ellipsis-v"></i> </td>
                </a>  
                <div class="dropdown-menu">
                  <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                    <input type="hidden" type="number" name="flight_id" 
                      value='.$row['id_vuelo'].'>
                    <div class="form-group">
                      <label for="exampleDropdownFormEmail1">Introduce el tiempo en minutos.                              
                      </label>
                      <input type="number" class="form-control" name="issue" 
                        placeholder="Ej. 120">
                    </div>  
                    <button type="submit" name="issue_but" 
                      class="btn btn-danger btn-sm">Enviar problema</button>
                    <div class="dropdown-divider"></div>
                    <button type="submit" name="dep_but" 
                      class="btn btn-primary btn-sm">Salido</button>
                  </form>
                </div>
              </div>  
            </th>                
          </tr> ' ; }} ?>
      </tbody>
    </table>        
  
  </div>
</div>

<div class="card" id="issue">
  <div class="card-body">
      <div class="dropdown" style="float: right;">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-filter"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#flight">Vuelo de hoy</a>
          <a class="dropdown-item" href="#issue">Problemas de Vuelo de Hoy</a>
          <a class="dropdown-item" href="#dep">Vuelos que Salieron Hoy</a>
          <a class="dropdown-item" href="#arr">Vuelos que Llegaron Hoy</a>
        </div>
      </div>        
    <p class="text-secondary">Problemas de Vuelo de Hoy</p>
    <table class="table-sm table table-hover table-bordered">
    <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Llegada</th>
          <th scope="col">Salida</th>
          <th scope="col">Destino</th>
          <th scope="col">Origen</th>
          <th scope="col">Aerolínea</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          <tr>
          <?php
            $curr_date = (string)date('y-m-d');
            $curr_date = '20'.$curr_date;
            $sql = "SELECT * FROM vuelo WHERE DATE(fecha_salida)=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,'s',$curr_date);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
              if($row['status']=='issue') {
                echo '              
            <td scope="row">
              <a href="pass_list.php?flight_id='.$row['id_vuelo'].'">
              '.$row['id_vuelo'].' </a> </td>
            <td>'.$row['fecha_llegada'].'</td>
            <td>'.$row['fecha_salida'].'</td>
            <td>'.$row['destino'].'</td>
            <td>'.$row['salida'].'</td>
            <td>'.$row['aerolinea'].'</td> 
            <th class="options">
              <div class="dropdown">
                <a class="text-reset text-decoration-none" href="#" 
                  id="dropdownMenuButton" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                  
                  <i class="fa fa-ellipsis-v"></i> </td>
                </a>  
                <div class="dropdown-menu">
                  <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                    <input type="hidden" type="number" name="flight_id" 
                      value='.$row['id_vuelo'].'>  
                    <button type="submit" name="issue_soved_but" 
                      class="btn btn-danger btn-sm">¡Problema resuelto!</button>
                  </form>
                </div>
              </div>  
            </th>                
          </tr> ' ; }} ?>
      </tbody>
    </table>        
  
  </div>
</div> 

<div class="card" id="dep">
  <div class="card-body">
      <div class="dropdown" style="float: right;">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-filter"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#flight">Vuelo de hoy</a>
          <a class="dropdown-item" href="#issue">Problemas de Vuelo de Hoy</a>
          <a class="dropdown-item" href="#dep">Vuelos que Salieron Hoy</a>
          <a class="dropdown-item" href="#arr">Vuelos que Llegaron Hoy</a>
        </div>
      </div>        
    <p class="text-secondary">Vuelos que Salieron Hoy</p>
    <table class="table-sm table table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Llegada</th>
          <th scope="col">Salida</th>
          <th scope="col">Destino</th>
          <th scope="col">Origen</th>
          <th scope="col">Aerolínea</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          <tr>
          <?php
            $curr_date = (string)date('y-m-d');
            $curr_date = '20'.$curr_date;
            $sql = "SELECT * FROM vuelo WHERE DATE(fecha_salida)=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,'s',$curr_date);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
              if($row['status']=='dep') {
                echo '              
            <td scope="row">
              <a href="pass_list.php?flight_id='.$row['id_vuelo'].'">
              '.$row['id_vuelo'].' </a> </td>
            <td>'.$row['fecha_llegada'].'</td>
            <td>'.$row['fecha_salida'].'</td>
            <td>'.$row['destino'].'</td>
            <td>'.$row['salida'].'</td>
            <td>'.$row['aerolinea'].'</td> 
            <th class="options">
              <div class="dropdown">
                <a class="text-reset text-decoration-none" href="#" 
                  id="dropdownMenuButton" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                  
                  <i class="fa fa-ellipsis-v"></i> </td>
                </a>  
                <div class="dropdown-menu">
                  <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                    <input type="hidden" type="number" name="flight_id" 
                      value='.$row['id_vuelo'].'>
                    <button type="submit" name="arr_but" 
                      class="btn btn-primary btn-sm">¡Llegada!</button>
                  </form>
                </div>
              </div>  
            </th>                
          </tr> ' ; }} ?>
      </tbody>
    </table>        
  
  </div>
</div> 

<div class="card" id="arr">
  <div class="card-body">
      <div class="dropdown" style="float: right;">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-filter"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#flight">Vuelo de hoy</a>
          <a class="dropdown-item" href="#issue">Problemas de Vuelo de Hoy</a>
          <a class="dropdown-item" href="#dep">Vuelos que Salieron Hoy</a>
          <a class="dropdown-item" href="#arr">Vuelos que Llegaron Hoy</a>
        </div>
      </div>        
    <p class="text-secondary">Vuelos que Llegaron Hoy</p>
    <table class="table-sm table table-hover table-bordered">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Llegada</th>
          <th scope="col">Salida</th>
          <th scope="col">Destino</th>
          <th scope="col">Origen</th>
          <th scope="col">Aerolínea</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
          <tr>
          <?php
            $curr_date = (string)date('y-m-d');
            $curr_date = '20'.$curr_date;
            $sql = "SELECT * FROM vuelo WHERE DATE(fecha_salida)=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,'s',$curr_date);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
              if($row['status']=='arr') {
                echo '              
            <td scope="row">
              <a href="pass_list.php?flight_id='.$row['id_vuelo'].'">
              '.$row['id_vuelo'].' </a> </td>
            <td>'.$row['fecha_llegada'].'</td>
            <td>'.$row['fecha_salida'].'</td>
            <td>'.$row['destino'].'</td>
            <td>'.$row['salida'].'</td>
            <td>'.$row['aerolinea'].'</td> 
            <th class="options">
              <div class="dropdown">
                <a class="text-reset text-decoration-none" href="#" 
                  id="dropdownMenuButton" data-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                  
                  <i class="fa fa-ellipsis-v"></i> </td>
                </a>  
                <div class="dropdown-menu">
                  <form class="px-4 py-3"  action="../includes/admin/admin.inc.php" method="post">
                    <input type="hidden" type="number" name="flight_id" 
                      value='.$row['id_vuelo'].'>                   
                  </form>
                </div>
              </div>  
            </th>                
          </tr> ' ; }} ?>
      </tbody>
    </table>        
  
  </div>
</div>
          
    </div>
   <?php } ?> 

</main>

    <?php include_once 'footer.php'; ?>
