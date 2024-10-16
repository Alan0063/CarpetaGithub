<?php include_once 'helpers/helper.php'; ?>
	<?php subview('header.php'); 
    require 'helpers/init_conn_db.php';                      
	?> 	

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnotrinAir</title>
	<link rel="stylesheet" href="assets/css/index.css">

</head>
<body>

<div class="container">
    <div class="welcome-text">¡Bienvenidos a UnachAir!</div>
    <div class="content-box">
        <h2>Nuestros Destinos</h2>
        <p>Ofrecemos los mejores servicios de transporte aéreo en UnachAir.</p>

        <div class="image-row">
            <div class="image-container">
                <img src="https://www.lugaresturisticosenmexico.com/wp-content/uploads/elementor/thumbs/Tampico-Ciudad-Madero-Tamaulipas-pqf59ms6u5nwhxtvylb651bhvdpnorarlnxml0oecs.jpg" 
                alt="Tamaulipas">
                <div class="image-text">
                    <div class="city">Chiapas -</div>
                    <div class="destination">Tamaulipas</div>
                    <div class="price">
                        <div class="amount">$1,290</div>
                        <div class="currency">MXN / <span>✈️</span></div>
                    </div>
                    <div class="separator"></div>
                    <div class="reserve">
                        <span>Reservar</span>
                        <span>→</span>
                    </div>
                </div>
            </div>
            
            <div class="image-container">
                <img src="https://blog.urbansa.co/hubfs/Centro%20de%20la%20ciudad%20-%20El%20centro%20de%20Bogot%C3%A1-Bogot%C3%A1%20de%20noche.jpg" 
                alt="Bogota">
                <div class="image-text">
                    <div class="city">Chiapas -</div>
                    <div class="destination">Bogotá</div>
                    <div class="price">
                        <div class="amount">$2,180</div>
                        <div class="currency">MXN / <span>✈️</span></div>
                    </div>
                    <div class="separator"></div>
                    <div class="reserve">
                        <span>Reservar</span>
                        <span>→</span>
                    </div>
                </div>
            </div>


            
            <div class="image-container">
                <img src="https://www.elheraldodejuarez.com.mx/incoming/owbbls-plaza-centro-de-chihuahua/ALTERNATES/FREE_768/Plaza%20centro%20de%20Chihuahua" 
                alt="Chiuaua">
                <div class="image-text">
                    <div class="city">Chiapas -</div>
                    <div class="destination">Chiuaua</div>
                    <div class="price">
                        <div class="amount">$949</div>
                        <div class="currency">MXN / <span>✈️</span></div>
                    </div>
                    <div class="separator"></div>
                    <div class="reserve">
                        <span>Reservar</span>
                        <span>→</span>
                    </div>
                </div>
            </div>
            
            <div class="image-container">
                <img src="https://www.entornoturistico.com/wp-content/uploads/2021/09/Metropolitan-center-en-San-Pedro-Garza-Garci%CC%81a-Monterrey.jpg" 
                alt="Monterrey">
                <div class="image-text">
                    <div class="city">Chiapas -</div>
                    <div class="destination">Monterrey N.L</div>
                    <div class="price">
                        <div class="amount">$3,258</div>
                        <div class="currency">MXN / <span>✈️</span></div>
                    </div>
                    <div class="separator"></div>
                    <div class="reserve">
                        <span>Reservar</span>
                        <span >→</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>










<div class="conatiner-fluid p-4" style="background-color: whitesmoke;margin-top:150px;">
   <!-- <h2 class="text-center mb-3 mt-3 display-4"
	   style="font-style: normal;font-size:80px;">Main Attractions In India</h2>   
	<div class="row p-5 pb-0"> -->

<!-- <div class="conatiner-fluid p-4" style="background-color: whitesmoke;margin-top:150px;"> -->
 

	</div>
	<footer class="mt-5">
	<em><h5 class="text-dark text-center p-0 brand mt-2">
				<img src="assets/images/plane-avion.png" 
					height="40px" width="40px" alt="">				
			</h5></em>
	<div class=" text-center">&copy; <?php echo date('Y')?> UnachAir<br><br></div>
	<!-- <p>----------</p> -->
	
	</footer>	

    <?php subview('footer.php'); ?> 

		<script src="assets/js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default',         
					width: 'auto', 
					fit: true   
				});
			});		
		</script>
		<script>
		$('.value-plus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
			divUpd.text(newVal);
			$('.input_val').val(newVal);
		});

		$('.value-minus').on('click', function(){
			var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
			if(newVal>=1) {
				divUpd.text(newVal);
				$('.input_val').val(newVal);
			} 
		});
		</script>
								<!--//quantity-->
						<!--load more-->
		<script>
	$(document).ready(function () {
		size_li = $("#myList li").size();
		x=1;
		$('#myList li:lt('+x+')').show();
		$('#loadMore').click(function () {
			x= (x+1 <= size_li) ? x+1 : size_li;
			$('#myList li:lt('+x+')').show();
		});
		$('#showLess').click(function () {
			x=(x-1<0) ? 1 : x-1;
			$('#myList li').not(':lt('+x+')').hide();
		});
	});
</script>
