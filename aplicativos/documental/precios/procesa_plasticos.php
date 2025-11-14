<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();


$busca_productos="select * from dns_cuadrobasicomedicamentos";
$rs_listax = $DB_gogess->executec($busca_productos);
if($rs_listax)
		{
			while (!$rs_listax->EOF) {
			
			 $cuadrobm_id=$rs_listax->fields["cuadrobm_id"];
			 $precio_c=$objBodega->busca_preciomayorcompra($cuadrobm_id,$DB_gogess);
			 
			 //busca precios
				$bu_p="select * from dns_preciostiempo where cuadrobm_id='".$cuadrobm_id."'";
				$rs_bup = $DB_gogess->executec($bu_p);
				
				if($rs_bup->fields["precio_id"]>0)
				{
				 $precio_c=$rs_bup->fields["precio_compra"];
				 $convenio=0;
				 $pvp_valor=0;
				 $pvp_valor=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 $convenio=7;
				 $pvp_ispol=0;
				 $pvp_ispol=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 $objFormulascontable->plasticos=1;
				 $pvp_plasticos=0;
				 $pvp_plasticos=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 
				 $act_data="update  dns_preciostiempo set  	precio_plasticos='".$pvp_plasticos."'  where precio_id='".$rs_bup->fields["precio_id"]."'";
				 $rs_insertap = $DB_gogess->executec($act_data);
				 
				  
				}
					
			//busca precios
			  
			
			  $rs_listax->MoveNext();
			}
		}	







}

?>