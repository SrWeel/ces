<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
if($_SESSION['ces1313777_sessid_inicio'])
{
?>
<div class=TableScroll_mat>

<table width="500" border="0" cellpadding="0" cellspacing="2">
  <tr bgcolor="#DDEAEC">
    <td width="58"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" align="center" >QUITAR</td>
    <td width="436"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" align="center" >MATERIA</td>
  </tr>
 <?php
 $sql_listapr = <<<QUERY
		SELECT 	
		* FROM media_capacitamateria inner join media_materia on media_capacitamateria.mate_id=media_materia.mate_id
		WHERE capapr_code='{$_POST['codigo']}'
QUERY;

 $rs_listapr = $DB_gogess->executec($sql_listapr,array());
	if($rs_listapr)
	{
	while (!$rs_listapr->EOF) {
 ?> 
  <tr bgcolor="#ECF3F4">
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; cursor:pointer" onClick="borrar_mat('<?php echo $rs_listapr->fields["capamat_id"]; ?>')"  ><img src="images/eliminar.png" width="16" height="16"></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"  ><?php echo $rs_listapr->fields["mate_nombre"];?></td>
  </tr>
  <?php
    $rs_listapr->MoveNext();	 
  }
  }
  ?>
</table>
</div>
<br><br>
<?php
}
?>