<?php

	  

	        $enlace_general=$rs_datosmenu->fields["mnupan_campoenlace"]."x";

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

		    $objformulario->sendvar[$enlace_general]=@$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=@$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usr_tpingx"]=0;
            $objformulario->sendvar["centro_idx"]=$_SESSION['ces1313777_centro_id'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			

			 



?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td><?php
	   
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
$objformulario->generar_formulario_bootstrap(@$submit,$table,2,$DB_gogess);
	   
	   ?></td>
       <td>
	   
	   <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center" class="style1">CAMPOS DISPONIBLES PACIENTE </div></td>
        </tr>
        <tr>
          <td>-clie_rucci-<br>
            -clie_nombre-<br>
            -clie_apellido-<br>
       </td>
        </tr>
        <tr>
          <td><span class="style1">CAMPOS DISPONIBLES MEDICO </span></td>
        </tr>
        <tr>
          <td>-medico-
		  <br />
		  -usua_ciruc-
		  <br />
		 -usua_nombre- <br />
		 -usua_apellido- <br />
		 -usua_siglastitulo- <br />
		 
		  </td>
        </tr>
        <tr>
          <td><span class="style1">CAMPOS DISPONIBLES EXTRAS </span></td>
        </tr>
        <tr>
          <td><p>-fecha-
		  <br>
		  -fechasolo-<br>
		  -fechaciudad-<br>
		  -centro-<br>
		  -desde-<br>
		  -hasta-<br />
		  -dias-<br />
		  -sello-<br />
		  -diagnostico-<br />
		  -ndesde-<br />
		  -nhasta-<br />
		  -hinicio-<br />
		  -hfin-<br />
		  -observaciones-<br />
		  -fechaatencion-<br />
		  -nfechaatencion-<br />
		  -telefonocentro-<br />
		  -direccioncentro-<br />
		  -aptooapto-<br />
		  -enfermedad-<br />
		  </p>
          </td>
        </tr>
</table>


	   </td>
     </tr>
   </table>



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


<script type="text/javascript">
<!--
$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

$('#certif_contenido').ckeditor();
//  End -->
</script>