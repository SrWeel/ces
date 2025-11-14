<?php
class menu{
var $resultado;

function display_menu($menu,$varsend,$menuperfil,$imenuperfil)
{

 $permiso=strchr($menuperfil,strval("-".$menu."-"));
if (!($permiso))
{
  $selecmenu1="select * from iba_menu where men_id=$menu";  
  $resultado1 = mysql_query($selecmenu1);
  while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $titulo=$row1[men_titulo];			
                $stylot=$row1[men_style];			
                $activem=$row1[men_active];
				$tipom=	$row1[men_type];		

			}   
 
if ($activem==1)
{
	if ($tipom==1)
	{
//Horizontal
	$selecmenu="select * from iba_menu,iba_itemmenu where iba_menu.men_id=iba_itemmenu.men_id and iba_menu.men_id=$menu order by ite_order asc";  
	$resultado = mysql_query($selecmenu);
	$por="%";
	printf("<table border='0' cellspacing='0' cellpadding='1' width='100%s'><tr>",$por);
  		while($row = mysql_fetch_array($resultado)) 
			{
					$ipermiso=strchr($imenuperfil,strval("-".$row[ite_id]."-"));
					if (!($ipermiso))
					{
						  if ($row[ite_active]==1)  
						   { 
						   if ($row[ite_icono])
							 {

                                if ($row[ite_link])
                                  {
							   			printf("<td class='%s' ><a %s href='%s%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row[ite_style],$row[ite_extra],$row[ite_link],$varsend,$row[ite_style],$row[ite_icono],$row[ite_titulo]);			
								   }
                                else
                                    {
									  if ($row[ite_tipd]==1)
                                         {
							   			    printf("<td class='%s' ><a %s href='index.php?table=%s%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_icono],$row[ite_titulo]);			
										 }
										 else
										 {
										     printf("<td class='%s' ><a %s href='index.php?tablelista=%s%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_icono],$row[ite_titulo]);													 
										 }	
                                    }

							 }
							 else
							 {

										if ($row[ite_link])
										  {		
												printf("<td class='%s' ><a %s href='%s%s' target='_top' class='%s'>%s</a></td>",$row[ite_style],$row[ite_extra],$row[ite_link],$varsend,$row[ite_style],$row[ite_titulo]);			
										  }
                                        else
                                          {
										  
										     if ($row[ite_tipd]==1)
                                               {										  
												printf("<td class='%s' ><a %s href='index.php?table=%s%s' target='_top' class='%s'>%s</a></td>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_titulo]);			
												}
												else
												{
												printf("<td class='%s' ><a %s href='index.php?tablelista=%s%s' target='_top' class='%s'>%s</a></td>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_titulo]);			
												}
                                           }
							 }
							}
					}
			}   
	printf("</tr></table>");
	}
  else
   {
//Vertical
	$selecmenu="select * from iba_menu,iba_itemmenu where iba_menu.men_id=iba_itemmenu.men_id and iba_menu.men_id=$menu order by ite_order asc";  
	$resultado = mysql_query($selecmenu);
	printf("<table border='0' cellspacing='1' cellpadding='1' width='100%s'><tr>",$por);
    printf("<tr><td  class='%s'><div align='center'>%s</div></td></tr>",$stylot,$titulo);
  		while($row = mysql_fetch_array($resultado)) 
			{
					$ipermiso=strchr($imenuperfil,strval("-".$row[ite_id]."-"));
					if (!($ipermiso))
					{
						  if ($row[ite_active]==1)  
						   { 
						   if ($row[ite_icono])
							 {
									if ($row[ite_link])
										 {	
                                            printf("<tr><td class='%s' ><a %s href='index.php?opcp=%s%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row[ite_style],$row[ite_extra],$row[ite_link],$varsend,$row[ite_style],$row[ite_icono],$row[ite_titulo]);			
									     }
                                   else
 										 {	
										    if ($row[ite_tipd]==1)
                                               {		
                                                 printf("<tr><td class='%s' ><a %s href='index.php?table=%s%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_icono],$row[ite_titulo]);			
												}
												else
												{
												   printf("<tr><td class='%s' ><a %s href='index.php?tablelista=%s%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_icono],$row[ite_titulo]);			
												
												} 
									     }                                       
							 }
							 else
							 {

    									if ($row[ite_link])
										 {	
							                 printf("<tr><td class='%s' ><a %s href='index.php?opcp=%s%s' target='_top' class='%s'>%s</a></td></tr>",$row[ite_style],$row[ite_extra],$row[ite_link],$varsend,$row[ite_style],$row[ite_titulo]);			
									     }
										else
										 {	
										    if ($row[ite_tipd]==1)
                                               {											 
							                      printf("<tr><td class='%s' ><a %s href='index.php?table=%s%s' target='_top' class='%s'>%s</a></td></tr>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_titulo]);			
												}
												else
												{
												  printf("<tr><td class='%s' ><a %s href='index.php?tablelista=%s%s' target='_top' class='%s'>%s</a></td></tr>",$row[ite_style],$row[ite_extra],$row[ite_linktable],$varsend,$row[ite_style],$row[ite_titulo]);			
												}  
									     }
							 }
							}
					}
			}   
	printf("</tr></table>");


   }
}


}

}
//Despliegue de menus en la seccion

function menu_posicion($uvic,$varsend,$menuperfil,$imenuperfil)
{
  $sql = "SELECT * FROM iba_menu where men_uvic like '$uvic' order by men_ord";
  $result = mysql_query($sql);
  if ($result)
  {
  while($row = mysql_fetch_array($result))
	{
          $this->display_menu($row["men_id"],$varsend,$menuperfil,$imenuperfil);
		  //echo "<br>";
	}
  mysql_free_result ($result);
  }
}





}

?>
