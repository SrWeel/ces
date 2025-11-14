<?php
			
				////////////////////////////////////////////////////
				
			
				   
				     echo '<tr>
			 <td valign="top" class="'.$objgridtablareporte->fie_style.'">'.utf8_decode($objgridtablareporte->campo_titulo).'</td>
			 <td valign="top" class="'.$objgridtablareporte->fie_style.'" >'.$objgridtablareporte->fie_txtizq.'</td>
			 <td valign="top" class="'.$objgridtablareporte->fie_style.'" nowrap="nowrap" >';
			 
			 echo " Desde:".$objgridtablareporte->fie_txtizq."<input name='".$nombre_campo."' id='".$nombre_campo."' type='text' class='".$objgridtablareporte->fie_styleobj."'  value='".$_POST[$nombre_campo]."' maxlength='".$len."' ".$objgridtablareporte->fie_attrib."   style='display:block; width:100px' >".$objgridtablareporte->fie_txtextra;		
				   
				   echo "Hasta:".$objgridtablareporte->fie_txtizq."<input name='".$nombre_campo."2'  id='".$nombre_campo."2' type='text' class='".$objgridtablareporte->fie_styleobj."'  value='".$_POST[$nombre_campo."2"]."' maxlength='".$len."' ".$objgridtablareporte->fie_attrib."  style='display:block; width:100px' >";	
			 
			 
			 echo '</td>			 
			 </tr>';	   
				   	
				   	 if($_POST[$nombre_campo])
								 {
					$camposv=$camposv.$nombre_campo."=".$_POST[$nombre_campo]."&".$nombre_campo."2"."=".$_POST[$nombre_campo."2"]."&";
					}
					
						   				  
				
				
?>