<?php
//$lista_dias =array();
//$lista_dias = array_values(array_unique($semana_dia[$lista_semana[$ivalor]]));

$week = '';
$week = $lista_semana[$ivalor]-1;
for($isv=0; $isv<7; $isv++){
    $diai=$isv-1;
    $lista_dias_valor[$isv]=date('Y-m-d', strtotime('01/01 +' . $week . ' weeks first day +' . $diai . ' day'));
}

//print_r($lista_dias_valor);
?>
<div align="center">
<p></p>

<?php
$nombre_medico="select * from app_usuario where usua_id=".$_POST["usua_idvaltx"];
$rs_nmedico = $DB_gogess->executec($nombre_medico,array());
echo "<b>".utf8_encode($rs_nmedico->fields["usua_nombre"]." ".$rs_nmedico->fields["usua_apellido"])."</b>";
//especialidad
$nombre_espscialidad="select * from dns_especialidad where especi_id=".$_POST["areag"];
$rs_nespe = $DB_gogess->executec($nombre_espscialidad,array());

echo "<br><b>".utf8_encode($rs_nespe->fields["especi_nombre"])."</b>";
?>
<table width="900px" border="1" cellpadding="5" cellspacing="0" >
  <tr>
    <td style="padding-top:6px; padding-bottom:6px; padding-left:6px; padding-right:6px" >&nbsp;</td>
	<?php 
	
	for($i=0;$i<count($lista_dias_valor);$i++)
	{
	    //echo $lista_dias_valor[$i];
		$fechats ='';
		$fechats = strtotime($lista_dias_valor[$i]); 
		$dia_nombre='';
		switch (date('w', $fechats)){ 
			case 0: $dia_nombre="Domingo"; break; 
			case 1: $dia_nombre="Lunes"; break; 
			case 2: $dia_nombre="Martes"; break; 
			case 3: $dia_nombre="Miercoles"; break; 
			case 4: $dia_nombre="Jueves"; break; 
			case 5: $dia_nombre="Viernes"; break; 
			case 6: $dia_nombre="Sabado"; break; 
		} 
	    echo   "<td nowrap='nowrap' style='padding-top:6px; padding-bottom:6px; padding-left:6px; padding-right:6px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;font-weight:bold' ><b>".$dia_nombre."</b> (".$lista_dias_valor[$i].")</td>";
	}
	
	
	?>
  
  </tr>
  <?php
  $lista_horas="select * from app_horas order by 	hora_orden asc";	 
  $rs_lhoras = $DB_gogess->executec($lista_horas,array());
  if($rs_lhoras)
	       {
		       while (!$rs_lhoras->EOF) {
			   
			   $colorbg='';
			   if($rs_lhoras->fields["hora_nombre"]=='13:00')
			   {
			      $colorbg='bgcolor="#EAEAEA"';
			      
			   }
  ?>
  <tr <?php echo $colorbg; ?>  >
     <td style='padding-top:5px; padding-bottom:5px; padding-left:5px; padding-right:5px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold'   >
	       <?php  echo $rs_lhoras->fields["hora_nombre"]; ?>
	 </td> 
	       <?php
		      for($i=0;$i<count($lista_dias_valor);$i++)
	         {
			 
			 $lista_buscatc="select count(*) as total from  faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$_POST["usua_idvaltx"]." and terap_fecha='".$lista_dias_valor[$i]."' and terap_hora='".$rs_lhoras->fields["hora_tiempo"]."'";
			$rs_lbuscatc = $DB_gogess->executec($lista_buscatc,array());
			$colorbgtd='';
			if($rs_lbuscatc->fields["total"]>0)
			{
			   
			   $colorbgtd='bgcolor="#EFEFEF"';
			}
			 
			 echo "<td style='padding-top:5px; padding-bottom:5px; padding-left:5px; padding-right:5px;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;' ".$colorbgtd." >";
			 
			 if($rs_lhoras->fields["hora_tiempo"]=='13:00:00')
			 {
			    echo 'ALMUERZO';
			 
			 }
			 else
			 {
			       
				   //TERAPIA
					 $lista_buscat="select * from  faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where faesa_terapiasregistro.usua_id=".$_POST["usua_idvaltx"]." and terap_fecha='".$lista_dias_valor[$i]."' and terap_hora='".$rs_lhoras->fields["hora_tiempo"]."'";
					 
					 $rs_lbuscat = $DB_gogess->executec($lista_buscat,array());
					 if($rs_lbuscat)
					 {
						  while (!$rs_lbuscat->EOF) {
						  
						  $alerta='';
						  if($rs_lbuscat->fields["terap_nfactura"]=='')
						  {
						    $alerta='<img src="images/red.png" width="10" height="10" />';
						  }
						  
						   if($rs_lbuscat->fields["terap_autorizacion"]!='')
						  {
						    $alerta='<img src="images/autorizado.png" width="10" height="10" />';
						  }
						  
						  echo ucwords(strtolower(utf8_encode($rs_lbuscat->fields["clie_nombre"]." ".$rs_lbuscat->fields["clie_apellido"]))).$alerta;
						  
						  $rs_lbuscat->MoveNext();
						  }
					 
					 }
				   //eVALUACION INTEGRAL
				   $bandera=0;
				   $busca_citas="select tu.usua_id,integr_hora,faesa_asigahorario.clie_id,clie_nombre,clie_apellido,atenc_id from faesa_asigahorario inner join faesa_integragrupo tu on faesa_asigahorario.grup_id=tu.grup_id inner join app_cliente on faesa_asigahorario.clie_id=app_cliente.clie_id where tu.usua_id=".$_POST["usua_idvaltx"]." and asighor_fecha='".$lista_dias_valor[$i]."' and integr_hora='".$rs_lhoras->fields["hora_tiempo"]."'";	
				   
				    $rs_lbuscaci = $DB_gogess->executec($busca_citas,array());
					 if($rs_lbuscaci)
					 {
						  while (!$rs_lbuscaci->EOF) {
						  
						  //echo utf8_encode($rs_lbuscaci->fields["clie_nombre"]." ".$rs_lbuscaci->fields["clie_apellido"])."<br>";
						  $bandera=1;
						  
						  $rs_lbuscaci->MoveNext();
						  }
					 
					 }
				   
				   if($bandera)
				   {
				     echo '<b>EVALUACION INTEGRAL</b>';
				   
				   }
				   
				    
			 
			 }
			 
			 echo "</td>";
			 
			 }
		   
		   ?>
  </tr>
  <?php          
                $rs_lhoras->MoveNext();
                 }
		}		 
  
  ?>
</table>
</div>
