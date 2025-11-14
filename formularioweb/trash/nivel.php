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
  if(@$_SESSION['formularioweb_peri_id'])
			{
			
			$sql='select distinct carr_id from inc_materiaprofesor,inc_profesorperiodo,inc_periodo where inc_materiaprofesor.proper_id=inc_profesorperiodo.proper_id and inc_periodo.perio_id=inc_profesorperiodo.perio_id  and  inc_profesorperiodo.peri_id='.$_SESSION['formularioweb_peri_id']." and inc_periodo.perio_id in(".$periodosactivos.")";
	$resultadocarr = mysql_query($sql);
			?>
			
			<label for="select-choice-1" class="select" >Nivel</label>
<select name="nivl_id" id="nivl_id"  >
    
	<option value="0">--CARRERA--</option>
	<?php
if($resultadocarr)
			{
			while($rowcarr = mysql_fetch_array($resultadocarr)) 
				{
				 
				    $ncarrera=$objformulario->replace_cmb("bib_carrera","carr_id,carr_nombre","where carr_id=",$rowcarr["carr_id"]);
				 
				   echo '<option value="'.$rowcarr["carr_id"].'">'.$ncarrera.'</option>';
				}
			}	
	?>
</select>
			
			
			
			<?php
			}
  
  ?>