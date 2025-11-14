<?php
$nombre_tabla=$_GET["id_inicio"];
$saca_n=explode("_",$nombre_tabla);

$script_txt="
CREATE TABLE dns_standarcab (
  standc_id int(11) NOT NULL,
  centro_id int(11) NOT NULL,
  clie_id int(11) NOT NULL,
  atenc_id int(11) NOT NULL,
  standc_hc varchar(90) NOT NULL,
  usua_id int(11) NOT NULL,
  standc_fecharegistro datetime NOT NULL,
  standc_enlace varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table dns_standarcab
--
ALTER TABLE dns_standarcab
  ADD PRIMARY KEY (standc_id),
  ADD UNIQUE KEY standc_enlace_2 (standc_enlace),
  ADD KEY centro_id (centro_id),
  ADD KEY clie_id (clie_id),
  ADD KEY atenc_id (atenc_id),
  ADD KEY standc_hc (standc_hc),
  ADD KEY standc_enlace (standc_enlace);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table dns_standarcab
--
ALTER TABLE dns_standarcab
  MODIFY standc_id int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO gogess_sistable (tab_name, tab_campoprimario, tab_tipocampoprimariio, tab_title, tab_information, tab_actv, tab_mdobuscar, st_id, tab_bextras, tab_valextguardar, tab_rel, tab_crel, tab_trel, tab_datosf, tab_archivo, tab_formatotabla, ayu_id, tab_nlista, tab_tablaregreso, instan_id, tab_tipoimp, tab_sqlimp, tab_archivoimp, tab_camposgrid, tab_scriptorden, tab_campogeneracion, tab_campoorden, tab_compilar, tab_sri, tab_camposecsri, tab_historialmedico, tab_codigo, datab_id, tab_stringconection, tab_sysmedico, tab_estructura, tab_fecharegistro, tab_codigoesp) VALUES
('dns_standarcab', 'standc_id', 'int', '-titulo-', '', 1, '', 6, '', '', '', '', 0, 0, 1, 1, 0, 30, '', 2, 0, '', '', 'standc_id', 'order by 	standc_id desc', '', '', 0, 0, '', 0, '', 0, '', 1, 1, 'standc_fecharegistro', '39');


  
 
INSERT INTO gogess_sisfield ( field_type, field_flags, fie_name, tab_name, fie_title, fie_titlereporte, fie_txtextra, fie_txtizq, fie_type, fie_typeweb, fie_evitaambiguo, fie_campoafecta, fie_camporecibe, fie_naleatorio, fie_style, fie_styleobj, fie_attrib, fie_valiextra, fie_value, fie_tabledb, fie_datadb, fie_sqlconexiontabla, fie_sqlorder, fie_active, fie_activesearch, fie_activelista, fie_activarprt, fie_obl, fie_sql, fie_group, fie_sendvar, fie_tactive, fie_lencampo, fie_lineas, fie_tabindex, fie_verificac, fie_tablac, fie_xmlactivo, fie_xmlformato, fie_inactivoftabla, fie_activogrid, fie_orden, fie_limpiarengrid, field_maxcaracter, fie_archivo, fie_mascara, fie_iconoarchivo, fie_activarbuscador, fie_tablabusca, fie_camposbusca, fie_campodevuelve, fie_ordengrid, fie_typereport, fie_guarda, fie_x, fie_y, fie_placeholder, fie_archivogrid, fie_groupprint, fie_anchocolomna, fie_tablasubgrid, fie_tablasubgridcampos, fie_tablasubcampoid, fie_campoenlacesub, fie_tblcombogrid, fie_campoidcombogrid, fie_campofecharegistro, fie_tituloscamposgrid, fie_camposobligatoriosgrid, fie_camposgridselect, fie_alias, ttbl_id) VALUES
( 'int', 'primary_key auto_increment', 'standc_id', 'dns_standarcab', 'Id:', '', '', '', 'hidden2peke', 'hidden2peke', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'dns_standarcab', '', '', '', 1, 1, 1, 1, 0, '', 1, '', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 1, 6, '', '', '', '', NULL, NULL, '', '', '', '', '', 0),
( 'int', '', 'centro_id', 'dns_standarcab', 'Establecimiento:', '', '', '', 'hidden2peke', 'hidden2peke', '', '', '', 0, 'cmbforms', 'form-control', '', '', 'replace', 'dns_centrosalud', 'centro_id,centro_nombre', '', '', 1, 1, 1, 1, 0, 'where centro_id=', 1, 'centro_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 6, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 1, 6, '', '', '', '', '', '', '', '', '', '', '', 0),
( 'int', '', 'clie_id', 'dns_standarcab', 'Paciente:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'form-control', '', '', 'replace', 'app_cliente', 'clie_id,clie_nombre,clie_apellido', '', '', 1, 1, 1, 1, 0, 'where clie_id=', 55, 'clie_idx', 0, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 0, 12, '', '', '', '', NULL, NULL, '', '', '', '', '', 0),
( 'int', '', 'atenc_id', 'dns_standarcab', 'Codigo Atencion:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'dns_standarcab', '', '', '', 1, 1, 1, 1, 0, '', 55, 'atenc_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 0, 12, '', '', '', '', NULL, NULL, '', '', '', '', '', 0),
( '', '', 'standc_hc', 'dns_standarcab', 'Historia clinica:', '', '', '', 'hidden2snf', 'hidden2snf', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'dns_standarcab', '', '', '', 1, 1, 1, 1, 0, '', 44, 'hcx', 0, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 1, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 0, 12, '', '', '', '', NULL, NULL, '', '', '', '', '', 0),
( 'int', '', 'usua_id', 'dns_standarcab', 'Profesional:', '', '', '', 'hidden2peke', 'hidden2peke', '', '', '', 0, 'cmbforms', 'form-control', '', '', 'replace', 'app_usuario', 'usua_id,usua_nombre,usua_apellido', '', '', 1, 1, 1, 1, 0, 'where usua_id=', 1, 'usua_idx', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 2, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 1, 6, '', '', '', '', '', '', '', '', '', '', '', 0),
( 'date', '', 'standc_fecharegistro', 'dns_standarcab', 'Fecha registro:', '', '', '', 'hidden2peke', 'hidden2peke', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'dns_standarcab', '', '', '', 1, 1, 1, 1, 0, '', 1, 'fechax', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 3, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 1, 6, '', '', '', '', NULL, NULL, '', '', '', '', '', 0),
( '', '', 'standc_enlace', 'dns_standarcab', 'Enlace:', '', '', '', 'hidden3', 'hidden3', '', '', '', 0, 'cmbforms', 'form-control', '', '', '', 'dns_standarcab', '', '', '', 1, 1, 1, 1, 0, '', 1, 'standc_enlacex', 1, 25, 0, 0, 0, '', 0, 'NULL', '0', '', 4, '', '', '', '', '', '', '', '', '', 0, '', 1, 0, 0, '', '', 1, 6, '', '', '', '', '', '', '', '', '', '', '', 0);

 
INSERT INTO `gogess_menupanel` ( `mnupan_nombre`, `opcionpa_id`, `con_id`, `tab_id`, `tabgrid_id`, `mnupan_campoenlace`, `mnupan_orden`, `mnupan_icono`, `mnupan_archivo`, `mnupan_camposforma`, `mnupan_activo`, `mnupan_templatetabla`, `mnupan_campogrid`, `mnupan_variablesession`, `posp_id`, `mnupan_grafico`, `tabsecundario_id`, `mnupan_templatetablasec`, `mnupan_camposformasecundaria`, `mnupan_campoarchivo`, `mnupan_nboton`, `especi_id`) VALUES
( '-titulo-', 1, 0, 0, 0, '', 15, 'fa fa-smile-o', 'panel_substandarformularios.php', '', 0, 'maestro_standar_base', '', '', 2, '', 0, '', '', '', '', 0);
";

$rest='';
$rest=substr($saca_n[1], 0, 5); 
$subindice_campo=$rest."_";
$titulo_tabla=strtoupper($saca_n[1]);

$nuebo_script=str_replace("_standarcab","_".$saca_n[1],$script_txt);
$nuebo_script=str_replace("standc_",$subindice_campo,$nuebo_script);
$nuebo_script=str_replace("-titulo-",$titulo_tabla,$nuebo_script);

echo $nuebo_script;
?>