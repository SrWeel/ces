<?php
if (!($this->fie_tactive))
        {
			$this->fie_title="";
		}
if (!($this->imprpt))
	   {
	      //No impresion
	         echo '<div class="form-group">';
			 echo'<div class="col-xs-12" style="border-bottom: 1px solid #999999; height:´10px; color:#999999" >'.$this->fie_title.'</div>';
			 echo '</div>';
	   
	      //No impresion
	   }
	   else
	   {
	      //impresion
	        echo '<div class="form-group">';
			 echo'<div class="col-xs-12" style="border-bottom: 1px solid #999999; height:10px; color:#999999" >'.$this->fie_title.'</div>';
			 echo '</div>';
	   
	      //impresion
	   }
?>