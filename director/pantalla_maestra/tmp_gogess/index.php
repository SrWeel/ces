<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $objtemplate->titulo_template  ?></title>



<link type="text/css" href="css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	

<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.corner.js"></script>
<script language="javascript" type="text/javascript" src="js/ui.mask.js"></script>
<script type="text/javascript" src="js/jquery.timer2.js"></script> 
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.fixheadertable.js"></script>
<script src="js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>


<link type="text/css" href="css/jquery.dataTables.min.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script> 

<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css" type="text/css">

<script type="text/javascript" src="js/franklin.js"></script>

<!-- NProgress -->
<script src="vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="vendors/Chart.js/dist/Chart.min.js"></script>

<!-- <script src="build/js/custom.min.js"></script>
<script type="text/javascript" src="js/dataTables.fixedColumns.min.js"></script> -->

<script type="text/javascript">

<!-- Begin

function hideLoading() {

	document.getElementById('pageIsLoading').style.display = 'none'; // DOM3 (IE5, NS6) only

}

//  End -->

</script>


<style type="text/css">
<!--

.form-control
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	height: 24px;
    padding: 3px 6px;

}

.form-group {
    margin-bottom: 10px;
}
-->
</style>


<?php

include_once("modules/script/script.php");

?>



<style type="text/css">

<!--

body {

	background-color: #ECECEC;

}
.css_txtfinaciero {
	font-size: 11px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

-->

</style>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">







<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">

        <tr background="<?php echo $objtemplate->path_template ?>images/fondo_cab.png">

          <td width="3%"><a href="index.php?sessid=<?php echo $sessid; ?>"><img src="<?php echo $objtemplate->path_template ?>images/header_usuario.png" border="0" /></a></td>

          <td width="90%" class=nombreseccion>&nbsp;</td>

          <td width="7%"><table  border="0" align="right" cellpadding="0" cellspacing="0">

            <tr>

			  <td background="<?php echo $objtemplate->path_template ?>images/fondo_cab.png"><a href="index.php?sessid=<?php echo $sessid; ?>"><img src="<?php echo $objtemplate->path_template ?>images/home.png" alt="" name="template1_r1_c3" border="0" id="template1_r1_c3" /></a></td>

              <td background="<?php echo $objtemplate->path_template ?>images/fondo_cab.png"><a href="close.php"><img src="<?php echo $objtemplate->path_template ?>images/salir.png" alt="" name="template1_r1_c4" border="0" id="template1_r1_c4" /></a></td>

            </tr>

          </table></td>

        </tr>

      </table>      </td>

  </tr>

  <tr>

    <td><div align="center"></div></td>

  </tr>

  <tr>

    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

      <tr>

        <td width="50%" bgcolor="#ECECEC"><?php 

	$objmenu->menu_posicion("t",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,@$table,@$apl,@$extra,$DB_gogess);	

	?></td>

        <td width="50%" bgcolor="#ECECEC"><span class="nombreseccion" style="text-transform: uppercase;">

          <?php 

		  if ($table)

          {  

		       echo $objtableform->titulo_tabla;

		  }	

		  

		    if (@$apl)

          {  

		       //echo $apl;

			   $tituloapl=$objformulario->replace_cmb("pcl_aplicationadm","ap_id,ap_nombre","where ap_id =",$apl,$DB_gogess);

			   echo $tituloapl;

		  }	

		  

		  ?>

        </span></td>

      </tr>

      <tr>

        <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="bordefrm">

          <tr>

            <td valign="top"><table width="15%"  border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td><?php

	$objmenu->menu_posicion("1",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>

              <tr>

                <td>&nbsp;</td>
              </tr>

              <tr>

                <td><?php

	$objmenu->menu_posicion("2",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>

              <tr>

                <td>&nbsp;</td>
              </tr>

              <tr>

                <td><?php

	$objmenu->menu_posicion("3",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>

              <tr>

                <td>&nbsp;</td>
              </tr>

              <tr>

                <td><?php

	$objmenu->menu_posicion("4",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><?php

	$objmenu->menu_posicion("7",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#C1E1F0"><div align="center"><strong>FINANCIERO</strong></div></td>
              </tr>
              
              <tr>
                <td><?php

	$objmenu->menu_posicion("f",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#C1E1F0"><strong>GRIDS</strong></td>
              </tr>
              <tr>
                <td><?php

	$objmenu->menu_posicion("8",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#C1E1F0"><strong>ROL DE PAGOS </strong></td>
              </tr>
              <tr>
                <td><?php

	$objmenu->menu_posicion("9",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>
              <tr>
                <td><strong>REPORTES</strong></td>
              </tr>
              <tr>
                <td><?php

	$objmenu->menu_posicion("10",@$varsend,$objacceso_session->sess_menu,$objacceso_session->sess_imenu,$table,@$apl,@$extra,$DB_gogess) 

	?></td>
              </tr>

            </table></td>

            <td valign="top"><table border="0" cellpadding="0" cellspacing="7">

              

              <tr>

                <td valign="top"><?php



if ($table)

 {   

    echo "<div id=divBody_borrar_".str_replace(".","_",$table)." ></div>";

	

	if ($objtableform->tabla_activa==1 or $objtableform->tabla_activa==2)

	{

    include ($objtableform->path_templateform."formulario.php");    

	}

 }

else

 {

    if (!(@$tablelista))

    {  

    switch (@$opcp) 

	{

	

	 case 7:

		{

//Aplicaciones

			include("libreria/aplicativopanel/aplicativo.php");



		}   	

        break;

	  

	 default:

		{

			 include($objtemplate->path_template."inicio.php");

		}

	   break;

	 }  

	 }

 }

	

	

	

	?></td>

                </tr>

              <tr>

                <td valign="top"><?php

if ($table)
{


  if ($objtableform->tabla_activa==1 or $objtableform->tabla_activa==3)

	{

      

	?> 

	

	

	<SCRIPT LANGUAGE=javascript>

<!--

function searchoflist(ret1) 

{ 	

	<?php

	 $dataenc='';

	 $armaencrip="geamv=".@$geamv."&id_inicio=".@$id_inicio."&campoorden=".$objgridtabla->campoorden."&forden=".$objgridtabla->forden;	

	 $dataenc=$objformulario->encrypt($armaencrip);		

	?>

	window.document.form_<?php echo str_replace(".","_",$table); ?>.action='index.php?mp=<?php echo $dataenc ?>'	

	window.document.form_<?php echo str_replace(".","_",$table); ?>.csearch.value=ret1   

	window.document.form_<?php echo str_replace(".","_",$table); ?>.opcion_<?php echo str_replace(".","_",$table); ?>.value='buscar'

	window.document.form_<?php echo str_replace(".","_",$table); ?>.submit()		

}	

//-->

</SCRIPT>

	  

	<?php

	

	

	} 

}	

?></td>

                </tr>

              <tr>

                <td valign="top">
				<?php
				if ($table)
                {
				?>
				<div class=TableScroll>

				<div id=grid_tabla >&nbsp;</div>

				</div>	
				<?php
				}
				?>
				</td>

                </tr>

            </table></td>

            <td valign="top">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td><center>

    </center></td>

  </tr>

  <tr>

    <td><?php include($objtemplate->path_template."pie.htm"); ?></td>

  </tr>

</table>


<div id=divBody_popup ></div>
</body>
</html>