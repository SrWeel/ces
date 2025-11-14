<?php

     
	  $icheck=0;
      if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td class='txtextra'>%s",$this->fie_style,$this->fie_title,$this->fie_txtizq);
	
			/////////////////////////////////////////
			   $valorfievalue=split(",",$this->contenid[$nombre_campo]);
				echo '<table border="0" cellspacing="0" cellpadding="0">'; 

				 $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;
				   $resulcheck = mysql_query($sqlchek);
				  if ($resulcheck)
				  {
				  $icheck=1;
				  while($rowcheck = mysql_fetch_array($resulcheck)) 
						{						  
						  if ($valorfievalue[$icheck-1])
						  {
						  echo "<tr> <td class=".$this->fie_style.">".$rowcheck[1]."</td> <td><input name='".$nombre_campo.$icheck."' class='".$this->fie_styleobj."' type='checkbox' id='checkbox' value='".$rowcheck[0]."' checked><br></td></tr>";
						  }
						  else
						  {
						  echo "<tr> <td class=".$this->fie_style.">".$rowcheck[1]."</td> <td><input name='".$nombre_campo.$icheck."' class='".$this->fie_styleobj."' type='checkbox' id='checkbox' value='".$rowcheck[0]."' ><br></td></tr>";
						  }
						  $icheck++;
						}
				  }	
				echo '</table>';
				/////////////////////////////////////////		
					
					
					 
			 printf("%s</td></tr>",$this->fie_txtextra);
			 			 
           }
		  else
           {
		     printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td class='txtextra'>%s",$this->fie_style,$this->fie_title,$this->fie_txtizq);
			
         	 if ($this->fie_value)
			 {			 
		   
			   /////////////////////////////////////////
			   $valorfievalue=split(",",$this->fie_value);
				echo '<table border="0" cellspacing="0" cellpadding="0">'; 

				 $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;
				   $resulcheck = mysql_query($sqlchek);
				  if ($resulcheck)
				  {
				  $icheck=1;
				  while($rowcheck = mysql_fetch_array($resulcheck)) 
						{						  
						  if ($valorfievalue[$icheck-1])
						  {
						  echo "<tr> <td class=".$this->fie_style.">".$rowcheck[1]."</td> <td><input name='".$nombre_campo.$icheck."' class='".$this->fie_styleobj."' type='checkbox' id='checkbox' value='".$rowcheck[0]."' checked><br></td></tr>";
						  }
						  else
						  {
						  echo "<tr> <td class=".$this->fie_style.">".$rowcheck[1]."</td> <td><input name='".$nombre_campo.$icheck."' class='".$this->fie_styleobj."' type='checkbox' id='checkbox' value='".$rowcheck[0]."' ><br></td></tr>";
						  }
						  $icheck++;
						}
				  }	
				echo '</table>';
				/////////////////////////////////////////
			   
			    
			   
			 }
			 else
			 {
			    
				/////////////////////////////////////////
				echo '<table border="0" cellspacing="0" cellpadding="0">'; 

				 $sqlchek="select distinct ".$this->fie_datadb." from ".$this->fie_tabledb." ".$this->fie_sqlorder;
				   $resulcheck = mysql_query($sqlchek);
				  if ($resulcheck)
				  {
				  $icheck=1;
				  while($rowcheck = mysql_fetch_array($resulcheck)) 
						{						  
						  echo "<tr> <td class=".$this->fie_style.">".$rowcheck[1]."</td> <td><input name='".$nombre_campo.$icheck."' class='".$this->fie_styleobj."' type='checkbox' id='checkbox' value='".$rowcheck[0]."' ><br></td></tr>";
						  $icheck++;
						}
				  }	
				echo '</table>';
				/////////////////////////////////////////
				
			 }
			 
			 printf("%s</td></tr>",$this->fie_txtextra);
           }

?>