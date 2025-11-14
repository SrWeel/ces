<?php
$comillasimple="'";
if(trim(@$this->fie_archivo))
{
$archivover=' <a href="archivo/'.$this->fie_archivo.'" target="_blank" ><img src="libreria/campos/imgtxtarchivo/descarga.jpg" width="20" height="21" border="0"></a>';
}
else
{
$archivover='';
}

 if (!($this->imprpt))
	   {
	   //No impresión
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
       if (!(@$this->contenid[$nombre_campo]==""))
           {						
            		 
			
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value='.$comillasimple.$this->contenid[$nombre_campo].$comillasimple.'>';
			echo '<span>'.$this->fie_txtextra.$archivover.'</span>';
			
 
			 
           }
        else
          {
           
		    if ($this->fie_sendvar)				
             {          
			 
			
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value='.$comillasimple.@$this->sendvar["$this->fie_sendvar"].$comillasimple.'>';
			//echo '<span>'.$this->fie_txtextra.$archivover.'</span>';
			
			  

			  
             }
            else
             {
			
			  
			 
			echo '<input name="'.$nombre_campo.'" id="'.$nombre_campo.'" type="hidden" value='.$comillasimple.$this->fie_value.$comillasimple.'>';
			//echo '<span>'.$this->fie_txtextra.$archivover.'</span>';
			
			
			  
			
			  
			  
			  
             } 
			 
			 
			 
			    
          }
		  //Fin no impresión
		  }

?>