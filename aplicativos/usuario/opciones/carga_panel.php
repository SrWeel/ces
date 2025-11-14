<script language="javascript">
<!--

function ejecutar_automatico()
{

  $("#div_automatico").load("automatico/ejecutar.php",{},function(result){  
     
	 grid_automatico($('#auto_id').val());
  });  
  $("#div_automatico").html("<img src='images/barra_carga.gif' width='220' height='40' />");

}


function lista_sri()
{
   $('#divBody_sri1').html("");
  $("#div_listasriaut").load("aplications/usuario/opciones/extras/automatico/sri_factura.php",{auto_id:$('#auto_id').val(),cd_aut:$('#cd_aut').val()},function(result){  
     
  });  
  $("#div_listasriaut").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function ejecutar_enviosri()
{

 var autorizapath;

  if($('#auto_id').val()=='1')
  {
  
    autorizapath='autoriza/envio_fac.php';
  }
   if($('#auto_id').val()=='3')
  {
  
    autorizapath='autoriza/envio_cre.php';
  }
  
  
   if($('#auto_id').val()=='5')
  {
  
    autorizapath='autoriza/envio_guia.php';
  }
  if($('#auto_id').val()=='2')
  {
  
    autorizapath='autoriza/envio_ret.php';
  }
  
  $("#div_enviosri").load(autorizapath,{},function(result){  
     
	
  });  
  $("#div_enviosri").html("<img src='images/barra_carga.gif' width='220' height='40' />");

}


function ejecutar_resultadosri()
{
 var autorizapath;
 
  if($('#auto_id').val()=='1')
  {
  
    autorizapath='autoriza/autoriza_fac.php';
  }
   if($('#auto_id').val()=='3')
  {
  
    autorizapath='autoriza/autoriza_cre.php';
  }
 
  
   if($('#auto_id').val()=='5')
  {
  
    autorizapath='autoriza/autoriza_guia.php';
  }
  if($('#auto_id').val()=='2')
  {
  
    autorizapath='autoriza/autoriza_ret.php';
  }
  
  $("#div_enviosri").load(autorizapath,{},function(result){  
     
	
  });  
  $("#div_enviosri").html("<img src='images/barra_carga.gif' width='220' height='40' />");

}




function envio_emailcli(xmlfact,idtipo)
{
 var path_envio
 if (confirm("Esta seguro que desea enviar el email al cliente?"))
	 { 
	 
	 if(idtipo=='01')
	 {
	 path_envio='aplications/usuario/opciones/extras/correos_cron/envio_email.php';
	 
	   $("#div_envioemail").load(path_envio,{
    pcomcab_id:xmlfact,email_extra:$('#email_extra').val()
  },function(result){  
    
	 $('#email_extra').val("");
//lista_sri();
	 
  });  
  $("#div_envioemail").html("Espere un momento..."); 
  
	 }
	 
	  if(idtipo=='04' || idtipo=='05')
	 {
	 path_envio='aplications/usuario/opciones/extras/correos_cron/envio_emailcre.php';
	 
	   $("#div_envioemail").load(path_envio,{
    pcomcabcre_id:xmlfact,email_extra:$('#email_extra').val()
  },function(result){  
    
	 $('#email_extra').val("");
//lista_sri();
	 
  });  
  $("#div_envioemail").html("Espere un momento..."); 
	 
	 }
	 



  if(idtipo=='07')
	 {
	 path_envio='aplications/usuario/opciones/extras/correos_cron/envio_emailsret.php';
	 
	   $("#div_envioemail").load(path_envio,{
    pcompretcab_id:xmlfact,email_extra:$('#email_extra').val()
  },function(result){  
    
	 $('#email_extra').val("");
lista_sri();
	 
  });  
  $("#div_envioemail").html("Espere un momento..."); 
	 
	 }


  
  
  }
  
}

function publicar_comprobante()
{

  $("#div_pubicando").load("publica/publica_comprobante.php",{},function(result){  
     
  });  
  $("#div_pubicando").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function publicar_credito()
{

  $("#div_pubicando").load("publica/publica_ncredito.php",{},function(result){  
     
  });  
  $("#div_pubicando").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function enviar_comprobante(idtipo)
{

  $("#div_enviomasivo").load("envio_masivo/envio.php",{},function(result){  
     
  });  
  $("#div_enviomasivo").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function enviar_comprobantec(idtipo)
{

  $("#div_enviomasivo").load("envio_masivo/envio_credito.php",{},function(result){  
     
  });  
  $("#div_enviomasivo").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}

function ver_sri1(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7)
{

  $("#"+divBody).load(urlpantalla,{pVar1:variable1},function(result){  
     
  });  
  $("#"+divBody).html("<img src='images/barra_carga.gif' width='220' height='40' />");


}



//-->
</script>
<style type="text/css">
<!--
.Estilo1 {	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.TableScroll {
        z-index:99;
		width:980px;
        height:550px;	
        overflow: auto;
      }
	  
-->
</style>


<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="498" valign="top"><div align="center">
	<?php
	if($_SESSION['usua_admx']==1)
	{
	?>
<div id=div_automatico >	
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td onclick="ejecutar_automatico()"><img src="images/subir_comprobante.png" width="128" height="128"></td>
  </tr>
</table>
</div>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td onclick="ejecutar_enviosri()"><img src="images/subir_sri.png" width="128" height="128"></td>
  </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td onclick="ejecutar_resultadosri()"><img src="images/subir_resultadosri.png" width="128" height="128"></td>
  </tr>
</table>

<?php
}
?>



    </div></td>
    <td width="402" valign="top">
	
	
	

	  <table width="1100" border="0" align="center" cellpadding="5" cellspacing="2">
        <tr>
          <td width="341" bgcolor="#CBDFE7"><div align="center" class="Estilo1">OPCIONES DE CARGA </div></td>
        </tr>
        <tr>
          <td valign="top" bgcolor="#F7F9F9"><div align="center">
              <select name="auto_id" id="auto_id">
                <option value="0">--Seleccionar--</option>
                <?php
	   $selecTabla="select * from kyradm_automatico where auto_activo='1'";   
  
		  $rs_gogessform = $DB_gogess->Execute($selecTabla);
		  if($rs_gogessform)
		  {
				while (!$rs_gogessform->EOF) {	
				
				echo '<option value="'.$rs_gogessform->fields["auto_id"].'">'.$rs_gogessform->fields["auto_titulo"].'</option>';
				
				$rs_gogessform->MoveNext();	   
				}
		  }		
	  ?>
              </select>
              <label for="cd_aut"></label>
              <select name="cd_aut" id="cd_aut">
			  <?php
			  if($_SESSION['usua_versoloautx']=='1')
			  {
			  ?>
              
                <option value="AUTORIZADO">AUTORIZADO</option>
               
			<?php
			}
			else
			{
			?>	
			<option value="" selected="selected">PENDIENTE</option>
                <option value="AUTORIZADO">AUTORIZADO</option>
                <option value="DEVUELTA">DEVUELTA</option>
                <option value="RECIBIDA">RECIBIDA</option>
                <option value="NO AUTORIZADO">NO AUTORIZADO</option>
			<?php
			}
			?>
              </select>
              <input type="button" name="Submit" value="Listar" onclick="lista_sri()" />
			  
			  <?php
			  if($_SESSION['usua_publicarx']=='1')
			  {
			  ?>
              <input type="button" name="Submit2" value="Publicar Facturas" onclick="publicar_comprobante()" />
			  <input type="button" name="Submit2" value="Publicar NCredito" onclick="publicar_credito()" />
			  <?php
			  }
			  ?>
			  
			   <?php
			  if($_SESSION['usua_enviomasivox']=='1')
			  {
			  ?>
              <input type="button" name="Submit22" value="Envio Masivo Facturas" onclick="enviar_comprobante($('#auto_id').val())" />
              <input type="button" name="Submit222" value="Envio Masivo NC" onclick="enviar_comprobantec($('#auto_id').val())" />
			    <?php
			  }
			  ?>
			  
          </div></td>
        </tr>
        <tr>
          <td valign="top">Email extra:
          <input name="email_extra" type="text" id="email_extra" size="50" /></td>
        </tr>
        <tr>
          <td valign="top">
		  
		  <div id="div_vaciar_automatico"></div>
              <div id="div_listaautomatico" ></div>
            <div id="div_firmar" ></div></td>
        </tr>
      </table>  
	  
	  
	  <table width="400" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div id="divBody_sri1"  ></div>

<!-- <textarea name="msg_error" cols="100" rows="3" id="msg_error"></textarea> -->
	</td>
  </tr>
</table>
	  <div id=div_envioemail ></div>
	  	
		<div id=div_enviomasivo >
	
	</div>
    <div id=div_listasriaut >	</div>
	</td>
    <td width="402" valign="top"><div id=div_pubicando ></div><div id=div_enviosri >&nbsp;</div></td>
  </tr>
</table>
<br><br>