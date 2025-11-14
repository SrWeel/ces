

<style type="text/css">

<!--

.titulo_suscripcion {font-size: 13px; font-family: Arial, Verdana; font-weight: bold; }

.espacio_css {

	font-size: 7px;

	font-family: Arial, Helvetica, sans-serif;

}

-->

</style>





<table border="0" align="center" cellpadding="0" cellspacing="2">

  <tr>

    <td width="48%">&nbsp;</td>

  </tr>

  <tr>

    <td><span class="espacio_css">&nbsp;</span></td>

  </tr>

  <tr>

    <td valign="top"><?php

		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	

            $objformulario->sendvar["horax"]=date("H:i:s");

			$objformulario->sendvar["sisu_idx"]=@$_SESSION['iduser'];

			 

$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess);  

?>      <span class="espacio_css">&nbsp;</span></td>

  </tr>

</table>

<?php       

if(@$csearch)

{

 @$valoropcion='actualizar';

}

else

{

 @$valoropcion='guardar';

}



echo "<input name='csearch' type='hidden' value=''>

<input name='idab' type='hidden' value=''>

<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >

<input name='table' type='hidden' value='".$table."'>";



?>

<div id=div_<?php echo $table ?> > </div>





