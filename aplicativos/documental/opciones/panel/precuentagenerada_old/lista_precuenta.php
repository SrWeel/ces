<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$ci_busqueda=$_POST["ci_busqueda"];
$select_tipo=$_POST["select_tipo"];

$sql1='';
if($ci_busqueda)
{
   
  $sql1=" clie_rucci='".$ci_busqueda."' and ";

}


$sql2='';
if($select_tipo)
{
  if($select_tipo==1)
   {
    $sql2=" (precu_activo='1' and precu_fechafinal='') and ";
   }
   else
   {
   $sql2=" (precu_activo='".$select_tipo."' or precu_fechafinal!='') and ";
   
   }
   
}

$sqlconcatena=$sql1.$sql2;
$sqlconcatena=substr($sqlconcatena,0,-4);
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Historia Clinica </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Paciente</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Codigo Precuenta </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Fecha Inicio </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Fecha Cierre </div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Estado</div></td>
      <td bgcolor="#DCE4ED" class="css_titulo"><div align="center">Movimiento</div></td>
    </tr>
	<?php
	if($sqlconcatena)
	{
	$lista_precuentas="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where ".$sqlconcatena." order by precu_fechainicio desc";
	}
	else
	{
	$lista_precuentas="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id order by precu_fechainicio desc";
	}
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["precu_activo"]==1)
   {
     $estado_prec='ABIERTO';
   
   }
   else
   {
     $estado_prec='CERRADO';
   
   }
	?>
    <tr>
      <td height="21" class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["clie_rucci"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["clie_nombre"]." ".$rs_lprecuentas->fields["clie_apellido"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo str_pad($rs_lprecuentas->fields["precu_id"], 10, "0", STR_PAD_LEFT); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_fechainicio"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["precu_fechafinal"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
      <td class="css_texto" onclick="ver_detalle('<?php echo $rs_lprecuentas->fields["precu_id"]; ?>')" style="cursor:pointer"><div align="center"><img src="images/listados.png" width="32" height="32" /></div></td>
    </tr>
	<?php
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>
</table>

<?php
}
?>