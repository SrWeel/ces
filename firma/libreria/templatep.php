<?php
class templatep{
var $resultado;


function maymin($txt)
{
   return $txt;
}

function select_templatep($system,$apl,$ar,$DB_gogess)
{

  if ($system)
  {
	   if($apl)
	 {
	   $selecmenu1ap="select * from sibase_aplication where ap_id=".$apl;  
	   //echo $selecmenu1ap;
	   $resultado1ap = $DB_gogess->Execute($selecmenu1ap);
        if($resultado1ap)
		{
        while (!$resultado1ap->EOF) {				    
					
					$idtmp=$resultado1ap->fields[$this->maymin("temp_id")];					
					 $resultado1ap->MoveNext();
				}
		}		
				
	 }
	  
	  
	  if (!($idtmp))
	 {
	  
	  
	  
	  $selecmenu1="select * from sibase_ptemplate where temp_active=1 and sys_id = $system";
	  $resultado1 = $DB_gogess->Execute($selecmenu1); 
	  if($resultado1)
	  {
      while (!$resultado1->EOF) {

					$this->path_template=$resultado1->fields[$this->maymin("temp_path")];			
	                $this->temp_fondo=$resultado1->fields[$this->maymin("temp_fondo")];
					$resultado1->MoveNext();	
				} 
	  }		 
				
	   }
	   else
	   {
	     //////////////////////////////////
		  $selecmenu1="select * from sibase_ptemplate where temp_id=".$idtmp;  
		
		  $resultado1 = $DB_gogess->Execute($selecmenu1); 
		  
		   if($resultado1)
	      {
		     while (!$resultado1->EOF) {
					$this->path_template=$resultado1->fields[$this->maymin("temp_path")];	
					$this->temp_fondo=$resultado1->fields[$this->maymin("temp_fondo")];			
	
	                $resultado1->MoveNext();
				} 
		    }
		 //////////////////////////////////
	   
	   }	  
   }
  else
   {
         
			echo "<span class='inicioT'>Portal Inactivo...<br>Lista de portales a los que puede ingresar...</span>";
			
	  $selecmenu2="select * from sibase_sys,sibase_ptemplate where sibase_sys.sys_id=sibase_ptemplate.sys_id and temp_active=1"; 
	  
	   $resultado2 = $DB_gogess->Execute($selecmenu2); 
	 
	  
	  if ($resultado2)
	  {
	     echo "<ul>";
		 while (!$resultado2->EOF) {
	 
					$this->path_template=$resultado1->fields[$this->maymin("temp_path")];			
					echo '<li><a class="inicioT" href="index.php?system='.$resultado1->fields[$this->maymin("sys_id")].'" target="_top">'.$resultado1->fields[$this->maymin("sys_titulo")].'</a></li>';
	                 $resultado2->MoveNext();
				}
			echo "</ul>";	
		}	
		 			
			
   }
 
}

//Fecha
function fecha()
{  
  $mes = array (
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Septiembre",
                10 => "octubre",
                11 => "Noviembre",
                12 => "Diciembre"
   );
  printf ("%d de %s del %d",date("d"),$mes[date("n")],date("Y"));
}


}

?>