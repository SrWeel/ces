<?php
 if (!($this->imprpt))
	   {
	   //No impresión
		if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		  if (!($this->contenid[$nombre_campo]==""))
           {						
             printf("<tr><td valign='top'><div  class='txtcampo'>%s</div></td><td></td><td></td><td valign='top'>",$this->fie_title);
			 $oFCKeditor = new FCKeditor($nombre_campo) ;			
			 $oFCKeditor->BasePath	= $this->ptaeditor ;   
			 $oFCKeditor->Value = $this->contenid[$nombre_campo];
             $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ; 
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;
			 printf(" %s</td></tr>",$this->fie_txtextra);	
           }
		  else
           {		
				if ($this->fie_sendvar)
                 {
					 printf("<tr><td valign='top'><div  class='txtcampo'>%s</div></td><td></td><td></td><td valign='top'>",$this->fie_title);
					 $oFCKeditor = new FCKeditor($nombre_campo) ;		
					 $oFCKeditor->BasePath	= $this->ptaeditor ;  	 
					 $oFCKeditor->Value = $this->sendvar["$this->fie_sendvar"];
					$oFCKeditor->Width  = $this->fie_lencampo ;
                    $oFCKeditor->Height = $this->fie_lineas ;  
					$oFCKeditor->tabindex=	$tabindx;	
					 $oFCKeditor->Create() ;
					 printf(" %s</td></tr>",$this->fie_txtextra);		 
                 }
                else
                  {
					 printf("<tr><td valign='top'><div  class='txtcampo'>%s</div></td><td></td><td></td><td valign='top'>",$this->fie_title);
					 $oFCKeditor = new FCKeditor($nombre_campo) ;		
					 $oFCKeditor->BasePath	= $this->ptaeditor ;  	 
					 $oFCKeditor->Value = '';
					 $oFCKeditor->Width  = $this->fie_lencampo ;
                     $oFCKeditor->Height = $this->fie_lineas ; 
					 $oFCKeditor->tabindex=	$tabindx;	
					 $oFCKeditor->Create() ;
					 printf(" %s</td></tr>",$this->fie_txtextra);
                  }
			 
           }        
		 }
		 //Fin no impresión
		 else
		 {
		 
		 if ($this->fie_activarprt)
		 {
		 //Formato impresión
		 if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
  		     printf("<tr><td valign='top'><div  class='txtextra'>%s</div></td><td></td><td></td><td valign='top' class='txtextra'>",$this->fie_title);
			 echo $this->contenid[$nombre_campo];
			 printf(" %s</td></tr>",$this->fie_txtextra);	
		 //Fin formato impresión
		 }
		 }
		      

?>