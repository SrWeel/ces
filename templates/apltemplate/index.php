<?php
$objcontenido->articuloenv=$ar;
$objcontenido->aplicativoenv=$apl;
?>
<html>
<head>
<title><?php  echo $objportal->sys_titulo ?></title>
<?php
if ($apl==30)
{
?>
<base target="_blank" />
<?php
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
if ($objportal->sys_pathfavicon)
{
  echo '<link rel="shortcut icon" href="'.$objportal->sys_pathfavicon.'" />';
}

?>
<link href="<?php echo $objtemplatep->path_template ?>styles/formato.css" rel="stylesheet" type="text/css"  media="all">
<link href="<?php echo $objtemplatep->path_template ?>styles/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo $objtemplatep->path_template ?>styles/default.css" />


<link href="styles/formato.css" rel="stylesheet" type="text/css">
<link href="styles/formatogeneral.css" rel="stylesheet" type="text/css">
<script src="<?php echo $objtemplatep->path_template ?>selectuser_contenido.js"></script>

<script type="text/javascript" language="JavaScript1.2" src="<?php echo $objtemplatep->path_template ?>stm31.js"></script>
<script src="<?php echo $objtemplatep->path_template ?>selectuseracc.js"></script>

 <link rel="stylesheet" href="<?php echo $objtemplatep->path_template ?>js/_common/css/main.css" type="text/css" media="all">
    <link href="<?php echo $objtemplatep->path_template ?>js/lightbox/lightbox.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo $objtemplatep->path_template ?>js/_common/js/mootools.js"></script>
    <script type="text/javascript" src="<?php echo $objtemplatep->path_template ?>js/lightbox/lightbox.js"></script>


<style type="text/css">

ul.makeMenu
{
	list-style:none;	
	width:100%;
	margin-top: 5px;
	margin-bottom:5px;
	
}
ul.makeMenu a
{
	           
				float:left;
				height:13px;				
				color:#ffffff;
				text-decoration:none;
				padding:0 15px;			
				cursor: pointer;	
}

ul.makeMenu li
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
	font-weight:bold;
	display:block;
	position:relative;
	padding:1px 2px;
	float: left;
	text-transform: uppercase;
}
ul.makeMenu ul
{
	position:absolute;
	left:20px;
	top:-1px;
	display:none;
	list-style:none;
	margin: 0;
    padding: 0;
}
ul.makeMenu  li  ul
{
	position:absolute;
	padding-top:5px;
	left:-10px;
	top:14px;
	display:none;
	list-style:none;
	z-index:89;
	
}

ul.makeMenu  li  ul li
{
	background:#18539f;
	opacity:0.7;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	padding-bottom:5px;
	padding-top:5px;
	border-top:1px solid #ffffff;
	border-left:1px solid #ffffff;
	border-right:1px solid #ffffff;
	border-bottom:1px solid #ffffff;
	width:170px;
	
}


ul.makeMenu li a:hover
{
	display:block;
	float:left;
	height:13px;				
	
	color:#FFFFFF;
	text-decoration:none;
	padding:0 15px;
	
	
}
ul.makeMenu li:hover  ul
{
	color:#C7272F;
	display:block;	
	
}

ul.makeMenu  li
{
	display:inline;
	
}

ul.makeMenu li a:hover span, makeMenu li .current span{
						height:13px;
						display:block;
						float:left;
					}
ul.makeMenu li .current{					    
						display:block;
						float:left;
						height:13px;				
							
						color:#ffffff;
						text-decoration:none;
						padding:0 15px;		
					}
					


ul.makeMenu li.CSStoHighlight {
 
  color:#C7272F;                 /* makes the active menu item text black */ 
}
ul.makeMenu ul.CSStoShow {     /* must not be combined with the next rule or IE gets confused */
  display: block;              /* specially to go with the className changes in the behaviour file */
}

ul.makeMenu li a.CSStoHighLink 
{ 
color:#C7272F; 
}

</style>
<!--[if gt IE 5.0]><![if lt IE 7]>
<style type="text/css">
/* that IE 5+ conditional comment makes this only visible in IE 5+ */
ul.makeMenu li {  /* the behaviour to mimic the li:hover rules in IE 5+ */
  behavior: url( IEmen.htc );
}
ul.makeMenu ul {  /* copy of above declaration without the > selector, except left position is wrong */
    position:absolute;
	left:20px;
	top:-1px;
	display:none;
	list-style:none;	
	
  }
</style>
<![endif]><![endif]-->

<?php
include("modules/script/script.php");
?>


<?php
/*echo '<script type="text/javascript" language="javascript" src="'.$objtemplatep->path_template.'styles/lytebox.js"></script>';
echo '<link rel="stylesheet" href="'.$objtemplatep->path_template.'styles/lytebox.css" type="text/css" media="screen" />';*/
?>

<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
#Layer1 {
	position: absolute;	
	left:502px;
	top:532px;
	width:674px;
	height:52px;
	z-index:16;
}


.cuadrofondo {
   opacity:0.86;
	background-image: url(templates/nproforestalv2/images/fondocuadro.gif);
	padding: 0px;
	height: 223px;
	width: 367px;
}
-->
</style>
<div id="opcionejecutardiv2" style="position: absolute; opacity: 10; display: none; padding-left: 3px; padding-top: 3px; padding-right: 3px; width: 240px; height: 30px; line-height: 30px; border: 1px solid #990000; color: #336699; font-weight: bold; background-color: #ffffff; left: 400px; top: 250px;">
 <span class="txtdonar">Espere un momento por favor...</span></div>
 

</head>
<body>


<link rel="stylesheet" type="text/css" href="<?php echo $objtemplatep->path_template ?>styles/contentslider.css" />
<script type="text/javascript" src="<?php echo $objtemplatep->path_template ?>styles/contentslider.js">

/***********************************************
* Featured Content Slider-  Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/

</script>
<link href="<?php echo $objtemplatep->path_template ?>styles/style.css" rel="stylesheet" type="text/css">
<?php

include($objtemplatep->path_template."subpanel/contenido.php");


?>
<div id="menuf" style="position: absolute; opacity: 10; display: none; padding-left: 3px; padding-top: 3px; padding-right: 3px; width: 750px; height: 550px; line-height: 3px; border: 1px solid #990000; color: #336699; font-weight: bold; background-color: #000000; left: 50%; top: 50%; z-index:15; margin-left:-375px; margin-top:-275px;">
<div style="z-index:20; position:relative;">
<div id=txtHintcontenido>



</div>
  </div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2452731-9");
pageTracker._trackPageview();
} catch(err) {}</script>
 <script type="text/javascript">
                    window.addEvent('domready',function(){
                        Lightbox.init({descriptions: '.lightboxDesc', showControls: true});
                    });
 </script>
 


 
</body>
</html>
