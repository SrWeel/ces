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

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$partop_id=$_POST["pVar1"];
$tabla=$_POST["pVar2"];
$centro_id=$_POST["pVar3"];
$usua_id=$_POST["pVar4"];
$clie_id=$_POST["pVar5"];
$maximop=$_POST["pVar6"];
$cuadrobm_id=$_POST["pVar7"];


echo $centro_id."<br>";

$tabla_busca='';

if($centro_id==55)
{
  $tabla_busca='dns_principalstockactual';
}
else
{
  $tabla_busca='dns_stockactual';

}



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
		
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$fecha_hoyz='';
$fecha_hoyz=date("Y-m-d");

$lista_precuentascant="select sum(detapre_cantidad) as detapre_cantidad from dns_preddetalleparteoperatorio inner join lpin_parteoperatorio on dns_preddetalleparteoperatorio.partop_id=lpin_parteoperatorio.partop_id where partop_estado=1 and detapre_fecharegistro like '".$fecha_hoyz."%' and centrob_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."'";
$rs_cantprecuenta= $DB_gogess->executec($lista_precuentascant,array());
$detapre_cantidad=0;
$detapre_cantidad=$rs_cantprecuenta->fields["detapre_cantidad"];

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		


$periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);
$nombre_centro='';
$nombre_centro=$objformulario->replace_cmb("dns_centrosalud_origen","centro_id,centro_nombre"," where centro_id=",$centro_id,$DB_gogess);

$busca_pedido="select * from ".$tabla." where partop_id='".$partop_id."'";
$rs_bupedido= $DB_gogess->executec($busca_pedido,array());

$select_bu="select cuadrobm_id from dns_cuadrobasicomedicamentos where cuadrobm_id ='".$cuadrobm_id."'";
$rs_bu= $DB_gogess->executec($select_bu,array());

$stockactual="select sum(stock_cantidad * stock_signo) as stactual from ".$tabla_busca." where centro_id='".$centro_id."' and cuadrobm_id=".$rs_bu->fields["cuadrobm_id"]." and stock_periodo='".$periodo_actual."'";
$rs_stactua = $DB_gogess->executec($stockactual);


$actual_saldo=0;
$actual_saldo=$rs_stactua->fields["stactual"]*1;

$actual_saldo=$actual_saldo - $detapre_cantidad;

if($actual_saldo<0)
{
  $actual_saldo=0;
}

echo "<b>Lugar que solicita: ".$nombre_centro."<br><br></b>";
echo "C&oacute;digo:".$rs_bupedido->fields["partop_id"]."<br>";
echo "Saldo actual: ".$actual_saldo;


if($actual_saldo>0)
{

echo "<br><b>".utf8_encode($rs_nproducto->fields[$ncampo_val]).' '.utf8_encode($concatena_nom)."</b>";
?>
<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px" align="center"><br /><br /> </div>
<input name="cantidada_ntre" type="hidden" id="cantidada_ntre" value="<?php echo $rs_bupedido->fields["plantra_cantidad"]; ?>" />
<input name="cantidada_totalselec" type="hidden" id="cantidada_totalselec" value="0" />
<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:17px" align="center"><b>Cantidad: <input name="cantidad_valor_data" type="number" id="cantidad_valor_data" value="0" size="10" ><span id="select_data"></span> </b></div>



<br>
<input name="concatenado_valor" type="hidden" id="concatenado_valor" value="">
<br>
<center><div id="id_inactivad"><input type="button" name="Submit" value="Pedir" onClick="entregar_datos()">
</div></center>

<div id="div_procesaentrega"></div>

<br>
<script type="text/javascript">
<!--



function entregar_datos()
{
  
  var pedido;
  var actual_saldo;
  
  actual_saldo=parseInt('<?php echo $actual_saldo; ?>');
  pedido=parseInt($('#cantidad_valor_data').val());
  
  
  if(pedido>0)
  {
  
     if(pedido>actual_saldo)
	 {
	 
	  alert('La cantidad debe ser menor o igual a lo disponible'); 
	  return false;
	 }
  
  }
  else
  {
     alert('Ingrese un valor en cantidad'); 
	  return false;
  
  }
  
  
  $("#div_procesaentrega").load("aplicativos/documental/opciones/panel/pedidoabodegav2/prepedido_medicamentos.php",{
		partop_id:'<?php echo $partop_id; ?>',
		tabla:'<?php echo $tabla; ?>',
		centro_id:'<?php echo $centro_id; ?>',
		usua_id:'<?php echo $usua_id; ?>',
		clie_id:'<?php echo $clie_id; ?>',
		fecha_desc:$('#fecha_desc').val(),
		cuadrobm_id:'<?php echo $cuadrobm_id; ?>',
		cantidad_valor:$('#cantidad_valor_data').val()
	  },function(result){  
	
	    desplegar_listainventario();
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

