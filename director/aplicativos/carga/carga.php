<?php
//include("../../libreria/dbcc.php");
//include("../../cfgclases/config.php");

$fp = fopen("carga.txt", "r");
$cuenta=0;
while(!feof($fp)) {
$linea = fgets($fp);

$lineaarray=explode(chr(9),$linea);
//print_r($lineaarray);
//echo $linea . "<br />";

 if ($cuenta>0)
 {
  /////////////////////////////////////////////////evita las primeras lineas

if ($lineaarray[0])
{	
 $carg_cedula=trim($lineaarray[0]);
$carg_nombre=trim($lineaarray[1]);
$carg_cuenta=trim($lineaarray[2]);
$carg_direccion=trim($lineaarray[3]);
$carg_telf=trim($lineaarray[4]);
$carg_celu=trim($lineaarray[5]);
$carg_referencia1=trim($lineaarray[6]);
$pred_cedula=trim($lineaarray[7]);
$carg_direccion_ref1=trim($lineaarray[8]);
$carg_telfref1=trim($lineaarray[9]);
$carg_nombre_refer2=trim($lineaarray[10]);
$carg_direcc_refr2=trim($lineaarray[11]);
$carg_telfref2=trim($lineaarray[12]);
$carg_no_accrual_proyectada=trim($lineaarray[13]);
$carg_usuario=trim($lineaarray[14]);
$carg_valor_venc=trim($lineaarray[15]);
$carg_pago_minimo=trim($lineaarray[16]);
$carg_total_deuda=trim($lineaarray[17]);
$carg_pagos=trim($lineaarray[18]);
$carg_estatus=trim($lineaarray[19]);
$carg_iden_de_vencido=trim($lineaarray[20]);
$carg_cuota_vencidas=trim($lineaarray[21]);
$carg_fec_prox_pago=trim($lineaarray[22]);
$carg_ciudad=trim($lineaarray[23]);
$carg_mail=trim($lineaarray[24]);
$carg_interes_corte=trim($lineaarray[25]);
$carg_ipcv=trim($lineaarray[26]);
$carg_campana=trim($lineaarray[27]);
$carg_fecha_asignacion=trim($lineaarray[28]);



echo  $sqlinsertacarga="INSERT INTO `cobr_carga` (`carg_cedula`, `carg_nombre`, `carg_cuenta`, `carg_direccion`, `carg_telf`, `carg_celu`, `carg_referencia1`, `carg_direccion_ref1`, `carg_telfref1`, `carg_nombre_refer2`, `carg_direcc_refr2`, `carg_telfref2`, `carg_no_accrual_proyectada`, `carg_tarjeta`, `carg_usuario`, `carg_valor_venc`, `carg_pago_minimo`, `carg_total_deuda`, `carg_pagos`, `carg_estatus`, `carg_iden_de_vencido`, `carg_cuota_vencidas`, `carg_fec_prox_pago`, `carg_ciudad`, `carg_mail`, `carg_interes_corte`, `carg_ipcv`, `carg_campana`, `carg_fecha_asignacion`) VALUES
('$carg_cedula', '$carg_nombre', '$carg_cuenta', '$carg_direccion', '$carg_telf', '$carg_celu', '$carg_referencia1', '$carg_direccion_ref1', '$carg_telfref1', '$carg_nombre_refer2', '$carg_direcc_refr2', '$carg_telfref2', '$carg_no_accrual_proyectada', '$carg_tarjeta', '$carg_usuario', '$carg_valor_venc', '$carg_pago_minimo', '$carg_total_deuda', `carg_pagos`, '$carg_estatus','$carg_iden_de_vencido','$carg_cuota_vencidas', '$carg_fec_prox_pago', '$carg_ciudad', '$carg_mail', '$carg_interes_corte', '$carg_ipcv', '$carg_campana', '$carg_fecha_asignacion');";

 $rs_gogessform = $DB_gogess->Execute($sqlinsertacarga);

}
}
  
 else
 {
   ////....
    switch ($cuenta) {
    case 0:
        $carg_cedula=trim($lineaarray[0]);
		//$pred_fechag=fechaformato($pred_fechag,'[/]');
        break;    
    default:
       
      }
	////....
	
 }
 $cuenta++;
 }
	


//fclose($fp);

?>