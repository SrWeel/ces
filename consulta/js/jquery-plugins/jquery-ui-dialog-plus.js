$.fn.extend({
    aqDialog:function($Parametros){
        $(this).each(function(){
            //Estableciendo valores predeterminados en el caso de no haberse definido
            $Parametros["Function"] = typeof($Parametros["Function"])!="undefined" ? $Parametros["Function"] : "";
            $Parametros["Title"] = typeof($Parametros["Title"])!="undefined" ? $Parametros["Title"] : "";
            $Parametros["Width"] = typeof($Parametros["Width"])!="undefined" ? $Parametros["Width"] : "400";
            $Parametros["Height"] = typeof($Parametros["Height"])!="undefined" ? $Parametros["Height"] : "300";
            $Parametros["UniqueInstance"] = typeof($Parametros["UniqueInstance"])!="undefined" && $Parametros["UniqueInstance"]!=null ? $Parametros["UniqueInstance"] : "";
            $Parametros["Text"] = typeof($Parametros["Text"])!="undefined" ? $Parametros["Text"] : "";
            $Parametros["File"] = typeof($Parametros["File"])!="undefined" ? $Parametros["File"] : "";
            $Parametros["Params"] = typeof($Parametros["Params"])!="undefined" ? $Parametros["Params"] : null;
            $Parametros["Modal"] = typeof($Parametros["Modal"])!="undefined" ? $Parametros["Modal"] : true;
            $Parametros["Resizable"] = typeof($Parametros["Resizable"])!="undefined" ? $Parametros["Resizable"] : true;
            $Parametros["Position"] = typeof($Parametros["Position"])!="undefined" ? $Parametros["Position"] : "center"; //a single string representing position within viewport: 'center', 'left', 'right', 'top', 'bottom' ; an array containing an x,y coordinate pair in pixel offset from left, top corner of viewport (e.g. [350,100]); an array containing x,y position string values (e.g. ['right','top'] for top right corner)

            $Parametros["onOpen"] = typeof($Parametros["onOpen"])!="undefined" ? $Parametros["onOpen"] : "";
            $Parametros["onClose"] = typeof($Parametros["onClose"])!="undefined" ? $Parametros["onClose"] : "";
            $Parametros["onLoadFinish"] = typeof($Parametros["onLoadFinish"])!="undefined" && $Parametros["onLoadFinish"]!=null ? $Parametros["onLoadFinish"] : "";
            
            //Funciones que se dispararan cuando la modalidad de dialog sea confirm
            $Parametros["onYes"] = typeof($Parametros["onYes"])!="undefined" ? $Parametros["onYes"] : "";
            $Parametros["onNo"] = typeof($Parametros["onNo"])!="undefined" ? $Parametros["onNo"] : "";
                
            //alert("aqui");
            if($Parametros["Function"]=="" || $Parametros["Function"]=="show"){
                $.aqDialog.show($(this),$Parametros);
            } else if($Parametros["Function"] == "alert"){
                $.aqDialog.alert($(this),$Parametros);
            } else if($Parametros["Function"] == "confirm"){
                $.aqDialog.confirm($(this),$Parametros);
            }
        });
    }
});


$.extend({
	aqDialog: {
		name: "aqDialog",
		ver: "1.0",
        show: function($Objeto, $Parametros) {
        	//Parametros:
        	// - Title
        	// - Text
        	// - Width
        	// - Height
        	// - File
        	// - Params
        	// - Buttons
        	// - OnOpen function
        	// - OnClose function
        	// - CloseOnEscape

        	//Padre
        	$padre = $(document);

        	//generando instancia
        	$instance = this._get_id_instance();

        	//Contruyendo objeto
        	$iDialog = $("<div id='aqDialog"+$instance+"' title='"+$Parametros["Title"]+"' instance='"+$instance+"'></div>").attr("class","aqDialog");
        	//$iDialog.css({"font-size":"11px"});

                //alert($Parametros["File"]);
                
        	//verificando si la instancia o dialog debe ser unico y no deberia replicarse
        	if($Parametros["UniqueInstance"]!="" && $.trim($Parametros["UniqueInstance"]).length > 0){
        		$ExisteInstance = false;
        		$objInstance = null;
        		$.each($(document).find(".unique-instance"), function(){
        			if($(this).hasClass($Parametros["UniqueInstance"])) {
        				$ExisteInstance = true;
        				$objInstance = $(this);
        				return false;
        			}
        		});
                        
        		if($ExisteInstance) {
                            if($Parametros["Text"]!=""){
                                $objInstance.html($Parametros["Text"]);
                                if($Parametros["onLoadFinish"]!=""){
                                    fnonLoadFinish = $Parametros["onLoadFinish"];
                                    fnonLoadFinish("aqDialog"+$instance);
                                }
                            }
                            if($Parametros["File"]!=""){
                                $objInstance.load($Parametros["File"],$Parametros["Params"], function(response, status, xhr){
                                    /*if(status == "error") {
                                        alert(xhr.status + " " + xhr.statusText);
                                    }*/
                                    if($Parametros["onLoadFinish"]!=""){
                                        fnonLoadFinish = $Parametros["onLoadFinish"];
                                        fnonLoadFinish("aqDialog"+$instance);
                                    }
                                });
                            }
                            return false;
        		}
        		$iDialog.addClass("unique-instance");
        		$iDialog.addClass($Parametros["UniqueInstance"]);
        	}

        	$iDialog.appendTo($padre);
                
        	//Configurando
        	$iDialog.dialog({
                closeOnEscape: false,
                open: function(event, ui) {
                    if($Parametros["onOpen"]!=""){
                    	fnonOpen = $Parametros["onOpen"];
                    	fnonOpen();
                    }
                },
                close: function(event, ui) {
                    if($Parametros["onClose"]!=""){
                        fnonClose = $Parametros["onClose"];
                        fnonClose();
                    }
                    //Eliminando elemento compuesto del dialog
                    $(document).find("#alertmod").remove();

                    //Eliminando contenedor principal del dialog
                    $ctrlDialog = $(this).parent(".ui-dialog");
                    $ctrlDialog.children().remove();
                    $ctrlDialog.remove();
                },
                resizable: $Parametros["Resizable"],
                autoOpen: false,
                width: $Parametros["Width"],
                height: $Parametros["Height"],
                modal: $Parametros["Modal"],
                position: $Parametros["Position"],
                buttons: $Parametros["Buttons"]
                });/*show: "blind",hide: "explode",*/
                
        	if($Parametros["Text"]!=""){
                    $iDialog.html($Parametros["Text"]);
                    if($Parametros["onLoadFinish"]!=""){
                        fnonLoadFinish = $Parametros["onLoadFinish"];
                        fnonLoadFinish("aqDialog"+$instance);
                    }
        	}

        	if($Parametros["File"]!=""){
                    $iDialog.load($Parametros["File"],$Parametros["Params"], function(response, status, xhr){
                        if(status == "error") {
                            alert(xhr.status + " " + xhr.statusText);
                        }
                        if($Parametros["onLoadFinish"]!=""){
                            fnonLoadFinish = $Parametros["onLoadFinish"];
                            fnonLoadFinish("aqDialog"+$instance);
                        }
                    });
        	}
                
        	$iDialog.dialog("open");
		},
            alert: function($Objeto, $Parametros) {
			$Parametros["Width"] = $Parametros["Width"]=="" ? "200" : $Parametros["Width"];
			$Parametros["Height"] = $Parametros["Height"]=="" ? "100" : $Parametros["Height"];

			$Parametros["Buttons"] = {Aceptar: function(){
				$(this).dialog("close");
			}};
			$.aqDialog.show($Objeto,$Parametros);
		},
                confirm: function($Objeto, $Parametros) {
			$Parametros["Width"] = "200";
			$Parametros["Height"] = "100";

			$Parametros["Modal"] = true;
			$Parametros["Buttons"] = {
				Si: function(){
					if($Parametros["onYes"]!=""){
                    	fnonYes = $Parametros["onYes"];
                    	fnonYes();
                    }
					$(this).dialog("close");
				},
				No: function(){
					if($Parametros["onNo"]!=""){
                    	fnonNo = $Parametros["onNo"];
                    	fnonNo();
                    }
					$(this).dialog("close");
				}
			};
			$.aqDialog.show($Objeto,$Parametros);
		},
		_get_id_instance: function(){
			var $id=null;
			var $coincide=false;

			$id = $.randomBetween(0,1000000);
			$.each(".aqDialog", function(){
				if(parseInt($(this).attr("instance"))==$id) {
					$coincide = true;
					return false;
				}
			});

			if($coincide) $id=this._get_id_instance();

			return $id;
		}
	}
});