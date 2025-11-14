	$(document).ready(function(){
            $(".cls-g-map").load("../imagenes/ecuador-svg-catt.svg", null, function(result){
                //alert(result);
                $(this).find(".cls-ecuador").attr("data-info","ECU");
                $(this).find(".cls-ecuador").css("cursor","pointer");
                //$(this).find(".cls-ecuador").find("#path3478").css("display","none");
                
                //$(this).find(".cls-ecuador").find("path").on("mouseover", function(){                    
                  //  $(this).attr("fill","#70A8D2");
                //});
                /*$(this).find(".cls-ecuador").find("text").on("mouseover", function(){                    
                    $(this).parent().find("path[data-union-label='"+$(this).attr("data-union-label")+"']").css("fill","#08B81C");
                });*/
                
               // $(this).find(".cls-ecuador").find("path").on("mouseout", function(){
                 //   if(!$(this).data("clicked")){
                  //      $(this).attr("fill","#87B6D9");
                   // }
                //});
                /*$(this).find(".cls-ecuador").find("text").on("mouseout", function(){                    
                    $(this).parent().find("path[data-union-label='"+$(this).attr("data-union-label")+"']").css("fill","#E6E6E6");
                });*/
                
                $(this).find(".cls-ecuador").find("path").on("click", function(){
                    //hidden_regions($(this),$(this).parent());
                    $(this).parent().find("path").data("clicked",false);
                    $(this).parent().find("path").attr("fill","#87B6D9");
                    $(this).data("clicked",true);
                    $(this).attr("fill","#70A8D2");
                    ui_busqueda_info({pCodProv:$(this).attr("data-code-prov"),pNombProv:$(this).attr("data-union-label")});
                });
                
            });
            
	    //$(".frmUsuario #frmUsuarioGrid").load("frmUsuarioGrid.php",{id_sis:$("." + $(".frmUsuario #frmUsuario-masterform").val() + " #id_sis").val()});
	});

	//Global
        function hidden_regions($except, $parent){
            $parent.find("path").each(function(){
                if($except.attr("data-union-label") != $(this).attr("data-union-label")){
                    $(this).fadeOut(2000);
                    
                    $(this).parent().find("text[data-union-label='"+$(this).attr("data-union-label")+"']").fadeOut();
                }
            });
            ui_busqueda_info();
        }
        
        function ui_busqueda_info($datos){
            $(".cls-main-form-consulta").aqDialog({Function:"",Title:"Filtro",
                File:"../frmConsulta/frmConsulta-filtro.php",
                Params:{pCodProv:$datos["pCodProv"],pNombProv:$datos["pNombProv"]},
                Width:300,
                Height:150,
                Resizable:false,
                onLoadFinish:function(){
                    get_materias();
                },
                Buttons:{
                    "Buscar":function(){
                        $("#hProv-busq").val($("#sProv-filtro").attr("data-cod-prov"));
                        $("#hMat-busq").val($("#sMat-filtro").val());
                        buscar_data_grid();
                        $("#"+$(".cls-g-map").data("dialog-map-id")).dialog("close");
                        $(this).dialog("close");
                    },
                    "Cancelar":function(){
                        $(this).dialog("close");
                    }
                }
            });
        }
        
        function get_materias(){
            $("#sMat-filtro").load("../include/util/load_data_combo.php",{dbClassDriver:"include/base_datos/base_datos.php",dbDriver:"include/base_datos/mysqlDriver.ini",sourceData:"materia",key:"codigo",description:"nombre",fkeyvalue:"",fkey:""}, function(result){
		//alert(result);
            });
        }
        
        function buscar_data_grid(){
            //alert($("#hProv-busq").val());
            $("#frmConsultaGrid").load("../frmConsultaGrid.php",{pProv:$("#hProv-busq").val(),pMat:$("#hMat-busq").val()});
        }
        
	function frmConsultaget_data_grid($selr){
            if(typeof($selr)=="undefined" || $selr==null || $selr==""){
                    $selr = $("#grid_frmConsultaGrid").jqGrid("getGridParam","selrow");
            }

            var $rows= $("#grid_frmConsultaGrid").jqGrid('getRowData');
            var $row;
            var $xRef;
            var $rowDataGrid = null;
                var $i=0;

            for($i=0;$i<$rows.length;$i++){
                $row=$rows[$i];
                $xRef=$row["codigo_sis"]; //Este campo debe ser dinamico, no estatico id_sis
                if($xRef==$selr){
                    $rowDataGrid = $row;
                    break;
                }
            }
            return $rowDataGrid;
	}

	function frmConsultaGridput_row_data_grid_in_form($selr){
            $data = frmConsultaget_data_grid($selr);
	    $x=null;
            
            $(".cls-info-dep-mat").load("getMateriaPorDep.php",{pDep:$data["codigo_sis"]});
            $(".cls-info-dep-resol").load("getResolPorDep.php",{pDep:$data["codigo_sis"]});
	    //alert($data["codigo_sis"]);
	}