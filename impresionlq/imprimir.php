<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);

session_start();

if($_SESSION['ces1313777_sessid_inicio'])

{

$director='../';

include("../cfg/clases.php");
include("../cfg/declaracion.php");

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
//include(@$director."libreria/estructura/aqualis_master.php");

$contenido = file_get_contents(@$director."jason_files/estructura/beko_documentodetalle.json");
$gogess_sisfield = json_decode($contenido, true);


$lista_imp="select * from app_impresion where imp_id=".$_GET["imp"];

$rs_lista=$DB_gogess->executec($lista_imp);

if($rs_lista)
{

$tm=$rs_lista->fields["imp_letratm"];

$script=$rs_lista->fields["imp_script"];

$nparametro=$rs_lista->fields["imp_campoparametro"];



$script_busca=str_replace("-".$nparametro."-","'".$_GET["pa"]."'",$script);





}

$forma_pago='';

if($script_busca)
{

  $rscampos_valor=$DB_gogess->executec($script_busca);



  if($rscampos_valor->fields["tippo_id"]==1)
  {  
    $forma_pago='CREDITO';    
  }
  else
  {
     
	if($rscampos_valor->fields["doccab_fpago"]=='01')
	{
	  $forma_pago='EFECTIVO'; 
	}
	
	if($rscampos_valor->fields["doccab_fpago"]=='19')
	{
	  $forma_pago='TARJETA DE CREDITO'; 
	}
	
	if($rscampos_valor->fields["doccab_fpago"]=='16')
	{
	  $forma_pago='TARJETA DE DEBITO'; 
	}
	
  }
  
   $centro_direccion='';
   $datos_centro="select * from dns_centrosalud where centro_id=".$rscampos_valor->fields["centro_id"];
   $rs_centro = $DB_gogess->executec($datos_centro,array());
   if($rs_centro)
   {
		while (!$rs_centro->EOF) {
		
		 $centro_direccion=$rs_centro->fields["centro_nombreprint"];
		
		$rs_centro->MoveNext();
		}
	}	
	
   $nombre_usuario='';
   $datos_usuario="select * from app_usuario where usua_id=".$rscampos_valor->fields["usua_id"];
   $rs_usuario = $DB_gogess->executec($datos_usuario,array());
   if($rs_usuario)
   {
		while (!$rs_usuario->EOF) {
		
		 $nombre_usuario=$rs_usuario->fields["usua_nombre"];
		
		$rs_usuario->MoveNext();
		}
	}
	
   $nimpresion=$rscampos_valor->fields["doccab_impresion"]+1;   
   $datos_actualiza="update beko_lqcabecera set doccab_impresion=".$nimpresion." where doccab_id='".$rscampos_valor->fields["doccab_id"]."'";
   $rs_actualiza = $DB_gogess->executec($datos_actualiza,array());

}


echo '<style type="text/css">
<!--
.cmbforms{
	font-family: Arial;
	font-size: 11px;
	text-decoration: none;
	font-weight: bold;
}

.cuadrot{

	font-family: Arial;
	font-size: 11px;
	text-decoration: none;
}

.css_bordesbarra
{

	font-family: Arial;
	font-size: 11px;
	text-decoration: none;



	background-color: #D8E4E9;



	border: 1px solid #666666;



}

.css_bordes

{



	font-family: Arial;



	font-size: 11px;



	text-decoration: none;



	border: 1px solid #666666;



}

.css_table
{

	font-family: Arial;
	font-size: 13px;
	text-decoration: none;
}

.css_precio
{

	font-family: Arial;
	font-size: 13px;
	text-decoration: none;
}

';


$usuario_factura='';
 $listacamposcss="select * from app_impresioncampos where impcamp_activo=1 and imp_id=".$_GET["imp"];
 $rs_camposcss = $DB_gogess->executec($listacamposcss); 
   if($rs_camposcss)
   {

			 while (!$rs_camposcss->EOF) {	
			 
			 if($rs_camposcss->fields["impcamp_campo"]=='usua_usuario')
			 {

                $usuario_factura=$rscampos_valor->fields[$rs_camposcss->fields["impcamp_campo"]];

             }		 
             else
			 {
			 echo '#'.$rs_camposcss->fields["impcamp_campo"] .'_div { top:'.$rs_camposcss->fields["impcamp_y"].'px; left:'.$rs_camposcss->fields["impcamp_x"].'px;

			 position: absolute;			
			 font-size: '.$tm.'px;
             font-style: normal;
		     font-family: Verdana, Arial, Helvetica, sans-serif;

			  }

			 ';

              }
			  
			 $rs_camposcss->MoveNext();

			 }



   }



echo '



-->



</style>
';

//obtiene especialidad y quien atiende
$atendido_por='Atendido por: ';
$lista_eati="select distinct usua_nombre,usua_apellido from beko_documentodetalle inner join app_usuario on app_usuario.usua_id=beko_documentodetalle.usuaat_id where doccab_id='".$rscampos_valor->fields["doccab_id"]."'";
$rs_eati = $DB_gogess->executec($lista_eati);
if($rs_eati)
{
   while (!$rs_eati->EOF) {
   
       $atendido_por.=$rs_eati->fields["usua_nombre"]." ".$rs_eati->fields["usua_apellido"]."<br>";
	   
	   $rs_eati->MoveNext();
   }
}

$atencion_data='Atenci&oacute;n: ';
$lista_espe="select distinct prof_nombre from beko_documentodetalle inner join cesdb_arextension.dns_profesion profe on beko_documentodetalle.prof_id=profe.prof_id inner join dns_especialidad on dns_especialidad.especi_id=profe.especienc_id where doccab_id='".$rscampos_valor->fields["doccab_id"]."'";
$rs_espe = $DB_gogess->executec($lista_espe);

if($rs_espe)
{
   while (!$rs_espe->EOF) {
   
       $atencion_data.=$rs_espe->fields["prof_nombre"]."<br>";
	   
	   $rs_espe->MoveNext();
   }
}


//obtiene especialidad y quien atiende

//objetos

$listacamposcss="select * from app_impresioncampos where impcamp_activo=1 and imp_id=".$_GET["imp"];
$rs_camposcss = $DB_gogess->executec($listacamposcss);
if($rs_camposcss)
{



			 while (!$rs_camposcss->EOF) {
			 
			 
			 if($rs_camposcss->fields["ticaimp_id"]==2)
			  {

                 echo '<div id='.$rs_camposcss->fields["impcamp_campo"].'_div >';
				//echo $rs_camposcss->fields["impcamp_parametrogrid"];
			     include($rs_camposcss->fields["impcamp_parametrogrid"]);
			     echo '</div>';
			 
              }
			  else
			  {
			     if($rs_camposcss->fields["impcamp_campo"]!='usua_usuario')
			     {
				    if($rs_camposcss->fields["ticaimp_id"]==4)
			        {
			           
					   $txt_campovalor='';
					   $txt_campovalor=str_replace("-formapago-",$forma_pago,$rs_camposcss->fields["impcamp_texto"]);
					   $txt_campovalor=str_replace("-filial-",$centro_direccion,$txt_campovalor);
					   $txt_campovalor=str_replace("-usuariof-",$nombre_usuario,$txt_campovalor);
					   
					   //aqui
					   echo '<div id='.$rs_camposcss->fields["impcamp_campo"].'_div >'.$rs_camposcss->fields["impcamp_titulo"].$txt_campovalor.'</div>';
					   
					   
					}
					else
					{
					  if($rs_camposcss->fields["impcamp_campo"]=='doccab_nombrerazon_cliente')
					  {
					  echo '<div id='.$rs_camposcss->fields["impcamp_campo"].'_div >'.$rs_camposcss->fields["impcamp_titulo"].$rscampos_valor->fields[$rs_camposcss->fields["impcamp_campo"]]." ".$rscampos_valor->fields["doccab_apellidorazon_cliente"].'</div>';
					  }
					  else
					  {
					  echo '<div id='.$rs_camposcss->fields["impcamp_campo"].'_div >'.$rs_camposcss->fields["impcamp_titulo"].$rscampos_valor->fields[$rs_camposcss->fields["impcamp_campo"]].'</div>';					  
					  }
					}
				 }  
			 
			  }

			 $rs_camposcss->MoveNext();

			 }

}
//objetos

}

?>