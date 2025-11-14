<?php
$tiempossss=4555000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["prod_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{


$cantidad_nueva=0;
$cantidad_actual=0;

//busca serial
//$busca_serial="select usua_id,prod_codigo from efacsistema_producto where prod_id=".$_POST["prod_id"];


 $busca_serial="select eteneva_id,dns_atencionevaluacion.prod_precio,clie_nombre,clie_apellido,dns_atencionevaluacion.prod_id,eteneva_id,dns_atencionevaluacion.prod_id,efacsistema_producto.prod_codigo from dns_atencionevaluacion inner join app_cliente on dns_atencionevaluacion.clie_id=app_cliente.clie_id  
	inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace
	inner join efacsistema_producto on dns_atencionevaluacion.prod_id=efacsistema_producto.prod_id
	 where eteneva_id=".$_POST["prod_id"]."";
	 
$rs_serial = $DB_gogess->executec($busca_serial,array());	 


//

//obtine codigo doc
$codigo_enc='';
//obtiene codigo doc

 $busca_agregado="select * from beko_lqdetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and doccab_id='".$_POST["enlace"]."'";
$rs_agregado = $DB_gogess->executec($busca_agregado,array());

$cantidad_actual=$rs_agregado->fields["docdet_cantidad"];

if($cantidad_actual>=1)
{

$borra_data="delete from beko_lqdetalle where docdet_codprincipal='".$rs_serial->fields["prod_codigo"]."' and  doccab_id='".$_POST["enlace"]."'";
$rs_okb = $DB_gogess->executec($borra_data,array());
$cantidad_nueva=$cantidad_actual+$_POST["cant_val"];

}
else
{
$cantidad_nueva=$_POST["cant_val"];

}


//$busca_dataproducto="select '".$_POST["enlace"]."' as doccab_id,prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(prod_precio) as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$_POST["prod_id"];
//$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());



$busca_dataproducto="select eteneva_id, 
'".$_POST["enlace"]."' as doccab_id,
efacsistema_producto.prod_codigo,
efacsistema_producto.prod_nombre,
'".$cantidad_nueva."' as docdet_cantidad,
(".$rs_serial->fields["prod_precio"].") as prod_precio,
efacsistema_producto.impu_codigo,
efacsistema_producto.tari_codigo,
tari_valor,
(((".$cantidad_nueva."*(".$rs_serial->fields["prod_precio"]."))*tari_valor)/100) as docdet_valorimpuesto,
(".$cantidad_nueva."*(".$rs_serial->fields["prod_precio"].")) as docdet_total,
".$_SESSION['ces1313777_sessid_inicio']." as usua_id,
clie_nombre,
clie_apellido
 from dns_atencionevaluacion inner join app_cliente on dns_atencionevaluacion.clie_id=app_cliente.clie_id  
	inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace
	inner join efacsistema_producto on dns_atencionevaluacion.prod_id=efacsistema_producto.prod_id
	inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo
	 where eteneva_id=".$_POST["prod_id"]."";

$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());


$ver_grupo="select * from faesa_asigahorario inner join faesa_grupos on faesa_asigahorario.grup_id=faesa_grupos.grup_id where eteneva_id=".$rs_dataproducto->fields["eteneva_id"];
$rs_vergrupo = $DB_gogess->executec($ver_grupo,array());

$busca_hora="select * from faesa_integragrupo where grup_id=".$rs_vergrupo->fields["grup_id"]." order by integr_hora asc limit 1";
$rs_bhora = $DB_gogess->executec($busca_hora,array());

//saca codigos y nombres
$lista_t='';
$lista_nt='';
$busca_horaxn="select * from faesa_integragrupo where grup_id=".$rs_vergrupo->fields["grup_id"]."";
$rs_bhoraxn = $DB_gogess->executec($busca_horaxn,array());
if($rs_bhoraxn)
 {
     while (!$rs_bhoraxn->EOF) {	
	 
	  $lista_t.=$rs_bhoraxn->fields["usua_id"].",";
	  
	  $busca_cliente1="select * from app_usuario where usua_id='".$rs_bhoraxn->fields["usua_id"]."'";
      $rs_bcliente1 = $DB_gogess->executec($busca_cliente1,array());
	  
	  $lista_nt.=$rs_bcliente1->fields["usua_nombre"]." ".$rs_bcliente1->fields["usua_apellido"].", ";
	  
	  $rs_bhoraxn->MoveNext();
	  }
 }	  

$lista_medico=array();
$lista_medico=explode(",",$lista_t);
$lista_medico = array_values(array_unique($lista_medico));
$lista_t=implode(",",$lista_medico);

$lista_nmedico=array();
$lista_nmedico=explode(",",$lista_nt);
$lista_nmedico = array_values(array_unique($lista_nmedico));
$lista_nt=implode(",",$lista_nmedico);
//saca codigos y nombres
	  
$nombre_pro='';
$nombre_pro=$rs_dataproducto->fields["clie_nombre"]." ".$rs_dataproducto->fields["clie_apellido"]." ".$rs_dataproducto->fields["prod_nombre"]." ".$rs_vergrupo->fields["asighor_fecha"]." ".$rs_vergrupo->fields["grup_nombre"]." Hora: ".$rs_bhora->fields["integr_hora"];


 $inserta_producto="insert into beko_lqdetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,eteneva_id,docdet_codigoterapeutas,docdet_nombreterapeutas) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$nombre_pro."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields["prod_precio"]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."','".$rs_dataproducto->fields["eteneva_id"]."','".$lista_t."','".$lista_nt."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());



}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>