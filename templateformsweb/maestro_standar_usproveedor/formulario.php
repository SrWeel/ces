<?php
require_once '../../../../../autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '175428196259619', // Replace {app-id} with your app id
  'app_secret' => '8f3fc09d6c9506d307682bf147fc58eb',
  'default_graph_version' => 'v2.8',
  ]);


$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://www.domohs.com/domohs/fb-callback.php', $permissions);
?>
<style>

.divider {
    border-top: 1px solid #d9dadc;
    display: block;
    line-height: 1px;
    margin: 15px 0;
    position: relative;
    text-align: center;
}
b, strong {
    font-weight: 700;
}
.divider .divider-title {
    background: #fff;
    font-size: 12px;
    letter-spacing: 1px;
    padding: 0 20px;
    text-transform: uppercase;
}

.btn-block {
	display:block;
	width:100%
}
.btn-block+.btn-block {
	margin-top:5px
}
input[type=button].btn-block,input[type=reset].btn-block,input[type=submit].btn-block {
	width:100%
}

.btn-group-sm > .btn, .btn-group-xs > .btn, .btn-sm1, .btn-xs, .navbar-form .btn, .navbar .navbar-nav .navbar-btn {
    font-size: 14px;
    line-height: 1.5;
    border-radius: 500px;
        border-top-left-radius: 500px;
        border-top-right-radius: 500px;
        border-bottom-right-radius: 500px;
        border-bottom-left-radius: 500px;
    padding: 7px 35px;
}
.btn1,.navbar .navbar-nav .navbar-btn {
	padding:10px 47px;
	font-size:18px;
	line-height:1.5;
	border-radius:500px;
	padding:11px 47px 9px;
	-webkit-transition:background-color .15s ease,border-color .15s ease,color .15s ease;
	transition:background-color .15s ease,border-color .15s ease,color .15s ease;
	border-width:0;
	letter-spacing:1.2px;
	min-width:130px;
	text-transform:uppercase;
	white-space:normal
}

.btn-facebook {
	color:#fff;
	background-color:#3b5998;
}
.btn-facebook:hover {
	color:#fff;
	background-color:#3a61b3;
}
.btn-facebook:focus {
	color:#fff;
	background-color:#3b5998;
	box-shadow:inset 0 0 0 2px hsla(0,0%,100%,.7)
}
.btn-facebook.active,.btn-facebook:active,.open>.dropdown-toggle.btn-facebook {
	background-color:#3b5998;
	box-shadow:none
}
.btn-group-sm>.btn,.btn-group-xs>.btn,.btn-sm1,.btn-xs,.navbar-form .btn,.navbar .navbar-nav .navbar-btn {
	font-size:14px;
	line-height:1.5;
	border-radius:500px;
	padding:7px 35px
}
</style>
<style type="text/css">
<!--
a:focus, a:hover {
color:#006699;
}


-->
</style>

<div align="center" style="max-width:600px;" >
<div class="content">
<div class="row">
<div class="col-xs-12">
<?php
echo '<a class="btn1 btn-sm1 btn-block btn-facebook ng-binding" href="'.htmlspecialchars($loginUrl).'"  ><b>REGISTRATE con Facebook</b></a>';
?>


</div>
</div>
</div>

<div class="divider"><strong class="divider-title ng-binding">o</strong></div>
      <?php
	 
		    $objformulario->sendvar["fechax"]=date("Y-m-d H:i:s");	
			$objformulario->sendvar["emp_idx"]=1;	
            $objformulario->sendvar["horax"]=date("H:i:s");
			$objformulario->sendvar["sisu_idx"]=@$_SESSION['ces1313777_sessid_inicio'];
			$objformulario->sendvar["usr_tpingx"]=0;
			//$objformulario->sendvar["usua_esusuariox"]=1; 
			if($_POST["pVar7"]==1)
			{
			$objformulario->sendvar["usua_esusuariox"]=1; 
			}
			if($_POST["pVar7"]==2)
			{
			$objformulario->sendvar["usua_esproveedorx"]=1; 
			}
			//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
			
			 
$objformulario->generar_formulario(@$submit,$table,1,$DB_gogess); 
?>
   <br><br>

	  <input name="acepta_pol" type="checkbox" id="acepta_pol" value="1" onClick="asignar_valor();" >
    Compartir mis datos de registro con los proveedores de contenido de Domohs para fines de Marketing<br> Al hacer clic en Registrate <a href="http://www.domohs.com/domohs/contenido_ext.php?ar=37" target="_blank" >t&eacute;rminos y condiciones</a> y la <a href="http://www.domohs.com/domohs/contenido_ext.php?ar=38" target="_blank" >pol&iacute;tica de <br>
    privacidad</a>  de Domohs

<?php       
if($csearch)
{
 $valoropcion='actualizar';
}
else
{
 $valoropcion='guardar';
}

echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_".$table."' type='hidden' value='".$valoropcion."' id='opcion_".$table."' >
<input name='table' type='hidden' value='".$table."'>";

?>
<div id=div_<?php echo $table ?> > </div>

</div>	


