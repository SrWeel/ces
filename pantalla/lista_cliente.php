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

$lista_clientes="select * from app_facturatemporal inner join app_cliente on app_facturatemporal.clie_id=app_cliente.clie_id where 	facttmp_estado=1 and app_facturatemporal.clie_id=".$_POST["clie_idp"]." and facttmp_codetemp='".$_POST["facttmp_codetempp"]."'";
$rs_cliente = $DB_gogess->executec($lista_clientes,array());

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

?>
<script type="text/javascript">
//asigna y quita datos
function asignar_quitar(clie_id,facttmp_codetemp,produ_id,tipo)
{

 $("#div_asignaquita").load("pantalla/asignar_quitar.php",{
clie_idp:clie_id,
facttmp_codetempp:facttmp_codetemp,
produ_idp:produ_id,
tipop:tipo

  },function(result){  

lista_productos('<?php echo $_POST["clie_idp"]; ?>','<?php echo $_POST["facttmp_codetempp"]; ?>');
lista_productoscliente('<?php echo $_POST["clie_idp"]; ?>','<?php echo $_POST["facttmp_codetempp"]; ?>');

  });  

  $("#div_asignaquita").html("Espere un momento..."); 

}

function facturar_datos(clie_id,facttmp_codetemp)
{
if(confirm("Esta seguro que desea facturar...?")) 
{
 $("#div_facturar").load("pantalla/facturar.php",{
 clie_idp:clie_id,
 facttmp_codetempp:facttmp_codetemp
 },function(result){ 
 
  });  

  $("#div_facturar").html("Espere un momento..."); 
}
}
</script>
<style type="text/css">
<!--

.txt_titulod {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<br><br>

<table width="900" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr bgcolor="#EEF7F7">
    <td colspan="3"><div align="center" class="txt_titulod"><?php echo $rs_cliente->fields["clie_nombre"]; ?></div></td>
  </tr>
  <tr bgcolor="#CFE2E0">
    <td width="335"><div align="center" class="txt_titulod"><strong>LISTA DE PRODUCTOS</strong></div></td>
    <td width="29"><div align="center"></div></td>
    <td width="314"><div align="center" class="txt_titulod">CLIENTE</div></td>
  </tr>
  <tr bgcolor="#F0F7FB">
    <td valign="top" bgcolor="#E6F1F9">
<div id="div_productos"></div>	</td>
    <td><table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td ><img src="images/asignar.png" width="167" height="129"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td  ><img src="images/quitar.png" width="167" height="129"></td>
      </tr>
    </table></td>
    <td valign="top"><div id="div_productoscliente" ></div></td>
  </tr>
  <tr bgcolor="#D1E0DF">
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top">	<div id="div_facturar" >
	<?php
	$busca_facturado="select * from app_facturatemporal where facttmp_codetemp='".$_POST["facttmp_codetempp"]."'";
    $rs_facturado = $DB_gogess->executec($busca_facturado,array());
	if($rs_facturado->fields["facttmp_estado"]==1)
	{
	?>
	<table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td onClick="facturar_datos('<?php echo $_POST["clie_idp"]; ?>','<?php echo $_POST["facttmp_codetempp"]; ?>')" style="cursor:pointer"  ><img src="images/factura.png" width="176" height="160"></td>
        </tr>
    </table>
	<?php
	}
	else
	 {
	
	 echo '<table width="300" height="40" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#ADCDAB"><center><b>Ya fue enviado a caja para facturaci&oacute;n...</b></center></td>
      </tr>
    </table>';
	 }
	
	?>
    	
    </div>
	
	</td>
  </tr>
</table>
<script type="text/javascript">
lista_productos('<?php echo $_POST["clie_idp"]; ?>','<?php echo $_POST["facttmp_codetempp"]; ?>');
lista_productoscliente('<?php echo $_POST["clie_idp"]; ?>','<?php echo $_POST["facttmp_codetempp"]; ?>');
</script>