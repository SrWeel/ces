<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
class menuweb{

	var $grupoactivo_menu;
	var $grupoactivo_submenu;
	var $menu_extra;
	var $submenu_extra;
	
	function encrypt($text) {
           
			return base64_encode($text);
   }

	
	function decrypt($encrypted_text){
	  
		$decrypted = base64_decode($encrypted_text);
		
		return $decrypted;
	}
	
	function sacaaleat()
	{
						$clave='';
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
		
		
		$despliega='';
		$despliega.='<ul class="nav navbar-nav navbar-right gp-primary-menu" >';
		
		if($this->grupoactivo_menu)
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and menp_uvic='".$posicion."' and itep_id in(".$this->grupoactivo_menu.") order by itep_order asc";
		}
		else
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and menp_uvic='".$posicion."' order by itep_order asc";
		}
		
		$resultadomenu = $DB_gogess->executec($despliegalista,array());
		if ($resultadomenu)
         {
			 while (!$resultadomenu->EOF) {	
			 
			 
			 if($resultadomenu->fields["itep_active"]==1)
					{
						
						if($resultadomenu->fields["itep_menu"]==0)
						{
		        //-----------------------MENU
				if ($resultadomenu->fields["itep_ltype"]==1)
				{
				// articulo
					$linksvar="secc=1&seccionp=".$resultadomenu->fields["secp_id"]."&ar=".$resultadomenu->fields["con_id"];	
					$linksvarencri=$this->variables_segura($linksvar);	
					
					$despliega.='<li><a href="index.php?snp='.$linksvarencri.'"  >'.$resultadomenu->fields["itep_titulo"].'</a></li>';	
				}
				
				if ($resultadomenu->fields["itep_ltype"]==2)
				{
				// aplicacion
					$linksvar="apl=".$resultadomenu->fields["ap_id"]."&secc=7&seccionp=".$resultadomenu->fields["secp_id"];	
					$linksvarencri=$this->variables_segura($linksvar);
					
					$despliega.='<li><a href="index.php?snp='.$linksvarencri.'"  >'.$resultadomenu->fields["itep_titulo"].'</a></li>';	
											
				}
				
				if ($resultadomenu->fields["itep_ltype"]==3)
				{
				// link externo
				  $despliega.='<li><a href="'.$resultadomenu->fields["itep_link"].'"  >'.$resultadomenu->fields["itep_titulo"].'</a></li>';
					
				}
				
				if ($resultadomenu->fields["itep_ltype"]==4)
				{
				// Inicio
				   $despliega.='<li ><a href="index.php" >'.$resultadomenu->fields["itep_titulo"].'</a></li>';
					
				}
				//------------------------MENU
						}
						else
						{
						//con sub menu-----------------------------	
							
		 $despliega.='<li><a href="#" >'.$resultadomenu->fields["itep_titulo"].'</a>';
       
        
		//Busca sub menu
		     $despliega.=$this->desplegar_submenu($resultadomenu->fields["itep_menu"],$DB_gogess);
        
  
    
         $despliega.='</li>';
							
							
						//con sub menu-----------------------------	
						}
				
					}
				
				
		 
		 
		 	   $resultadomenu->MoveNext();
			}
		
		 }
		
		if($this->menu_extra)
		{
		$despliega.=$this->menu_extra;
		}
		
		
		$despliega.='</ul>';
		echo $despliega;
	}
	
	function desplegar_submenu($idmenu,$DB_gogess)
	{
		$despliega='';
		$despliega.='<ul class="child-menu" >';
		
		if($this->grupoactivo_submenu)
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and gogess_pitemmenu.menp_id=".$idmenu." and itep_active=1 and itep_id in(".$this->grupoactivo_submenu.") order by itep_order asc";
		}
		else
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and gogess_pitemmenu.menp_id=".$idmenu." and itep_active=1 order by itep_order asc";
		}
		
		$resultadomenu = $DB_gogess->executec($despliegalista,array());
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
			 $buscagrafico="select * from gogess_contenido where con_id=".$resultadomenu->fields["con_id"];
			 $resultagab = $DB_gogess->executec($buscagrafico,array());
			 
			 //buscaimagendocumento
			 
			$despliega.='<li>
            
                
                <a href="'.$linkvalor.'">'.utf8_encode($resultadomenu->fields["itep_titulo"]).'</a>
        
         	
            
           </li>';
			 
			 
			 
			 $resultadomenu->MoveNext();
			 }
		 }
		
		if($this->submenu_extra)
		{
		$despliega.=$this->submenu_extra;
		}
		
		 $despliega.='</ul>';
		return $despliega;
		
	}
	
	
	//MOVIL-------------------------------------------
	
	function desplegar_menumovil($posicion,$DB_gogess)
	{
		$despliega='';
		$despliega.='<ul class="mobile_menu" >';
		
		if($this->grupoactivo_menu)
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and menp_uvic='".$posicion."' and itep_id in(".$this->grupoactivo_menu.") order by itep_order asc";
		}
		else
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and menp_uvic='".$posicion."' order by itep_order asc";
		}
		
		$resultadomenu = $DB_gogess->executec($despliegalista,array());
		if ($resultadomenu)
         {
			 while (!$resultadomenu->EOF) {	
			 
			 
			 if($resultadomenu->fields["itep_active"]==1)
					{
						
						if($resultadomenu->fields["itep_menu"]==0)
						{
		        //-----------------------MENU
				if ($resultadomenu->fields["itep_ltype"]==1)
				{
				// articulo
					$linksvar="secc=1&seccionp=".$resultadomenu->fields["secp_id"]."&ar=".$resultadomenu->fields["con_id"];	
					$linksvarencri=$this->variables_segura($linksvar);	
					
					$despliega.='<li><a href="index.php?snp='.$linksvarencri.'"  >'.$resultadomenu->fields["itep_titulo"].'</a></li>';	
				}
				
				if ($resultadomenu->fields["itep_ltype"]==2)
				{
				// aplicacion
					$linksvar="apl=".$resultadomenu->fields["ap_id"]."&secc=7&seccionp=".$resultadomenu->fields["secp_id"];	
					$linksvarencri=$this->variables_segura($linksvar);
					
					$despliega.='<li><a href="index.php?snp='.$linksvarencri.'"  >'.$resultadomenu->fields["itep_titulo"].'</a></li>';	
											
				}
				
				if ($resultadomenu->fields["itep_ltype"]==3)
				{
				// link externo
				  $despliega.='<li><a href="'.$resultadomenu->fields["itep_link"].'"  >'.$resultadomenu->fields["itep_titulo"].'</a></li>';
					
				}
				
				if ($resultadomenu->fields["itep_ltype"]==4)
				{
				// Inicio
				   $despliega.='<li ><a href="index.php" >'.$resultadomenu->fields["itep_titulo"].'</a></li>';
					
				}
				//------------------------MENU
						}
						else
						{
						//con sub menu-----------------------------	
							
		 $despliega.='<li class="menu-item-has-children"><a href="#" >'.$resultadomenu->fields["itep_titulo"].'</a>';
       
        
		//Busca sub menu
		     $despliega.=$this->desplegar_submenumovil($resultadomenu->fields["itep_menu"],$DB_gogess);
        
  
       
         $despliega.='</li>';
							
							
						//con sub menu-----------------------------	
						}
				
					}
				
				
		 
		 
		 	   $resultadomenu->MoveNext();
			}
		
		 }
		
		if($this->menu_extra)
		{
		$despliega.=$this->menu_extra;
		}
		
		$despliega.='</ul>';
		echo $despliega;
	}
	
	
	function desplegar_submenumovil($idmenu,$DB_gogess)
	{
		$despliega='';
		$despliega.='<ul class="sub-menu" >';
		
		if($this->grupoactivo_submenu)
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and gogess_pitemmenu.menp_id=".$idmenu." and itep_active=1 and itep_id in(".$this->grupoactivo_submenu.") order by itep_order asc";
		}
		else
		{
		$despliegalista="select * from gogess_pmenu,gogess_pitemmenu where gogess_pmenu.menp_id=gogess_pitemmenu.menp_id and menp_active=1 and gogess_pitemmenu.menp_id=".$idmenu." and itep_active=1 order by itep_order asc";
		}
		
		$resultadomenu = $DB_gogess->executec($despliegalista,array());
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
			 $buscagrafico="select * from gogess_contenido where con_id=".$resultadomenu->fields["con_id"];
			 $resultagab = $DB_gogess->executec($buscagrafico,array());
			 
			 //buscaimagendocumento
			 
			$despliega.='<li>
            
                
                <a href="'.$linkvalor.'">'.utf8_encode($resultadomenu->fields["itep_titulo"]).'</a>
        
         	
            
           </li>';
			 
			 
			 
			 $resultadomenu->MoveNext();
			 }
		 }
		
		if($this->submenu_extra)
		{
		$despliega.=$this->submenu_extra;
		}
		
		 $despliega.='</ul>';
		return $despliega;
		
	}
	
	
	
}

?>