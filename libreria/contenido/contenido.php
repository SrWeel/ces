<?php
/**
 * Contenido del portal
 * 
 * Este archivo permite mostrar el contenido del portal.
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package contenido_sistema
 */
class contenido_sistema{
	
	
	function encrypt($text) {
           
			return base64_encode($text);
   }
function decrypt($encrypted_text){
  
	$decrypted = base64_decode($encrypted_text);
	
	return $decrypted;
}

function sacaaleat()
{
                    $max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
					$chars = array();
					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
					$chars[] = "z";
					for ($i=0; $i<$max_chars; $i++) {
						@$clave .= round(rand(0, 9));
					}
                            
	 			   return  $clave; 
}
function variables_segura($linksvar)
{
     $valorext=$this->sacaaleat();
	 $valoresencriptados=$this->encrypt($linksvar);																						
	 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
     return $linksvarencri;
}

function despliega_contenido($idmen,$seccapl,$apl,$path_template,$secc,$variables_ext,$DB_gogess)
	{
		
		 			//if(@$_SESSION['ces1313777_sessid_inicio'])
							//{
						     //$objcontrolclv->verificar_cambio($_SESSION['ces1313777_sessid_inicio'],30,$DB_gogess);
							//@$objcontrolclv->estado_clave=1;
							//}
							//else
							//{
							
							//@$objcontrolclv->estado_clave=1;
							//}
					//if($objcontrolclv->estado_clave==1)		
					//{
						
						
					//}
		           if (!($secc))
					{
						include($path_template."inicio.php");
					}
					else
					{
						//--------------------------
						
						switch ($secc) 
							{
							 case 1:
								 {
								 //$objcontenido->select_articulo($ar);
								 //include($path_template."contenido.php");
								 }
								 break; 
							 case 7:
								{
						          //Aplicaciones
									if ($apl)
										{
											
											$sqlnom = "select * from gogess_aplication where ap_id=?";	
	                                        $resultnom = $DB_gogess->executec($sqlnom,array($apl));
											if($resultnom)
											{
											$ap_path=$resultnom->fields["ap_path"];
											$ap_activo=$resultnom->fields["ap_activo"];
											$ap_protec=$resultnom->fields["ap_protec"];
											}
											if ($ap_activo==1)
												{
													
													   if ($ap_protec==1)
														{ 
														
														   if  (@$_SESSION['ces1313777_sessid_inicio'])
															  {
																 include($ap_path."index.php");
																
															  }
															  else
															  { 
																 echo "<br><br><br><br><center><div class=titulo>Para ingresar a esta seccion debe estar registrado</div>";
																
															   }
														}
														else
														{
															include($ap_path."index.php");
														}
													
												}
												
										}
									else
										{
										  echo "Aplicativo inactivo...!!!";
										
										}	
						
								}   	
								 break; 	 
							}
						//---------------------------
						
					}
		
	}
	
}