<?php



//ini_set('display_errors',1);



//error_reporting(E_ALL);

header('Content-Type: text/html; charset=UTF-8');



include("../../cfgclases/sessiontime.php");



ini_set("session.cookie_lifetime",$tiempossss);



ini_set("session.gc_maxlifetime",$tiempossss);



session_start();



if($_SESSION['sessidadm1777_pichincha'])



{



$director="../../";



include ("../../cfgclases/clases.php");


$lista_anchoalto="select * from app_impresion where imp_id=".$_GET["iddibujo"];
$rs_anchoalto = $DB_gogess->Execute($lista_anchoalto); 

$ancho=$rs_anchoalto->fields["imp_ancho"]*37.79527559055118;
$alto=$rs_anchoalto->fields["imp_alto"]*37.79527559055118;
$tm=$rs_anchoalto->fields["imp_letratm"];
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml">



<head>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<title>Documento sin t&iacute;tulo</title>





<link type="text/css" href="../../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	



<script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>

<script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>

<script language="javascript" type="text/javascript" src="../../js/jquery.corner.js"></script>

<script language="javascript" type="text/javascript" src="../../js/ui.mask.js"></script>

<script type="text/javascript" src="../../js/jquery.timer2.js"></script> 

<script type="text/javascript" src="../../js/jquery.validate.js"></script>

<script type="text/javascript" src="../../js/additional-methods.js"></script>

<script type="text/javascript" src="../../js/jquery.form.js"></script>

<script type="text/javascript" src="../../js/jquery.fixheadertable.js"></script>

<script src="../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>





<style type="text/css">



<!--



#divcoordenada{



	top:0px;



	left:0px;



	position: absolute;	



}



#actualizando_div



{



top:0px;



	left:0px;



position: absolute;



z-index:99



}







-->



</style>



<style type="text/css">



<!--



#contenedor_imp {



	font-size: 11px;



	font-style: normal;



	font-family: Verdana, Arial, Helvetica, sans-serif;



	height: 700px;



	width: 700px;



	top:0px;



	left:0px;



	position: relative;



}







<?php



$listacamposcss="select * from app_impresioncampos where imp_id=".$_GET["iddibujo"];







 $rs_camposcss = $DB_gogess->Execute($listacamposcss); 



   if($rs_camposcss)



   {



			 while (!$rs_camposcss->EOF) {



			 



			 echo '#'.$rs_camposcss->fields["impcamp_campo"] .'_div { top:'.$rs_camposcss->fields["impcamp_y"].'px; left:'.$rs_camposcss->fields["impcamp_x"].'px;



			  position: absolute;

			 border: 1px solid #999999;
			 
			 font-size: '.$tm.'px;

			 font-style: normal;
		
			 font-family: Verdana, Arial, Helvetica, sans-serif;



			  }



			 ';



			 



			 $rs_camposcss->MoveNext();



			 }



   }







?>



-->



</style>







<script>











 $(function() {



<?php



$listacamposcss="select * from app_impresioncampos where imp_id=".$_GET["iddibujo"];



 $rs_camposcss = $DB_gogess->Execute($listacamposcss); 



   if($rs_camposcss)



   {



			 while (!$rs_camposcss->EOF) {



			 



					 



			 echo '$( "#'.$rs_camposcss->fields["impcamp_campo"] .'_div" ).draggable({



			 



			  drag: function(ev_'.$rs_camposcss->fields["impcamp_id"].', ui) {



				



				  		   



				   



				},



				



			 stop: function(ev_'.$rs_camposcss->fields["impcamp_id"].', ui) {



			 



			



			   guardar_posicion('.$rs_camposcss->fields["impcamp_id"].',$(this).position().left,$(this).position().top);



			 }	



			 



			 });



			 



			 ';



			 



			 $rs_camposcss->MoveNext();



			 }



   }



?> 











});







function guardar_posicion(idcampo,x,y)



{







  $("#actualizando_div").load("actualizar_xy.php",{



    pidcampo:idcampo,



	px:x,



	py:y



  },function(result){  



      



  });  



  $("#actualizando_div").html("Espere un momento...");  







}



</script>







</head>







<body>



 <div id=actualizando_div ></div>



 <table width="<?php echo $ancho; ?>px" height="<?php echo $alto; ?>px" border="0" cellpadding="0" cellspacing="0">



        <tr>



         <td valign="top" background="../../images/hojacajacm.png">


		  <?php



$listacamposcss="select * from app_impresioncampos where imp_id=".$_GET["iddibujo"];



 $rs_camposcss = $DB_gogess->Execute($listacamposcss); 



   if($rs_camposcss)



   {



			 while (!$rs_camposcss->EOF) {



			 



	



			   echo '<div id='.$rs_camposcss->fields["impcamp_campo"] .'_div >'.$rs_camposcss->fields["impcamp_campo"].'</div>';



			 



			 $rs_camposcss->MoveNext();



			 }



   }







?>		  </td>



        </tr>



      </table>



</body>



</html>



<?php



}



?>