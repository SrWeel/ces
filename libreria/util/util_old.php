<?php
/**
 * Util Funciones
 * 
 * Este archivo permite obtener funciones standar para el sistema.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package util_funciones
 */

class util_funciones{


function fechaCastellano($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  //$nombredia.
  return " ".$numeroDia." de ".$nombreMes." de ".$anio;
}

function ver_precioterapia($clie_id,$DB_gogess)
{
   //-----------------------------------------
   $cantidad_nueva=1;
   $lista_hijos="select distinct tipopac_id,clie_nombre,clie_apellido,clie_id from app_cliente where clie_id='".$clie_id."'";
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
    }
	
	$busca_serial="select usua_id,prod_codigo,prod_id from efacsistema_producto where  prod_paraterapia=1";
    $rs_serial = $DB_gogess->executec($busca_serial,array());
	
   //-----------------------------------------
   
   $busca_dataproducto="select prod_codigo,prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as ".$valor_precio.",efacsistema_producto.impu_codigo,efacsistema_producto.tari_codigo,tari_valor,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from efacsistema_producto inner join beko_tarifa on efacsistema_producto.tari_codigo=beko_tarifa.tari_codigo where  prod_id=".$rs_serial->fields["prod_id"];
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());

   return $rs_dataproducto->fields["docdet_total"];


   //-----------------------------------------

}

function verifica_siyafuepagada($terap_id,$clie_id,$DB_gogess)
{

  $concatena_pag='';
 //optiene terapias pagadas
$concatena_pag='';
$listatpag="select terap_id from beko_documentodetalle";
$rs_listapag = $DB_gogess->executec($listatpag);
 if($rs_listapag)
 {
     	while (!$rs_listapag->EOF) {
		
		
		$concatena_pag.=$rs_listapag->fields["terap_id"];
		
		$rs_listapag->MoveNext();	
		}
  }
  
 //lista fisica
$lista_fisica="select distinct terap_id from faesa_terapiasregistro where terap_nfactura is not NULL and clie_id=".$clie_id;
$rs_listafisica = $DB_gogess->executec($lista_fisica);
 if($rs_listafisica)
 {
     	while (!$rs_listafisica->EOF) {
		
		
		$concatena_pag.=$rs_listafisica->fields["terap_id"].",";
		
		$rs_listafisica->MoveNext();	
		}
  }
  
//lista issfa
$lista_issfa="select distinct  terap_id from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where tipopac_id='1' and app_cliente.clie_id=".$clie_id;
$rs_listaissfa = $DB_gogess->executec($lista_issfa);
 if($rs_listaissfa)
 {
     	while (!$rs_listaissfa->EOF) {
		
		$concatena_pag.=$rs_listaissfa->fields["terap_id"].",";
		
		$rs_listaissfa->MoveNext();	
		}
  }  
  $concatena_pag=$concatena_pag."0";  
  
  $pagado_t=0;
  $lista_tera="select * from faesa_terapiasregistro where terap_id=".$terap_id." and terap_id in (".$concatena_pag.") and clie_id=".$clie_id." order by terap_fecha asc";
  
  if($clie_id==190)
  {
  
  // echo $lista_tera;
  }
   $rs_lterap = $DB_gogess->executec($lista_tera,array());
	{
     	while (!$rs_lterap->EOF) {

		$pagado_t=1;
		
		$rs_lterap->MoveNext();	
		}
    		
   }
   return $pagado_t;
  
  
  
}

function lista_terapias_porpagar($clie_id,$DB_gogess)
{
$concatena_pag='';
 //optiene terapias pagadas
$concatena_pag='';
$listatpag="select terap_id from beko_documentodetalle";
$rs_listapag = $DB_gogess->executec($listatpag);
 if($rs_listapag)
 {
     	while (!$rs_listapag->EOF) {
		
		
		$concatena_pag.=$rs_listapag->fields["terap_id"];
		
		$rs_listapag->MoveNext();	
		}
  }
  
 //lista fisica
$lista_fisica="select distinct terap_id from faesa_terapiasregistro where terap_nfactura!='' and clie_id=".$clie_id;
$rs_listafisica = $DB_gogess->executec($lista_fisica);
 if($rs_listafisica)
 {
     	while (!$rs_listafisica->EOF) {
		
		
		$concatena_pag.=$rs_listafisica->fields["terap_id"].",";
		
		$rs_listafisica->MoveNext();	
		}
  }
  
//lista issfa
$lista_issfa="select distinct  terap_id from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where tipopac_id='1' and app_cliente.clie_id=".$clie_id;
$rs_listaissfa = $DB_gogess->executec($lista_issfa);
 if($rs_listaissfa)
 {
     	while (!$rs_listaissfa->EOF) {
		
		
		$concatena_pag.=$rs_listaissfa->fields["terap_id"].",";
		
		$rs_listaissfa->MoveNext();	
		}
  }  
  $concatena_pag=$concatena_pag."0";  
  $lista_tera="select * from faesa_terapiasregistro where terap_id not in (".$concatena_pag.") and clie_id=".$clie_id." order by terap_fecha asc";
   $rs_lterap = $DB_gogess->executec($lista_tera,array());
	{
	 $idcuenta=0;
	 $total_pag=0;
  $restorna_valor='<table width="400px" border="1" cellpadding="0" cellspacing="0" align="center">';
  
     	while (!$rs_lterap->EOF) {
		 
		 $idcuenta++;
		 $valor_tera=$this->ver_precioterapia($clie_id,$DB_gogess); 
		 $restorna_valor.='<tr>
		  <td class="css_texto" >'.$idcuenta.'</td>
		  <td class="css_texto">PENDIENTE PAGO </td>
          <td class="css_texto">'.$rs_lterap->fields["terap_fecha"].'</td>
          <td class="css_texto">'.$rs_lterap->fields["terap_hora"].'</td>
          <td class="css_texto">'.$valor_tera.'</td>
        </tr>';
		
		$total_pag=$total_pag+$valor_tera;
		$rs_lterap->MoveNext();	
		}
    		
    $restorna_valor.='<tr>
		  <td class="css_texto" ></td>
		  <td class="css_texto"></td>
          <td class="css_texto"></td>
          <td class="css_texto"></td>
          <td class="css_texto">'.$total_pag.'</td>
        </tr>';				
   $restorna_valor.='</table>';
   }
   return $restorna_valor;

}

public function getSubString($string, $length=NULL)
{
    //Si no se especifica la longitud por defecto es 50
    if ($length == NULL)
        $length = 50;
    //Primero eliminamos las etiquetas html y luego cortamos el string
    $stringDisplay = substr(strip_tags($string), 0, $length);
    //Si el texto es mayor que la longitud se agrega puntos suspensivos
    if (strlen(strip_tags($string)) > $length)
        $stringDisplay .= ' ...';
    return $stringDisplay;
}

function desplegarencuadros($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	echo '<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'">';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   echo '<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   echo '<td>'.$arreglolista[$k].'</td>';
		   $k++;
		 
		 }
		 
	   echo '</tr>';	  
	}
	echo '</table>';
    }
}


function desplegarencuadrosv2($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $cuadro='';
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	$cuadro='';
	$cuadro.='<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'" align="center" >';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   $cuadro.='<tr>';
	     
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   $cuadro.='<td><center>'.@$arreglolista[$k].'</center></td>';
		   $k++;
		 
		 }
		 
	   $cuadro.='</tr>';	  
	}
	$cuadro.='</table>';
    }
	
	return $cuadro;
}


function genera_insert($tabla_gridvalor,$campo_enlace,$campo_fecharegistro,$valor_enlace,$valor_usuario,$valor_fecha,$_POSTx,$campos_data)
{
    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 {
	 
	  $sqlcampos=$sqlcampos.",".$campos_data[$i];	
	  $sqlvalues=$sqlvalues.",'".str_replace("'", "\'",$_POSTx[$campos_data[$i]."x"])."'"; 
	 
	 }
	 
	 $sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,1);
	 
	 if($campo_fecharegistro)
	 {
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.",".$campo_enlace.",".$campo_fecharegistro.",usua_id) values (".$sqlvalues.",'".$valor_enlace."','".$valor_fecha."','".$valor_usuario."')";
	 }
	 else
	 {
	 $sql_1="insert into ".$tabla_gridvalor." (".$sqlcampos.",".$campo_enlace.",usua_id) values (".$sqlvalues.",'".$valor_enlace."','".$valor_usuario."')";
	 
	 }
	 
	return $sql_1;
}

function genera_update($tabla_gridvalor,$campo_id,$valor_id,$_POSTx,$campos_data)
{
    //print_r($_POSTx);
     $sqlcampos='';
	 $sqlvalues='';
     for($i=0;$i<count($campos_data);$i++)
	 { 
	 //$sqlcampos=$sqlcampos.",".$campos_data[$i];	
	  $sqlvalues=$sqlvalues."".$campos_data[$i]."='".str_replace("'", "\'",$_POSTx[$campos_data[$i]."x"])."',"; 
	 }
	 //$sqlcampos=substr($sqlcampos,1);
	 $sqlvalues=substr($sqlvalues,0,-1); 
	 $sql_1="update ".$tabla_gridvalor." set ".$sqlvalues." where ".$campo_id."='".$valor_id."'";
	 

	return $sql_1;
}

function leer_contenido_completo($url){
	
	if (file_exists($url)) {
   //abrimos el fichero, puede ser de texto o una URL
   $fichero_url = fopen ($url, "r");
   $texto = "";
   //bucle para ir recibiendo todo el contenido del fichero en bloques de 1024 bytes
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   
	}
	else
{
 echo 'Archivo no existe...';	

}
   return $texto;
}


function calcular_edad($fechan,$fechafin){
$resultado=array();
$separa_anios=array();
$valor_anio=0;
$valor_mes=0;
$fechainicial = new DateTime($fechan);
$fechafinal = new DateTime($fechafin);
$diferencia = $fechainicial->diff($fechafinal);
$meses = ( $diferencia->y * 12 ) + $diferencia->m;
$anios=$meses/12;
$separa_anios=explode(".",$anios);
$valor_anio=@$separa_anios[0];
$valor_mes=("0.".@$separa_anios[1])*12;
$resultado["anio"]=$valor_anio;
$resultado["mes"]=round($valor_mes);
return $resultado;
}

function obtiene_datos($director,$lista_tbldata,$objformulario,$tabla,$enlace,$psic_id_valor,$rs_sihaydata,$grupoblock,$DB_gogess)
{
		//datos de tablas
		
		$campos_data_r["faesa_gridwisc"]["campos"]=array('escwisc_nombre','wisc_marcador','wisc_observacion');
        $campos_name_r["faesa_gridwisc"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_gridwisc"]["combo"]="faesa_escalaswisc";
        $tabla_enlacecombo1_r["faesa_gridwisc"]["idcombo"]="escwisc_id";
		$tabla_enlacecombo1_r["faesa_gridwisc"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_gridwppsi1"]["campos"]=array('escwppsi1_nombre','wppsi1_marcador','wppsi1_observacion');
        $campos_name_r["faesa_gridwppsi1"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_gridwppsi1"]["combo"]="faesa_escalaswppsi";
        $tabla_enlacecombo1_r["faesa_gridwppsi1"]["idcombo"]="escwppsi1_id";
		$tabla_enlacecombo1_r["faesa_gridwppsi1"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_gridwppsi2"]["campos"]=array('escwppsi2_nombre','wppsi2_marcador','wppsi2_observacion');
        $campos_name_r["faesa_gridwppsi2"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_gridwppsi2"]["combo"]="faesa_escalaswppsi2";
        $tabla_enlacecombo1_r["faesa_gridwppsi2"]["idcombo"]="escwppsi2_id";
		$tabla_enlacecombo1_r["faesa_gridwppsi2"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_diagnosticodifirencial"]["campos"]=array('diagn_criteriodiagnostico','marcps_nombre','diagn_observacion');
        $campos_name_r["faesa_diagnosticodifirencial"]["titulos"]=array('Criterio Diagnostico','Marcador','Observaciones');
        $tabla_combo1_r["faesa_diagnosticodifirencial"]["combo"]="faesa_marcadorps";
        $tabla_enlacecombo1_r["faesa_diagnosticodifirencial"]["idcombo"]="marcps_id";
		$tabla_enlacecombo1_r["faesa_diagnosticodifirencial"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_entrevistacomfamilescolar"]["campos"]=array('trast_nombre','entrvfe_percentil','entrvfe_observacion');
        $campos_name_r["faesa_entrevistacomfamilescolar"]["titulos"]=array('Caracteristica','Percentil','Observaciones');
        $tabla_combo1_r["faesa_entrevistacomfamilescolar"]["combo"]="faesa_trastornoentrev";
        $tabla_enlacecombo1_r["faesa_entrevistacomfamilescolar"]["idcombo"]="trast_id";
		$tabla_enlacecombo1_r["faesa_entrevistacomfamilescolar"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_invetarioansiedad"]["campos"]=array('tipans_nombre','invtans_marcador','invtans_observacion');
        $campos_name_r["faesa_invetarioansiedad"]["titulos"]=array('Ansiedad','Marcador','Observaciones');
        $tabla_combo1_r["faesa_invetarioansiedad"]["combo"]="faesa_tipoansiedad";
        $tabla_enlacecombo1_r["faesa_invetarioansiedad"]["idcombo"]="tipans_id";
		$tabla_enlacecombo1_r["faesa_invetarioansiedad"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_griddesarrolloinf"]["campos"]=array('escdesarrinf_nombre','desarrinf_percentil','desarrinf_edad','desarrinf_interpretacion');
        $campos_name_r["faesa_griddesarrolloinf"]["titulos"]=array('&Aacute;reas y dominios','Puntaje - Percentil','Edad Equivalente','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_griddesarrolloinf"]["combo"]="faesa_areadesarrollo";
        $tabla_enlacecombo1_r["faesa_griddesarrolloinf"]["idcombo"]="escdesarrinf_id";
		$tabla_enlacecombo1_r["faesa_griddesarrolloinf"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_gridvelocidadpor"]["campos"]=array('escvelopor_nombre','velopor_subescala','velopor_percentil','velopor_apreciacion');
        $campos_name_r["faesa_gridvelocidadpor"]["titulos"]=array('Escala','Sub Escala','Percentil','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_gridvelocidadpor"]["combo"]="faesa_escalavelopor";
        $tabla_enlacecombo1_r["faesa_gridvelocidadpor"]["idcombo"]="escvelopor_id";
		$tabla_enlacecombo1_r["faesa_gridvelocidadpor"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_gridescalamemoria"]["campos"]=array('escescameno_nombre','escameno_subescala','escameno_percentil','escameno_apreciacion');
        $campos_name_r["faesa_gridescalamemoria"]["titulos"]=array('Escala','Sub Escala','Percentil','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_gridescalamemoria"]["combo"]="faesa_escalamemo";
        $tabla_enlacecombo1_r["faesa_gridescalamemoria"]["idcombo"]="escescameno_id";
		$tabla_enlacecombo1_r["faesa_gridescalamemoria"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_griddepreinfantil"]["campos"]=array('escdepreinf_nombre','depreinf_percentil','depreinf_descripcion');
        $campos_name_r["faesa_griddepreinfantil"]["titulos"]=array('Escala','Percentil','Descripci&oacute;n');
        $tabla_combo1_r["faesa_griddepreinfantil"]["combo"]="faesa_factordepre";
        $tabla_enlacecombo1_r["faesa_griddepreinfantil"]["idcombo"]="escdepreinf_id";
		$tabla_enlacecombo1_r["faesa_griddepreinfantil"]["enlace"]="psic_enlace";
		
		$campos_data_r["faesa_gridinterpersonales"]["campos"]=array('aippsc_nombre','inteperson_marcador','inteperson_observacion');
        $campos_name_r["faesa_gridinterpersonales"]["titulos"]=array('&Aacute;rea','Marcador','Observaciones');
        $tabla_combo1_r["faesa_gridinterpersonales"]["combo"]="faesa_areasintepersonalespsc";
        $tabla_enlacecombo1_r["faesa_gridinterpersonales"]["idcombo"]="aippsc_id";
		$tabla_enlacecombo1_r["faesa_gridinterpersonales"]["enlace"]="psic_enlace";
		
		
		$campos_data_r["faesa_evaluacionproyectivaemo"]["campos"]=array('facto_nombre','evaproyemo_descripcion');
        $campos_name_r["faesa_evaluacionproyectivaemo"]["titulos"]=array('Factores','Descripción');
        $tabla_combo1_r["faesa_evaluacionproyectivaemo"]["combo"]="";
        $tabla_enlacecombo1_r["faesa_evaluacionproyectivaemo"]["idcombo"]="";
		$tabla_enlacecombo1_r["faesa_evaluacionproyectivaemo"]["enlace"]="psic_enlace";
		
		//datos de tablas
		
		//pedagogia
		
		$campos_data_r["faesa_pedagogianeurofunciones"]["campos"]=array('areev_nombre','pedneuro_marcador','pedneuro_observaciones');
        $campos_name_r["faesa_pedagogianeurofunciones"]["titulos"]=array('&Aacute;rea','Marcador','Observaciones');
        $tabla_combo1_r["faesa_pedagogianeurofunciones"]["combo"]="faesa_areaev";
		$tabla_enlacecombo1_r["faesa_pedagogianeurofunciones"]["idcombo"]="areev_id";
        $tabla_enlacecombo1_r["faesa_pedagogianeurofunciones"]["enlace"]="pedago_enlace";
		
		
		$campos_data_r["faesa_pedagogiacompetencias"]["campos"]=array('tipcompe_nombre','pedcompete_observaciones','pedcompete_dificultades');
        $campos_name_r["faesa_pedagogiacompetencias"]["titulos"]=array('Tipo','Observaciones','Dificultades Espec&iacute;ficas');
        $tabla_combo1_r["faesa_pedagogiacompetencias"]["combo"]="faesa_tipocompetencia";
		$tabla_enlacecombo1_r["faesa_pedagogiacompetencias"]["idcombo"]="tipcompe_id";
        $tabla_enlacecombo1_r["faesa_pedagogiacompetencias"]["enlace"]="pedago_enlace";
		
		
		
		$campos_data_r["faesa_pedagogiaaprendizaje"]["campos"]=array('tipoa_nombre','pedaprendiz_porcentaje','pedaprendiz_apreciacion');
        $campos_name_r["faesa_pedagogiaaprendizaje"]["titulos"]=array('Tipo','Porcentaje','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_pedagogiaaprendizaje"]["combo"]="faesa_tipoarea2";
		$tabla_enlacecombo1_r["faesa_pedagogiaaprendizaje"]["idcombo"]="tipoa_id";
        $tabla_enlacecombo1_r["faesa_pedagogiaaprendizaje"]["enlace"]="pedago_enlace";
		
		
		$campos_data_r["faesa_pedgridvelocidadpor"]["campos"]=array('escvelopor_nombre','velopor_subescala','velopor_percentil','velopor_apreciacion');
        $campos_name_r["faesa_pedgridvelocidadpor"]["titulos"]=array('Escala','Sub Escala','Percentil','Apreciaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridvelocidadpor"]["combo"]="faesa_escalavelopor";
        $tabla_enlacecombo1_r["faesa_pedgridvelocidadpor"]["idcombo"]="escvelopor_id";
		$tabla_enlacecombo1_r["faesa_pedgridvelocidadpor"]["enlace"]="pedago_enlace";
		
		
		
		$campos_data_r["faesa_pedgridwisc"]["campos"]=array('escwisc_nombre','wisc_marcador','wisc_observacion');
        $campos_name_r["faesa_pedgridwisc"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridwisc"]["combo"]="faesa_escalaswisc";
        $tabla_enlacecombo1_r["faesa_pedgridwisc"]["idcombo"]="escwisc_id";
		$tabla_enlacecombo1_r["faesa_pedgridwisc"]["enlace"]="pedago_enlace";
		
		$campos_data_r["faesa_pedgridwppsi1"]["campos"]=array('escwppsi1_nombre','wppsi1_marcador','wppsi1_observacion');
        $campos_name_r["faesa_pedgridwppsi1"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridwppsi1"]["combo"]="faesa_escalaswppsi";
        $tabla_enlacecombo1_r["faesa_pedgridwppsi1"]["idcombo"]="escwppsi1_id";
		$tabla_enlacecombo1_r["faesa_pedgridwppsi1"]["enlace"]="pedago_enlace";
		
		$campos_data_r["faesa_pedgridwppsi2"]["campos"]=array('escwppsi2_nombre','wppsi2_marcador','wppsi2_observacion');
        $campos_name_r["faesa_pedgridwppsi2"]["titulos"]=array('Sub Escalas','Puntaje-percentiles','Interpretaci&oacute;n');
        $tabla_combo1_r["faesa_pedgridwppsi2"]["combo"]="faesa_escalaswppsi2";
        $tabla_enlacecombo1_r["faesa_pedgridwppsi2"]["idcombo"]="escwppsi2_id";
		$tabla_enlacecombo1_r["faesa_pedgridwppsi2"]["enlace"]="pedago_enlace";
		
		
		//pedagogia
		
		//lenguaje
		$campos_data_r["faesa_gridtestplon"]["campos"]=array('esctestplon_nombre','testplon_descripcion','testplon_resultado');
        $campos_name_r["faesa_gridtestplon"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_gridtestplon"]["combo"]="faesa_areatestplon";
		$tabla_enlacecombo1_r["faesa_gridtestplon"]["idcombo"]="esctestplon_id";
        $tabla_enlacecombo1_r["faesa_gridtestplon"]["enlace"]="lenguaj_enlace";
		
		
		$campos_data_r["faesa_gridtestelce"]["campos"]=array('esctestelce_nombre','testelce_descripcion','testelce_resultado');
        $campos_name_r["faesa_gridtestelce"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_gridtestelce"]["combo"]="faesa_areatestelce";
		$tabla_enlacecombo1_r["faesa_gridtestelce"]["idcombo"]="esctestelce_id";
        $tabla_enlacecombo1_r["faesa_gridtestelce"]["enlace"]="lenguaj_enlace";
		
		
		$campos_data_r["faesa_gridprotocoloalimen"]["campos"]=array('escprotoalimen_nombre','protoalimen_descripcion','protoalimen_resultado');
        $campos_name_r["faesa_gridprotocoloalimen"]["titulos"]=array('Marcador','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_gridprotocoloalimen"]["combo"]="faesa_areaprotoalimen";
		$tabla_enlacecombo1_r["faesa_gridprotocoloalimen"]["idcombo"]="escprotoalimen_id";
        $tabla_enlacecombo1_r["faesa_gridprotocoloalimen"]["enlace"]="lenguaj_enlace";
		
		
		$campos_data_r["faesa_griddesainfantil"]["campos"]=array('escdesainfa_nombre','desainfa_percentil','desainfa_edad','desainfa_interpretacion');
        $campos_name_r["faesa_griddesainfantil"]["titulos"]=array('&Aacute;rea y Dominios','Puntaje - Percentil','Edad Equivalente','Interpretaci&oacute;n Cualitativa');
        $tabla_combo1_r["faesa_griddesainfantil"]["combo"]="faesa_areadesainfantil";
		$tabla_enlacecombo1_r["faesa_griddesainfantil"]["idcombo"]="escdesainfa_id";
        $tabla_enlacecombo1_r["faesa_griddesainfantil"]["enlace"]="lenguaj_enlace";
		
		//lenguaje
		
		//terapia fisica
		
		
		$campos_data_r["faesa_griddedsarrollofisico"]["campos"]=array('escdesafisico_nombre','desafisico_descripcion','desafisico_resultado');
        $campos_name_r["faesa_griddedsarrollofisico"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_griddedsarrollofisico"]["combo"]="faesa_areadesafisico";
		$tabla_enlacecombo1_r["faesa_griddedsarrollofisico"]["idcombo"]="escdesafisico_id";
        $tabla_enlacecombo1_r["faesa_griddedsarrollofisico"]["enlace"]="terfisic_enlace";
		
		
		
		$campos_data_r["faesa_griddedsarrolloinfantil"]["campos"]=array('escdesainfantil_nombre','desainfantil_percentil','desainfantil_edad','desainfantil_interpretacion');
        $campos_name_r["faesa_griddedsarrolloinfantil"]["titulos"]=array('&Aacute;rea','Puntaje - Percentil','Edad Equivalente','Interpretaci&oacute;n Cualitativa');
        $tabla_combo1_r["faesa_griddedsarrolloinfantil"]["combo"]="faesa_areadesarolloinfantil";
		$tabla_enlacecombo1_r["faesa_griddedsarrolloinfantil"]["idcombo"]="escdesainfantil_id";
        $tabla_enlacecombo1_r["faesa_griddedsarrolloinfantil"]["enlace"]="terfisic_enlace";
		
		//terapia fisica
		
		//terapia ocupacional
		
		$campos_data_r["faesa_griddesarrollofisicoo"]["campos"]=array('escdesafisico_nombre','desafisico_descripcion','desafisico_resultado');
        $campos_name_r["faesa_griddesarrollofisicoo"]["titulos"]=array('&Aacute;rea','Descripci&oacute;n','Resultado');
        $tabla_combo1_r["faesa_griddesarrollofisicoo"]["combo"]="faesa_areadesafisico";
		$tabla_enlacecombo1_r["faesa_griddesarrollofisicoo"]["idcombo"]="escdesafisico_id";
        $tabla_enlacecombo1_r["faesa_griddesarrollofisicoo"]["enlace"]="ocupacio_enlace";
		
		
		$campos_data_r["faesa_gridmovimientosprimario"]["campos"]=array('alcanc_nombre','movipri_derecho','movipri_izquierdo');
        $campos_name_r["faesa_gridmovimientosprimario"]["titulos"]=array('Alcance','Derecho','Izquierdo');
        $tabla_combo1_r["faesa_gridmovimientosprimario"]["combo"]="faesa_alcances";
		$tabla_enlacecombo1_r["faesa_gridmovimientosprimario"]["idcombo"]="alcanc_id";
        $tabla_enlacecombo1_r["faesa_gridmovimientosprimario"]["enlace"]="ocupacio_enlace";
		
		$campos_data_r["faesa_gridfuncionmanual"]["campos"]=array('arafunman_nombre','funciman_derecho','funciman_izquierdo');
        $campos_name_r["faesa_gridfuncionmanual"]["titulos"]=array('Area','Derecho','Izquierdo');
        $tabla_combo1_r["faesa_gridfuncionmanual"]["combo"]="faesa_areafuncionmanual";
		$tabla_enlacecombo1_r["faesa_gridfuncionmanual"]["idcombo"]="arafunman_id";
        $tabla_enlacecombo1_r["faesa_gridfuncionmanual"]["enlace"]="ocupacio_enlace";
		
		
		$campos_data_r["faesa_gridbimanual"]["campos"]=array('arabima_nombre','biman_resultado');
        $campos_name_r["faesa_gridbimanual"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridbimanual"]["combo"]="faesa_areabimanual";
		$tabla_enlacecombo1_r["faesa_gridbimanual"]["idcombo"]="arabima_id";
        $tabla_enlacecombo1_r["faesa_gridbimanual"]["enlace"]="ocupacio_enlace";
		
		$campos_data_r["faesa_gridmanipulativa"]["campos"]=array('areamanipu_nombre','manipu_resultado');
        $campos_name_r["faesa_gridmanipulativa"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridmanipulativa"]["combo"]="faesa_areamanipulativa";
		$tabla_enlacecombo1_r["faesa_gridmanipulativa"]["idcombo"]="areamanipu_id";
        $tabla_enlacecombo1_r["faesa_gridmanipulativa"]["enlace"]="ocupacio_enlace";
		
		$campos_data_r["faesa_gridgrafomotora"]["campos"]=array('areagrafom_nombre','grafom_resultado');
        $campos_name_r["faesa_gridgrafomotora"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridgrafomotora"]["combo"]="faesa_areagrafomotora";
		$tabla_enlacecombo1_r["faesa_gridgrafomotora"]["idcombo"]="areagrafom_id";
        $tabla_enlacecombo1_r["faesa_gridgrafomotora"]["enlace"]="ocupacio_enlace";
		
		
		$campos_data_r["faesa_gridocular"]["campos"]=array('areaocular_nombre','ocular_resultado');
        $campos_name_r["faesa_gridocular"]["titulos"]=array('Area','Resultado');
        $tabla_combo1_r["faesa_gridocular"]["combo"]="faesa_areaocular";
		$tabla_enlacecombo1_r["faesa_gridocular"]["idcombo"]="areaocular_id";
        $tabla_enlacecombo1_r["faesa_gridocular"]["enlace"]="ocupacio_enlace";
		
		//terapia ocupacional
		
		for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
		 {
		
		  include($director."libreria/estructura/".$lista_tbldata[$itbl].".php");
		
		 } 
		$objformulario->sisfield_arr=$gogess_sisfield;
		$objformulario->sistable_arr=$gogess_sistable;
		
		$busca_dtabla="select * from gogess_sistable where tab_name='".$tabla."'";
        $rs_dtabla = $DB_gogess->executec($busca_dtabla,array());
        $table=$rs_dtabla->fields["tab_name"];  
        $campo_primariodata=$rs_dtabla->fields["tab_campoprimario"]; 
		
		$em_id_val=0;	
	    $csearch=0;	
	    $variableb=0;
		$csearch=$psic_id_valor;				 
				  $contenido_informes='';
         $objformulario->form_format_tabla($table,$DB_gogess);
		 $objformulario->systemb=@$system;
		 $objformulario->apl=@$apl;
         $objformulario->seccapl=@$seccapl;
         $objformulario->sessid=@$sessid;
         $objformulario->aplweb=@$apl;
         $objformulario->portalweb=@$portal;
         $objformulario->tiposis="web";
         $objformulario->imprpt=1;
		 $objformulario->pathexterno=@$director;
         $objformulario->pathexternoimp=@$director;
         $objformulario->campos_formatoc=@$campos_tipo;	
         $objformulario->idvalor_validador=@$csearch;
		 
		 $objformulario->vatajo=@$csearch;		   
		 $objformulario->campoorden=@$campoorden;
	     $objformulario->forden=@$forden;
		 $objformulario->id_inicio=@$id_inicio;   
		 $objformulario->formulario_buscar($table,@$csearch,@$listab,@$campo,@$obp,$DB_gogess);
		 
		 //concatena valorees y datos
		 
		 
		 $busca_g="select distinct fie_groupprint from gogess_sisfield where tab_name='".$table."' and fie_groupprint>0 and fie_group not in(".$grupoblock.") order by fie_groupprint asc";
$rs_buscag = $DB_gogess->executec($busca_g,array());
				if($rs_buscag)
                   {
	                  while (!$rs_buscag->EOF) {	
					  
					  
					  //verifica si hay datos en el grupo
					  $datos_valordata='';
					  $concatena_data='';
					  $bandera_valor=0;
					   $obtiene_camposlleno="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcamposlleno = $DB_gogess->executec($obtiene_camposlleno,array());
					  if($rs_bbcamposlleno)					  
					  {
					     while (!$rs_bbcamposlleno->EOF) {
						 
						   // $datos_valordata='';
						   if($rs_bbcamposlleno->fields["fie_guarda"]==1)
						   {
								//-------------------------------
								$datos_valordata=$objformulario->contenid[$rs_bbcamposlleno->fields["fie_name"]];
								if($datos_valordata=='0')
								{
								 $datos_valordata='';
								}
								
								$concatena_data.=$datos_valordata;
								//-------------------------------
								
						   }	
						   else
						   {
						   
						        if($rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid' or $rs_bbcamposlleno->fields["fie_typeweb"]=='campogrid2')
								{
								  $concatena_data.='si';
								}
								
								if($rs_bbcamposlleno->fields["fie_typeweb"]=='camposub_grid')
								{
								    
								   if($table=='faesa_psicologia')
								   {
								   //------------------------
								   if($objformulario->contenid["psic_enlace"])
								   {
								      $busca_registros="select count(1) as cuenta_valor from ".$rs_bbcamposlleno->fields["fie_tablasubgrid"]." where ".$rs_bbcamposlleno->fields["fie_campoenlacesub"]."='".$objformulario->contenid["psic_enlace"]."'";
									  $rs_cuentareg = $DB_gogess->executec($busca_registros,array());
									  
									  if($rs_cuentareg->fields["cuenta_valor"]>0)
									  {
									    $concatena_data.='si';
									  }
								   
								   }
								   //------------------------
								   }
								   
								   if($table=='faesa_pedagogia')
								   {
								   //-------------------------------
									   if($objformulario->contenid["pedago_enlace"])
									   {
										  $busca_registros="select count(1) as cuenta_valor from ".$rs_bbcamposlleno->fields["fie_tablasubgrid"]." where ".$rs_bbcamposlleno->fields["fie_campoenlacesub"]."='".$objformulario->contenid["pedago_enlace"]."'";
										  $rs_cuentareg = $DB_gogess->executec($busca_registros,array());
										  
										  if($rs_cuentareg->fields["cuenta_valor"]>0)
										  {
											$concatena_data.='si';
										  }
									   
									   }
								   //--------------------------------
								   }
								   
								
								}
						   
						   }
												 
						 $rs_bbcamposlleno->MoveNext();
						 }
					  
					  }
					  
					
					  
					  if($concatena_data)
					  {
					  
					  
					  //echo $rs_buscag->fields["fie_groupprint"]."<br>";
					  
					  $obtiene_campos="select * from gogess_sisfield where tab_name='".$table."' and fie_groupprint=".$rs_buscag->fields["fie_groupprint"]." order by fie_orden asc";
					  $rs_bbcampos = $DB_gogess->executec($obtiene_campos,array());
					  if($rs_bbcampos)
					  {
					       while (!$rs_bbcampos->EOF) {
						   
						   //echo $rs_bbcampos->fields["fie_name"]."<br>";
						   
						   ///------------------------------------------------------
						   $fie_title="";
						   if (!($rs_bbcampos->fields["fie_tactive"]))
							{
								$fie_title="";
							}
							else
							{
							
							   $fie_title="<label><b>".$rs_bbcampos->fields["fie_title"]."</b></label> ";
							}
						   
						   
						   if($rs_bbcampos->fields["fie_guarda"]==1)
						   { 
							
						
							   if (!(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]==""))
							   {
									 if ($rs_bbcampos->fields["fie_value"]=="replace")
									 {
										$valorbus=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
									 }
									 else
									 {
										if($rs_bbcampos->fields["fie_typeweb"]=='tiempobloque')
										{
										   $separa_fecha=array();
										   $separa_fecha=explode("-",$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]);
										   
										   $rmp=@$separa_fecha[0]." a&ntilde;os ".@$separa_fecha[1]." meses";
										}
										else
										{
										$rmp=$objformulario->contenid[$rs_bbcampos->fields["fie_name"]];
										}
										
									 }
							        
									if(@$objformulario->contenid[$rs_bbcampos->fields["fie_name"]]!='0')
									{
									  $saltotitulo="";
									  if($rs_bbcampos->fields["fie_name"]=='psic_impresiondiagnostica')
									  {
									    $saltotitulo="<br><b>IV. RECOMENDACIONES</b>";
										$contenido_informes.="<br>".$fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'" ><p align="justify" >'.utf8_decode($rmp).'</p></span>'.$saltotitulo;
									  }
									  else
									  {
									    $contenido_informes.="<br>".$fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'" ><p align="justify" >'.utf8_decode($rmp).'</p></span>';
									  }
									  
									  $saltotitulo="";				                                     
									  }
							   }
							   else
							   {
								    if($rs_bbcampos->fields["fie_sendvar"])
									{
									
									    //-------------------------------------------------------------------------------------
										
										if ($rs_bbcampos->fields["fie_value"]=="replace")
										 {
											$valorbus=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
											$rmp= $objformulario->replace_cmb($rs_bbcampos->fields["fie_tabledb"],$rs_bbcampos->fields["fie_datadb"],$rs_bbcampos->fields["fie_sql"],$valorbus,$DB_gogess);  
										 }
										 else
										 {
											$rmp=$objformulario->sendvar[$rs_bbcampos->fields["fie_sendvar"]];
										 }
								   
										  $contenido_informes.=$fie_title.'<span id="despliegue_'.$rs_bbcampos->fields["fie_name"].'" > <p align="justify" > '.$rmp.'</p></span>';	
										
										
										//--------------------------------------------------------------------------------------
									 
									
									}

							   
							   }
						   
						   
						   }
						   else
						   {
						   
						      
								  if($rs_bbcampos->fields["fie_archivogrid"])
								  {
								   
								    //include("../".$template_reemplazo."".$rs_bbcampos->fields["fie_archivogrid"]);
									
	
									$rs_bbcampos->fields["fie_campoenlacesub"];
									$valor_enlace='';
									$tabla_gridvalor_x=$rs_bbcampos->fields["fie_tablasubgrid"];
									$campo_enlace_x=$rs_bbcampos->fields["fie_campoenlacesub"];
									
									$campos_data=array();
									$campos_name=array();
									$tabla_combo1='';
									$tabla_enlacecombo1='';
									
									$campos_data=$campos_data_r[$tabla_gridvalor_x]["campos"];
                                    $campos_name=$campos_name_r[$tabla_gridvalor_x]["titulos"];
                                    $tabla_combo1=$tabla_combo1_r[$tabla_gridvalor_x]["combo"];
                                    $tabla_enlacecombo1=$tabla_enlacecombo1_r[$tabla_gridvalor_x]["idcombo"];

									
									$sqlcampos='';
									for($i=0;$i<count($campos_data);$i++)
										 {
											 $sqlcampos=$sqlcampos.",".$campos_data[$i];
										 }
									$sqlcampos=substr($sqlcampos,1);
									
									$cuenta=0;
									if($tabla_combo1)
									{
									$lista_servicios="select ".$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"].",".$sqlcampos." from ".$tabla_gridvalor_x." inner join ".$tabla_combo1." on ".$tabla_gridvalor_x.".".$tabla_enlacecombo1."=".$tabla_combo1.".".$tabla_enlacecombo1." where ".$campo_enlace_x."='".$rs_sihaydata->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]."'";
									}
									else
									{
									$lista_servicios="select ".$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"].",".$sqlcampos." from ".$tabla_gridvalor_x." where ".$campo_enlace_x."='".$rs_sihaydata->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]."'";
									
									}
									
									//echo $lista_servicios;
									$rs_data = $DB_gogess->executec($lista_servicios,array());
									
									if($rs_data->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]>0)
									{
									    $contenido_informes.="<br><b>".$fie_title."</b><br><br>";
									   	
										if($tabla_gridvalor_x=='faesa_pedagogiacompetencias')
										{
										      
											  $lista_porcombo="select * from ".$tabla_combo1;
											  $rs_listacombo = $DB_gogess->executec($lista_porcombo,array());
											  if($rs_listacombo)
										      {
												  while (!$rs_listacombo->EOF) {	
												  
												     $lista_serviciosgroup="select ".$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"].",".$sqlcampos." from ".$tabla_gridvalor_x." inner join ".$tabla_combo1." on ".$tabla_gridvalor_x.".".$tabla_enlacecombo1."=".$tabla_combo1.".".$tabla_enlacecombo1." where ".$campo_enlace_x."='".$rs_sihaydata->fields[$tabla_enlacecombo1_r[$tabla_gridvalor_x]["enlace"]]."' and ".$tabla_combo1.".tipcompe_id=".$rs_listacombo->fields["tipcompe_id"];
													  
													  $rs_listagropu = $DB_gogess->executec($lista_serviciosgroup,array());
													  
													  $contenido_informestbl='';
													 
													  $contenido_informestbl.="<p><b>".$rs_listacombo->fields["tipcompe_nombre"]."</b></p>".'<table class="table table-bordered"  style="width:100%" border="1" cellpadding="3" cellspacing="0" >';
													  $contenido_informestbl.='<thead><tr>';
													  for($i=1;$i<count($campos_name);$i++)
														 {
															 $contenido_informestbl.='<th style="border: 1px solid #999999;" ><b>'.$campos_name[$i].'</b></th>';
													
														 }
													  $contenido_informestbl.='</tr></thead><tbody>';
													  
													  if($rs_listagropu)
														 {
															  while (!$rs_listagropu->EOF) {	
															  
															  
																$cuenta++;
																$contenido_informestbl.='<tr>';
															 
																	for($i=1;$i<count($campos_data);$i++)
																	 {
																		 
																		 $contenido_informestbl.='<td style="border: 1px solid #999999;" >'.str_replace(".",".<br>",utf8_decode($rs_listagropu->fields[$campos_data[$i]])).'</td>';
																	 }
														 
																$contenido_informestbl.='</tr>';
																
																
														   
															   $rs_listagropu->MoveNext();	   
															  }
														  }
													  
													  
												      $contenido_informestbl.='</tbody></table></p>';
													  
													 $contenido_informes.=$contenido_informestbl;
													 
													 
													 $rs_listacombo->MoveNext();	 
												  }
											  }
											  
											  
										  
										}
										else
										{					
										
										$contenido_informes.='<table class="table table-bordered"  style="width:100%" border="1" cellpadding="3" cellspacing="0" >';
										$contenido_informes.='<thead><tr>';
									    
											for($i=0;$i<count($campos_name);$i++)
											 {
												 $contenido_informes.='<th style="border: 1px solid #999999;" ><b>'.$campos_name[$i].'</b></th>';
										
											 }
										
										$contenido_informes.='</tr></thead><tbody>';
										
										if($rs_data)
										 {
											  while (!$rs_data->EOF) {	
												$cuenta++;
												
												if($rs_data->fields[$campos_data[1]])
												{
										        $contenido_informes.='<tr>';
											 
													for($i=0;$i<count($campos_data);$i++)
													 {
														 
														 $contenido_informes.='<td style="border: 1px solid #999999;" >'.str_replace(".",".<br>",utf8_decode($rs_data->fields[$campos_data[$i]])).'</td>';
													 }
										 
										        $contenido_informes.='</tr>';
												}
										   
										       $rs_data->MoveNext();	   
											  }
										  }

										$contenido_informes.='</tbody></table></p>';
										}
									 
									}
									
	                                
									
									
									
								  }
						          else
								  {
			                            
									   if($rs_bbcampos->fields["fie_typeweb"]=='campo_subetiqueta')
										{
										 $contenido_informes.="<br><div style='color:#666666' ><b>".$fie_title."</b></div>";
										}
										else
										{
										 $contenido_informes.="<br><b>".$fie_title."</b><hr>";
										
										}	
								       
								       
								  }
								  
						   
						   }
						   ///-------------------------------------------------------
						   
						   
						   
						   $rs_bbcampos->MoveNext();
						   }
					  
					  }
					  
					  
					  }
					  
					  $rs_buscag->MoveNext();
					  }
				    }	
		 
		 
		 
		 
		 //concatena valores y datos

		return  $contenido_informes; 

}


}
?>