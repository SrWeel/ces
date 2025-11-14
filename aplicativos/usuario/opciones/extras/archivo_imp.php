<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
ini_set("session.gc_maxlifetime","14400");
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_SESSION['ces1313777_sessid_inicio'])
{


$formato_pdf=0;
 $subindice="_facturas";

$director="../../../../";
include ("../../../../cfgclases/clases.php");

$campos_tipo=Array
(
    'comcab_nfactura' => 'hidden2',
    'comcab_rucci_cliente' => 'hidden2_solo',	
	'estaf_id' => 'hidden2',
	'comcab_guiaremision' => 'hidden2',	
	'comcab_nombrerazon_cliente' => 'hidden2',
	'comcab_direccion_cliente' => 'hidden2',	
	'comcab_telefono_cliente' => 'hidden2',
	'comcab_email_cliente' => 'hidden2',
	'comcab_descuento' => 'hidden2',
	
	'comcab_descuento' => 'hidden2',
	'comcab_ice' => 'hidden2',
	'comcab_propina' => 'hidden2',
	'comcab_subtotal' => 'hidden2',
	'comcab_iva' => 'hidden2',
	'comcab_total' => 'hidden2',		
);


$table='ca_factura_cabecera';  
$solover=1;
$_POST["pVar1"]=$_GET["pdf"];

	$variableb=0;
			if($_POST["pVar1"]=='undefined')
				  {
					 $variableb=0;
				  }
				  else
				  {
					 $variableb=$_POST["pVar1"];					
					 $_REQUEST["opcion_".$table]="buscar";
			         $csearch=$_POST["pVar1"];				 
				  }
		
				  
	 $comillasimple="'";
		 $botonenvio='';	
		 
//$objformulario = new  formulario();

$objformulario->systemb=$system;
$objformulario->apl=$apl;
$objformulario->seccapl=$seccapl;
$objformulario->sessid=$sessid;
$objformulario->aplweb=$apl;
$objformulario->portalweb=$portal;
$objformulario->tiposis="web";
//se ejecuta despues de validar
$objformulario->funciones_ext=$funciones_externas;
//se ejecuta despues de validar

$objformulario->pathexterno=$director;
$objformulario->pathexternoimp="";
$objformulario->campos_formatoc=$campos_tipo;	

$objformulario->idvalor_validador=$csearch;


include($director."libreria/func_gb.php");


?>		 
 <?php
echo '
<style type="text/css">
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
}';

$listacamposcss="select * from ca_camposformato where forimp_id=1";



 $rs_camposcss = $DB_gogess->Execute($listacamposcss); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {
			 
			 echo '#'.$rs_camposcss->fields["forc_ncampo"] .'_div { top:'.$rs_camposcss->fields["forc_ptop"].'px; left:'.$rs_camposcss->fields["forc_pleft"].'px;
			 position: absolute;
			
			  }
			 ';
			 
			 $rs_camposcss->MoveNext();
			 }
   }



echo '
-->
</style>
';

?>
 
<?php 
  $campoenc='em_id';
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar[$campoenc."x"]=$_SESSION['ces1313777_sessid_idempresa'];	
            $objformulario->sendvar["horax"]=date("h:i:s");
			$objformulario->sendvar["sisu_idx"]=$_SESSION['iduser'];
			$objformulario->sendvar["usua_idx"]=$_SESSION['data_sessid_inicio'];
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['data_sessid_inicio'];
			$logotipoemp=$objformulario->replace_cmb("ca_empresa","em_id,em_logo","where em_id=",$objformulario->contenid["em_id"],$DB_gogess);
			
			
if($logotipoemp)
		{
		$logotipo_imd= '<div id=div_logo ><img src="../../../../../admsacc/archivo/'.$logotipoemp.'"  width="180"  /></div>';
		}
//campos

 $listacamposcss="select * from ca_camposformato where forimp_id=1 and tipoob_id=1";
 $rs_camposcss = $DB_gogess->Execute($listacamposcss); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {
			 
	
			   echo '<div id='.$rs_camposcss->fields["forc_ncampo"] .'_div >'.$objformulario->contenid[$rs_camposcss->fields["forc_ncampo"]].'</div>';
			 
			 $rs_camposcss->MoveNext();
			 }
   }


//objetos
$listacamposcss="select * from ca_camposformato where forimp_id=1 and tipoob_id=2";
 $rs_camposcss = $DB_gogess->Execute($listacamposcss); 
   if($rs_camposcss)
   {
			 while (!$rs_camposcss->EOF) {
			 
	          include($rs_camposcss->fields["forc_archivo"]);
			   
			   echo '<div id='.$rs_camposcss->fields["forc_ncampo"] .'_div >'.$variable_objeto[$rs_camposcss->fields["forc_ncampo"]].'</div>';
			 
			 $rs_camposcss->MoveNext();
			 }
   }



 $actualizestado="update ca_factura_cabecera set comcab_impreso='SI' where comcab_id='".$_POST["pVar1"]."'";
 $OKIMP=$DB_gogess->Execute($actualizestado);
 

}


?>