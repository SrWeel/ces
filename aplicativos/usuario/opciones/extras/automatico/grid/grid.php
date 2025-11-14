<?php
include("../../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director="../../../../../../";
include ("../../../../../../cfgclases/clases.php");
?>
<style type="text/css">
<!--
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}
.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<table width="300" border="0" cellpadding="0" cellspacing="2">        
         <tr>
		 <td nowrap bgcolor="#ECF2EE" class="Estilo3">Fecha</td>
		    <td nowrap bgcolor="#ECF2EE" class="Estilo3">Archivo</td>
		  
		    <td nowrap bgcolor="#ECF2EE" class="Estilo3">Doc. </td>
		    <td nowrap bgcolor="#ECF2EE" class="Estilo3">Comp. NUM</td>
            <td nowrap bgcolor="#ECF2EE" class="Estilo3">Reg</td>
            <td nowrap bgcolor="#ECF2EE" class="Estilo3">No Reg</td>
            
		    <td nowrap bgcolor="#ECF2EE" class="Estilo3">&nbsp;</td>
		    <td nowrap bgcolor="#ECF2EE" class="Estilo3">&nbsp;</td>
		    <td nowrap bgcolor="#ECF2EE" class="Estilo3">&nbsp;</td>
             
            <td nowrap bgcolor="#ECF2EE" class="Estilo3">&nbsp;</td>
            <td nowrap bgcolor="#ECF2EE" class="Estilo3">&nbsp;</td>
            <td nowrap bgcolor="#ECF2EE" class="Estilo3">ESTADO</td>
  </tr>
  
  <?php
   $selecTablaxx="select auto_titulo,tipocmp_codigo from kyradm_automatico where auto_id=".$_POST["pauto_id"];  

   $rs_gogessformxx = $DB_gogess->Execute($selecTablaxx);
   

  
  if($_POST["cd_aut"])
  {
           $buscaestad="select * from factura_listacargados where emp_id=".$_SESSION['ces1313777_sessid_idempresa']." and listcg_estado='AUTORIZADO' and listcg_origen='".$rs_gogessformxx->fields["auto_titulo"]."-AUTOMATICO' order by listcg_fechaemision desc";
  }
  else
  {
	  $buscaestad="select * from factura_listacargados where emp_id=".$_SESSION['ces1313777_sessid_idempresa']." and not(listcg_estado='AUTORIZADO') and listcg_origen='".$rs_gogessformxx->fields["auto_titulo"]."-AUTOMATICO' order by listcg_fechaemision desc";
  }
			
			//echo $buscaestad;	
				$rs_estadol = $DB_gogess->Execute($buscaestad);
				if($rs_estadol)
				{   
				   while (!$rs_estadol->EOF) {	
				   
				   $listcg_firma=$rs_estadol->fields["listcg_firma"];
				   $listcg_id=$rs_estadol->fields["listcg_id"];
				   
				   $listcg_srirecibido=$rs_estadol->fields["listcg_srirecibido"];
				   $listcg_sriautorizado=$rs_estadol->fields["listcg_sriautorizado"];
				   $listcg_numerofacturas=$rs_estadol->fields["listcg_numerofacturas"];
				   
				   $listcg_claveAcceso=$rs_estadol->fields["listcg_claveacceso"];
				   
				   $grupos=$listcg_numerofacturas/1;
				   $cortanum=explode(".",$grupos);
				   if($cortanum[1]>0)
				   {
				   $grupos=$cortanum[0]+1;
				   }
				   else
				   {
				   $grupos=$cortanum[0];
				   }
				   $cantidadporgrupo=$opcg_cantidadporlote;
				   
				   
				   //cantidad firmados
			
				
				$buscafirmados="select count(listcgd_firma) as totalfirma from factura_detallista where listcgd_firma='SI' and listcgd_archivobase='".$rs_estadol->fields["listcg_archivo"]."'";
				
			
				$okcantidadfirma = $DB_gogess->Execute($buscafirmados); 
				$totalfirmados=$okcantidadfirma->fields["totalfirma"];
				//cantidad firmados
				   
				 ?>
				 
                 
          <tr>
            <td width="21" bgcolor="#ECF2EE"><span class="Estilo5"><?php echo $rs_estadol->fields["listcg_fechaemision"] ?></span></td>
            <td width="21" bgcolor="#ECF2EE"><span class="Estilo5"><?php echo $rs_estadol->fields["listcg_archivo"] ?></span></td>
           
            <td width="9" bgcolor="#ECF2EE"><?php echo $listcg_numerofacturas  ?>&nbsp;</td>
            <td width="10" bgcolor="#ECF2EE"><?php echo  $grupos; ?>&nbsp;</td>
            
            <td width="21" bgcolor="#ECF2EE"><span class="Estilo5"><?php echo $rs_estadol->fields["listcg_registrados"] ?></span></td>
            <td width="21" bgcolor="#ECF2EE"><span class="Estilo5"><?php echo $rs_estadol->fields["listcg_noregistrados"] ?></span></td>
            <td width="93" bgcolor="#ECF2EE"><span class="Estilo5">
            <!--
              <input type="button" name="Submit2" value="Genear xml" onClick="generar_xml('<?php echo $rs_estadol->fields["listcg_archivo"]  ?>','<?php echo $grupos ?>','<?php echo $cantidadporgrupo ?>','<?php  echo $banderaexiste ?>','<?php echo $listcg_numerofacturas ?>')"  >
            -->
            </span></td>
            <td width="100" align="center" bgcolor="#ECF2EE"><span class="Estilo5">
            
            <?php
			if($rs_estadol->fields["listcg_estado"]!='AUTORIZADO')
             {
				 //---------------------------
			if($totalfirmados!=$grupos)
			{
				if($grupos>0)
				{
			?>
            
              <input type="button" name="Submit3" value="Firmar Lote"  onClick="firmar_documentos('<?php echo $rs_estadol->fields["listcg_archivo"]  ?>','<?php echo $grupos ?>','<?php echo $cantidadporgrupo ?>','<?php  echo $banderaexiste ?>',$('#clave_firma_v').val(),1,'<?php echo $rs_gogessformxx->fields["tipocmp_codigo"] ?>')" >
              
              <?php
				}
				
				
				}
				else
				{
				echo "<b>Documentos ya fueron firmados...</b>";	
					
				}
				  //--------------------------
			 }
			 else
			 {
				 echo "<b>Documentos ya fueron firmados, autorizados...</b>";	
				 
			 }
			  ?>
              
            </span></td>
            <td width="54" bgcolor="#ECF2EE">
            
            <input name="Submit4" type="button" value=" SRI" onclick="lista_sri('<?php echo $rs_estadol->fields["listcg_archivo"] ?>','<?php echo $_POST["pauto_id"]; ?>')" >            </td>
            
           
            
            <td width="54" bgcolor="#ECF2EE">
            <?php
            if($rs_estadol->fields["listcg_estado"]!='AUTORIZADO')
             {
				 ?>
            <input name="Submit5" type="button" onclick="vaciar_automatico('<?php echo $rs_estadol->fields["listcg_archivo"]  ?>','<?php echo $_POST["pauto_id"]; ?>')" value="Vaciar automatico" />
            <?php
			 }
			 ?>            </td>
		    <td width="54" bgcolor="#ECF2EE"><input type="button" name="button" id="button" value="Log de automatico" onclick="abrir_standar('aplications/usuario/opciones/extras/automatico/verlog.php','LOG','divBody_logc','divDialog_logc',690,500,'<?php echo $rs_estadol->fields["listcg_archivo"] ?>',0,0,0,0,0,0)" /></td>
            
            <td width="21" bgcolor="#ECF2EE"><span class="Estilo5"><?php echo $rs_estadol->fields["listcg_estado"] ?></span></td>
		  </tr>
                 
                 
                 
                 
				 <?php
				   $rs_estadol->MoveNext();
				   }
				
				}  
  
  
  ?>
  	  </table> 
<div id=divBody_arch ></div>
<div id=divBody_logc ></div>
<div id=divBody_proceso ></div>