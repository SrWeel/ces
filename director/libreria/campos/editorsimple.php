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
	
			  if($this->fie_inactivoftabla)
			{
			 		 
			 $oFCKeditor = new FCKeditor($nombre_campo) ;			
			 $oFCKeditor->BasePath	= $this->ptaeditor ;   
			 $oFCKeditor->Value = $this->contenid[$nombre_campo];
             $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ;
			 $oFCKeditor->ToolbarSet='Basic';	 
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;		 
				
			 }
			 else
			 {
			  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >';			 
			 $oFCKeditor = new FCKeditor($nombre_campo) ;			
			 $oFCKeditor->BasePath	= $this->ptaeditor ;   
			 $oFCKeditor->Value = $this->contenid[$nombre_campo];
             $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ; 
			 $oFCKeditor->ToolbarSet='Basic';	
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;		 
			 echo $this->fie_txtextra.'</td>	
			 </tr>';
			 
			 
			 }
			 
           }
		  else
           {		
				if ($this->fie_sendvar)
                 {
			 	 
				   if($this->fie_inactivoftabla)
			{
						 
			 $oFCKeditor = new FCKeditor($nombre_campo) ;		
			 $oFCKeditor->BasePath	= $this->ptaeditor ;  	 
			 $oFCKeditor->Value = $this->sendvar["$this->fie_sendvar"];
			 $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ;
			 $oFCKeditor->ToolbarSet='Basic';	  
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;		 
				
				}
				else
				{
				
				 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >';			 
			 $oFCKeditor = new FCKeditor($nombre_campo) ;		
			 $oFCKeditor->BasePath	= $this->ptaeditor ;  	 
			 $oFCKeditor->Value = $this->sendvar["$this->fie_sendvar"];
			 $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ;  
			 $oFCKeditor->ToolbarSet='Basic';	
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;		 
			 echo $this->fie_txtextra.'</td>	
			 </tr>';
				
				
				}	 
					 
					 	 
                 }
                else
                  {
 
 	   if($this->fie_inactivoftabla)
			{
			  			 
			 $oFCKeditor = new FCKeditor($nombre_campo) ;		
			 $oFCKeditor->BasePath	= $this->ptaeditor ;  	 
			 $oFCKeditor->Value = '';
			 $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ; 
			 $oFCKeditor->ToolbarSet='Basic';	
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;		 
			
			}
			else
			{
			 echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >';			 
			 $oFCKeditor = new FCKeditor($nombre_campo) ;		
			 $oFCKeditor->BasePath	= $this->ptaeditor ;  	 
			 $oFCKeditor->Value = '';
			 $oFCKeditor->Width  = $this->fie_lencampo ;
             $oFCKeditor->Height = $this->fie_lineas ; 
			 $oFCKeditor->ToolbarSet='Basic';	
			 $oFCKeditor->tabindex=	$tabindx;	
			 $oFCKeditor->Create() ;		 
			 echo $this->fie_txtextra.'</td>
			</tr>';	
			
			
			}		 
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
			   if($this->fie_inactivoftabla)
			{
			 	 echo $this->contenid[$nombre_campo];
			 }
			 else
			 {
		 
			  echo '<tr>
			 <td valign="top" class="'.$this->fie_style.'">'.$this->fie_title.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >'.$this->fie_txtizq.'</td>
			 <td valign="top" class="'.$this->fie_style.'" >';			 
			 echo $this->contenid[$nombre_campo];		 
			 echo $this->fie_txtextra.'</td>
			 </tr>'; 
		 
			 }
			 
		 //Fin formato impresión
		 }
		 }
		      

?>