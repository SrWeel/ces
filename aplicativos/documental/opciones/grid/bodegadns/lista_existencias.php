<?php
$tiempossss=44600000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{

//echo $_POST["pVar1"]."<br>";


$busca_medicamento="select * from dns_cuadrobasicomedicamentos where cuadrobm_historial=0 and cuadrobm_id='".trim($_POST["pVar1"])."'";
$rs_cbmedicamento = $DB_gogess->executec($busca_medicamento);

$busca_centros="select * from dns_centrosalud"; 
$rs_centros = $DB_gogess->executec($busca_centros);
?>
<style type="text/css">
<!--
.css_data {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_txt {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif;  }
-->
</style>	
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DBE6EE"><span class="css_data">CENTRO</span></td>
	<td bgcolor="#F2F2F2"><span class="css_data">DIRECCI&Oacute;N</span></td>
	<td bgcolor="#DBE6EE"><span class="css_data">CODIGO</span></td>
    <td bgcolor="#F2F2F2"><span class="css_data">MEDICAMENTO</span></td>
	<td bgcolor="#DBE6EE"><span class="css_data">EXTRA</span></td>
    <td bgcolor="#F2F2F2"><span class="css_data">DISPONIBLE</span></td>
  </tr>
  <?php
  if($rs_centros)
				   {
						while (!$rs_centros->EOF) {
						
						$array_color=array();
						
						
						$color_fila="";
						$stockactual="select sum(stock_cantidad * stock_signo) as stockactual from dns_principalstockactual where centro_id=".$rs_centros->fields["centro_id"]." and cuadrobm_id=".$rs_cbmedicamento->fields["cuadrobm_id"];
						$rs_stactua = $DB_gogess->executec($stockactual);
						
						if(@$rs_stactua->fields["stockactual"])
						{
						$disponible="".$rs_stactua->fields["stockactual"];
						$array_color[0]='bgcolor="#72B87A"';
						$array_color[1]='bgcolor="#72B87A"';
						$array_color[2]='bgcolor="#72B87A"';
						$array_color[3]='bgcolor="#72B87A"';
						$array_color[4]='bgcolor="#72B87A"';
						$array_color[5]='bgcolor="#72B87A"';
						}
						else
						{
						$disponible=" 0";
						$array_color[0]='bgcolor="#E6F3F9"';
						$array_color[1]='bgcolor="#F2F2F2"';
						$array_color[2]='bgcolor="#E6F3F9"';
						$array_color[3]='bgcolor="#F2F2F2"';
						$array_color[4]='bgcolor="#E6F3F9"';
						$array_color[5]='bgcolor="#F2F2F2"';
						}
						
						
						
						
  ?>
  <tr >
    <td  <?php  echo $array_color[0]; ?> class="css_txt" ><?php echo utf8_encode($rs_centros->fields["centro_nombre"]); ?></td>
	<td  <?php  echo $array_color[1]; ?> class="css_txt" ><?php echo utf8_encode($rs_centros->fields["centro_direccion"]); ?></td>
	<td  <?php  echo $array_color[2]; ?> class="css_txt" ><?php echo utf8_encode($rs_cbmedicamento->fields["cuadrobm_codigoatc"]) ?></td>
	<td  <?php  echo $array_color[3]; ?> class="css_txt" ><?php echo utf8_encode($rs_cbmedicamento->fields["cuadrobm_principioactivo"]) ?></td>
    <td  <?php  echo $array_color[4]; ?> class="css_txt" ><?php echo utf8_encode($rs_cbmedicamento->fields["cuadrobm_primerniveldesagregcion"]." ".$rs_cbmedicamento->fields["cuadrobm_tercerniveldesagregcion"]." ".$rs_cbmedicamento->fields["cuadrobm_concentracion"]) ?></td>
    <td  <?php  echo $array_color[5]; ?> class="css_txt" ><?php echo $disponible; ?></td>
  </tr>
  <?php
                          $rs_centros->MoveNext();
						}
					}
  
  ?>
</table>  
<?php
}
?>