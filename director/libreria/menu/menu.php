<?php
/**
 * Menu del administrador
 * 
 * Esta clase permite menu del administrador
 *
 * @author Ecohevea <franklin.aguas@gogess.com>
 * @version 1.0
 * @package menu
 */

class menu{
var $resultado;
var $submenuact;

function maymin($txt)
{
   return $txt;
}

function encrypt($text) {
           
           return base64_encode($text);
   }
   
function display_menu($menu,$varsend,$menuperfil,$imenuperfil,$table,$apl,$extra,$DB_gogess)
{

 $permiso=strchr($menuperfil,strval("-".$menu."-"));
if (!($permiso))
{
  $selecmenu1="select * from gogess_menu where men_id=$menu"; 
  
  $rs_menu = $DB_gogess->Execute($selecmenu1);  
  if($rs_menu)
  {
	  while (!$rs_menu->EOF) { 
					$titulo=$rs_menu->fields[$this->maymin("men_titulo")];			
					$stylot=$rs_menu->fields[$this->maymin("men_style")];			
					$activem=$rs_menu->fields[$this->maymin("men_active")];
						
				$rs_menu->MoveNext();	
				}   
   }
	if ($activem==1)
	{
	//Despliegue del menu
	
		$selecmenu="select * from gogess_menu,gogess_itemmenu where gogess_menu.men_id=gogess_itemmenu.men_id and gogess_menu.men_id=$menu order by ite_order asc";  
		 $rs_smenu = $DB_gogess->Execute($selecmenu);
		 
		
		printf("<ol id='%s'>",$stylot);
		while (!$rs_smenu->EOF) 
			   {
					 $ipermiso=strchr($imenuperfil,strval("-".$rs_smenu->fields["ite_id"]."-"));
						if (!($ipermiso))
						{
							  if ($rs_smenu->fields[$this->maymin("ite_active")]==1)  
							   { 
										if ($rs_smenu->fields[$this->maymin("ite_link")])
											 {	
											   if ($rs_smenu->fields[$this->maymin("ite_link")]=="#")
												{
												
												 printf("<li><a %s href='#' target='_top' class='%s' name='post' ><span>%s</span></a></li>",$rs_smenu->fields[$this->maymin("ite_extra")],$rs_smenu->fields[$this->maymin("ite_style")],$rs_smenu->fields[$this->maymin("ite_titulo")]);	
												 
												 
												 
												 		
												}
												else
												{
												
												//Para submenus
												
												if (@$rs_smenu->field[$this->maymin("ite_link")]=="##")
														{
														  
														   printf("<li><a %s href='index.php?smenu=%s%s' target='_top' class='%s' name='post' ><span>%s</span></a></li>",$rs_smenu->fields[$this->maymin("ite_extra")],$rs_smenu->fields[$this->maymin("ite_submenu")],$varsend,$rs_smenu->fields[$this->maymin("ite_style")],$rs_smenu->fields[$this->maymin("ite_titulo")]);			 
														   if ($rs_smenu->fields[$this->maymin("ite_submenu")]==$this->submenuact)
														   {
															// $this->display_submenu($rs_smenu->fields["ite_submenu"],$varsend,$menuperfil,$imenuperfil);
														   }
														}
														else
														{
														   if ($rs_smenu->fields[$this->maymin("ite_link")]==trim($apl))
															{
															  $currente='class="current"';
															}
															else
															{
															  $currente='';
															}			
															
														    $dataenc='';
														    $armaencrip="imenu=".$rs_smenu->fields["ite_id"]."&opcp=7&apl=".$rs_smenu->fields[$this->maymin("ite_link")];
															$dataenc=$this->encrypt($armaencrip);																					
															echo "<li ".$currente."><a ".$rs_smenu->fields[$this->maymin("ite_extra")]." href='index.php?mp=".$dataenc."' target='_top' class='".$rs_smenu->fields[$this->maymin("ite_style")]."' name='post' ><span>".$rs_smenu->fields[$this->maymin("ite_titulo")]."</span></a></li>";
																
														}
												
												
												//Fin submenus
												
												} 
											 }
											else
											 {	
											
												if ($rs_smenu->fields[$this->maymin("ite_linktable")]==trim($table))
															{
															  $currente='class="current"';
															}
															else
															{
															  $currente='';
															}			
												
												if ($rs_smenu->fields[$this->maymin("ite_tipd")]==1)
												   {											 
													  												  
													  		$dataenc='';
														    $armaencrip="valorlocal=".$rs_smenu->fields[$this->maymin("ite_linktable")];
															$dataenc=$this->encrypt($armaencrip);	
															echo "<li ".$currente."><a ".$rs_smenu->fields[$this->maymin("ite_extra")]." href='index.php?mp=".$dataenc."' target='_top' class='".$rs_smenu->fields[$this->maymin("ite_style")]."' name='post' ><span>".$rs_smenu->fields[$this->maymin("ite_titulo")]."</span></a></li>";
															
															
													}
													else
													{
													  printf("<li %s><a %s href='index.php?tablelista=%s%s' target='_top' class='%s' name='post'><span>%s</span></a></li>",$currente,$rs_smenu->fields[$this->maymin("ite_extra")],base64_encode($rs_smenu->fields[$this->maymin("ite_linktable")]),$varsend,$rs_smenu->fields[$this->maymin("ite_style")],$rs_smenu->fields[$this->maymin("ite_titulo")]);			
													}  
													
													
											 }
								 }								
						}
						
					 $rs_smenu->MoveNext();	
				}   
		printf("</ol>");
	
	  //Fin despliegue del menu
	
	}

 }

}




function menu_lista_array($menu,$menuperfil,$imenuperfil,$table,$apl,$extra,$DB_gogess)
{
  $li=0;
   $permiso=strchr($menuperfil,strval("-".$menu."-"));
   if (!($permiso))
   {
    
	      $selecmenu1="select * from gogess_menu where men_id=$menu";   
		  $rs_menu = $DB_gogess->Execute($selecmenu1);  
		  if($rs_menu)
		  {
			  while (!$rs_menu->EOF) { 
							$titulo=$rs_menu->fields[$this->maymin("men_titulo")];			
							$stylot=$rs_menu->fields[$this->maymin("men_style")];			
							$activem=$rs_menu->fields[$this->maymin("men_active")];
								
						$rs_menu->MoveNext();	
						}   
		   }
		   
		   if ($activem==1)
	       {
		      $selecmenu="select * from gogess_menu,gogess_itemmenu where gogess_menu.men_id=gogess_itemmenu.men_id and gogess_menu.men_id=".$menu." order by ite_order asc";  
		      $rs_smenu = $DB_gogess->Execute($selecmenu);
			  while (!$rs_smenu->EOF) 
			   {
			       //-------------------------------------------------
				   $ipermiso=strchr($imenuperfil,strval("-".$rs_smenu->fields["ite_id"]."-"));
				   if (!($ipermiso))
						{
						    if ($rs_smenu->fields[$this->maymin("ite_active")]==1)  
							   {
							      //aplicativo
								 
								  if(trim($rs_smenu->fields[$this->maymin("ite_link")]))
								  {
									  if ($rs_smenu->fields[$this->maymin("ite_link")]==trim($apl))
										{
										  $currente='class="current"';
										}
										else
										{
										  $currente='';
										}			
										
										$dataenc='';
										$armaencrip="imenu=".$rs_smenu->fields["ite_id"]."&opcp=7&apl=".$rs_smenu->fields[$this->maymin("ite_link")];
										$dataenc=$this->encrypt($armaencrip);																				
										
										$lista[$li]="<a ".$rs_smenu->fields[$this->maymin("ite_extra")]." href='index.php?mp=".$dataenc."' target='_top' class='".$rs_smenu->fields[$this->maymin("ite_style")]."' name='post' ><span>".$rs_smenu->fields[$this->maymin("ite_titulo")]."</span></a>";
										$li++;
										
								  }
								  //aplicativo
								  else
								  {
								  //tabla
								                if ($rs_smenu->fields[$this->maymin("ite_linktable")]==trim($table))
															{
															  $currente='class="current"';
															}
															else
															{
															  $currente='';
															}			
																							  
													  		$dataenc='';
														    $armaencrip="valorlocal=".$rs_smenu->fields[$this->maymin("ite_linktable")];
															$dataenc=$this->encrypt($armaencrip);	
															$lista[$li]="<a ".$rs_smenu->fields[$this->maymin("ite_extra")]." href='index.php?mp=".$dataenc."' target='_top' class='".$rs_smenu->fields[$this->maymin("ite_style")]."' name='post' ><span>".$rs_smenu->fields[$this->maymin("ite_titulo")]."</span></a>";
															$li++;
													 
								  
								  //tabla
								  }
							   
							   }						     
						
						}
				   //--------------------------------------------------
			      $rs_smenu->MoveNext();
			   }
		   
		   
		   }
		   
   
   }
 
  return $lista;
}


function menu_posicion($uvic,$varsend,$menuperfil,$imenuperfil,$table,$apl,$extra,$DB_gogess)
{
  $sql = "SELECT * FROM gogess_menu where men_uvic like '$uvic' order by men_ord";
  $rs_sql = $DB_gogess->Execute($sql);
  
  if ($rs_sql)
  {
  
  while (!$rs_sql->EOF) {
          $this->display_menu($rs_sql->fields[$this->maymin("men_id")],$varsend,$menuperfil,$imenuperfil,$table,$apl,$extra,$DB_gogess);
		  $rs_sql->MoveNext();
	}
  
  
  
  }
}





}

?>