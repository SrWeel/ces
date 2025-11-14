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
 $fecha_hoy=date("Y-m-d"); 
  $hora_hoy=date("H:i:s"); 
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Multi-page template</title>
	<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="js/jquery.js"></script>
	<script src="_assets/js/index.js"></script>
	<script src="js/jquery.mobile-1.4.5.min.js"></script>
	
	
<script type="text/javascript">
<!--
function salir_sistema()
{

$("#div_login").load("acceso/salir.php",{

 },function(result){  

      

  });  

  $("#div_login").html("Espere un momento...");  


}

function activar_asistencia(alu_idp,campo,es)
{

$("#div_asistenacia").load("asistencia.php",{

  carr_id:'<?php echo $_SESSION['formularioweb_carr_id']; ?>',
  nivl_id:'<?php echo $_SESSION['formularioweb_nivl_id']; ?>',
  matprof_id:'<?php echo $_SESSION['formularioweb_matprof_id']; ?>',
  activo:$('input:checkbox[name='+campo+']:checked').val(),
  alu_id:alu_idp,
  esp:es

 },function(result){  

     
  });  

  $("#div_asistenacia").html("Espere un momento...");  


}
//  End -->
</script>
	
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
	
	$sacandoids="select * from inc_materiaprofesor where matprof_id=".@$_SESSION['formularioweb_matprof_id'];
$resultadoxids = mysql_query($sacandoids);
			if($resultadoxids)
			{
			while($rowxids = mysql_fetch_array($resultadoxids)) 
				{
				  $carr_idsila=$rowxids["carr_id"];
				  $nivl_idsila=$rowxids["nivl_id"];
				  $mate_idsila=$rowxids["mate_id"];
				  
				  
				  $periodop_asignadom=trim($objformulario->replace_cmb("inc_profesorperiodo","proper_id,perio_id","where proper_id=",$rowxids["proper_id"]));
				  
				  $perio_id=$periodop_asignadom;
				}
			}
	
	
$datosgenerales="select * from inc_materiaprofesor,inc_profesorperiodo where inc_materiaprofesor.proper_id=inc_profesorperiodo.proper_id and inc_profesorperiodo.perio_id=".$perio_id." and matprof_id=".@$_SESSION['formularioweb_matprof_id'];
$resultadox = mysql_query($datosgenerales);
			if($resultadox)
			{
			while($rowx = mysql_fetch_array($resultadox)) 
				{
		
				   
				   $carreraval=$objformulario->replace_cmb("bib_carrera","carr_id,carr_nombre","where carr_id=",$rowx["carr_id"]);
				   $semestreval=$objformulario->replace_cmb("inc_nivel","nivl_id,nivl_nombre","where nivl_id=",$rowx["nivl_id"]);
				 
				   $nombre_periodo=$objformulario->replace_cmb("inc_periodo","perio_id,perio_nombre","where perio_id=",$perio_id);
				   
				   $nprofesor=$objformulario->replace_cmb("inc_personal","peri_id,peri_nombres,peri_apellidos","where peri_id=",$rowx["peri_id"]);
				   
				  
				   $encabezadotxt= str_replace('-carrera-',$carreraval,$encabezado);
					$encabezadotxt=str_replace('-semestre-',$semestreval,$encabezadotxt);	
					$encabezadotxt=str_replace('-periodo-',$nombre_periodo,$encabezadotxt);	
					$encabezadotxt=str_replace('-profesor-',$nprofesor,$encabezadotxt);	
				   
				}
				mysql_free_result($resultadox);
			}	

	echo $carreraval."<br>";
	echo $semestreval."<br>";
	echo $nombre_periodo."<br>";
	echo $nprofesor."<br>";
	?>
	<?php
	
	
//$listaalumnos="select * from inc_alumnoperiodomateria,inc_alumnoperiodo where inc_alumnoperiodomateria.aluper_id=inc_alumnoperiodo.aluper_id and perio_id=".$perio_id." and matprof_id=".$matprof_id." order by alu_apellidos asc";

$listaalumnos="select * from inc_alumnoperiodomateria,inc_alumnoperiodo,inc_alumno where inc_alumnoperiodomateria.aluper_id=inc_alumnoperiodo.aluper_id and inc_alumno.alu_id=inc_alumnoperiodomateria.alu_id and perio_id=".$perio_id." and matprof_id=".@$_SESSION['formularioweb_matprof_id']." order by alu_apellidos asc";


echo '<table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke">

<thead>
       <tr>
        <!-- <th data-priority="2">C&eacute;dula</th>-->
		<th data-priority="1" >EN</th>
		<th data-priority="1" >SA</th>
         <th data-priority="1" >Nombres</th>
         <th data-priority="1">Apellidos</th>
       </tr>
     </thead>
	 <tbody>
 ';				
$resultado = mysql_query($listaalumnos);
			if($resultado)
			{
			while($row = mysql_fetch_array($resultado)) 
				{
				    $nombrealumno=$objformulario->replace_cmb("inc_alumno","alu_id,	alu_nombres","where alu_id=",$row["alu_id"]);
					$apellidoalumno=$objformulario->replace_cmb("inc_alumno","alu_id,alu_apellidos","where alu_id=",$row["alu_id"]);
					$cedulaalumno=$objformulario->replace_cmb("inc_alumno","alu_id,alu_ci","where alu_id=",$row["alu_id"]);
				    
					$busca_si="select * from inc_asisalumno where carr_id=".$_SESSION['formularioweb_carr_id']." and nivl_id=".$_SESSION['formularioweb_nivl_id']." and matprof_id=".$_SESSION['formularioweb_matprof_id']." and alu_id=".$row["alu_id"]." and asialu_es=1 and asialu_fecha='".$fecha_hoy."' and perio_id=".$perio_id;
                    $result_bsi = mysql_query($busca_si);
					$cheke="";
					if($result_bsi)
					{
					while($row_bsi= mysql_fetch_array($result_bsi)) 
						{
						  if($row_bsi["asialu_activo"]=='true')
						  {
							$cheke="checked";
							}
						}
					
					}
					
					
					echo '  <tr>
						<!-- <td >'.$cedulaalumno.'</td>-->
						<td  ><label><input name="checke_asis_'.$row["alu_id"].'" id="checke_asis_'.$row["alu_id"].'"  type="checkbox" value="'.$row["alu_id"].'"  onClick="activar_asistencia('.$row["alu_id"].',\'checke_asis_'.$row["alu_id"].'\',1)" '.$cheke.' ></label></td>';
						
				
					$busca_si2="select * from inc_asisalumno where carr_id=".$_SESSION['formularioweb_carr_id']." and nivl_id=".$_SESSION['formularioweb_nivl_id']." and matprof_id=".$_SESSION['formularioweb_matprof_id']." and alu_id=".$row["alu_id"]." and asialu_es=2 and asialu_fecha='".$fecha_hoy."' and perio_id=".$perio_id;
                    $result_bsi2 = mysql_query($busca_si2);
					$cheks="";
					if($result_bsi2)
					{
					while($row_bs2= mysql_fetch_array($result_bsi2)) 
						{
						
							
							if($row_bs2["asialu_activo"]=='true')
						    {
							$cheks="checked";
							}
							
							
						}
					
					}	
						
						
				   echo '<td  ><label><input name="checks_asis_'.$row["alu_id"].'" id="checks_asis_'.$row["alu_id"].'"  type="checkbox" value="'.$row["alu_id"].'"  onClick="activar_asistencia('.$row["alu_id"].',\'checks_asis_'.$row["alu_id"].'\',2)" '.$cheks.' ></label></td>
						<td >'.$nombrealumno.'</td>
						<td  >'.$apellidoalumno.'</td>';
						
						
					
					
					 echo '</tr>';
				}
				mysql_free_result($resultado);
			}	
			
echo '</tbody></table>';											
	
	
	mysql_close($link);
	?>
	<div id="div_asistenacia" ></div>
	<div id="div_login" ></div>
	<?php
	}
	?>
	</div><!-- /content -->
</div><!-- /page one -->
	
</body>
</html>	