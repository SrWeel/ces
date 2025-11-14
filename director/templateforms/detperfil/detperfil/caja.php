<link href="<?php echo $pathc.$objtableform->path_templateform ?>formatoper.css" rel="stylesheet" type="text/css">
<table  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="479" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="6" height="1" border="0" alt=""></td>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="467" height="1" border="0" alt=""></td>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="6" height="1" border="0" alt=""></td>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="1" height="1" border="0" alt=""></td>
      </tr>
      <tr>
        <td><img name="caja_r1_c1" src="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r1_c1.gif" width="6" height="5" border="0" alt=""></td>
        <td background="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r1_c2.gif"><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r1_c2.gif"></td>
        <td><img name="caja_r1_c3" src="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r1_c3.gif" width="6" height="5" border="0" alt=""></td>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="1" height="5" border="0" alt=""></td>
      </tr>
      <tr>
        <td background="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r2_c1.gif">&nbsp;</td>
        <td  valign="top">
          <?php
$objformulario->sendvar["per_idex"]=$listab;
$objformulario->generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,1);  
?>
          <input name="listab" type="hidden" id="listab" value="<?php echo $listab; ?>">
          <input name="obp" type="hidden" id="obp" value="=">
          <input name="campo" type="hidden" id="campo" value="per_id">
          <br>
        </td>
        <td background="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r2_c3.gif">&nbsp;</td>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="1" height="248" border="0" alt=""></td>
      </tr>
      <tr>
        <td><img name="caja_r3_c1" src="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r3_c1.gif" width="6" height="5" border="0" alt=""></td>
        <td background="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r3_c2.gif"><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r3_c2.gif"></td>
        <td><img name="caja_r3_c3" src="<?php echo $pathc.$objtableform->path_templateform ?>images/caja_r3_c3.gif" width="6" height="5" border="0" alt=""></td>
        <td><img src="<?php echo $pathc.$objtableform->path_templateform ?>images/spacer.gif" width="1" height="5" border="0" alt=""></td>
      </tr>
    </table></td>
    <td valign="top"><?php 
	$objbotones->table="gogess_perfil";
	$objbotones->sessid=$sessid;
	$objbotones->csearch=$listab;
	$objbotones->imagen="pboton.gif";
	$objbotones->csstexto="aquboton";
	$objbotones->target="_top";
	$objbotones->titulo_boton="Regresar a PERFIL";
	$objbotones->alt="Regresar a PERFIL";
	$objbotones->boton_backnivel1($csearch,$objtemplate->path_template,$fimp); 
	?></td>
  </tr>
</table>
<?php        printf("<input name='valores' type='hidden' value=''><input name='csearch' type='hidden' value=''><input name='idab' type='hidden' value=''><input name='opcion' type='hidden' value='guardar'><input name='table' type='hidden' value='%s'><input name='sessid' type='hidden' value='%s'>",$table,$sessid); ?>