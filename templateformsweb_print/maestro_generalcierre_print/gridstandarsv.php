<?php
//--------------------------------------------------
$campos_dataedit=array();
$campos_dataedit=explode(",",$rs_bbcampos->fields["fie_tablasubgridcampos"]);
$campo_id=$rs_bbcampos->fields["fie_tablasubcampoid"];

$fie_tblcombogrid=$rs_bbcampos->fields["fie_tblcombogrid"];
$fie_campoidcombogrid=$rs_bbcampos->fields["fie_campoidcombogrid"];

$campos_validaciongrid=array();
$campos_validaciongrid=explode(",",$rs_bbcampos->fields["fie_camposobligatoriosgrid"]);

$fie_tituloscamposgrid=array();
$fie_tituloscamposgrid=explode(",",$rs_bbcampos->fields["fie_tituloscamposgrid"]);

$campo_enlace=$rs_bbcampos->fields["fie_campoenlacesub"];

//echo $rs_bbcampos->fields["fie_id"];

?>
<script language="javascript">
<!--

function grid_extras_<?php echo $rs_bbcampos->fields["fie_id"];  ?>(enlacep,id_grid,opcionp)
{


$("#lista_detalles_<?php echo $rs_bbcampos->fields["fie_id"];  ?>").load("<?php echo $formulario_path; ?>/grid_standarsv.php",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
<?php echo $campo_id; ?>x:$('#<?php echo $campo_id; ?>x').val(),
fie_id:'<?php echo $rs_bbcampos->fields["fie_id"];  ?>',
sess_id:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>',
clie_id:'<?php echo $objformulario->sendvar["clie_idx"]; ?>'

 },function(result){       
	

  });  

$("#lista_detalles_<?php echo $rs_bbcampos->fields["fie_id"];  ?>").html("Espere un momento...");

}
//-->
</script>


<div class="panel panel-default" >
<div class="panel-body">

  <div id="lista_detalles_<?php echo $rs_bbcampos->fields["fie_id"];  ?>"></div>
  
</div>
</div>

<script type="text/javascript">
<!--

 grid_extras_<?php echo $rs_bbcampos->fields["fie_id"];  ?>('<?php echo @$objformulario->contenid["atenc_enlace"]; ?>',0,0);

//  End -->
</script>