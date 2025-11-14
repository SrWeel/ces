<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="44450000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$codigo_pr=$_POST["codigo_pr"];
$lote_pr=$_POST["lote_pr"];
$fechai=$_POST["fechai"];
$fechaf=$_POST["fechaf"];



if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$sqltotal="";

$objformulario= new  ValidacionesFormulario();

$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);


$busca_nmedic="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$codigo_pr."'";
$rs_nmedic= $DB_gogess->executec($busca_nmedic);
$nom1='';					
if($rs_nmedic->fields["cuadrobm_nombrecomercial"])
{
   $nom1=$rs_nmedic->fields["cuadrobm_nombrecomercial"].' ';
}

$nom2='';					
if($rs_nmedic->fields["cuadrobm_primerniveldesagregcion"])
{
   $nom2=$rs_nmedic->fields["cuadrobm_primerniveldesagregcion"].' ';
}

$nom3='';					
if($rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"])
{
   $nom3=$rs_nmedic->fields["cuadrobm_tercerniveldesagregcion"].' ';
}
 
$nom4='';					
if($rs_nmedic->fields["cuadrobm_concentracion"])
{
   $nom4=$rs_nmedic->fields["cuadrobm_concentracion"].' ';
}

$nom5='';					
if($rs_nmedic->fields["cuadrobm_nombredispositivo"])
{
   $nom5=$rs_nmedic->fields["cuadrobm_nombredispositivo"].' ';
}


$concatena_nom=$nom1.$nom2.$nom3.$nom4.$nom5;
$nombre_medic='';
$nombre_medic=$rs_nmedic->fields["cuadrobm_codigoatc"].' '.utf8_encode($rs_nmedic->fields["cuadrobm_principioactivo"]).' '.utf8_encode($concatena_nom);

$busca_lote="select * from dns_movimientoinventario where moviin_nlote='".$lote_pr."' and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."'";
$rs_dlote= $DB_gogess->executec($busca_lote);

$moviin_fechadecaducidad=$rs_dlote->fields["moviin_fechadecaducidad"];

$centro_id=$_SESSION['ces1313777_centro_id'];
?>
<div align="center">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><strong>DIRECCION NACIONAL DE ATENCION INTEGRA EN SALUD DE LA POLICIA NACIONAL </strong></div></td>
    </tr>
    <tr>
      <td><div align="center"><strong>Kardex BODEGA DNS Lote: </strong><?php echo $lote_pr; ?> <strong>Fecha Cad.</strong><?php echo $moviin_fechadecaducidad; ?> </div></td>
    </tr>
    <tr>
      <td><div align="center"><strong>Producto:</strong> <?php echo $nombre_medic; ?> </div></td>
    </tr>
    <tr>
      <td><div align="center"><strong>Desde:</strong> <?php echo $fechai; ?> <strong>Hasta: </strong><?php echo $fechai; ?> </div></td>
    </tr>
  </table>
</div>
<?php
$bu_kardex="select * from dns_kardex where (fecha>='".$fechai."' and fecha<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."' and moviin_nlote='".$lote_pr."' order by tipom_id,fecha asc";

$bu_kardex="select invp.centro_id,cen.centro_nombre AS bodega,sum(invp.moviin_totalenunidadconsumo) AS cantidad,invp.tipom_id AS tipom_id,invp.tipomov_id AS tipomov_id,invp.cuadrobm_id AS cuadrobm_id,invp.moviin_nlote AS moviin_nlote,invp.moviin_fechadecaducidad AS moviin_fechadecaducidad,centrorecibe_id,moviin_fecharegistro,invp.plantra_id,invp.plantrai_id,centroenvia_id from dns_movimientoinventario invp inner join dns_centrosalud cen on invp.centro_id=cen.centro_id where perioac_id='".$per_activo."' 
and (date_format(moviin_fecharegistro, '%Y-%m-%d')>='".$fechai."' and date_format(moviin_fecharegistro, '%Y-%m-%d')<='".$fechaf."') and cuadrobm_id='".$rs_nmedic->fields["cuadrobm_id"]."' and moviin_nlote='".$lote_pr."' and invp.centro_id='".$centro_id."'
group by invp.centro_id,invp.tipom_id,invp.tipomov_id,invp.cuadrobm_id,invp.moviin_nlote,invp.moviin_fechadecaducidad,centrorecibe_id,moviin_fecharegistro,invp.plantra_id,invp.plantrai_id,centroenvia_id";

?>
<br>
<br>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><strong>Fecha</strong></div></td>
    <td><div align="center"><strong>Movimiento</strong></div></td>
	<td><div align="center"><strong>Bodega Origen</strong></div></td>
    <td><div align="center"><strong>Bodega Destino</strong></div></td>
    <td><div align="center"><strong>Ingreso</strong></div></td>
    <td><div align="center"><strong>Egreso</strong></div></td>
    <td><div align="center"><strong>Saldo</strong></div></td>
  </tr>
  <?php
  $saldo=0; 
  $rs_listakardex = $DB_gogess->executec($bu_kardex);
                   if($rs_listakardex)
				   {
						while (!$rs_listakardex->EOF) {
						
					if($rs_listakardex->fields["tipom_id"]==1)
					{	
											
						$busca_movnom="select * from dns_motivomovimiento where tipom_id=1 and tipomov_id='".$rs_listakardex->fields["tipomov_id"]."'";
						$rs_movnom = $DB_gogess->executec($busca_movnom);
						
						$saldo=$saldo+$rs_listakardex->fields["cantidad"];
						
						
						
						$busca_cor="select * from dns_centrosalud where centro_id='".$rs_listakardex->fields["centroenvia_id"]."'";
						$rs_cdor = $DB_gogess->executec($busca_cor);
					?>
					 <tr>
						<td><?php echo $rs_listakardex->fields["moviin_fecharegistro"]; ?></td>
						<td><?php echo $rs_movnom->fields["tipomov_nombre"]; ?></td>
						<td><?php echo utf8_encode($rs_cdor->fields["centro_nombre"]); ?></td>
						<td></td>
						<td><?php echo $rs_listakardex->fields["cantidad"]; ?></td>
						<td>&nbsp;</td>
						<td><?php echo $saldo; ?></td>
  </tr>					
					<?php
					}
					
					if($rs_listakardex->fields["tipom_id"]==2 )
					{	
					    $busca_movnom="select * from dns_motivomovimiento where tipom_id=2 and tipomov_id='".$rs_listakardex->fields["tipomov_id"]."'";
						$rs_movnom = $DB_gogess->executec($busca_movnom);
						
						$color='';
						
						
						$saldo=$saldo-$rs_listakardex->fields["cantidad"];
						
						$busca_cdestino="select * from dns_centrosalud where centro_id='".$rs_listakardex->fields["centrorecibe_id"]."'";
						$rs_cdestino = $DB_gogess->executec($busca_cdestino);
						
						
					?>
					<tr <?php echo $color; ?> >
						<td><?php echo $rs_listakardex->fields["moviin_fecharegistro"]; ?></td>
						<td><?php echo $rs_movnom->fields["tipomov_nombre"]; ?></td>
						<td></td>
						<td><?php echo utf8_encode($rs_cdestino->fields["centro_nombre"]); ?></td>
						<td>&nbsp;</td>
						<td><?php echo $rs_listakardex->fields["cantidad"]; ?></td>
						<td><?php echo $saldo; ?></td>
                    </tr>					
					<?php
					}
						

                         $rs_listakardex->MoveNext();
                       }
				}	   
  
  
  ?>
</table>
<?php
}
?>