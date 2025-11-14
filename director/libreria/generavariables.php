<?php	
class generavariables{

	function despliegavariables($llegapost,$llegaget)
	{
	  $sqlvari = "select * from gogess_variables where vari_activo=1";	
	  $resultvari = mysql_query($sqlvari); 
	  if ($resultvari)
	  {		 	
		   while($rowvari = mysql_fetch_array($resultvari))
			{
			
			$valorvar='';  
			if($llegapost[$rowvari["vari_nombre"]])
			{
			     $valorvar=$llegapost[$rowvari["vari_nombre"]];
			}
			else
			{
			   if($llegaget[$rowvari["vari_nombre"]])
			    {
				  $valorvar=$llegaget[$rowvari["vari_nombre"]];
			    }
			}
			
			
			echo '<input name="'.$rowvari["vari_nombre"].'" id="'.$rowvari["vari_nombre"].'" type="hidden" value="'.$valorvar.'" />';
			
			}
	   }	
	
	}
}

?>