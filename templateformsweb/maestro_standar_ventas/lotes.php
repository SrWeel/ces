<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$precu_id=$_POST["pVar1"];
$tabla=$_POST["pVar2"];
$centro_id=$_POST["pVar3"];
$usua_id=$_POST["pVar4"];
$clie_id=$_POST["pVar5"];
$maximop=$_POST["pVar6"];
$cuadrobm_id=$_POST["pVar7"];


 $lista_nproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
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
		
		


$periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);

$busca_pedido="select * from ".$tabla." where precu_id='".$precu_id."'";
$rs_bupedido= $DB_gogess->executec($busca_pedido,array());

$select_bu="select cuadrobm_id from dns_cuadrobasicomedicamentos where cuadrobm_id ='".$cuadrobm_id."'";
$rs_bu= $DB_gogess->executec($select_bu,array());

$stockactual="select sum(stock_cantidad * stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id=".$rs_bu->fields["cuadrobm_id"]." and stock_periodo='".$periodo_actual."'";
$rs_stactua = $DB_gogess->executec($stockactual);

echo "C&oacute;digo:".$rs_bupedido->fields["precu_id"]."<br>";
echo "Saldo actual: ".$rs_stactua->fields["stactual"]*1;

$actual_saldo=0;
$actual_saldo=$rs_stactua->fields["stactual"]*1;

if($actual_saldo>0)
{

echo "<br><b>".utf8_encode($rs_nproducto->fields[$ncampo_val]).' '.utf8_encode($concatena_nom)."</b>";
?>
<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px" align="center">Entregar:  </div>
<input name="cantidada_ntre" type="hidden" id="cantidada_ntre" value="" />
<input name="cantidada_totalselec" type="hidden" id="cantidada_totalselec" value="0" />
<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px" align="center"><b>Seleccionado: <span id="select_data"></span> </b></div>
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
  $busca_paraentrega="select * from dns_movimientoinventario where tipom_id=1 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."' and year(moviin_fecharegistro)>='".$periodo_actual."' and centro_id='".$centro_id."' order by 	moviin_fechadecaducidad asc";
  $rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {	
	  
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
	 $busca_entregados="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and (entregamoviin_id='".$rs_paraentrega->fields["moviin_id"]."' or  entregamoviin_id='0') and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."' and centro_id='".$centro_id."' and perioac_id='".$periodo_actual."' and moviincent_id=0";
	  $rs_entregados = $DB_gogess->executec($busca_entregados,array());
	  // envios pacientes
	  
	  //trasnferencias
	  
	  $busca_entregadost="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and entregamoviin_id='0' and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$rs_bu->fields["cuadrobm_id"]."' and centro_id='".$centro_id."' and perioac_id='".$periodo_actual."' and moviincent_id='".$rs_paraentrega->fields["moviin_id"]."'";
	  $rs_entregadost = $DB_gogess->executec($busca_entregadost,array());
	  
	  //trasferencias
	  
	  $actual_porlote=0;
	  $actual_porlote=$rs_paraentrega->fields["moviin_totalenunidadconsumo"]-$rs_entregados->fields["totalv"]-$rs_entregadost->fields["totalv"];
	 // $actual_porlote=0;
	 
	 
	  if($actual_porlote>0)
	  {
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
	  ?>
	   <input name="checkbox_data[]" type="checkbox" id="checkbox_data" value="<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" onClick="suma_valores()" >
	  <?php
	//  }
	  ?>	
      </div></td>
    <td nowrap bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $rs_bupedido->fields["precu_id"]; ?>&nbsp;</div></td>
	 <td bgcolor="#F0FBFF"><div align="center">&nbsp;<?php echo $actual_porlote; ?>&nbsp;
      <input name="cant_ac_<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" type="hidden" id="cant_ac_<?php echo $rs_paraentrega->fields["moviin_id"]; ?>" value="<?php echo $actual_porlote; ?>">
    </div></td>	
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
<br>
<input name="concatenado_valor" type="hidden" id="concatenado_valor" value="">
<br>
<center><div id="id_inactivad"><input type="button" name="Submit" value="Entregar" onClick="seleccionado_valores()"></div></center>

<div id="div_procesaentrega"></div>

<br>
<script type="text/javascript">
<!--

function suma_valores()
{
    var entregar;
		
	var valor_sumado=0;
	
	$("input[name='checkbox_data[]']").each(function (index) {  
       if($(this).is(':checked')){
	      
		  actual_valor=parseInt($('#cantidad_valor_'+$(this).val()).val());
		  valor_sumado=valor_sumado+actual_valor;
		  
	   }
	 }); 
	 
	$('#select_data').html(valor_sumado); 
	$('#cantidada_totalselec').val(valor_sumado); 

}

function seleccionado_valores()
{
    var listaCompras = '';
	var actual_valor;
	var ingreso_valor
	var entregar;
	
	var t_aentregar;
	var total_selecio;
	
	t_aentregar=0;
	total_selecio=0;
	
	t_aentregar=parseInt($('#cantidada_ntre').val());
	total_selecio=parseInt($('#cantidada_totalselec').val());

	
    $("input[name='checkbox_data[]']").each(function (index) {  
       if($(this).is(':checked')){
	   
	     
		 actual_valor=parseInt($('#cant_ac_'+$(this).val()).val());
		 //alert(actual_valor);
	     ingreso_valor=parseInt($('#cantidad_valor_'+$(this).val()).val());
		 
	     if($('#cantidad_valor_'+$(this).val()).val()==0 || $('#cantidad_valor_'+$(this).val()).val()=='')
		 {
           alert('Ingrese un valor en cantidad'); 
		   listaCompras='';
		   return false;
		 }
		 else
		 {
		   if(ingreso_valor<=actual_valor)
		   {		   
		     listaCompras +=$(this).val()+'|'+$('#cantidad_valor_'+$(this).val()).val()+',';
		   }
		   else
		   {		   
		     alert('La cantidad debe ser menor o igual a lo disponible'); 
		     listaCompras='';
		     return false;
		   }
		  
		 }
		  
		  
       }
    });
	
	$('#concatenado_valor').val(listaCompras);
	
	if($('#concatenado_valor').val()=='')
	{
	  alert("Seleccione Una opcion");
	}
	else
	{
	  
	
		   entregar_datos($('#concatenado_valor').val());
		
	  
    }
}

function entregar_datos(datos_data)
{
  
  $("#div_procesaentrega").load("templateformsweb/maestro_standar_ventas/entregando_medicamentos.php",{
        datos_data:datos_data,
		precu_id:'<?php echo $precu_id; ?>',
		tabla:'<?php echo $tabla; ?>',
		centro_id:'<?php echo $centro_id; ?>',
		usua_id:'<?php echo $usua_id; ?>',
		clie_id:'<?php echo $clie_id; ?>',
		fecha_desc:$('#fecha_desc').val()
	  },function(result){  
	
	    // desplegar_listainventario();
		 grid_extras_10271('<?php echo $precu_id; ?>',0,4);
		 $('#divDialog_pdespacho').dialog( "close" );
		 
	  });  
  $("#id_inactivad").html("");		
  $("#div_procesaentrega").html("Espere un momento...");  

}


//  End -->
</script>


<?php
   }
   else
   {
     echo "<br><br><br><center><b>No hay disponibilidad...</b></center>";
   }

}
?>

