<?php
if(trim(@$this->fie_iconoarchivo))
{
  $iconografico="archivo/".$this->fie_iconoarchivo;
}
else
{
  $iconografico="libreria/campos/imgtxtarchivo/descarga.jpg";
}

if(trim(@$this->fie_archivo))
{
$archivover=' <a href="archivo/'.$this->fie_archivo.'" target="_blank" ><img src="'.$iconografico.'"  border="0"></a>';
}
else
{
$archivover='';
}

if (!($this->imprpt))
{
//no impresion

		  if (!($this->fie_tactive))
			{
				$this->fie_title="";
			}
		  if (!(@$this->contenid[$nombre_campo]==""))
           {						
              
			 $this->fie_styleobj='';	
			 echo '<div class="form-group" id="bloque_'.$nombre_campo.'" >';
			 echo'<div class="col-xs-5" align="right"><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
			 echo '<div class="col-xs-5">';
			 
			 if ($this->contenid[$nombre_campo])
			 {	
			   	 
			   printf("<input name='%s' class='%s' type='checkbox' id='%s' value='1' checked %s>",$nombre_campo,$this->fie_styleobj,$nombre_campo,@$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='%s' value='1' %s>",$nombre_campo,$this->fie_styleobj,$nombre_campo,@$tabindx);
			 }		 
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 
			 
			 			 
           }
		  else
           {
		    	
			 $this->fie_styleobj='';	
			 echo '<div class="form-group" id="bloque_'.$nombre_campo.'" >';
			 echo'<div class="col-xs-5" align="right"><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
			 echo '<div class="col-xs-5">';	 
			 if ($this->fie_value)
			 {			 
			   printf("<input name='%s' class='%s' type='checkbox' id='%s' value='1' checked %s>",$nombre_campo,$this->fie_styleobj,$nombre_campo,$tabindx);
			 }
			 else
			 {
			    printf("<input name='%s' class='%s' type='checkbox' id='%s' value='1' %s>",@$nombre_campo,@$this->fie_styleobj,$nombre_campo,@$tabindx);
			 }		 
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';
			 
			 
           }
//no impresion
}
else
{
//impresion


             $this->fie_styleobj='';	
			 echo '<div class="form-group" id="bloque_'.$nombre_campo.'" >';
			 echo'<div class="col-xs-5" align="right"><b>'.$this->fie_title.' '.$this->fie_txtizq.$this->txtobligatorio.'</b></div>';
			 echo '<div class="col-xs-5">';			 
			 echo '<input name="'.$nombre_campo.'"  id="'.$nombre_campo.'"  type="hidden" value="'.$this->contenid[$nombre_campo].'">';			 
			 if ($this->contenid[$nombre_campo])
			 {	
			    echo '<img src="images/check_on.png" width="12" height="12" />';
			 }
			 else
			 {
			    echo '<img src="images/check_off.png" width="12" height="12" />';
			 }		 
             echo '</div>';
			 echo '<div class="col-xs-1">';
			 echo '<div  id="'.$nombre_campo."_despliegue".'" ></div>';
			 echo '</div>'; 
			 echo '<div class="col-xs-1">';
			 echo $this->fie_txtextra;
			 echo '</div>';  
			 echo '</div>';



//impresion
}
?>