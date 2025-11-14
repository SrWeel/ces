<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$obj_funciones=new util_funciones();


if($_SESSION['ces1313777_sessid_inicio'])
{


$fecha_hoy=date("Y-m-d");
$genr_id_val=$_POST["genr_id"];

$busca_mesrol="select * from conco_generarroles where genr_id='".$genr_id_val."'";
$rs_mesrol= $DB_gogess->executec($busca_mesrol,array());
$mes_rol=0;
$mes_rol=$rs_mesrol->fields["genr_mes"];

$borra_data="delete from conco_roles where genr_id='".$genr_id_val."'";
$rs_bd= $DB_gogess->executec($borra_data,array());

$borra_data="delete from conco_detalleroles where genr_id='".$genr_id_val."'";
$rs_bd= $DB_gogess->executec($borra_data,array());

$cuenta_d=0;
//lista clientes
$busca_clientes="select * from app_cliente inner join grid_infolaboral3 on app_cliente.clie_enlace=grid_infolaboral3.standar_enlace where (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc";
$rs_listaclientes= $DB_gogess->executec($busca_clientes,array());

if($rs_listaclientes)
{
      while (!$rs_listaclientes->EOF)
		{

//datos generales

//
			
			//================================================================
$info_rmu=0;
if($rs_listaclientes->fields["info_rmu"]>0)
{
$info_rmu=$rs_listaclientes->fields["info_rmu"];
}
			
$anio_mes=$obj_funciones->calcular_tiempoaniomes($rs_listaclientes->fields["info_fechaingreso"],$fecha_hoy);			
			
$bu_empresa="select * from app_empresa where emp_id='".$rs_listaclientes->fields["emp_id"]."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array());
$emp_salariominimo=$rs_bempresa->fields["emp_salariominimo"];

//$busca_valor="select * from conco_rubrosg left join grid_parametrosrubros4 on conco_rubrosg.rubrg_enlace=grid_parametrosrubros4.standar_enlace where para_grupoocupacional='".$rs_listaclientes->fields["info_grupoocupacional"]."' and para_regimenlaboral='".$rs_listaclientes->fields["info_regimenlaboral"]."' and tiporub_id=1";
			
$busca_valor="select * from conco_rubrosg left join grid_parametrosrubros4 on conco_rubrosg.rubrg_enlace=grid_parametrosrubros4.standar_enlace where para_grupoocupacional='".$rs_listaclientes->fields["info_grupoocupacional"]."'  and tiporub_id=1";

$rs_sueldo=$DB_gogess->executec($busca_valor,array());
$valor_sueldo=0;
$valor_sueldo=$rs_sueldo->fields["para_valor"];

if(!($valor_sueldo))
{
$busca_valor="select * from conco_rubrosg where rubrg_activo=1 and tiporub_id=1";
$rs_sueldo=$DB_gogess->executec($busca_valor,array()); 
$valor_sueldo=0;
$valor_sueldo=$rs_sueldo->fields["rubrg_valor"];
}
			
			//================================================================			
			
			$genr_id=$genr_id_val;
			$clie_id=$rs_listaclientes->fields["clie_id"];
			$info_unidad=$rs_listaclientes->fields["info_unidad"];
			$info_grupoocupacional=$rs_listaclientes->fields["info_grupoocupacional"];
			$info_puestoinstitucional=$rs_listaclientes->fields["info_puestoinstitucional"];
			$info_regimenlaboral=$rs_listaclientes->fields["info_regimenlaboral"];
			$info_modalidad=$rs_listaclientes->fields["info_modalidad"];
			$info_fechaingreso=$rs_listaclientes->fields["info_fechaingreso"];		
			$info_partidapresupuestaria=$rs_listaclientes->fields["info_partidapresupuestaria"];	
			$info_codigobiometrico=$rs_listaclientes->fields["info_codigobiometrico"];	
			
			if(!($info_rmu))
			{
			$info_rmu=$valor_sueldo;
			}
			
			$info_tipodecontrato=$rs_listaclientes->fields["info_tipodecontrato"];
			$info_fondosdereserva=$rs_listaclientes->fields["info_fondosdereserva"];
			$info_decimotercero=$rs_listaclientes->fields["info_decimotercero"];
			$info_decimocuarto=$rs_listaclientes->fields["info_decimocuarto"];
			
$inserta_rol="insert into conco_roles (genr_id,clie_id,info_unidad,info_grupoocupacional,info_puestoinstitucional,info_regimenlaboral,info_modalidad,info_fechaingreso,info_partidapresupuestaria,info_codigobiometrico,info_rmu,info_tipodecontrato,info_fondosdereserva,info_decimotercero,info_decimocuarto) values ('".$genr_id."','".$clie_id."','".$info_unidad."','".$info_grupoocupacional."','".$info_puestoinstitucional."','".$info_regimenlaboral."','".$info_modalidad."','".$info_fechaingreso."','".$info_partidapresupuestaria."','".$info_codigobiometrico."','".$info_rmu."','".$info_tipodecontrato."','".$info_fondosdereserva."','".$info_decimotercero."','".$info_decimocuarto."')";

$cuenta_d++;
//echo $cuenta_d."-->".$inserta_rol."<br>";

			$rs_irol=$DB_gogess->executec($inserta_rol,array());
			
			//codigo gen
			$nuevo_num=$DB_gogess->funciones_nuevoID(0);
			$roles_id=0;
			$roles_id=$nuevo_num;
			//codigo gen
			
			//echo $inserta_rol."<br>";
			
			//lista_rubros
			$busca_rubros="select * from conco_asiganrubro inner join conco_rubrosg on conco_asiganrubro.rubrg_id=conco_rubrosg.rubrg_id where clie_id='".$clie_id."'";
			$rs_rubros=$DB_gogess->executec($busca_rubros,array());
			if($rs_rubros)
			{
				  while (!$rs_rubros->EOF)
					{
					  
					  //print_r($rs_rubros->fields);
					  $rubrg_id=$rs_rubros->fields["rubrg_id"];
					  $rubrg_nombre='';
					  $rubrg_ingresoegreso='';
					  $rubrg_valor='';
					  $rubrg_formula='';
					  $rubrg_salariominimo='';
					  $tipprub_id=0;
					  
					  switch ($rs_rubros->fields["tiporub_id"]) {
							case 1:
							  {
							   //sueldo
							   //
								$rubrg_id=$rs_rubros->fields["rubrg_id"];
								$rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								$rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
								if($info_rmu>0)
								{
								  $rubrg_valor=$info_rmu;
								}
								else
								{
								  $rubrg_valor=$rs_rubros->fields["rubrg_valor"];
								}
								$rubrg_formula='';
								$rubrg_salariominimo=$emp_salariominimo;
								$tipprub_id=0;
							   //sueldo	
							  }							  	
								break;
							case 2:
								{
								 //Fondos de reserva
								 if($info_fondosdereserva==1)
								 {
								     //rol de pagos
									 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 
									 $antiguedad=$anio_mes["anio"];
									 $sueldo=$valor_sueldo;
									 //formula
									 if($antiguedad>=1)
									 {
									     $sueldo=$valor_sueldo*0.0833;
									 }
									 //formula
									 
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];
								     $rubrg_valor=$sueldo;								 
								     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;								 
									 //rol de pagos
								 }
								 if($info_fondosdereserva==2)
								 {
								    //acumulado iess
									 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];									 
									 $rubrg_formula='';	
									 $rubrg_valor=0;						     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;										
									//acumulado iess
								 }
								 if($info_fondosdereserva==3)
								 {
								    //no aplica
									 $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];									 
									 $rubrg_formula='';	
									 $rubrg_valor=0;						     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;	
									//no aplica
								 }
								 //Fondos de reserva
								}
								break;
							case 3:
								{
								//Decimo Tercero
								//obtiene todos los sueldos del anio
								$anioac=date("Y");
								$lista_valoressueldos="select sum(roles_valorapagar) as totalsueldos  from conco_generarroles inner join conco_roles on conco_generarroles.genr_id=conco_roles.genr_id where clie_id='".$clie_id."' and genr_anio='".$anioac."'";
								$rs_lvtotalsueldos=$DB_gogess->executec($lista_valoressueldos,array());
								$total_anioactual=0;
								$total_anioactual=$rs_lvtotalsueldos->fields["totalsueldos"];
								
								 if($info_decimotercero==1)
								 {
								  //rolde de pagos
								     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 									 
									 //formula
									 $sueldo=$total_anioactual/12;	
									 $rubrg_valor=$sueldo/12;								 
									 //formula
									 
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];							     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;								 
								  //rolde de pagos
								 }
								 
								 if($info_decimotercero==2)
								 {
								   //acumulado
								     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 									 
									 //formula
									 $sueldo=0;
									 if($rs_rubros->fields["mes_id"]==$mes_rol)
									 {
									 $sueldo=$total_anioactual/12;									 								 
									 }
									 //formula
									 
									 $rubrg_valor=$sueldo;
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];							     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;	
								   
								   //acumulado
								 }
								 
								//obtiene todos los sueldos del anio
								
								if($info_decimotercero==3)
								 {
								     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 									 
									 //formula
									 $sueldo=0;									 
									 //formula									 
									 $rubrg_valor=$sueldo;
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];							     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;	
								 
								 }
								
								//Decimo Tercero								
								}
								break;
						    case 4:
								{
								//Decimo Cuarto
								
								if($info_decimocuarto==1)
								 {
								  //rolde de pagos
								     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 									 
									 //formula
									 $sueldo=$total_anioactual/12;	
									 $rubrg_valor=$sueldo/12;								 
									 //formula
									 
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];							     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;								 
								  //rolde de pagos
								 }
								 
								 if($info_decimocuarto==2)
								 {
								   //acumulado
								     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 									 
									 //formula
									 $sueldo=0;
									 if($rs_rubros->fields["mes_id"]==$mes_rol)
									 {
									 $sueldo=$total_anioactual/12;									 								 
									 }
									 //formula
									 
									 $rubrg_valor=$sueldo;
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];							     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;	
								   
								   //acumulado
								 }
								 
								//obtiene todos los sueldos del anio
								
								if($info_decimocuarto==3)
								 {
								     $rubrg_id=$rs_rubros->fields["rubrg_id"];
								     $rubrg_nombre=$rs_rubros->fields["rubrg_nombre"];
								     $rubrg_ingresoegreso=$rs_rubros->fields["rubrg_ingresoegreso"];
									 									 
									 //formula
									 $sueldo=0;									 
									 //formula									 
									 $rubrg_valor=$sueldo;
									 $rubrg_formula=$rs_rubros->fields["rubrg_formula"];							     
								     $rubrg_salariominimo=$emp_salariominimo;	
									 $tipprub_id=$info_fondosdereserva;	
								 
								 }
								
								
								
								//Decimo Cuarto								
								}
								break;		
								
						}
					  
					  
					  $insert_detallerol="insert into conco_detalleroles (roles_id,rubrg_id,rubrg_nombre,rubrg_ingresoegreso,rubrg_valor,rubrg_formula,rubrg_salariominimo,genr_id,clie_id) values ('".$roles_id."','".$rubrg_id."','".$rubrg_nombre."','".$rubrg_ingresoegreso."','".$rubrg_valor."','".$rubrg_formula."','".$rubrg_salariominimo."','".$genr_id_val."','".$clie_id."')";
					  
					  $rs_detallerol=$DB_gogess->executec($insert_detallerol,array());
					  
					  //echo $insert_detallerol."<br>";
					  
					
					$rs_rubros->MoveNext();
					}
			}		
			
			//lista_rubros
			
			
			
			$rs_listaclientes->MoveNext();
		}
}		


//lista clientes
echo "<center>Generado con exito...De clic en el grafico para descargar el rol<br>";


}

?>