<?php
/**
 * Campos
 * 
 * Este archivo permite realizar los grid 
 * 
 * @author Ecohevea <franklin.aguas@hecoevea.com>
 * @version 1.0
 * @package grid_gogess
 */
class grid_plus_gogess{

     var $campos_visualizar;
	 var $campo_clave;
	 var $tipo_campo_clave;

	function leer_data($tabla,$filtro,$campofiltro,$tipocampof,$desplegar,$sqlbuscar,$DB_gogess)
	{
	
	 // echo $desplegar;
	   if($this->campos_visualizar)
	   {
	     
	    $listacampos="select * from gogess_sisfield where fie_activelista=1 and tab_name ='".$tabla."' and fie_name in(".$this->campos_visualizar.") order by fie_ordengrid asc";
	   }
	   else
	   {
	    $listacampos="select * from gogess_sisfield where fie_activelista=1 and tab_name ='".$tabla."' order by fie_ordengrid asc";
	   }
	   

	  
	   $rs_grt = $DB_gogess->Execute($listacampos);
			 if ($rs_grt)
			   {
			      while (!$rs_grt->EOF) {
				      
					  $this->arrcampos_nombre[]=$rs_grt->fields["fie_name"];	
					  $this->arrcampos_titulo[]=str_replace(":","",$rs_grt->fields["fie_title"]);
					  $this->arrcampos_tipo[]=$rs_grt->fields["field_type"];
					  				 
					 
				    
				     $rs_grt->MoveNext();	
				  }
			   
			   }
			//print_r($this->arrcampos_nombre);  
			   if(!($filtro))
		       {
			         ////////////////////////////////
					  if($sqlbuscar)
					  {
					  $datoscompleto="select * from ".$tabla." where ".$sqlbuscar;
					  }
					  else
					  {
					  
					   $datoscompleto="select * from ".$tabla;
					  }
					 //////////////////////////////////
				}
				else
				{
				     ////////////////////////////////
					  if($sqlbuscar)
					  {
					  $datoscompleto="select * from ".$tabla." where ".$filtro." and ".$sqlbuscar;
					   }
					   else
					   {
					   $datoscompleto="select * from ".$tabla." where ".$filtro;
					   }
					 //////////////////////////////////
				    
				}	 
					
					if($this->orden)
				{
				  $datoscompleto=$datoscompleto." ".$this->orden;
				}
				
	  
		
		      
		
	
	}
	
				 
	

}


?>