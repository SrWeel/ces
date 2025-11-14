<?php

$nombre_campo=$_POST["ncampop"];

echo '<br><div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000" >!!!Cada ves que actualice la lista no olvide guardar el resgistro </div>
<div class="row">';

			 $separa_img=explode(",",$_POST["nuevop"]);

			 $comillas="'";

			 for($ic=0; $ic<count($separa_img);$ic++)

			 {

				 if(trim($separa_img[$ic]))

				 {

					 echo '<div class="col-md-3">

					    <span class="glyphicon glyphicon-remove-circle" onClick="borrar_img('.$comillas.$nombre_campo.$comillas.','.$comillas.preg_replace("/[\n|\r|\n\r]/",'',$separa_img[$ic]).$comillas.')" style="cursor:pointer" ></span>

						<a href="archivo/'.preg_replace("/[\n|\r|\n\r]/",'',$separa_img[$ic]).'" class="thumbnail" target="_blank" >

						    

							<img src="archivo/verdoc.png" >

						</a>

						  </div>';

				  }

			 }	  

echo '</div>'; 

?>