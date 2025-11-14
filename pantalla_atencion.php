<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$cuadro_valor=array();
$director='';
include("cfg/clases.php");
include("cfg/declaracion.php");
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
$pathjs='templates/beko/';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Atencion</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.txt_texto {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<link type="image/x-icon" rel="shortcut icon" href="<?php echo $pathjs; ?>favicon.ico" />
<link type="text/css" href="<?php echo $pathjs; ?>css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery-ui-1.10.4.custom.min.js"></script>

<link type="text/css" href="<?php echo $pathjs; ?>css/bootstrap.css" rel="stylesheet" />	
<link type="text/css" href="<?php echo $pathjs; ?>css/login.css" rel="stylesheet" />	
<link type="text/css" href="<?php echo $pathjs; ?>css/aplicacion.css" rel="stylesheet" />	
<link type="text/css" href="<?php echo $pathjs; ?>css/jquery.dataTables.min.css" rel="stylesheet" />	

<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.timer2.js"></script> 
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/additional-methods.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.printPage.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.formatCurrency.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.pwstrength.js"  charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.fixheadertable.js"></script>
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.PrintArea.js"></script> 
<script type="text/javascript" src="<?php echo $pathjs; ?>js/jquery.dataTables.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo $pathjs; ?>js/ui.mask.js"></script>
<script src="<?php echo $pathjs; ?>js/bootstrap.js"></script>  

<script type="text/javascript">
function productos_data(clie_id,facttmp_codetemp)
{

   $("#productos_local").load("pantalla/lista_cliente.php",{
clie_idp:clie_id,
facttmp_codetempp:facttmp_codetemp

  },function(result){  



  });  

  $("#productos_local").html("Espere un momento...");  

}

function lista_productos(clie_id,facttmp_codetemp)
{

 $("#div_productos").load("pantalla/productos.php",{
clie_idp:clie_id,
facttmp_codetempp:facttmp_codetemp

  },function(result){  



  });  

  $("#div_productos").html("Espere un momento..."); 

}


function lista_productoscliente(clie_id,facttmp_codetemp)
{

 $("#div_productoscliente").load("pantalla/cliente.php",{
clie_idp:clie_id,
facttmp_codetempp:facttmp_codetemp

  },function(result){  



  });  

  $("#div_productoscliente").html("Espere un momento..."); 

}



</script>


</head>
<body>






<table width="100%" height="900" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="11%" valign="top"><?php
$ib=0;
$lista_clientes="select * from app_facturatemporal inner join app_cliente on app_facturatemporal.clie_id=app_cliente.clie_id where 	facttmp_estado=1";
$rs_cliente = $DB_gogess->executec($lista_clientes,array());
 
 if($rs_cliente)
 {
    while (!$rs_cliente->EOF) {	
 
 if($rs_cliente->fields["clie_genero"]=='M')
 {
 $gsexo="images/chico.png";
 }
 else
 {
  $gsexo="images/chica.png";
 
 }
 
 $comilla="'";
 $cuadro_valor[$ib]='<table border="0" cellpadding="0" cellspacing="0" bgcolor="#D7E9EA">
  <tr>
    <td  style="cursor:pointer" onClick="productos_data('.$comilla.$rs_cliente->fields["clie_id"].$comilla.','.$comilla.$rs_cliente->fields["facttmp_codetemp"].$comilla.')"  ><img src="'.$gsexo.'" width="125" height="149"></td>
  </tr>
  <tr>
		<td ><div align="center"><span class="txt_texto">'.$rs_cliente->fields["clie_nombre"].'</span></div></td>
  </tr>
</table>';
$ib++;
 
     $rs_cliente->MoveNext();	
     }
 }
 
 
 desplegarencuadros($cuadro_valor,0,3,3,1);
?></td>
    <td width="1%" bgcolor="#A3CBCA">&nbsp;</td>
    <td width="88%" valign="top"><div id="productos_local"></div><div id="div_asignaquita" ></div></td>
  </tr>
</table>
</body>
</html>
