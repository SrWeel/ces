<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
   <!-- Bootstrap -->

    <link href="<?php echo $objtemplatep->path_template ?>/menu/css/font-awesome.min.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $objtemplatep->path_template ?>dependencies/bootstrap/css/bootstrap.min.css" type="text/css">

    <link href="http://fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css">

    <link href="<?php echo $objtemplatep->path_template ?>/menu/css/hoe.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

<link type="text/css" href="<?php echo $objtemplatep->path_template ?>css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	

<link type="text/css" href="<?php echo $objtemplatep->path_template ?>css/jquery.dataTables.min.css" rel="stylesheet" />	



 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="<?php echo $objtemplatep->path_template ?>/menu/js/1.11.2.jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="<?php echo $objtemplatep->path_template ?>/menu/js/bootstrap.min.js"></script>

<link type="text/css" href="<?php echo $objtemplatep->path_template ?>css/responsive.dataTables.min.css" rel="stylesheet" />	

<link type="text/css" href="<?php echo $objtemplatep->path_template ?>css/buttons.dataTables.min.css" rel="stylesheet" />	



 <link rel="stylesheet" href="<?php echo $objtemplatep->path_template ?>css/core.css" type="text/css" />

 

 

<link rel="stylesheet" type="text/css" href="<?php echo $objtemplatep->path_template ?>/css/jquery.datetimepicker.min.css" >

<script src="<?php echo $objtemplatep->path_template ?>/js/jquery.datetimepicker.full.min.js"></script>

<script type="text/javascript" src="<?php echo $objtemplatep->path_template ?>js/jquery.printPage.js"></script>

<script type="text/javascript" src="director/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="director/ckeditor/adapters/jquery.js"></script>

 <link rel="stylesheet" href="<?php echo $objtemplatep->path_template ?>css/wickedpicker.min.css" type="text/css">
 <script src="<?php echo $objtemplatep->path_template ?>js/jMonthCalendar.js" type="text/javascript"></script>
 <script src="<?php echo $objtemplatep->path_template ?>js/wickedpicker.min.js" type="text/javascript"></script>
 
 
 <script language="JavaScript" type="text/javascript">
 $(window).on('mouseover', (function () {
    window.onbeforeunload = null;
}));
$(window).on('mouseout', (function () {
    window.onbeforeunload = ConfirmLeave;
}));
function ConfirmLeave() {
    return "";
}
var prevKey="";
$(document).keydown(function (e) {            
    if (e.key=="F5") {
        window.onbeforeunload = ConfirmLeave;
    }
    else if (e.key.toUpperCase() == "W" && prevKey == "CONTROL") {                
        window.onbeforeunload = ConfirmLeave;   
    }
    else if (e.key.toUpperCase() == "R" && prevKey == "CONTROL") {
        window.onbeforeunload = ConfirmLeave;
    }
    else if (e.key.toUpperCase() == "F4" && (prevKey == "ALT" || prevKey == "CONTROL")) {
        window.onbeforeunload = ConfirmLeave;
    }
    prevKey = e.key.toUpperCase();
});
</script>

<link rel="stylesheet" href="<?php echo $objtemplatep->path_template ?>select/css/select2.min.css" type="text/css">
<script src="<?php echo $objtemplatep->path_template ?>select/js/select2.min.js" type="text/javascript"></script>
 