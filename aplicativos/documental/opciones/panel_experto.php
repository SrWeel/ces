<script language="javascript">

<!--



function lista_requerimientos()

{



$("#lista_requerimientos").load("aplicativos/documental/opciones/requerimiento/lista_requerimientos.php",{

enlace:'<?php echo $_SESSION['ces1313777_sessid_inicio']; ?>'

 },function(result){       



			 



  });  

$("#lista_requerimientos").html("Espere un momento...");





}



function levantar_mano(requid,usuaid)

{



$("#levanta_"+requid).load("aplicativos/documental/opciones/requerimiento/levantar_mano.php",{

usuaidp:usuaid,

requidq:requid

 },function(result){       



			

  });  

$("#levanta_"+requid).html("Espere un momento...");





}

//-->

</script>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:900px;">

<center><h4>Panel Experto</h4></center>

<?php

//verifica lo llenado

$busca_datosus="select * from app_usuario where usua_id=?";

$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$_SESSION['ces1313777_sessid_inicio']));

$porcentaje_actual=45;

$conteo_actual=0;



if($rs_usuarios->fields["usua_ciruc"])

{

$conteo_actual++;

}



if($rs_usuarios->fields["usua_genero"])

{

$conteo_actual++;

}



if($rs_usuarios->fields["usua_fechanacimiento"]!='0000-00-00')

{

$conteo_actual++;

}



if($rs_usuarios->fields["usua_celular"])

{

$conteo_actual++;

}





if($rs_usuarios->fields["usua_direcciondom"])

{

$conteo_actual++;

}



if($rs_usuarios->fields["usua_telefonodom"])

{

$conteo_actual++;

}





if($rs_usuarios->fields["usua_archivo"])

{

$conteo_actual++;

}



if($rs_usuarios->fields["usua_ciruc"])

{

$conteo_actual++;

}



//valida servicios



$busca_serv="select count(1) as totalserv from app_servicios where  usua_id=".@$_SESSION['ces1313777_sessid_inicio'];

$rs_tserv = $DB_gogess->executec($busca_serv,array());





if($rs_tserv->fields["totalserv"]>0)

{

$conteo_actual++;

}





$busca_ref="select count(1) as totalref from app_referencia where  usua_id=".@$_SESSION['ces1313777_sessid_inicio'];

$rs_tref = $DB_gogess->executec($busca_ref,array());





if($rs_tref->fields["totalref"]>0)

{

$conteo_actual++;

}



//valida servicios







$actul_lleno=5*$conteo_actual;

if($actul_lleno==50)

{



$actul_lleno=55;

}



$total_lleno=$porcentaje_actual+$actul_lleno;

if($total_lleno!=100)

{

?>



<div class="panel panel-default">

  <div class="panel-heading">

    <h3 class="panel-title" style="color:#990000">Complete sus datos para tener mas beneficios como experto</h3>

  </div>

  <div class="panel-body">

    

	

	<div class="row" align="center">



<div class="form-group">

<div class="col-xs-3">



<div class="progress progress-striped active">

  <div class="progress-bar" role="progressbar"

       aria-valuenow="<?php echo $total_lleno ?>" aria-valuemin="0" aria-valuemax="100"

       style="width: <?php echo $total_lleno ?>%">

    <span class="sr-only">45% completado</span>

  </div>

</div>



</div>



<div class="col-xs-3">

 <button type="button" class="mb-sm btn btn-primary"  onClick="ver_formularioenpantalla('aplicativos/documental/datos_expertocompleto.php','Perfil','divBody_ext','<?php echo $_SESSION['ces1313777_sessid_inicio'] ?>',0,0,0,0,0,0)"  >COMPLETAR PERFIL</button>

</div>

</div>



</div>

	

	

	

  </div>

</div>

<?php

}

?>







<div id="lista_requerimientos"></div>







</div>



<script language="javascript">

<!--

lista_requerimientos();

//-->

</script>