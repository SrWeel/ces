<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$crb_id=$_POST["genr_id"];
$valor_id=$_POST["genr_id"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$genr_id=$crb_id;

$lista_rolg="select * from conco_generarroles where genr_id='".$genr_id."'";
$resultl_rolg = $DB_gogess->executec($lista_rolg,array());

$genr_anio=$resultl_rolg->fields["genr_anio"];
$genr_mes=$resultl_rolg->fields["genr_mes"];

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));

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

//
//1-costo
//2-gasto



$concatena='';
//$lista_empleados="select * from conco_roles where genr_id='".$genr_id."' and usua_id in(1,257,272,55,255,285,231,275,69,27,261)";
//if(@$valcedula_val)
//{
//$datos_empl="select * from app_usuario where usua_estado=1 and usua_ciruc='".$valcedula_val."'";
//$resultl_empl=$DB_gogess->executec($datos_empl,array());
//$lista_empleados="select * from conco_roles  where genr_id='".$genr_id."' and usua_id in(".$resultl_empl->fields["usua_id"].") ";
//}
//else
//{
echo $lista_empleados="select * from conco_roles inner join app_usuario on conco_roles.usua_id=app_usuario.usua_id where usua_estado=1 and genr_id='".$genr_id."' order by usua_apellido asc";
//}

$ilista_arch=0;
$array_larch=array();
$array_haber=array();	
$cuenta_lista=0;	

$resultl_listaroles = $DB_gogess->executec($lista_empleados,array());
if($resultl_listaroles)
{
      while (!$resultl_listaroles->EOF)
		{
		  
		  $info_tipopersonal=0;
		  $datos_empleado="select * from app_usuario where usua_id='".$resultl_listaroles->fields["usua_id"]."'";
		  $resultl_empleado= $DB_gogess->executec($datos_empleado,array());
		  
		  $obtiene_cargos="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace inner join app_tipounidad on 		
grid_infolaboral3.info_unidad=app_tipounidad.tipouni_id inner join cmb_puestoinstitucional on grid_infolaboral3.info_puestoinstitucional=cmb_puestoinstitucional.tipoinst_id where info_fechadesalida='0000-00-00' and app_usuario.usua_id='".$resultl_listaroles->fields["usua_id"]."' order by info_id desc limit 1";
          $rs_cargos=$DB_gogess->executec($obtiene_cargos,array());
		  
		  $info_tipopersonal=$rs_cargos->fields["info_tipopersonal"];
		  
		  $info_unidad=$rs_cargos->fields["info_unidad"];
		  $info_partidapresupuestaria=$rs_cargos->fields["info_partidapresupuestaria"];
		  
		  $busca_cuenta="select * from lpin_plancuentas where planc_id='".$info_partidapresupuestaria."'";
		  $rs_bucuenta=$DB_gogess->executec($busca_cuenta,array());
		 
		 if($info_unidad==17)
		 {
		 echo $obtiene_cargos."<br>";
		 echo $info_unidad."<br>";
		 //=============================================================================== 
		  
		$busca_ingresos="select conco_detalleroles.detlroll_id,conco_detalleroles.roles_id,conco_detalleroles.rubrg_id,conco_detalleroles.rubrg_nombre,conco_detalleroles.rubrg_ingresoegreso,conco_detalleroles.rubrg_valor,conco_detalleroles.rubrg_formula,conco_detalleroles.rubrg_salariominimo,conco_detalleroles.tipprub_id,conco_detalleroles.genr_id,conco_detalleroles.usua_id,detlroll_tabla,detlroll_idtabla,detlroll_idcampo from conco_detalleroles inner join conco_rubrosg on conco_detalleroles.rubrg_id=conco_rubrosg.rubrg_id where roles_id='".$resultl_listaroles->fields["roles_id"]."'";
		
		//echo  $busca_ingresos."<br>";
		  //and conco_detalleroles.rubrg_ingresoegreso=1
		  //and tiporub_id=1
		  
		  //echo $busca_ingresos."<br>";
		  $suma_ing=0;
		  $suma_egr=0;
		  
		  $resultl_ingresos= $DB_gogess->executec($busca_ingresos,array());
		  if($resultl_ingresos)
           {
		       while (!$resultl_ingresos->EOF)
		       {
			    
				    $rubrg_ingresoegreso=$resultl_ingresos->fields["rubrg_ingresoegreso"];
				    $ingreso_val.='<tr><td class="css_txt" ><b>SUELDO:</b></td> <td class="css_txts" >'.number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '').'</td></tr>';				  
				    $total_ingresos=number_format($resultl_ingresos->fields["rubrg_valor"], 2, '.', '');
	
					$detlroll_tabla=$resultl_ingresos->fields["detlroll_tabla"];
					$detlroll_idtabla=$resultl_ingresos->fields["detlroll_idtabla"];
					$detlroll_idcampo=$resultl_ingresos->fields["detlroll_idcampo"];			  
					
					if($detlroll_tabla=='')
					{
					
					$asigr_cuentadebe='';
					$asigr_cuentahaber='';
					
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//buscar cuenta
					$busca_cu="select * from conco_asiganrubro where usua_id='".$resultl_listaroles->fields["usua_id"]."' and rubrg_id='".$resultl_ingresos->fields["rubrg_id"]."'";
					$resultl_cu= $DB_gogess->executec($busca_cu,array());
					
					$asigr_cuentadebe=$resultl_cu->fields["asigr_cuentadebe"];
					$asigr_cuentahaber=$resultl_cu->fields["asigr_cuentahaber"];
					
					//busca cuenta	
								  
					if($rubrg_ingresoegreso==1)					
					{
									  
						if($asigr_cuentadebe)
						{				  
						//detalle asiento
						$array_haber[$cuenta_lista]["TIPO"]="DEBE";
						$array_haber[$cuenta_lista]["CUENTA"]=$asigr_cuentadebe;
						$array_haber[$cuenta_lista]["VALOR"]=$total_ingresos;
						$cuenta_lista++;
						
						$suma_ing=$suma_ing+$total_ingresos;
						//detalle asiento	
						}
					
					}
					
					if($rubrg_ingresoegreso==2)					
					{
					
						if($asigr_cuentahaber)
						{
						//detalle asiento
						$array_haber[$cuenta_lista]["TIPO"]="HABER";
						$array_haber[$cuenta_lista]["CUENTA"]=$asigr_cuentahaber;
						$array_haber[$cuenta_lista]["VALOR"]=$total_ingresos;
						$cuenta_lista++;
						$suma_egr=$suma_egr+$total_ingresos;
						//detalle asiento	
						}
					
					}
					
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++
					
					}
					else
					{
					
					//detlroll_tabla,detlroll_idtabla,detlroll_idcampo
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++
					//buscar cuenta
					$asigr_cuentadebe='';
					$asigr_cuentahaber='';
					
					$busca_cu="select * from ".$detlroll_tabla." where ".$detlroll_idcampo."='".$detlroll_idtabla."'";
					$resultl_cu= $DB_gogess->executec($busca_cu,array());
					
					$sacon_cmp=array();
					$sacon_cmp=explode("_",$detlroll_idcampo);
					
					$asigr_cuentadebe=$resultl_cu->fields[$sacon_cmp[0]."_cuentadebe"];
					$asigr_cuentahaber=$resultl_cu->fields[$sacon_cmp[0]."_cuentahaber"];
					
					//busca cuenta				  
									
					if($rubrg_ingresoegreso==1)					
					{
									  
						if($asigr_cuentadebe)
						{				  
						//detalle asiento
						$array_haber[$cuenta_lista]["TIPO"]="DEBE";
						$array_haber[$cuenta_lista]["CUENTA"]=$asigr_cuentadebe;
						$array_haber[$cuenta_lista]["VALOR"]=$total_ingresos;
						$cuenta_lista++;
					    $suma_ing=$suma_ing+$total_ingresos;	
						//detalle asiento	
						}						
					
					}
					
					if($rubrg_ingresoegreso==2)					
					{
					
						if($asigr_cuentahaber)
						{
						//detalle asiento
						$array_haber[$cuenta_lista]["TIPO"]="HABER";
						$array_haber[$cuenta_lista]["CUENTA"]=$asigr_cuentahaber;
						$array_haber[$cuenta_lista]["VALOR"]=$total_ingresos;
						$cuenta_lista++;
						$suma_egr=$suma_egr+$total_ingresos;
						//detalle asiento	
						}
					
					}
					
					//++++++++++++++++++++++++++++++++++++++++++++++++++++++
					
					
					
					
					}


				
				$resultl_ingresos->MoveNext();
		       }
		   }
		   
		   
		   $array_haber[$cuenta_lista]["TIPO"]="HABER";
		   $array_haber[$cuenta_lista]["CUENTA"]=$rs_bucuenta->fields["planc_codigoc"];
		   $array_haber[$cuenta_lista]["VALOR"]= $suma_ing-$suma_egr;
		   $cuenta_lista++;
						
		   
		
		//===================================================================  
		}
		
		
		$resultl_listaroles->MoveNext();
		}
}		

print_r($array_haber);


// Array de datos proporcionado
$transacciones =$array_haber;

// Array para almacenar los resultados agrupados
$resultadoAgrupado = [];

// Iterar sobre cada transacción
foreach ($transacciones as $transaccion) {
    $tipo = $transaccion['TIPO'];
    $cuenta = $transaccion['CUENTA'];
    $valor = $transaccion['VALOR'];

    // Generar una clave única combinando TIPO y CUENTA
    $clave = $tipo . '_' . $cuenta;

    // Verificar si ya existe la clave en el array resultadoAgrupado
    if (!isset($resultadoAgrupado[$clave])) {
        $resultadoAgrupado[$clave] = [
            'TIPO' => $tipo,
            'CUENTA' => $cuenta,
            'VALOR' => 0
        ];
    }

    // Sumar el valor al grupo correspondiente
    $resultadoAgrupado[$clave]['VALOR'] += $valor;
}

// Convertir el array resultadoAgrupado a un array indexado simple
$resultadoFinal = array_values($resultadoAgrupado);

// Imprimir el resultado final
$array_haber=$resultadoFinal;

$tabla_asiento='conco_generarroles';
$valor_id=$genr_id;
$tipo_code=13;
//crea asiento
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//
	
 $busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and 	comcont_rol=0";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

echo $busca_principalx="select * from conco_generarroles where genr_id='".$genr_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);

$genr_observacion=$rs_bprincipalx->fields["genr_observacion"];
$genr_mes=$rs_bprincipalx->fields["genr_observacion"];
$genr_anio=$rs_bprincipalx->fields["genr_anio"];
$genr_fechacierre=$rs_bprincipalx->fields["genr_fechacierre"];
$crb_fecha=$genr_fechacierre;

$doccab_anulado=0;


$concepto='';
$concepto=$n_tipo.' ROLES GERENCIA'.$genr_anio.'-'.$genr_mes.' '.$genr_observacion.' CODE:'.$genr_id;
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++
//preguntar se anula la factura se anula pago
$actualiza_data="update lpin_comprobantecontable set tipoa_id='".$tipo_code."',comcont_anulado='".$doccab_anulado."',comcont_fecha='".$genr_fechacierre."',comcont_concepto='".$concepto."',comcont_numeroc='".$genr_id."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
$rs_actualizdada = $DB_gogess->executec($actualiza_data);

//actualiza comprobante


//===========================================================================

$comcont_enlace=$rs_bcabecera->fields["comcont_enlace"];

$borra_dt="delete from lpin_detallecomprobantecontable where comcont_enlace='".$comcont_enlace."'";
$rs_oktd = $DB_gogess->executec($borra_dt);

for($i=0;$i<count($array_haber);$i++)
		 {
		    
			$detcc_debe=0;
			$detcc_haber=0;
			
			if($array_haber[$i]["TIPO"]=='DEBE')
			{
			$detcc_debe=$array_haber[$i]["VALOR"];
			}
			
			if($array_haber[$i]["TIPO"]=='HABER')
			{
			$detcc_haber=$array_haber[$i]["VALOR"];
			}
	
	        $detcc_cuentacontable='';
	        $detcc_cuentacontable=$array_haber[$i]["CUENTA"];
			
		   //BUSCA CUENTA
		   
		   $busca_dtacuenta="select * from lpin_plancuentas where planc_codigoc='".$detcc_cuentacontable."'";
		   $rs_bcuenta = $DB_gogess->executec($busca_dtacuenta);
		   
		   $detcc_descricpion=$rs_bcuenta->fields["planc_nombre"];
		   $detcc_referencia=$rs_bcuenta->fields["planc_nombre"];
		   
		   $comcont_enlace=$rs_bcabecera->fields["comcont_enlace"];
		   
		   //BUSCA CUENTA
		 		 
		 $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$crb_fecha."','".$comcont_enlace."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura
$busca_principalx="select * from conco_generarroles where genr_id='".$genr_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);

$genr_observacion=$rs_bprincipalx->fields["genr_observacion"];
$genr_mes=$rs_bprincipalx->fields["genr_observacion"];
$genr_anio=$rs_bprincipalx->fields["genr_anio"];
$genr_fechacierre=$rs_bprincipalx->fields["genr_fechacierre"];
$crb_fecha=$genr_fechacierre;

$doccab_anulado=0;


$concepto='';
$concepto=$n_tipo.' ROLES GERENCIA'.$genr_anio.'-'.$genr_mes.' '.$genr_observacion.' CODE:'.$genr_id;

//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$comcont_rol=0;

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,comcont_rol) VALUES
( '".$tipo_code."', '".$crb_fecha."', '".$concepto."', '".$genr_id."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','".$comcont_rol."');";

$rs_insertcab = $DB_gogess->executec($inserta_cab);
$id_gen=$DB_gogess->funciones_nuevoID(0);


if($rs_insertcab)
{
//-----------------------------------------

		 for($i=0;$i<count($array_haber);$i++)
		 {
		    
			$detcc_debe=0;
			$detcc_haber=0;
			
			if($array_haber[$i]["TIPO"]=='DEBE')
			{
			$detcc_debe=$array_haber[$i]["VALOR"];
			}
			
			if($array_haber[$i]["TIPO"]=='HABER')
			{
			$detcc_haber=$array_haber[$i]["VALOR"];
			}
	
	        $detcc_cuentacontable='';
	        $detcc_cuentacontable=$array_haber[$i]["CUENTA"];
			
		   //BUSCA CUENTA
		   
		   $busca_dtacuenta="select * from lpin_plancuentas where planc_codigoc='".$detcc_cuentacontable."'";
		   $rs_bcuenta = $DB_gogess->executec($busca_dtacuenta);
		   
		   //echo $busca_dtacuenta."<br>";
		   
		   $detcc_descricpion=$rs_bcuenta->fields["planc_nombre"];
		   $detcc_referencia=$rs_bcuenta->fields["planc_nombre"];
		   
		   //BUSCA CUENTA
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$crb_fecha."','".$comcont_enlace."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
				
		
//-----------------------------------------			
}

//===========================================================================
}





//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//crea asiento	

}

?>