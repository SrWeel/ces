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
$mes[8]='SEPTIEMBRE';
$mes[10]='OCTUBRE';
$mes[11]='NOVIEMBRE';
$mes[12]='DICIEMBRE';

?>
<table height="165" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="95" width="67">No.</td>
    <td width="86">NOMBRE</td>
    <td width="86">N&ordm;.CED.</td>
    <td width="86">CARGO</td>
    <td width="79">RMU</td>
    <td width="74">FONDO DE RESERVA    OCTUBRE</td>
    <td width="68">XIII</td>
    <td width="67">XIV</td>
    <td width="67">Antig&uuml;edad 0.25%</td>
    <td width="78">PASAJE 0.50</td>
    <td width="69">CARGAS    FAMILIARES&nbsp; 1% DEL S/B&nbsp; $ 4.00 x C/D NI&Ntilde;O</td>
    <td width="68">ALIMENTACION $ 4    X DIA TRABAJADO</td>
    <td width="72">TOTAL INGRESOS</td>
    <td width="65">APORTE PERSONAL</td>
    <td width="64">CAUCI&Oacute;N</td>
    <td width="55">APORTE CONYUGE</td>
    <td width="79">DTOS JUDIC</td>
    <td width="75">ANT. SUELDO    DEC.EJEC. 1710</td>
    <td width="78">CONCILIACION</td>
    <td width="75">PREST. HIPOT.</td>
    <td width="75">PREST. QUIROG</td>
    <td width="73">BENEFICA</td>
    <td width="73">CUOTAS SINDICATO</td>
	<?php
	//$busca_ingresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."' and conco_detalleroles.rubrg_ingresoegreso=1 and tiporub_id!=1";
	//$resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
	
	
	?>
    <td width="68">TOTAL EGRESOS</td>
    <td width="75">NETO A RECIBIR</td>
    <td width="65">APORTE PATRON.</td>
	
	
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
				  
				  if($resultl_egresos->fields["rubrg_id"]==20)
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
		  
		  
		  $total_ingresos=0;
		  $total_ingresos=$fondos_re+$decimo_iii+$decimo_iv+$antiguedad_val+$pasajes_val+$cargas_val+$alimentacion_val+$rmu;
		  
		  $total_egresos=0;
		  $total_egresos=$aportepersonal_val+ $caucion_val+$conyuge_val+$anticipos_val+$hipotecario_val+$quirografario_val+$benefica_val+$sindicato_val;
		  
		  $neto_recibir=$total_ingresos-$total_egresos;
		  
		  $numera_datos++;
		  
		
		  
		  ?>
		  
		  <tr>
			<td><?php echo $numera_datos; ?></td>
			<td><?php echo $resultl_empleado->fields["usua_apellido"]." ".$resultl_empleado->fields["usua_nombre"]; ?></td>
			<td><?php echo $resultl_empleado->fields["usua_rucci"]; ?></td>
			<td><?php echo utf8_encode($tipoinst_nombre); ?></td>
			<td><?php echo $rmu; ?></td>
			<td><?php echo $fondos_re; ?></td>
			<td><?php echo $decimo_iii; ?></td>
			<td><?php echo $decimo_iv; ?></td>
			<td><?php echo $antiguedad_val; ?></td>
			<td><?php echo $pasajes_val; ?></td>
			<td><?php echo $cargas_val; ?></td>
			<td><?php echo $alimentacion_val; ?> </td>
			<td><?php echo $total_ingresos; ?></td>
			<td><?php echo $aportepersonal_val; ?></td>
			<td><?php echo $caucion_val; ?></td>
			<td><?php echo $conyuge_val; ?></td>
			<td>&nbsp;</td>
			<td><?php echo $anticipos_val; ?></td>
			<td>&nbsp;</td>
			<td><?php echo $hipotecario_val; ?></td>
			<td><?php echo $quirografario_val; ?></td>
			<td><?php echo $benefica_val; ?></td>
			<td><?php echo $sindicato_val; ?></td>
			<td><?php echo $total_egresos; ?></td>
			<td><?php echo $neto_recibir; ?></td>
			<td><?php echo $valor_patronal; ?></td>
		  </tr>
		  
		  <?php
		  $resultl_listaroles->MoveNext();
		}
}		

?>
</table> 
<?php 
}

?>