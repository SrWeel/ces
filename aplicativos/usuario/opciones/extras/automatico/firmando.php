<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_SESSION['ces1313777_sessid_inicio'])
{
$formato_pdf=0;
 $subindice="_facturas";

$director="../../../../../";
include ("../../../../../cfgclases/clases.php");

require_once("../../../../../../JavaBridge/java/Java.inc");

    //java("HolaFranklin");
$firmaElectronica = new Java("firmaArchivo.signatureWeb");

function agregar_dv($_rol) {
    /* Remuevo los ceros del comienzo. */
    while($_rol[0] == "0") {
        $_rol = substr($_rol, 1);
    }
    $factor = 2;
    $suma = 0;
    for($i = strlen($_rol) - 1; $i >= 0; $i--) {
        $suma += $factor * $_rol[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
    $dv = 11 - $suma % 11;
    /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "1" : $dv);
    return $dv;
}

function randomString($length = 10, $letters = NULL){
    //Si no nos especifican lo contrario usaremos un conjunto de letras por defecto
    if(!isset($letters) || strlen($letters) == 0){
        $letters = "1234567890"; //Por defecto usaremos todas estas letras
    }
    
    $str = ''; //Cadena resultante
    $max = strlen($letters)-1;
    
    for($i=0; $i<$length; $i++){
        $str .= $letters[rand(0,$max)]; //Hasta que tengamos $length caracteres agregamos una letra al hazar del conjunto $letters
    }
    
    return $str;
}

//---------------------------
//Lote masivo clave de acceso

//echo $_POST["pclvfirma"];
//---------------------------

$lotecarg="select * from factura_listacargados where listcg_archivo='".$_POST["parchivo"]."'";
							$rs_busclote = $DB_gogess->Execute($lotecarg); 
							if($rs_busclote)
							{
								  while (!$rs_busclote->EOF) {	
								  
								  $dat_ruclote=$rs_busclote->fields["listcg_ruc"];
								  

								  $dat_ruclote=$rs_busclote->fields["listcg_ruc"];
								  $accesoclavelotex=$rs_busclote->fields["listcg_claveAcceso"];
								  $establelotex=$rs_busclote->fields["listcg_establecimiento"];
								  $coddocx=$rs_busclote->fields["listcg_codDoc"];
								  $listcg_firmax=$rs_busclote->fields["listcg_firma"];
								  
								  $listcg_xml=$rs_busclote->fields["listcg_xml"];
								  
								  
								  
								  
								  $grupos=$rs_busclote->fields["listcg_numerofacturas"]/1;
								   $cortanum=explode(".",$grupos);
								   if($cortanum[1]>0)
								   {
								   $grupos=$cortanum[0]+1;
								   }
								   else
								   {
								   $grupos=$cortanum[0];
								   }
								   
								   //------------------------------------------
								   $buscacfgx="select * from kyradm_automatico where auto_id=".$rs_busclote->fields["auto_id"];
								   $rs_opcionesx = $DB_gogess->Execute($buscacfgx);
									if($rs_opcionesx)
										{ 
											$o_cantidadporlote=1;
											
										}
								   
								   
								   //------------------------------------------
								  $rs_busclote->MoveNext();
								  
								  }
								  
						    }
 
 
 if($listcg_firmax=='SI')
 {
  echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Lote firmado</div>';
 }
 else
 {
 
   
    //busca certificado
	$buscacertificado="select * from factura_cerficado where usua_ciruc='".$_SESSION['ces1313777_sessid_cedula']."' and cert_activo=1";
	$rs_cert = $DB_gogess->Execute($buscacertificado); 
					  if($rs_cert)
					  {
						  while (!$rs_cert->EOF) {
						  
							$archcert=$rs_cert->fields["cert_nombre"];
						  
							 $rs_cert->MoveNext();
						  }
					  
					  }
					  $narchivoval=str_replace(".txt","",$_POST["parchivo"]);
	
	
					  
	//busca certificado
	for($iv=1;$iv<=$grupos;$iv++)
	{
	

	   $archivoafirmar=$narchivoval."-".$iv.".xml";
	   $buscafact="select * from factura_detallista where listcgd_archivo='".$archivoafirmar."'";
	   $rs_okdetalleloc = $DB_gogess->Execute($buscafact); 
	   if($rs_okdetalleloc)
			{
				  	  while (!$rs_okdetalleloc->EOF) {
						  
							$firmado=$rs_okdetalleloc->fields["listcgd_firma"];
							
							$listcgd_xml=$rs_okdetalleloc->fields["listcgd_xml"];
							
							$claveaccesobuscaenfac=$rs_okdetalleloc->fields["listcgd_claveacceso"];
						  
							 $rs_okdetalleloc->MoveNext();
						  } 
					  
			}
        
		
		if($firmado!='SI')
		{
		//---------------------------------------------------si esta firmado---------------------------------

		   //------------------------------------------------------------------------------------
		if($o_silote==1)
		{    
        $salida_xml=$firmaElectronica->firmando($listcgd_xml,"C:/firma/certificado/".$archcert,$_POST["pclvfirma"],"lote");
		}
		else
		{
		$salida_xml=$firmaElectronica->firmando($listcgd_xml,"C:/firma/certificado/".$archcert,$_POST["pclvfirma"],"comprobante");	
		}
		
		if(trim($salida_xml)=='1')
		{
		  echo "Archivo a firmar no existe...";
		  
		}
		else
		{
		  if(trim($salida_xml)=='2')
			{
			  echo "Certificado no existe...";
			  
			}
		   else
		   {
		   
			 if(trim($salida_xml)=='3')
				{
				
				  echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Clave del certificado incorrecto...</div>';
				  
				}
				else
				{
				   
				    $archivofirma=$narchivoval."-".$iv.".xml";
					
					$listadata="update factura_detallista set listcgd_xmlfirmado='".base64_encode($salida_xml)."',listcgd_firma='SI' where listcgd_archivo='".$archivofirma."'";
					//echo $listadata;
					$okfirma = $DB_gogess->Execute($listadata); 
					if($okfirma)
					{
						//$archivo=$path_firmado.$narchivoval."-".$iv.".xml";
						//$id = fopen($archivo, 'w+');
						//$cadena = $salida_xml;
						//fwrite($id, $cadena);
						//fclose($id);	
						//echo "Documento firmado con exito...";
						
						//firmadode cabecera
						
						if($_POST["pcargaid"]=='01')
						{
						$actualizafacturaf="update comprobante_fac_cabecera set comcab_firmado='SI',comcab_usuarioacepto='".$_SESSION['ces1313777_sessid_cedula']."',comcab_xmlfirmado='".base64_encode($salida_xml)."' where comcab_clavedeaccesos='".$claveaccesobuscaenfac."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						// echo $actualizafacturaf;
						 if(!($okvalorfirma))
						 {
							$listadataxr="update factura_detallista set listcgd_xmlfirmado='',listcgd_firma='' where listcgd_archivo='".$archivofirma."'"; 
							$okretorno=$DB_gogess->Execute($listadataxr); 
						 }
						}
						
						
							if($_POST["pcargaid"]=='04')
						{
						$actualizafacturaf="update comprobante_credito_cab set comcabcre_firmado='SI',comcabcre_usuarioacepto='".$_SESSION['ces1313777_sessid_cedula']."',comcabcre_xmlfirmado='".base64_encode($salida_xml)."' where comcabcre_tipocomprobante ='".$_POST["pcargaid"]."' and comcabcre_clavedeaccesos='".$claveaccesobuscaenfac."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						 if(!($okvalorfirma))
						 {
							$listadataxr="update factura_detallista set listcgd_xmlfirmado='',listcgd_firma='' where listcgd_archivo='".$archivofirma."'"; 
							$okretorno=$DB_gogess->Execute($listadataxr); 
						 }
						}
						
						if($_POST["pcargaid"]=='05')
						{
						$actualizafacturaf="update comprobante_credito_cab set comcabcre_firmado='SI',comcabcre_usuarioacepto='".$_SESSION['ces1313777_sessid_cedula']."',comcabcre_xmlfirmado='".base64_encode($salida_xml)."' where comcabcre_tipocomprobante ='".$_POST["pcargaid"]."' and  comcabcre_clavedeaccesos='".$claveaccesobuscaenfac."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						 if(!($okvalorfirma))
						 {
							$listadataxr="update factura_detallista set listcgd_xmlfirmado='',listcgd_firma='' where listcgd_archivo='".$archivofirma."'"; 
							$okretorno=$DB_gogess->Execute($listadataxr); 
						 }
						}
						
						
						
						if($_POST["pcargaid"]=='06')
						{
						$actualizafacturaf="update comprobante_guia_cabecera set compguiacab_firmado='SI',compguiacab_usuarioacepto='".$_SESSION['ces1313777_sessid_cedula']."',compguiacab_xmlfirmado='".base64_encode($salida_xml)."' where compguiacab_tipocomprobante ='".$_POST["pcargaid"]."' and  compguiacab_clavedeaccesos='".$claveaccesobuscaenfac."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						 if(!($okvalorfirma))
						 {
							$listadataxr="update factura_detallista set listcgd_xmlfirmado='',listcgd_firma='' where listcgd_archivo='".$archivofirma."'"; 
							$okretorno=$DB_gogess->Execute($listadataxr); 
						 }
						}
						
						
			
			           if($_POST["pcargaid"]=='07')
						{
					
						 
						 $actualizafacturaf="update comprobante_retencion_cab set compretcab_firmado='SI',compretcab_usuarioacepto='".$_SESSION['ces1313777_sessid_cedula']."',compretcab_xmlfirmado='".base64_encode($salida_xml)."' where compretcab_clavedeaccesos='".$claveaccesobuscaenfac."'";
                         $okvalorfirma=$DB_gogess->Execute($actualizafacturaf); 
						
						 if(!($okvalorfirma))
						 {
							$listadataxr="update factura_detallista set listcgd_xmlfirmado='',listcgd_firma='' where listcgd_archivo='".$archivofirma."'"; 
							$okretorno=$DB_gogess->Execute($listadataxr); 
						 }
						 
						 
						 
						}
			//echo "Factura firmada con exito...";
						
						//firmadode cabecera
						
						
						$firma++;
								
					}
					
					
				}
		   
		   }
		
		}
   //------------------------------------------------------------------------------------
		  
		  //---------------------------------------------------si esta firmado---------------------------------
		  }
		  else
		  {
		   echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Documento ya fue firmado...</div>';
		  }
		  
		 
		  
	}
	
  if($firma>0)
		  {
			  echo "Documentos firmados (".$firma.") con exito...";
		  }
   
   
   
 }
 //crando xml
// $actualizdata="update factura_listacargados set listcg_code='".$_POST["pclvfirma"]."', where listcg_archivo='".$_POST["parchivo"]."'";	
  //	$rs_certxx = $DB_gogess->Execute($actualizdata); 
   // echo $actualizdata;

}
else
{

echo '<div style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';

}

?>