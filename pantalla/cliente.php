<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

function desplegarencuadros($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	echo '<center><table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'">';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   echo '<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   echo '<td>'.@$arreglolista[$k].'</td>';
		   $k++;
		 
		 }
		 
	   echo '</tr>';	  
	}
	echo '</table></center>';
    }
}
 $cuadro_valor=array();
	$ib=0;
	$lista_productos="select * from app_detalletemporal inner join app_producto on app_detalletemporal.produ_id=app_producto.produ_id where produ_activo=1 and facttmp_codetemp='".$_POST["facttmp_codetempp"]."'";
	$rs_producto = $DB_gogess->executec($lista_productos,array());
  if($rs_producto)
   {
    while (!$rs_producto->EOF) {	
	
 $comilla="'";
 
  if($rs_producto->fields["produ_foto"])
 {
 $nfoto=$rs_producto->fields["produ_foto"];
 }
 else
 {
 $nfoto="sinimagen.png";
 
 }
 

 
 $cuadro_valor[$ib]='<table border="0" cellpadding="0" cellspacing="0" bgcolor="#D7E9EA">
  <tr>
    <td  style="cursor:pointer" onClick="asignar_quitar('.$comilla.$_POST["clie_idp"].$comilla.','.$comilla.$_POST["facttmp_codetempp"].$comilla.','.$rs_producto->fields["dettem_id"].',2)"  ><img src="archivo/'.$nfoto.'" width="100" height="100"></td>
  </tr>
  <tr>
		<td height="70" ><div align="center"><span class="txt_texto">'.$rs_producto->fields["produ_nombre"].'</span></div></td>
  </tr>
</table>';
$ib++;
   
   $rs_producto->MoveNext();	
     }
 }
 
  desplegarencuadros($cuadro_valor,0,3,3,4);
	?>