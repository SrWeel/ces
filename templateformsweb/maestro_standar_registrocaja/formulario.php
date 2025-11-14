<?php
if ($_SESSION['ces1313777_sessid_emp_id'])
{
?>

<style type="text/css">

<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }

.espacio_css {

	font-size: 7px;

	font-family: Arial, Helvetica, sans-serif;

}

-->

</style>



<table width="450" border="0" align="center" cellpadding="0" cellspacing="2">

  

  <tr>

    <td width="94%"><span class="espacio_css">&nbsp;</span></td>

    <td width="6%" rowspan="2">&nbsp;</td>

  </tr>

  <tr>

    <td valign="top"><div align="center">

      <?php

	 

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

			$objformulario->sendvar["emp_idx"]=$_SESSION['ces1313777_sessid_emp_id'];	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["usua_idx"]=$_SESSION['ces1313777_sessid_inicio'];

			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

			$objformulario->sendvar["usua_idaltx"]=@$_SESSION['usua_idalt'];

			 $_SESSION['usua_idalt']='';
			 
			 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess);  

?>

    </div></td>

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
<?php
}
?>