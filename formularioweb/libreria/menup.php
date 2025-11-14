<?php
class menup{
var $resultado;
var $systemb;
var $sessid;

function display_menu($menu,$varsend,$system)
{
  $selecmenu1="select * from iba_pmenu where menp_id=$menu and sys_id = $system";  
  $resultado1 = mysql_query($selecmenu1);
  while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $titulo=$row1["menp_titulo"];			
                $stylot=$row1["menp_style"];			
                $activem=$row1["menp_active"];
				$tipom=	$row1["menp_type"];		

			}   
 
if ($activem==1)
{
	if ($tipom==1)
	{
//Horizontal
	$selecmenu="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=$menu and sys_id=$system order by itep_order asc";  
	$resultado = mysql_query($selecmenu);
	printf("<table border='0' cellspacing='0' cellpadding='1'><tr>");
  		while($row = mysql_fetch_array($resultado)) 
			{
              if ($row["itep_active"]==1)  
               { 
               if ($row["itep_icono"])
                 {

switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
             printf("<td class='%s' ><a %s href='%s' class='%s'><img src='%s' border=0>%s</a></td>",$row[itep_style],$row[itep_extra],$row[itep_link],$row[itep_style],$row[itep_icono],$row[itep_titulo]);			                            
         }
         break; 
     }

                 }
                 else
                 {

switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
                  printf("<td class='%s' ><a %s href='%s' class='%s'>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["itep_link"],$row["itep_style"],$row["itep_titulo"]);			                            
         }
         break; 
     }

                 }
                }
			}   
	printf("</tr></table>");
	}
  else
   {
//Vertical
	$selecmenu="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=$menu and sys_id=$system order by itep_order asc";  
	$resultado = mysql_query($selecmenu);
	printf("<table border='0' cellspacing='1' cellpadding='1'>");
    //printf("<tr><td  class='%s'><div align='center'>%s</div></td></tr>",$stylot,$titulo);
  		while($row = mysql_fetch_array($resultado)) 
			{
              if ($row["itep_active"]==1)  
               { 
          if ($row["itep_icono"])
                 {  
 

switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<tr><td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<tr><td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
             printf("<tr><td class='%s' ><a %s href='%s' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row[itep_style],$row[itep_extra],$row[itep_link],$row[itep_style],$row[itep_icono],$row[itep_titulo]);			                            
         }
         break; 
     }

                 }
                 else
                 {


switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<tr><td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<tr><td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
                  printf("<tr><td class='%s' ><a %s href='%s' class='%s'>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["itep_link"],$row["itep_style"],$row["itep_titulo"]);			                            
         }
         break; 
     }

                 }

                }
			}   
	printf("</tr></table>");


   }
}


}

function displayspd_menu($menu,$varsend,$system)
{
  $selecmenu1="select * from iba_pmenu where menp_id=$menu and sys_id = $system";  
  $resultado1 = mysql_query($selecmenu1);
  while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $titulo=$row1["menp_titulo"];			
                $stylot=$row1["menp_style"];			
                $activem=$row1["menp_active"];
				$tipom=	$row1["menp_type"];		

			}   
 
if ($activem==1)
{
	if ($tipom==1)
	{
//Horizontal
	$selecmenu="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=$menu and sys_id=$system order by itep_order asc";  
	$resultado = mysql_query($selecmenu);
	printf("<table border='0' cellspacing='0' cellpadding='1'><tr>");
  		while($row = mysql_fetch_array($resultado)) 
			{
              if ($row["itep_active"]==1)  
               { 
               if ($row["itep_icono"])
                 {

switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
             printf("<td class='%s' ><a %s href='%s' class='%s'><img src='%s' border=0>%s</a></td>",$row[itep_style],$row[itep_extra],$row[itep_link],$row[itep_style],$row[itep_icono],$row[itep_titulo]);			                            
         }
         break; 
     }

                 }
                 else
                 {

switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
                  printf("<td class='%s' ><a %s href='%s' class='%s'>%s</a></td>",$row["itep_style"],$row["itep_extra"],$row["itep_link"],$row["itep_style"],$row["itep_titulo"]);			                            
         }
         break; 
     }

                 }
                }
			}   
	printf("</tr></table>");
	}
  else
   {
//Vertical
	$selecmenu="select * from iba_pmenu,iba_pitemmenu where iba_pmenu.menp_id=iba_pitemmenu.menp_id and iba_pmenu.menp_id=$menu and sys_id=$system order by itep_order asc";  
	$resultado = mysql_query($selecmenu);
	printf("<table border='0' cellspacing='1' cellpadding='1'>");
    //printf("<tr><td  class='%s'><div align='center'>%s</div></td></tr>",$stylot,$titulo);
  		while($row = mysql_fetch_array($resultado)) 
			{
              if ($row["itep_active"]==1)  
               { 
          if ($row["itep_icono"])
                 {  
 

switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<tr><td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<tr><td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_icono"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
             printf("<tr><td class='%s' ><a %s href='%s' class='%s'><img src='%s' border=0>%s</a></td></tr>",$row[itep_style],$row[itep_extra],$row[itep_link],$row[itep_style],$row[itep_icono],$row[itep_titulo]);			                            
         }
         break; 
     }

                 }
                 else
                 {


switch ($row["itep_ltype"]) 
	{
     case 1://Articulo
         {
            printf("<tr><td class='%s' ><a %s href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 2://Aplicacion
         {
            printf("<tr><td class='%s' ><a %s href='index.php?apl=%s&secc=7&seccionp=%s&system=%s&sessid=%s' target='_top' class='%s'>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["ap_id"],$row["secp_id"],$this->systemb,$this->sessid,$row["itep_style"],$row["itep_titulo"]);			
         }
         break; 
     case 3://Link externo
         {
                  printf("<tr><td class='%s' ><a %s href='%s' class='%s'>%s</a></td></tr>",$row["itep_style"],$row["itep_extra"],$row["itep_link"],$row["itep_style"],$row["itep_titulo"]);			                            
         }
         break; 
     }

                 }

                }
			}   
	printf("</tr></table>");


   }
}

}

function display_menudsp($menu,$varsend,$system,$apl,$secc,$sessid)
{  
 $por='"';
 printf ("<script language='JavaScript'>\n<!-- \nfunction imenu(obj,op) {\nvar NS4 = (navigator.appName=='Netscape' && parseInt(navigator.appVersion)>=4);\n");
 printf ("var show_v=(NS4)?'show':'visible';\nvar hide_v=(NS4)?'hide':'hidden';\nvar layerObj=(NS4) ? 'document' : 'document.all';\n        var styleObj=(NS4) ? '' : '.style'; \n");

//*********************************************************************
  $selecmenu2="select * from iba_imenudesp,iba_pmenu,iba_contenido where iba_imenudesp.menp_id=iba_pmenu.menp_id and iba_imenudesp.dsp_id=$menu group by menp_titulo";  
  $resultado2 = mysql_query($selecmenu2);
  while($row2 = mysql_fetch_array($resultado2)) 
			{	                
	            printf("if(op==%s)\n {\n",$row2["menp_id"]);
                printf("contenido=%s",$por); 
                $contenido=$this->displayspd_menu($row2["menp_id"],$varsend,$system);
                printf("%s",$contenido);
                printf("%s",$por);
                printf("}\n");                
			}  
//*********************************************************************    
 printf("if (NS4) { \n eval(layerObj + '[%s' + obj + '%s]' + styleObj + '.document.open()');\n",$por,$por);
 printf("eval(layerObj + '[%s' + obj + '%s]' + styleObj + '.document.write(contenido)');\n",$por,$por);
 printf("eval(layerObj + '[%s' + obj + '%s]' + styleObj + '.document.close()'); \n",$por,$por);               
 printf("}\nelse \n{ \neval(layerObj + '[%s' + obj + '%s].innerHTML = contenido');   \n}\n}\n//-->\n</script> \n",$por,$por);
              	                
//*********************************************************************
  $selecmenu2="select * from iba_menudesp,iba_imenudesp,iba_pmenu,iba_contenido where iba_menudesp.dsp_id=iba_imenudesp.dsp_id and iba_imenudesp.menp_id=iba_pmenu.menp_id and iba_imenudesp.dsp_id=$menu group by menp_titulo order by idsp_orden";  

//echo $selecmenu2;

  $resultado2 = mysql_query($selecmenu2);
  while($row2 = mysql_fetch_array($resultado2)) 
			{	
		     if ($row2["dsp_active"])
               {
                if ($row2["idsp_active"])
               {
	                $idspid=$row2["idsp_id"];		
		            $menutitulo=$row2["menp_titulo"];
        	        $varsend="&system=".$system."&apl=".$apl."&secc=".$secc."&sessid=".$sessid; 
            	    printf("<a href='index.php?seccionp=%s%s'  class='%s' onMouseOver=imenu('fra1',%s)>%s</a><span class=menulk><br><br></span>",$row2["secp_id"],$varsend,$row2["menp_style"],$row2["menp_id"],$menutitulo);
                }   
              }  
			}  
//*********************************************************************               
}


}

?>
