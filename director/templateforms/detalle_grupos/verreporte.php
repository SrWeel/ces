<?php

include("../../cfgclases/sessiontime.php");

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();



$director="../../";

include("../../cfgclases/clases.php");



?>

<style type="text/css">

<!--

.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }

.Estilo8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }

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

<BR><BR>

<div align="center"><span class="Estilo9">GRUPOS PARA EVALUACIONES INTEGRALES</span>

<BR><BR>
<?php

$litsa_porcentro="select * from dns_centrosalud";
$resul_centro = $DB_gogess->Execute($litsa_porcentro);
 if($resul_centro)
			  {					

						while (!$resul_centro->EOF) {	
?>
<div align="center"><span class="Estilo9"><?php echo $resul_centro->fields["centro_nombre"]; ?></span>
  <?php

$lista_grupos="select * from faesa_grupos where centro_id=".$resul_centro->fields["centro_id"];

$resultdoc = $DB_gogess->Execute($lista_grupos);	

              if($resultdoc)
			  {					

						//$resultdoc = mysql_query($listadoc);						

						while (!$resultdoc->EOF) {	

					

					$cintegrantes_grupo="select count(*) as cantidad from  faesa_integragrupo where grup_id=".$resultdoc->fields["grup_id"];

                    $cresultdo_integrantes = $DB_gogess->Execute($cintegrantes_grupo);	

					

?>

</div>

<table width="800" border="0" align="center" cellpadding="0" cellspacing="1">

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

                  $integrantes_grupo="select * from  faesa_integragrupo i inner join faesa_tipoproceso tp on i.tipp_id=tp.tipp_id inner join dns_especialidad es on i.especi_id=es.especi_id inner join app_usuario us on i.usua_id=us.usua_id where grup_id=".$resultdoc->fields["grup_id"];

                  $resultdo_integrantes = $DB_gogess->Execute($integrantes_grupo);	

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

<?php
                              $resul_centro->MoveNext();

									}	

					}		

?>