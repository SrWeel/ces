<?php
ini_set("session.gc_maxlifetime","14400");
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{


if($_POST["pvalor_verificador"]==$_SESSION['cap_code'])
{
    echo '<input name="capcha_validar" type="hidden" id="capcha_validar" value="1" />';
}
else
{
  echo '<input name="capcha_validar" type="hidden" id="capcha_validar" value="0" />';

}


}

?>