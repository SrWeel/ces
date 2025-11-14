<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%" valign="top"><div align="center"><img src="<?php echo $ap_path ?>opciones.png" width="120" height="140" /></div></td>
    <td width="37%" valign="top"><?php
		
	$objmenu->menu_posicion("6",$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,$apl,$extra,$DB_gogess);
	
	?></td>
    <td width="38%" valign="top"><?php
	
	$objmenu->menu_posicion("5",$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,$apl,$extra,$DB_gogess);
	
	?></td>
  </tr>
</table>
