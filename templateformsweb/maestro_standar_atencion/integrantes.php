<style type="text/css">
<!--
.Estilo5 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.Estilo8 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo9 {
	font-size: 17px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.borde_cuadro{
	border: 1px solid #333333;

}
-->
</style>

<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 

$objformulario= new  ValidacionesFormulario();

$objtableform= new templateform();


$lista_grupos="select * from faesa_grupos where grup_id=".$_POST["grup_idx"];
$resultdoc = $DB_gogess->executec($lista_grupos,array());	
              if($resultdoc)
			  {					
						//$resultdoc = mysql_query($listadoc);						
						while (!$resultdoc->EOF) {	
					
					$cintegrantes_grupo="select count(*) as cantidad from  faesa_integragrupo where grup_id=".$resultdoc->fields["grup_id"]." order by integr_id asc";
                    $cresultdo_integrantes = $DB_gogess->executec($cintegrantes_grupo,array());	
					
?>
</div>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td width="100" class="borde_cuadro"><div align="center"><span class="Estilo5">GRUPO</span></div></td>
    <td width="100" class="borde_cuadro"><div align="center"><span class="Estilo5">HORARIO</span></div></td>
    <td width="100" class="borde_cuadro"><div align="center"><span class="Estilo5">PROCESO</span></div></td>
    <td width="100" class="borde_cuadro"><div align="center"><span class="Estilo5">AREA</span></div></td>
    <td class="borde_cuadro"><div align="center"><span class="Estilo5">TERAPEUTA</span></div></td>
    <td width="100" class="borde_cuadro"><div align="center"><span class="Estilo5">RANGO</span></div></td>
  </tr>
          <?php
		          $contandor=0;
                  $integrantes_grupo="select * from  faesa_integragrupo i inner join faesa_tipoproceso tp on i.tipp_id=tp.tipp_id inner join dns_especialidad es on i.especi_id=es.especi_id inner join app_usuario us on i.usua_id=us.usua_id where grup_id=".$resultdoc->fields["grup_id"]." order by integr_hora asc";
                  $resultdo_integrantes = $DB_gogess->executec($integrantes_grupo,array());	
						if($resultdo_integrantes)
						{
						   while (!$resultdo_integrantes->EOF) {			   
           ?>
  <tr>
    <?php
	if($contandor==0)
	{
	echo '<td rowspan="'.$cresultdo_integrantes->fields["cantidad"].'" class="borde_cuadro"><div align="center"><span class="Estilo8">'.$resultdoc->fields["grup_nombre"].'</span></div></td>
	';
    }
	?>
	<td class="borde_cuadro Estilo8"><?php echo $resultdo_integrantes->fields["integr_hora"]; ?></td>
    <td class="borde_cuadro Estilo8"><?php echo $resultdo_integrantes->fields["tipp_nombre"]; ?></td>
    <td class="borde_cuadro Estilo8"><?php echo $resultdo_integrantes->fields["especi_nombre"]; ?></td>
    <td class="borde_cuadro Estilo8"><?php echo $resultdo_integrantes->fields["usua_nombre"]." ".$resultdo_integrantes->fields["usua_apellido"]; ?></td>
	<?php
	if($contandor==0)
	{
	echo '<td rowspan="'.$cresultdo_integrantes->fields["cantidad"].'" class="borde_cuadro"><div align="center"><span class="Estilo8">'.$resultdoc->fields["grup_ri"].' A '.$resultdoc->fields["grup_rf"].'</span></div></td>';
    }
	?>
  </tr>
          <?php
		                  $contandor++;
                          $resultdo_integrantes->MoveNext();
						   }
						
						
						}
          ?>
  
</table>
<?php
                             $resultdoc->MoveNext();
									}	
					}				
?>