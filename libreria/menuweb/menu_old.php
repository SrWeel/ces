<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
class menuweb{
	
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
							$clave .= round(rand(0, 9));
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


	function desplegar_menu($posicion,$DB_gogess)
	{
		
		$despliega.='<ul id="menu">';
		
		$despliegalista="select * from sysc_pmenu,sysc_pitemmenu where sysc_pmenu.menp_id=sysc_pitemmenu.menp_id and menp_active=1 and menp_uvic='".$posicion."'";
		$resultadomenu = $DB_gogess->Execute($despliegalista);
		if ($resultadomenu)
         {
			 while (!$resultadomenu->EOF) {	
			 
			 
			 if($resultadomenu->fields["itep_active"]==1)
					{
						
						if($resultadomenu->fields["itep_menu"]==-1)
						{
		        //-----------------------MENU
				if ($resultadomenu->fields["itep_ltype"]==1)
				{
				// articulo
					$linksvar="secc=1&seccionp=".$resultadomenu->fields["secp_id"]."&ar=".$resultadomenu->fields["con_id"];	
					$linksvarencri=$this->variables_segura($linksvar);	
					
					$despliega.='<li><a href="index.php?snp='.$linksvarencri.'" class="drop" >'.$resultadomenu->fields["itep_titulo"].'</a></li>';	
				}
				
				if ($resultadomenu->fields["itep_ltype"]==2)
				{
				// aplicacion
					$linksvar="apl=".$resultadomenu->fields["ap_id"]."&secc=7&seccionp=".$resultadomenu->fields["secp_id"];	
					$linksvarencri=$this->variables_segura($linksvar);
					
					$despliega.='<li><a href="index.php?snp='.$linksvarencri.'" class="drop" >'.$resultadomenu->fields["itep_titulo"].'</a></li>';	
											
				}
				
				if ($resultadomenu->fields["itep_ltype"]==3)
				{
				// link externo
				  $despliega.='<li><a href="'.$resultadomenu->fields["itep_link"].'" class="drop" >'.$resultadomenu->fields["itep_titulo"].'</a></li>';
					
				}
				
				if ($resultadomenu->fields["itep_ltype"]==4)
				{
				// Inicio
				   $despliega.='<li><a href="index.php" class="drop">'.$resultadomenu->fields["itep_titulo"].'</a></li>';
					
				}
				//------------------------MENU
						}
						else
						{
						//con sub menu-----------------------------	
							
		 $despliega.='<li><a href="#" class="drop">'.$resultadomenu->fields["itep_titulo"].'</a>';
       
        
		//Busca sub menu
		     $despliega.=$this->desplegar_submenu($resultadomenu->fields["itep_menu"],$DB_gogess);
        
  
    
         $despliega.='</li>';
							
							
						//con sub menu-----------------------------	
						}
				
					}
				
				
		 
		 
		 	   $resultadomenu->MoveNext();
			}
		
		 }
		
		$despliega.='</ul>';
		echo $despliega;
	}
	
	function desplegar_submenu($idmenu,$DB_gogess)
	{
		
		$despliega.=' <div class="dropdown_3columns">';
		
	$despliegalista="select * from sysc_pmenu,sysc_pitemmenu where sysc_pmenu.menp_id=sysc_pitemmenu.menp_id and menp_active=1 and sysc_pitemmenu.menp_id=".$idmenu;
			$resultadomenu = $DB_gogess->Execute($despliegalista);
		if ($resultadomenu)
         {
			 while (!$resultadomenu->EOF) {	
			 
			 
			 
			 if ($resultadomenu->fields["itep_ltype"]==1)
				{
				// articulo
					$linksvar="secc=1&seccionp=".$resultadomenu->fields["secp_id"]."&ar=".$resultadomenu->fields["con_id"];	
					$linksvarencri=$this->variables_segura($linksvar);	
					
					$linkvalor='index.php?snp='.$linksvarencri;	
				}
				
				if ($resultadomenu->fields["itep_ltype"]==2)
				{
				// aplicacion
					$linksvar="apl=".$resultadomenu->fields["ap_id"]."&secc=7&seccionp=".$resultadomenu->fields["secp_id"];	
					$linksvarencri=$this->variables_segura($linksvar);
					
					$linkvalor='index.php?snp='.$linksvarencri;
											
				}
				
				if ($resultadomenu->fields["itep_ltype"]==3)
				{
				// link externo
				  $linkvalor=$resultadomenu->fields["itep_link"];
					
				}
			 
			 
			 //buscaimagendocumento
			 $buscagrafico="select * from sysc_contenido where con_id=".$resultadomenu->fields["con_id"];
			 $resultagab = $DB_gogess->Execute($buscagrafico);
			 
			 //buscaimagendocumento
			 
			$despliega.='<div class="col_3"  >
            
                <a href="'.$linkvalor.'"><img src="archivo/'.$resultagab->fields["con_grafico"].'"  width="70" height="70" class="img_left imgshadow" alt="" border=0 /></a>
                <div  align="justify" style="font-family: Arial, Helvetica, sans-serif; font-size: 11px;" ><b><a href="'.$linkvalor.'">'.utf8_encode($resultadomenu->fields["itep_titulo"]).'</a></b>'.$resultadomenu->fields["itep_detalle"].' <a href="'.$linkvalor.'">Ver m&aacute;s...</a></div>
        
         	
            
            </div>';
			 
			 
			 
			 $resultadomenu->MoveNext();
			 }
		 }
		
		 $despliega.='</div>';
		return $despliega;
		
	}
	
}

?>