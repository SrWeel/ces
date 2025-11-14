<?php

function lista_p($centro_id,$prof_id,$valor_b,$conve_id,$DB_gogess)
{

$bandera=0;
//===============================================================================================

@$tippo_id=3;

$fuente_precio="prod_precio";
if($tippo_id==1)
{
$fuente_precio="prod_preciotarifarionacional";
}
else
{
$fuente_precio="prod_precio";
}

$sql1='';
$sql2='';

$busca_espcialida="select * from cesdb_arextension.dns_profesion where prof_id='".$prof_id."'";
$rs_dataespcialidad = $DB_gogess->Execute($busca_espcialida);

if($rs_dataespcialidad->fields["prof_especialidad"]==1)
{


if($prof_id=='911116')
{
$tabla_tmporalespe="select prod_id,'".$prof_id."' as prof_id,prod_nombre,prod_codigo,prod_precio,prod_preciotarifarionacional,tipp_id from efacsistema_producto where prod_codigo in ('97814') and prod_nivel=1";
}
else
{
//99212 sub
$tabla_tmporalespe="select prod_id,'".$prof_id."' as prof_id,prod_nombre,prod_codigo,prod_precio,prod_preciotarifarionacional,tipp_id from efacsistema_producto where prod_codigo in ('99202') and prod_nivel=1";
}

$sql_new="select distinct prod_codigo,prod_nombre,".$fuente_precio." from  app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace inner join (".$tabla_tmporalespe.") tblespe on dns_gridfuncionprofesional.prof_id=tblespe.prof_id";

}

if($rs_dataespcialidad->fields["prof_especialidadconcodigo"]==1)
{

//subsecuentes 99211

$tabla_tmporalespe="select prod_id,prod_nombre,prod_codigo,prod_precio,prof_id,tipp_id from efacsistema_producto inner join dns_gridaplicaen on efacsistema_producto.prod_enlace=dns_gridaplicaen.prod_enlace where prof_id='".$prof_id."' and prod_nivel=1 and tipp_id=2 and prod_codigo not in ('99211')";

//$sql_new="select *,app_usuario.usua_id as usuat_id from  app_usuario inner join (".$tabla_tmporalespe.") tblespe on app_usuario.usua_formaciondelprofesional=tblespe.usua_formaciondelprofesional";

$sql_new="select distinct prod_codigo,prod_nombre,".$fuente_precio." from  app_usuario inner join dns_gridfuncionprofesional on app_usuario.usua_enlace=dns_gridfuncionprofesional.usua_enlace inner join (".$tabla_tmporalespe.") tblespe on dns_gridfuncionprofesional.prof_id=tblespe.prof_id";

}

//---------------------------------------------------------------------------------------


if($prof_id)
{
$sql1=" dns_gridfuncionprofesional.prof_id = '".@$prof_id."' and ";
}

if($valor_b)
{
$sql2=" (dns_gridfuncionprofesional.prof_id = '".@$valor_b."' or usua_nombre like '%".$valor_b."%' or usua_apellido like '%".$valor_b."%' ) and (prof_id in(select prof_id from cesdb_arextension.dns_profesion where prof_nosalir=0)) and ";
}
$concatenado=$sql1.$sql2;
$concatenado=substr($concatenado,0,-4);

$despliega_d='';

$despliega_d.='<table class="table table-bordered"  style="width:100%" >
  <tr bgcolor="#73A4AC">
    <td class="ccss_text" style="color:#FFFFFF"><span class="ccss_text">No</span></td>
	<td class="ccss_text" style="color:#FFFFFF" ><span class="ccss_text">C&oacute;digo</span></td>
	<td class="ccss_text" style="color:#FFFFFF" ><span class="ccss_text">Area</span></td>
	<td class="ccss_text" style="color:#FFFFFF" ><span class="ccss_text">Precio</span></td>
  </tr>';


 $cuenta=0;
 if($concatenado)
 {
  
   $lista_servicios=$sql_new." and  usua_ciruc not in('1711467884','1714907449') and (dns_gridfuncionprofesional.prof_id in(select prof_id from cesdb_arextension.dns_profesion where prof_nosalir=0)) and ".$concatenado."  and usua_estado=1 and app_usuario.centro_id='".$centro_id."'";
   
  
 }
 else
 {
   
	$lista_servicios=$sql_new." and  usua_ciruc not in('1711467884','1714907449') and (dns_gridfuncionprofesional.prof_id in(select prof_id from cesdb_arextension.dns_profesion where prof_nosalir=0)) and usua_estado=1 and app_usuario.centro_id='".$centro_id."'";
	
 
 }
 
 
 $rs_data = $DB_gogess->Execute($lista_servicios);
 if($rs_data)
 {

	  while (!$rs_data->EOF) {	
	    $cuenta++;     
		
		    
	 //ver precio convenio
	  $gconve_precio=0;
	  if($conve_id>0)
      {
	    $busca_valorconvenio="select * from cesdb_arextension.dns_gridconvenios conve inner join efacsistema_producto on conve.prod_enlace=efacsistema_producto.prod_enlace where prod_id='".$rs_data->fields["prod_id"]."' and gconve_convenio='".$conve_id."'";
		$rs_valorconvenio = $DB_gogess->Execute($busca_valorconvenio);
	    $gconve_precio=$rs_valorconvenio->fields["gconve_precio"];
	  }
	  
	  if($gconve_precio>0)
		{
			//$saca_descuentovalor=($conve_descuento*$rs_data->fields["prod_precio"])/100;
			$valor_precio=$gconve_precio;
		}
	  else
	    {
		    $valor_precio=$rs_data->fields[$fuente_precio];
		}
	  
	  //ver precio convenio

  $despliega_d.='<tr>
	<td class="ccss_text"><span class="ccss_text">'.$cuenta.'</span></td>
	<td class="ccss_text"><span class="ccss_text">'.$rs_data->fields["prod_codigo"].'</span></td>  
	<td class="ccss_text"><span class="ccss_text">'.$rs_dataespcialidad->fields["prof_nombre"].'('.$rs_data->fields["prod_nombre"].')</span></td>    
	<td nowrap="nowrap" class="ccss_text"><span class="ccss_text">$ '.$valor_precio.'</span></td>     
  </tr>';
        
		$bandera=1;

        $rs_data->MoveNext();
	  }
  }

$despliega_d.='</table>';

if($bandera==0)
{
  $despliega_d='';
}

//===================================================================================================

return $despliega_d;

}

?>