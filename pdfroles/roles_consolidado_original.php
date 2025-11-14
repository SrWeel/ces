<?php
ini_set('display_errors',0);
error_reporting(E_ALL);

 $fechahoy=date("Y-m-d");
 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename="."consolidado_".$fechahoy.".xls");
 $banderaimp=1;

//header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=44440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$genr_id=$_GET["genr_id"];
$valcedula_val=@$_GET["valcedula_val"];

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
 
$objformulario= new  ValidacionesFormulario();
$obj_funciones=new util_funciones();

$emp_id=1;
$nombre_empresa="select * from app_empresa where emp_id='".$emp_id."'"; 
$resultl_empresa = $DB_gogess->executec($nombre_empresa,array());

$lista_rolg="select * from conco_generarroles where genr_id='".$genr_id."'";
$resultl_rolg = $DB_gogess->executec($lista_rolg,array());

$genr_anio=$resultl_rolg->fields["genr_anio"];
$genr_mes=$resultl_rolg->fields["genr_mes"];

$mes=array();
$mes[1]='ENERO';
$mes[2]='FEBRERO';
$mes[3]='MARZO';
$mes[4]='ABRIL';
$mes[5]='MAYO';
$mes[6]='JUNIO';
$mes[7]='JULIO';
$mes[8]='AGOSTO';
$mes[9]='SEPTIEMBRE';
$mes[10]='OCTUBRE';
$mes[11]='NOVIEMBRE';
$mes[12]='DICIEMBRE';

?>
<style type="text/css">
<!--
.css_titulo {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_txt {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<table height="165" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="67" height="95" bgcolor="#A8FFA8"><span class="css_titulo">No.</span></td>
    <td width="86" bgcolor="#A8FFA8"><span class="css_titulo">REGIMEN LABORAL</span></td>
	<td width="86" bgcolor="#A8FFA8"><span class="css_titulo">TIPO DE CONTRATO</span></td>
	<td width="86" bgcolor="#A8FFA8"><span class="css_titulo">NOMBRE Y APPELIDOS</span></td>
    <td width="86" bgcolor="#A8FFA8"><span class="css_titulo">CEDULA</span></td>
    <td width="86" bgcolor="#A8FFA8"><span class="css_titulo">CARGO</span></td>
	<td width="86" bgcolor="#A8FFA8"><span class="css_titulo">CONVENIOS</span></td>
    <td width="79" bgcolor="#A8FFA8"><span class="css_titulo">RMU</span></td>
    <td width="74" bgcolor="#A8FFA8"><span class="css_titulo">FONDO DE RESERVA    OCTUBRE</span></td>
    <td width="68" bgcolor="#A8FFA8"><span class="css_titulo">XIII</span></td>
    <td width="67" bgcolor="#A8FFA8"><span class="css_titulo">XIV</span></td>
    <td width="67" bgcolor="#A8FFA8"><span class="css_titulo">Antig&uuml;edad 0.25%</span></td>
    <td width="78" bgcolor="#A8FFA8"><span class="css_titulo">PASAJE 0.50</span></td>
    <td width="69" bgcolor="#A8FFA8"><span class="css_titulo">CARGAS    FAMILIARES&nbsp; 1% DEL S/B&nbsp; $ 4.00 x C/D NI&Ntilde;O</span></td>
    <td width="68" bgcolor="#A8FFA8"><span class="css_titulo">ALIMENTACION $ 4    X DIA TRABAJADO</span></td>
	<?php
	$lista_extaras="select distinct rubrg_id,rubrg_nombre from conco_detalleroles where rubrg_id=19 and genr_id='".$genr_id."' and rubrg_ingresoegreso=1";
	$resultl_extras = $DB_gogess->executec($lista_extaras,array());
	if($resultl_extras)
	{
      while (!$resultl_extras->EOF)
		{
		
		echo '<td width="68" bgcolor="#A8FFA8"><span class="css_titulo">'.$resultl_extras->fields["rubrg_nombre"].'</span></td>';
		
		 $resultl_extras->MoveNext();
		}
	}	
	?>
	
    <td width="72" bgcolor="#A8FFA8"><span class="css_titulo">TOTAL INGRESOS</span></td>
    <td width="65" bgcolor="#A8FFA8"><span class="css_titulo">APORTE PERSONAL</span></td>
    <td width="64" bgcolor="#A8FFA8"><span class="css_titulo">CAUCI&Oacute;N</span></td>
    <td width="55" bgcolor="#A8FFA8"><span class="css_titulo">APORTE CONYUGE</span></td>
    <td width="79" bgcolor="#A8FFA8"><span class="css_titulo">DTOS JUDIC</span></td>
    <td width="75" bgcolor="#A8FFA8"><span class="css_titulo">ANT. SUELDO    DEC.EJEC. 1710</span></td>
    <td width="78" bgcolor="#A8FFA8"><span class="css_titulo">CONCILIACION</span></td>
    <td width="75" bgcolor="#A8FFA8"><span class="css_titulo">PREST. HIPOT.</span></td>
    <td width="75" bgcolor="#A8FFA8"><span class="css_titulo">PREST. QUIROG</span></td>
    <td width="73" bgcolor="#A8FFA8"><span class="css_titulo">BENEFICA</span></td>
    <td width="73" bgcolor="#A8FFA8"><span class="css_titulo">CUOTAS SINDICATO</span></td>
	<td width="73" bgcolor="#A8FFA8"><span class="css_titulo">SUPA</span></td>
	<?php
	$lista_extaras2="select distinct rubrg_id,rubrg_nombre from conco_detalleroles where rubrg_id=19 and genr_id='".$genr_id."' and rubrg_ingresoegreso=2";
	$resultl_extras2 = $DB_gogess->executec($lista_extaras2,array());
	if($resultl_extras2)
	{
      while (!$resultl_extras2->EOF)
		{
		
		echo '<td width="68" bgcolor="#A8FFA8"><span class="css_titulo">'.$resultl_extras2->fields["rubrg_nombre"].'</span></td>';
		
		 $resultl_extras2->MoveNext();
		}
	}	
	?>
    <td width="68" bgcolor="#A8FFA8"><span class="css_titulo">TOTAL EGRESOS</span></td>
    <td width="75" bgcolor="#A8FFA8"><span class="css_titulo">NETO A RECIBIR</span></td>
    <td width="65" bgcolor="#A8FFA8"><span class="css_titulo">APORTE PATRON.</span></td>
	
	<td width="65" bgcolor="#A8FFA8"><span class="css_titulo">PROVISION DECIMO TERCERO</span></td>
	<td width="65" bgcolor="#A8FFA8"><span class="css_titulo">PROVISION DECIMO CUARTO</span></td>
	<td width="65" bgcolor="#A8FFA8"><span class="css_titulo">PROVISION FONDOS DE RESERVA</span></td>
	<td width="65" bgcolor="#A8FFA8"><span class="css_titulo">PROVISION VACACIONES</span></td>
	
  </tr>

<?php
$numera_datos=0;
$concatena='';
$lista_empleados="select * from conco_roles where genr_id='".$genr_id."'";
$resultl_listaroles = $DB_gogess->executec($lista_empleados,array());
if($resultl_listaroles)
{
      while (!$resultl_listaroles->EOF)
		{
		  $datos_empleado="select * from app_usuario where usua_id='".$resultl_listaroles->fields["usua_id"]."'";
		  $resultl_empleado= $DB_gogess->executec($datos_empleado,array());		
		  
		 
		 //Informacion Laboral
		  $lista_infolaboral="select * from grid_infolaboral3 left join cmb_puestoinstitucional on grid_infolaboral3.info_puestoinstitucional=cmb_puestoinstitucional.tipoinst_id where standar_enlace='".$resultl_empleado->fields["usua_enlace"]."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
		  		
          $resultl_linfo= $DB_gogess->executec($lista_infolaboral,array());	
		  
		  $tipoinst_nombre='';
		  $tipoinst_nombre=$resultl_linfo->fields["tipoinst_nombre"];
		  
		  
		  $info_regimenlaboral=$resultl_linfo->fields["info_regimenlaboral"];		  
		  $datos_regimen="select tiporeglab_id,tiporeglab_nombre from cmb_regimenlaboral where tiporeglab_id='".$resultl_linfo->fields["info_regimenlaboral"]."'";
		  $resultl_regimen=$DB_gogess->executec($datos_regimen,array());	
		  $tiporeglab_nombre='';
		  $tiporeglab_nombre=$resultl_regimen->fields["tiporeglab_nombre"];
		  
		  
		  $info_tipodecontrato=$resultl_linfo->fields["info_tipodecontrato"];
		  $datos_contrato="select tdct_id,tdct_nombre from cmb_tipocontrato where tdct_id='".$resultl_linfo->fields["info_tipodecontrato"]."'";
		  $resultl_contrato= $DB_gogess->executec($datos_contrato,array());
		  $tdct_nombre='';
		  $tdct_nombre=$resultl_contrato->fields["tdct_nombre"];
		  
		   		
          $info_convenios=$resultl_linfo->fields["info_convenios"];
		  $datos_convenio="select tcov_id,tcov_nombre from cmb_tipoconvenio where tcov_id='".$resultl_linfo->fields["info_convenios"]."'";
		  $resultl_convenio= $DB_gogess->executec($datos_convenio,array());
		  $tcov_nombre=$resultl_convenio->fields["tcov_nombre"];
		  if(!($tcov_nombre))
		  {
		    $tcov_nombre='NO APLICA';
		  }
		  //$resultl_empleado->fields["usua_rucci"]." ".$resultl_empleado->fields["usua_nombre"]." ".$resultl_empleado->fields["usua_apellido"]."<br>";
		  
		  //ingresos
		  
		  $total_ingresos=0;
		  $total_egresos=0;
		  $rmu='';
		  $ingreso_val='';
		  $ingreso_val=' <table width="100%" border="0" cellpadding="0" cellspacing="0">';
		  $busca_ingresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=1 and tiporub_id=1";
		  
		  $resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
		  if($resultl_ingresos)
           {
		       while (!$resultl_ingresos->EOF)
		       {
			   				  
				  
				  $rmu='';
		          $rmu=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				
				$resultl_ingresos->MoveNext();
		       }
		   }
		   
		  $fondos_re='';
		  $decimo_iii='';
		  $decimo_iv='';
		  $antiguedad_val='';
		  $pasajes_val='';
		  $cargas_val='';
		  $alimentacion_val='';
		 
		   
$busca_ingresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=1 and tiporub_id!=1";
		  
		  $resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
		  if($resultl_ingresos)
           {
		       while (!$resultl_ingresos->EOF)
		       {
			    
				  if($resultl_ingresos->fields["rubrg_id"]==2)
				  {
				   $fondos_re='';
				   $fondos_re=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==3)
				  {
				   $decimo_iii='';
				   $decimo_iii=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==4)
				  {
				   $decimo_iv='';
				   $decimo_iv=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==11)
				  {
				   $antiguedad_val='';
				   $antiguedad_val=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==5)
				  {
				   $pasajes_val='';
				   $pasajes_val=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==12)
				  {
				   $cargas_val='';
				   $cargas_val=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==13)
				  {
				   $alimentacion_val='';
				   $alimentacion_val=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				 
				 
				  
				$resultl_ingresos->MoveNext();
		       }
		   }
		   		  
		  //ingresos
		  
		  //egresos
		  
		  //egresos varios
		  $aportepersonal_val='';
		  $caucion_val='';
		  $conyuge_val='';
		  $anticipos_val='';
		  $hipotecario_val='';
		  $quirografario_val='';
		  $benefica_val='';
		  $sindicato_val='';
		  $supa_val='';
		  
		  $busca_egresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=2";
		  
		  $resultl_egresos= $DB_gogess->executec($busca_egresos,array());
		  if($resultl_egresos)
           {
		       while (!$resultl_egresos->EOF)
		       {
			    
				   if($resultl_egresos->fields["rubrg_id"]==6)
				  {
				   $aportepersonal_val='';
				   $aportepersonal_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_egresos->fields["rubrg_id"]==9)
				  {
				   $caucion_val='';
				   $caucion_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_egresos->fields["rubrg_id"]==20 or $resultl_egresos->fields["rubrg_id"]==9 or $resultl_egresos->fields["rubrg_id"]==21)
				  {
				   $caucion_val='';
				   $caucion_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_egresos->fields["rubrg_id"]==14)
				  {
				   $conyuge_val='';
				   $conyuge_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				
				  if($resultl_egresos->fields["rubrg_id"]==7)
				  {
				   $anticipos_val='';
				   $anticipos_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				
				  if($resultl_egresos->fields["rubrg_id"]==10)
				  {
				   $hipotecario_val='';
				   $hipotecario_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				
				  if($resultl_egresos->fields["rubrg_id"]==8)
				  {
				   $quirografario_val='';
				   $quirografario_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				   if($resultl_egresos->fields["rubrg_id"]==17)
				  {
				   $benefica_val='';
				   $benefica_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_egresos->fields["rubrg_id"]==15)
				  {
				   $sindicato_val='';
				   $sindicato_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				   if($resultl_egresos->fields["rubrg_id"]==22)
				  {
				   $supa_val='';
				   $supa_val=number_format($resultl_egresos->fields["rubrg_valor"], 2, '.', '');
				  }
				
				$resultl_egresos->MoveNext();
		       }
		   }
		  
		  //egresos
		  
		  //patronal
		  
		  //patronal
		  $valor_patronal='';
		  $busca_patronal="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=3";
		  
		  $resultl_patronal= $DB_gogess->executec($busca_patronal,array());
		  if($resultl_patronal)
           {
		       while (!$resultl_patronal->EOF)
		       {
			    			  
				  $valor_patronal=number_format($resultl_patronal->fields["rubrg_valor"], 2, '.', '');
				  
				
				$resultl_patronal->MoveNext();
		       }
		   }
		  
		  //patronal
		  
		  $total_ingresost=0;
		  $total_ingresos=0;
		  $total_ingresos=$fondos_re+$decimo_iii+$decimo_iv+$antiguedad_val+$pasajes_val+$cargas_val+$alimentacion_val+$rmu;
		  
		  
		  $total_egresost=0;
		  $total_egresos=0;
		  $total_egresos=$supa_val+$aportepersonal_val+ $caucion_val+$conyuge_val+$anticipos_val+$hipotecario_val+$quirografario_val+$benefica_val+$sindicato_val;
		  
		  
		  
		  $numera_datos++;
		  
		
		  
		  ?>
		  
		  <tr>			
			<td class="css_txt" ><?php echo $numera_datos; ?></td>
			<td class="css_txt" ><?php echo $tiporeglab_nombre; ?></td>	
			<td class="css_txt" ><?php echo $tdct_nombre; ?></td>					
			<td class="css_txt" ><?php echo $resultl_empleado->fields["usua_apellido"]." ".$resultl_empleado->fields["usua_nombre"]; ?></td>
			<td class="css_txt" ><?php echo $resultl_empleado->fields["usua_rucci"]; ?></td>
			<td class="css_txt" ><?php echo $tipoinst_nombre; ?></td>
			<td class="css_txt" ><?php echo $tcov_nombre; ?></td>			
			<td class="css_txt" ><?php echo $rmu; ?></td>
			<td class="css_txt" ><?php echo $fondos_re; ?></td>
			<td class="css_txt" ><?php echo $decimo_iii; ?></td>
			<td class="css_txt" ><?php echo $decimo_iv; ?></td>
			<td class="css_txt" ><?php echo $antiguedad_val; ?></td>
			<td class="css_txt" ><?php echo $pasajes_val; ?></td>
			<td class="css_txt" ><?php echo $cargas_val; ?></td>
			<td class="css_txt" ><?php echo $alimentacion_val; ?> </td>
			
			
			
			<?php
			$suma_extras=0;
	$lista_extaras="select distinct rubrg_id,rubrg_nombre from conco_detalleroles where rubrg_id=19 and genr_id='".$genr_id."' and rubrg_ingresoegreso=1";
	$resultl_extras = $DB_gogess->executec($lista_extaras,array());
	if($resultl_extras)
	{
      while (!$resultl_extras->EOF)
		{
		
	      $lista_extarasvalor="select  rubrg_valor from conco_detalleroles where rubrg_nombre='".$resultl_extras->fields["rubrg_nombre"]."' and rubrg_id='".$resultl_extras->fields["rubrg_id"]."' and genr_id='".$genr_id."' and rubrg_ingresoegreso=1 and usua_id='". $resultl_empleado->fields["usua_id"]."'";
		  
	      $resultl_extrasvalor = $DB_gogess->executec($lista_extarasvalor,array());
		  
		  $suma_extras=$suma_extras+$resultl_extrasvalor->fields["rubrg_valor"];
		  
		  echo '<td class="css_txt" >'.$resultl_extrasvalor->fields["rubrg_valor"].'</td>';
		
		 $resultl_extras->MoveNext();
		}
	}	
	
	
	$total_ingresost=$total_ingresos+$suma_extras;
	?>
			
			
			<td class="css_txt" ><?php echo $total_ingresost; ?></td>
			<td class="css_txt" ><?php echo $aportepersonal_val; ?></td>
			<td class="css_txt" ><?php echo $caucion_val; ?></td>
			<td class="css_txt" ><?php echo $conyuge_val; ?></td>
			<td class="css_txt" >&nbsp;</td>
			<td class="css_txt" ><?php echo $anticipos_val; ?></td>
			<td class="css_txt" >&nbsp;</td>
			<td class="css_txt" ><?php echo $hipotecario_val; ?></td>
			<td class="css_txt" ><?php echo $quirografario_val; ?></td>
			<td class="css_txt" ><?php echo $benefica_val; ?></td>
			<td class="css_txt" ><?php echo $sindicato_val; ?></td>
			<td class="css_txt" ><?php echo $supa_val; ?></td>
			
			
		<?php
		$suma_extras2=0;
	$lista_extaras2="select distinct rubrg_id,rubrg_nombre from conco_detalleroles where rubrg_id=19 and genr_id='".$genr_id."' and rubrg_ingresoegreso=2";
	$resultl_extras2 = $DB_gogess->executec($lista_extaras2,array());
	if($resultl_extras2)
	{
      while (!$resultl_extras2->EOF)
		{
		
	      $lista_extarasvalor2="select  rubrg_valor from conco_detalleroles where rubrg_nombre='".$resultl_extras2->fields["rubrg_nombre"]."' and rubrg_id='".$resultl_extras2->fields["rubrg_id"]."' and genr_id='".$genr_id."' and rubrg_ingresoegreso=2 and usua_id='". $resultl_empleado->fields["usua_id"]."'";
		  
	      $resultl_extrasvalor2 = $DB_gogess->executec($lista_extarasvalor2,array());
		  
		  $suma_extras2=$suma_extras2+$resultl_extrasvalor2->fields["rubrg_valor"];
		  
		  echo '<td class="css_txt" >'.$resultl_extrasvalor2->fields["rubrg_valor"].'</td>';
		
		 $resultl_extras2->MoveNext();
		}
	}	
	
	
	$total_egresost=$total_egresos+$suma_extras2;
	
	$neto_recibir=number_format($total_ingresost, 2, '.', '')-number_format($total_egresost, 2, '.', '');
	?>		
			
			
			
			<td class="css_txt" ><?php echo $total_egresost; ?></td>
			<td class="css_txt" ><?php echo $neto_recibir; ?></td>
			<td class="css_txt" ><?php echo $valor_patronal; ?></td>
			
	<?php
			
		  $fondos_re='';
		  $decimo_iii='';
		  $decimo_iv='';		  	 
		   
$busca_ingresos="select conco_acumuladetalleroles.detlroll_id,conco_acumuladetalleroles.roles_id,conco_acumuladetalleroles.rubrg_id,conco_acumuladetalleroles.rubrg_nombre,conco_acumuladetalleroles.rubrg_ingresoegreso,conco_acumuladetalleroles.rubrg_valor,conco_acumuladetalleroles.rubrg_formula,conco_acumuladetalleroles.rubrg_salariominimo,conco_acumuladetalleroles.tipprub_id,conco_acumuladetalleroles.genr_id,conco_acumuladetalleroles.usua_id from conco_acumuladetalleroles inner join conco_rubrosg on conco_acumuladetalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_acumuladetalleroles.rubrg_ingresoegreso=1 and tiporub_id!=1";
		  
		  $resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
		  if($resultl_ingresos)
           {
		       while (!$resultl_ingresos->EOF)
		       {
			    
				  if($resultl_ingresos->fields["rubrg_id"]==2)
				  {
				   $fondos_re='';
				   $fondos_re=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==3)
				  {
				   $decimo_iii='';
				   $decimo_iii=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  
				  if($resultl_ingresos->fields["rubrg_id"]==4)
				  {
				   $decimo_iv='';
				   $decimo_iv=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
				  }
				  				 
				  
				$resultl_ingresos->MoveNext();
		       }
		   }
		   		  
		  //ingresos	
		  $provi_vaca=0;
		  $provi_vaca=$rmu/12;		  
		  $provi_vaca=number_format($provi_vaca, 2, '.', '');
		  
		  
		  
	?>		
	        
			<td class="css_txt" ><?php echo $decimo_iii; ?></td>
			<td class="css_txt" ><?php echo $decimo_iv; ?></td>
			<td class="css_txt" ><?php echo $fondos_re; ?></td>
			<td class="css_txt" ><?php echo $provi_vaca; ?></td>
		  </tr>
		  
		  <?php
		  $total_egresost=0;
		  $total_ingresost=0;
		  $resultl_listaroles->MoveNext();
		}
}		

?>
</table> 
<?php 
}

?>