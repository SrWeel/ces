<?php
$objformulario->fie_txtextra='';
if (!($objformulario->imprpt))
	   {
         //No impresión	  
	
		  if (!($objformulario->contenid[$nombre_campo]==""))
           {						
             
			 echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->contenid[$nombre_campo]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."'  >".$objformulario->fie_txtextra;
			 
           }
		  else
           {
         	if ($objformulario->fie_sendvar)				
             { 
			 echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->sendvar[$objformulario->fie_sendvar]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."'  >".$objformulario->fie_txtextra;
				 
              }
             else
              {
			    if ($objformulario->dedatos)
				{
			      echo $objformulario->fie_title." ".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$objformulario->contenid[$nombre_campo]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='".$objformulario->fie_lencampo."' >".$objformulario->fie_txtextra;				   
				}  
				else
				{
				
				////////////////////////////////////////////////////
				
				if ($typeSql=='int' or $typeSql=='real')
				{
                   
				   
				     echo '<tr>
			 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
			 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
			 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >';
			 
			 echo " Desde:".$objformulario->fie_txtizq."<input name='".$nombre_campo."' type='text' class='".$objformulario->fie_styleobj."'  value='".$_POST[$nombre_campo]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='7' >".$objformulario->fie_txtextra;		
				   
				   echo "Hasta:".$objformulario->fie_txtizq."<input name='".$nombre_campo."2' type='text' class='".$objformulario->fie_styleobj."'  value='".$_POST[$nombre_campo."2"]."' maxlength='".$len."' ".$objformulario->fie_attrib." size='7' >";	
			 
			 
			 echo $objformulario->fie_txtextra.'</td>			 
			 </tr>';
				   
				   
				   
				   	
				   	 if($_POST[$nombre_campo])
								 {
					$camposv=$camposv.$nombre_campo."=".$_POST[$nombre_campo]."&".$nombre_campo."2"."=".$_POST[$nombre_campo."2"]."&";
					}
						   				  
				 }
				 else
				 {
				   
				   
				   echo '<tr>
			 <td valign="top" class="'.$objformulario->fie_style.'">'.$objformulario->fie_title.'</td>
			 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
			 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >
			 <input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="text" class="'.$objformulario->fie_styleobj.'"  value="'.$_POST[$nombre_campo].'" maxlength="'.$len.'" '.str_replace("chr39","'",$objformulario->fie_attrib).' size="'.$objformulario->fie_lencampo.'" >
			 '.$objformulario->fie_txtextra.'</td>			 
			 </tr>';
				   	
				    if($_POST[$nombre_campo])
								 {
				    $camposv=$camposv.$nombre_campo."=".$_POST[$nombre_campo]."&";			
					}   				  
				 
				 } 
				///////////////////////////////////////////////////////
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
				printf("<b>%s</b>%s%s  %s",$objformulario->fie_title,$objformulario->fie_txtizq,$objformulario->contenid[$nombre_campo],$objformulario->fie_txtextra);		   
				
		 }
		 
		 }  
		   //Impresión
		   
		   
		   
		   }
?>