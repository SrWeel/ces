<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");



$tabla_con='dns_consultaexterna';
$nueva_tablasubindice='dns_pediatriaconsultaexterna';

$subntable="pediatria";
$nombre_formulario="PEDIATRIA - ";
$genera_estructurasx="";
$lista_pacsql="";
$lista_pacientesx="select * from gogess_sistable where tab_name='".$tabla_con."'";
$rs_tblplax = $DB_gogess->executec($lista_pacientesx,array());
if($rs_tblplax)
	{
		while (!$rs_tblplax->EOF) {
		
		
$genera_tabla="INSERT INTO gogess_sistable ( tab_name, tab_campoprimario, tab_tipocampoprimariio, tab_title, tab_information, tab_actv, tab_mdobuscar, st_id, tab_bextras, tab_valextguardar, tab_rel, tab_crel, tab_trel, tab_datosf, tab_archivo, tab_formatotabla, ayu_id, tab_nlista, tab_tablaregreso, instan_id, tab_tipoimp, tab_sqlimp, tab_archivoimp, tab_camposgrid, tab_scriptorden, tab_campogeneracion, tab_campoorden, tab_compilar, tab_sri, tab_camposecsri, tab_historialmedico, tab_codigo, datab_id, tab_stringconection, tab_sysmedico, tab_estructura, tab_fecharegistro, tab_codigoesp) VALUES
( '".$rs_tblplax->fields["tab_name"]."','".$rs_tblplax->fields["tab_campoprimario"]."','".$rs_tblplax->fields["tab_tipocampoprimariio"]."','".$nombre_formulario.$rs_tblplax->fields["tab_title"]."','".$rs_tblplax->fields["tab_information"]."','".$rs_tblplax->fields["tab_actv"]."','".$rs_tblplax->fields["tab_mdobuscar"]."','".$rs_tblplax->fields["st_id"]."','".$rs_tblplax->fields["tab_bextras"]."','".$rs_tblplax->fields["tab_valextguardar"]."','".$rs_tblplax->fields["tab_rel"]."','".$rs_tblplax->fields["tab_crel"]."','".$rs_tblplax->fields["tab_trel"]."','".$rs_tblplax->fields["tab_datosf"]."','".$rs_tblplax->fields["tab_archivo"]."','".$rs_tblplax->fields["tab_formatotabla"]."','".$rs_tblplax->fields["ayu_id"]."','".$rs_tblplax->fields["tab_nlista"]."','".$rs_tblplax->fields["tab_tablaregreso"]."','".$rs_tblplax->fields["instan_id"]."','".$rs_tblplax->fields["tab_tipoimp"]."','".$rs_tblplax->fields["tab_sqlimp"]."','".$rs_tblplax->fields["tab_archivoimp"]."','".$rs_tblplax->fields["tab_camposgrid"]."','".$rs_tblplax->fields["tab_scriptorden"]."','".$rs_tblplax->fields["tab_campogeneracion"]."','".$rs_tblplax->fields["tab_campoorden"]."','".$rs_tblplax->fields["tab_compilar"]."','".$rs_tblplax->fields["tab_sri"]."','".$rs_tblplax->fields["tab_camposecsri"]."','".$rs_tblplax->fields["tab_historialmedico"]."','".$rs_tblplax->fields["tab_codigo"]."','".$rs_tblplax->fields["datab_id"]."','".$rs_tblplax->fields["tab_stringconection"]."','".$rs_tblplax->fields["tab_sysmedico"]."','".$rs_tblplax->fields["tab_estructura"]."','".$rs_tblplax->fields["tab_fecharegistro"]."','".$rs_tblplax->fields["tab_codigoesp"]."');";

$genera_tabla=str_replace($tabla_con,$nueva_tablasubindice,$genera_tabla);

$rs_ok1 = $DB_gogess->executec($genera_tabla,array());

$genera_estructuras="CREATE TABLE  IF NOT EXISTS ".$nueva_tablasubindice." LIKE ".$tabla_con.";";

echo "<br>".$genera_estructuras."<br>";

$rs_ok1x = $DB_gogess->executec($genera_estructuras,array());

echo $genera_tabla."<br>___________________________________________________________________________________________<br>";

/// campos
$lista_campos="";
$lista_campos="select * from gogess_sisfield where tab_name='".$tabla_con."' order by fie_id asc";
$rs_campos = $DB_gogess->executec($lista_campos,array());
if($rs_campos)
	{
		while (!$rs_campos->EOF) {
		
		$genera_campos="";
		$genera_campos="INSERT INTO gogess_sisfield ( field_type, field_flags, fie_name, tab_name, fie_title, fie_titlereporte, fie_txtextra, fie_txtizq, fie_type, fie_typeweb, fie_evitaambiguo, fie_campoafecta, fie_camporecibe, fie_naleatorio, fie_style, fie_styleobj, fie_attrib, fie_valiextra, fie_value, fie_tabledb, fie_datadb, fie_sqlconexiontabla, fie_sqlorder, fie_active, fie_activesearch, fie_activelista, fie_activarprt, fie_obl, fie_sql, fie_group, fie_sendvar, fie_tactive, fie_lencampo, fie_lineas, fie_tabindex, fie_verificac, fie_tablac, fie_xmlactivo, fie_xmlformato, fie_inactivoftabla, fie_activogrid, fie_orden, fie_limpiarengrid, field_maxcaracter, fie_archivo, fie_mascara, fie_iconoarchivo, fie_activarbuscador, fie_tablabusca, fie_camposbusca, fie_campodevuelve, fie_ordengrid, fie_typereport, fie_guarda, fie_x, fie_y, fie_placeholder, fie_archivogrid, fie_groupprint, fie_anchocolomna, fie_tablasubgrid, fie_tablasubgridcampos, fie_tablasubcampoid, fie_campoenlacesub, fie_tblcombogrid, fie_campoidcombogrid, fie_campofecharegistro, fie_tituloscamposgrid, fie_camposobligatoriosgrid, fie_camposgridselect, fie_alias, ttbl_id) VALUES
('".$rs_campos->fields["field_type"]."','".$rs_campos->fields["field_flags"]."','".$rs_campos->fields["fie_name"]."','".$rs_campos->fields["tab_name"]."','".$rs_campos->fields["fie_title"]."','".$rs_campos->fields["fie_titlereporte"]."','".$rs_campos->fields["fie_txtextra"]."','".$rs_campos->fields["fie_txtizq"]."','".$rs_campos->fields["fie_type"]."','".$rs_campos->fields["fie_typeweb"]."','".$rs_campos->fields["fie_evitaambiguo"]."','".$rs_campos->fields["fie_campoafecta"]."','".$rs_campos->fields["fie_camporecibe"]."','".$rs_campos->fields["fie_naleatorio"]."','".$rs_campos->fields["fie_style"]."','".$rs_campos->fields["fie_styleobj"]."','".$rs_campos->fields["fie_attrib"]."','".$rs_campos->fields["fie_valiextra"]."','".$rs_campos->fields["fie_value"]."','".$rs_campos->fields["fie_tabledb"]."','".$rs_campos->fields["fie_datadb"]."','".$rs_campos->fields["fie_sqlconexiontabla"]."','".$rs_campos->fields["fie_sqlorder"]."','".$rs_campos->fields["fie_active"]."','".$rs_campos->fields["fie_activesearch"]."','".$rs_campos->fields["fie_activelista"]."','".$rs_campos->fields["fie_activarprt"]."','".$rs_campos->fields["fie_obl"]."','".$rs_campos->fields["fie_sql"]."','".$rs_campos->fields["fie_group"]."','".$rs_campos->fields["fie_sendvar"]."','".$rs_campos->fields["fie_tactive"]."','".$rs_campos->fields["fie_lencampo"]."','".$rs_campos->fields["fie_lineas"]."','".$rs_campos->fields["fie_tabindex"]."','".$rs_campos->fields["fie_verificac"]."','".$rs_campos->fields["fie_tablac"]."','".$rs_campos->fields["fie_xmlactivo"]."','".$rs_campos->fields["fie_xmlformato"]."','".$rs_campos->fields["fie_inactivoftabla"]."','".$rs_campos->fields["fie_activogrid"]."','".$rs_campos->fields["fie_orden"]."','".$rs_campos->fields["fie_limpiarengrid"]."','".$rs_campos->fields["field_maxcaracter"]."','".$rs_campos->fields["fie_archivo"]."','".$rs_campos->fields["fie_mascara"]."','".$rs_campos->fields["fie_iconoarchivo"]."','".$rs_campos->fields["fie_activarbuscador"]."','".$rs_campos->fields["fie_tablabusca"]."','".$rs_campos->fields["fie_camposbusca"]."','".$rs_campos->fields["fie_campodevuelve"]."','".$rs_campos->fields["fie_ordengrid"]."','".$rs_campos->fields["fie_typereport"]."','".$rs_campos->fields["fie_guarda"]."','".$rs_campos->fields["fie_x"]."','".$rs_campos->fields["fie_y"]."','".$rs_campos->fields["fie_placeholder"]."','".$rs_campos->fields["fie_archivogrid"]."','".$rs_campos->fields["fie_groupprint"]."','".$rs_campos->fields["fie_anchocolomna"]."','".$rs_campos->fields["fie_tablasubgrid"]."','".$rs_campos->fields["fie_tablasubgridcampos"]."','".$rs_campos->fields["fie_tablasubcampoid"]."','".$rs_campos->fields["fie_campoenlacesub"]."','".$rs_campos->fields["fie_tblcombogrid"]."','".$rs_campos->fields["fie_campoidcombogrid"]."','".$rs_campos->fields["fie_campofecharegistro"]."','".$rs_campos->fields["fie_tituloscamposgrid"]."','".$rs_campos->fields["fie_camposobligatoriosgrid"]."','".$rs_campos->fields["fie_camposgridselect"]."','".$rs_campos->fields["fie_alias"]."','".$rs_campos->fields["ttbl_id"]."');";

        
		
		$reeplaza_valocampos=str_replace("'NULL'","NULL",$genera_campos);		
		$reeplaza_valocampos=str_replace($tabla_con,$nueva_tablasubindice,$reeplaza_valocampos);
		
		
		if($rs_campos->fields["fie_tablasubgrid"]=='dns_signosvitales' or $rs_campos->fields["fie_tablasubgrid"]=='cesdb_arextension.dns_antecedentespersonales' or $rs_campos->fields["fie_tablasubgrid"]=='cesdb_arextension.dns_antecedentesfamiliares')
		{
		     $genera_estructurasx="";
		
		}
		else
		{
		     //------
			 if($rs_campos->fields["fie_tablasubgrid"]=='cesdb_arextension.dns_evoluciongridorgano')
			 {
			 $reeplaza_valocampos=str_replace("cesdb_arextension.dns_evoluciongridorgano","cesdb_arextension.dns_".$subntable."evoluciongridorgano",$reeplaza_valocampos);			
			 $genera_estructurasx="CREATE TABLE  IF NOT EXISTS cesdb_arextension.dns_".$subntable."evoluciongridorgano LIKE cesdb_arextension.dns_evoluciongridorgano;";
			 }
			 
			 //-----
			 if($rs_campos->fields["fie_tablasubgrid"]=='cesdb_arextension.dns_evoluciongridexamenfisico')
			 {
			 $reeplaza_valocampos=str_replace("cesdb_arextension.dns_evoluciongridexamenfisico","cesdb_arextension.dns_".$subntable."evogridexamenfisico",$reeplaza_valocampos);			 
			 $genera_estructurasx="CREATE TABLE  IF NOT EXISTS cesdb_arextension.dns_".$subntable."evogridexamenfisico LIKE cesdb_arextension.dns_evoluciongridexamenfisico;";
			 }
			 
			 //-----
			 if($rs_campos->fields["fie_tablasubgrid"]=='dns_cuadrobasicocexterno')
			 {
			 $reeplaza_valocampos=str_replace("dns_cuadrobasicocexterno","cesdb_arextension.dns_".$subntable."cuadrobasicocexterno",$reeplaza_valocampos);			
			 $genera_estructurasx="CREATE TABLE  IF NOT EXISTS cesdb_arextension.dns_".$subntable."cuadrobasicocexterno LIKE dns_cuadrobasicocexterno;";
			 }
			 
			 //------
			 if($rs_campos->fields["fie_tablasubgrid"]=='dns_diagnosticoexterna')
			 {
			 $reeplaza_valocampos=str_replace("dns_diagnosticoexterna","cesdb_arextension.dns_".$subntable."diagnosticoexterna",$reeplaza_valocampos);			 
			 $genera_estructurasx="CREATE TABLE  IF NOT EXISTS cesdb_arextension.dns_".$subntable."diagnosticoexterna LIKE dns_diagnosticoexterna;";
			 }
			 
			 //-----
			 if($rs_campos->fields["fie_tablasubgrid"]=='dns_recetaconsultaexterna')
			 {
			 $reeplaza_valocampos=str_replace("dns_recetaconsultaexterna","cesdb_arextension.dns_".$subntable."recetaconsultaexterna",$reeplaza_valocampos);			
			 $genera_estructurasx="CREATE TABLE  IF NOT EXISTS cesdb_arextension.dns_".$subntable."recetaconsultaexterna LIKE dns_recetaconsultaexterna;";
			 }
			 
			 //------
			 if($rs_campos->fields["fie_tablasubgrid"]=='cesdb_arextension.dns_dispositivomedicoexterno')
			 {
			 $reeplaza_valocampos=str_replace("cesdb_arextension.dns_dispositivomedicoexafisico","cesdb_arextension.dns_".$subntable."disposiexterno",$reeplaza_valocampos);			 
			 $genera_estructurasx="CREATE TABLE  IF NOT EXISTS cesdb_arextension.dns_".$subntable."disposiexterno LIKE cesdb_arextension.dns_dispositivomedicoexafisico;";
			 }
			 
			 
		
		}
		

        echo $reeplaza_valocampos."<br>------------------<br>";
		
		$rs_ok2 = $DB_gogess->executec($reeplaza_valocampos,array());
        $nuevoid_valor=0;
		$nuevoid_valor=$DB_gogess->funciones_nuevoID(0);
		
		
		if($rs_campos->fields["fie_tablasubgrid"])
		{
		
		$rs_ok3 = $DB_gogess->executec($genera_estructurasx,array());
		
		echo "<br>".$genera_estructurasx."<br><br>";
		$genera_estructurasx="";
		
		//------------------subgrid---------------------------
		$busca_campos_grid="select * from gogess_gridfield where fie_id='".$rs_campos->fields["fie_id"]."'";
		$rs_campos_grid = $DB_gogess->executec($busca_campos_grid,array());
		if($rs_campos_grid)
	    {
		  while (!$rs_campos_grid->EOF) {
		
		    $gridfield="";
		    $gridfield="INSERT INTO gogess_gridfield ( fie_id, gridfield_title, gridfield_nameid, gridfield_tipo, gridfield_tablecmb, gridfield_camposcmb, gridfield_ordercmb, gridfield_orden, gridfield_tamano, gridfield_extra, gridfield_llenarconcombo, gridfield_editarengrid, gridfield_campoafectacheck, gridfield_valordefault, gridfield_orderecibe, gridfield_bloqueado, gridfield_valordefecto) VALUES
('".$nuevoid_valor."','".$rs_campos_grid->fields["gridfield_title"]."','".$rs_campos_grid->fields["gridfield_nameid"]."','".$rs_campos_grid->fields["gridfield_tipo"]."','".$rs_campos_grid->fields["gridfield_tablecmb"]."','".$rs_campos_grid->fields["gridfield_camposcmb"]."','".$rs_campos_grid->fields["gridfield_ordercmb"]."','".$rs_campos_grid->fields["gridfield_orden"]."','".$rs_campos_grid->fields["gridfield_tamano"]."','".$rs_campos_grid->fields["gridfield_extra"]."','".$rs_campos_grid->fields["gridfield_llenarconcombo"]."','".$rs_campos_grid->fields["gridfield_editarengrid"]."','".$rs_campos_grid->fields["gridfield_campoafectacheck"]."','".$rs_campos_grid->fields["gridfield_valordefault"]."','".$rs_campos_grid->fields["gridfield_orderecibe"]."','".$rs_campos_grid->fields["gridfield_bloqueado"]."','".$rs_campos_grid->fields["gridfield_valordefecto"]."');";

             echo $gridfield."<br>";
			 
			 $rs_ok4 = $DB_gogess->executec($gridfield,array());

			
		    $rs_campos_grid->MoveNext();
		  }
		}
		 echo "<br>------------------<br>";
		//------------------subgrid---------------------------
		
		}
		
		
		$rs_campos->MoveNext();
		}
	}	

/// campos



		$rs_tblplax->MoveNext();
		}
	}	


?>