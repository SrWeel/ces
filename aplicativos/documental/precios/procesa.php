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
				 
				 $convenio=0;
				 $pvp_valor=0;
				 $pvp_valor=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 $convenio=7;
				 $pvp_ispol=0;
				 $pvp_ispol=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 $act_data="update  dns_preciostiempo set  precio_compra='".$precio_c."',precio_pvp='".$pvp_valor."',precio_ispol='".$pvp_ispol."' where precio_id='".$rs_bup->fields["precio_id"]."'";
				 $rs_insertap = $DB_gogess->executec($act_data);
				 
				  
				}
				else
				{
				
				 $convenio=0;
				 $pvp_valor=0;
				 $pvp_valor=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 $convenio=7;
				 $pvp_ispol=0;
				 $pvp_ispol=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
				 
				 $precio_compra=$precio_c;
				 $precio_pvp=$pvp_valor;
				 $precio_ispol=$pvp_ispol;
				 $precio_fechamodi=date("Y-m-d H:i:s");
				 
				 $act_datai="insert into dns_preciostiempo (cuadrobm_id,precio_compra,precio_pvp,precio_ispol,precio_fechamodi) values ('".$cuadrobm_id."','".$precio_compra."','".$precio_pvp."','".$precio_ispol."','".$precio_fechamodi."');";			
				 $rs_insertap = $DB_gogess->executec($act_datai);
				
				
				}			
			//busca precios
			  
			
			  $rs_listax->MoveNext();
			}
		}	







}

?>