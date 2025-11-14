<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
date_default_timezone_set('America/Guayaquil');
$path_template='../../../../../templates/page/';
 $fecha_hoy=date("Y-m-d");
$horario=$_GET["horario"];
?>
 <!-- Bootstrap -->
<link rel="icon" type="image/png" href="<?php echo "archivo/".$objportal->sys_pathfavicon; ?>" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo "archivo/".$objportal->sys_pathfavicon; ?>" sizes="16x16">
    <link href="<?php echo $path_template ?>/menu/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $path_template ?>dependencies/bootstrap/css/bootstrap.min.css" type="text/css">
    <link href="<?php echo $path_template ?>/menu/css/hoe.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<link type="text/css" href="<?php echo $path_template ?>css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<link type="text/css" href="<?php echo $path_template ?>css/jquery.dataTables.min.css" rel="stylesheet" />	


 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo $path_template ?>/menu/js/1.11.2.jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $path_template ?>/menu/js/bootstrap.min.js"></script>

<link type="text/css" href="<?php echo $path_template ?>css/responsive.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $path_template ?>css/buttons.dataTables.min.css" rel="stylesheet" />	
 <link rel="stylesheet" href="<?php echo $path_template ?>css/core.css" type="text/css" /> 

<link rel="stylesheet" type="text/css" href="<?php echo $path_template ?>/css/jquery.datetimepicker.min.css" >
<script src="<?php echo $path_template ?>/js/jquery.datetimepicker.full.min.js"></script>


<style type="text/css">
<!--
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px;
    
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.form-control {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    height: 24px;
    padding: 3px 6px;
}
-->
</style>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Agendar</title>
</head>

<body>
<div align="center">
<br />
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="Estilo3"><b>Fecha: </b></span></td>
    <td><span class="Estilo3">      
      <input name="fecha_valor" type="text" id="fecha_valor" value="<?php echo $fecha_hoy; ?>" class="form-control"  />
    </span></td>

    <td>&nbsp;</td>
    <td><input type="button" name="Button" value="Ver" onclick="ver_diario()" /></td>
	
	<td>&nbsp;</td>
   <!-- <td>&nbsp;</td>	
	<td onclick="btn_agendar()" ><span style=" cursor:pointer"><img src="agen.png" width="60" height="60"></span></td>
    <td>&nbsp;</td>	
	<td>&nbsp;</td>
	<td onclick="btn_agendarotros()" ><span style=" cursor:pointer"><img src="horariosotros1.png" width="60" height="60"></span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td onclick="btn_agendarquirofano()" ><span style=" cursor:pointer"><img src="quirofanoicon.png" width="60" height="60"></span></td>
	<td>&nbsp;</td>-->
	<td>&nbsp;</td>
	<td onclick="btn_listaag()" ><span style="cursor:pointer"><img src="horaroslista.png" width="50" height="50"></span></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<?php
	if($horario=='t')
    {
	?>
	<td><input type="button" name="Submit" value="Imprimir Agenda" onClick="ver_calendario_generalimptarde()" class="form-control"  ></td>
	<?php
	}
	else
	{
	?>
	<td><input type="button" name="Submit" value="Imprimir Horario Ma&ntilde;na" onClick="ver_calendario_generalimpmanana()" class="form-control"  ></td>
	<?php
	}
	?>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
</div>

<div id="lista_ag"></div>

<div id="divBody_agenda" ></div>

  <script src="<?php echo $path_template ?>/menu/js/hoe.js"></script>
	<script type="text/javascript" src="<?php echo $path_template ?>js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo $path_template ?>js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo $path_template ?>js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo $path_template ?>js/jquery.dataTables.min.js"></script> 
	<script language="javascript" type="text/javascript" src="<?php echo $path_template ?>js/ui.mask.js"></script>
	<script type="text/javascript" src="<?php echo $path_template ?>js/dataTables.responsive.min.js"></script> 
	
	
<script type="text/javascript">
<!--	
function ver_diario()
{
   <?php
   if($horario=='t')
   {
     $link_env='caltarde_agendar.php';
   }
   if($horario=='m')
   {
     $link_env='cal_agendar.php';
   }
   ?>
  
  $("#lista_ag").load("<?php echo $link_env; ?>",{
  
    fecha_valor:$('#fecha_valor').val()

  },function(result){  

  });  

  $("#lista_ag").html("Espere un momento..."); 

}

$( "#fecha_valor" ).datepicker({dateFormat: 'yy-mm-dd'});

ver_diario();


function btn_agendar()
{
abrir_standar('pantalla_agenda.php','AGENDAMIENTO','divBody_agenda','divDialog_agenda',900,600,0,0,0,0,0,0,0);
}

function btn_agendarotros()
{
abrir_standar('pantalla_agendaotros.php','OTRAS_REUNIONES','divBody_agenda','divDialog_agenda',900,400,0,0,0,0,0,0,0);
}

function btn_agendarquirofano()
{
abrir_standar('pantalla_agendaquirofano.php','QUIROFANOS','divBody_agenda','divDialog_agenda',900,400,0,0,0,0,0,0,0);
}

function btn_listaag()
{
abrir_standar('pantalla_agendalista.php','AGENDAMIENTO','divBody_agenda','divDialog_agenda',990,600,0,0,0,0,0,0,0);
}

function ver_calendario_generalimptarde()
{ 
  window.open('caltarde_print.php?fecha_valor='+$('#fecha_valor').val(),'_blank');
}

function ver_calendario_generalimpmanana()
{
 
  window.open('cal_print.php?fecha_valor='+$('#fecha_valor').val(),'_blank');


}


function busca_paciente()
{

$("#listap").load("lista_hc.php",{
  busca_paciente:$('#busca_paciente').val()

 },function(result){       


  });  

$("#listap").html("Espere un momento...");

}


//  End -->
</script>
	
</body>
</html>
