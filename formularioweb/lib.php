<?php

function genera_mapa($sala_id,$fecha_busca,$asite_id,$even_id,$DB_gogess)
{
 $genera_mapa='';
 
 $lista_st="select distinct asie_area from app_asientos where sala_id='".$sala_id."'";
		    $rs_st = $DB_gogess->executec($lista_st);
			if($rs_st)
			{
				while (!$rs_st->EOF) {	
		        //--------------------------------
			       $genera_mapa.="<br><center><b><span class='txt_letra' >".$rs_st->fields["asie_area"]."</span></b></center>";
				    
					$lista_let="select distinct letra_letra from app_asientos where asie_area='".$rs_st->fields["asie_area"]."'";
		            $rs_let = $DB_gogess->executec($lista_let);
					if($rs_let)
					{
					     while (!$rs_let->EOF) {
						 
						   //echo $rs_let->fields["letra_letra"]."<br>";
						   
						   $genera_mapa.='<table border="0" cellpadding="0" cellspacing="0" align="center" >
							  <tr>';
							  
								
								$lista_letnum="select letra_letra,asie_num,CONCAT(letra_letra,asie_num) as asiento from app_asientos where letra_letra='".$rs_let->fields["letra_letra"]."'  order by asie_num desc";
		                        $rs_letnum = $DB_gogess->executec($lista_letnum);
								if($rs_letnum)
								{
								      while (!$rs_letnum->EOF) {
									  
									    $lista_basi="select * from app_reservas where reserv_fecha='".$fecha_busca."' and even_id='".$even_id."' and reserv_asiento='".$rs_letnum->fields["asiento"]."'";
                                        $rs_basi = $DB_gogess->executec($lista_basi); 
										  
										if($rs_basi->fields["reserv_id"]>0)
										{
										
										if($asite_id==$rs_basi->fields["asite_id"])
										{
										
										$genera_mapa.='<td><center><span class="txt_letra" >'.$rs_letnum->fields["letra_letra"].$rs_letnum->fields["asie_num"].'</span><br><img src="sala/silla_onmios.png" width="20" height="20" /></center></td>'; 
										
										}
										else
										{
										$genera_mapa.='<td><center><span class="txt_letra" >'.$rs_letnum->fields["letra_letra"].$rs_letnum->fields["asie_num"].'</span><br><img src="sala/silla_on.png" width="20" height="20" /></center></td>'; 
										}
										
										
										}
										else
										{  
										$genera_mapa.='<td><center><span class="txt_letra" >'.$rs_letnum->fields["letra_letra"].$rs_letnum->fields["asie_num"].'</span><br><img src="sala/silla_off.png" width="20" height="20" /></center></td>'; 
										}
										
									    $rs_letnum->MoveNext();
									  }
								}
								
								
						   $genera_mapa.='</tr>
							</table>';
						 
						   $rs_let->MoveNext();
						 }					
					}
				   
				  
				  
				//--------------------------------  
			      $rs_st->MoveNext();
			   }
			}
			
  return $genera_mapa;
}
?>
