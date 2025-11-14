<?php
ini_set("session.gc_maxlifetime","14400");
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{


if($_POST["pvalor_verificador"]==$_SESSION['cap_code'])
{
    echo '	
	<table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td onclick="validar_pago()" style="cursor:pointer" ><img src="images/pagar_on.png" width="64" height="27" /></td>
            </tr>
          </table>	';
}
else
{
  echo '  
  <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td  ><img src="images/pagar_off.png" width="64" height="27" /></td>
            </tr>
          </table>	';

}


}

?>