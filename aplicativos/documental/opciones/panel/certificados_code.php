<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{


$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
 // include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 


$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
?>
<style type="text/css">
<!--
.css_uno {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000000;
}
.css_dos {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

/* standard list style table */
table.adminlist {
	background-color: #FFFFFF;
	margin: 0px;
	padding: 0px;
	border: 1px solid #ddd;
	border-spacing: 0px;
	width: 70%;
	border-collapse: collapse;
}

table.adminlist th {
	margin: 0px;
	padding: 6px 4px 2px 4px;
	height: 25px;
	background-repeat: repeat;
	font-size: 11px;
	color: #000;
}
table.adminlist th.title {
	text-align: left;
}

table.adminlist th a:link, table.adminlist th a:visited {
	color: #c64934;
	text-decoration: none;
}

table.adminlist th a:hover {
	text-decoration: underline;
}

table.adminlist tr.row0 {
	background-color: #F9F9F9;
}
table.adminlist tr.row1 {
	background-color: #FFF;
}
table.adminlist td {
	border-bottom: 1px solid #e5e5e5;
	padding: 6px 4px 2px 15px;
}
table.adminlist tr.row0:hover {
	background-color: #f1f1f1;
}
table.adminlist tr.row1:hover {
	background-color: #f1f1f1;
}
table.adminlist td.options {
	background-color: #ffffff;
	font-size: 8px;
}
select.options, input.options {
	font-size: 8px;
	font-weight: normal;
	border: 1px solid #999999;
}
/* standard form style table */
-->
</style><br /><br />
<div align="center">
  <table width="800" border="0" cellpadding="4" cellspacing="4">
    <tr>
      <td class="css_uno">CI PACIENTE: </td>
      <td><span class="css_uno">CI PROFESIONAL: </span></td>
      <td class="css_uno">FECHA DESDE: </td>
      <td><span class="css_uno">FECHA HASTA:</span></td>
    </tr>
    <tr>
      <td class="css_uno"><input name="ci_paciente" type="text" id="ci_paciente" style="width:220px" class="form-control" /></td>
      <td><input name="ci_medico" type="text" id="ci_medico" style="width:220px" class="form-control" /></td>
      <td class="css_uno"><input name="fechai" type="text" id="fechai" style="width:220px" class="form-control" /></td>
      <td>
        <input name="fechaf" type="text" id="fechaf" style="width:220px" class="form-control" />      </td>
    </tr>
    <tr>
      <td class="css_uno">ESPECIALIDAD:</td>
      <td class="css_uno">TIPO CERTIFICADO:</td>
      <td class="css_uno">N&Uacute;MERO D&Iacute;AS OTORGADOS:</td>
      <td class="css_uno">&nbsp;</td>
    </tr>
    <tr>
      <td class="css_uno"><select name="tab_name" id="tab_name" style="width:220px" class="form-control" >
        <?php
	         echo '<option value="">---Todos--</option>';
			 $lista_tablas_diag="select distinct gogess_sistable.tab_name,tab_title from gogess_sisfield inner join gogess_sistable on gogess_sisfield.tab_name=gogess_sistable.tab_name where ttbl_id=1 and  gogess_sistable.tab_name in ('dns_anamesisexamenfisico','dns_traumatologiaanamesis','dns_hospitalanamesis')";
             $rs_diagnost = $DB_gogess->executec($lista_tablas_diag,array());
			 if ($rs_diagnost)
			   {
			      while (!$rs_diagnost->EOF) {
				  
				  echo '<option value="'.$rs_diagnost->fields["tab_name"].'">'.$rs_diagnost->fields["tab_title"].'</option>';
				  
				  $rs_diagnost->MoveNext();
				  }
				}  
	  ?>
      </select></td>
      <td class="css_uno"><select name="certif_id" id="certif_id" style="width:220px" class="form-control" >
        <?php
	         echo '<option value="">---Seleecionar--</option>';
			 $objformulario->fill_cmb("dns_certificados","certif_id,certif_titulo ","","where certif_activo=1 order by certif_titulo asc",$DB_gogess);	
	  ?>
      </select></td>
      <td class="css_uno"><input name="nd_otorgado" type="text" id="nd_otorgado" style="width:220px" class="form-control" /></td>
      <td class="css_uno">&nbsp;</td>
    </tr>
    <tr>
      <td class="css_uno">&nbsp;</td>
      <td>&nbsp;</td>
      <td class="css_uno">&nbsp;</td>
      <td><input type="button" name="Button" value="GENERAR CERTIFICADO" class="form-control" onClick="ver_pantalla()"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  
  <div id="pantalla_word">
  
  
  </div>
  
  
  </div><br>
  
  <div align="center">
   <b>HISTORIAL DE CERTIFICADOS</b>
   <table width="600" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>Buscar Certificado CI PACIENTE: </td>
      <td><input name="cedula_valor" type="text" id="cedula_valor" class="form-control" /></td>
      <td><input type="button" name="Button" value="Buscar" class="form-control" onclick="ver_listacert()" /></td>
    </tr>
    <tr>
      <td colspan="3"><div id="lista_cert" ></div></td>
    </tr>
  </table>
  </div>
  <br>
<?php
}
?>

<script type="text/javascript">
<!--
function ver_listacert()
{

 $("#lista_cert").load("certificados/lista_certificados.php",{
    cedula_valor:$('#cedula_valor').val()

  },function(result){  



  });  

  $("#lista_cert").html("Espere un momento..."); 
  

}

function imp_cert_anterior(id)
{
  
   window.open('certificados/certificado_standarlog.php?id_gen='+id, '_blank');
  
}


function imp_cert()
{
   if($('#id_gen').val()>0)
   {
   
   window.open('certificados/certificado_standarlog.php?id_gen='+$('#id_gen').val(), '_blank');
   }
   else
   {
    alert("Guarde el Certificado para Imrimir");
   
   }
}

function ver_pantalla()
{

$("#pantalla_word").load("certificados/word.php",{
ireport:$('#certif_id').val(),
c1:$('#ci_paciente').val(),
c2:$('#ci_medico').val(),
fechai:$('#fechai').val(),
fechaf:$('#fechaf').val(),
tab_name:$('#tab_name').val(),
nd_otorgado:$('#nd_otorgado').val()

  },function(result){  



  });  

  $("#pantalla_word").html("Espere un momento...");  

}

//  End -->
</script>

<script type="text/javascript">
<!--
$( "#fechai" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fechaf" ).datepicker({dateFormat: 'yy-mm-dd'});


//  End -->
</script>