<?php
if (@$table)
{
 $objformulario->form_format_tabla($table,$DB_gogess); 
 
 if (@$objformulario->tab_datosf)
 {
      $opcion_val="opcion_".$table;
	  if (!(@$$opcion_val))
	  {
	    
		//**************************************************************
		$selecf="select * from ".$table." limit 1";		
		$resultadof = $DB_gogess->Execute($selecf);
		
		//$resultadof = mysql_query($selecf);
		if ($resultadof)
			{			   
			   $ncamposf = $resultadof->FieldCount();  
			   $if=0;
			 } 
		
		$if=0;	 
		while ($if < $ncamposf) 
         {
				$objformulario->fie_activesearch=0;
								
				$fld=$resultadof->FetchField($if);
	            $nombre_campof=strtolower($fld->name);
				
				$objformulario->campo_gogess($table,$nombre_campof,$DB_gogess);
				
				$flags = $objformulario->field_flags;
				
				
				$order = strstr ($flags, 'primary');
				
				if ($order)
				 {
				   if (!(@$ordername))
				   {
					 $ordernamef=$nombre_campof;
				   } 
				   if (!(@$ordt))
				   {
					  $ordtf="asc";
				   }
				
				 }
				$if++; 
		  } 	 
			 
		if (@$listab)
			{
			    if (@$obp=='num')
					{
					   $obp='=';
					}
				 else
					{
					   $obp='like';
					}
					
				 if ($obp=='=')
				   {
					$sqlf="select * from ".$table." where ".$campo." ".$obp." ".$listab." order by ".$ordernamef." ".$ordtf;					
				   }
				 else
				   {			    
					$sqlf="select * from ".$table." where ".$campo." ".$obp." '".$listab."' order by ".$ordernamef." ".$ordtf;					
				   }    
			}
			else
			{
			  $sqlf="select * from ".$table." order by ".$ordernamef." ".$ordtf;	
			}
		
		//**************************************************************
		
		
		 $resultadof = $DB_gogess->Execute($sqlf);
        if($resultadof)
		{
  		while (!$resultadof->EOF) {
		
			 
			  $csearch= $resultadof->fields[maymin($ordernamef)];			  
			  $resultadof->MoveNext();
			  
			}
		}
		$$opcion_val="buscar";
	  }
 
 }
}

?>