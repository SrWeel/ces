<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
session_start();
//require_once '../../autoload.php';
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$obj_session_apl= new session_apl();
$obj_session_apl->seleccion_acc_apl($_POST["accesousuario_p"],$DB_gogess);
?>
<style type="text/css">
<!--

.Estilo1 {

	font-size: 10px;

	color: #999999;

}
-->
</style>

<style type="text/css">
<!--
a:focus, a:hover,a {
color:#ffffff;
}

.errors{
font-family:Verdana, Arial, Helvetica, sans-serif;

}

@import url(http://fonts.googleapis.com/css?family=Roboto:400);

.container {
    padding: 0px;

}

.cmb_txt{

    width: 100%;
    margin: 0;
    padding: 5px 10px;
    background: 0;
    border: 0;
    border-bottom: 1px solid #000000;
    outline: 0;
    font-style: italic;
    font-size: 12px;
    font-weight: 400;
    letter-spacing: 1px;
    margin-bottom: 5px;
    color: #000000;
    outline: 0;	

}

.btn_txt{

    width: 100%;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 500;
    margin-top: 16px;
    outline: 0;
    cursor: pointer;
    letter-spacing: 1px;
	color: #FFFFFF;

}
-->
</style>
<div  style="height:300px" >
<!-- <center><a href="index.php"><img src="images/logo_resgistro.png" border="0"></a></center> -->
<p>&nbsp;</p>

      <div class="form-group" style="max-width:400px" align="center">
	    <div class="col-md-12" align="center">
            <div class="form-login">
            <h4>INGRESAR AL SISTEMA</h4>
			<div id="acceso_usuario_ac" ></div> 
			<div id="acceso_usuario1_ac" ></div> 
            <input type="text" id="usuario_valor_ac" name="usuario_valor_ac" class="cmb_txt" placeholder="usuario" />
            </br>
            <input type="password" id="clave_valor_ac" name ="clave_valor_ac" class="cmb_txt" placeholder="clave" />
            </br>
			 <input id="token" name="token" value="" type="hidden">
			 <?php

				$anio_actual=date("Y");

			?>
			<input name="li_periodo"  id="li_periodo" type="hidden" value="<?php echo $anio_actual ?>">
            <div class="wrapper">
            <span class="btn btn-success btn_txt" onclick="ingreso_usuario_ac('<?php echo $_POST["funciones_siguientes"] ?>')" >     
              INGRESAR
            </span>
            </div>
            </div>
        </div>
	</div>
</div>

<br />
