<form name="form1" method="post" action="">
  <table align="center" border="0" cellpadding="0" cellspacing="3">
    <tbody>
      <tr>
        <td valign="top"><table class="ayudatborde" border="0" cellpadding="0" cellspacing="4" height="250" width="150">
            <tbody>
              <tr>
                <td bgcolor="#f0f3f4" valign="top"><span class="ayudatregistros"> Cambio de clave </span></td>
              </tr>
            </tbody>
        </table></td>
        <td><table align="center" border="0" cellpadding="0" cellspacing="0" width="479">
            <tbody>
              <tr>
                <td><img src="images/spacer.gif" alt="" border="0" height="1" width="6"></td>
                <td><img src="images/spacer.gif" alt="" border="0" height="1" width="467"></td>
                <td><img src="images/spacer.gif" alt="" border="0" height="1" width="6"></td>
                <td><img src="images/spacer.gif" alt="" border="0" height="1" width="1"></td>
              </tr>
              <tr>
                <td><img name="caja_r1_c1" src="images/caja_r1_c1.gif" alt="" border="0" height="5" width="6"></td>
                <td background="images/caja_r1_c2.gif"><img src="images/caja_r1_c2.gif"></td>
                <td><img name="caja_r1_c3" src="images/caja_r1_c3.gif" alt="" border="0" height="5" width="6"></td>
                <td><img src="images/spacer.gif" alt="" border="0" height="5" width="1"></td>
              </tr>
              <tr>
                <td background="images/caja_r2_c1.gif">&nbsp;</td>
                <td valign="top">
                  <table border="0" align="center" cellpadding="0" cellspacing="3">
                    <tbody>
                      <tr>
                        <td valign="top"><div class="cmbforms"></div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td valign="top">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><div class="cmbforms">Usuario</div></td>
                        <td>&nbsp;</td>
                        <td><div class="cmbforms"> &nbsp;&nbsp;</div></td>
                        <td class="txtextra">&nbsp;
                        <input name="sisu_usu" type="hidden" id="sisu_usu" value="<?php echo $_SESSION['novpichincha1777_ususer']; ?>">                        <?php echo $_SESSION['novpichincha1777_ususer'];  ?></td>
                      </tr>
                      <tr>
                        <td valign="top"><div class="cmbforms">Clave anterior</div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td valign="top">&nbsp;
                            <input name="canterior" type="password" class="cssobj" id="canterior" size="25" maxlength="200"></td>
                      </tr>
                      <tr>
                        <td valign="top"><div class="cmbforms">Password</div></td>
                        <td>&nbsp; </td>
                        <td>&nbsp; </td>
                        <td valign="top">&nbsp;
                            <input name="sisu_pwd" class="cssobj" maxlength="200" size="25" type="password"></td>
                      </tr>
                      <tr>
                        <td valign="top"><div class="cmbforms">Confirmaci&oacute;n Password</div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td valign="top">&nbsp;
                            <input name="sisu_pwd1" class="cssobj" maxlength="200" size="25" type="password"></td>
                      </tr>
                    </tbody>
                </table>
                <input name="opcp" type="hidden" id="opcp" value="7">
                <input name="apl" type="hidden" id="apl" value="2">
                <input name="subopcp" type="hidden" id="subopcp" value="1">
				<input name="sessid" type="hidden" id="sessid" value="<?php echo $sessid; ?>">
				<?php
				 switch ($subopcp) 
					{
					     case 1:
					      {
           					$selecuser="select * from gogess_sisusers where sisu_usu like '".$_SESSION['novpichincha1777_ususer']."' and sisu_pwd like '".$canterior."'";    
  							$resultadouser = mysql_query($selecuser);
  							while($rowuser = mysql_fetch_array($resultadouser)) 
							{	
								if ($sisu_pwd<>"")
								{
									if ($sisu_pwd1<>"")
									{
										if ($sisu_pwd==$sisu_pwd1)
										{
										   //echo $rowuser["sisu_usu"];	
										   $sqlcambioc="update gogess_sisusers set sisu_pwd = '".$sisu_pwd."' where sisu_id=".$rowuser["sisu_id"];
										  // echo $sqlcambioc;
										   $cambio2 = mysql_query($sqlcambioc);
										   if ($cambio2)
										   {
										     $_SESSION['novpichincha1777_pwd']=$sisu_pwd;
											 echo "Clave fue modificada...";
										   }	 
										   							
										}
										else
										{
										  echo "Claves no concuerdan...";
										}
									}
									else
									{
									  echo "Campo Confirmación Password no fue llenado....llene todos los campos";
									}
								} 
								else
								{
								  echo "Campo Password no fue llenado....llene todos los campos";
								} 
							}
							
       					  }
                         break;
						 default:
							{
			 					
							}
	   					break;
	               }
				?>				
				</td>
                <td background="images/caja_r2_c3.gif">&nbsp;</td>
                <td><img src="images/spacer.gif" alt="" border="0" height="248" width="1"></td>
              </tr>
              <tr>
                <td><img name="caja_r3_c1" src="images/caja_r3_c1.gif" alt="" border="0" height="5" width="6"></td>
                <td background="images/caja_r3_c2.gif"><img src="images/caja_r3_c2.gif"></td>
                <td><img name="caja_r3_c3" src="images/caja_r3_c3.gif" alt="" border="0" height="5" width="6"></td>
                <td><img src="images/spacer.gif" alt="" border="0" height="5" width="1"></td>
              </tr>
            </tbody>
        </table></td>
      </tr>
    </tbody>
  </table>
    <div align="center">
    <input type="submit" name="Submit" value="Enviar">
  </div>
</form>
