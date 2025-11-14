<?php
class paginardatos{


var $id_inicio;

function calculapag($sql,$inicio,$orden,$nregistros)
	{
	  if (!($inicio))
	  {
		$inicio=0;	
	  }
	  
					   $this->id_inicio=$inicio;
					   $this->desplegar=$nregistros;
	  
					   $datos=$sql." ".$orden."  limit ".$inicio.",".$nregistros;
					   $datoscompleto=$sql." ".$orden;
					   
					  
					   
					   $this->resultdatospg = mysql_query($datos);		
					   	   
					   $resultdatoscompleto = mysql_query($datoscompleto);
					   			   
					   $n_registros  = mysql_num_rows($resultdatoscompleto);			
									  
					   $this->totalreg=$n_registros;
					   $this->total_paginas = ceil($n_registros / $this->desplegar); 
					   
					   $this->paginaactual=($this->id_inicio/$this->desplegar)+1;
	  
	}

function paginaspg($linkss,$stilonum,$stilocuadro,$stiloactual,$stilotxt)
	{
	   
	        echo "<span class='".$stilotxt."'>PAGINAS: </span>";
			$iniciopag=0;
			echo '<div class='.$stilocuadro.'>';
			for($ipag=1;$ipag<=$this->total_paginas;$ipag++)
			{
				if($this->paginaactual==$ipag)
				{
				 echo '<span class="'.$stiloactual.'">'.$ipag.'</span> - ';
				}
				else
				{
				 echo '<a href="index.php?'.$linkss.'id_inicio='.$iniciopag.'" target="_top" class="'.$stilonum.'">'.$ipag.'</a> - ';
				}
			 $iniciopag=$iniciopag+$this->desplegar;
			}
			$id_iniciosig=$id_inicio+$this->desplegar;
			if($id_iniciosig<$this->totalreg)
			{
			echo '<a href="index.php?'.$linkss.'id_inicio='.$id_iniciosig.'" target="_top" class="'.$stilonum.'">->></a>';
			}
			echo '</div>';
			
	}
	
	
}

?>