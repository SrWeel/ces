<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
date_default_timezone_set("America/Guayaquil");

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();
$obj_funciones=new util_funciones();

$fecha_hoy=date("Y-m-d");
$genr_id_val=$_POST["genr_id"];

$busca_mesrol="select * from conco_generarroles where genr_id='".$genr_id_val."'";
$rs_mesrol= $DB_gogess->executec($busca_mesrol,array());
$mes_rol=0;
$anio_rol=0;
$mes_rol=$rs_mesrol->fields["genr_mes"];
$anio_rol=$rs_mesrol->fields["genr_anio"];
$fecha_cierre='';
$fecha_cierre=$rs_mesrol->fields["genr_fechacierre"];

//fecha que se hace rol que por lo general es ultimo dia de mes
$solofecha_cierre=array();
$solofecha_cierre=explode(" ",$rs_mesrol->fields["genr_fechacierre"]);
$genr_fechacierre=$solofecha_cierre[0];

//borra_rol_regenerar
$borra_data="delete from conco_roles where genr_id='".$genr_id_val."'";
$rs_bd= $DB_gogess->executec($borra_data,array());
$borra_data="delete from conco_detalleroles where genr_id='".$genr_id_val."'";
$rs_bd= $DB_gogess->executec($borra_data,array());
$borra_data="delete from conco_acumuladetalleroles where genr_id='".$genr_id_val."'";
$rs_bd= $DB_gogess->executec($borra_data,array());
//borra_rol_regenerar

$antiguedad=0;
$cuenta_d=0;
//lista_empleados

//$busca_clientes="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where (info_fechadesalida='0000-00-00' or info_fechadesalida is null) and info_fechaingreso<='".$genr_fechacierre."' and usua_id in (261) order by usua_apellido asc";
$busca_clientes="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where (info_fechadesalida='0000-00-00' or info_fechadesalida is null) and info_fechaingreso<='".$genr_fechacierre."' and usua_estado=1 order by usua_apellido asc";

$rs_listaclientes= $DB_gogess->executec($busca_clientes,array());

if($rs_listaclientes)
{
      while (!$rs_listaclientes->EOF)
		{
		   $usua_id=$rs_listaclientes->fields["usua_id"];
		   $emp_id=$rs_listaclientes->fields["emp_id"];
		   //obtiene sueldo antiguedad
		   $antiguedad=0;
		   $antiguedad=$obj_funciones->caculo_antiguedad($genr_fechacierre,$usua_id,$DB_gogess);
		   $sueldo=0;
		   $sueldo=$obj_funciones->obtiene_sueldo($genr_fechacierre,$anio_rol,$mes_rol,$emp_id,$usua_id,$DB_gogess);
		   $s_minimo=0;
		   $s_minimo=$obj_funciones->salario_minimo($emp_id,$DB_gogess);
		   //obtiene sueldo antiguedad
		   
		   //obtiene regimen laboral
		   //1 LOSEP 
		   //2 CODIGO DE TRABAJO 
		   //3 JUBILADOS 
		   $regimen_laboralid=$obj_funciones->obtiene_regimenlaboral($genr_fechacierre,$anio_rol,$mes_rol,$emp_id,$usua_id,$DB_gogess);
		   
		   //obtiene regimen laboral
		   
		   //datos generales a registrar		   
		    $genr_id=$genr_id_val;
			$info_unidad=$rs_listaclientes->fields["info_unidad"];
			$info_grupoocupacional=$rs_listaclientes->fields["info_grupoocupacional"];
			$info_puestoinstitucional=$rs_listaclientes->fields["info_puestoinstitucional"];
			$info_regimenlaboral=$rs_listaclientes->fields["info_regimenlaboral"];
			$info_modalidad=$rs_listaclientes->fields["info_modalidad"];
			$info_fechaingreso=$rs_listaclientes->fields["info_fechaingreso"];		
			$info_partidapresupuestaria=$rs_listaclientes->fields["info_partidapresupuestaria"];	
			$info_codigobiometrico=$rs_listaclientes->fields["info_codigobiometrico"];	
			$info_tipodecontrato=$rs_listaclientes->fields["info_tipodecontrato"];
			$info_fondosdereserva=$rs_listaclientes->fields["info_fondosdereserva"];
			$info_decimotercero=$rs_listaclientes->fields["info_decimotercero"];
			$info_decimocuarto=$rs_listaclientes->fields["info_decimocuarto"];
			$info_rmu=$sueldo;	
			//datos de form de pago de rubro
			$info_tipodecontrato=$rs_listaclientes->fields["info_tipodecontrato"];
			$info_fondosdereserva=$rs_listaclientes->fields["info_fondosdereserva"];
			$info_decimotercero=$rs_listaclientes->fields["info_decimotercero"];
			$info_decimocuarto=$rs_listaclientes->fields["info_decimocuarto"];
			//datos de form de pago de rubro			
		   //inserta cabecera rol
		   	$inserta_rol="insert into conco_roles (genr_id,usua_id,info_unidad,info_grupoocupacional,info_puestoinstitucional,info_regimenlaboral,info_modalidad,info_fechaingreso,info_partidapresupuestaria,info_codigobiometrico,info_rmu,info_tipodecontrato,info_fondosdereserva,info_decimotercero,info_decimocuarto,roles_mes,roles_anio) values ('".$genr_id."','".$usua_id."','".$info_unidad."','".$info_grupoocupacional."','".$info_puestoinstitucional."','".$info_regimenlaboral."','".$info_modalidad."','".$info_fechaingreso."','".$info_partidapresupuestaria."','".$info_codigobiometrico."','".$info_rmu."','".$info_tipodecontrato."','".$info_fondosdereserva."','".$info_decimotercero."','".$info_decimocuarto."','".$mes_rol."','".$anio_rol."')";
			$rs_irol=$DB_gogess->executec($inserta_rol,array());
			$nuevo_num=$DB_gogess->funciones_nuevoID(0);
			$roles_id=0;
			$roles_id=$nuevo_num;
		   //inserta cabecera rol		
		   //datos generales a registrar
		   
		   //echo $antiguedad."<br>";
		   //echo $sueldo."<br>";
		   //echo $s_minimo."<br>";
		  
		    //lista_rubros
			 $busca_rubros="select * from conco_asiganrubro inner join conco_rubrosg on conco_asiganrubro.rubrg_id=conco_rubrosg.rubrg_id where conco_asiganrubro.usua_id='".$usua_id."' and rubrg_activo=1";
			$rs_rubros=$DB_gogess->executec($busca_rubros,array());
			if($rs_rubros)
			{
				  while (!$rs_rubros->EOF)
					{
					
					  $rubrg_id=$rs_rubros->fields["rubrg_id"];
					  $rubrg_nombre='';
					  $rubrg_ingresoegreso='';
					  $rubrg_valor=0;
					  $rubrg_valoracumula=0;
					  
					  $rubrg_formula='';
					  $rubrg_salariominimo='';
					  $tipprub_id=0;
					  $valor_anticipo=0;
					  $valor_decimo=0;
					  
					  $valor_decimoacumula=0;
					  
					  $valor_fondoacumula=0;
					  
					  $valor_fondo=0;
					  $valor_iess=0;
					  //tiporub_id
					  //1 SUELDO
					  //2 FONDOS DE RESERVA
					  //3 DECIMO TERCERO
					  //4 DECIMO CUARTO
					  //99 OTROS
					   switch ($rs_rubros->fields["tiporub_id"]) {
							case 1:
							  {
								 //sueldo
								 //
							     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								 $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								 $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								 $rubrg_valor=$sueldo;								
								 $rubrg_formula='';
								 $rubrg_salariominimo=$s_minimo;
								 $tipprub_id=0;
								 //sueldo	
							  }							  	
							  break;							  
							  case 2:
							  {
							     
								 //fondos de reserva
								 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								 $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								 $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
                                 $obj_funciones->mes_rolp=$solofecha_cierre[1];		
								 
								 
								 $obj_funciones->mesrol=$mes_rol;
								 				 
								 $valor_fondo=$obj_funciones->saca_fondodereserva($info_fondosdereserva,$antiguedad,$sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);		
								 
								 $valor_fondoacumula=$obj_funciones->saca_acumulafondodereserva($info_fondosdereserva,$antiguedad,$sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);	
								 						
								 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								 $rubrg_valor=$valor_fondo;	
								 
								 $rubrg_valoracumula=$valor_fondoacumula;
								 						     
								 $rubrg_salariominimo=$s_minimo;	
								 $tipprub_id=$info_fondosdereserva;								
								 //fondos de reserva							     
							  }
							  break;
							  
							  case 5:
							  {
							     //IESS
								 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								 $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								 $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];									 
								 $valor_iess=$obj_funciones->saca_iess($regimen_laboralid,$antiguedad,$sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);								
								 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								 $rubrg_valor=$valor_iess;							     
								 $rubrg_salariominimo=$s_minimo;	
								 $tipprub_id=0;									 							
								 //IESS							     
							  }
							  break;
							  
							  case 4:
							  {
							     //decimo cuarto
								 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								 $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								 $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								 $valor_decimo=$obj_funciones->saca_decimocuarto($anio_rol,$mes_rol,$sueldo,$s_minimo,$info_decimocuarto,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$DB_gogess);
								 
								 $valor_decimoacumula=$obj_funciones->saca_acumuladecimocuarto($anio_rol,$mes_rol,$sueldo,$s_minimo,$info_decimocuarto,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);
								 
								 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								 $rubrg_valor=$valor_decimo;	
								 $rubrg_valoracumula=$valor_decimoacumula;	
								 						     
								 $rubrg_salariominimo=$s_minimo;	
								 $tipprub_id=$info_decimocuarto;								
								 //decimo cuarto							     
							  }
							  break;
							  
							  case 3:
							  {
							     //decimo tercero
								 $s_extras=0;
								 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								 $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								 $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								 $valor_decimo=$obj_funciones->saca_decimotercero($anio_rol,$mes_rol,$sueldo,$s_minimo,$s_extras,$info_decimotercero,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);
								 
								 $valor_decimoacumula=$obj_funciones->saca_acumuladecimotercero($anio_rol,$mes_rol,$sueldo,$s_minimo,$s_extras,$info_decimotercero,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);
								 
								 
								 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								 $rubrg_valor=$valor_decimo;	
								 
								 $rubrg_valoracumula=$valor_decimoacumula;
								 						     
								 $rubrg_salariominimo=$s_minimo;	
								 $tipprub_id=$info_decimotercero;								 
							     //decimo tercero
							  }
							  break;
							  
							  case 6:
							  {
							    //anticipos								
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_anticiposueldo($anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$DB_gogess);
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //anticipos
							  }
							  break;
							  
							  case 7:
							  {
							    //quirografario							
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_quirografario($anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);								
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //quirografario
							  }
							  break;
							  
							  case 9:
							  {
							    //hipotecario							
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_hipotecario($anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);								
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //hipotecario
							  }
							  break;		  
							  
							 case 10:
							  {
							    //antiguedad							
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_antiguedad($regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //antiguedad
							  }
							  break;
							  
							  
							  case 11:
							  {
							    //pasajes	
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_pasajes($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //pasajes
							  }
							  break;
							  
							  case 12:
							  {
							    //cargas familiares	
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_cargasf($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //cargas familiares
							  }
							  break;
							  
							  
							  case 13:
							  {
							    //alimentacion
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_alimentacion($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //alimentacion
							  }
							  break;
							  
							  
							  case 14:
							  {
							    //aporte conyuge
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_conyuge($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //aporte conyuge
							  }
							  break;
							  
							  case 15:
							  {
							    //sindicato
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_sindicato($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //sindicato
							  }
							  break;
							  
							  case 16:
							  {
							     //IESS
								 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								 $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								 $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];									 
								 $valor_iess=$obj_funciones->saca_iesspatronal($regimen_laboralid,$antiguedad,$sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess);								
								 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								 $rubrg_valor=$valor_iess;							     
								 $rubrg_salariominimo=$s_minimo;	
								 $tipprub_id=0;									 							
								 //IESS							     
							  }
							  break;
							  
							   case 17:
							  {
							    //benefica
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_benefica($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //benefica
							  }
							  break;							  
							  
							  case 18:
							  {
							    //asociacion
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_asociacion($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //asociacion
							  }
							  break;
							  
							  case 19:
							  {
							    //valores extras
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$tipprub_id=0;								
								$obj_funciones->saca_valoresextras($roles_id,$rubrg_id,$s_minimo,$genr_id_val,$tipprub_id,$anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$DB_gogess);
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];															     
								$rubrg_salariominimo=$s_minimo;	
								$rubrg_valor=0;
							    //valores extras
							  }
							  break;
							  
							  case 20:
							  {
							    //supa
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_supa($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //supa
							  }
							  break;
							  
							   case 21:
							  {
							    //optica
								$tiporub_idval=$rs_rubros->fields["tiporub_id"];
												
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$obj_funciones->saca_optica($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess);							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
							    //optica
							  }
							  break;
							  
							  
							  case 22:
							  {
							    //valores extras
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$tipprub_id=0;								
								$obj_funciones->saca_horasextras($roles_id,$rubrg_id,$s_minimo,$genr_id_val,$tipprub_id,$anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$DB_gogess);
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];															     
								$rubrg_salariominimo=$s_minimo;	
								$rubrg_valor=0;
							    //valores extras
							  }
							  break;
							  
							  case 23:
							  {
							    //valores vacaciones
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$tipprub_id=0;		
														
								$rubrg_valoracumula=$obj_funciones->saca_vacaciones($roles_id,$rubrg_id,$s_minimo,$genr_id_val,$tipprub_id,$anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$sueldo,$DB_gogess);
								
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];															     
								$rubrg_salariominimo=$s_minimo;	
								$rubrg_valor=0;
							    //valores vacaciones
							  }
							  break;
							  
							  
							  case 99:
							  {
							    //otros	
                                if($rs_rubros->fields["mes_id"]==13)
								{								
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								$valor_anticipo=$rs_rubros->fields["rubrg_valor"];							
								$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								$rubrg_valor=$valor_anticipo;							     
								$rubrg_salariominimo=$s_minimo;	
								$tipprub_id=0;
								}
								else
								{
									  if($rs_rubros->fields["mes_id"]==$mes_rol)
									  {
										$rubrg_id=$rs_rubros->fields["rubrg_id"];
										$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
										$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
										$valor_anticipo=$rs_rubros->fields["rubrg_valor"];							
										$rubrg_formula=$rs_rubros->fields["rubrg_formula"];
										$rubrg_valor=$valor_anticipo;							     
										$rubrg_salariominimo=$s_minimo;	
										$tipprub_id=0;  
										  										  
									  }	  
									
									
								}
							    //otros
							  }
							  break;
							  
							  
							  
						}		
					  
					  
					  //registra rubro 
					  if($rubrg_valor>0)
					  {
					 $insert_detallerol="insert into conco_detalleroles (roles_id,rubrg_id,rubrg_nombre,rubrg_ingresoegreso,rubrg_valor,rubrg_formula,rubrg_salariominimo,genr_id,usua_id,tipprub_id) values ('".$roles_id."','".$rubrg_id."','".$rubrg_nombre."','".$rubrg_ingresoegreso."','".$rubrg_valor."','".$rubrg_formula."','".$s_minimo."','".$genr_id_val."','".$usua_id."','".$tipprub_id."')";
					  //echo $insert_detallerol."<br>";
					  $rs_detallerol=$DB_gogess->executec($insert_detallerol,array());
					  }
					  //registra rubro
					  
					  //acumula
					  if($rubrg_valoracumula>0)
					  {
					 $insert_detallerol="insert into conco_acumuladetalleroles (roles_id,rubrg_id,rubrg_nombre,rubrg_ingresoegreso,rubrg_valor,rubrg_formula,rubrg_salariominimo,genr_id,usua_id,tipprub_id) values ('".$roles_id."','".$rubrg_id."','".$rubrg_nombre."','".$rubrg_ingresoegreso."','".$rubrg_valoracumula."','".$rubrg_formula."','".$s_minimo."','".$genr_id_val."','".$usua_id."','".$tipprub_id."')";
					  //echo $insert_detallerol."<br>";
					  $rs_detallerol=$DB_gogess->executec($insert_detallerol,array());
					  }					  
					  //acumula	
					  
					
					  $rs_rubros->MoveNext();
					}
			}		
		  
		   
		   
		   $cuenta_d++;
		   
		   
		   $rs_listaclientes->MoveNext();
		}
}		

//lista_empleados

echo $cuenta_d.": Roles Generados...<br>";


}


?>
