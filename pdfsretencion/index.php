<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Lista</title>


<link type="text/css" href="../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/ui.mask.js"></script>
<script language="javascript" type="text/javascript" src="../js/ui.datepicker-es.js"></script>
<script type="text/javascript" src="../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/additional-methods.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<script type="text/javascript" src="../js/jquery.printPage.js"></script>

<script type="text/javascript" src="../js/jquery.formatCurrency.js"></script>
<script src="../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="js/jquery.fixheadertable.js"></script>


<script type="text/javascript">
<!--

function lista_facturas()
{
  
   $("#id_listar").load("lista.php",{
   
   n_fac:$('#n_fac').val()

  },function(result){  

  });  
  $("#id_listar").html("Espere un momento...");  

}


//  End -->
</script>


</head>

<body>
<label>Buscar
<input name="n_fac" type="text" id="n_fac" />
</label>
<input type="button" name="Submit" value="Enviar" onclick="lista_facturas()" />
<br><CENTER><B>LISTA RETENCIONES</B><CENTER>
<div id="id_listar" align="center">

</div>

<script type="text/javascript">
<!--
lista_facturas();
//  End -->
</script>
</body>
</html>
