<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

if(@$_SESSION['ces1313777_sessid_inicio'])
{


$lista_rubrosbusca=array();
$cuenta_rub=0;
$lista_rubors="select * from conco_rubrosg where rubrg_activo=1";
$rs_listarubro = $DB_gogess->executec($lista_rubors,array());
if($rs_listarubro)
 {
     while (!$rs_listarubro->EOF) 
	   { 
	      $lista_rubrosbusca[$cuenta_rub]["rubrg_id"]=$rs_listarubro->fields["rubrg_id"];
	      $cuenta_rub++;
		  
		  $rs_listarubro->MoveNext();
       }
 }

//print_r($lista_rubrosbusca);
$fecha_hoy=date("Y-m-d H:i:s");

$busca_lista="select * from app_usuario inner join grid_infolaboral3 on app_usuario.usua_enlace=grid_infolaboral3.standar_enlace inner join app_tipounidad on 		
grid_infolaboral3.info_unidad=app_tipounidad.tipouni_id inner join cmb_puestoinstitucional on grid_infolaboral3.info_puestoinstitucional=cmb_puestoinstitucional.tipoinst_id where info_fechadesalida='0000-00-00'";
$rs_lista = $DB_gogess->executec($busca_lista,array());

if($rs_lista)
 {
     while (!$rs_lista->EOF) 
	   { 
            
			//$busca_rubros="select * from conco_asiganrubro where "
			
			$usua_enlace=$rs_lista->fields["usua_enlace"];
			
			for($i=0;$i<count($lista_rubrosbusca);$i++)
			{
			    //busca asignado
				$busca_asig="select * from conco_asiganrubro where usua_id='".$rs_lista->fields["usua_id"]."' and rubrg_id='".$lista_rubrosbusca[$i]["rubrg_id"]."'";
			    //echo $busca_asig."<br>";
				$rs_basig = $DB_gogess->executec($busca_asig,array());
				
				if($rs_basig->fields["asigr_id"]>0)
				{
				  //echo "Id: ".$lista_rubrosbusca[$i]["rubrg_id"]." Asignado<br>";				
				}
				else
				{				
				  //echo "No Asignado<br>";
				  $asigna_ruborn="INSERT INTO conco_asiganrubro ( emp_id, usua_id, rubrg_id, asigr_observacion, asigr_activo, asigr_enlace, asigr_fecharegistro, usuar_id) VALUES ('".$_SESSION['ces1313777_sessid_emp_id']."','".$rs_lista->fields["usua_id"]."','".$lista_rubrosbusca[$i]["rubrg_id"]."', '',1, '".$usua_enlace."', '".$fecha_hoy."', '".$_SESSION['ces1313777_sessid_inicio']."')";
				  $rs_okasig = $DB_gogess->executec($asigna_ruborn,array());
				  
				  //echo $asigna_ruborn."<br>";
				  
				}
				
				
				
			}
			
			
		   
	      $rs_lista->MoveNext();
	   }
 }

echo "Asignado Rubros";
}
else
{
  echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Su sesi&oacute;n a caducado de precione F5 para continuar...</div>';

}
?>