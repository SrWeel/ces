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

$genr_id_val=$_POST["genr_id"];

$borra_data="delete from conco_roles where genr_id='".$genr_id_val."'";
$rs_bd= $DB_gogess->executec($borra_data,array());

//lista clientes
$busca_clientes="select * from app_cliente inner join grid_infolaboral3 on app_cliente.clie_enlace=grid_infolaboral3.standar_enlace where info_fechadesalida='0000-00-00' order by info_id desc";
$rs_listaclientes= $DB_gogess->executec($busca_clientes,array());

if($rs_listaclientes)
{
      while (!$rs_listaclientes->EOF)
		{
			
			//================================================================
			
$busca_valor="select * from conco_rubrosg left join grid_parametrosrubros4 on conco_rubrosg.rubrg_enlace=grid_parametrosrubros4.standar_enlace where para_grupoocupacional='".$rs_listaclientes->fields["info_grupoocupacional"]."' and para_regimenlaboral='".$rs_listaclientes->fields["info_regimenlaboral"]."' and 	tiporub_id=1";

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
			$info_rmu=$valor_sueldo;
			$info_tipodecontrato=$rs_listaclientes->fields["info_tipodecontrato"];
			$info_fondosdereserva=$rs_listaclientes->fields["info_fondosdereserva"];
			$info_decimotercero=$rs_listaclientes->fields["info_decimotercero"];
			$info_decimocuarto=$rs_listaclientes->fields["info_decimocuarto"];
			
			$inserta_rol="insert into conco_roles (genr_id,clie_id,info_unidad,info_grupoocupacional,info_puestoinstitucional,info_regimenlaboral,info_modalidad,info_fechaingreso,info_partidapresupuestaria,info_codigobiometrico,info_rmu,info_tipodecontrato,info_fondosdereserva,info_decimotercero,info_decimocuarto) values ('".$genr_id."','".$clie_id."','".$info_unidad."','".$info_grupoocupacional."','".$info_puestoinstitucional."','".$info_regimenlaboral."','".$info_modalidad."','".$info_fechaingreso."','".$info_partidapresupuestaria."','".$info_codigobiometrico."','".$info_rmu."','".$info_tipodecontrato."','".$info_fondosdereserva."','".$info_decimotercero."','".$info_decimocuarto."')";
			//$rs_irol=$DB_gogess->executec($inserta_rol,array());
			//echo $inserta_rol."<br>";
			
			//lista_rubros
			$busca_rubros="select * from conco_asiganrubro inner join conco_rubrosg on conco_asiganrubro.rubrg_id=conco_rubrosg.rubrg_id where clie_id='".$clie_id."'";
			$rs_rubros=$DB_gogess->executec($busca_rubros,array());
			if($rs_rubros)
			{
				  while (!$rs_rubros->EOF)
					{
					  
					  print_r($rs_rubros->fields);
					
					$rs_rubros->MoveNext();
					}
			}		
			
			//lista_rubros
			
			
			
			$rs_listaclientes->MoveNext();
		}
}		


//lista clientes


}

?>