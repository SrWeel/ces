<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$crb_id=$_POST["crb_id"];

$cuenta_hay=0;

$lista_pagos="select * from lpin_masivocobropago inner join lpin_masivocobropagodetalle on lpin_masivocobropago.crb_enlace=lpin_masivocobropagodetalle.crb_enlace where crb_id='".$crb_id."'";

$rs_listadiariox = $DB_gogess->executec($lista_pagos,array());
 if($rs_listadiariox)
 {
     while (!$rs_listadiariox->EOF) {
	 
	 $cuenta_hay++;
	 
	 $busca_registrado="select * from lpin_cobropago where crpadetmasivo_id='".$rs_listadiariox->fields["crpadet_id"]."'";
	 $rs_bureg = $DB_gogess->executec($busca_registrado,array());
	 
	 if($rs_bureg->fields["crb_id"]>0)
	 {
	   echo "Ya fue procesado...<br>";
	 }
	 else
	 {
	 //=======================================================================
	 
	 $ttra_id=$rs_listadiariox->fields["ttra_id"];	 
	 $frocob_id=$rs_listadiariox->fields["frocob_id"];
	 $subfp_id=$rs_listadiariox->fields["subfp_id"];
	 $crb_fecha=$rs_listadiariox->fields["crb_fecha"];
	 $proveep_id=$rs_listadiariox->fields["proveep_id"];
	 $crb_cuenta=$rs_listadiariox->fields["crb_cuenta"];
	 $crb_ncomprobante=str_replace("'","",$rs_listadiariox->fields["crb_ncomprobante"]);
	 $crb_ncheque=$rs_listadiariox->fields["crb_ncheque"];
	 $crb_fechacheque=$rs_listadiariox->fields["crb_fechacheque"];
	 $cuentb_id=$rs_listadiariox->fields["cuentb_id"];
	 $lote_id=$rs_listadiariox->fields["lote_id"];
	 $usua_id=$rs_listadiariox->fields["usua_id"];
	 $crb_fecharegistro=$rs_listadiariox->fields["crb_fecharegistro"];
	 $crb_efectivo=$rs_listadiariox->fields["crb_efectivo"]; 
	 $crb_descripcion =str_replace("'","",$rs_listadiariox->fields["crb_descripcion"]); 
	 $crb_paguesealaorden =$rs_listadiariox->fields["crb_paguesealaorden"]; 
	 
	 $codig_unicovalor='';
	 $unico_number='';
	 $unico_number=strtoupper(uniqid());			
	 $codig_unicovalor=date("Y-m-d").$_SESSION['ces1313777_sessid_inicio'].$unico_number;
	 
	 $crb_enlace=$codig_unicovalor; 
	 $doccab_id=$rs_listadiariox->fields["doccabcp_id"]; 
	 $compra_id=$rs_listadiariox->fields["compracp_id"]; 
	 $crpadetmasivo_id=$rs_listadiariox->fields["crpadet_id"];
	    
		
		
	$inserta_data="INSERT INTO lpin_cobropago ( ttra_id, frocob_id, subfp_id, crb_fecha, proveep_id, crb_cuenta, crb_ncomprobante, crb_ncheque, crb_fechacheque, cuentb_id, lote_id, usua_id, crb_fecharegistro, crb_efectivo, crb_descripcion, crb_paguesealaorden, crb_enlace, doccab_id, compra_id,crpadetmasivo_id) VALUES
('".$ttra_id."','".$frocob_id."','".$subfp_id."','".$crb_fecha."','".$proveep_id."','".$crb_cuenta."','".$crb_ncomprobante."','".$crb_ncheque."','".$crb_fechacheque."','".$cuentb_id."','".$lote_id."','".$usua_id."','".$crb_fecharegistro."','".$crb_efectivo."','".$crb_descripcion."','".$crb_paguesealaorden."','".$crb_enlace."','".$doccab_id."','".$compra_id."','".$crpadetmasivo_id."')";

   $rs_insdata = $DB_gogess->executec($inserta_data,array());
   //echo $inserta_data."<br>";
 
 
  $ttradet_id=$ttra_id;
  $compracp_id=$compra_id;
  $doccabcp_id=$doccab_id;
  $crpadet_fechaemision=$rs_listadiariox->fields["crpadet_fechaemision"];
  $tipdocdet_id=$rs_listadiariox->fields["tipdocdet_id"];
  $crpadet_valor=$rs_listadiariox->fields["crpadet_valor"];
  $crpadet_saldo=$rs_listadiariox->fields["crpadet_saldo"];
  $crpadet_valorapagar=$rs_listadiariox->fields["crpadet_valorapagar"];
  $usua_id=$rs_listadiariox->fields["usua_id"];
  $crpadet_fecharegistro=$rs_listadiariox->fields["crpadet_fecharegistro"];
 
   
   
   $inserta_detalle="INSERT INTO lpin_cobropagodetalle ( crb_enlace, ttradet_id, compracp_id, doccabcp_id, crpadet_fechaemision, tipdocdet_id, crpadet_valor, crpadet_saldo, crpadet_valorapagar, usua_id, crpadet_fecharegistro) VALUES ('".$crb_enlace."','".$ttradet_id."','".$compracp_id."','".$doccabcp_id."','".$crpadet_fechaemision."','".$tipdocdet_id."','".$crpadet_valor."','".$crpadet_saldo."','".$crpadet_valorapagar."','".$usua_id."','".$crpadet_fecharegistro."')";
   
   $rs_insdatadeta = $DB_gogess->executec($inserta_detalle,array());

 // echo $inserta_detalle."<br>============================<br>";
 
 
 
///creando asientos++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$lista_pagosas="select * from lpin_cobropago where crb_enlace='".$crb_enlace."'";
$rs_listadiarioxas = $DB_gogess->executec($lista_pagosas,array());

$crb_idbu=$rs_listadiarioxas->fields["crb_id"];
$ttra_idbu=$rs_listadiarioxas->fields["ttra_id"];

if($crb_idbu>0)
{
//==================
  if($ttra_idbu==1)
  {
    ///cobro
      include ('ejecuta_cobro.php');
    //cobro
  }


  if($ttra_idbu==2)
  {
    ///pago
 
      include ('ejecuta_pago.php');

    //pago
  }

//==================
}




///creando asientos+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 
 
 
 

//=======================================================================
   }
	 
	   $rs_listadiariox->MoveNext();	
	 
	 }
 
 
 }
 

 
 


if( $cuenta_hay>0)
{
echo '<center><b>PROCESADO</b></center><br><br>';
$lista_pagoscerrar="update lpin_masivocobropago set crb_procesado=1,crb_fechaprocesado='".date("Y-m-d H:i:s")."' where crb_id='".$crb_id."'";
$rs_listadiariocerrar = $DB_gogess->executec($lista_pagoscerrar,array());
?>

<script type="text/javascript">
<!--

 $('#btn_ghj').hide();
 $('#btn_ghj1').hide();

//  End -->
</script>

<?php
}
else
{
echo '<center><b>ALERTA PARA PROCESAR DEBE AGREGAR REGISTROS EN DOCUMENTOS PARA PAGOS</b></center><br><br>';
}



}


?>