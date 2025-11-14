<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_GET["excel"]==1)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."LISTA_".$fechahoy.".xls");
}

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$precu_id=$_GET["precu_id"];
$centro_id=$_GET["centro_id"];

if($centro_id==1)
{
  $centro_id='55';
}

$lista_bprecuentac="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_bprecuentac = $DB_gogess->executec($lista_bprecuentac,array());
$clie_id=$rs_bprecuentac->fields["clie_id"];

$busca_clientec="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());	 

echo "CI:".$rs_bclientec->fields["clie_rucci"]."<br>";
echo "Paciente:".$rs_bclientec->fields["clie_nombre"]." ". $rs_bclientec->fields["clie_apellido"];
 $contador_vx=0;
 $contador_vxtotal=0;
 
 $lista_centros="select distinct  dns_detalleprecuenta.centrob_id from dns_detalleprecuenta inner join app_usuario on dns_detalleprecuenta.usua_id=app_usuario.usua_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2)";	
 $rs_lcentros = $DB_gogess->executec($lista_centros,array());
 
 if($rs_lcentros)
 {

	  while (!$rs_lcentros->EOF) { 
	  
	  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
   $contador_vx=0;	  
   $centro_idval=$rs_lcentros->fields["centrob_id"];
   
   $busca_ncentro="select * from dns_centrosalud where centro_id='".$centro_idval."'";
   $rs_ncentro = $DB_gogess->executec($busca_ncentro,array());	
   
   if(!($rs_ncentro->fields["centro_nombre"]))
   {
   echo "<br><br><b>PEDIDOS</b>";
   }
   else
   {   
   echo "<br><br><b>".$rs_ncentro->fields["centro_nombre"]."</b>";
   }
   
   for($iv=1;$iv<=2;$iv++)
   {
  ////iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii 
  if($iv==1)
  {
    echo "<br>MEDICAMENTOS<br>";
  }
  if($iv==2)
  {
    echo "<br>INSUMOS<br>";
  }
?>
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">AREA </div></td> 
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Usuario</div></td>       
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	$valor_total=0;
	//$lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_detalleprecuenta.centrob_id in (".$centro_id.",1,9999,8888)";
	
	//$lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2)";
	
	$lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (".$iv.") order by areap_id asc";
	
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuenta'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 

 

if($centro_idval==$rs_lprecuentas->fields["centrob_id"])
{
//=========================================================================
   
   $contador_vx++;
   $areap_id=$rs_lprecuentas->fields["areap_id"];	
   
   ///busca si es parte operatorio
   $nombre_bga='';
   if($areap_id==0)
   {
   
   $busca_pp="select * from dns_preddetalleparteoperatorio where detapre_id='".$rs_lprecuentas->fields["detapreoper_id"]."'";
   $rs_pp = $DB_gogess->executec($busca_pp,array());
   
   
   if($rs_pp->fields["partop_id"]>0)
   {
     $nombre_bga='QUIROFANO';
   }
   
   }
   
   if(!($nombre_bga))
   {
     
	   $areap_id=$rs_lprecuentas->fields["areap_id"];	  
  
       $busca_area="select * from lpin_area where area_id='".$areap_id."'";
       $rs_barea= $DB_gogess->executec($busca_area,array());
       $narea_v='';
       $narea_v=$rs_barea->fields["area_nombre"];
       $nombre_bga=$narea_v;
   }
  // if(!(trim($rs_lprecuentas->fields["centro_nombre"]))
  // {
   
  // }
   
   ///busca si es parte operatorio
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center">
        <?php echo $contador_vx; ?>
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $nombre_bga.$rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $usuariod; ?></div></td>   
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  
	  
//$ncampo_val='detapre_observacion';
//echo '<input name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_camposzz('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" />';
						
	  
	  ?>	  
	  </div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
     <!-- <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td> -->
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	   
	//=========================================================================
}	   
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>

<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo $valor_total; ?></b></div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>
<?php
////iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
}


$contador_vxtotal=$contador_vxtotal+$contador_vx;

        $rs_lcentros->MoveNext();	   

	  }
  }


echo "<br>Total Registros: ".$contador_vxtotal."<br>";
?>



<div id="campo_valorxx"></div>

<script type="text/javascript">
<!--
function guardar_camposzz(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorxx").load("aplicativos/documental/opciones/panel/precuenta/guarda_campop.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valorxx").html("Espere un momento...");



}

//  End -->
</script>