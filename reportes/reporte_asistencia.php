<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$dias_semana[1]='LUNES';
$dias_semana[2]='MARTES';
$dias_semana[3]='MIERCOLES';
$dias_semana[4]='JUEVES';
$dias_semana[5]='VIERNES';

?>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>

<?php
$valor_busca=$_GET["idsec"];
$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");
require_once('tcpdf_include.php');
$objformulario= new  ValidacionesFormulario();



function calcular_tiempo_trasnc($hora1,$hora2)
{
$dif=date("H:i:s", strtotime("00:00:00") + strtotime($hora1) - strtotime($hora2));
return $dif;
}


function restar_hora($horaini,$horafin)
{
    $f1 = new DateTime($horaini);
    $f2 = new DateTime($horafin);
    $d = $f1->diff($f2);
    return $d->format('%H:%I:%S');
}


$url="plantillas/informe_asistencia.php";
$lee_plantilla=$objvarios->leer_contenido_completo($url);	
$logo='<div align="center"><img src="../images/informe_logo.jpg" width="161" height="70" /></div>';
$lee_plantilla=str_replace("-logo-",$logo,$lee_plantilla);

//saca la ciudad
$busca_clientex="select * from app_usuario where usua_id='".$_GET["ivalor"]."'";
$rs_bclientex = $DB_gogess->executec($busca_clientex,array());
$centro_id=$rs_bclientex->fields["centro_id"];
//saca la ciudad


$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$centro_id,$DB_gogess);

$hora_entrada_pol=$objformulario->replace_cmb("faesa_politicasasistencia","centro_id,polasis_horaentradam"," where centro_id =",$centro_id,$DB_gogess);
$hora_salida_pol=$objformulario->replace_cmb("faesa_politicasasistencia","centro_id,polasis_horasalidat"," where centro_id =",$centro_id,$DB_gogess);

//BUSCA SI ENTRA MAS TARDE
$busca_horae="select * from faesa_politicasasistencia po inner join faesa_horasentrada he on po.polasis_id=he.polasis_id where usua_id=".$_GET["ivalor"];
$rs_bhoras = $DB_gogess->executec($busca_horae,array());

if($rs_bhoras->fields["horae_horaentrada"])
{
$hora_entrada_pol=$rs_bhoras->fields["horae_horaentrada"];
$hora_salida_pol=$rs_bhoras->fields["horae_horasalida"];
}
//BUSCA SI ENTRA MAS TARDE


$trabaja_sabado='';
$trabaja_domingo='';
$trabaja_sabado=$objformulario->replace_cmb("faesa_politicasasistencia","centro_id,polasis_tsabado"," where centro_id =",$centro_id,$DB_gogess);
$trabaja_domingo=$objformulario->replace_cmb("faesa_politicasasistencia","centro_id,polasis_tdomingo"," where centro_id =",$centro_id,$DB_gogess);


$fechas_array=array();
$br=0;
//----------------------------------------------------------
$nuevafecha = date($_GET["fechai"]);
$fechas_array[$br]=$nuevafecha;
$br++;
do {
    
$nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

$fechas_array[$br]=$nuevafecha;
$br++;
	
} while ($_GET["fechaf"] > $nuevafecha);
//----------------------------------------------------------


//reporte asistencia
$cedula_persona='';
$nombre_persona_lista='';
$busca_cliente="select * from app_usuario inner join app_jobtitle on app_usuario.jobt_id=app_jobtitle.jobt_id where usua_id='".$_GET["ivalor"]."'";
        $cuantadata=0;
        $rs_bcliente = $DB_gogess->executec($busca_cliente,array());
		$nombre_persona='';
		if($rs_bcliente->fields["usua_nombre"])
		{
		$obtiene_nombres[$cuantadata]="<b>".$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]."</b><br>".$rs_bcliente->fields["jobt_name"]."<br>COD: ".$rs_bcliente->fields["usua_codigo"]."<br>MSP: ".$rs_bcliente->fields["usua_msp"]."<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
		
		$nombre_persona=$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"]."<br> Hora Entrada:".$hora_entrada_pol."<br> Hora Salida:".$hora_salida_pol;
		
		$nombre_persona_lista=$rs_bcliente->fields["usua_siglastitulo"]." ".$rs_bcliente->fields["usua_nombre"]." ".$rs_bcliente->fields["usua_apellido"];
		
		$cedula_persona=$rs_bcliente->fields["usua_ciruc"];
		
		
		$obtiene_codebio=$rs_bcliente->fields["usua_codigobiometrico"];
		
		$cuantadata++;
		}


//datos personales
$fecha_ciudad=$nciudad.", ".$objvarios->fechaCastellano(date("Y-m-d"));
$lee_plantilla=str_replace("-fecha-",$fecha_ciudad,$lee_plantilla);

//lista centro
$contenido_valor='';
$contador=0;
  $SUMADIAS=0;
  $HORASPERMISOS=0;
  $MINUTOSPERMISOS=0;
 $contenido_valor.='<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="css_titulo">'.$rs_centro->fields["centro_nombre"].'</span></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="2">
      <tr>
	    <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">ORD</span></div></td>
		 <td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">D&Iacute;A</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">FECHA</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">CEDULA DE IDENTIDAD</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">APELLIDOS Y NOMBRES</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">HORA ENTRADA</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">HORA MEDIA</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">HORA SALIDA</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">HORAS TRABAJADAS</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">DIAS PERMISOS</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">HORAS PERMISOS </span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">FERIADO</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">ATRASOS</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">FALTAS</span></div></td>
		<td bgcolor="#CCD9E3"><div align="center"><span class="css_titulo">OBSERVACIONES</span></div></td>
       </tr>';
	   $contador_suma=0;
	$cuenta_flatas=0;	
	$cuenta_atrasos=0;
	$cuenta_permisos=0;
	$cuenta_feriad=0;
	for($iv=0;$iv<count($fechas_array);$iv++)
	{
	  $dia='';
	  $dia=date("w", strtotime($fechas_array[$iv]));
      if($dia!=0)
	  {  
	     if($dia!=6)
		 {

	  $contador=$iv+1;	
	   $contador_suma++;	  
      $contenido_valor.='<tr>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$contador_suma.'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$dias_semana[$dia].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$fechas_array[$iv].'</span></td>
        <td bgcolor="#F4F4F4"><span class="css_texto">'.$cedula_persona.'</span></td>
		<td bgcolor="#F4F4F4"><span class="css_texto">'.$nombre_persona_lista.'</span></td>';
		
	//busca feriados y vacaciones
	$sacafecha_val=explode("-",$fechas_array[$iv]);
	
	$n_feriado='';
	$v_feriado='';
	
	$bu_feriados="select * from faesa_politicasasistencia pa inner join faesa_vacaciones vac on pa.polasis_id=vac.polasis_id where vaca_siempre=1 and centro_id=".$centro_id." and vaca_fecha like '%"."-".$sacafecha_val[1]."-".$sacafecha_val[2]."'";
	$rs_bferiado = $DB_gogess->executec($bu_feriados,array());
	if($rs_bferiado->fields["vaca_id"])
	{
	   $n_feriado=$rs_bferiado->fields["vaca_motivo"];
	   $v_feriado=1;
	   $cuenta_feriado++;
	}
	
	
	$bu_feriados="select * from faesa_politicasasistencia pa inner join faesa_vacaciones vac on pa.polasis_id=vac.polasis_id where vaca_siempre=0 and centro_id=".$centro_id." and vaca_fecha = '".$sacafecha_val[0]."-".$sacafecha_val[1]."-".$sacafecha_val[2]."'";
	$rs_bferiado = $DB_gogess->executec($bu_feriados,array());
	if($rs_bferiado->fields["vaca_id"])
	{
	   $n_feriado=$rs_bferiado->fields["vaca_motivo"];
	   $v_feriado=1;
	   $cuenta_feriado++;
	}
	
	//busca feriados y vacaciones	
		
		
	//busca permiso
	
	$n_permiso='';
	$v_permiso='';
	 $tiempop='';
	 $tiempoH='';
	 $nombre_vacacion='';
	$lista_bpermiso="select * from  faesa_permisos  where usua_id='".$_GET["ivalor"]."' and (permi_fecha<='".$fechas_array[$iv]."' and permi_fechaf>='".$fechas_array[$iv]."')";
	$rs_bpermiso = $DB_gogess->executec($lista_bpermiso,array());
	$HORASAT_permi='';
	$MINUTOSAT_permi='';
	
	$horas_atraso=0;
	$HORASAT_permiSuma='';
	$MINUTOSAT_permiSuma='';
	
	$tiempoHt='';
	
	$n_permiso='';
	 $bandera_val='';
	if($rs_bpermiso)
	{
		 while (!$rs_bpermiso->EOF) {
				 //----------------------------------------------
				if($rs_bpermiso->fields["permi_id"])
				{
				   
				   $n_permiso.=$rs_bpermiso->fields["permi_observacion"]."<br>".$rs_bpermiso->fields["permi_concargoa"]."/";
				   if($rs_bpermiso->fields["permi_dias"]>0)
				   {
					  $tiempop=1;
				   }
				   
				   $permiso_manana=$rs_bpermiso->fields["permi_maniana"];
						
				   $tiempoH=$rs_bpermiso->fields["permi_horas"];
				   $spara_valora_permi=array();
		           $spara_valora_permi=explode(":",$tiempoH);
		           $HORASAT_permi=$HORASAT_permi+$spara_valora_permi[0];
		           $MINUTOSAT_permi=$MINUTOSAT_permi+$spara_valora_permi[1];  	   
				   $nombre_vacacion=$rs_bpermiso->fields["permi_concargoa"];
				   
				   if($nombre_vacacion=='VACACIONES' or $nombre_vacacion=='REMUNERACION')
	               {
				      
					  $spara_valora_permiSuma=array();
		              $spara_valora_permiSuma=explode(":",$tiempoH);
		              $HORASAT_permiSuma=$HORASAT_permiSuma+$spara_valora_permiSuma[0];
		              $MINUTOSAT_permiSuma=$MINUTOSAT_permiSuma+$spara_valora_permiSuma[1];  	   
				   
				   }
				    
				   $v_permiso=1;
				   $cuenta_permisos++;
				   $bandera_val=1;
				   
				   
				}
				//--------------------------------------------  
				
				   $rs_bpermiso->MoveNext();
		}
	      
		  if($bandera_val)
		  {
			  $horas_nuevas='';
			  $saca_horas_demin='';
			  if($MINUTOSAT_permi>=60)
			  {
				  $horas_nuevas=$MINUTOSAT_permi/60;
				  $saca_horas_demin=explode(".",$horas_nuevas); 
				  if($saca_horas_demin[0])
				  {
				      $HORASAT_permi=$HORASAT_permi+$saca_horas_demin[0];
				  }
				  $MINUTOSAT_permi=(("0.".$saca_horas_demin[1])*60);
			  }
			  $tiempoHt=$HORASAT_permi.":".$MINUTOSAT_permi;
			  //------------------------------------------------
			  
			  $horas_nuevasSuma='';
			  $saca_horas_deminSuma='';
			  if($MINUTOSAT_permiSuma>=60)
			  {
				  $horas_nuevasSuma=$MINUTOSAT_permiSuma/60;
				  $saca_horas_deminSuma=explode(".",$horas_nuevasSuma); 
				  if($saca_horas_deminSuma[0])
				  {
				      $HORASAT_permiSuma=$HORASAT_permiSuma+$saca_horas_deminSuma[0];
				  }
				  $MINUTOSAT_permiSuma=(("0.".$saca_horas_deminSuma[1])*60);
			  }
			  $nombre_vacacion=='REMUNERACION';
			  $tiempoH=$HORASAT_permiSuma.":".$MINUTOSAT_permiSuma;
			  
			  
		  }
		  
	}
	
	//busca permiso	
	
	$hora_medias='';
		
	$lista_inv="select * from  faesa_biometrico  where bio_codigousuario='".$obtiene_codebio."' and bio_fecha='".$fechas_array[$iv]."' and 	centro_id='".$_GET["centro_id"]."' order by bio_hora asc";
	$rs_inv = $DB_gogess->executec($lista_inv,array());
	$inicio=0;
	$hora_entrada='';
	$hora_salida='';
	if ($rs_inv)
		{
			 while (!$rs_inv->EOF) {
				  
				if($inicio==0)
				{
				    
					$hora_entrada=substr($rs_inv->fields["bio_hora"],0,-3); 
				}
				else
				{
				   $hora_medias.=substr($rs_inv->fields["bio_hora"],0,-3)." "; 
				
				}
				
				
				
				$hora_salida=substr($rs_inv->fields["bio_hora"],0,-3); 
				
				$inicio++;  
				  
		     $rs_inv->MoveNext();
		     }
        }				  
	$hora_medias=str_replace($hora_salida,'',$hora_medias);
	 $conatenahoras='';

	 $conatenahoras=$hora_entrada.$hora_salida;
	 
	 if($n_permiso)
	 {
	 $conatenahoras='1';
	 }
	 
	 if($n_feriado)
	 {
	   $conatenahoras='1';
	 }
	 
	 $faltas='';
	 if(!($conatenahoras))
	 {
	    $faltas=1;
		$cuenta_flatas++;
	 }
	 
	 $horas_atraso='';
	 if($hora_entrada)
	 {	
	   if($hora_entrada>$hora_entrada_pol)
	   {
	      
		  if(!($tiempoH))
		  {
		    if(!($tiempop))
			{
		     $horas_atraso=calcular_tiempo_trasnc($hora_entrada,$hora_entrada_pol);
			 }
		  }
		  
		  ///
		  if($permiso_manana==0)
		  {
		     $horas_atraso=calcular_tiempo_trasnc($hora_entrada,$hora_entrada_pol);
		  }
		  ///
		  
		  if($horas_atraso)
		  {
		     $cuenta_atrasos++;
		  }
		  else
		  {
		     $horas_atraso='';
		  
		  }
	   }
	   
	 }
	 
	 $contenido_valor.='<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$hora_entrada.'</span></td>';
	 $contenido_valor.='<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$hora_medias.'</span></td>';
	 
	 
	 $contenido_valor.='<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$hora_salida.'</span></td>';
	 $horas_t='';
	 $horas_t=calcular_tiempo_trasnc($hora_salida,$hora_entrada);
	 
	  $horassin=$horas_t;
	 
	 if($tiempoH)
	 {
	    if(trim($hora_medias))
	    {
	      if($tiempoH!=":")
		  {
		  $horas_t=restar_hora($horas_t,$tiempoH);
		  }
	    }
	 }
	 
	 $contenido_valor.='<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$horas_t.'</span></td>';
	 
	 $contenido_valor.='
	    <td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$tiempop.'</span></td>
		<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$tiempoHt.'</span></td>
	    <td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$v_feriado.'</span></td>
		
		
		<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto" >'.$horas_atraso.'</span></td>
		
		
		<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto" >'.$faltas.'</span></td>
		<td bgcolor="#F4F4F4" nowrap="nowrap" ><span class="css_texto"  >'.$n_permiso.$n_feriado.'</span></td>
        </tr>';
		
		if($nombre_vacacion=='VACACIONES' or $nombre_vacacion=='REMUNERACION')
	     {
		$SUMADIAS=$SUMADIAS+$tiempop;
		}
		
		if($nombre_vacacion=='VACACIONES' or $nombre_vacacion=='REMUNERACION')
	     {
		$spara_valor=array();
		$spara_valor=explode(":",$tiempoH);
		$HORASPERMISOS=$HORASPERMISOS+$spara_valor[0];
		$MINUTOSPERMISOS=$MINUTOSPERMISOS+$spara_valor[1];
		}
		
		//suma atrasos
		$spara_valorat=array();
		$spara_valorat=explode(":",$horas_atraso);
		$HORASAT=$HORASAT+$spara_valorat[0];
		$MINUTOSAT=$MINUTOSAT+$spara_valorat[1];
		
		//suma atrasos
		
		
		   }
		}
	
	} 
		
    $contenido_valor.='</table></td>
  </tr>
</table>';


$mashorasAT=$MINUTOSAT/60;
$verminutosAT=explode(".",$mashorasAT);
$hnuevaAT=$verminutosAT[0];
$minnAT=("0.".$verminutosAT[1])*60;
$HORASAT=$HORASAT+$hnuevaAT;
$minnAT=number_format($minnAT, 2, '.', '');



//$contenido_valor.="Faltas:".$cuenta_flatas."<br>";
//$contenido_valor.="Atrasos:".$HORASAT.":".$minnAT."<br>";
//$contenido_valor.="Feriados:".$cuenta_feriado."<br>";
//$contenido_valor.="D&iacute;as permisos:".$SUMADIAS."<br>";


$mashoras=$MINUTOSPERMISOS/60;
$verminutos=explode(".",$mashoras);
$hnueva=$verminutos[0];
$minn=("0.".$verminutos[1])*60;
$HORASPERMISOS=$HORASPERMISOS+$hnueva;
$minn=number_format($minn, 2, '.', '');

//$contenido_valor.="Horas permisos:".$HORASPERMISOS."<br>";
//$contenido_valor.="Minutos permisos:".$minn."<br>";

$contenido_valor.="<BR>RESUMEN<BR><table width='200px' border='1' >
  <tr>
    <td>Faltas</td>
    <td>".$cuenta_flatas."</td>
  </tr>
  <tr>
    <td>Atrasos</td>
    <td>".$HORASAT.":".$minnAT."</td>
  </tr>
  <tr>
    <td>Feriados</td>
    <td>".$cuenta_feriado."</td>
  </tr>
  <tr>
    <td>D&iacute;as permisos</td>
    <td>".$SUMADIAS."</td>
  </tr>
  <tr>
    <td>Horas permisos</td>
    <td>".$HORASPERMISOS."</td>
  </tr>
  <tr>
    <td>Minutos permisos</td>
    <td>".$minn."</td>
  </tr>
</table>";




$contenido_valor.="<center>___________________________________________</center><br>
<center>JEFE DE RECURSOS HUMANOS FAESA</center>
";


$lee_plantilla=str_replace("-inventario-",$contenido_valor,$lee_plantilla);
$lee_plantilla=str_replace("-datos-",$nombre_persona,$lee_plantilla);

//datos de medicos

$comprobantepdf='';
$comprobantepdf=$lee_plantilla;



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    var $filtro_valor_h1;
	var $filtro_valor_h2;
	var $filtro_valor_h3;
	//Page header
    public function Header() {
        // Logo
		$image_file = 'centro.png';
        $this->Image($image_file, 85, 10, 31, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 9);
        // Title
		$this->SetFont('helvetica', 'B', 9);
        // Title
		
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom	
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
    }
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Faesa');
$pdf->SetTitle('Faesa');
$pdf->SetSubject('Faesa');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->filtro_valor_h1='';
$pdf->filtro_valor_h2='';
$pdf->filtro_valor_h3='';
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

//$pdf->Write(0, 'HANOR', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

echo utf8_encode($comprobantepdf);
$pdf->writeHTML(utf8_encode($comprobantepdf), true, false, false, false, '');

//echo $comprobantepdf="Holaa";
$nombre_pdf="inventario_".$valor_busca.".pdf";
//$pdf->Output($nombre_pdf, 'I');



}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
 ?>
<script type="text/javascript">
<!--
    location.href = "../index.php";
 //  End -->
</script>
 <?php
}	

?>