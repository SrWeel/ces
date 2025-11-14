<!--Fireworks 8 Dreamweaver 8 target.  Created Tue Jan 13 12:06:12 GMT-0500 (SA Pacific Standard Time) 2009-->
<style type="text/css">
<!--
.accesohomestl {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
}
.stlalerta {	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FF0000;
	font-weight: normal;
}

-->
</style>
<?php
if (!($objtemplatep->path_template))
{
 $objtemplatep->path_template=$q4;
}
?>
<form name="sisacc" method="post">
  <span class="stlalerta"><?php echo $mensaje; ?></span>
  <table border="0" cellpadding="0" cellspacing="0" width="203">
    <!-- fwtable fwsrc="ingreso.png" fwbase="ing1.jpg" fwstyle="Dreamweaver" fwdocid = "551347071" fwnested="0" -->
    <tr>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="48" height="1" border="0" alt="" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="117" height="1" border="0" alt="" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="9" height="1" border="0" alt="" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="29" height="1" border="0" alt="" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="1" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="4"><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r1_c1.jpg" alt="" name="ing1_r1_c1" width="203" height="28" border="0" id="ing1_r1_c1" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="28" border="0" alt="" /></td>
    </tr>
    <tr>
      <td rowspan="4"><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r2_c1.jpg" alt="" name="ing1_r2_c1" width="48" height="58" border="0" id="ing1_r2_c1" /></td>
      <td background="<?php echo $objtemplatep->path_template ?>images/ing1_r2_c2.jpg"><div align="center">
        <input name="sisusu" type="text" class="accesohomestl" id="sisusu" size="18" />
      </div></td>
      <td rowspan="2" colspan="2"><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r2_c3.jpg" alt="" name="ing1_r2_c3" width="38" height="28" border="0" id="ing1_r2_c3" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="21" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r3_c2.jpg" alt="" name="ing1_r3_c2" width="117" height="7" border="0" id="ing1_r3_c2" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="7" border="0" alt="" /></td>
    </tr>
    <tr>
      <td background="<?php echo $objtemplatep->path_template ?>images/ing1_r4_c2.jpg"><div align="center">
        <input name="pwdusu" type="password" class="accesohomestl" id="pwdusu" size="18" />
      </div></td>
      <td rowspan="2"><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r4_c3.jpg" alt="" name="ing1_r4_c3" width="9" height="30" border="0" id="ing1_r4_c3" /></td>
      <td rowspan="2"  onClick="showUseracc(window.document.sisacc.sisusu.value,window.document.sisacc.pwdusu.value,3,0,'<?php echo $objtemplatep->path_template ?>')" class=mousecls><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r4_c4.jpg" alt="" name="ing1_r4_c4" width="29" height="30" border="0" id="ing1_r4_c4" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="21" border="0" alt="" /></td>
    </tr>
    <tr>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r5_c2.jpg" alt="" name="ing1_r5_c2" width="117" height="9" border="0" id="ing1_r5_c2" /></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="9" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="4"><a href="index.php?csearch=<?php echo $csearch ?>&amp;opcion=<?php echo $opcion; ?>&amp;apl=18&amp;secc=7&amp;system=<?php echo $system ?>&amp;sessid=<?php echo $sessid ?>"><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r6_c1.jpg" alt="" name="ing1_r6_c1" width="203" height="16" border="0" id="ing1_r6_c1" /></a></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="16" border="0" alt="" /></td>
    </tr>
    <tr>
      <td colspan="4"><a href="index.php?csearch=<?php echo $csearch ?>&amp;opcion=<?php echo $opcion; ?>&amp;apl=7&amp;secc=7&amp;system=<?php echo $system ?>&amp;sessid=<?php echo $sessid ?>"><img src="<?php echo $objtemplatep->path_template ?>images/ing1_r7_c1.jpg" alt="" name="ing1_r7_c1" width="203" height="18" border="0" id="ing1_r7_c1" /></a></td>
      <td><img src="<?php echo $objtemplatep->path_template ?>images/spacer.gif" width="1" height="18" border="0" alt="" /></td>
    </tr>
  </table>
</form>

