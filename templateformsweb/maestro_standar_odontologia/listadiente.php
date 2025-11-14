<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$clie_id=$_POST["pVar1"];
$odonto_enlace=$_POST["pVar2"];
$odopie_id=$_POST["pVar3"];

$bloqueo=$_POST["pVar7"];

$lista_doc="select * from dns_odontograma inner join dns_odontosimbolo on dns_odontograma.odonto_valor=dns_odontosimbolo.odosimb_id where clie_id=".$clie_id." and odopie_id=".$odopie_id;
$rs_doc = $DB_gogess->executec($lista_doc,array());
?>
<style type="text/css">
<!--
.css_listab {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<center>
<div id="borra_lisd"></div>
<table width="400" border="1">
<?php
if($rs_doc)
        {
	       while (!$rs_doc->EOF) {
		   
		   $obtiene_id="select * from dns_odopiezadental inner join dns_tipofilaodonto on dns_odopiezadental.tipofodo_id=dns_tipofilaodonto.tipofodo_id where odopie_id=".$rs_doc->fields["odopie_id"];
		   $rs_obt = $DB_gogess->executec($obtiene_id,array());
		   
		   
$clie_id=$rs_doc->fields["clie_id"];
$campoodo_id=$rs_doc->fields["campoodo_id"];
$odopie_id=$rs_doc->fields["odopie_id"];
?>
  <tr>
    <td><span class="css_listab"><?php echo $rs_obt->fields["tipofodo_nombre"]; ?></span></td>
    <td><span class="css_listab"><?php echo $rs_obt->fields["tipofodo_codigo"]; ?></span></td>
    <td><span class="css_listab"><img src="archivo/<?php echo $rs_doc->fields["odosimb_grafico"]; ?>" width="20" height="20" /></span></td>
    <td><span class="css_listab"><?php echo $rs_doc->fields["odosimb_nombre"]; ?></span></td>
    <td><span class="css_listab"><?php echo $rs_doc->fields["odonto_fecharegistro"]; ?></span></td>
	<?php
	if(!($bloqueo))
	{
	?>
    <td onClick="borrar_registro_diente('dns_odontograma','odonto_id','<?php echo $rs_doc->fields["odonto_id"]; ?>')" style="cursor:pointer" ><span class="css_listab"><img src="images/borrar.png" width="20" height="20" /></span></td>
	<?php
	}
	else
	{
	?>
	<td  ><span class="css_listab"></span></td>
	
	<?php
	}
	?>
  </tr>
<?php
            $rs_doc->MoveNext();	   
			  }
		}
?>  
</table>
</center>

<SCRIPT LANGUAGE=javascript>
<!--
function borrar_registro_diente(tabla,campo,valor)
{
 if (confirm("Esta seguro que desea borrar este registro ?"))
 { 
	 $("#borra_lisd").load("templateformsweb/maestro_standar_odontologia/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor

  },function(result){  

      funcion_cerrar_popdiente('divDialog_dientel');
	  despliega_diente('<?php echo $clie_id; ?>','<?php echo $campoodo_id; ?>','<?php echo $odopie_id; ?>');
  });  

  $("#borra_lisd").html("Espere un momento...");  


  }


}

function funcion_cerrar_popdiente(valor_pop)
{

$('#'+valor_pop).dialog( "close" );

}
//-->
</SCRIPT>

