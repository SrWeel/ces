<?php

function generacodebarra2($idnumerografico,$idfac,$grafbarra)
{
  $fontSize = 10;   // GD1 in px ; GD2 in point
  $marge    = 2;   // between barcode and hri in pixel
  $x        = 165;  // barcode center
  $y        = 30;  // barcode center
  $height   = 60;   // barcode height in 1D ; module size in 2D
  $width    = 1;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
  $code     = $idnumerografico; // barcode, of course ;)
  $type     = 'code128';
  $black    = '000000'; // color in hexa
  
   $im     = imagecreatetruecolor(330, 60);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  imagefilledrectangle($im, 0, 0, 330, 60, $white);
  
   $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  // -------------------------------------------------- //
  //                        HRI
  // -------------------------------------------------- //
 // if ( isset($font) ){
 //   $box = imagettfbbox($fontSize, 0, $font, $data['hri']);
//    $len = $box[2] - $box[0];
//    Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
 //   imagettftext($im, $fontSize, $angle, $x + $xt, $y + $yt, $blue, $font, $data['hri']);
 // }
 
  
   
   $local="C:/xampp/htdocs/italface/codigodebarra/";
  imagegif($im,$local.$grafbarra.$idfac.'.gif');
  imagedestroy($im);  
	
}

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


function formulario_guardar($table,$_POSTX,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess)
{
   $_POST_B=$_POSTX;
   $sqlcampos='';
   $sqlvalues='';
  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1 order by fie_orden asc"; 
  $rs_gogessform = $DB_gogess->executec($selecTabla,array());
  while (!$rs_gogessform->EOF) {
  //---------------------------------
          $tab_namesql=$rs_gogessform->fields["tab_name"];
		  $fie_namesql=$rs_gogessform->fields["fie_name"];
		  
          //$this->tab_bextras=$rs_gogessform->fields["tab_bextras"];
		  
		  $datos_campos=campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);
		  
		  $typeSql=$datos_campos["field_type"];
		  $flags = $datos_campos["field_flags"];
		  $autoincrement = strstr ($flags, 'auto_increment');		  
		  
		  if (!($autoincrement))
             {
                  //-----1
				   $sqlcampos=$sqlcampos.",".$fie_namesql;				   
				    switch ($typeSql) 
						{
						 case "int":
						  {
							if (@$_POST_B[$fie_namesql])
							{	  
							  $sqlvalues=$sqlvalues.",".$_POST_B[$fie_namesql];   
							 }
							 else
							 {
							   $sqlvalues=$sqlvalues.",0";  
							 } 
						   }
						  break;
						 case "real":
						  {
							if ($_POST_B[$fie_namesql])
							{
							 $sqlvalues=$sqlvalues.",".$_POST_B[$fie_namesql];
							 }
							 else
							 {
							 $sqlvalues=$sqlvalues.",0";
							 }
						   }
						  break;
						 default:
							{
								switch ($datos_campos["fie_typeweb"]) 
										{
												 case "checkboxmul":
												  {   
														   $icheck=0;
														   $valorcheck='';
														  /////////////////////////////////////////////////
															   $sqlchek="select distinct ".$datos_campos["fie_datadb"]." from ".$datos_campos["fie_tabledb"]." ".$datos_campos["fie_sqlorder"];
															   $rs_gogess1 = $DB->executec($sqlchek,array());															 
															   $icheck=1;
															   while (!$rs_gogess1->EOF) 
																	{	
																	 
																		 if ($_POST_B[$fie_namesql.$icheck])
																		  {
																		   $valorcheck=$valorcheck.$_POST_B[$fie_namesql.$icheck].",";
																		  }
																		  else
																		  {
																		  $valorcheck=$valorcheck."0".",";
																		  }																	 
																		  $icheck++;																		 
																		  $rs_gogess1->MoveNext();
																	}
																	
															$sqlvalues=$sqlvalues.",'".$valorcheck."'";	
														  ////////////////////////////////////////////////					                 
												   }
												   break;
												 case "password":
												  {   
														$textoformateado=md5($_POST_B[$fie_namesql]);
														$sqlvalues=$sqlvalues.",'".$textoformateado."'";						                 
												  }
												   break;
												 default:
													{
													 @$textoformateado=textorraro($_POST_B[$fie_namesql]);
													 $sqlvalues=$sqlvalues.",'".$textoformateado."'";
													}	 
												break;
										  }
								
							}
						   break;
						 } 
				   
                  //-----1
             }		  
		  
          
  //--------------------------------- 
    $rs_gogessform->MoveNext();
  }
  
  
   $sql_1="insert into ".$table." (".substr ("$sqlcampos",1).") values (".substr ("$sqlvalues",1).")";
   
//echo $sql_1;

    $okinsertado=0; 
   $ok=$DB_gogess->executec($sql_1,array());
   
   if ($ok) 
   {
    $okinsertado=1;	  
   }  
   else 
   {
	 $okinsertado=0;	   
   }
   unset($_POST_B);
   return $okinsertado;
   
   
}

function formulario_update($table,$_POSTX,$typesql,$ids,$varsend,$listab,$campo,$obp,$DB_gogess)
{
  $_POST=$_POSTX; 
  $_POST_B=$_POSTX;
  
  $selecTabla="select * from gogess_sistable,gogess_sisfield where gogess_sistable.tab_name = gogess_sisfield.tab_name and gogess_sistable.tab_name like '".$table."' and fie_active=1";  
  $rs_update = $DB_gogess->executec($selecTabla,array());
 
   while (!$rs_update->EOF) {
   //---1
          $tab_namesql=trim($rs_update->fields["tab_name"]);
		  $fie_namesql=trim($rs_update->fields["fie_name"]);
          //$this->tab_bextras=trim($rs_update->fields[$this->maymin("tab_bextras")]);		  
	  
		  $datos_campos=campo_gogess($tab_namesql,$fie_namesql,$DB_gogess);		  
		  $typeSql=$datos_campos["field_type"];
		  $flags = $datos_campos["field_flags"];

		  $autoincrement = strstr ($flags, 'auto_increment');		
          $pka = strstr ($flags, 'primary');
		  
		  if ($pka)
			{
			   $ncampoid=$fie_namesql;
				 switch ($typeSql) 
							{
									 case "int":
									  {   
											$operator="=";							                 
									   }
									   break;
									 case "real":
									  {   
											$operator="=";							                 
									  }
									   break;
									 default:
										$operator="like";
										break;
							  }
			}
		 
		 
		 if (!($autoincrement))
         {
		 //---2
		 
		 switch ($typeSql) 
				{
				 case "int":
				  {  
					//En caso de error en datos
					   if ($_POST_B[$fie_namesql])
					   {
						$sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST_B[$fie_namesql];   
					   }
						else
						{
						$sqlvalues=$sqlvalues.",".$fie_namesql."=0";
						}
				   }
				  break;
				 case "real":
				  {         
					 if ($_POST_B[$fie_namesql])
					 {
					   $sqlvalues=$sqlvalues.",".$fie_namesql."=".$_POST_B[$fie_namesql];
					 }
					 else
					 {
					   $sqlvalues=$sqlvalues.",".$fie_namesql."=0";
					 }
				   }
				  break;
				  
				   case "date":
						  {
							if ($_POST_B[$fie_namesql])
							{	  
							  $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST_B[$fie_namesql]."'";   
							 }
							 else
							 {
							   $sqlvalues=$sqlvalues.",".$fie_namesql."=NULL";  
							 } 
						   }
						  break; 
						  
						  case "time":
						  {
							if ($_POST_B[$fie_namesql])
							{	  
							  $sqlvalues=$sqlvalues.",".$fie_namesql."='".$_POST_B[$fie_namesql]."'";  
							 }
							 else
							 {
							   $sqlvalues=$sqlvalues.",".$fie_namesql."=NULL"; 
							 } 
						   }
						  break;
				  
				  
				 default:
					{
						
						$icheck=0;
						   $valorcheck='';
						/////////////////////////////////////////////////////////////////////////////
						switch ($datos_campos["fie_type"]) 
								{
										 case "checkboxmul":
										  {   
														 /////////////////////////////////////////////////																
														 
														   $sqlchek="select distinct ".$datos_campos["fie_datadb"]." from ".$datos_campos["fie_tabledb"]." ".$datos_campos["fie_sqlorder"];
														   $rs_gogess1 = $DB->Execute($sqlchek);															 
														   $icheck=1;
														   while (!$rs_gogess1->EOF) 
															{	
																  if ($_POST_B[$fie_namesql.$icheck])
																  {
																   $valorcheck=$valorcheck.$_POST_B[$fie_namesql.$icheck].",";
																  }
																  else
																  {
																  $valorcheck=$valorcheck."0".",";
																  }
																 
																 $icheck++;
																$rs_gogess1->MoveNext();
															}
															
																
															$sqlvalues=$sqlvalues.",".$fie_namesql."='".$valorcheck."'";
													  ////////////////////////////////////////////////			                 
										   }
										   break;
										 case "password":
										  {   
											   if (strlen($_POST_B[$fie_namesql])<24)
											   {
												   $textoformateado=md5($_POST_B[$fie_namesql]);
												   $sqlvalues=$sqlvalues.",".$fie_namesql."='".$textoformateado."'";				
											   }                 
										  }
										   break;
										 default:
											{
											   $textoformateado=textorraro($_POST_B[$fie_namesql]);
											   $sqlvalues=$sqlvalues.",".$fie_namesql."='".$textoformateado."'";							     
											}	 
										break;
								  }
					
						/////////////////////////////////////////////////////////////////////////////

					}
				   break;
				 }  
					 
		 //---2
		 } 
		 
		 
    
   //---1	
    $rs_update->MoveNext();
  }
  
 
		   $sql_1="update ".$table." set ".substr ("$sqlvalues",1)." where ".$ids;  
			

 $okinsertado=0; 
//echo $sql_1;
 $ok=$DB_gogess->executec($sql_1,array());
   if ($ok) 
    {      
	  $okinsertado=1;	
	}
	else
	{	
	   $okinsertado=0;	 
	} 
	
	
	unset($_POST_B);
   return $okinsertado;

}


function textorraro($texto) {
				  $s = trim($texto);
				  $s = str_replace("&","&amp;",trim($texto));
				  $s = str_replace("amp;amp;","amp;",trim($s));
				  $s = str_replace("'","\'",trim($s));
				  
				  
				  
				  return $s;
				 }	

function campo_gogess($table,$field,$DB_gogess)
{
  $selecTabla="select * from gogess_sisfield where gogess_sisfield.fie_name like '".$field."' and gogess_sisfield.tab_name like '".$table."' and fie_active=1";   
  $rs_gogessform = $DB_gogess->executec($selecTabla,array());
  
     	while (!$rs_gogessform->EOF) {
		      //de campo
		        $data_campo["field_type"]=$rs_gogessform->fields["field_type"];
				$data_campo["field_flags"]=$rs_gogessform->fields["field_flags"];
			  //de campo					
				$data_campo["tab_name"]=$rs_gogessform->fields["tab_name"];
				$data_campo["fie_name"]=$rs_gogessform->fields["fie_name"];
				//@$data_campo["tab_datosf"]=@$rs_gogessform->fields["tab_datosf"];				
				$data_campo["fie_title"]=$rs_gogessform->fields["fie_title"];
				$data_campo["fie_type"]=$rs_gogessform->fields["fie_type"];
				$data_campo["fie_typeweb"]=$rs_gogessform->fields["fie_typeweb"];
				$data_campo["fie_style"]=$rs_gogessform->fields["fie_style"];
				$data_campo["fie_value"]=$rs_gogessform->fields["fie_value"];
				$data_campo["fie_tabledb"]=$rs_gogessform->fields["fie_tabledb"];
				$data_campo["fie_datadb"]=$rs_gogessform->fields["fie_datadb"];
				$data_campo["fie_active"]=$rs_gogessform->fields["fie_active"];				
				$data_campo["fie_attrib"]=$rs_gogessform->fields["fie_attrib"];
				$data_campo["fie_activesearch"]=$rs_gogessform->fields["fie_activesearch"];
				$data_campo["fie_obl"]=$rs_gogessform->fields["fie_obl"];
				$data_campo["fie_sql"]=$rs_gogessform->fields["fie_sql"];
				$data_campo["fie_group"]=$rs_gogessform->fields["fie_group"];
				$data_campo["fie_sendvar"]=$rs_gogessform->fields["fie_sendvar"];
				$data_campo["fie_tactive"]=$rs_gogessform->fields["fie_tactive"];
				$data_campo["fie_lencampo"]=$rs_gogessform->fields["fie_lencampo"];
				$data_campo["fie_txtextra"]=$rs_gogessform->fields["fie_txtextra"];
				$data_campo["fie_valiextra"]=$rs_gogessform->fields["fie_valiextra"];
				$data_campo["fie_txtizq"]=$rs_gogessform->fields["fie_txtizq"];
				$data_campo["fie_lineas"]=$rs_gogessform->fields["fie_lineas"];
				$data_campo["fie_tabindex"]=$rs_gogessform->fields["fie_tabindex"];
				$data_campo["fie_activarprt"]=$rs_gogessform->fields["fie_activarprt"];
				$data_campo["fie_verificac"]=$rs_gogessform->fields["fie_verificac"];
				$data_campo["fie_tablac"]=$rs_gogessform->fields["fie_tablac"];
				$data_campo["fie_sqlorder"]=$rs_gogessform->fields["fie_sqlorder"];				
				$data_campo["fie_styleobj"]=$rs_gogessform->fields["fie_styleobj"];
				$data_campo["fie_naleatorio"]=$rs_gogessform->fields["fie_naleatorio"];
				$data_campo["fie_sqlconexiontabla"]=$rs_gogessform->fields["fie_sqlconexiontabla"];
				$data_campo["fie_activelista"]=$rs_gogessform->fields["fie_activelista"];
				$data_campo["fie_campoafecta"]=$rs_gogessform->fields["fie_campoafecta"];
				$data_campo["fie_camporecibe"]=$rs_gogessform->fields["fie_camporecibe"];
				$data_campo["fie_inactivoftabla"]=$rs_gogessform->fields["fie_inactivoftabla"];			
				$data_campo["fie_evitaambiguo"]=$rs_gogessform->fields["fie_evitaambiguo"];  
				$data_campo["field_maxcaracter"]=trim($rs_gogessform->fields["field_maxcaracter"]);
				$data_campo["existecampo"]=1;				
				$rs_gogessform->MoveNext();                            
			}   
  
  return $data_campo;
}	



?>