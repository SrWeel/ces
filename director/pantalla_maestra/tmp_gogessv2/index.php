<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $objtemplate->titulo_template  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
 
    <link href="css/general.css" rel="stylesheet">
    <link href="css/colors/noise-blue.css" rel="stylesheet" id="theme">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <link href="css/ie8.css" rel="stylesheet">
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="js/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="ico/favicon.png">
	<link type="text/css" href="css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
	
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>

<script language="javascript" type="text/javascript" src="js/jquery.corner.js"></script>

<script language="javascript" type="text/javascript" src="js/ui.mask.js"></script>
<script language="javascript" type="text/javascript" src="js/ui.datepicker-es.js"></script>
 
<script type="text/javascript" src="js/jquery.timer2.js"></script> 
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript" src="js/jquery.fixheadertable.js"></script>

<script src="js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>

<?php
include("modules/script/script.php");
?>



    <script>
      //* hide all elements & show preloader
      document.documentElement.className += 'loader';
    </script>
  </head>

  <body>
   <div class="loading"><img src="img/ajaxLoader/loader01.gif" alt=""></div>
  
  
  
  <div class="mainContainer">
  
   <header>
        <div>
          <a href="#" class="logo"><img src="img/logo.png" alt=""></a>
          <?php 
		  if ($table)
          {  
		       echo $objtableform->titulo_tabla;
		  }	
		  
		    if ($apl)
          {  
		       //echo $apl;
			   $tituloapl=$objformulario->replace_cmb("pcl_aplicationadm","ap_id,ap_nombre","where ap_id =",$apl,$DB_gogess);
			   echo $tituloapl;
		  }	
		  
		  ?>
          <ul class="headerButtons">
            
           
            
            <li><a href="close.php"><img src="img/icons/14x14/light/lock3.png" alt=""> </a></li>
          </ul>
        </div>
    </header>
	
	
  <div class="widgetBar">
   <div class="barInner">
     <?php
	$objmenu->menu_posicion("1",$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,$apl,$extra,$DB_gogess) 
	?>
	 <?php
	$objmenu->menu_posicion("2",$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,$apl,$extra,$DB_gogess) 
	?>
	 <?php
	$objmenu->menu_posicion("3",$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,$apl,$extra,$DB_gogess) 
	?>
	 <?php
	$objmenu->menu_posicion("4",$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,$apl,$extra,$DB_gogess) 
	?>
    </div>
  </div>
	
	  <div class="content">
    <div class="innerContent">
      
	  
	  <table border="0" cellpadding="0" cellspacing="7">
              
              <tr>
                <td valign="top"><?php

if ($table)
 {   
    echo "<div id=divBody_borrar_".str_replace(".","_",$table)." ></div>";
	
	if ($objtableform->tabla_activa==1 or $objtableform->tabla_activa==2)
	{
    include ($objtableform->path_templateform."formulario.php");    
	}
 }
else
 {
    if (!($tablelista))
    {  
    switch ($opcp) 
	{
	
	 case 7:
		{
//Aplicaciones
			include("libreria/aplicativopanel/aplicativo.php");

		}   	
        break;
	  
	 default:
		{
			 include($objtemplate->path_template."inicio.php");
		}
	   break;
	 }  
	 }
 }
	
	
	
	?></td>
                </tr>
              <tr>
                <td valign="top"><?php
		
		if ($table)
{



  if ($objtableform->tabla_activa==1 or $objtableform->tabla_activa==3)
	{
      
	?> 
	
	
	<SCRIPT LANGUAGE=javascript>
<!--
function searchoflist(ret1) 
{ 	
	<?php
	 $dataenc='';
	 $armaencrip="geamv=".$geamv."&id_inicio=".$id_inicio."&campoorden=".$objgridtabla->campoorden."&forden=".$objgridtabla->forden;	
	 $dataenc=$objformulario->encrypt($armaencrip);		
	?>
	window.document.form_<?php echo str_replace(".","_",$table); ?>.action='index.php?mp=<?php echo $dataenc ?>'	
	window.document.form_<?php echo str_replace(".","_",$table); ?>.csearch.value=ret1   
	window.document.form_<?php echo str_replace(".","_",$table); ?>.opcion_<?php echo str_replace(".","_",$table); ?>.value='buscar'
	window.document.form_<?php echo str_replace(".","_",$table); ?>.submit()		
}	
//-->
</SCRIPT>
	  
	<?php
	
	
	} 
}	
		
		?></td>
                </tr>
              <tr>
                <td valign="top"><div class=TableScroll>
				<div id=grid_tabla >&nbsp;</div>
				</div>	</td>
                </tr>
            </table>
	  
	  
    </div>
  </div>
  
  
  </div>
  
  








   <script>
      $(document).ready(function() {
        setTimeout('$("html").removeClass("loader")',1000);
      });
    </script>
   </body>
</html>