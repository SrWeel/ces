<link href="styles/formato.css" rel="stylesheet" type="text/css">
<table width="179" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="179" valign="top" bgcolor="#A0DC6B"><table border="0" cellpadding="0" cellspacing="0" width="178">
      <!-- fwtable fwsrc="accesoindex.png" fwbase="accesoindex.jpg" fwstyle="Dreamweaver" fwdocid = "424464284" fwnested="0" -->
      <tr>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="6" height="1" border="0" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="161" height="1" border="0" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="9" height="1" border="0" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="2" height="1" border="0" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="4"><img name="accesoindex_r1_c1" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r1_c1.jpg" width="178" height="37" border="0" id="accesoindex_r1_c1" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="37" border="0" alt="" /></td>
      </tr>
      <tr>
        <td rowspan="2"><img name="accesoindex_r2_c1" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r2_c1.jpg" width="6" height="121" border="0" id="accesoindex_r2_c1" alt="" /></td>
        <td><a href="index.php?opcion=buscar&apl=7&secc=7&seccionp=23&system=14&sessid=<?php echo $sessid ?>"><img name="accesoindex_r2_c2" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r2_c2.jpg" width="161" height="110" border="0" id="accesoindex_r2_c2" alt="" /></a></td>
        <td rowspan="2" colspan="2"><img name="accesoindex_r2_c3" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r2_c3.jpg" width="11" height="121" border="0" id="accesoindex_r2_c3" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="110" border="0" alt="" /></td>
      </tr>
      <tr>
        <td><img name="accesoindex_r3_c2" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r3_c2.jpg" width="161" height="11" border="0" id="accesoindex_r3_c2" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="11" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3"><a href="index.php?apl=1&secc=7&system=14&sessid=<?php echo $sessid ?>"><img name="accesoindex_r4_c1" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r4_c1.jpg" width="176" height="35" border="0" id="accesoindex_r4_c1" alt="" /></a></td>
        <td rowspan="2"><img name="accesoindex_r4_c4" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r4_c4.jpg" width="2" height="37" border="0" id="accesoindex_r4_c4" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="35" border="0" alt="" /></td>
      </tr>
      <tr>
        <td colspan="3"><img name="accesoindex_r5_c1" src="<?php echo $objtemplatep->path_template ?>images/accesoindex_r5_c1.jpg" width="176" height="2" border="0" id="accesoindex_r5_c1" alt="" /></td>
        <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="2" border="0" alt="" /></td>
      </tr>
    </table>
      <img src="<?php echo $objtemplatep->path_template ?>images/menuimg.jpg" /><br />
        <table width="179" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="179" bgcolor="#A0DC6B"><?php
   $objcontenido->objetos_seccion(12,'i',$varsend,$system,2,$sessid);
     ?></td>
          </tr>
      </table></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#A0DC6B">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#7ECF36"><div align="center" class="linkvideo">Documentos</div></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF">
	
	<table width="179" border="0" cellpadding="0" cellspacing="1">
  
  <?php
  $listad="select * from asi_categoriap";
  $resultadol = mysql_query($listad);
  if($resultadol)
  {
  		while($rowl = mysql_fetch_array($resultadol)) 
			{	
  ?>
  <tr>
    <td width="514" bgcolor="#A0DC6B" class="Estilo3"><a href="index.php?catgp_id=<?php echo $rowl[catgp_id]; ?>&apl=25&secc=7&system=14&sessid=<?php echo $sessid ?>" class=linkdoc ><?php echo $rowl[catgp_nombre]; ?></a></td>
    </tr>
  <?php
            }
  }			
  
  ?>
</table>
	
	</td>
  </tr>
</table>

