<?php
$path_template='';
$path_template='templates/page/';
$busca_datosus="select usua_archivo,usua_nombre,usua_apellido,centro_nombre from app_usuario inner join dns_centrosalud  on app_usuario.centro_id=dns_centrosalud.centro_id where usua_id=?";
$rs_usuarios = $DB_gogess->executec($busca_datosus,array(@$_SESSION['ces1313777_sessid_inicio']));
$imagen_avatar='';

function encrypt($text) {

			return base64_encode($text);

   }


function sacaaleat()
	{

						$clave='';
						$max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres
						$chars = array();
						for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras
						$chars[] = "z";
						for ($i=0; $i<$max_chars; $i++) {
							$clave .= round(rand(0, 9));
						}
					   return  $clave; 

	}

function variables_segura($linksvar)
	{

		 $valorext=sacaaleat();
		 $valoresencriptados=encrypt($linksvar);																						
		 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);
		 return $linksvarencri;

	}


//echo $es_proveedor;

if($rs_usuarios->fields["usua_archivo"])
{
$imagen_avatar=$rs_usuarios->fields["usua_archivo"];
}
else
{
$imagen_avatar='person.png';
}

?>
<!-- Bootstrap -->
<div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
        <header id="hoe-header" hoe-lpanel-effect="shrink">
            <div class="hoe-left-header">
                <a href="index.php"><img src="images/logosys.png"></a>
                <span class="hoe-sidebar-toggle"><a href="#"></a></span>
            </div>
            <div class="hoe-right-header" hoe-position-type="relative" >
                <span class="hoe-sidebar-toggle"><a href="#"></a></span>
                <ul class="left-navbar"></ul>
                <ul class="right-navbar"></ul>
            </div>
        </header>
        <div id="hoeapp-container" hoe-color-type="lpanel-bg2" hoe-lpanel-effect="shrink">
            <aside id="hoe-left-panel" hoe-position-type="absolute">
                <div class="profile-box">
                    <div class="media">
                        <a class="pull-left" href="javascript:ver_formularioenpantalla('aplicativos/documental/datos_usuario.php','Perfil','divBody_ext','<?php echo $_SESSION['ces1313777_sessid_inicio'] ?>',0,0,0,0,0,0)">
                            <!-- <img class="img-circle" src="archivo/<?php echo $imagen_avatar; ?>"> -->
                        </a>
                        <div class="media-body">
                            <div class="media-heading" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px"><b><?php echo $rs_usuarios->fields["usua_nombre"]." ".$rs_usuarios->fields["usua_apellido"]." <strong>".$rs_usuarios->fields["centro_nombre"]."</strong>"; ?></div>
                            <!-- <small><?php echo $rs_usuarios->fields["usua_nombre"]." ".$rs_usuarios->fields["usua_apellido"]; ?></small> -->
                        </b></div>
                    </div>
                </div>

                <ul class="nav panel-list">
                    <li class="nav-level">MENU</li>	
					<?php
					//cliente
					//--------------------------------
					$lista_menu="select * from gogess_menupanel where mnupan_activo=1 and posp_id=1 and mnupan_id in (SELECT per_codobj FROM app_usuariosperfil WHERE per_activo=1 and usua_id=".@$_SESSION['ces1313777_sessid_inicio'].") order by mnupan_orden asc ";

					$rs_listamenu = $DB_gogess->executec($lista_menu,array());
					  if($rs_listamenu)
                        {

						        while (!$rs_listamenu->EOF) {
								echo '<li>';
								switch ($rs_listamenu->fields["opcionpa_id"]) {
										case 1:
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/opciones/panel/'.$rs_listamenu->fields["mnupan_archivo"].'\',\'Perfil\',\'divBody_ext\',\''.$_SESSION['ces1313777_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >

												<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>
												<span class="menu-text" >'.utf8_decode($rs_listamenu->fields["mnupan_nombre"]).'</span>
												<span class="selected"></span>
											</a>';
											break;
										case 5:
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_clave.php\',\'Clave\',\'divBody_ext\',\''.$_SESSION['ces1313777_sessid_inicio'].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)">
												<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>
												<span class="menu-text">'.utf8_decode($rs_listamenu->fields["mnupan_nombre"]).'</span>
												<span class="selected"></span>
											</a>';
											break;
										case 6:
										   echo '<a href="javascript:salir_sistema()">
												<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>
												<span class="menu-text">'.utf8_decode($rs_listamenu->fields["mnupan_nombre"]).'</span>
												<span class="selected"></span>
											</a>';
											break;
										case 7:
										   echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_contenido.php\',\'Perfil\',\'divBody_ext\',\''.$rs_listamenu->fields["con_id"].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)">
												<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>
												<span class="menu-text">'.utf8_decode($rs_listamenu->fields["mnupan_nombre"]).'</span>
												<span class="selected"></span>
											</a>';
										   break;	
										case 8:
											echo '<a href="javascript:ver_formularioenpantalla(\'aplicativos/documental/datos_standar.php\',\'Pago\',\'divBody_ext\',\''.@$_SESSION[$rs_listamenu->fields["mnupan_variablesession"]].'\',\''.$rs_listamenu->fields["mnupan_id"].'\',0,0,0,0,0)" >
												<i class="'.$rs_listamenu->fields["mnupan_icono"].'"></i>
												<span class="menu-text" >'.utf8_decode($rs_listamenu->fields["mnupan_nombre"]).'</span>
												<span class="selected"></span>
											</a>';
											break;   						
										default:
										   echo "";
									}
								echo '</li>';
								$rs_listamenu->MoveNext(); 
								}
						}		
					//--------------------------------

					?>   
                </ul>
            </aside>
            <section id="main-content"  >
                <div id=acceso_panel ><br>
<div id="divBody_ext" >
<?php
$buscaopcionapl="select * from gogess_opcionaplicativo where ap_id=? and opap_activo='?'";
$rs_aplopciones = $DB_gogess->executec($buscaopcionapl,array($apl,1));
  if($rs_aplopciones)
  {

     	while (!$rs_aplopciones->EOF) {
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["ejecuta"]=$rs_aplopciones->fields["opap_ejecuta"];
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["id"]=$rs_aplopciones->fields["opap_id"];
		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["nombre"]=$rs_aplopciones->fields["opap_nombre"];

		if($rs_aplopciones->fields["opap_intro"]==1)
		{

		 $opcioninical=$rs_aplopciones->fields["opap_ejecuta"];
		 $idopcioninical=$rs_aplopciones->fields["opap_id"];
		}

		$rs_aplopciones->MoveNext(); 
		}
  }


 //print_r($arrayopciones);
  $idvalor_opcion=0;

  if(!(@$seccapl))
  {

     $idvalor_opcion=@$idopcioninical;

	// include("menu/menu.php");
	 include("opciones/".trim(@$opcioninical).".php");

  }
  else
  {

    $idvalor_opcion=$arrayopciones[$seccapl]["id"];
	$pantalla_nombre=$arrayopciones[$seccapl]["nombre"];
	//include("menu/menu.php");
	echo '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td bgcolor="#E7EFF5" ><b>'.trim($pantalla_nombre).'</b></td></tr></table>';
	//echo "opciones/".$arrayopciones[$seccapl]["ejecuta"].".php";
	include("opciones/".$arrayopciones[$seccapl]["ejecuta"].".php");

  }

?>
</div>
</div>

kkkk
            </section> 
        </div>
    </div>