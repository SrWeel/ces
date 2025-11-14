<?php
$nombre_grid="grid_gridanfamiliar.php";
$campo_idenlace="anamn_enlace";
?>
<script language="javascript">
<!--
function grid_extras_<?php echo $rs_bbcampos->fields["fie_id"];  ?>(enlacep,id_grid,opcionp)
{


$("#lista_detalles_<?php echo $rs_bbcampos->fields["fie_id"];  ?>").load("<?php echo $formulario_path; ?>/<?php echo $nombre_grid; ?>",{

enlace:enlacep,
idgrid:id_grid,
opcion:opcionp,
enlace:enlacep,
fie_title:'<?php echo $rs_bbcampos->fields["fie_title"]; ?>',
fie_id:'<?php echo $rs_bbcampos->fields["fie_id"];  ?>'

 },function(result){       

  });  

$("#lista_detalles_<?php echo $rs_bbcampos->fields["fie_id"];  ?>").html("Espere un momento...");



}

//-->

</script>



<div class="panel panel-default" >
<div class="panel-body">

  <div id="lista_detalles_<?php echo $rs_bbcampos->fields["fie_id"];  ?>">  </div>

</div>

</div>

<script type="text/javascript">

<!--

// $("#fecha_valx").datepicker({dateFormat: 'yy-mm-dd'});

 //$("#hora_valx").wickedpicker({twentyFour: true});

 grid_extras_<?php echo $rs_bbcampos->fields["fie_id"];  ?>('<?php echo @$objformulario->contenid[$campo_idenlace]; ?>',0,0);

 //  End -->

</script>