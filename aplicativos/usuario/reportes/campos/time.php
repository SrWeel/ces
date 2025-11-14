<?php

if (!($objformulario->imprpt))
	   {
         //No impresión	  
		if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
		  if (!($objformulario->contenid[$nombre_campo]==""))
           {				
		     echo $objformulario->fie_title.$objformulario->fie_txtizq.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$objformulario->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="7"  >'; 
			 echo  '<input type="reset" value=" ... " onclick= "return ';
			 echo  "showCalendar('".$nombre_campo."', '%H:%M', '24', true)";
			 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
		   	
        }
		  else
           {
         	if ($objformulario->fie_sendvar)				
             { 
                 echo $objformulario->fie_title.$objformulario->fie_txtizq.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$objformulario->sendvar[$objformulario->fie_sendvar].'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="7"  >'; 
				 echo  '<input type="reset" value=" ... " onclick= "return ';
				 echo  "showCalendar('".$nombre_campo."', '%H:%M', '24', true)";
				 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
					 	  
			  }
             else
              {
			    if ($objformulario->dedatos)
				{
				  // printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s > %s</td></tr>",$objformulario->fie_style,$objformulario->fie_title,$objformulario->fie_style,$objformulario->fie_txtizq,$nombre_campo,$objformulario->fie_styleobj,$objformulario->contenid[$nombre_campo],$len,$objformulario->fie_attrib,$objformulario->fie_lencampo,$tabindx,$objformulario->fie_txtextra);
                     echo $objformulario->fie_title.$objformulario->fie_txtizq.'<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$objformulario->contenid[$nombre_campo].'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="7"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."', '%H:%M', '24', true)";
					 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
				   
				}  
				else
				{
				  //printf("<tr><td valign='top'><div  class='%s'>%s</div></td><td></td><td><div  class='%s'> %s</div></td><td class='txtextra'><input name='%s' type='text' class='%s'  value='%s' maxlength='%s' %s size='%s' %s > %s</td></tr>",$objformulario->fie_style,$objformulario->fie_title,$objformulario->fie_style,$objformulario->fie_txtizq,$nombre_campo,$objformulario->fie_styleobj,$objformulario->fie_value,$len,$objformulario->fie_attrib,$objformulario->fie_lencampo,$tabindx,$objformulario->fie_txtextra);
                   
					 echo $objformulario->fie_title.$objformulario->fie_txtizq.' <br>Desde:<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$_POST[$nombre_campo].'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="7"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."', '%H:%M', '24', true)";
					 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
					 
					 
					 
					 	 echo ' Hasta:<input name="'.$nombre_campo.'2" id="'.$nombre_campo.'2" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$_POST[$nombre_campo."2"].'" maxlength="'.$len.'" '.$objformulario->fie_attrib.' size="7"  >'; 
					 echo  '<input type="reset" value=" ... " onclick= "return ';
					 echo  "showCalendar('".$nombre_campo."2', '%H:%M', '24', true)";
					 echo '"; class="'.$objformulario->fie_styleobj.'">'.$objformulario->fie_txtextra;
					 
					  if($_POST[$nombre_campo])
								 {
					 $camposv=$camposv.$nombre_campo."=".$_POST[$nombre_campo]."&".$nombre_campo."2"."=".$_POST[$nombre_campo."2"]."&";
					 }
				}
              }  
           }
           //Fin no impresión
		   }
		   else
		   {
		   //Impresión
		   		 if ($objformulario->fie_activarprt)
		 {
		   if (!($objformulario->fie_tactive))
        {
			$objformulario->fie_title="";
		}
		   
		   if ($objformulario->contenid[$nombre_campo]<>'')
		{
				printf("<tr><td valign='top'><div  class='%s'><b>%s</b></div></td><td> </td><td class='txtextra'>%s%s  %s</td></tr>",$objformulario->fie_styleobj,$objformulario->fie_title,$objformulario->fie_txtizq,$objformulario->contenid[$nombre_campo],$objformulario->fie_txtextra);		   
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>