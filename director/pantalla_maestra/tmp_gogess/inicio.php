<table width="100%" border="0" cellpadding="0" cellspacing="12">
  <tr>
    <td>
<?php


  $selecTablaic="select * from gogess_iconomenuhome,gogess_itemmenu where gogess_iconomenuhome.ite_id=gogess_itemmenu.ite_id and iico_acitvo=1 and ite_active=1 order by iico_orden";    
 $rs_inicio = $DB_gogess->Execute($selecTablaic);
 
  $im=0;
  if ($rs_inicio)
  {
  while (!$rs_inicio->EOF) {	
			
			   
			   $ipermiso=strchr(@$imenuperfil,strval("-".$rs_inicio->fields[maymin("ite_id")]."-"));
					if (!($ipermiso))
					{
					  
					   /////////////////////////////////////////
					   if ($rs_inicio->fields[maymin("ite_link")])
						{	
						   /////////////////////////////////////
						   
						  if ($rs_inicio->fields[maymin("ite_link")]=="#")
								{
								 
								 $listamenu[$im]="<a ".$rs_inicio->fields[maymin("ite_extra")]." href='#' target='_top' class='".$rs_inicio->fields[maymin("ite_style")]."'><img src='".$objparametros->em_patharchivo.$rs_inicio->fields[maymin("iico_icono")]."'  border=0/></a>";		
								}
								else
								{
								
								$listamenu[$im]="<a ".$rs_inicio->fields[maymin("ite_extra")]." href='index.php?opcp=7&apl=".$rs_inicio->fields[maymin("ite_link")].$varsend."' target='_top' class='".$rs_inicio->fields[maymin("ite_style")]."'><img src='".$objparametros->em_patharchivo.$rs_inicio->fields[maymin("iico_icono")]."'  border=0/></a>";												  		
								
								} 
						   
						   
						   ///////////////////////////////////////				 
						}
						else
						{
							  if ($rs_inicio->fields[maymin("ite_tipd")]==1)
								   {											 
									 $listamenu[$im]="<a ".$rs_inicio->fields[maymin("ite_extra")]." href='index.php?table=".$rs_inicio->fields[maymin("ite_linktable")].@$varsend."' target='_top' class='".$rs_inicio->fields[maymin("ite_style")]."'><img src='".$objparametros->em_patharchivo.$rs_inicio->fields[maymin("iico_icono")]."'  border=0/></a>";			
									}
									else
									{
									  $listamenu[$im]="<a ".$rs_inicio->fields[maymin("ite_extra")]." href='index.php?tablelista=".$rs_inicio->fields[maymin("ite_linktable")].@$varsend."' target='_top' class='".$rs_inicio->fields[maymin("ite_style")]."'><img src='".$objparametros->em_patharchivo.$rs_inicio->fields[maymin("iico_icono")]."'  border=0/></a></li>";			
									}  
						
						
						}
					   
					   
					   ////////////////////////////////////////////
					   
					   
					   
					}
			   
			$im++;
			 $rs_inicio->MoveNext();
			
			}
  }
 
  $columnasico=$objformulario->replace_cmb("gogess_datosg","em_id,em_ncolumnasicono","where em_id =",1,$DB_gogess);
  

  
  $objtemplate->desplegarencuadros(@$listamenu,0,2,2,@$columnasico);
  
?></td>
  </tr>
</table>