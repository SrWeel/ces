<?php
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["val_afacturar"]."<br>";
//echo $_POST["prod_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{
$lista_especialidad='';

if(@$_POST["prod_id_pr"])
{
$busca_serial="select usua_id,prod_codigo,prod_id from efacsistema_producto where  prod_paraterapia=1 and prod_id='".$_POST["prod_id_pr"]."'";
}
else
{
$busca_serial="select usua_id,prod_codigo,prod_id from efacsistema_producto where  prod_paraterapia=1";
}

$rs_serial = $DB_gogess->executec($busca_serial,array());

$lista_t='';
$lista_nt='';
$fecha_horat='';
$seleccionados=array();
$seleccionados=explode(",",$_POST["val_afacturar"]);
//print_r($seleccionados);
$contador=0;
for($i=0;$i<count($seleccionados);$i++)
{
    if($seleccionados[$i]>0)
	{
	 $contador++;
	 
	 //----------------------------------
	  $lista_t.=$seleccionados[$i].",";
	  
	  $busca_tera1="select * from faesa_terapiasregistro where terap_id='".$seleccionados[$i]."'";
      $rs_bctera = $DB_gogess->executec($busca_tera1,array());
	 
	  $busca_cliente1="select * from app_usuario where usua_id='".$rs_bctera->fields["usua_id"]."'";
      $rs_bcliente1 = $DB_gogess->executec($busca_cliente1,array());
	  
	  $busca_area="select * from dns_especialidad where especi_id='".$rs_bcliente1->fields["especi_id"]."'";
      $rs_area = $DB_gogess->executec($busca_area,array());
	  
	  $lista_especialidad.=$rs_area->fields["especi_iniciales"].",";
	  //dns_especialidad
	 // especi_id
	  
	  $lista_nt.=$rs_bcliente1->fields["usua_nombre"]." ".$rs_bcliente1->fields["usua_apellido"].", ";
	 //---------------------------------
	  //---------------------------------
	  //-fecha_hora
	  $fecha_horat.=$rs_bctera->fields["terap_fecha"]." ".$rs_bctera->fields["terap_hora"].",";
	   
	  //---------------------------------
	 
	}

}

echo $contador;
$lista_esp =array();
$lista_esp = array_values(array_unique(explode(",",$lista_especialidad)));

$lista_especialidad=implode("-",$lista_esp);


$prod_id=$rs_serial->fields["prod_id"];
$cantidad=$contador;

if($cantidad>0)
{

$lista_medico=array();
$lista_medico=explode(",",$lista_t);
$lista_medico = array_values(array_unique($lista_medico));
$lista_t=implode(",",$lista_medico);

$lista_nmedico=array();
$lista_nmedico=explode(",",$lista_nt);
$lista_nmedico = array_values(array_unique($lista_nmedico));
$lista_nt=implode(",",$lista_nmedico);

//-----------------------------------------------
$obtiene_cliente="select * from dns_atencion where atenc_hc='".$_POST["atenc_hc"]."'";
$rs_cliente = $DB_gogess->executec($obtiene_cliente,array());


$lista_hijos="select distinct tipopac_id,clie_nombre,clie_apellido,clie_id from app_cliente where clie_id='".trim($rs_cliente->fields["clie_id"])."'";
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
	case 9:
        $valor_precio="prod_apadrinado";
        break;					
    }

 

$cantidad_nueva=0;
$cantidad_actual=0;	
//echo $_POST["val_afacturar"]."<br>";
//echo $_POST["atenc_hc"]."<br>";
//echo $_POST["enlace"]."<br>";

$busca_agregado="select * from beko_lqdetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());
$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];


if($cantidad_actual>=1)
{

$borra_data="delete from beko_lqdetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());
$cantidad_nueva=$cantidad;

}
else
{

$cantidad_nueva=$cantidad;

}


$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$rs_serial->fields["prod_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());


$codigo_enc='';
		
//$codigo_enc=$nombre_n." ". $apellido_n." ".$_POST["atenc_hc"]." ".$fecha_horat." ".$lista_especialidad;

$codigo_enc=$nombre_n." ". $apellido_n." ".$_POST["atenc_hc"]." ".$lista_especialidad;

if($codigo_enc)
{

$inserta_producto="insert into beko_lqdetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,atenc_hc,terap_id,docdet_codigoterapeutas,docdet_nombreterapeutas) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$rs_dataproducto->fields["prod_nombre"]." - ".$codigo_enc.""."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields[$valor_precio]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."','".$_POST["atenc_hc"]."','".$_POST["val_afacturar"]."','".$lista_t."','".$lista_nt."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}
else
{

$inserta_producto="insert into beko_lqdetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,atenc_hc,terap_id,docdet_codigoterapeutas,docdet_nombreterapeutas) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$rs_dataproducto->fields["prod_nombre"]."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields[$valor_precio]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."','".$_POST["atenc_hc"]."','".$_POST["val_afacturar"]."','".$lista_t."','".$lista_nt."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}
///echo $inserta_producto;
//-----------------------------------------------
}
else
{

  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">Porfavor seleccione la terapia a facturar...</div>';
}


}
else
{

$varable_enviafunc='';
  // $varable_enviafunc=base64_encode("buscar_terapia()");
	
		
	//enviar
	echo '
	<script type="text/javascript">
	<!--
	abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
	//  End -->
	</script>
	
	<div id="divBody_acsession"></div>
	';


}
?>