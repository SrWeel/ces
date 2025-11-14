<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$subindice_formulario='div_formulariodet';

$compra_id=$_POST["compra_id"];
$insu_valorx=$_POST["insu_valorx"];
$centro_id=$_POST["centro_id"];

$sql1 = '';
$sql2 = '';
$sql3 = '';
$sql4 = '';
$sql5 = '';
$sql6 = '';
$sql7 = '';
$sql8 = '';
$sql9 = '';
$sql10 = '';
$sql11 = '';

if ($compra_id) {
				$sql1 = " compra_id='" . $compra_id . "' and ";
			}

			if ($centro_id) {
				$sql2 = " centro_id='" . $centro_id . "' and ";
			}

$concatena_valores = $sql1 . $sql2 . $sql3 . $sql4 . $sql5 . $sql6 . $sql7 . $sql8 . $sql9 . $sql10 . $sql11;
$concatena_valores = substr($concatena_valores, 0, -4);			
$campo='cuadrobm_principioactivo';
$orden=1;
if (@$campo != '') {
				if (@$orden == 1) {
					$ordena_registro = " order by " . @$campo . " asc ";
				}

				if (@$orden == 2) {
					$ordena_registro = " order by " . @$campo . " desc ";
				}
			}

$busca_cierre=$objformulario->replace_cmb("dns_compras","compra_id,compra_procesado"," where compra_id=",$compra_id,$DB_gogess);


?>

<table border="1" cellspacing="0" cellpadding="5">
  <tr>
   
    <th>Id</th>
    <th>Centro Salud</th>
    <th>Factura No</th>
    <th>Code ext</th>
    <th>Desc ext</th>
    <th>Medicamento/Dispositivo M&eacute;dico</th>
    <th>Movimiento</th>
    <th>Tipo movimiento</th>
    <th>No Lote</th>
    <th>Registro Sanitario</th>
    <th>Fecha de caducidad</th>
    <th>Fecha de Elaboraci&oacute;n</th>
    <th>Presentaci&oacute;n Comercial</th>
    <th>Nombre del Fabricante</th>
    <th>C&oacute;digo de Barras</th>
    <th>Red p&uacute;blica</th>
    <th>Laboratorio</th>
    <th>Unidad Almacena</th>
    <th>Cantidad</th>
    <th>Precio Unitario</th>
    <th>Total</th>
    <th>Unidad Consumo</th>
    <th>Observaci&oacute;n</th>
    <th colspan="5" bgcolor="#B9DBC8" >Prorrateo</th>
    <th>Total ingresado en unidad de consumo</th>
    <th>Precio unitario compra</th>
    <th>Verificado</th>
    <th>Fecha Registro </th>
  </tr>
  <?php
  $campobuscador='';
  $campo_fechas='';
  if ($concatena_valores) {
				@$lista_data = "select * from dns_temporalovimientoinventario left join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where " . $concatena_valores . " " . $ordena_registro;
			} else {
				@$lista_data = "select * from dns_temporalovimientoinventario left join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id  " . $ordena_registro . "";
			}
  //echo $lista_data;
  
			$rs_data = $DB_gogess->executec($lista_data, array());
			if ($rs_data) {
				while (!$rs_data->EOF) {
				
				$comulla_simple = "'";
					$tabla_valordata = "";
					$campo_valor = "";
					$tabla_valordata = "'dns_temporalovimientoinventario'";
					$campo_valor = "'moviin_id'";
					$ide_producto = 'moviin_id';
					$contador_un++;
  ?>
  <tr>
    <?php
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'moviin_id';
						echo $rs_data->fields[$ncampo_val];
						echo '</td>';
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'centro_id';
						//echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_data->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_data->fields[$ide_producto].'" value="'.$rs_data->fields[$ncampo_val].'" size="20" onchange="guardar_camposdispath('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_data->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_data->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" />';
$vcentro=$rs_data->fields[$ncampo_val];
if($rs_data->fields[$ncampo_val]==55)
{
  $vcentro=1;
}
						$centro_nombre = $objformulario->replace_cmb("dns_centrosalud", "centro_id,centro_nombre", "where centro_id=", $vcentro, $DB_gogess);

						echo wordwrap($centro_nombre, 10, "<br>");
						echo '</td>';						
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'compra_id';
		                $vdata ='';
						$vdata = $objformulario->replace_cmb("dns_compras", "compra_id,compra_nfactura,compra_ndocumento", "where compra_id=", $rs_data->fields[$ncampo_val], $DB_gogess);
						echo $vdata ;
						echo '</td>';
						
						echo '<td >';
						$ncampo_val = 'moviin_codeext';
						echo $rs_data->fields[$ncampo_val];
						echo '</td>';
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'moviin_descext';
						echo wordwrap($rs_data->fields[$ncampo_val],20, "<br>");
						
						echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="hidden" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  />';

						
						echo '</td>';						
						
						$ncampo_val = 'cuadrobm_id';
						echo '<td><select class="form-control" style="width:280px" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '"  onChange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')"  >
	<option value="" >--</option>';
						$objformulario->fill_cmb('dns_cuadrobasicomedicamentos', 'cuadrobm_id,cuadrobm_nombrecomercial,cuadrobm_principioactivo,cuadrobm_primerniveldesagregcion,cuadrobm_presentacion,cuadrobm_concentracion', $rs_data->fields[$ncampo_val], '', $DB_gogess);
						echo '</select></td>';
						
						$ncampovalr='cmb_moviin_descext'. $rs_data->fields[$ide_producto];
						
						$campobuscador.=" $('#cmb_".$ncampo_val . $rs_data->fields[$ide_producto]."').select2({
        dropdownParent: $('#divDialog_factura')
    });
						";
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'tipom_id';
		                $vdata ='';
						$vdata = $objformulario->replace_cmb("dns_tipomovimiento", "tipom_id,tipom_nombre", "where tipom_id=", $rs_data->fields[$ncampo_val], $DB_gogess);
						echo $vdata ;
						echo '</td>';
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'tipomov_id';
		                $vdata ='';
						$vdata = $objformulario->replace_cmb("dns_motivomovimiento", "tipomov_id,tipomov_nombre", "where tipomov_id=", $rs_data->fields[$ncampo_val], $DB_gogess);
						echo $vdata ;
						echo '</td>';
						
						//echo '<td onclick="buscar_productodata('.$comulla_simple.$ncampovalr.$comulla_simple .')" style="cursor:pointer"><img src="images/searchbu.png" width="20" height="18"></td>';

                        echo '<td>';
						$ncampo_val = 'moviin_nlote';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						echo '</td>';
						
						echo '<td>';
						$ncampo_val = 'moviin_rsanitario';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						echo '</td>';
						
						echo '<td>';
						$ncampo_val = 'moviin_fechadecaducidad';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						
						$campo_fechas.='
						 $( "#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" ).datepicker({dateFormat: "yy-mm-dd"}); 
						 ';						
						
						echo '</td>';
						
						echo '<td>';
						$ncampo_val = 'moviin_fechadeelaboracion';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						
						$campo_fechas.='
						 $( "#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" ).datepicker({dateFormat: "yy-mm-dd"}); 
						 ';
						
						
						echo '</td>';
						
						echo '<td>';
						$ncampo_val = 'moviin_presentacioncomercial';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						echo '</td>';
						
						echo '<td>';
						$ncampo_val = 'moviin_nombrefabricante';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						echo '</td>';
						
						echo '<td>';
						$ncampo_val = 'moviin_codigoproveedor';
						echo '<input class="form-control" style="width:140px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						echo '</td>';
						
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'moviin_redpublica';
		                $vdata ='';
						$vdata = $objformulario->replace_cmb("gogess_sino", "value,etiqueta", "where value=", $rs_data->fields[$ncampo_val], $DB_gogess);
						echo $vdata ;
						echo '</td>';
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'moviin_laboratorio';
		                $vdata ='';
						$vdata = $objformulario->replace_cmb("gogess_sino", "value,etiqueta", "where value=", $rs_data->fields[$ncampo_val], $DB_gogess);
						echo $vdata ;
						echo '</td>';
						
						echo '</td>';	
						$ncampo_val = 'unid_id';
						echo '<td><select class="form-control" style="width:90px" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '"  onChange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')"  >
	<option value="" >--</option>';
						$objformulario->fill_cmb('dns_unidad', 'unid_id,unid_nombre', $rs_data->fields[$ncampo_val], '', $DB_gogess);
						echo '</select></td>';							
						
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'centrorecibe_cantidad';
						echo $rs_data->fields[$ncampo_val];						
						echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="hidden" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  />';
						echo '</td>';
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'moviin_preciocontable';
						echo $rs_data->fields[$ncampo_val];						
						echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="hidden" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  />';
						echo '</td>';
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'moviin_total';
						echo $rs_data->fields[$ncampo_val];						
						echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="hidden" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  />';
						echo '</td>';
						
						echo '</td>';	
						$ncampo_val = 'uniddesg_id';
						echo '<td><select class="form-control" style="width:90px" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '"  onChange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')"  >
	<option value="" >--</option>';
						$objformulario->fill_cmb('dns_unidad', 'unid_id,unid_nombre', $rs_data->fields[$ncampo_val], '', $DB_gogess);
						echo '</select></td>';					
						
						
						echo '<td  nowrap="nowrap" >';
						$ncampo_val = 'centrorecibe_observacion';
						echo '<textarea name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" cols="25" rows="2" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" >' . $rs_data->fields[$ncampo_val] . '</textarea>';
                        echo '</td>';		
						
						

        $unidad1='';
		$unidad1 = $objformulario->replace_cmb("dns_unidad", "unid_id,unid_nombre", "where unid_id=", $rs_data->fields["unid_id"], $DB_gogess);
		$unidad2 ='';
		$unidad2 = $objformulario->replace_cmb("dns_unidad", "unid_id,unid_nombre", "where unid_id=", $rs_data->fields["uniddesg_id"], $DB_gogess);
		?>     
           <td  nowrap="nowrap" bgcolor="#B9DBC8"  >En cada : </td>
           <td  nowrap="nowrap" bgcolor="#B9DBC8"  ><b><div id="medida_unidad<?php echo $rs_data->fields[$ide_producto]; ?>"><?php echo $unidad1; ?></div></b></td>
           <td  nowrap="nowrap" bgcolor="#B9DBC8"  Existe: </td>
           <td  nowrap="nowrap" bgcolor="#B9DBC8"  ><?php
						$ncampo_val = 'moviin_cantidadunidadconsumo';
						echo '<input class="form-control" style="width:70px" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '" size="20" onchange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')" />';
						 
	   ?></td>
           <td  nowrap="nowrap" bgcolor="#B9DBC8" ><b><div id="medida_descargo<?php echo $rs_data->fields[$ide_producto]; ?>"><?php echo $unidad2; ?></div></b><div id="r_calculo_alerta<?php echo $rs_data->fields[$ide_producto]; ?>"></div></td>
     
        
   <?php   
    echo '<td  nowrap="nowrap" >';
	$ncampo_val = 'moviin_totalenunidadconsumo';		
	echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  readonly="readonly" />';
	echo '</td>';   
	
	echo '<td  nowrap="nowrap" >';
	$ncampo_val = 'moviin_preciocompra';				
	echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="text" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  readonly="readonly" />';
	echo '</td>';  
	

	echo '</td>';	
	$ncampo_val = 'moviin_verificado';
	echo '<td><select class="form-control" style="width:90px" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '"  onChange="guardar_camposdispath(' . $tabla_valordata . ',' . $comulla_simple . $ncampo_val . $comulla_simple . ',' . $rs_data->fields[$ide_producto] . ',$(' . $comulla_simple . '#cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . $comulla_simple . ').val(),' . $comulla_simple . $ide_producto . $comulla_simple . ')"  >
    <option value="" >--</option>';
	$objformulario->fill_cmb('gogess_sino', 'value,etiqueta', $rs_data->fields[$ncampo_val], '', $DB_gogess);
	echo '</select></td>';				
	
	
	echo '<td  nowrap="nowrap" >';
	$ncampo_val = 'moviin_fecharegistro';
	echo $rs_data->fields[$ncampo_val];						
	//echo '<input class="form-control" name="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" type="hidden" id="cmb_' . $ncampo_val . $rs_data->fields[$ide_producto] . '" value="' . $rs_data->fields[$ncampo_val] . '"  />';
	echo '</td>';					
   ?>
   
  
  </tr>
  <?php
  $rs_data->MoveNext();
				}
			}
  
  ?>
</table>

<script type="text/javascript">
<!--
<?php

echo $campobuscador;

echo $campo_fechas;

?>


function guardar_camposdispath(tabla, campo, id, valor, campoidtabla) {

		$("#campo_valordis").load("movimiento_compras/guarda_campodispath.php", {

			tabla: tabla,
			campo: campo,
			id: id,
			valor: valor,
			campoidtabla: campoidtabla

		}, function(result) {
			   colocar_medidasdata(id);
			   if(campo=='moviin_cantidadunidadconsumo')
			   {
                 calcula_datadata(id);


                }
		});

		$("#campo_valordis").html("Espere un momento...");



	}


function guardar_camposdispathalterno(tabla, campo, id, valor, campoidtabla) {

		$("#campo_valordis").load("movimiento_compras/guarda_campodispath.php", {

			tabla: tabla,
			campo: campo,
			id: id,
			valor: valor,
			campoidtabla: campoidtabla

		}, function(result) {
			   
		});

		$("#campo_valordis").html("Espere un momento...");



	}


//  End -->
</script>
