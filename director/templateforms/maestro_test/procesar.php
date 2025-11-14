<?php
ini_set("session.gc_maxlifetime","54400000");
session_start();
$director="../../";
include ("../../cfgclases/clases.php");

$busca_test="select * from appg_test where test_id='".$_POST["test_id"]."'";
$rs_test = $DB_gogess->Execute($busca_test);

if($rs_test->fields["test_ntabla"])
{
     echo "Nombre ya fue creado no se puede modificar...<br>";
}
else
{
   
    $nombre_tabla=strtolower(str_replace(' ','',$rs_test->fields["test_nombrecorto"]));
    $nombre_tabla=str_replace('.','',$nombre_tabla);
	$nombre_tabla=str_replace(':','',$nombre_tabla);
    $nombre_tabla=str_replace('_','',$nombre_tabla);
    $nombre_tabla=str_replace('&','',$nombre_tabla);
    $nombre_tabla="grid_".$nombre_tabla.$_POST["test_id"];
    

   $actualiza_data="update appg_test set test_ntabla='".$nombre_tabla."' where test_id='".$_POST["test_id"]."'";
   $rs_ac = $DB_gogess->Execute($actualiza_data);
   
   echo "Nombre generado no se puede modificar...<br>";

?>

<script language="javascript">
<!--
$('#test_ntabla').val('<?php echo $nombre_tabla; ?>');
$('#despliegue_test_ntabla').html('<?php echo $nombre_tabla; ?>');

//-->
</script>
   
   <?php
    
}

if($rs_test->fields["test_ntablafija"])
{
     echo "Nombre Fijo  ya fue creado no se puede modificar...<br>";
}
else
{
 
    $nombre_tablaf=strtolower(str_replace(' ','',$rs_test->fields["test_nombrecorto"]));
    $nombre_tablaf=str_replace('.','',$nombre_tablaf);
	$nombre_tablaf=str_replace(':','',$nombre_tablaf);
    $nombre_tablaf=str_replace('_','',$nombre_tablaf);
    $nombre_tablaf=str_replace('&','',$nombre_tablaf);
    $nombre_tablaf="fijo_".$nombre_tablaf.$_POST["test_id"];
    

   $actualiza_data="update appg_test set test_ntablafija='".$nombre_tablaf."' where test_id='".$_POST["test_id"]."'";
   $rs_ac = $DB_gogess->Execute($actualiza_data);
   
   echo "Nombre Fijo generado no se puede modificar...<br>";
   ?>
   
<script language="javascript">
<!--
$('#test_ntablafija').val('<?php echo $nombre_tablaf; ?>');
$('#despliegue_test_ntablafija').html('<?php echo $nombre_tablaf; ?>');

//-->
</script>
   
   
   <?php
 
} 
?>


