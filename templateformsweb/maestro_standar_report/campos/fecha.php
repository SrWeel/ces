<?php
			
				////////////////////////////////////////////////////
				
			
				   
				     echo '<tr  '.$color_fila.' >
			 <td valign="top" class="'.$objformulario->fie_style.'">'.utf8_decode($objformulario->fie_title).'</td>
			 <td valign="top" class="'.$objformulario->fie_style.'" >'.$objformulario->fie_txtizq.'</td>
			 <td valign="top" class="'.$objformulario->fie_style.'" nowrap="nowrap" >';
			 
			 echo " Desde:".@$objformulario->fie_txtizq."<input name='".@$nombre_campo."' id='".@$nombre_campo."' type='text' class='".@$objformulario->fie_styleobj."'  value='".@$_POST[$nombre_campo]."' maxlength='".@$len."' ".@$objformulario->fie_attrib." size='7' >".@$objformulario->fie_txtextra;		
				   
				   echo "Hasta:".@$objformulario->fie_txtizq."<input name='".@$nombre_campo."2' id='".@$nombre_campo."2' type='text' class='".@$objformulario->fie_styleobj."'  value='".@$_POST[$nombre_campo."2"]."' maxlength='".@$len."' ".@$objformulario->fie_attrib." size='7' >";	
			 
			 
			 echo '</td>			 
			 </tr>';	   
				   	
				   	 if(@$_POST[$nombre_campo])
								 {
					@$camposv=$camposv.$nombre_campo."=".$_POST[$nombre_campo]."&".$nombre_campo."2"."=".$_POST[$nombre_campo."2"]."&";
					}
					
						   				  
				
				
?>