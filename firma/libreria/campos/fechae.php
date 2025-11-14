<?php
				 //fecha actual 
			$dob=$this->contenid[$nombre_campo];
			
			$dia=date(j); 
			$mes=date(n); 
			$ano=date(Y); 
			
			//fecha de nacimiento 
			list($y,$m,$d)=explode("-",$dob);
			$dianaz=$d; 
			$mesnaz=$m; 
			$anonaz=$y; 
			
			//si el mes es el mismo pero el dia inferior aun no ha cumplido años, le quitaremos un año al actual 
			
			
			if (($mesnaz == $mes) && ($dianaz > $dia)) { 
			$ano=($ano-1); } 
			
			
			//si el mes es superior al actual tampoco abra cumplido años, por eso le quitamos un año al actual 
			
			if ($mesnaz > $mes) { 
			$ano=($ano-1);} 
			
			//ya no habria mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad 
			
			$edad=($ano-$anonaz); 
			
			if ($dob)
			{
			    $edadnac= $edad; 
			}
		
		   //*************************************
		   if (!($this->imprpt))
	        {		
			
			//No impresión  
		   if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {		
		  		
			
             printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td> <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script>  %s</td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->contenid[$nombre_campo],$this->fie_txtextra);
			 if($edadnac)
			 {
			   printf("<tr><td><div  class='%s'>Edad: </div></td><td> </td><td> </td><td>  %s </td></tr>",$this->fie_style,$edadnac);
			 }
			 
			 
           	   
		   }
		  else
           {
         	if ($this->fie_sendvar)				
             { 
                 printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td>  <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script>  %s</td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->sendvar[$this->fie_sendvar],$this->fie_txtextra);
				 
				 if($edadnac)
				 {
				 printf("<tr><td><div  class='%s'>Edad: </div></td><td> </td><td> </td><td>  %s </td></tr>",$this->fie_style,$edadnac);
				 }
              }
             else
              {
			    if ($this->fie_value)
			    {		
				  printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td>  <script>DateInput('%s', true, 'YYYY-MM-DD','%s')</script>  %s   </td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_value,$this->fie_txtextra);
				  if($edadnac)
				  {
				   printf("<tr><td><div  class='%s'>Edad: </div></td><td> </td><td> </td><td>  %s </td></tr>",$this->fie_style,$edadnac);
				  }
				}
				else
				{
				  printf("<tr><td><div  class='%s'>%s</div></td><td> </td><td> </td><td>  <script>DateInput('%s', true, 'YYYY-MM-DD')</script>  %s   </td></tr>",$this->fie_style,$this->fie_title,$nombre_campo,$this->fie_txtextra);
				  if($edadnac)
				 {
				  printf("<tr><td><div  class='%s'>Edad: </div></td><td> </td><td> </td><td>  %s </td></tr>",$this->fie_style,$edadnac);
				  }
				}
				
              }  
           }
		   
		   //Fin no impresión
		   
		   }
		   else
		   {
		   		 if ($this->fie_activarprt)
		 {
		   if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		   
		   		if ($this->contenid[$nombre_campo]<>'')
		{	
		   //Impresión
		    printf("<tr><td width='150'><div  class='%s'><b>%s</b></div></td><td> </td><td><div  class='%s'> %s  %s</div></td></tr>",$this->fie_style,$this->fie_title,$this->fie_style,$this->contenid[$nombre_campo],$this->fie_txtextra);
			if($edadnac)
			{
			 printf("<tr><td width='150'><div  class='%s'><b>Edad:</b> </div></td><td> </td><td><div  class='%s'>  %s </div></td></tr>",$this->fie_style,$this->fie_style,$edadnac);
		     }
		   //Fin Impresión
		   }
		   }
		   }
		   
		   //***********************************
?>