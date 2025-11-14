 <script language="javascript">
<!--


//referencia





//Grid capacitacion

function grid_capacitacion(id_grid,opcionp)
{


if(opcionp==1)
{



if($('#tipoc_val').val()=='')

  {

   alert("Seleccione una categor\u00eda...");

   return false;

  }

  

  

 if($('#descripcion_val').val()=='')

  {

   alert("Ingrese la descripci\u00f3n...");

   return false;

  }

   



}



if(opcionp==2)

{

	if (!(confirm('Desea borrar este registro?'))) { 

	  return false;

	}



}


$("#lista_capacitacion").load("../templateformsweb/maestro_standar_cliente/grid_capacitacion.php",{



enlace:$('#clie_token').val(),

idgrid:id_grid,

opcion:opcionp,

tipoc_val:$('#tipoc_val').val(),

descripcion_val:$('#descripcion_val').val()

 },function(result){       

			$('#tipoc_val').val("");

			$('#descripcion_val').val("");

			//$('.messagesgraficoc_val').html(""); 



  });  

$("#lista_capacitacion").html("Espere un momento...");



}
</script>
 
 <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=1;	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			
			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_usua_id'];
			 $objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
	 $valoralet=mt_rand(1,500);

			 $aletorioid='01'.@$_SESSION['ces1313777_usua_id'].date("Ymdhis").$valoralet;

			 $objformulario->sendvar["clie_tokenx"]=$aletorioid;				 


$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
<div id="vista_panelx" >   
<div class="panel panel-default" >

  <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033">QU&Eacute; TE GUSTA?</h3>

  </div>

  <div class="panel-body">
  
  <div class="form-group">
     <div class="col-md-12">
		
					<select class="form-control" name="tipoc_val" id="tipoc_val"  >
		
						<option value="" >--Seleccion Categor&iacute;a--</option>
		
						<?php
		
						$objformulario->fill_cmb('app_tipogustos','tipog_id,tipog_nombre','','order by tipog_nombre asc',$DB_gogess);
		
						?>
		
					</select>
		
		</div>
   </div>
   
  <div class="form-group">

	<div class="col-md-12">
	
			   <textarea placeholder="Descripci&oacute;n(150 caracteres):" name="descripcion_val"  id="descripcion_val" class="form-control"  rows="3" wrap="VIRTUAL"  cols="25" ></textarea>
	
	</div>

  </div>
  
<div class="form-group">	

<div class="col-md-12">

           <button type="button" class="mb-sm btn btn-primary"  onClick="grid_capacitacion(0,1)"  style="background-color:#000066" >AGREGAR</button>

</div>

</div>	


<div id="lista_capacitacion"></div>
 
  
  
  </div>
  
</div>  
</div>

<?php       
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>
<div id=div_<?php echo $table ?> > </div>


<script>

         $(function() {

            $( "#clie_nombreconyugue" ).autocomplete({

               source: "../templateformsweb/maestro_standar_cliente/search.php",

               minLength: 5,

			   select: function( event, ui ) {

				 $('#conyu_id').val(ui.item.clie_id);

				  //$('#doccab_direccion_cliente').val(ui.item.direccion);

				  //$('#doccab_telefono_cliente').val(ui.item.telefono);

				  //$('#doccab_email_cliente').val(ui.item.email);

					

			   }

            });

         });

      </script>
	  
	  
<script>

         $(function() {

            $( "#clie_mama" ).autocomplete({

               source: "../templateformsweb/maestro_standar_cliente/search.php",

               minLength: 5,

			   select: function( event, ui ) {

				 $('#clie_idmama').val(ui.item.clie_id);

				  //$('#doccab_direccion_cliente').val(ui.item.direccion);

				  //$('#doccab_telefono_cliente').val(ui.item.telefono);

				  //$('#doccab_email_cliente').val(ui.item.email);

					

			   }

            });

         });

      </script>
	  
	  	  
<script>

         $(function() {

            $( "#clie_papa" ).autocomplete({

               source: "../templateformsweb/maestro_standar_cliente/search.php",

               minLength: 5,

			   select: function( event, ui ) {

				 $('#clie_idpapa').val(ui.item.clie_id);

				  //$('#doccab_direccion_cliente').val(ui.item.direccion);

				  //$('#doccab_telefono_cliente').val(ui.item.telefono);

				  //$('#doccab_email_cliente').val(ui.item.email);

					

			   }

            });

         });

      </script>		  
	  

<script>

         $(function() {

            $( "#clie_representante" ).autocomplete({

               source: "../templateformsweb/maestro_standar_cliente/search.php",

               minLength: 5,

			   select: function( event, ui ) {

				 $('#clie_idrep').val(ui.item.clie_id);

				  //$('#doccab_direccion_cliente').val(ui.item.direccion);

				  //$('#doccab_telefono_cliente').val(ui.item.telefono);

				  //$('#doccab_email_cliente').val(ui.item.email);

					

			   }

            });

         });

      </script>		

<script language="javascript">

<!--

grid_capacitacion(0,0);


//-->

</script>