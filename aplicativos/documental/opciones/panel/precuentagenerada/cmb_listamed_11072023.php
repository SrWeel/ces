<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$centro_id=$_POST["centro_id"];
$b_data=trim($_POST["b_data"]);
$precu_id=trim($_POST["precu_id"]);

$lista_bprecuentac="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_bprecuentac = $DB_gogess->executec($lista_bprecuentac,array());
$clie_id=$rs_bprecuentac->fields["clie_id"];

$activodespacho=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_activodespacho"," where centro_id=",$centro_id,$DB_gogess);

if($centro_id==1)
{
  $centro_id=55;
}

if($activodespacho==1)
{
?>
<br>
Medicamento/Insumo: <select name="cuadrobmext_id " id="cuadrobmext_id"  class="form-control" >
<?php
echo '<option value="">---Seleccionar--</option>';

$lista_productos="select * from dns_cuadrobasicomedicamentos_vista where cuadrobm_principioactivo like '%".$b_data."%' order by  cuadrobm_principioactivo asc ";
$rs_bproductos = $DB_gogess->executec($lista_productos,array());
if($rs_bproductos)
 {
	while (!$rs_bproductos->EOF) { 
	
	$cuadrobm_id=$rs_bproductos->fields["cuadrobm_id"];
	
    $stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
	$rs_stactua = $DB_gogess->executec($stockactual);
	
	$maximo_permitido=$rs_stactua->fields["stactual"];
	
	if($rs_stactua->fields["stactual"]>0)
	{
	
	
	echo '<option value="'.$rs_bproductos->fields["cuadrobm_id"].'">'.$rs_bproductos->fields["cuadrobm_nombrecomercial"].'</option>';	

     }


     $rs_bproductos->MoveNext();	
	}	
} 	
  
?>  
</select>

Cantidad:<input name="n_cantidadext" type="text" id="n_cantidadext" size="10" value="" class="form-control" >
<input name="n_medicamntoext" type="hidden" id="n_medicamntoext" size="40" value="">
<input name="n_precioext" type="hidden" id="n_precioext" size="10" value="">
Observaci&oacute;n:<input name="n_obsext" type="text" id="n_obsext" size="40" value=""  class="form-control">
<br>
<input type="button" name="Submit" value="----&gt;" onClick="asgnar_detalleexterno()" >
<?php
}
else
{
   if($centro_id=='9999' or $centro_id=='8888')
   {
   ?><br>
   
   Tipo:<select name="detapre_tipox" id="detapre_tipox"  class="form-control" >
      <?php
	  echo '<option value="">---Seleccionar--</option>';
	  $objformulario->fill_cmb("dns_categoriadns","categ_id,categ_nombre",$detapre_tipox," order by categ_nombre asc ",$DB_gogess);			
	  ?>	  
    </select>   
   <input name="cuadrobmext_id" type="hidden" id="cuadrobmext_id" value="0">
   Nombre:<input name="n_medicamntoext" type="text" id="n_medicamntoext" size="40" value="" class="form-control">
   Cantidad:<input name="n_cantidadext" type="text" id="n_cantidadext" size="10" value="" class="form-control">
   Precio Unitario Compra:<input name="n_precioext" type="text" id="n_precioext" size="10" value="" class="form-control">
   Observaci&oacute;n:<input name="n_obsext" type="text" id="n_obsext" size="40" value=""  class="form-control" ><br>
   <input type="button" name="Submit" value="----&gt;" onClick="asgnar_detalleexternonobodega()" >
   <?php
   }
   else
   {
   echo "No activo para Despacho";
   }
}
?>

<div id="lista_asignadoext"></div>

<script type="text/javascript">
<!--

function asgnar_detalleexternonobodega()
{

 if($('#detapre_tipox').val()=='')
 {
   alert("Ingrese el tipo...");
   return false; 
 }
 
 if($('#n_cantidadext').val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }
 

 $("#lista_asignadoext").load("aplicativos/documental/opciones/panel/precuentagenerada/asignar_gext.php",{
      
	  precu_id:'<?php echo $precu_id; ?>',
	  clie_id:'<?php echo $clie_id; ?>',
	  atenc_id:'<?php echo $atenc_id; ?>',
	  cuadrobmext_id:$('#cuadrobmext_id').val(),
	  n_medicamntoext:$('#n_medicamntoext').val(),
	  n_cantidadext:$('#n_cantidadext').val(),
	  n_precioext:$('#n_precioext').val(),
	  n_obsext:$('#n_obsext').val(),
	  centrotx_id:$('#centrotx_id').val(),
	  detapre_tipox:$('#detapre_tipox').val()

  },function(result){  

desplegar_asignados();

  });  
  $("#lista_asignadoext").html("Espere un momento"); 

}


function asgnar_detalleexterno()
{


 if($('#n_cantidadext').val()=='')
 {
   alert("Ingrese la Cantidad...");
   return false;
 }
 

 $("#lista_asignadoext").load("aplicativos/documental/opciones/panel/precuentagenerada/asignar_gext.php",{
      
	  precu_id:'<?php echo $precu_id; ?>',
	  clie_id:'<?php echo $clie_id; ?>',
	  atenc_id:'<?php echo $atenc_id; ?>',
	  cuadrobmext_id:$('#cuadrobmext_id').val(),
	  n_medicamntoext:$('#n_medicamntoext').val(),
	  n_cantidadext:$('#n_cantidadext').val(),
	  n_precioext:$('#n_precioext').val(),
	  n_obsext:$('#n_obsext').val(),
	  centrotx_id:$('#centrotx_id').val()

  },function(result){  

desplegar_asignados();

  });  
  $("#lista_asignadoext").html("Espere un momento"); 

}

//  End -->
</script>
