<?php
$objperfil->usuarios_perfil($_SESSION['ces1313777_sessid_cedula'],$_SESSION['idmen'],$DB_gogess);
//if($objperfil->estado_checker==1)
//{
?>
<style type="text/css">
<!--
.css_rep1 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>
<div align="center">
<p>&nbsp;</p>
<table width="300" border="0" align="center" cellpadding="3" cellspacing="1">
  <tr>
    <td bgcolor="#EBF2F3"><div align="center"><span class="css_rep1">LISTA REPORTES</span></div></td>
  </tr>
  <tr>
    <td bgcolor="#F5FAFA"><table width="600" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td bgcolor="#EBF2F3"><span class="css_rep1">Nombre</span></td>
        <td bgcolor="#EBF2F3">&nbsp;</td>
        </tr>
	  <?php
	  $buscareportes="select * from kyradm_report where rept_activo=1";
	  $rs_gogessform = $DB_gogess->Execute($buscareportes);
		  if($rs_gogessform)
		  {
				while (!$rs_gogessform->EOF) {	
				
	  ?>
      <tr>
        <td><span class="Estilo5"><?php  echo $rs_gogessform->fields["rept_nombre"] ?></span></td>
        <td><div align="center" class="Estilo5"><a href="templateformsweb/maestro_standar_report/verreporte.php?ireport=<?php  echo $rs_gogessform->fields["rept_id"] ?>" target="_blank">Abrir reporte </a></div></td>
        </tr>
      
	  <?php
	              $rs_gogessform->MoveNext();	
	               }
	  
	  }
	  
	  ?>
      
      <tr>
        <td>LISTA RETENCIONES</td>
        <td><div align="center" class="Estilo5"><a href="../xmlsri/templateforms/maestro_reporte/verreporte.php?ireport=11" target="_blank">Abrir reporte </a></div></td>
      </tr>
      
      
    </table></td>
  </tr>
</table>
</div>
<?php
//}
//else
//{

//echo "<div align='center'><br><br><br><br><div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>Debe tener el perfil checker para acceder a esta opci&oacute;n</b></div></div>";

//}
?>
