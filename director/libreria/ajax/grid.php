<?php


//Llamando objetos
$director="../../";

include("../../cfgclases/clases.php");


//Conexion a la base de datos

$listagrid="select * from gogess_subgrid where subgri_activo=1 and subgri_id=".$_POST["psubgri_id"];
	
	$resultgrid = $DB_gogess->Execute($listagrid);	
	if($resultgrid)
	{	
	   while (!$resultgrid->EOF) 
	   {
	     $table=$resultgrid->fields["subgri_nameenlace"];
		 $campoenc=$resultgrid->fields["subgri_campoenlace"];
		 $tipoenlace=$resultgrid->fields["subgri_tipoenlace"];
		 
		 $subgri_campoidts=$resultgrid->fields["subgri_campoidts"];
		 
		 
		 
		 //echo $resultgrid->fields["subgri_tipoenlace"]."<br>";
		 
		  $resultgrid->MoveNext();
	   }
	 }  
	   
//TABLA PARA GENERAR GRID

$objformulario->pathgrid="../../";
$objformulario->sendvar[$campoenc."x"]=$_POST["plistab"];
$objformulario->cambion=$campoenc;


?>
<div style="border: 1px solid #999999;" >
<table border="0" cellspacing="0">
  <tr>
    <td>
	
	<table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><?php
$objformulario->sendvar["fechax"]=date("Y-m-d");
$objformulario->sendvar["horax"]=date("h:i:s");
$objformulario->generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,1,$DB_gogess);
?></td>
        <td valign="top"><?php

$objformulario->generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,2,$DB_gogess);
?></td>
      </tr>
    </table>


<input type="button" name="Submit" value="Agregar" onclick="agregar_dato_<?php  echo $_POST["psubgri_id"] ?>(1,'')" style="font-family:Geneva, Arial, Helvetica, sans-serif; font-size:11px; color:#003366"  />
</td>
  </tr>
</table>
</div>

