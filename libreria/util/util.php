<?php
/**
 * Util Funciones
 * 
 * Este archivo permite obtener funciones standar para el sistema.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package util_funciones
 */

class util_funciones{

public $horassueltas=array();
var $camposlike;
var $campostxt;
var $mesrol;


function seleccion_genero($clie_genero)
{

  $genero_valor='';
  if($clie_genero=='M')
	{
	  $genero_valor='H';
	}
  if($clie_genero=='F')
	{
	  $genero_valor='M';
	}

return $genero_valor;


}

function seleccion_generonombre($clie_genero)
{

  $genero_valor='';
  if($clie_genero=='M')
	{
	  $genero_valor='HOMBRE';
	}
  if($clie_genero=='F')
	{
	  $genero_valor='MUJER';
	}

return $genero_valor;


}

function selecciona_institucion($conve_id)
{

    $institucion_valor='PRIVADO';
	if($conve_id==7 or $conve_id==27 or $conve_id==28)
	{
	  $institucion_valor='RED P&Uacute;BLICA';
	}
 
   return $institucion_valor;
}

function selecciona_nacionalidad($nac_id,$DB_gogess)
{
  $txt_nacionalidad='';
  $busca_nac="select * from cesdb_arcombos.dns_nacionalidad where nac_id='".$nac_id."'";
  $rs_buscanac = $DB_gogess->executec($busca_nac,array());  
  
  if ($rs_buscanac->fields["nac_nacionalidad"])
  {
    $txt_nacionalidad=$rs_buscanac->fields["nac_nacionalidad"];
  }
  else
  {
    $txt_nacionalidad=$rs_buscanac->fields["nac_nombre"];
  }
  
  return $txt_nacionalidad;
}


function llena_plantilladata($leeplantilla,$table,$DB_gogess,$objformulario,$lista_data)
{

$busca_g="select distinct * from gogess_sisfield where tab_name='".$table."'";
$rs_buscag = $DB_gogess->executec($busca_g,array());
if($rs_buscag)
   {
	  while (!$rs_buscag->EOF) {
	  
	  $separa_fechaig=array();	
	  
	  if ($rs_buscag->fields["fie_value"]=="replace")
					 {
						  $valorbus=$lista_data->fields[$rs_buscag->fields["fie_name"]];
						  $rmp=$objformulario->replace_cmb($rs_buscag->fields["fie_tabledb"],$rs_buscag->fields["fie_datadb"],$rs_buscag->fields["fie_sql"],$valorbus,$DB_gogess); 
						  $leeplantilla=str_replace("-".$rs_buscag->fields["fie_name"]."-",$rmp,$leeplantilla);
					 }
					 else
					 {					 
					 
						 if($rs_buscag->fields["fie_typeweb"]=='tiempobloque')
							{
							   $separa_fecha=array();
							   $separa_fecha=explode("-",$lista_data->fields[$rs_buscag->fields["fie_name"]]);					   
							   $rmp=@$separa_fecha[0]." a&ntilde;os ".@$separa_fecha[1]." meses";
							}
							else
							{
								   if($rs_buscag->fields["fie_typeweb"]=='checkbox_peke')
								   {
										if($lista_data->fields[$rs_buscag->fields["fie_name"]]==1)
										{
										$rmp='<img src="visto_dns.png" width="20" height="18" />';
										}
										else
										{
										$rmp='';
										}
								   }
								   else
								   {
								   @$rmp=$lista_data->fields[$rs_buscag->fields["fie_name"]];  
								   }
								   
							}
					 
						 $leeplantilla=str_replace("-".$rs_buscag->fields["fie_name"]."-",$rmp,$leeplantilla);
					 
					 }
	  
	  $rs_buscag->MoveNext();
	  }
   }	 
   
return $leeplantilla;

}

function caculo_antiguedad($fechacierre,$usua_id,$DB_gogess)
{

$fecha_hoy=date("Y-m-d");
$fecha_hoy=$fechacierre;
$antiguedad=0;
$busca_clientes="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
$rs_listaclientes= $DB_gogess->executec($busca_clientes,array());
$anio_mes=$this->calcular_tiempoaniomes($rs_listaclientes->fields["info_fechaingreso"],$fecha_hoy);
$antiguedad=$anio_mes["anio"];
return $antiguedad;

}


function calcular_tiempoaniomes($fechan,$fechafin){

$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;
$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;
$resultado["anio"]=$valor_anio;
$resultado["mes"]=round($valor_mes);
return $resultado;

}


function obtiene_sueldo($genr_fechacierre,$anio_rol,$mes_rol,$emp_id,$usua_id,$DB_gogess)
{

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array());  
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];
    
$busca_sueldo="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
$rs_listasueldo= $DB_gogess->executec($busca_sueldo,array());

$info_fechaingreso=$rs_listasueldo->fields["info_fechaingreso"];


$info_rmu=0;
if($rs_listasueldo->fields["info_rmu"]>0)
{
	$info_rmu=$rs_listasueldo->fields["info_rmu"];
}	
	
$busca_valor="select * from conco_rubrosg left join grid_parametrosrubros4 on conco_rubrosg.rubrg_enlace=grid_parametrosrubros4.standar_enlace where para_grupoocupacional='".$rs_listasueldo->fields["info_grupoocupacional"]."' and tiporub_id=1";

$rs_sueldo=$DB_gogess->executec($busca_valor,array());
$valor_sueldo=0;
$valor_sueldo=$rs_sueldo->fields["para_valor"];

if(!($valor_sueldo))
{
$busca_valor="select * from conco_rubrosg where rubrg_activo=1 and tiporub_id=1";
$rs_sueldor=$DB_gogess->executec($busca_valor,array()); 
$valor_sueldo=0;
$valor_sueldo=$rs_sueldor->fields["rubrg_valor"];
}


if(!($info_rmu))
{
	$info_rmu=$valor_sueldo;
}

$sueldo_valor=0;
$sueldo_valor=$info_rmu;

//verifica si hay que sacar porcentaje de sueldo
$separa_fechai=array();
@$separa_fechai=explode("-",$info_fechaingreso);
@$mes_ingresat=$separa_fechai[1]*1;

//if($clie_id==257)
//{
//  echo $mes_rol;
//}

$n_diastrabajar=0;
$numerod_mesrol=0;
if(($separa_fechai[0]==$anio_rol) and ($mes_ingresat==$mes_rol))
{

 $numerod_mesrol = cal_days_in_month(CAL_GREGORIAN, $mes_rol,$anio_rol);
 $n_diastrabajar=$this->dias_entrefechas($info_fechaingreso,$genr_fechacierre);
 $n_diastrabajar=$n_diastrabajar+1;
 if($n_diastrabajar<$numerod_mesrol)
 {
   $diario_sueldo=$sueldo_valor/$cfgr_diasmes;
   $proporcional_sueldo=$n_diastrabajar*$diario_sueldo;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');
   
   $sueldo_valor=$proporcional_sueldo;
 }

}

//verifica si hay que sacar porcentaje de sueldo

	
return $sueldo_valor;	

}

function salario_minimo($emp_id,$DB_gogess)
{
    $bu_empresa="select * from app_empresa where emp_id='".$emp_id."'";		
    $rs_bempresa= $DB_gogess->executec($bu_empresa,array());
    $emp_salariominimo=$rs_bempresa->fields["emp_salariominimo"];
	
	return $emp_salariominimo;
}


function obtiene_regimenlaboral($genr_fechacierre,$anio_rol,$mes_rol,$emp_id,$usua_id,$DB_gogess)
{

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array());  
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];
    
$busca_sueldo="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
$rs_listasueldo= $DB_gogess->executec($busca_sueldo,array());

$info_fechaingreso=$rs_listasueldo->fields["info_fechaingreso"];
$info_regimenlaboral=$rs_listasueldo->fields["info_regimenlaboral"];

return $info_regimenlaboral;

}



function saca_fondodereserva($info_fondosdereserva,$antiguedad,$valor_sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{
  
  $fecha_array=explode("-",$genr_fechacierre);
  
  $busca_sueldodata="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
  $rs_sueldodata= $DB_gogess->executec($busca_sueldodata,array());
  
  $info_continuidad=0;
  $info_continuidad=$rs_sueldodata->fields["info_continuidad"];
  
  if($info_continuidad==1)
  {  
    $antiguedad=$antiguedad+1;
  }
  
  //extras
  
 // echo "<br>".$this->mesrol."<br>";
  $bu_vextrast="select sum(asigextr_valor) as extrat from conco_asignaextras where asigextr_afectaiess=1 and tipoie_id=1 and emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigextr_activo=1 and  year(asigextr_fechaaprobacion)='".$fecha_array[0]."' and month(asigextr_fechaaprobacion)='".$fecha_array[1]."'";	
  	
  $rs_vextrast= $DB_gogess->executec($bu_vextrast,array()); 
  
  //echo "<br>".$rs_vextrast->fields["extrat"]."-->".$valor_sueldo."<br>";
  
//horas extras
@$horasextra_valor=0;
$bu_vextrash="select sum(asigrhext_valorhoras) as horasextra  from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$fecha_array[0]."' and asigrhext_mes='".$fecha_array[1]."'";

$rs_vextrash= $DB_gogess->executec($bu_vextrash,array());
@$horasextra_valor=$rs_vextrash->fields["horasextra"];  

//horas extras
  
  
  
  $valor_sueldo=$valor_sueldo+$rs_vextrast->fields["extrat"]+@$horasextra_valor;
  
  //echo $valor_sueldo."<br>";
  //extras
  
  
  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array());  
  $cfgr_parafondosreserva=$rs_bempresa->fields["cfgr_parafondosreserva"];  
  //1.- ROL DE PAGOS
  //2.- ACUMULA
  //3.- NO APLICA  
  
  //busca cambios mes 
  //$busca_asis="select * from grid_fondosdereserva6 where archdt_mes='".$this->mes_rolp."'";
 // echo "<br>".$antiguedad;
  //busca cambios mes
  
  $valor_fondo=0;  
  switch ($info_fondosdereserva) {
	    case 1:
	    {
			if($antiguedad>=1)
			{
			  $valor_fondo=$valor_sueldo*$cfgr_parafondosreserva;
			} 
		}							  	
		break;		
		case 2:
	    {
			$valor_fondo=0;   
		}							  	
		break;
		case 3:
	    {
			$valor_fondo=0;  
		}							  	
		break;		
	}		
    
  return number_format($valor_fondo, 2, '.', '');
  
}



function saca_acumulafondodereserva($info_fondosdereserva,$antiguedad,$valor_sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{

  $fecha_array=explode("-",$genr_fechacierre);
  
  $busca_sueldodata="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
  $rs_sueldodata= $DB_gogess->executec($busca_sueldodata,array());
  
  $info_continuidad=0;
  $info_continuidad=$rs_sueldodata->fields["info_continuidad"];
  
  if($info_continuidad==1)
  {  
    $antiguedad=$antiguedad+1;
  }
  
   //extras
  
 // echo "<br>".$this->mesrol."<br>";
  $bu_vextrast="select sum(asigextr_valor) as extrat from conco_asignaextras where asigextr_afectaiess=1 and tipoie_id=1 and emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigextr_activo=1 and  year(asigextr_fechaaprobacion)='".$fecha_array[0]."' and month(asigextr_fechaaprobacion)='".$fecha_array[1]."'";	
  	
  $rs_vextrast= $DB_gogess->executec($bu_vextrast,array()); 
  
  //echo "<br>".$rs_vextrast->fields["extrat"]."-->".$valor_sueldo."<br>";
  
//horas extras
@$horasextra_valor=0;
$bu_vextrash="select sum(asigrhext_valorhoras) as horasextra  from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$fecha_array[0]."' and asigrhext_mes='".$fecha_array[1]."'";

$rs_vextrash= $DB_gogess->executec($bu_vextrash,array());
@$horasextra_valor=$rs_vextrash->fields["horasextra"];  

//horas extras
  
  
  $valor_sueldo=$valor_sueldo+$rs_vextrast->fields["extrat"]+@$horasextra_valor;
  
  //echo $valor_sueldo."<br>";
  //extras
  
  
  
  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array());  
  $cfgr_parafondosreserva=$rs_bempresa->fields["cfgr_parafondosreserva"];  
  //1.- ROL DE PAGOS
  //2.- ACUMULA
  //3.- NO APLICA  
  //echo $valor_sueldo;
  
  $valor_fondo=0;  
  switch ($info_fondosdereserva) {
	    case 1:
	    {
			$valor_fondo=0; 
		}							  	
		break;		
		case 2:
	    {			
			if($antiguedad>=1)
			{
			  $valor_fondo=$valor_sueldo*$cfgr_parafondosreserva;
			}  
		}							  	
		break;
		case 3:
	    {
			$valor_fondo=0;  
		}							  	
		break;		
	}		
    
  return number_format($valor_fondo, 2, '.', '');
  
}


function saca_iess($regimen_laboralid,$antiguedad,$valor_sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{

//=======================
//GERENCIA GENERAL 17
  $info_unidad=0;
  $busca_sueldodatax="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
  $rs_sueldodatax= $DB_gogess->executec($busca_sueldodatax,array());
  
  $info_unidad=$rs_sueldodatax->fields["info_unidad"];
//=======================

$fecha_array=explode("-",$genr_fechacierre);

echo "Sueldo:".$info_unidad."->".$valor_sueldo."<br>";
    
  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array());  
  $cfgr_porcentajeiess=0;  
  
  switch ($regimen_laboralid) {
    case 1:
	    //losep
        $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_porcentajeiess"];
        break;
    case 2:
	    //codigo trabajo
		if($info_unidad==17)
		{
		 $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_iessgerente"];
		}
		else
		{
        $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_ctiesspersonal"];
		}
		
        break;
    case 3:
	    //juvilados
		if($info_unidad==17)
		{
		 $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_iessgerente"];
		}
		else
		{
        $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_juviesspersonal"];
		}
		
        break;
 }
  
//echo $cfgr_porcentajeiess;  
@$extra_valor=0;
@$horasextra_valor=0;

$bu_vextras="select sum(asigextr_valor) as extra from conco_asignaextras where asigextr_afectaiess=1 and tipoie_id=1 and emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigextr_activo=1 and year(asigextr_fechaaprobacion)='".$fecha_array[0]."' and month(asigextr_fechaaprobacion)='".$fecha_array[1]."'";	

$rs_vextras= $DB_gogess->executec($bu_vextras,array());
@$extra_valor=$rs_vextras->fields["extra"];  

//horas extras

$bu_vextrash="select sum(asigrhext_valorhoras) as horasextra  from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$fecha_array[0]."' and asigrhext_mes='".$fecha_array[1]."'";
$rs_vextrash= $DB_gogess->executec($bu_vextrash,array());

@$horasextra_valor=$rs_vextrash->fields["horasextra"];  

//horas extras
  
  $valor_fondo=0;  
  $valor_fondo=($valor_sueldo+$extra_valor+$horasextra_valor)*$cfgr_porcentajeiess;
		
    
  return number_format($valor_fondo, 2, '.', '');
  
}



function saca_iesspatronal($regimen_laboralid,$antiguedad,$valor_sueldo,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{
  
  //=======================
//GERENCIA GENERAL 17
  $info_unidad=0;
  $busca_sueldodatax="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace where usua_id='".$usua_id."' and (info_fechadesalida='0000-00-00' or info_fechadesalida is null) order by info_id desc limit 1";
  $rs_sueldodatax= $DB_gogess->executec($busca_sueldodatax,array());
  
  $info_unidad=$rs_sueldodatax->fields["info_unidad"];
//=======================


  $fecha_array=explode("-",$genr_fechacierre);
    
  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array());  
  $cfgr_porcentajeiess=0;  
  
  switch ($regimen_laboralid) {
    case 1:
	    //losep
        $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_iesspatronal"];
        break;
    case 2:
	    //codigo trabajo
        $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_ctiesspatronal"];
        break;
    case 3:
	    //juvilados
        $cfgr_porcentajeiess=$rs_bempresa->fields["cfgr_juviesspatronal"];
        break;
 }
  
//echo   $cfgr_porcentajeiess;
  
@$extra_valor=0;
@$horasextra_valor=0;

$bu_vextras="select sum(asigextr_valor) as extra from conco_asignaextras where asigextr_afectaiess=1 and tipoie_id=1 and emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigextr_activo=1 and year(asigextr_fechaaprobacion)='".$fecha_array[0]."' and month(asigextr_fechaaprobacion)='".$fecha_array[1]."'";	

$rs_vextras= $DB_gogess->executec($bu_vextras,array());
@$extra_valor=$rs_vextras->fields["extra"];  

//horas extras

$bu_vextrash="select sum(asigrhext_valorhoras) as horasextra  from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$fecha_array[0]."' and asigrhext_mes='".$fecha_array[1]."'";
$rs_vextrash= $DB_gogess->executec($bu_vextrash,array());

@$horasextra_valor=$rs_vextrash->fields["horasextra"];  

//horas extras
  
  
  $valor_fondo=0;  
  $valor_fondo=($valor_sueldo+$extra_valor+$horasextra_valor)*$cfgr_porcentajeiess;
  
  if($info_unidad==17)
  {
    $valor_fondo=0;
  }
		
  return number_format($valor_fondo, 2, '.', '');
  
}



function saca_totalaniosueldo($anioac,$mesac,$sueldoac,$usua_id,$emp_id,$DB_gogess)
{

$lista_valoressueldos="select sum(roles_valorapagar) as totalsueldos from conco_roles where usua_id='".$usua_id."' and roles_anio='".$anioac."' and roles_mes!='".$mesac."'";
$rs_lvtotalsueldos=$DB_gogess->executec($lista_valoressueldos,array());
$total_anioactual=0;
$total_anioactual=$rs_lvtotalsueldos->fields["totalsueldos"]+$sueldoac;

return $total_anioactual;

}


function dias_entrefechas($fechai,$fechaf)
{

  $fecha1= new DateTime($fechai);
  $fecha2= new DateTime($fechaf);
  $diff = $fecha1->diff($fecha2);

  return $diff->days;
}



function saca_decimocuarto($anio_rol,$mes_rol,$sueldoac,$s_minimo,$info_decimocuarto,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$DB_gogess)
{

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
$cfgr_diasanio=$rs_bempresa->fields["cfgr_diasanio"];
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];
$valor_mes_d4=$s_minimo/$cfgr_diasanio;

//1 ROL DE PAGOS
//2 ACUMULADO
//3 NO APLICA

$separa_fechai=array();
$separa_fechai=explode("-",$info_fechaingreso);
$mes_ingresat=$separa_fechai[1]*1;

$n_diastrabajar=0;
$numerod_mesrol=0;
if(($separa_fechai[0]==$anio_rol) and ($mes_ingresat==$mes_rol))
{

 $numerod_mesrol = cal_days_in_month(CAL_GREGORIAN, $mes_rol,$anio_rol);
 $n_diastrabajar=$this->dias_entrefechas($info_fechaingreso,@$genr_fechacierre);
 if($n_diastrabajar<$numerod_mesrol)
 {
   $proporcional_sueldo=$n_diastrabajar*$valor_mes_d4;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');   
   $sueldo_valor=$proporcional_sueldo;
 }
 else
 { 
   $proporcional_sueldo=$cfgr_diasmes*$valor_mes_d4;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');   
   $sueldo_valor=$proporcional_sueldo;
 }

}
else
{
   $proporcional_sueldo=$cfgr_diasmes*$valor_mes_d4;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');   
   $sueldo_valor=$proporcional_sueldo;
}


//==============================

  $valor_decimo=0;  
  switch ($info_decimocuarto) {
	    case 1:
	    {			
			 $valor_decimo=$sueldo_valor;			
		}							  	
		break;		
		case 2:
	    {
			$valor_decimo=0;   
		}							  	
		break;
		case 3:
	    {
			$valor_decimo=0;  
		}							  	
		break;		
	}	

//==============================
return $valor_decimo;
}



function saca_acumuladecimocuarto($anio_rol,$mes_rol,$sueldoac,$s_minimo,$info_decimocuarto,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
$cfgr_diasanio=$rs_bempresa->fields["cfgr_diasanio"];
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];
$valor_mes_d4=$s_minimo/$cfgr_diasanio;

//1 ROL DE PAGOS
//2 ACUMULADO
//3 NO APLICA

$separa_fechai=array();
$separa_fechai=explode("-",$info_fechaingreso);
$mes_ingresat=$separa_fechai[1]*1;

$n_diastrabajar=0;
$numerod_mesrol=0;
if(($separa_fechai[0]==$anio_rol) and ($mes_ingresat==$mes_rol))
{

 $numerod_mesrol = cal_days_in_month(CAL_GREGORIAN, $mes_rol,$anio_rol);
 $n_diastrabajar=$this->dias_entrefechas($info_fechaingreso,$genr_fechacierre);
 if($n_diastrabajar<$numerod_mesrol)
 {
   $proporcional_sueldo=$n_diastrabajar*$valor_mes_d4;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');   
   $sueldo_valor=$proporcional_sueldo;
 }
 else
 { 
   $proporcional_sueldo=$cfgr_diasmes*$valor_mes_d4;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');   
   $sueldo_valor=$proporcional_sueldo;
 }

}
else
{
   $proporcional_sueldo=$cfgr_diasmes*$valor_mes_d4;
   $proporcional_sueldo=number_format($proporcional_sueldo, 2, '.', '');   
   $sueldo_valor=$proporcional_sueldo;
}


//==============================

  $valor_decimo=0;  
  switch ($info_decimocuarto) {
	    case 1:
	    {			
			$valor_decimo=0;   			
		}							  	
		break;		
		case 2:
	    {
			
			 $valor_decimo=$sueldo_valor;	
		}							  	
		break;
		case 3:
	    {
			$valor_decimo=0;  
		}							  	
		break;		
	}	

//==============================
return $valor_decimo;
}





function saca_decimotercero($anio_rol,$mes_rol,$sueldoac,$s_minimo,$s_extras,$info_decimotercero,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
$cfgr_diasanio=$rs_bempresa->fields["cfgr_diasanio"];
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];

//1 ROL DE PAGOS
//2 ACUMULADO
//3 NO APLICA
//horas extras
$fecha_array=explode("-",$genr_fechacierre);
 
@$horasextra_valor=0;
$bu_vextrash="select sum(asigrhext_valorhoras) as horasextra  from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$fecha_array[0]."' and asigrhext_mes='".$fecha_array[1]."'";

$rs_vextrash= $DB_gogess->executec($bu_vextrash,array());
@$horasextra_valor=$rs_vextrash->fields["horasextra"];  

//horas extras
  

$s_extras=$horasextra_valor;
$sueldo_total=$sueldoac+$s_extras;
$v_mensual=($sueldo_total/360)*30;

//==============================

  $valor_decimo=0;  
  switch ($info_decimotercero) {
	    case 1:
	    {			
			 $valor_decimo=$v_mensual;			
		}							  	
		break;		
		case 2:
	    {
			$valor_decimo=0;   
		}							  	
		break;
		case 3:
	    {
			$valor_decimo=0;  
		}							  	
		break;		
	}	

//==============================  
return number_format($valor_decimo, 2, '.', '');


}



function saca_acumuladecimotercero($anio_rol,$mes_rol,$sueldoac,$s_minimo,$s_extras,$info_decimotercero,$antiguedad,$info_fechaingreso,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
$cfgr_diasanio=$rs_bempresa->fields["cfgr_diasanio"];
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];

//1 ROL DE PAGOS
//2 ACUMULADO
//3 NO APLICA

//horas extras
$fecha_array=explode("-",$genr_fechacierre);
 
@$horasextra_valor=0;
$bu_vextrash="select sum(asigrhext_valorhoras) as horasextra  from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$fecha_array[0]."' and asigrhext_mes='".$fecha_array[1]."'";

$rs_vextrash= $DB_gogess->executec($bu_vextrash,array());
@$horasextra_valor=$rs_vextrash->fields["horasextra"];  

//horas extras
$s_extras=$horasextra_valor;

$sueldo_total=$sueldoac+$s_extras;
$v_mensual=$sueldo_total/12;

//==============================

  $valor_decimo=0;  
  switch ($info_decimotercero) {
	    case 1:
	    {			
			 $valor_decimo=0; 		
		}							  	
		break;		
		case 2:
	    {
			 
			$valor_decimo=$v_mensual; 
		}							  	
		break;
		case 3:
	    {
			$valor_decimo=0;  
		}							  	
		break;		
	}	

//==============================  
return number_format($valor_decimo, 2, '.', '');


}



function calcula_meses($inicio,$fin)
{
	

$datetime1=new DateTime($inicio);
$datetime2=new DateTime($fin);
 
# obtenemos la diferencia entre las dos fechas
$interval=$datetime2->diff($datetime1);
 
# obtenemos la diferencia en meses
$intervalMeses=$interval->format("%m");
# obtenemos la diferencia en años y la multiplicamos por 12 para tener los meses
$intervalAnos = $interval->format("%y")*12;
 
return $intervalMeses+$intervalAnos;
	
	
}



function saca_anticiposueldo($anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$DB_gogess)
{
//busca anticipo sueldo
$couta_val=0;
$suma_valor=0;	
//echo $fecha_cierre;
$bu_anticipo="select * from conco_asigananticipo where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrantic_activo=1 and asigrantic_fechaaprobacion<='".$fecha_cierre."'";		
$rs_anticipo= $DB_gogess->executec($bu_anticipo,array()); 
if($rs_anticipo)
			{
				  while (!$rs_anticipo->EOF)
					{
						$meses_pasan=0;
						$meses_pasan=$this->calcula_meses($rs_anticipo->fields["asigrantic_fechaaprobacion"],$fecha_cierre);
						$meses_pasan=$meses_pasan+1;
						
						$couta_val=0;
						if($meses_pasan<=$rs_anticipo->fields["asigrantic_tiempo"])
						{
							$couta_val=$rs_anticipo->fields["asigrantic_valor"]/$rs_anticipo->fields["asigrantic_tiempo"];
							$suma_valor=$suma_valor+$couta_val;
						}
						
						$rs_anticipo->MoveNext();
					}
			}		


$total_anticipo=0;   
$total_anticipo=$suma_valor;

return number_format($total_anticipo, 2, '.', '');

}


function saca_hipotecario($anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{
	
$busca_dodec="select * from conco_tiporub where tiporub_id=9";
$rs_dodec= $DB_gogess->executec($busca_dodec,array());

$tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];

$busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
$rs_btabla= $DB_gogess->executec($busca_tabla,array());

$tabla=$rs_btabla->fields["tiparch_ntabla"];
$campo_cedula=$rs_dodec->fields["tiporub_campocedula"];

$busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
$rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());


//busca anticipo sueldo
//echo $tiporub_campovalor;
$bu_data="select sum(".$tiporub_campovalor.") as total from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and 	archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;		
$rs_data= $DB_gogess->executec($bu_data,array()); 
$total_data=0;   
$total_data=$rs_data->fields["total"];
return number_format($total_data, 2, '.', '');

}


//antiguedad
function saca_antiguedad($regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$genr_fechacierre,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  $cfgr_valorantiguedadcodigot=$rs_bempresa->fields["cfgr_valorantiguedadcodigot"];
  @$antiguedad=$this->caculo_antiguedad($genr_fechacierre,$clie_id,$DB_gogess);
  
  $valor_antiguedad=0;
  if($regimen_laboralid==2)
  {
     $valor_antiguedad=($sueldo*$cfgr_valorantiguedadcodigot)*$antiguedad;
  
  }
  
  return number_format($valor_antiguedad, 2, '.', '');

}
//antiguedad


//pasajes

function saca_pasajes($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  $cfgr_pasajesvalorct=$rs_bempresa->fields["cfgr_pasajesvalorct"];
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select ".$tiporub_campovalor." as valort from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  $dias_t=0;
  $dias_t=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_pasajes=0;
  if($regimen_laboralid==2)
  {
     $valor_pasajes=($dias_t*$cfgr_pasajesvalorct);
  
  }
  
  return $valor_pasajes;

}

//pasajes


//cargas familiares
function saca_cargasf($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  $cfgr_valorcargas=$rs_bempresa->fields["cfgr_valorcargas"];
  
   $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
   $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
   
   $usua_enlace=$rs_cedulaclie->fields["usua_enlace"];
   
   //ninios menores a 18
   
   $lista_cargas="select carg_fechadenacimiento,year(from_days((to_days(now()) - to_days(carg_fechadenacimiento)))) AS anios from grid_cargasfamiliares2 where standar_enlace='".$usua_enlace."' and carg_parentesco in (5,6)";
   $rs_lcargas=$DB_gogess->executec($lista_cargas,array());
   
   $cuenta_ninos=0;
   if($rs_lcargas)
		{
			while (!$rs_lcargas->EOF)
				{	
				    //echo $rs_lcargas->fields["anios"];				
					if($rs_lcargas->fields["anios"]<18)
					{
					   $cuenta_ninos++;
					}					
				 
				  $rs_lcargas->MoveNext();
				}
		}		
   
  
   //ninios menores a 18
   
  $valor_cargas=0;
  if($regimen_laboralid==2)
  {
     $valor_cargas=($cuenta_ninos*$cfgr_valorcargas);  
  }
  
  return $valor_cargas;


}
//cargas familiares

//alimentacion


function saca_alimentacion($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  $cfgr_alimentacion=$rs_bempresa->fields["cfgr_alimentacion"];
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select ".$tiporub_campovalor." as valort from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  $dias_t=0;
  $dias_t=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_alimentacion=0;
  if($regimen_laboralid==2)
  {
     $valor_alimentacion=($dias_t*$cfgr_alimentacion);
  
  }
  
  return $valor_alimentacion;

}

//alimentacion

function genera_insert_general($tabla_gridvalor,$_POSTx,$campos_data)
{
    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 {
	 
	  $sqlcampos=$sqlcampos.",".$campos_data[$i];	
	  $sqlvalues=$sqlvalues.",'".$_POSTx[$campos_data[$i]]."'"; 
	 
	 }
	 
	 $sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,1);
	 
	
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.") values (".$sqlvalues.")";
	 
	
	return $sql_1;
}


//aporte conyuge

function saca_conyuge($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select ".$tiporub_campovalor." as valort from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  
  $valort=0;
  $valort=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_conyuge=0;
  if($valort>0)
  {
  $valor_conyuge=$valort;
  }

  return $valor_conyuge;
}


//sindicato


function saca_sindicato($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select ".$tiporub_campovalor." as valort from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  
  $valort=0;
  $valort=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_sindicato=0;
  if($valort>0)
  {
  $valor_sindicato=$valort;
  }

  return $valor_sindicato;
}

//sindicato

function genera_sqlbusqueda($valor,$operador)
{

  $listacampostxt=array();
  $listacampostxt=explode(",",$this->campostxt);
  
  $listacamposlike=array();
  $listacamposlike=explode(",",$this->camposlike);
  
  $sql='';
  if($valor)
  {
  
  if($operador=='OR')
  {	  
	  for($i=0;$i<count($listacampostxt);$i++)
	  {
		 $sql.=$listacampostxt[$i]."='".$valor."' or ";
	  
	  }
	  
	  for($i=0;$i<count($listacamposlike);$i++)
	  {
		 $sql.=$listacamposlike[$i]." like '%".$valor."%' or ";
	  
	  }	  
	  
	  $sql="(".substr($sql,0,-3).")";
	  
  }
  
  
  
  }
  
  
  
  return $sql;

}

//benefica
function saca_benefica($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$clie_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select ".$tiporub_campovalor." as valort from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  
  $valort=0;
  $valort=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_sindicato=0;
  if($valort>0)
  {
  $valor_sindicato=$valort;
  }

  return $valor_sindicato;
}

//benefica

//asociacion
function saca_asociacion($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select ".$tiporub_campovalor." as valort from ".$tabla." where ".str_replace("-","",$campo_cedula)."='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  
  $valort=0;
  $valort=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_sindicato=0;
  if($valort>0)
  {
  $valor_sindicato=$valort;
  }

  return $valor_sindicato;
}
//asociacion


//supa
function saca_supa($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================lpad(".str_replace("-","",$campo_cedula).",10,0)
  
  $bu_data="select sum(".$tiporub_campovalor.") as valort from ".$tabla." where lpad(".str_replace("-","",$campo_cedula).",10,0)='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  
  $valort=0;
  $valort=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_sindicato=0;
  if($valort>0)
  {
  $valor_sindicato=$valort;
  }

  return $valor_sindicato;
}
//supa

//optica
function saca_optica($tiporub_idval,$regimen_laboralid,$sueldo,$anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{

  $bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
  $rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
  
  
  $busca_dodec="select * from conco_tiporub where tiporub_id='".$tiporub_idval."'";
  $rs_dodec= $DB_gogess->executec($busca_dodec,array());
  $tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];
  $busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
  $rs_btabla= $DB_gogess->executec($busca_tabla,array());

  $tabla=$rs_btabla->fields["tiparch_ntabla"];
  $campo_cedula=$rs_dodec->fields["tiporub_campocedula"];
  
  //if(strlen($campo_cedula)==9)
  //{
	  // $campo_cedula="0".$campo_cedula;	  
  //}
  
  $busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
  $rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());
  
  //===================================================
  
  $bu_data="select sum(".$tiporub_campovalor.") as valort from ".$tabla." where lpad(".str_replace("-","",$campo_cedula).",10,0)='".$rs_cedulaclie->fields["usua_ciruc"]."' and  archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;	
  	
  $rs_data=$DB_gogess->executec($bu_data,array()); 
  
  $valort=0;
  $valort=$rs_data->fields["valort"];
  
  //===================================================
  
  $valor_sindicato=0;
  if($valort>0)
  {
  $valor_sindicato=$valort;
  }

  return $valor_sindicato;
}
//optica


function saca_quirografario($anio_rol,$mes_rol,$usua_id,$emp_id,$DB_gogess)
{
	
$busca_dodec="select * from conco_tiporub where tiporub_id=7";
$rs_dodec= $DB_gogess->executec($busca_dodec,array());

$tiporub_campovalor=$rs_dodec->fields["tiporub_campovalor"];

$busca_tabla="select * from cmb_tipoarchivo where tiparch_id='".$rs_dodec->fields["tiparch_id"]."'";
$rs_btabla= $DB_gogess->executec($busca_tabla,array());

$tabla=$rs_btabla->fields["tiparch_ntabla"];
$campo_cedula=$rs_dodec->fields["tiporub_campocedula"];

$busca_cedulaclie="select * from app_usuario where usua_id='".$usua_id."'";
$rs_cedulaclie= $DB_gogess->executec($busca_cedulaclie,array());


//busca anticipo sueldo
//echo $tiporub_campovalor;
$bu_data="select sum(".$tiporub_campovalor.") as total from ".$tabla." where ".$campo_cedula."='".$rs_cedulaclie->fields["usua_ciruc"]."' and 	archdt_anio='".$anio_rol."' and archdt_mes='".$mes_rol."' group by ".$campo_cedula;		
$rs_data= $DB_gogess->executec($bu_data,array()); 
$total_data=0;   
$total_data=$rs_data->fields["total"];
return number_format($total_data, 2, '.', '');

}

//saca valores extras

function saca_valoresextras($roles_id,$rubrg_id,$s_minimo,$genr_id_val,$tipprub_id,$anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$DB_gogess)
{


$saca_fechaarr=array();
$saca_fechaarr=explode("-",$fecha_cierre);

$fecha_array=array();
$fecha_array=explode("-",$fecha_cierre);


$couta_val=0;
$bu_vextras="select * from conco_asignaextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigextr_activo=1 and year(asigextr_fechaaprobacion)='".$fecha_array[0]."' and month(asigextr_fechaaprobacion)='".$fecha_array[1]."'";	

$rs_vextras= $DB_gogess->executec($bu_vextras,array()); 
if($rs_vextras)
			{
				  while (!$rs_vextras->EOF)
					{
						$meses_pasan=0;
						$rs_vextras->fields["asigextr_fechaaprobacion"]."<br>";
						$meses_pasan=$this->calcula_meses($rs_vextras->fields["asigextr_fechaaprobacion"],$fecha_cierre);
						$meses_pasan=$meses_pasan+1;
						
						$couta_val=0;
						$rubrg_nombre='';
						$rubrg_ingresoegreso='';
						$couta_val=0;
						$rubrg_formula='';
						//if($meses_pasan<=$rs_vextras->fields["asigextr_tiempo"])
						//{
							    $couta_val=$rs_vextras->fields["asigextr_valor"];
								$rubrg_valor=$couta_val;
							    $rubrg_nombre=$rs_vextras->fields["asigextr_nombre"];
								$rubrg_ingresoegreso=$rs_vextras->fields["tipoie_id"];
								$rubrg_formula='';
								
								if($rubrg_valor>0)
								{
								
								$detlroll_tabla='conco_asignaextras';
								$detlroll_idtabla=$rs_vextras->fields["asigextr_id"];
								$detlroll_idcampo='asigextr_id';
								
								$insert_extval="insert into conco_detalleroles (roles_id,rubrg_id,rubrg_nombre,rubrg_ingresoegreso,rubrg_valor,rubrg_formula,rubrg_salariominimo,genr_id,usua_id,tipprub_id,detlroll_tabla,detlroll_idtabla,detlroll_idcampo) values ('".$roles_id."','".$rubrg_id."','".$rubrg_nombre."','".$rubrg_ingresoegreso."','".$rubrg_valor."','".$rubrg_formula."','".$s_minimo."','".$genr_id_val."','".$usua_id."','".$tipprub_id."','".$detlroll_tabla."','".$detlroll_idtabla."','".$detlroll_idcampo."')";
				
					             $rs_extval=$DB_gogess->executec($insert_extval,array());
								}
						
						//}
						
						$rs_vextras->MoveNext();
					}
			}		



}

//saca valores extras

//saca horas extras


function saca_horasextras($roles_id,$rubrg_id,$s_minimo,$genr_id_val,$tipprub_id,$anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$DB_gogess)
{

$saca_fecha=array();
$saca_fecha=explode("-",$fecha_cierre);


$couta_val=0;
$bu_vextras="select * from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$saca_fecha[0]."' and asigrhext_mes='".$saca_fecha[1]."'";
	
$rs_vextras= $DB_gogess->executec($bu_vextras,array()); 
if($rs_vextras)
			{
				  while (!$rs_vextras->EOF)
					{
						$meses_pasan=0;
						//$rs_vextras->fields["asigextr_fechaaprobacion"]."<br>";
						//$meses_pasan=$this->calcula_meses($rs_vextras->fields["asigextr_fechaaprobacion"],$fecha_cierre);
						//$meses_pasan=$meses_pasan+1;
						
						$couta_val=0;
						$rubrg_nombre='';
						$rubrg_ingresoegreso='';
						$couta_val=0;
						$rubrg_formula='';
						
							    $couta_val=$rs_vextras->fields["asigrhext_valorhoras"];
								$rubrg_valor=$couta_val;
							    $rubrg_nombre='HORAS EXTRAS';
								$rubrg_ingresoegreso=1;
								$rubrg_formula='';
								
								if($rubrg_valor>0)
								{
								
								$detlroll_tabla='conco_asiganhextras';
								$detlroll_idtabla=$rs_vextras->fields["asigrhext_id"];
								$detlroll_idcampo='asigrhext_id';
								
								$insert_extval="insert into conco_detalleroles (roles_id,rubrg_id,rubrg_nombre,rubrg_ingresoegreso,rubrg_valor,rubrg_formula,rubrg_salariominimo,genr_id,usua_id,tipprub_id,detlroll_tabla,detlroll_idtabla,detlroll_idcampo) values ('".$roles_id."','".$rubrg_id."','".$rubrg_nombre."','".$rubrg_ingresoegreso."','".$rubrg_valor."','".$rubrg_formula."','".$s_minimo."','".$genr_id_val."','".$usua_id."','".$tipprub_id."','".$detlroll_tabla."','".$detlroll_idtabla."','".$detlroll_idcampo."')";
				
					             $rs_extval=$DB_gogess->executec($insert_extval,array());
								}
						
						
						
						$rs_vextras->MoveNext();
					}
			}		



}

//saca horas extras

//saca vacaciones


function saca_vacaciones($roles_id,$rubrg_id,$s_minimo,$genr_id_val,$tipprub_id,$anio_rol,$mes_rol,$usua_id,$emp_id,$fecha_cierre,$sueldoac,$DB_gogess)
{

$saca_fecha=array();
$saca_fecha=explode("-",$fecha_cierre);

$bu_empresa="select * from app_empresa inner join conco_cfgrol on app_empresa.emp_id=conco_cfgrol.emp_id where app_empresa.emp_id='".$emp_id."'";		
$rs_bempresa= $DB_gogess->executec($bu_empresa,array()); 
$cfgr_diasanio=$rs_bempresa->fields["cfgr_diasanio"];
$cfgr_diasmes=$rs_bempresa->fields["cfgr_diasmes"];

//saca horas extras

$couta_val=0;
$bu_vextras="select sum(asigrhext_valorhoras) as totalhext from conco_asiganhextras where emp_id='".$emp_id."' and usua_id='".$usua_id."' and asigrhext_activo=1 and asigrhext_anio='".$saca_fecha[0]."' and asigrhext_mes='".$saca_fecha[1]."'";
	
$rs_vextras= $DB_gogess->executec($bu_vextras,array()); 

$horasextras_val=$rs_vextras->fields["totalhext"];

//saca horas extras

$rmu=$sueldoac;
//ingresos	
$provi_vaca=0;
//$provi_vaca=$rmu/12;
$provi_vaca=((($rmu+$horasextras_val)/$cfgr_diasanio)*$cfgr_diasmes)/2;			  
$provi_vaca=number_format($provi_vaca, 2, '.', '');



return $provi_vaca;

}

//saca vcaciones


function fechaCastellano($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  //$nombredia.
  return " ".$numeroDia." de ".$nombreMes." de ".$anio;
}

function ver_precioterapia($clie_id,$DB_gogess)
{
   //-----------------------------------------
   $cantidad_nueva=1;
   $lista_hijos="select distinct tipopac_id,clie_nombre,clie_apellido,clie_id from app_cliente where clie_id='".$clie_id."'";
   $rs_datahijos = $DB_gogess->executec($lista_hijos,array());
   if($rs_datahijos)
   {
	  while (!$rs_datahijos->EOF) {	
        
		$tipopac_id=$rs_datahijos->fields["tipopac_id"];
		$nombre_n=$rs_datahijos->fields["clie_nombre"];
		$apellido_n=$rs_datahijos->fields["clie_apellido"];

        $rs_datahijos->MoveNext();	   
	  }
   }
   $valor_precio='prod_precio';
	switch ($tipopac_id) {
    case 1:
        $valor_precio="prod_precioisfa";
        break;
    case 2:
        $valor_precio="prod_precio";
        break;
    case 3:
        $valor_precio="prod_precioconvenio";
        break;
	case 4:
        $valor_precio="prod_precioconveniohermano";
        break;	
	case 5:
        $valor_precio="prod_preciopolicia";
        break;
	case 6:
        $valor_precio="prod_preciomilitar";
        break;		
	case 7:
        $valor_precio="prod_preciomilitar";
        break;	
	case 8:
        $valor_precio="prod_preciomilitar";
        break;					
    }
	
	$busca_serial="select usua_id,prod_codigo,prod_id from efacsistema_producto where  prod_paraterapia=1";
    $rs_serial = $DB_gogess->executec($busca_serial,array());
	
   //-----------------------------------------
   
   $busca_dataproducto="select prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$rs_serial->fields["prod_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());

   return $rs_dataproducto->fields["docdet_total"];


   //-----------------------------------------

}

function verifica_siyafuepagada($terap_id,$clie_id,$DB_gogess)
{

  $concatena_pag='';
 //optiene terapias pagadas
$concatena_pag='';
$listatpag="select terap_id from beko_documentodetalle";
$rs_listapag = $DB_gogess->executec($listatpag);
 if($rs_listapag)
 {
     	while (!$rs_listapag->EOF) {
		
		
		$concatena_pag.=$rs_listapag->fields["terap_id"];
		
		$rs_listapag->MoveNext();	
		}
  }
  
 //lista fisica
$lista_fisica="select distinct terap_id from faesa_terapiasregistro where terap_nfactura !='' and clie_id=".$clie_id;
$rs_listafisica = $DB_gogess->executec($lista_fisica);
 if($rs_listafisica)
 {
     	while (!$rs_listafisica->EOF) {
		
		
		$concatena_pag.=$rs_listafisica->fields["terap_id"].",";
		
		$rs_listafisica->MoveNext();	
		}
  }
  
//lista issfa
$lista_issfa="select distinct  terap_id from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where tipopac_id='1' and app_cliente.clie_id=".$clie_id;
$rs_listaissfa = $DB_gogess->executec($lista_issfa);
 if($rs_listaissfa)
 {
     	while (!$rs_listaissfa->EOF) {
		
		$concatena_pag.=$rs_listaissfa->fields["terap_id"].",";
		
		$rs_listaissfa->MoveNext();	
		}
  }  
  $concatena_pag=$concatena_pag."0";  
  
  $pagado_t=0;
  $lista_tera="select * from faesa_terapiasregistro where terap_id=".$terap_id." and terap_id in (".$concatena_pag.") and clie_id=".$clie_id." order by terap_fecha asc";
  
  if($clie_id==190)
  {
  
  // echo $lista_tera;
  }
   $rs_lterap = $DB_gogess->executec($lista_tera,array());
	{
     	while (!$rs_lterap->EOF) {

		$pagado_t=1;
		
		$rs_lterap->MoveNext();	
		}
    		
   }
   return $pagado_t;
  
  
  
}

function lista_terapias_porpagar($clie_id,$DB_gogess)
{
$concatena_pag='';
 //optiene terapias pagadas
$concatena_pag='';
$listatpag="select terap_id from beko_documentodetalle";
$rs_listapag = $DB_gogess->executec($listatpag);
 if($rs_listapag)
 {
     	while (!$rs_listapag->EOF) {
		
		
		$concatena_pag.=$rs_listapag->fields["terap_id"];
		
		$rs_listapag->MoveNext();	
		}
  }
  
 //lista fisica
$lista_fisica="select distinct terap_id from faesa_terapiasregistro where terap_nfactura!='' and clie_id=".$clie_id;
$rs_listafisica = $DB_gogess->executec($lista_fisica);
 if($rs_listafisica)
 {
     	while (!$rs_listafisica->EOF) {
		
		
		$concatena_pag.=$rs_listafisica->fields["terap_id"].",";
		
		$rs_listafisica->MoveNext();	
		}
  }
  
//lista issfa
$lista_issfa="select distinct  terap_id from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where tipopac_id='1' and app_cliente.clie_id=".$clie_id;
$rs_listaissfa = $DB_gogess->executec($lista_issfa);
 if($rs_listaissfa)
 {
     	while (!$rs_listaissfa->EOF) {
		
		
		$concatena_pag.=$rs_listaissfa->fields["terap_id"].",";
		
		$rs_listaissfa->MoveNext();	
		}
  }  
  $concatena_pag=$concatena_pag."0";  
  $lista_tera="select * from faesa_terapiasregistro where terap_id not in (".$concatena_pag.") and clie_id=".$clie_id." order by terap_fecha asc";
   $rs_lterap = $DB_gogess->executec($lista_tera,array());
	{
	 $idcuenta=0;
	 $total_pag=0;
  $restorna_valor='<table width="400px" border="1" cellpadding="0" cellspacing="0" align="center">';
  
     	while (!$rs_lterap->EOF) {
		 
		 $idcuenta++;
		 $valor_tera=$this->ver_precioterapia($clie_id,$DB_gogess); 
		 $restorna_valor.='<tr>
		  <td class="css_texto" >'.$idcuenta.'</td>
		  <td class="css_texto">PENDIENTE PAGO </td>
          <td class="css_texto">'.$rs_lterap->fields["terap_fecha"].'</td>
          <td class="css_texto">'.$rs_lterap->fields["terap_hora"].'</td>
          <td class="css_texto">'.$valor_tera.'</td>
        </tr>';
		
		$total_pag=$total_pag+$valor_tera;
		$rs_lterap->MoveNext();	
		}
    		
    $restorna_valor.='<tr>
		  <td class="css_texto" ></td>
		  <td class="css_texto"></td>
          <td class="css_texto"></td>
          <td class="css_texto"></td>
          <td class="css_texto">'.$total_pag.'</td>
        </tr>';				
   $restorna_valor.='</table>';
   }
   return $restorna_valor;

}

public function getSubString($string, $length=NULL)
{
    //Si no se especifica la longitud por defecto es 50
    if ($length == NULL)
        $length = 50;
    //Primero eliminamos las etiquetas html y luego cortamos el string
    $stringDisplay = substr(strip_tags($string), 0, $length);
    //Si el texto es mayor que la longitud se agrega puntos suspensivos
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;
}

function desplegarencuadros($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	echo '<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'">';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   echo '<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   echo '<td>'.@$arreglolista[$k].'</td>';
		   $k++;
		 
		 }
		 
	   echo '</tr>';	  
	}
	echo '</table>';
    }
}


function desplegarencuadrosv2($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $cuadro='';
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	$cuadro='';
	$cuadro.='<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'" align="center" >';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   $cuadro.='<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   $cuadro.='<td><center>'.@$arreglolista[$k].'</center></td>';
		   $k++;
		 
		 }
		 
	   $cuadro.='</tr>';	  
	}
	$cuadro.='</table>';
    }
	
	return $cuadro;
}


function genera_insert($tabla_gridvalor,$campo_enlace,$campo_fecharegistro,$valor_enlace,$valor_usuario,$valor_fecha,$_POSTx,$campos_data)
{
    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 {
	 
	  $sqlcampos=$sqlcampos.",".$campos_data[$i];	
	  $valor_g='';
		
      switch ($_POSTx[$campos_data[$i]."x"]) {
	    case '0':
		    {
			$valor_g='0';
			}
			break;
		case 'true':
		    {
			$valor_g='1';
			}
			break;
		case 'false':
		    {
			$valor_g='0';
			}
			break;
		default:
		   $valor_g=$_POSTx[$campos_data[$i]."x"];
		  }
		
	  $sqlvalues=$sqlvalues.",'".str_replace("'", "\'",$valor_g)."'"; 
	 
	 }
	 
	 $sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,1);
	 
	 if($campo_fecharegistro)
	 {
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.",".$campo_enlace.",".$campo_fecharegistro.",usua_id) values (".$sqlvalues.",'".$valor_enlace."','".$valor_fecha."','".$valor_usuario."')";
	 }
	 else
	 {
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.",".$campo_enlace.",usua_id) values (".$sqlvalues.",'".$valor_enlace."','".$valor_usuario."')";
	 
	 }
	 
	$file = fopen("../../log_recetas/archivoinsert".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
    fwrite($file, $sql_1 . PHP_EOL);
    fclose($file);
	 
	return $sql_1;
}

function genera_update($tabla_gridvalor,$campo_id,$valor_id,$_POSTx,$campos_data)
{
    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 { 
	 //$sqlcampos=$sqlcampos.",".$campos_data[$i];	
	 
	
	   $valor_g='';
		
      switch ($_POSTx[$campos_data[$i]."x"]) {
	    case '0':
		    {
			$valor_g='0';
			}
			break;
		case 'true':
		    {
			$valor_g='1';
			}
			break;
		case 'false':
		    {
			$valor_g='0';
			}
			break;
		default:
		   $valor_g=$_POSTx[$campos_data[$i]."x"];
		  }
	 
	 
	  $sqlvalues=$sqlvalues."".$campos_data[$i]."='".str_replace("'", "\'",$valor_g)."',"; 
	  
	  
	  
	 }
	 //$sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,0,-1); 
	 $sql_1="update ".$tabla_gridvalor." set ".$sqlvalues." where ".$campo_id."='".$valor_id."'";
	 
	$file = fopen("../../log_recetas/archivoupdate".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
    fwrite($file, $sql_1 . PHP_EOL);
    fclose($file);	

	return $sql_1;
}




function genera_updategriddata($tabla_gridvalor,$campo_id,$valor_id,$_POSTx,$campos_data)
{
    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 { 
	 //$sqlcampos=$sqlcampos.",".$campos_data[$i];	
	 
	 if($campos_data[$i])
	 {
	
	   $valor_g='';
		
      switch ($_POSTx[$campos_data[$i]."x"]) {
	    case '0':
		    {
			$valor_g='0';
			}
			break;
		case 'true':
		    {
			$valor_g='1';
			}
			break;
		case 'false':
		    {
			$valor_g='0';
			}
			break;
		default:
		   $valor_g=$_POSTx[$campos_data[$i]."x"];
		  }
	 
	 
	  $sqlvalues=$sqlvalues."".$campos_data[$i]."='".str_replace("'", "\'",$valor_g)."',"; 
	  
	  }
	  
	 }
	 //$sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,0,-1); 
	 $sql_1="update ".$tabla_gridvalor." set ".$sqlvalues." where ".$campo_id."='".$valor_id."'";
	 
	$file = fopen("../../log_recetas/archivoupdate".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
    fwrite($file, $sql_1 . PHP_EOL);
    fclose($file);	

	return $sql_1;
}

function leer_contenido_completo($url){
	
	if (file_exists($url)) {
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   
	}
	else
{
 echo 'Archivo no existe...';	

}
   return $texto;
}


function calcular_edad($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;
$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;
$resultado["anio"]=$valor_anio;
$resultado["mes"]=round($valor_mes);
return $resultado;
}


function calcular_edaddias($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;
$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;
$resultado["anio"]=$valor_anio;
$resultado["mes"]=round($valor_mes);
$sacad_dia=explode(".",$valor_mes);
//$resultado["dias"]=round(("0.".@$sacad_dia[1])*30);
if(trim("0.".@$sacad_dia[1])=='0.')
{
	@$sacad_dia[1]=0;
}

$numva_data=floatval("0.".@$sacad_dia[1]);
$resultado["dias"]= number_format($numva_data, 5, '.', '');

return $resultado;
}


function obtiene_datos($director,$lista_tbldata,$objformulario,$tabla,$enlace,$psic_id_valor,$rs_sihaydata,$grupoblock,$DB_gogess)
{
		//datos de tablas
		
		$campos_data_r["faesa_gridwisc"]["campos"]=array('escwisc_nombre','wisc_marcador','wisc_observacion');
        $campos_name_r["faesa_gridwisc"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_gridwisc"]["combo"]="faesa_escalaswisc";
        $tabla_enlacecombo1_r["faesa_gridwisc"]["idcombo"]="escwisc_id";
		$tabla_enlacecombo1_r["faesa_gridwisc"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_gridwppsi1"]["campos"]=array('escwppsi1_nombre','wppsi1_marcador','wppsi1_observacion');
        $campos_name_r["faesa_gridwppsi1"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_gridwppsi1"]["combo"]="faesa_escalaswppsi";
        $tabla_enlacecombo1_r["faesa_gridwppsi1"]["idcombo"]="escwppsi1_id";
		$tabla_enlacecombo1_r["faesa_gridwppsi1"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_gridwppsi2"]["campos"]=array('escwppsi2_nombre','wppsi2_marcador','wppsi2_observacion');
        $campos_name_r["faesa_gridwppsi2"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_gridwppsi2"]["combo"]="faesa_escalaswppsi2";
        $tabla_enlacecombo1_r["faesa_gridwppsi2"]["idcombo"]="escwppsi2_id";
		$tabla_enlacecombo1_r["faesa_gridwppsi2"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_diagnosticodifirencial"]["campos"]=array('diagn_criteriodiagnostico','marcps_nombre','diagn_observacion');
        $campos_name_r["faesa_diagnosticodifirencial"]["titulos"]=array('Criterio Diagnostico','Marcador','Observaciones');
        $tabla_combo1_r["faesa_diagnosticodifirencial"]["combo"]="faesa_marcadorps";
        $tabla_enlacecombo1_r["faesa_diagnosticodifirencial"]["idcombo"]="marcps_id";
		$tabla_enlacecombo1_r["faesa_diagnosticodifirencial"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_entrevistacomfamilescolar"]["campos"]=array('trast_nombre','entrvfe_percentil','entrvfe_observacion');
        $campos_name_r["faesa_entrevistacomfamilescolar"]["titulos"]=array('Caracteristica','Percentil','Observaciones');
        $tabla_combo1_r["faesa_entrevistacomfamilescolar"]["combo"]="faesa_trastornoentrev";
        $tabla_enlacecombo1_r["faesa_entrevistacomfamilescolar"]["idcombo"]="trast_id";
		$tabla_enlacecombo1_r["faesa_entrevistacomfamilescolar"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_invetarioansiedad"]["campos"]=array('tipans_nombre','invtans_marcador','invtans_observacion');
        $campos_name_r["faesa_invetarioansiedad"]["titulos"]=array('Ansiedad','Marcador','Observaciones');
        $tabla_combo1_r["faesa_invetarioansiedad"]["combo"]="faesa_tipoansiedad";
        $tabla_enlacecombo1_r["faesa_invetarioansiedad"]["idcombo"]="tipans_id";
		$tabla_enlacecombo1_r["faesa_invetarioansiedad"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_griddesarrolloinf"]["campos"]=array('escdesarrinf_nombre','desarrinf_percentil','desarrinf_edad','desarrinf_interpretacion');
        $campos_name_r["faesa_griddesarrolloinf"]["titulos"]=array('&Aacute;reas y dominios','Puntaje - Percentil','Edad Equivalente','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_griddesarrolloinf"]["combo"]="faesa_areadesarrollo";
        $tabla_enlacecombo1_r["faesa_griddesarrolloinf"]["idcombo"]="escdesarrinf_id";
		$tabla_enlacecombo1_r["faesa_griddesarrolloinf"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_gridvelocidadpor"]["campos"]=array('escvelopor_nombre','velopor_subescala','velopor_percentil','velopor_apreciacion');
        $campos_name_r["faesa_gridvelocidadpor"]["titulos"]=array('Escala','Sub Escala','Percentil','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_gridvelocidadpor"]["combo"]="faesa_escalavelopor";
        $tabla_enlacecombo1_r["faesa_gridvelocidadpor"]["idcombo"]="escvelopor_id";
		$tabla_enlacecombo1_r["faesa_gridvelocidadpor"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_gridescalamemoria"]["campos"]=array('escescameno_nombre','escameno_subescala','escameno_percentil','escameno_apreciacion');
        $campos_name_r["faesa_gridescalamemoria"]["titulos"]=array('Escala','Sub Escala','Percentil','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_gridescalamemoria"]["combo"]="faesa_escalamemo";
        $tabla_enlacecombo1_r["faesa_gridescalamemoria"]["idcombo"]="escescameno_id";
		$tabla_enlacecombo1_r["faesa_gridescalamemoria"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_griddepreinfantil"]["campos"]=array('escdepreinf_nombre','depreinf_percentil','depreinf_descripcion');
        $campos_name_r["faesa_griddepreinfantil"]["titulos"]=array('Escala','Percentil','Descripci&oacute;n');
        $tabla_combo1_r["faesa_griddepreinfantil"]["combo"]="faesa_factordepre";
        $tabla_enlacecombo1_r["faesa_griddepreinfantil"]["idcombo"]="escdepreinf_id";
		$tabla_enlacecombo1_r["faesa_griddepreinfantil"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_gridinterpersonales"]["campos"]=array('aippsc_nombre','inteperson_marcador','inteperson_observacion');
        $campos_name_r["faesa_gridinterpersonales"]["titulos"]=array('&Aacute;rea','Marcador','Observaciones');
        $tabla_combo1_r["faesa_gridinterpersonales"]["combo"]="faesa_areasintepersonalespsc";
        $tabla_enlacecombo1_r["faesa_gridinterpersonales"]["idcombo"]="aippsc_id";
		$tabla_enlacecombo1_r["faesa_gridinterpersonales"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_evaluacionproyectivaemo"]["campos"]=array('facto_nombre','evaproyemo_descripcion');
        $campos_name_r["faesa_evaluacionproyectivaemo"]["titulos"]=array('Factores','Descripción');
        $tabla_combo1_r["faesa_evaluacionproyectivaemo"]["combo"]="";
        $tabla_enlacecombo1_r["faesa_evaluacionproyectivaemo"]["idcombo"]="";
		$tabla_enlacecombo1_r["faesa_evaluacionproyectivaemo"]["enlace"]="psic_enlace";
		
		//datos de tablas
		
		//pedagogia
		
		$campos_data_r["faesa_pedagogianeurofunciones"]["campos"]=array('areev_nombre','pedneuro_marcador','pedneuro_observaciones');
        $campos_name_r["faesa_pedagogianeurofunciones"]["titulos"]=array('&Aacute;rea','Marcador','Observaciones');
        $tabla_combo1_r["faesa_pedagogianeurofunciones"]["combo"]="faesa_areaev";
		$tabla_enlacecombo1_r["faesa_pedagogianeurofunciones"]["idcombo"]="areev_id";
        $tabla_enlacecombo1_r["faesa_pedagogianeurofunciones"]["enlace"]="pedago_enlace";
		
		
		$campos_data_r["faesa_pedagogiacompetencias"]["campos"]=array('tipcompe_nombre','pedcompete_observaciones','pedcompete_dificultades');
        $campos_name_r["faesa_pedagogiacompetencias"]["titulos"]=array('Tipo','Observaciones','Dificultades Espec&iacute;ficas');
        $tabla_combo1_r["faesa_pedagogiacompetencias"]["combo"]="faesa_tipocompetencia";
		$tabla_enlacecombo1_r["faesa_pedagogiacompetencias"]["idcombo"]="tipcompe_id";
        $tabla_enlacecombo1_r["faesa_pedagogiacompetencias"]["enlace"]="pedago_enlace";
		
		
		
		$campos_data_r["faesa_pedagogiaaprendizaje"]["campos"]=array('tipoa_nombre','pedaprendiz_porcentaje','pedaprendiz_apreciacion');
        $campos_name_r["faesa_pedagogiaaprendizaje"]["titulos"]=array('Tipo','Porcentaje','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_pedagogiaaprendizaje"]["combo"]="faesa_tipoarea2";
		$tabla_enlacecombo1_r["faesa_pedagogiaaprendizaje"]["idcombo"]="tipoa_id";
        $tabla_enlacecombo1_r["faesa_pedagogiaaprendizaje"]["enlace"]="pedago_enlace";
		
		
		$campos_data_r["faesa_pedgridvelocidadpor"]["campos"]=array('escvelopor_nombre','velopor_subescala','velopor_percentil','velopor_apreciacion');
        $campos_name_r["faesa_pedgridvelocidadpor"]["titulos"]=array('Escala','Sub Escala','Percentil','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridvelocidadpor"]["combo"]="faesa_escalavelopor";
        $tabla_enlacecombo1_r["faesa_pedgridvelocidadpor"]["idcombo"]="escvelopor_id";
		$tabla_enlacecombo1_r["faesa_pedgridvelocidadpor"]["enlace"]="pedago_enlace";
		
		
		
		$campos_data_r["faesa_pedgridwisc"]["campos"]=array('escwisc_nombre','wisc_marcador','wisc_observacion');
        $campos_name_r["faesa_pedgridwisc"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridwisc"]["combo"]="faesa_escalaswisc";
        $tabla_enlacecombo1_r["faesa_pedgridwisc"]["idcombo"]="escwisc_id";
		$tabla_enlacecombo1_r["faesa_pedgridwisc"]["enlace"]="pedago_enlace";
		
		$campos_data_r["faesa_pedgridwppsi1"]["campos"]=array('escwppsi1_nombre','wppsi1_marcador','wppsi1_observacion');
        $campos_name_r["faesa_pedgridwppsi1"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridwppsi1"]["combo"]="faesa_escalaswppsi";
        $tabla_enlacecombo1_r["faesa_pedgridwppsi1"]["idcombo"]="escwppsi1_id";
		$tabla_enlacecombo1_r["faesa_pedgridwppsi1"]["enlace"]="pedago_enlace";
		
		$campos_data_r["faesa_pedgridwppsi2"]["campos"]=array('escwppsi2_nombre','wppsi2_marcador','wppsi2_observacion');
        $campos_name_r["faesa_pedgridwppsi2"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridwppsi2"]["combo"]="faesa_escalaswppsi2";
        $tabla_enlacecombo1_r["faesa_pedgridwppsi2"]["idcombo"]="escwppsi2_id";
		$tabla_enlacecombo1_r["faesa_pedgridwppsi2"]["enlace"]="pedago_enlace";
		
		
		//pedagogia
		
		//lenguaje
		$campos_data_r["faesa_gridtestplon"]["campos"]=array('esctestplon_nombre','testplon_descripcion','testplon_resultado');
        $campos_name_r["faesa_gridtestplon"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_gridtestplon"]["combo"]="faesa_areatestplon";
		$tabla_enlacecombo1_r["faesa_gridtestplon"]["idcombo"]="esctestplon_id";
        $tabla_enlacecombo1_r["faesa_gridtestplon"]["enlace"]="lenguaj_enlace";
		
		
		$campos_data_r["faesa_gridtestelce"]["campos"]=array('esctestelce_nombre','testelce_descripcion','testelce_resultado');
        $campos_name_r["faesa_gridtestelce"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_gridtestelce"]["combo"]="faesa_areatestelce";
		$tabla_enlacecombo1_r["faesa_gridtestelce"]["idcombo"]="esctestelce_id";
        $tabla_enlacecombo1_r["faesa_gridtestelce"]["enlace"]="lenguaj_enlace";
		
		
		$campos_data_r["faesa_gridprotocoloalimen"]["campos"]=array('escprotoalimen_nombre','protoalimen_descripcion','protoalimen_resultado');
        $campos_name_r["faesa_gridprotocoloalimen"]["titulos"]=array('Marcador','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_gridprotocoloalimen"]["combo"]="faesa_areaprotoalimen";
		$tabla_enlacecombo1_r["faesa_gridprotocoloalimen"]["idcombo"]="escprotoalimen_id";
        $tabla_enlacecombo1_r["faesa_gridprotocoloalimen"]["enlace"]="lenguaj_enlace";
		
		
		$campos_data_r["faesa_griddesainfantil"]["campos"]=array('escdesainfa_nombre','desainfa_percentil','desainfa_edad','desainfa_interpretacion');
        $campos_name_r["faesa_griddesainfantil"]["titulos"]=array('&Aacute;rea y Dominios','Puntaje - Percentil','Edad Equivalente','Interpretaci&oacute;n Cualitativa');
        $tabla_combo1_r["faesa_griddesainfantil"]["combo"]="faesa_areadesainfantil";
		$tabla_enlacecombo1_r["faesa_griddesainfantil"]["idcombo"]="escdesainfa_id";
        $tabla_enlacecombo1_r["faesa_griddesainfantil"]["enlace"]="lenguaj_enlace";
		
		//lenguaje
		
		//terapia fisica
		
		
		$campos_data_r["faesa_griddedsarrollofisico"]["campos"]=array('escdesafisico_nombre','desafisico_descripcion','desafisico_resultado');
        $campos_name_r["faesa_griddedsarrollofisico"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_griddedsarrollofisico"]["combo"]="faesa_areadesafisico";
		$tabla_enlacecombo1_r["faesa_griddedsarrollofisico"]["idcombo"]="escdesafisico_id";
        $tabla_enlacecombo1_r["faesa_griddedsarrollofisico"]["enlace"]="terfisic_enlace";
		
		
		
		$campos_data_r["faesa_griddedsarrolloinfantil"]["campos"]=array('escdesainfantil_nombre','desainfantil_percentil','desainfantil_edad','desainfantil_interpretacion');
        $campos_name_r["faesa_griddedsarrolloinfantil"]["titulos"]=array('&Aacute;rea','Puntaje - Percentil','Edad Equivalente','Interpretaci&oacute;n Cualitativa');
        $tabla_combo1_r["faesa_griddedsarrolloinfantil"]["combo"]="faesa_areadesarolloinfantil";
		$tabla_enlacecombo1_r["faesa_griddedsarrolloinfantil"]["idcombo"]="escdesainfantil_id";
        $tabla_enlacecombo1_r["faesa_griddedsarrolloinfantil"]["enlace"]="terfisic_enlace";
		
		//terapia fisica
		
		//terapia ocupacional
		
		$campos_data_r["faesa_griddesarrollofisicoo"]["campos"]=array('escdesafisico_nombre','desafisico_descripcion','desafisico_resultado');
        $campos_name_r["faesa_griddesarrollofisicoo"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_griddesarrollofisicoo"]["combo"]="faesa_areadesafisico";
		$tabla_enlacecombo1_r["faesa_griddesarrollofisicoo"]["idcombo"]="escdesafisico_id";
        $tabla_enlacecombo1_r["faesa_griddesarrollofisicoo"]["enlace"]="ocupacio_enlace";
		
		
		$campos_data_r["faesa_gridmovimientosprimario"]["campos"]=array('alcanc_nombre','movipri_derecho','movipri_izquierdo');
        $campos_name_r["faesa_gridmovimientosprimario"]["titulos"]=array('Alcance','Derecho','Izquierdo');
        $tabla_combo1_r["faesa_gridmovimientosprimario"]["combo"]="faesa_alcances";
		$tabla_enlacecombo1_r["faesa_gridmovimientosprimario"]["idcombo"]="alcanc_id";
        $tabla_enlacecombo1_r["faesa_gridmovimientosprimario"]["enlace"]="ocupacio_enlace";
		
		$campos_data_r["faesa_gridfuncionmanual"]["campos"]=array('arafunman_nombre','funciman_derecho','funciman_izquierdo');
        $campos_name_r["faesa_gridfuncionmanual"]["titulos"]=array('Area','Derecho','Izquierdo');
        $tabla_combo1_r["faesa_gridfuncionmanual"]["combo"]="faesa_areafuncionmanual";
		$tabla_enlacecombo1_r["faesa_gridfuncionmanual"]["idcombo"]="arafunman_id";
        $tabla_enlacecombo1_r["faesa_gridfuncionmanual"]["enlace"]="ocupacio_enlace";
		
		
		$campos_data_r["faesa_gridbimanual"]["campos"]=array('arabima_nombre','biman_resultado');
        $campos_name_r["faesa_gridbimanual"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridbimanual"]["combo"]="faesa_areabimanual";
		$tabla_enlacecombo1_r["faesa_gridbimanual"]["idcombo"]="arabima_id";
        $tabla_enlacecombo1_r["faesa_gridbimanual"]["enlace"]="ocupacio_enlace";
		
		$campos_data_r["faesa_gridmanipulativa"]["campos"]=array('areamanipu_nombre','manipu_resultado');
        $campos_name_r["faesa_gridmanipulativa"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridmanipulativa"]["combo"]="faesa_areamanipulativa";
		$tabla_enlacecombo1_r["faesa_gridmanipulativa"]["idcombo"]="areamanipu_id";
        $tabla_enlacecombo1_r["faesa_gridmanipulativa"]["enlace"]="ocupacio_enlace";
		
		$campos_data_r["faesa_gridgrafomotora"]["campos"]=array('areagrafom_nombre','grafom_resultado');
        $campos_name_r["faesa_gridgrafomotora"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridgrafomotora"]["combo"]="faesa_areagrafomotora";
		$tabla_enlacecombo1_r["faesa_gridgrafomotora"]["idcombo"]="areagrafom_id";
        $tabla_enlacecombo1_r["faesa_gridgrafomotora"]["enlace"]="ocupacio_enlace";
		
		
		$campos_data_r["faesa_gridocular"]["campos"]=array('areaocular_nombre','ocular_resultado');
        $campos_name_r["faesa_gridocular"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridocular"]["combo"]="faesa_areaocular";
		$tabla_enlacecombo1_r["faesa_gridocular"]["idcombo"]="areaocular_id";
        $tabla_enlacecombo1_r["faesa_gridocular"]["enlace"]="ocupacio_enlace";
		
		//terapia ocupacional
		
		for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
		 {
		
		  include($director."libreria/estructura/".$lista_tbldata[$itbl].".php");
		
		 } 
		$objformulario->sisfield_arr=$gogess_sisfield;
		$objformulario->sistable_arr=$gogess_sistable;
		
		$busca_dtabla="select * from gogess_sistable where tab_name='".$tabla."'";
        $rs_dtabla = $DB_gogess->executec($busca_dtabla,array());
        $table=$rs_dtabla->fields["tab_name"];  
        $campo_primariodata=$rs_dtabla->fields["tab_campoprimario"]; 
		
		$em_id_val=0;	
	    $csearch=0;	
	    $variableb=0;
		$csearch=$psic_id_valor;				 
				  $contenido_informes='';
         $objformulario->form_format_tabla($table,$DB_gogess);
		 $objformulario->systemb=@$system;
		 $objformulario->apl=@$apl;
         $objformulario->seccapl=@$seccapl;
         $objformulario->sessid=@$sessid;
         $objformulario->aplweb=@$apl;
         $objformulario->portalweb=@$portal;
         $objformulario->tiposis="web";
         $objformulario->imprpt=1;
		 $objformulario->pathexterno=@$director;
         $objformulario->pathexternoimp=@$director;
         $objformulario->campos_formatoc=@$campos_tipo;	
         $objformulario->idvalor_validador=@$csearch;
		 
		 $objformulario->vatajo=@$csearch;		   
		 $objformulario->campoorden=@$campoorden;
	     $objformulario->forden=@$forden;
		 $objformulario->id_inicio=@$id_inicio;   
		 $objformulario->formulario_buscar($table,@$csearch,@$listab,@$campo,@$obp,$DB_gogess);
		 
		 //concatena valorees y datos
		 
		 
		 $busca_g="select distinct fie_groupprint from gogess_sisfield where tab_name='".$table."' and fie_groupprint>0 and fie_group not in(".$grupoblock.") order by fie_groupprint asc";
$rs_buscag = $DB_gogess->executec($busca_g,array());
				if($rs_buscag)
                   {
	                  while (!$rs_buscag->EOF) {	
					  
					  
					  //verifica si hay datos en el grupo
					  $datos_valordata='';
					  $concatena_data='';
					  $bandera_valor=0;
					   $obtiene_camposlleno="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcamposlleno = $DB_gogess->executec($obtiene_camposlleno,array());
					  if($rs_bbcamposlleno)					  
					  {
					     while (!$rs_bbcamposlleno->EOF) {
						 
						   // $datos_valordata='';
						   if($rs_bbcamposlleno->fields["fie_guarda"]==1)
						   {
								//-------------------------------
								$datos_valordata=$objformulario->contenid[$rs_bbcamposlleno->fields["fie_name"]];
								if($datos_valordata=='0')
								{
								 $datos_valordata='';
								}
								
								$concatena_data.=$datos_valordata;
								//-------------------------------
								
						   }	
						   else
						   {
						   
						        if($rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid2')
								{
								  $concatena_data.='si';
								}
								
								if($rs_bbcamposlleno->fields["fie_typeweb"]=='camposub_grid')
								{
								    
								   if($table=='faesa_psicologia')
								   {
								   //------------------------
								   if($objformulario->contenid["psic_enlace"])
								   {
								      $busca_registros="select count(1) as cuenta_valor from ".$rs_bbcamposlleno->fields["fie_tablasubgrid"]." where ".$rs_bbcamposlleno->fields["fie_campoenlacesub"]."='".$objformulario->contenid["psic_enlace"]."'";
									  $rs_cuentareg = $DB_gogess->executec($busca_registros,array());
									  
									  if($rs_cuentareg->fields["cuenta_valor"]>0)
									  {
									    $concatena_data.='si';
									  }
								   
								   }
								   //------------------------
								   }
								   
								   if($table=='faesa_pedagogia')
								   {
								   //-------------------------------
									   if($objformulario->contenid["pedago_enlace"])
									   {
										  $busca_registros="select count(1) as cuenta_valor from ".$rs_bbcamposlleno->fields["fie_tablasubgrid"]." where ".$rs_bbcamposlleno->fields["fie_campoenlacesub"]."='".$objformulario->contenid["pedago_enlace"]."'";
										  $rs_cuentareg = $DB_gogess->executec($busca_registros,array());
										  
										  if($rs_cuentareg->fields["cuenta_valor"]>0)
										  {
											$concatena_data.='si';
										  }
									   
									   }
								   //--------------------------------
								   }
								   
								
								}
						   
						   }
												 
						 $rs_bbcamposlleno->MoveNext();
						 }
					  
					  }
					  
					
					  
					  if($concatena_data)
					  {
					  
					  
					  //echo $rs_buscag->fields["fie_groupprint"]."<br>";
					  
					  $obtiene_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcampos = $DB_gogess->executec($obtiene_campos,array());
					  if($rs_bbcampos)
					  {
					       while (!$rs_bbcampos->EOF) {
						   
						   //echo $rs_bbcampos->fields["fie_name"]."<br>";
						   
						   ///------------------------------------------------------
						   $fie_title="";
						   if (!($rs_bbcampos->fields["fie_tactive"]))
							{
								$fie_title="";
							}
							else
							{
							
							   $fie_title="<label><b>".$rs_bbcampos->fields["fie_title"]."</b></label> ";
							}
						   
						   
						   if($rs_bbcampos->fields["fie_guarda"]==1)
						   { 
							
						
							   if (!(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]==""))
							   {
									 if ($rs_bbcampos->fields["fie_value"]=="replace")
									 {
										$valorbus=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
									 }
									 else
									 {
										if($rs_bbcampos->fields["fie_typeweb"]=='tiempobloque')
										{
										   $separa_fecha=array();
										   $separa_fecha=explode("-",$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]);
										   
										   $rmp=@$separa_fecha[0]." a&ntilde;os ".@$separa_fecha[1]." meses";
										}
										else
										{
										$rmp=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										}
										
									 }
							        
									if(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]!='0')
									{
									  $saltotitulo="";
									  if($rs_bbcampos->fields["fie_name"]=='psic_impresiondiagnostica')
									  {
									    $saltotitulo="<br><b>IV. RECOMENDACIONES</b>";
										$contenido_informes.="<br>".$fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'" ><p align="justify" >'.utf8_decode($rmp).'</p></span>'.$saltotitulo;
									  }
									  else
									  {
									    $contenido_informes.="<br>".$fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'" ><p align="justify" >'.utf8_decode($rmp).'</p></span>';
									  }
									  
									  $saltotitulo="";				                                     
									  }
							   }
							   else
							   {
								    if($rs_bbcampos->fields["fie_sendvar"])
									{
									
									    //-------------------------------------------------------------------------------------
										
										if ($rs_bbcampos->fields["fie_value"]=="replace")
										 {
											$valorbus=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
											$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
										 }
										 else
										 {
											$rmp=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
										 }
								   
										  $contenido_informes.=$fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'" > <p align="justify" > '.$rmp.'</p></span>';	
										
										
										//--------------------------------------------------------------------------------------
									 
									
									}

							   
							   }
						   
						   
						   }
						   else
						   {
						   
						      
								  if($rs_bbcampos->fields["fie_archivogrid"])
								  {
								   
								    //include("../".$template_reemplazo."".$rs_bbcampos->fields["fie_archivogrid"]);
									
	
									$rs_bbcampos->fields["fie_campoenlacesub"];
									$valor_enlace='';
									$tabla_gridvalor_x=$rs_bbcampos->fields["fie_tablasubgrid"];
									$campo_enlace_x=$rs_bbcampos->fields["fie_campoenlacesub"];
									
									$campos_data=array();
									$campos_name=array();
									$tabla_combo1='';
									$tabla_enlacecombo1='';
									
									$campos_data=$campos_data_r[$tabla_gridvalor_x]["campos"];
                                    $campos_name=$campos_name_r[$tabla_gridvalor_x]["titulos"];
                                    $tabla_combo1=$tabla_combo1_r[$tabla_gridvalor_x]["combo"];
                                    $tabla_enlacecombo1=$tabla_enlacecombo1_r[$tabla_gridvalor_x]["idcombo"];

									
									$sqlcampos='';
									for($i=0;$i<count($campos_data);$i++)
										 {
											 $sqlcampos=$sqlcampos.",".$campos_data[$i];
										 }
									$sqlcampos=substr($sqlcampos,1);
									
									$cuenta=0;
									if($tabla_combo1)
									{
									$lista_servicios="select ".$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"].",".$sqlcampos." from ".$tabla_gridvalor_x." inner join ".$tabla_combo1." on ".$tabla_gridvalor_x.".".$tabla_enlacecombo1."=".$tabla_combo1.".".$tabla_enlacecombo1." where ".$campo_enlace_x."='".$rs_sihaydata->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]."'";
									}
									else
									{
									$lista_servicios="select ".$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"].",".$sqlcampos." from ".$tabla_gridvalor_x." where ".$campo_enlace_x."='".$rs_sihaydata->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]."'";
									
									}
									
									//echo $lista_servicios;
									$rs_data = $DB_gogess->executec($lista_servicios,array());
									
									if($rs_data->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]>0)
									{
									    $contenido_informes.="<br><b>".$fie_title."</b><br><br>";
									   	
										if($tabla_gridvalor_x=='faesa_pedagogiacompetencias')
										{
										      
											  $lista_porcombo="select * from ".$tabla_combo1;
											  $rs_listacombo = $DB_gogess->executec($lista_porcombo,array());
											  if($rs_listacombo)
										      {
												  while (!$rs_listacombo->EOF) {	
												  
												     $lista_serviciosgroup="select ".$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"].",".$sqlcampos." from ".$tabla_gridvalor_x." inner join ".$tabla_combo1." on ".$tabla_gridvalor_x.".".$tabla_enlacecombo1."=".$tabla_combo1.".".$tabla_enlacecombo1." where ".$campo_enlace_x."='".$rs_sihaydata->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]."' and ".$tabla_combo1.".tipcompe_id=".$rs_listacombo->fields["tipcompe_id"];
													  
													  $rs_listagropu = $DB_gogess->executec($lista_serviciosgroup,array());
													  
													  $contenido_informestbl='';
													 
													  $contenido_informestbl.="<p><b>".$rs_listacombo->fields["tipcompe_nombre"]."</b></p>".'<table class="table table-bordered"  style="width:100%" border="1" cellpadding="1" cellspacing="0" >';
													  $contenido_informestbl.='<thead><tr>';
													  for($i=1;$i<count($campos_name);$i++)
														 {
															 $contenido_informestbl.='<th style="border: 1px solid #999999;" ><b>'.$campos_name[$i].'</b></th>';
													
														 }
													  $contenido_informestbl.='</tr></thead><tbody>';
													  
													  if($rs_listagropu)
														 {
															  while (!$rs_listagropu->EOF) {	
															  
															  
																$cuenta++;
																$contenido_informestbl.='<tr>';
															 
																	for($i=1;$i<count($campos_data);$i++)
																	 {
																		 
																		 $contenido_informestbl.='<td style="border: 1px solid #999999;" >'.str_replace(".",".<br>",utf8_decode($rs_listagropu->fields[$campos_data[$i]])).'</td>';
																	 }
														 
																$contenido_informestbl.='</tr>';
																
																
														   
															   $rs_listagropu->MoveNext();	   
															  }
														  }
													  
													  
												      $contenido_informestbl.='</tbody></table></p>';
													  
													 $contenido_informes.=$contenido_informestbl;
													 
													 
													 $rs_listacombo->MoveNext();	 
												  }
											  }
											  
											  
										  
										}
										else
										{					
										
										$contenido_informes.='<table class="table table-bordered"  style="width:100%" border="1" cellpadding="1" cellspacing="0" >';
										$contenido_informes.='<thead><tr>';
									    
											for($i=0;$i<count($campos_name);$i++)
											 {
												 $contenido_informes.='<th style="border: 1px solid #999999;" ><b>'.$campos_name[$i].'</b></th>';
										
											 }
										
										$contenido_informes.='</tr></thead><tbody>';
										
										if($rs_data)
										 {
											  while (!$rs_data->EOF) {	
												$cuenta++;
												
												if($rs_data->fields[$campos_data[1]])
												{
										        $contenido_informes.='<tr>';
											 
													for($i=0;$i<count($campos_data);$i++)
													 {
														 
														 $contenido_informes.='<td style="border: 1px solid #999999;" >'.str_replace(".",".<br>",utf8_decode($rs_data->fields[$campos_data[$i]])).'</td>';
													 }
										 
										        $contenido_informes.='</tr>';
												}
										   
										       $rs_data->MoveNext();	   
											  }
										  }

										$contenido_informes.='</tbody></table></p>';
										}
									 
									}
									
	                                
									
									
									
								  }
						          else
								  {
			                            
									   if($rs_bbcampos->fields["fie_typeweb"]=='campo_subetiqueta')
										{
										 $contenido_informes.="<br><div style='color:#666666' ><b>".$fie_title."</b></div>";
										}
										else
										{
										 $contenido_informes.="<br><b>".$fie_title."</b><hr>";
										
										}	
								       
								       
								  }
								  
						   
						   }
						   ///-------------------------------------------------------
						   
						   
						   
						   $rs_bbcampos->MoveNext();
						   }
					  
					  }
					  
					  
					  }
					  
					  $rs_buscag->MoveNext();
					  }
				    }	
		 
		 
		 
		 
		 //concatena valores y datos

		return  $contenido_informes; 

}

function SumaHoras( $hora, $minutos_sumar ) 
{ 
   $minutoAnadir=$minutos_sumar;
   $segundos_horaInicial=strtotime($hora);
   $segundos_minutoAnadir=$minutoAnadir*60;
   $nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
   return $nuevaHora;
}


function genera_arrayhora($hora_ini,$rango_hora,$hora_fin)
{

$explodearray=array();
if($this->horassueltas)
{
@$explodearray=explode(",",$this->horassueltas);
}

$formatea_array=array();
for($k=0;$k<count($explodearray);$k++)
{  
   $lista_h=array();
   $lista_h=explode(":",$explodearray[$k]);
   @$formatea_array[$k]=$lista_h[0].":".$lista_h[1];
}


$hora_i=$hora_ini;
//echo $this->SumaHoras($hora_i,$rango_hora);
$arreglo_horas=array();
$i=0;
while ($hora_i != $hora_fin) {
  $arreglo_horas[$i]=$this->SumaHoras($hora_i,$rango_hora);
  $hora_i=$arreglo_horas[$i];
  $i++;
}

$concatena_array=array();
$concatena_array=array_merge($formatea_array,$arreglo_horas);
asort($concatena_array);
$concatena_array=array_values(array_unique($concatena_array));
return $concatena_array;

}



function genera_insertempleado($tabla_gridvalor,$campo_enlace,$campo_fecharegistro,$valor_enlace,$valor_usuario,$valor_fecha,$_POSTx,$campos_data)
{

    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 {
	   if($campos_data[$i])
	   {
	     $sqlcampos=$sqlcampos.",".$campos_data[$i];
	     $sqlvalues=$sqlvalues.",'".str_replace("'", "\'",$_POSTx[$campos_data[$i]."x"])."'"; 
	   }
	 }	 

	 $sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,1); 

	 if($campo_fecharegistro)
	 {
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.",".$campo_enlace.",".$campo_fecharegistro.",usuar_id) values (".$sqlvalues.",'".$valor_enlace."','".$valor_fecha."','".$valor_usuario."')";
	 }
	 else
	 {
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.",".$campo_enlace.",usuar_id) values (".$sqlvalues.",'".$valor_enlace."','".$valor_usuario."')";
	 }	 
//echo $sql_1;
	return $sql_1;
}




}
?>