<?php
//campo oculto impresion con despliegue de datos
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
		else
		{
		
		   $this->fie_title="<label>".$this->fie_title.": </label>";
		}

if (!(@$this->contenid[$nombre_campo]==""))
           {
		         if ($this->fie_value=="replace")
				 {
				    $valorbus=$this->contenid[$nombre_campo];
			        $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  
				 }
				 else
				 {
				    $rmp=$this->contenid[$nombre_campo];
				 }
		   
				 echo $this->fie_title.'<span id="despliegue_'.$nombre_campo.'">'.$rmp.'</span>';
	  
				  
		   }
		 else
		 {
		      if ($this->fie_sendvar)				
              { 
		        //---------------------------------------------------------------------------------
		         if ($this->fie_value=="replace")
				 {
				    $valorbus=$this->sendvar[$this->fie_sendvar];
			        $rmp= $this->replace_cmb($this->fie_tabledb,$this->fie_datadb,$this->fie_sql,$valorbus,$DB_gogess);  
				 }
				 else
				 {
				    $rmp=$this->sendvar[$this->fie_sendvar];
				 }
		   
				 echo $this->fie_title.'<span id="despliegue_'.$nombre_campo.'">'.$rmp.'</span>';
	
		        //-----------------------------------------------------------------------------------
		      }
		 }  

?>