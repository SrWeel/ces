<?php
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
      printf("<tr><td><div  class='txtcampo'>%s</div></td><td> </td><td><input name='%s' type='radio' value='%s' class='%s' %s %s></td></tr>",$this->fie_title,$nombre_campo,$this->fie_value,$this->fie_styleobj,$this->fie_attrib,$tabindx);
    
?>