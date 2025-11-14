<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime","460000");
ini_set("session.gc_maxlifetime","460000");
session_start();
$director="../adm_alianzanorte/";
include ("../adm_alianzanorte/cfgclases/clases.php");
  
@$_SESSION['formularioweb_ac']=0;
if(@$_SESSION['formularioweb_clie_id'])
{
?>	

<div class="form-group">
<div class="col-xs-12">
<?php
$comill_s="'";
$carr_id=$_POST["pVar1"];
$lista_banner="select * from app_banner where bann_activo=1 order by bann_id desc";
$rs_banner = $DB_gogess->Execute($lista_banner);	

if($rs_banner->fields["bann_banner"]!='')
{
?>
<center>
	<div class="banner">	
	<img src="../archivo/<?php echo $rs_banner->fields["bann_banner"]; ?>" alt="Responsive image">
	</div>
</center>
<?php
}
else
{
?>
<center>
	<img  id="u3700" src="images/logo.png?crc=<?php echo date("YmdHis"); ?>" alt=""  >
</center>
<?php
}
?>

<?php
echo '<div align="center"><br>';
$lista_dis="select * from disi_discipuladores inner join app_cliente on disi_discipuladores.clie_id=app_cliente.clie_id inner join bib_discipulado on disi_discipuladores.carr_id=bib_discipulado.carr_id where bib_discipulado.carr_id='".$carr_id."';";
$rs_listadis = $DB_gogess->Execute($lista_dis);	
	
echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px' ><b>".$rs_listadis->fields["carr_nombre"]."</b><BR> Lista<br></div>";


echo '<br><table data-role="table" id="table-column-toggle" data-mode="columntoggle" class="ui-responsive table-stroke"  border="1" cellpadding="0" cellspacing="0">
     <thead>
       <tr  >
		 <th data-priority="1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px" ><center>Asiste</center></th>
		 <th data-priority="1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px" ><center>Apellidos</center></th>
         <th data-priority="1" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px" ><center>Nombres</center></th>
         
       </tr>
     </thead>
	 <tbody>
 ';	

 $listaalumnos="select * from disi_asistentes inner join app_cliente on disi_asistentes.clie_id=app_cliente.clie_id where carr_id='".$carr_id."' order by clie_apellido asc";

  $resultado = $DB_gogess->Execute($listaalumnos);
	if($resultado)
			  {
			     while (!$resultado->EOF) 
			     {	
				    
					$cheke='';
				    echo '<tr '.$color_fila.' >';
					echo '<td><center><label><input name="checke_asis_'.$resultado->fields["clie_id"].'" id="checke_asis_'.$resultado->fields["clie_id"].'" class="largerCheckbox" type="checkbox" value="'.$resultado->fields["clie_id"].'"  onClick="" '.$cheke.' ></label></center></td>';
					
					echo '<td  class="nombre_ccss" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" >'.$resultado->fields["clie_apellido"].'</td><td  class="nombre_ccss" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px" >'.$resultado->fields["clie_nombre"].'</td>';
				 
				 
				   $resultado->MoveNext();
				 }
			  }	 

 

echo '</tbody></table>'; 


//busca disponibles

echo "<br><div id='div_disponble' style='font-size:14px' ><input name='fecha_parareservar' type='hidden' id='fecha_parareservar' value='0' /><br><br><br></div>";

//busca si ya esta registrado

?>
</div>
</div>


<center>
<br><br>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="https://www.facebook.com/IglesiaAlianzaNorte" target="_blank"><img src="images/facebook.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
    <td><a href="https://www.instagram.com/iglesia_alianzanorte" target="_blank"><img src="images/instagram.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
    <td><a href="https://www.youtube.com/c/IglesiaAlianzaNorte" target="_blank"><img src="images/youtube.png?sn=<?php echo date("YmnHis"); ?>" width="50" height="50" /></a></td>
  </tr>
</table>
</center>

<script type="text/javascript">
<!--

function asignaquita_campos(id,campo)
{
 var concatena;
 var anterior;
 var actual;
 var linea = new String();
 if($('#'+campo).prop('checked')==true)
 {
    concatena=id+",";
	anterior=$('#id_seleccionado').val();
	actual=anterior+concatena;
	$('#id_seleccionado').val(actual);
 
 }
 else
 {
    concatena=id+",";
    linea=$('#id_seleccionado').val();
	linea = linea.replace(concatena, "");
    $('#id_seleccionado').val(linea);
 }

}

function guarda_campo(inv_id,campo,tabla)
{
   $("#g_datos").load("guarda_campo.php",{
   inv_id:inv_id,
   clie_id:'<?php echo $_SESSION['formularioweb_clie_id']; ?>',
   campo:campo,
   tabla:tabla,
   valor:$('#'+campo+'_'+inv_id).val()
   
  },function(result){  

	  
  });  

  $("#g_datos").html("Espere un momento...");  


}

function reserva_lafecha()
{
  if($('#even_id').val()=='')
  {
    alert("Seleccione el culto por favor...");
    return false;
  }
  
  $("#ya_esta").load("reservando_fecha.php",{
   fecha_rserva:$('#fecha_parareservar').val(),
   clie_id:'<?php echo $_SESSION['formularioweb_clie_id']; ?>',
   id_seleccionado:$('#id_seleccionado').val(),
   even_id:$('#even_id').val()
   
  },function(result){  

     // disponible();
	  
  });  

  $("#ya_esta").html("Espere un momento...");  

}

function reserva_cancelar()
{
  
var r = confirm("Esta seguro en cancelar la reserva!");
if (r == true) {
  
//---------------------------------------------  
   $("#ya_esta").load("cancelar_fecha.php",{
   fecha_rserva:$('#fecha_parareservar').val(),
   even_id:$('#even_id').val(),
   clie_id:'<?php echo $_SESSION['formularioweb_clie_id']; ?>'
   
  },function(result){  

      abrir_standar('op_reserva.php','divBody_lista',0,0,0,0,0,0,0);
	  
  });  

  $("#ya_esta").html("Espere un momento...");  
//---------------------------------------------  
  
}   

}

function disponible()
{
   if($('#even_id').val()!='')
   {  
	   $("#div_disponble").load("disponible.php",{
	   fecha_rserva:'<?php echo $fecha_rserva; ?>',
	   even_id:$('#even_id').val()
	  },function(result){  
	
	
	  });  
	
	  $("#div_disponble").html("Espere un momento...");  
  }
  else
  {
       $("#div_disponble").html("");  
  }
  
}


//  End -->
</script>

<?php
}
?>
