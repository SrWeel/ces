<?php
header('Content-Type: text/html; charset=UTF-8');
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
?>
 <style>
  .txt_letra{
  font-family:Verdana, Arial, Helvetica, sans-serif;
  font-size:11px;
  }
 </style>
<?php
  $sala_id=$_GET["sala_id"];
  //$sala_id=6;
  $fecha_busca=$_GET["fecha_busca"];
  //$fecha_busca='2020-09-08';
  $even_id=$_GET["even_id"];
  //$even_id=4;
  $reserv_id=$_GET["reserv_id"];
  
  $lista_reserva="select * from app_reservas where asite_id='".$reserv_id."' and reserv_fecha='".$fecha_busca."' and even_id='".$even_id."'";
	$rs_lreserva = $DB_gogess->executec($lista_reserva);
	
	if($rs_lreserva)
	{
		while (!$rs_lreserva->EOF) 
			{ 
			
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++    
			$lista_inv="select * from app_invitados where inv_id='".$rs_lreserva->fields["inv_id"]."'";
			$rs_linv = $DB_gogess->executec($lista_inv);
			if($rs_linv->fields["inv_nombre"])
			{
			  if($rs_linv->fields["inv_parentesco"])
			  {
				
				  
				  $codigo_valor=$rs_lreserva->fields["inv_id"]."-".$rs_lreserva->fields["reserv_asiento"]."-".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"];				 
				  
				  $lista_invidtados.="<b>Asiento:</b>".$rs_lreserva->fields["reserv_asiento"]."  <b>".$rs_linv->fields["inv_parentesco"].": </b>".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br>";
				  
				  //$lista_invidtados.='<br><img src="data:image/png;base64,'.$imageData.'"><br>';
				
			  }
			  else
			  {
				   
				
				  $codigo_valor=$rs_lreserva->fields["inv_id"]."-".$rs_lreserva->fields["reserv_asiento"]."-".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"];

				  $lista_invidtados.="<b>Asiento:</b>".$rs_lreserva->fields["reserv_asiento"]."  ".$rs_linv->fields["inv_nombre"]." ".$rs_linv->fields["inv_apellido"]."<br>";
				  
				  //$lista_invidtados.='<br><img src="data:image/png;base64,'.$imageData.'"><br>';
				
			  } 
			}
			//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
			
			 $rs_lreserva->MoveNext();
			}
	
	}	
	
  
  echo "<center>".$lista_invidtados."</center>";

		  if(@$sala_id>0)
		  {
		    $lista_st="select distinct asie_area from app_asientos where sala_id='".$sala_id."'";
		    $rs_st = $DB_gogess->executec($lista_st);
			if($rs_st)
			{
				while (!$rs_st->EOF) {	
		        //--------------------------------
			       echo "<br><center><b><span class='txt_letra' >".$rs_st->fields["asie_area"]."</span></b></center>";
				    
					$lista_let="select distinct letra_letra from app_asientos where asie_area='".$rs_st->fields["asie_area"]."' ";
		            $rs_let = $DB_gogess->executec($lista_let);
					if($rs_let)
					{
					     while (!$rs_let->EOF) {
						 
						   //echo $rs_let->fields["letra_letra"]."<br>";
						   
						   echo '<table border="0" cellpadding="0" cellspacing="0" align="center" >
							  <tr>';
							  
								
								$lista_letnum="select letra_letra,asie_num,CONCAT(letra_letra,asie_num) as asiento from app_asientos where letra_letra='".$rs_let->fields["letra_letra"]."' order by asie_num desc";
		                        $rs_letnum = $DB_gogess->executec($lista_letnum);
								if($rs_letnum)
								{
								      while (!$rs_letnum->EOF) {
									  
									    $lista_basi="select * from app_reservas where reserv_fecha='".$fecha_busca."' and even_id='".$even_id."' and reserv_asiento='".$rs_letnum->fields["asiento"]."'";
                                        $rs_basi = $DB_gogess->executec($lista_basi); 
										  
										if($rs_basi->fields["reserv_id"]>0)
										{
										
										if($reserv_id==$rs_basi->fields["asite_id"])
										{
										
										echo '<td><center><span class="txt_letra" >'.$rs_letnum->fields["letra_letra"].$rs_letnum->fields["asie_num"].'</span><br><img src="silla_onmios.png" width="20" height="20" /></center></td>'; 
										
										}
										else
										{
										echo '<td><center><span class="txt_letra" >'.$rs_letnum->fields["letra_letra"].$rs_letnum->fields["asie_num"].'</span><br><img src="silla_on.png" width="20" height="20" /></center></td>'; 
										}
										
										
										}
										else
										{  
										echo '<td><center><span class="txt_letra" >'.$rs_letnum->fields["letra_letra"].$rs_letnum->fields["asie_num"].'</span><br><img src="silla_off.png" width="20" height="20" /></center></td>'; 
										}
										
									    $rs_letnum->MoveNext();
									  }
								}
								
								
						   echo '</tr>
							</table>';
						 
						   $rs_let->MoveNext();
						 }					
					}
				   
				  
				  
				//--------------------------------  
			      $rs_st->MoveNext();
			   }
			}
			
			
		  }


?>