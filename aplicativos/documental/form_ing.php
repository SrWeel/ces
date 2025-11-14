<?php
ini_set('display_errors',1);
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

.navbar, .dropdown-menu{
background:#FFFFFF;
border: none;
height:80px;

}

.nav>li>a, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .dropdown-menu>li>a, .dropdown-menu>li{
  border-bottom: 3px solid transparent;
}
.nav>li>a:focus, .nav>li>a:hover,.nav .open>a, .nav .open>a:focus, .nav .open>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover{
  border-bottom: 3px solid transparent;
  background: rgba(154, 154, 154, 0.27);
}
.navbar a, .dropdown-menu>li>a, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .navbar-toggle{
 color: #fff;
}
.dropdown-menu{
      -webkit-box-shadow: none;
    box-shadow:none;
}

.nav li:hover:nth-child(8n+1), .nav li.active:nth-child(8n+1){
  border-bottom: #b6f423 4px solid;
}
.nav li:hover:nth-child(8n+2), .nav li.active:nth-child(8n+2){
  border-bottom: #82e2ea 4px solid;
}
.nav li:hover:nth-child(8n+3), .nav li.active:nth-child(8n+3){
  border-bottom: #f8b42c 4px solid;
}
.nav li:hover:nth-child(8n+4), .nav li.active:nth-child(8n+4){
  border-bottom: #fd594a 4px solid;
}
.nav li:hover:nth-child(8n+5), .nav li.active:nth-child(8n+5){
  border-bottom: #e8479d 4px solid;
}
.nav li:hover:nth-child(8n+6), .nav li.active:nth-child(8n+6){
  border-bottom: #a12eeb 4px solid;
}
.nav li:hover:nth-child(8n+7), .nav li.active:nth-child(8n+7){
  border-bottom: #4785d9 4px solid;
}
.nav li:hover:nth-child(8n+8), .nav li.active:nth-child(8n+8){
  border-bottom: #2aed9a 4px solid;
}

.navbar-toggle .icon-bar{
    color: #fff;
   
}

.fondopg {
    background-image: url("images/fondo.jpg");
    background-repeat: no-repeat;
}

body {
	background-color: #ffffff;    
    
}

.btn-success {
    color: #fff;
    background-color: #459DBE;
    border-color: #5570A5;
}
-->
</style>

<script type="text/javascript">
<!--
function solicita_clave()
{ 

$("#olvida_clave").load("aplicativos/documental/solicita_clave.php",{
  
  },function(result){  


  });  
  $("#olvida_clave").html("Espere un momento...");  

}

function recupera_clave()
{

  $("#olvida_clave").load("aplicativos/documental/recupera_clave.php",{
  email_pc:$('#email_pc').val()
  },function(result){  


  });  
  $("#olvida_clave").html("Espere un momento...");  

}

//  End -->
</script>

<br><br>
<div class="navbar-wrapper">
    <div class="container-fluid">
        <nav class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="images/logoh.png"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<div class="container fondopg" style="height:500px" >
<!-- <center><a href="index.php"><img src="images/logo_resgistro.png" border="0"></a></center> -->

 <center><img src="images/logohome.png"  /></center>
 
   <div style="border: 1px solid #003366;max-width:400px;" align="center" >
      <div class="form-group" style="max-width:400px;">
	    <div class="col-md-12" align="center">
            <div class="form-login">
			<BR />
            <h4 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px"><b>ACCESO AL SISTEMA</b></h4>
			<div id="acceso_usuario" ></div> 
			<div id="acceso_usuario1" ></div> 
            <input type="text" id="usuario_valor" name="usuario_valor" class="form-control" placeholder="usuario" />
            </br>
            <input type="password" id="clave_valor" name ="clave_valor" class="form-control" placeholder="clave" />
            </br>
			 <input id="token" name="token" value="" type="hidden">
			 <?php
				$anio_actual=date("Y");
			?>
			<input name="li_periodo"  id="li_periodo" type="hidden" value="<?php echo $anio_actual ?>">
            <div class="wrapper">
            <span class="btn btn-success btn_txt" <?php echo $obj_session_apl->funcionbotoningreso; ?> >     
                <a href="#"  <?php echo $obj_session_apl->funcionbotoningreso; ?> >INGRESAR</a>
            </span>
            </div>
            </div>
        
        </div>
	</div>	
		<center>&nbsp;</center>
	</div>

</div>







<div id="olvida_clave" >



<br />
<br />
