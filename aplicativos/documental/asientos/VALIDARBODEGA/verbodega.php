<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$cuadrobm_id=375;
$centro_id='14';

$periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);


$select_bu="select cuadrobm_id from dns_cuadrobasicomedicamentos where cuadrobm_id ='".$cuadrobm_id."'";
$rs_bu= $DB_gogess->executec($select_bu,array());

$stockactual="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id=".$rs_bu->fields["cuadrobm_id"]." and stock_periodo='".$periodo_actual."'";
$rs_stactua = $DB_gogess->executec($stockactual);

echo "C&oacute;digo:".$rs_bupedido->fields["precu_id"]."<br>";
echo "Saldo actual: ".$rs_stactua->fields["stactual"]*1;

$actual_saldo=0;
$actual_saldo=$rs_stactua->fields["stactual"]*1;
$concatena_id='';
?>

<table width="200" border="1" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td bgcolor="#DBEAEE"><div align="center"><strong>Seleccionar</strong></div></td>
    <td bgcolor="#DBEAEE"><div align="center"><strong>Codigo</strong></div></td>
	<td bgcolor="#DBEAEE"><div align="center"><strong>Cantidad Disponible</strong></div></td>
    <td bgcolor="#DBEAEE"><div align="center"><strong>Lote</strong></div></td>
    <td bgcolor="#DBEAEE"><div align="center"><strong>Caducidad</strong></div></td>
    
    <td nowrap bgcolor="#DBEAEE"><div align="center"><strong>Cantidad a entregar </strong></div></td>
  </tr>
  <?php
 echo $busca_paraentrega="select * from dns_movimientoinventario where tipom_id=1 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."' and year(moviin_fecharegistro)>='".$periodo_actual."' and centro_id='".$centro_id."' order by 	moviin_fechadecaducidad asc";
  $rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {
	  
	  $moviin_redpublica=$rs_paraentrega->fields["moviinb_redpublica"];
	  
	  $lista_nproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."'";
	  $rs_nproducto = $DB_gogess->executec($lista_nproducto,array());
	  
	    $ncampo_val='cuadrobm_principioactivo';
		$nom1='';					
		if($rs_nproducto->fields["cuadrobm_nombredispositivo"])
		{
		   $nom1=$rs_nproducto->fields["cuadrobm_nombredispositivo"].' ';
		}
		
		$nom2='';					
		if($rs_nproducto->fields["cuadrobm_primerniveldesagregcion"])
		{
		   $nom2=$rs_nproducto->fields["cuadrobm_primerniveldesagregcion"].' ';
		}
		
		$nom3='';					
		if($rs_nproducto->fields["cuadrobm_presentacion"])
		{
		   $nom3=$rs_nproducto->fields["cuadrobm_presentacion"].' ';
		}
		 
		$nom4='';					
		if($rs_nproducto->fields["cuadrobm_concentracion"])
		{
		   $nom4=$rs_nproducto->fields["cuadrobm_concentracion"].' ';
		}
		
		$concatena_nom=$nom1.$nom2.$nom3.$nom4;
		
		
	  //envios pacientes
	 $busca_entregados="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and (entregamoviin_id='".$rs_paraentrega->fields["moviin_id"]."' or  entregamoviin_id='0') and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."'  and perioac_id='".$periodo_actual."' and moviincent_id=0";
	  $rs_entregados = $DB_gogess->executec($busca_entregados,array());
	  // envios pacientes
	  
	  //trasnferencias
	  
	  $busca_entregadost="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and entregamoviin_id='0' and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."' and perioac_id='".$periodo_actual."' and moviincent_id='".$rs_paraentrega->fields["moviin_id"]."'";
	  $rs_entregadost = $DB_gogess->executec($busca_entregadost,array());
	  
	  //trasferencias
	  
	  $actual_porlote=0;
	  $actual_porlote=$rs_paraentrega->fields["moviin_totalenunidadconsumo"]-$rs_entregados->fields["totalv"]-$rs_entregadost->fields["totalv"];
	 // $actual_porlote=0;
	 
	 
	  if($actual_porlote>0)
	  {
	  
	                  $boton_check=' <input name="checkbox_data[]" type="checkbox" id="checkbox_data" value="'.$rs_paraentrega->fields["moviin_id"].'" onClick="suma_valores()" > ';
					 
	                  if($moviin_redpublica==1 and $code_redp==1)
						{
						  
						   $boton_check=' <input name="checkbox_data[]" type="checkbox" id="checkbox_data" value="'.$rs_paraentrega->fields["moviin_id"].'" onClick="suma_valores()" > ';
						  
						}
						
						if($moviin_redpublica==1 and $code_redp==0)
						{
						  
						   $boton_check='';
						  
						}
						
						if($moviin_redpublica==0 and $code_redp==1)
						{
						  
						   $boton_check='';
						  
						}
						
						if($moviin_redpublica==0 and $code_redp==0)
						{
						  $boton_check=' <input name="checkbox_data[]" type="checkbox" id="checkbox_data" value="'.$rs_paraentrega->fields["moviin_id"].'" onClick="suma_valores()" > ';				
						}
						
						
	$concatena_id.=$rs_paraentrega->fields["moviin_id"].",";  
  ?>
  <tr>
    <td bgcolor="#F0FBFF">
      <div align="center">
	  <?php
	 // if($rs_paraentrega->fields["moviin_fechadecaducidad"]<=date("Y-m-d"))
	 // {
	 // echo '<div style="color:#FF0000" >Caducado</div>';
	//  }
	//  else
	 // {
	 
	 echo $boton_check;
	  ?>
	   
	  <?php
	//  }
	  ?>	
      </div></td>
    <td nowrap bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $rs_bupedido->fields["precu_id"]; ?>---<?php echo $rs_paraentrega->fields["moviin_id"]; ?>&nbsp;</div></td>
	 <td bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $actual_porlote; ?>&nbsp;
      <input name="cant_ac_<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" type="hidden" id="cant_ac_<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" value="<?php echo $actual_porlote; ?>">
    </div>
	
	<?php
	//echo $busca_entregados."<br>";
	
	//echo $busca_entregadost."<br>";
	
	?>
	</td>	
    <td nowrap bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $rs_paraentrega->fields["moviin_nlote"]; ?>&nbsp;</div></td>
	<!-- <td nowrap bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $rs_paraentrega->fields["moviin_preciocompra"]; ?>&nbsp;</div></td> -->
    <td nowrap bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $rs_paraentrega->fields["moviin_fechadecaducidad"]; ?>&nbsp;</div></td>
   
    <td bgcolor="#F0FBFF"><div align="center"><input name="cantidad_valor_<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" type="number" id="cantidad_valor_<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" value="0" size="10" onChange="suma_valores()" >
    </div></td>
  </tr>
  <?php
        }
       $rs_paraentrega->MoveNext();
      }
  }
  ?>
</table>
<?php

}

echo $concatena_id;
?>