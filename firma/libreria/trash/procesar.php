<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
?>
<?php
//Llamando objetos
$director="../";
include("../cfgclases/clases.php");



if($_POST["pidvalor"])
{
$objformulario->formulario_update($_POST["tabla"],$_POST,$typesql,$_POST["pidvalor"],$varsend,$listab,$campo,$obp,$DB_gogess);
}
else
{
$objformulario->formulario_guardar($_POST["tabla"],$_POST,$typesql,$varsend,$listab,$campo,$obp,$DB_gogess);

}
if($objformulario->okinsertado)
{
    echo " var result_global = '1'; ";
}
else
{
   echo " var result_global = '0'; ";

}
?>