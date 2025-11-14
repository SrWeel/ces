<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

//===========================================================
$tabla_con='dns_anamesisexamenfisico';
$nueva_tablasubindice='dns_acupunturaanamesis';
//no espacios no tildes no caracteres especiales no debe hacer referencia al sistema
$nombre_modulo='acupuntura';
//===========================================================

//busca tabla generada
$busca_tbl="select * from gogess_sistable where tab_nam='".$nueva_tablasubindice."'";
$rs_btbl = $DB_gogess->executec($busca_tbl,array());
$tab_idvalor=$rs_btbl->fields["tab_id"];
//busca tabla generada

//busca tabla vista
$busca_tblvista="select * from gogess_sistable where tab_nam='".$nueva_tablasubindice."_vista"."'";
$rs_btblvista = $DB_gogess->executec($busca_tblvista,array());
$tab_idvistavalor=$rs_btblvista->fields["tab_id"];
//busca tabla vista

//busca orden
$busca_siguiente="select mnupan_orden from gogess_menupanel where posp_id=2 order by mnupan_orden desc";
$rs_bsiguiente = $DB_gogess->executec($busca_siguiente,array());
$mnupan_orden=$rs_bsiguiente->fields["mnupan_orden"]+1;
//busca orden

$busca_menu="select * from gogess_menupanel where mnupan_id=44";
$rs_campos_grid = $DB_gogess->executec($busca_menu,array());
		if($rs_campos_grid)
	    {
		  while (!$rs_campos_grid->EOF) {
		  
		     $mnupan_nombre=strtoupper($nombre_modulo)." - ".$rs_campos_grid->fields["mnupan_nombre"];
			 $opcionpa_id=$rs_campos_grid->fields["opcionpa_id"];
			 $con_id=$rs_campos_grid->fields["con_id"];
			 $tab_id=$tab_idvalor;
			 $tabgrid_id=$tab_idvistavalor;
			 $mnupan_campoenlace='';
			 $mnupan_orden=$mnupan_orden;
			 $mnupan_icono='fa fa-smile-o';
			 $mnupan_archivo='panel_substandarform'.$nombre_modulo.'.php';
			 $mnupan_camposforma='anamn_id,hidden3;';
			 $mnupan_activo=1;
			 $mnupan_templatetabla='maestro_standar_'.$nombre_modulo.'anamnesisclinica';
			 $mnupan_campogrid="\'anam_id\',\'anam_hc\',\'anam_motivoconsulta\',\'paciente\',\'centro_nombre\',\'diagnostico\',\'profesional\',\'anam_fecharegistro\'";
			 $mnupan_variablesession='';
			 $posp_id=2;
			 $mnupan_grafico='otorrino.png';
			 $tabsecundario_id=0;
			 $mnupan_templatetablasec='';
			 $mnupan_camposformasecundaria='';
			 $mnupan_campoarchivo='';
			 $mnupan_nboton='';
			 $especi_id=0;
			 $tipofor_id=0;
			 $mnupan_nordengrid=0;			 
			 
			 
			$ejecuta_menupanel="INSERT INTO gogess_menupanel (mnupan_nombre, opcionpa_id, con_id, tab_id, tabgrid_id, mnupan_campoenlace, mnupan_orden, mnupan_icono, mnupan_archivo, mnupan_camposforma, mnupan_activo, mnupan_templatetabla, mnupan_campogrid, mnupan_variablesession, posp_id, mnupan_grafico, tabsecundario_id, mnupan_templatetablasec, mnupan_camposformasecundaria, mnupan_campoarchivo, mnupan_nboton, especi_id, tipofor_id, mnupan_nordengrid) VALUES
('".$mnupan_nombre."','".$opcionpa_id."','".$con_id."','".$tab_id."','".$tabgrid_id."','".$mnupan_campoenlace."','".$mnupan_orden."','".$mnupan_icono."','".$mnupan_archivo."','".$mnupan_camposforma."','".$mnupan_activo."','".$mnupan_templatetabla."','".$mnupan_campogrid."','".$mnupan_variablesession."','".$posp_id."','".$mnupan_grafico."','".$tabsecundario_id."','".$mnupan_templatetablasec."','".$mnupan_camposformasecundaria."','".$mnupan_campoarchivo."','".$mnupan_nboton."','".$especi_id."','".$tipofor_id."','".$mnupan_nordengrid."');";

		    $rs_menupanel = $DB_gogess->executec($ejecuta_menupanel,array());
		
		
		     $rs_campos_grid->MoveNext();
		  }
		}


?>