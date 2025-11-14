<?php
class manejo_errores{


	function almacenar_error($apl,$table,$sessid,$mensaje,$extra1)
	{
	  $fechahoraactual=date("Y-m-d h:i:s");
	  if ($apl)
	  {
	   $identifi=$apl;
	  }
	  if ($table)
	  {
	   $identifi=$table;
	  }
	  $insertarsql="INSERT INTO gogess_error (err_id ,err_fecha ,err_identificador ,err_mensaje ,sess_id,err_extra1) VALUES (NULL , '".$fechahoraactual."', '".$identifi."', '".$mensaje."', '".$sessid."','".$extra1."');";  
	  $resultado = mysql_query($insertarsql);
	 
	}


}



?>