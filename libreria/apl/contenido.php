<?php

/**

 * Contenido del aplicativo

 * 

 * Este archivo permite mostrar o obtener los objetos que conforman el apl(menu).

 * 

 * @author Ecohevea <franklin.aguas@hecoevea.com>

 * @version 1.0

 * @package contenido_apl

 */

class contenido_apl{

	



function encrypt($text) {

           

			return base64_encode($text);

   }

function decrypt($encrypted_text){

  

	$decrypted = base64_decode($encrypted_text);

	

	return $decrypted;

}



function sacaaleat()

{

                    $max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres

					$chars = array();

					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras

					$chars[] = "z";

					for ($i=0; $i<$max_chars; $i++) {

						@$clave .= round(rand(0, 9));

					}

                            

	 			   return  $clave; 

}

function variables_segura($linksvar)

{

     $valorext=$this->sacaaleat();

	 $valoresencriptados=$this->encrypt($linksvar);																						

	 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);

     return $linksvarencri;

}



function despliega_menuapl($opcion,$apl,$DB_gogess)

{

//Saca perfil

 $sacaperfil="select * from  app_usuariosperfil where usua_id='?' and per_activo='?'";



 $rs_sacaperfil=$DB_gogess->executec($sacaperfil,array($_SESSION['ces1313777_sessid_inicio'],1));

 if($rs_sacaperfil)

 {

        while (!$rs_sacaperfil->EOF) {

		

		  

		@$menupricnipal.=$rs_sacaperfil->fields["per_codobj"].",";

		

		 $rs_sacaperfil->MoveNext();

		}

 

 }

 //echo $sacaperfil;

 //Saca perfil
  $listamenu="select * from gogess_menuaplicativo men left join gogess_menuopcion menopc on  men.menap_id=menopc.menap_id where opap_id=? and ap_id=?";
$rs_listamenu=$DB_gogess->executec($listamenu,array($opcion,$apl));

  if($rs_listamenu)

  {

   $i=0;

    while (!$rs_listamenu->EOF) {

	

             $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];

			 

			 

			 //saca item menu

			 

			 $listaitem="select * from gogess_itemmenuaplicativo where menap_id=? and itmenap_activo='?' and itmenap_id in (".substr($menupricnipal,0,-1).") order by itmenap_orden asc";

			// echo $listaitem;

			 

			 $rs_listaitemmenu=$DB_gogess->executec($listaitem,array($rs_listamenu->fields["menap_id"],1));

			 $kl=0;

			 if($rs_listaitemmenu)

             {

                   while (!$rs_listaitemmenu->EOF) {

				   

				   $itemmenuapl[$i][$kl]["nombre"]=$rs_listaitemmenu->fields["itmenap_nombre"];

			       $itemmenuapl[$i][$kl]["link"]=$rs_listaitemmenu->fields["opap_id"];

				   $itemmenuapl[$i][$kl]["itmenap_id"]=$rs_listaitemmenu->fields["itmenap_id"];

				   //segundo nivel

				   

				   $listaniveldos="select * from gogess_itemmenuaplicativo where menap_id=? and itmenap_activo='?' and itmenap_id in (".substr($menupricnipal,0,-1).")  order by itmenap_orden asc ";

				   

				   $rs_listanivel2=$DB_gogess->executec($listaniveldos,array($rs_listaitemmenu->fields["smenap_id"],1));

				   $hl=0;

				   if($rs_listanivel2)

                   {

				      while (!$rs_listanivel2->EOF) {

					  

					   $itemmenuaplsecond[$kl][$hl]["nombre"]=$rs_listanivel2->fields["itmenap_nombre"];

					   $itemmenuaplsecond[$kl][$hl]["link"]=$rs_listanivel2->fields["opap_id"];

					   $itemmenuaplsecond[$kl][$hl]["itmenap_id"]=$rs_listanivel2->fields["itmenap_id"];

					   

					   $hl++;

					   $rs_listanivel2->MoveNext();

					  }

				   

				   }

				   

				   //segundo nivel

				   

				   $kl++;

				   

				    $rs_listaitemmenu->MoveNext();

				   }



             }			 

			 //saca item menu

			 

			 

			// $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];

			

			

			

			 $i++;	 

				

			$rs_listamenu->MoveNext();

	  }	

  

  }

  



  //despliega menu



  echo '<ul id="'.@$menudata[0]["estilo"].'">';

  

  for ($j=0;$j<count(@$itemmenuapl[0]);$j++)

  {

    

	//opap_id

	if(trim($itemmenuapl[0][$j]["link"]))

	{

	         $armadolinkx='';

			 $linksvarx="idmen=".$itemmenuapl[0][$j]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuapl[0][$j]["link"];	

			 $linksvarencrix=$this->variables_segura($linksvarx);			 

			 $armadolinkx='index.php?snp='.$linksvarencrix;

			 echo '<li><a href="'.$armadolinkx.'">'.$itemmenuapl[0][$j]["nombre"].'</a>';

	}

	else

	{

	echo '<li><a href="#">'.$itemmenuapl[0][$j]["nombre"].'</a>';

	}

	

	

	if ((count(@$itemmenuaplsecond[$j]))>0)

	{

		echo "<ul>";

		for($k=0;$k<count($itemmenuaplsecond[$j]);$k++)

		{

			

			if(trim($itemmenuaplsecond[$j][$k]["link"]))

			{

			 $armadolink='';

			 $linksvar="idmen=".$itemmenuaplsecond[$j][$k]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuaplsecond[$j][$k]["link"];	

			 $linksvarencri=$this->variables_segura($linksvar);			 

			 $armadolink='index.php?snp='.$linksvarencri;			

			 echo '<li><a href="'.$armadolink.'">'.$itemmenuaplsecond[$j][$k]["nombre"].'</a>';

			 }

			 else

			 {

			   echo '<li><a href="#">'.$itemmenuaplsecond[$j][$k]["nombre"].'</a>';

			 

			 }

			 

		}

		echo "</ul>";

	}

	

	

	echo '</li>';

  

  }

  	

  echo '</ul>';

  

  

  

}	




function despliega_menuapl_li($opcion,$apl,$DB_gogess)

{


 //Saca perfil

 $sacaperfil="select * from  app_usuariosperfil where usua_id='?' and per_activo='?'";



 $rs_sacaperfil=$DB_gogess->executec($sacaperfil,array(@$_SESSION['ces1313777_sessid_inicio'],1));

 if($rs_sacaperfil)

 {

        while (!$rs_sacaperfil->EOF) {

		

		  

		@$menupricnipal.=$rs_sacaperfil->fields["per_codobj"].",";

		

		 $rs_sacaperfil->MoveNext();

		}

 

 }

 //echo $sacaperfil;

 //Saca perfil

 

 

  $listamenu="select * from gogess_menuaplicativo men left join gogess_menuopcion menopc on  men.menap_id=menopc.menap_id where opap_id=? and ap_id=?";


  $rs_listamenu=$DB_gogess->executec($listamenu,array($opcion,$apl));

  if($rs_listamenu)

  {

   $i=0;

    while (!$rs_listamenu->EOF) {

	

             $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];

			 

			 

			 //saca item menu

			 

			 $listaitem="select * from gogess_itemmenuaplicativo where menap_id=? and itmenap_activo='?' and itmenap_id in (".substr(@$menupricnipal,0,-1).") order by itmenap_orden asc";

			// echo $listaitem;

			 

			 $rs_listaitemmenu=$DB_gogess->executec($listaitem,array($rs_listamenu->fields["menap_id"],1));

			 $kl=0;

			 if($rs_listaitemmenu)

             {

                   while (!$rs_listaitemmenu->EOF) {

				   

				   $itemmenuapl[$i][$kl]["nombre"]=utf8_encode($rs_listaitemmenu->fields["itmenap_nombre"]);

			       $itemmenuapl[$i][$kl]["link"]=$rs_listaitemmenu->fields["opap_id"];

				   $itemmenuapl[$i][$kl]["itmenap_id"]=$rs_listaitemmenu->fields["itmenap_id"];
                   $itemmenuapl[$i][$kl]["icono"]=$rs_listaitemmenu->fields["menap_icono"];
				   //segundo nivel

				   

				  $listaniveldos="select * from gogess_itemmenuaplicativo where menap_id=? and itmenap_activo='?' and itmenap_id in (".substr($menupricnipal,0,-1).")  order by itmenap_orden asc ";

				   

				   $rs_listanivel2=$DB_gogess->executec($listaniveldos,array($rs_listaitemmenu->fields["smenap_id"],1));

				   $hl=0;

				   if($rs_listanivel2)

                   {

				      while (!$rs_listanivel2->EOF) {

					  

					   $itemmenuaplsecond[$kl][$hl]["nombre"]=utf8_encode($rs_listanivel2->fields["itmenap_nombre"]);

					   $itemmenuaplsecond[$kl][$hl]["link"]=$rs_listanivel2->fields["opap_id"];

					   $itemmenuaplsecond[$kl][$hl]["itmenap_id"]=$rs_listanivel2->fields["itmenap_id"];
                       $itemmenuaplsecond[$kl][$hl]["icono"]=$rs_listanivel2->fields["menap_icono"];
					   

					   $hl++;

					   $rs_listanivel2->MoveNext();

					  }

				   

				   }

				   

				   //segundo nivel

				   

				   $kl++;

				   

				    $rs_listaitemmenu->MoveNext();

				   }



             }			 

			 //saca item menu

			// $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];

	 $i++;	 

				

			$rs_listamenu->MoveNext();

	  }	

  

  }


  //despliega menu



 // echo '<ul id="'.@$menudata[0]["estilo"].'">';

  

  for ($j=0;$j<count(@$itemmenuapl[0]);$j++)

  {

    

	//opap_id

	if(trim($itemmenuapl[0][$j]["link"]))

	{

	         $armadolinkx='';

			 $linksvarx="idmen=".$itemmenuapl[0][$j]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuapl[0][$j]["link"];	

			 $linksvarencrix=$this->variables_segura($linksvarx);			 

			 $armadolinkx='index.php?snp='.$linksvarencrix;
			 
			 if(@$opcion==$itemmenuapl[0][$j]["link"])
			 {
                $seleccionado="class='active'";
			 }
			 else
			 {
			   $seleccionado="";	 
			 }
			 echo '<li class="dropdown" '.$seleccionado.' ><a href="'.$armadolinkx.'"  title="'.$itemmenuapl[0][$j]["nombre"].'" class="dropdown-toggle" data-toggle="dropdown" >
			 '.$itemmenuapl[0][$j]["icono"].'
			 '.$itemmenuapl[0][$j]["nombre"].'<b class="caret"></b></a>';

	}

	else

	{

	echo '<li class="dropdown" ><a href="#" class="dropdown-toggle" data-toggle="dropdown" >'.$itemmenuapl[0][$j]["nombre"].'<b class="caret"></b></a>';

	}

	

	

	if ((count(@$itemmenuaplsecond[$j]))>0)

	{

		echo "<ul class='dropdown-menu' >";

		for($k=0;$k<count($itemmenuaplsecond[$j]);$k++)

		{

			

			if(trim($itemmenuaplsecond[$j][$k]["link"]))

			{

			 $armadolink='';

			 $linksvar="idmen=".$itemmenuaplsecond[$j][$k]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuaplsecond[$j][$k]["link"];	

			 $linksvarencri=$this->variables_segura($linksvar);			 

			 $armadolink='index.php?snp='.$linksvarencri;			

			 echo '<li><a href="'.$armadolink.'">
			  '.$itemmenuapl[0][$j]["icono"].'
			 
			 '.$itemmenuaplsecond[$j][$k]["nombre"].'</a>';

			 }

			 else

			 {

			   echo '<li><a href="#">'.$itemmenuaplsecond[$j][$k]["nombre"].'</a>';

			 

			 }

			 

		}

		echo "</ul>";

	}

	

	

	echo '</li>';

  

  }

  	

 // echo '</ul>';

  

  

  

}	


///iconos de acceso rapido


function despliega_menuapl_rapido($opcion,$apl,$DB_gogess)

{


 //Saca perfil
$sacaperfil="select * from  app_usuariosperfil where usua_id='".@$_SESSION['ces1313777_sessid_inicio']."' and per_activo='1'";
$rs_sacaperfil=$DB_gogess->executec(@$sacaperfil,array());
 if($rs_sacaperfil)
{



        while (!$rs_sacaperfil->EOF) {

		@$menupricnipal.=$rs_sacaperfil->fields["per_codobj"].",";


		 $rs_sacaperfil->MoveNext();



		}



 



 }


 //echo $sacaperfil;

 //Saca perfil

 $listamenu="select distinct men.menap_id,menap_style from gogess_menuaplicativo men left join gogess_menuopcion menopc on  men.menap_id=menopc.menap_id where  ap_id=".$apl;
  //echo $opcion."<br>";
//  echo $apl."<br>";

  $rs_listamenu=$DB_gogess->executec($listamenu,array());



  if($rs_listamenu)
{



   $i=0;



    while (!$rs_listamenu->EOF) {



	



             $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];



			 //saca item menu
$listaitem="select * from gogess_itemmenuaplicativo where itmenap_rapido=1 and menap_id=".$rs_listamenu->fields["menap_id"]." and itmenap_activo='1' and itmenap_id in (".substr(@$menupricnipal,0,-1).") order by itmenap_orden asc";

			// echo $listaitem;


			 $rs_listaitemmenu=$DB_gogess->executec($listaitem,array());



			 $kl=0;



			 if($rs_listaitemmenu)



             {



                   while (!$rs_listaitemmenu->EOF) {



				   



				   $itemmenuapl[$i][$kl]["nombre"]=$rs_listaitemmenu->fields["itmenap_nombre"];



			       $itemmenuapl[$i][$kl]["link"]=$rs_listaitemmenu->fields["opap_id"];



				   $itemmenuapl[$i][$kl]["itmenap_id"]=$rs_listaitemmenu->fields["itmenap_id"];

                   $itemmenuapl[$i][$kl]["icono"]=$rs_listaitemmenu->fields["menap_icono"];

				   $itemmenuapl[$i][$kl]["grafico"]=$rs_listaitemmenu->fields["itmenap_graficoacceso"];



				   $kl++;



				   



				    $rs_listaitemmenu->MoveNext();



				   }







             }			 



			 //saca item menu





			// $menudata[$i]["estilo"]=$rs_listamenu->fields["menap_style"];





			 $i++;	 



				



			$rs_listamenu->MoveNext();



	  }	



  

  }

  //despliega menu



 // echo '<ul id="'.@$menudata[0]["estilo"].'">';

//print_r($itemmenuapl);
  $tlink=0;

  for ($j=0;$j<count(@$itemmenuapl[1]);$j++)

  {

    

	//opap_id

	if(trim($itemmenuapl[1][$j]["link"]))

	{

	         $armadolinkx='';
             $linksvarx="idmen=".$itemmenuapl[1][$j]["itmenap_id"]."&apl=".$apl."&secc=7&seccapl=".$itemmenuapl[1][$j]["link"];	
             $linksvarencrix=$this->variables_segura($linksvarx);			 
             $armadolinkx='index.php?snp='.$linksvarencrix;
             $link_datos[$tlink]='<a href="'.$armadolinkx.'"  title="'.$itemmenuapl[1][$j]["nombre"].'"  ><img src="/domohs/archivo/'.$itemmenuapl[1][$j]["grafico"].'" border="0" width="128" height="128" ></a>';

	}

	else

	{

	        $link_datos[$tlink]='<a href="#">'.$itemmenuapl[0][$j]["nombre"].'<img src="/domohs/archivo/'.$itemmenuapl[1][$j]["grafico"].'" border="0/" width="128" height="128"   ></a>';

	}


$tlink++;
  

  }


  	$this->desplegarencuadros(@$link_datos,0,5,5,3);

 // echo '</ul>';



}	

//despliega cuadros

function desplegarencuadros($arreglolista,$border,$cellpadding,$cellspacing,$columnas)
{
    $nregistros=count($arreglolista);
	if($nregistros>0)
	{
	
	$columna=$columnas;
	$filascal=($nregistros/$columna)+1;
	
		//para decimales arreglar
	$fila=$filascal;
	$k=0;	
	echo '<table  border="'.$border.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'">';
	for ($i=0;$i<=$fila-1;$i++)
	{
	   echo '<tr>';
	    echo '<td width="70px">&nbsp;</td>'; 
		 for($j=0;$j<=$columna-1;$j++)
		 {
		   echo '<td class="post-body img">'.@$arreglolista[$k].'</td>';
		   echo '<td width="70px">&nbsp;</td>';
		   $k++;
		 
		 }
		 
	   echo '</tr>';	  
	}
	echo '</table>';
    }
}



}

?>