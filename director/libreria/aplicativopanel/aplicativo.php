<?php
//panel de manejo para aplicaciones

if ($apl)
{
	$sqlnom = "select * from gogess_aplicationadm where ap_id=$apl";	
	$rs_gogessapl = $DB_gogess->Execute($sqlnom);
	
	if ($rs_gogessapl)
	{	
	   while (!$rs_gogessapl->EOF) 
	    {		 	
 
		    $ap_path=$rs_gogessapl->fields["ap_path"];
			$ap_activo=$rs_gogessapl->fields["ap_activo"];
			$ap_protec=$rs_gogessapl->fields["ap_protec"];
			
			$rs_gogessapl->MoveNext();	  
		}

	}

	if (@$ap_activo==1)
    {
		if ($ap_protec==1)
			{
				if  ($sessid)
				  {
					 //saca parametros del imenu
					 $sacapar="select * from gogess_parametroimenu where ite_id=".$imenu;
					 $rs_sacapar = $DB_gogess->Execute($sacapar);
					 if($rs_sacapar)
					 {
					    while (!$rs_sacapar->EOF) 
	                     {
					       if($rs_sacapar->fields["paraim_tipo"]=='FIJA')
						   {
						   $nombrevar=$rs_sacapar->fields["paraim_nombre"];
						   $$nombrevar=$rs_sacapar->fields["paraim_valor"];
						   
						   }
						   
						 $rs_sacapar->MoveNext();	
						 }
					 }
					 //saca parametros del imenu
					 
					 include($ap_path."index.php");
				  }
				  else
				  { 
					 echo "<br><br><br><br><center><div class=titulo>Para ingresar a esta seccion debe estar registrado</div>";
					 printf("<a href='indexr.php?system=%s' target='_top'><img src=aqualisv3/logotipo/logoaqualis.png border=0><img src=aqualisv3/logotipo/cube.gif border=0></a></center><br><br><br><br>",$system);
				   } 

            }
		else
			{
					include($ap_path."index.php");
			}     

    }
   else
	{
	  include("msg/inactive.php");
	
	}

}
else
{
  include("msg/inactive.php");

}

?>