<?php

/**

 * Formulario

 * 

 * Este archivo permite generar los formularios 

 * Para poder usar a futuro actualizaciones de formularios.

 * @author Ecohevea <franklin.aguas@hecoevea.com>

 * @version 1.0

 * @package ConexionData

 */

 

class FormularioData

{ 

public $campos;

public $table;

public $n_registros;

public $ncampos;

public $tipo_campo;

public $nombre_campo;

public $flags;

public $selecTabla;

public $resultado;

public $valores;

//publiciables de campos

public $tab_name;

public $tab_title;

public $tab_information;

public $fie_name;

public $fie_title;

public $fie_type;

public $fie_style;

public $fie_attrib;

public $fie_value;

public $fie_tabledb;

public $fie_datadb;

public $fie_active;

public $fie_activesearch;

public $fie_obl;

public $fie_sql;

public $fie_group;

public $tab_bextras;

public $sendpublic=array();

public $fie_sendprivate;

public $fie_tactive;

public $fie_lencampo;

public $fie_lineas;

public $fie_valiextra;

public $fie_verificac;

public $fie_tablac;

public $tableant;

public $tableant1;

public $fie_actiprivateprt;

public $fie_sqlorder;
public $fie_placeholder;

public $opcp;

public $imprpt;

public $impaqualis;

public $dirg;

public $systemb;

public $apl;

public $secc;

public $seccapl;



public $fie_styleobj;

public $ptaeditor;

public $geamv;

public $refresh;

public $camposinfo;

public $fie_activelista;

public $sessid;



public $keyv = "x26rgqehx2p03z9xxxxssx1k";

public $ivv = "wh37774n";

public $bit_checkv=8;

public $fie_id;





/**

 * Encripta los datos que se envian por la barra de navegacion.

 * 

 * Aplica algoritmo de encriptacion puede ser propio o base64 encode

 * 

 * @param string $text texto par encriptar.

 * @return string encriptado.

 */

	

function encrypt($text) {

           return base64_encode($text);

   }



/**

 * Desencripta los datos que se envian por la barra de navegacion.

 * 

 * Aplica algoritmo de desencriptacion puede ser propio o base64 decode

 * 

 * @param string $text texto par desencriptar.

 * @return string desencriptado.

 */

 

function decrypt($encrypted_text){

	$decrypted = base64_decode($encrypted_text);	

	return $decrypted;

}



/**

 * Obtiene un valor aleatorio.

 * 

 * Obtiene un valor aleatorio para uso general

 * 

 * @return string aleatorio.

 */

function sacaaleat()

{

                    $max_chars = round(rand(3,3));  // tendrá entre 7 y 10 caracteres

					$chars = array();

					for ($i="a"; $i<"z"; $i++) $chars[] = $i;  // creamos vector de letras

					$chars[] = "z";

					for ($i=0; $i<$max_chars; $i++) {

						$clave .= round(rand(0, 9));

					}

                            

	 			   return  $clave; 

}





/**

 * Variable segura encriptada.

 * 

 * Obtiene una seria de datos ecnriptados usa las funciones encrypt($text) y sacaaleat()

 * 

 * @param string $linksvar texto par encriptar.

 * @return string encriptado.

 */

function variables_segura($linksvar)

{

     $valorext=$this->sacaaleat();

	 $valoresencriptados=$this->encrypt($linksvar);																						

	 $linksvarencri=base64_encode($valoresencriptados).trim($valorext);

     return $linksvarencri;

}



/**

 * Funcion para limpiar texto o caracteres especiales de un string.

 * 

 * Limpia o remplaza los caracteres especiales

 * 

 * @param string $texto texto par limpiar.

 * @return string texto limpio.

 */



function textorraro($texto) {

				  $s = trim($texto);

				  $s = str_replace("&&amp;","&amp;",trim($texto));

				  $s = str_replace("&","&amp;",trim($texto));

				  $s = str_replace("&&amp;","&amp;",trim($texto));

				  $s = str_replace("'","\'",trim($s));

				  

				  

				  return $s;

				 }		



/**

 * Funcion para limpiar texto o caracteres especiales de un string en java script.

 * 

 * Limpia o remplaza los caracteres especiales

 * 

 * @param string $str texto par limpiar.

 * @return string texto limpio.

 */	

function tildes_unicode($str){

    $str = trim($str);

	$str = preg_replace('/&aacute;/','\u00e1',$str);

	$str = preg_replace('/&eacute;/','\u00e9',$str);

	$str = preg_replace('/&iacute;/','\u00ed',$str);

	$str= preg_replace('/&oacute;/','\u00f3',$str);

	$str = preg_replace('/&uacute;/','\u00fa',$str);



	$str = preg_replace('/&Aacute;/','\u00c1',$str);

	$str = preg_replace('/&Eacute;/','\u00c9',$str);

	$str = preg_replace('/&Iacute;/','\u00cd',$str);

	$str = preg_replace('/&Oacute;/','\u00d3',$str);

	$str= preg_replace('/&Uacute;/','\u00da',$str);



	$str = preg_replace('/&ntilde;/','\u00f1',$str);

	$str = preg_replace('/&Ntilde;/','\u00d1',$str);

	return $str;

}







/**

 * Funcion para obtener las caracteristicas de la tabla.

 * 

 * Obtiene las caracteristicas de una tabla

 * 

 * @param string $table el nombre de la tabla.

 * @return caracteristicas.

 */		



function form_format_tabla($table,$DB_gogess)
{

//print_r($this->sistable_arr);
    $table=0;

	@$this->tab_name=$this->sistable_arr[$table]["tab_name"];
	@$this->tab_title=$this->sistable_arr[$table]["tab_title"]; 
	@$this->tab_information=$this->sistable_arr[$table]["tab_information"];
	@$this->tab_bextras=$this->sistable_arr[$table]["tab_bextras"];
	@$this->tab_datosf=$this->sistable_arr[$table]["tab_datosf"];
	@$this->tab_scriptguardar=$this->sistable_arr[$table]["tab_valextguardar"];
	@$this->tab_archivo=$this->sistable_arr[$table]["tab_archivo"];
	@$this->tab_formatotabla=$this->sistable_arr[$table]["tab_formatotabla"];	 

		   	

}				 

/**

 * Funcion para obtener el mumero de campos.

 * 

 * Obtiene la cantidad de campos

 * 

 * @param string $table el nombre de la tabla.

 * @return int $cuenta cantidad.

 */	





function form_num_fields($table,$DB_gogess)

{

    //print_r($this->sisfield_arr);

  $cuenta=0;

  foreach ($this->sisfield_arr as $campos) {    

	

	

	if(trim($campos["tab_name"])==$table &&  trim($campos["fie_active"])==1 )

	{

	  //echo $campos["tab_name"]."--".$campos["fie_name"]."--".$campos["fie_active"]."<br>";

	   $cuenta++;

	}

	

  }

  return $cuenta;

}





 

}



?>