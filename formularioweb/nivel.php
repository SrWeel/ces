<?php
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();
include("../libreria/formulario.php");
include("../libreria/dbcc.php");
include("../cfgclases/config.php");

//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
  
  $lista_periodoactivo="select * from inc_periodo where perio_activo=1";
$resultadoper = mysql_query($lista_periodoactivo);
			if($resultadoper)
			{
			while($rowper = mysql_fetch_array($resultadoper)) 
				{
				    $periodosactivos=$periodosactivos.$rowper["perio_id"].",";			  
				   
				}
			}	   

$periodosactivos=substr($periodosactivos,0,-1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INCINE</title>
	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="js/jquery.js"></script>
	<script src="_assets/js/index.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	
</head>


<body>

<!-- Start of first page: #one -->
<div data-role="page" id="home">

	<div data-role="header" data-position="inline">
		<h1>INCINE</h1>
		<a href="./" data-icon="home" data-role="button" rel="external" data-iconpos="notext">Home</a>
		<a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-power" onClick="salir_sistema()" >Quit</a>
	</div><!-- /header -->

	<div role="main" class="ui-content">
<?php	
if(@$_SESSION['formularioweb_peri_id'])
			{

			 $sql='select distinct 	nivl_id from inc_materiaprofesor,inc_profesorperiodo,inc_periodo where inc_materiaprofesor.proper_id=inc_profesorperiodo.proper_id and inc_periodo.perio_id=inc_profesorperiodo.perio_id  and  inc_profesorperiodo.peri_id='.$_SESSION['formularioweb_peri_id']." and inc_periodo.perio_id in(".$periodosactivos.") and carr_id=".$_SESSION['formularioweb_carr_id'];
	$resultadocarr = mysql_query($sql);
			
	?>					
<label for="select-choice-1" class="select" >Nivel</label>
<select name="nivl_id" id="nivl_id"  onChange="selecciona_materias()">
 <option value="0">--SEMESTRE--</option>
	<?php
if($resultadocarr)
			{
			while($rowcarr = mysql_fetch_array($resultadocarr)) 
				{
				 
				   
					$nsemestre=$objformulario->replace_cmb("inc_nivel","nivl_id,nivl_nombre","where nivl_id=",$rowcarr["nivl_id"]);
				 
				   echo '<option value="'.$rowcarr["nivl_id"].'">'.$nsemestre.'</option>';
				}
			}	
	?>
</select>
<a href="materia.php"  data-role="button" rel="external" >Siguiente</a>
<div id="div_materia" >

</div>
<div id="div_login" ></div>
	<?php		
			}
?>
    </div><!-- /content -->
</div><!-- /page one -->
	
	
	<script type="text/javascript">
<!--
function salir_sistema()
{

$("#div_login").load("acceso/salir.php",{

 },function(result){  

      

  });  

  $("#div_login").html("Espere un momento...");  


}
function selecciona_materias()
{

$("#div_materia").load("variables_sess.php",{
  carr_id:'<?php echo $_SESSION['formularioweb_carr_id']; ?>',
  nivl_id:$('#nivl_id').val()
 },function(result){  

     
  });  

  $("#div_materia").html("Espere un momento...");  


}
//  End -->
</script>
</body>
</html>	
	