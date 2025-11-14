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

$categ_id=$_POST["categ_id"];

$moviin_descext=$_POST["moviin_descext"];
$saca_sug=explode(" ",$moviin_descext);

?>
<center><b>SUGERENCIAS</b></center>
<table width="500" border="2" align="center" cellpadding="1" cellspacing="0">
<?php
 $lista_campor="select * from dns_cuadrobasicomedicamentos where cuadrobm_historial=0  and (cuadrobm_principioactivo like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_nombrecomercial like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_nombredispositivo like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_primerniveldesagregcion like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_presentacion like '%".$_POST["bu_txtproducto"]."%' or cuadrobm_concentracion like '%".$_POST["bu_txtproducto"]."%')  order by  cuadrobm_principioactivo asc";
 
$lista_campor="SELECT * FROM dns_cuadrobasicomedicamentos WHERE MATCH (cuadrobm_principioactivo,cuadrobm_nombrecomercial) AGAINST ('".$moviin_descext."' IN NATURAL LANGUAGE MODE);";
 
 $rs_tabla = $DB_gogess->executec($lista_campor,array());
 if($rs_tabla)
 {
	  while (!$rs_tabla->EOF) {	  
	  
	                    $ncampo_val='cuadrobm_nombrecomercial';
						$nom1='';					
						if($rs_tabla->fields["cuadrobm_nombrecomercial"])
						{
						   $nom1=$rs_tabla->fields["cuadrobm_nombrecomercial"].' ';
						}
						
						$nom2='';					
						if($rs_tabla->fields["cuadrobm_principioactivo"])
						{
						   $nom2=$rs_tabla->fields["cuadrobm_principioactivo"].' ';
						}
						
						$nom3='';					
						if($rs_tabla->fields["cuadrobm_presentacion"])
						{
						   $nom3=$rs_tabla->fields["cuadrobm_presentacion"].' ';
						}
						 
						$nom4='';					
						if($rs_tabla->fields["cuadrobm_concentracion"])
						{
						   $nom4=$rs_tabla->fields["cuadrobm_concentracion"].' ';
						}
						
						
	                    
						$concatena_nom=$nom1.$nom2.$nom3.$nom4;
						
						//obtiene precio
						
						$busca_precio="select * from dns_preciostiempo where cuadrobm_id='".$rs_tabla->fields["cuadrobm_id"]."'";
						$rs_buprecio = $DB_gogess->executec($busca_precio,array());
						
						$precio_comprav=$rs_buprecio->fields["precio_compra"];
						
						//obtiene precio
						$cuadrobm_codigoatc='';
						$cuadrobm_codigoatc=$rs_tabla->fields["cuadrobm_codigoatc"];
						
						//cuadrobm_id,cuadrobm_principioactivo,cuadrobm_nombredispositivo,cuadrobm_primerniveldesagregcion,cuadrobm_presentacion,cuadrobm_concentracion
?>
  <tr>
    <td width="82" bgcolor="#FFFFFF" ><input type="button" name="Button" value="Seleccionar" onClick="selecciona_p('<?php echo $rs_tabla->fields["cuadrobm_id"]; ?>','<?php echo $precio_comprav; ?>','<?php echo $cuadrobm_codigoatc; ?>')"></td>
    <td width="218" bgcolor="#FFFFFF" ><?php echo $rs_tabla->fields["cuadrobm_codigoatc"].' - '.utf8_encode($rs_tabla->fields[$ncampo_val]).' '.utf8_encode($concatena_nom); ?></td>
	<td> $ <?php echo $precio_comprav; ?></td>
  </tr>
<?php	  
	  $rs_tabla->MoveNext();
	  }
  }
?>
</table>