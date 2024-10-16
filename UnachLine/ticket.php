<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/ticket.css">
<style>

</style>
<main>
  <?php if(isset($_SESSION['userId'])) {   
    require 'helpers/init_conn_db.php';   
    
    if(isset($_POST['cancel_but'])) {
        $ticket_id = $_POST['ticket_id'];
        $stmt = mysqli_stmt_init($conn);
        $sql = 'SELECT * FROM Ticket WHERE id_ticket=?';
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {
            header('Location: ticket.php?error=sqlerror');
            exit();            
        } else {
            mysqli_stmt_bind_param($stmt,'i',$ticket_id);            
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {   
              $sql_pas = 'DELETE FROM Pasajero WHERE id_pasajero=? 
                ';
              $stmt_pas = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt_pas,$sql_pas)) {
                  header('Location: ticket.php?error=sqlerror');
                  exit();            
              } else {
                  mysqli_stmt_bind_param($stmt_pas,'i',$row['id_pasajero']);            
                  mysqli_stmt_execute($stmt_pas);
                  $sql_t = 'DELETE FROM Ticket WHERE id_ticket=?';
                  $stmt_t = mysqli_stmt_init($conn);
                  if(!mysqli_stmt_prepare($stmt_t,$sql_t)) {
                      header('Location: ticket.php?error=sqlerror');
                      exit();            
                  } else {
                      mysqli_stmt_bind_param($stmt_t,'i',$row['id_ticket']);            
                      mysqli_stmt_execute($stmt_t);
                  }                  
              }              
            }
        }        
    }
    
    ?>     
    <div class="container mb-5"> 
    <h1 class="text-center mt-4 mb-4">Mis Tickets</h1>

      <?php 
      $stmt = mysqli_stmt_init($conn);
      $sql = 'SELECT * FROM Ticket WHERE id_usuario=?';
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)) {
          header('Location: ticket.php?error=sqlerror');
          exit();            
      } else {
          mysqli_stmt_bind_param($stmt,'i',$_SESSION['userId']);            
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          while ($row = mysqli_fetch_assoc($result)) {   
            $sql_p = 'SELECT * FROM Pasajero WHERE id_pasajero=?';
            $stmt_p = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_p,$sql_p)) {
                header('Location: ticket.php?error=sqlerror');
                exit();            
            } else {
                mysqli_stmt_bind_param($stmt_p,'i',$row['id_pasajero']);            
                mysqli_stmt_execute($stmt_p);
                $result_p = mysqli_stmt_get_result($stmt_p);
                if($row_p = mysqli_fetch_assoc($result_p)) {
                  $sql_f = 'SELECT * FROM vuelo WHERE id_vuelo=?';
                  $stmt_f = mysqli_stmt_init($conn);
                  if(!mysqli_stmt_prepare($stmt_f,$sql_f)) {
                      header('Location: ticket.php?error=sqlerror');
                      exit();            
                  } else {
                      mysqli_stmt_bind_param($stmt_f,'i',$row['id_vuelo']);            
                      mysqli_stmt_execute($stmt_f);
                      $result_f = mysqli_stmt_get_result($stmt_f);
                      if($row_f = mysqli_fetch_assoc($result_f)) {
                        $date_time_dep = $row_f['fecha_salida'];
                        $date_dep = substr($date_time_dep,0,10);
                        $time_dep = substr($date_time_dep,10,6) ;    
                        $date_time_arr = $row_f['fecha_llegada'];
                        $date_arr = substr($date_time_arr,0,10);
                        $time_arr = substr($date_time_arr,10,6) ; 
                        if($row['class'] === 'E') {
                            $class_txt = 'Economica';
                        } else if($row['class'] === 'B') {
                            $class_txt = 'VIP';
                        }
                        echo '
                        <div class="row mb-5">                                                         
                        <div class="col-8 out">
                            <div class="row ">                                                     
                                <div class="col">
                                    <h2 class="text-secondary mb-0 brand">
                                        UnachAir</h2> 
                                </div>
                                <div class="col">
                                    <h2 class="mb-0">'.$class_txt.' Clase</h2>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">  
                                <div class="col-4">
                                    <p class="head">Aerolinea</p>
                                    <p class="txt">'.$row_f['aerolinea'].'</p>
                                </div>            
                                <div class="col-4">
                                    <p class="head">Salida</p>
                                    <p class="txt">'.$row_f['salida'].'</p>
                                </div>
                                <div class="col-4">
                                    <p class="head">Destino</p>
                                    <p class="txt">'.$row_f['destino'].'</p>                
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-8">
                                    <p class="head">Pasajeros</p>
                                    <p class=" h5 text-uppercase">
                                    '.$row_p['f_name'].' '.$row_p['m_name'].' '.$row_p['l_name'].'
                                    </p>                              
                                </div>
                                <div class="col-4">
                                    <p class="head">Hora de Abordar</p>
                                    <p class="txt">12:45</p>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <p class="head">Salida</p>
                                    <p class="txt mb-1">'.$date_dep.'</p>
                                    <p class="h1 font-weight-bold mb-3">'.$time_dep.'</p>  
                                </div>            
                                <div class="col-3">
                                    <p class="head">Llegada</p>
                                    <p class="txt mb-1">'.$date_arr.'</p>
                                    <p class="h1 font-weight-bold mb-3">'.$time_arr.'</p>  
                                </div>
                                <div class="col-3">
                                    <p class="head">Puerta</p>
                                    <p class="txt">A22</p>
                                </div>            
                                <div class="col-3">
                                    <p class="head">Asiento</p>
                                    <p class="txt">'.$row['seat_no'].'</p>
                                </div>                
                            </div>                    
                        </div>
                        <div class="col-3 pl-0" style="background-color:#376b8d !important;
                            padding:20px; border-top-right-radius: 25px; border-bottom-right-radius: 25px;">
                            <div class="row">  
                                <div class="col">                                    
                                <h2 class="text-light text-center brand">
                                    UnachAir</h2> 
                                </div>                                      
                            </div>                             
                            <div class="row justify-content-center">
                                <div class="col-12">                                    
                                    <img src="assets/images/plane-avion.png" class="mx-auto d-block"
                                    height="200px" width="200px" alt="">
                                </div>                                
                            </div>                         
                        </div>   
                        
                        <div class="col-1">
                            <div class="dropdown">
                                <a class="text-reset text-decoration-none" href="#" 
                                    id="dropdownMenuButton" data-toggle="dropdown" 
                                    aria-haspopup="true" aria-expanded="false">
                                    
                                    <i class="fa fa-ellipsis-v"></i> </td>
                                </a>  
                                <div class="dropdown-menu">
                                    <form class="px-4 py-3"  action="ticket.php" 
                                        method="post">
                                        <input type="hidden" name="ticket_id" 
                                            value='.$row['id_ticket'].'>
                                        <button class="btn btn-danger btn-sm"
                                            name="cancel_but">
                                            <i class="fa fa-trash"></i> &nbsp; Cancelar Ticket</button>
                                    </form>
                                    <form class="px-4 py-3" action="e_ticket.php" target="_blank"
                                        method="post">
                                        <input type="hidden" name="ticket_id" 
                                            value='.$row['id_ticket'].'>
                                        <button class="btn w-100 mb-3 btn-primary btn-sm"
                                            name="print_but">
                                            <i class="fa fa-print"></i> &nbsp; Imprimir Ticket</button>
                                    </form>                                    
                                </div>
                            </div>              
                        </div>                          
                        </div>                                               
                      ' ;
                      }
                  }                  
                }
            }                                    
          }
      }   
      
       ?> 

    </div>
  </main>
  <?php } ?>
  <?php subview('footer.php'); ?> 