/*========= Starting function =========*/
$(function(){

	/*========= chartline 02 =========*/
	var sin = [], cos = [];
		for (var i = 0; i < 21; i += 0.5) {
			sin.push([i, Math.sin(i)]);
			cos.push([i, Math.cos(i)]);
	}

	var plot = $.plot($("#chartLine01"),
		[ { data: sin, label: "Sales (this month)"}, { data: cos, label: "Profit (this month)" } ], {
			series: {
			lines: { show: true },
			points: { show: true, lineWidth: 2 }, 
			shadowSize: 0,
		},
			grid: { hoverable: true, clickable: true, borderWidth: 0 },
			yaxis: { min: -1.2, max: 1.2 },
		    colors: [ "#77aae9", "#f36a30" ],
	        legend: {
	            show: false
	        }
	});

	/*========= chartline 01 =========*/
	var d1 = [4.3, 5.1, 4.3, 5.2, 5.4, 4.7, 3.5, 4.1, 5.6, 7.4, 6.9, 7.1,
    7.9, 7.9, 7.5, 6.7, 7.7, 7.7, 7.4, 7.0, 7.1, 5.8, 5.9, 7.4,
    8.2, 8.5, 9.4, 8.1, 10.9, 10.4, 10.9, 12.4, 12.1, 9.5, 7.5,
    7.1, 7.5, 8.1, 6.8, 3.4, 2.1, 1.9, 2.8, 2.9, 1.3, 4.4, 4.2,
    3.0, 3.0], 

	d2 = [0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.1, 0.0, 0.3, 0.0,
	    0.0, 0.4, 0.0, 0.1, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0,
	    0.0, 0.6, 1.2, 1.7, 0.7, 2.9, 4.1, 2.6, 3.7, 3.9, 1.7, 2.3,
	    3.0, 3.3, 4.8, 5.0, 4.8, 5.0, 3.2, 2.0, 0.9, 0.4, 0.3, 0.5, 0.4], 

	options = {
	    series: {
	        lines: { 
	            show: true, 
	            fill: true, 
	            lineWidth: 2, 
	            steps: false, 
	            fillColor: { colors: [{opacity: 0.25}, {opacity: 0}] } 
	        },
	        points: { 
	            show: true, 
	            radius: 4, 
	            fill: true,
	            lineWidth: 2
	        }
	    }, 
	    tooltip: true, 
	    tooltipOpts: {
	        content: '%s: %y'
	    }, 
	    xaxis: { mode: "time" }, 
	    grid: { borderWidth: 0, hoverable: true },
	    legend: {
	        show: false
	    }
	};

	var dt1 = [], dt2 = [], st = new Date(2009, 9, 6).getTime();

	for( var i = 0; i < d2.length; i++ )
	{
	    dt1.push([st + i * 3600000, parseFloat( (d1[i]).toFixed( 3 ) )]);
	    dt2.push([st + i * 3600000, parseFloat( (d2[i]).toFixed( 3 ) )]);
	}

	var data = [
	    { data: dt1, color: '#77aae9', label: 'This month sales', lines: { lineWidth: 1 } }, 
	    { data: dt2, color: '#f36a30', label: 'Last month profit', points: { show: false }, lines: { lineWidth: 2, fill: false } }
	];

	$.plot($("#chartLine02"), data, options);

	function showTooltip(x, y, contents) {
	    $('<div id="tooltip">' + contents + '</div>').css( {
	        position: 'absolute',
	        display: 'none',
	        //float: 'left',
	        top:  y - 40,
	        left: x - 30,
	        color: '#cccccc',
	        fontSize: '11px',
	        fontFamily: 'Arial',
	        fontWeight: 'normal',
	        padding: '4px 10px',
	        'background-color': 'rgba(47, 47, 47, 0.8)'
	    }).appendTo("body").fadeIn(200);
	 }


	var previousPoint = null;
	$("#chartLine02").bind("plothover", function (event, pos, item){
	    $("#x").text(pos.x.toFixed(2));
	    $("#y").text(pos.y.toFixed(2));
	    if (item) {
	        if (previousPoint != item.dataIndex){
	            previousPoint = item.dataIndex;

	            $("#tooltip").remove();
	            var x = item.datapoint[0].toFixed(2),
	                y = item.datapoint[1].toFixed(2);

	                showTooltip(item.pageX, item.pageY,
	                        item.series.label +" = "+ y);
	                                            }
	    }
	    else {
	        $("#tooltip").remove();
	        previousPoint = null;
	     }
	});


	/*========= piechart =========*/
	var data = [
	    { label: "Hotel Mulia Senayan", data: Math.random() * 2500 + 500, color: "#83b3ee" }, 
	    { label: "Hotel Grand Hyatt", data: Math.random() * 2500 + 500, color: "#d57d64" }, 
	    { label: "Shangrila Hotel", data: Math.random() * 2500 + 500, color: "#97c26a" }, 
	    { label: "Twin Plaza Hotel", data: Math.random() * 2500 + 500, color: "#eeb755" }, 
	    { label: "Merlynn Park Hotel", data: Math.random() * 2500 + 500, color: "#b3a1f2" }, 
	];

	var opts = {
	    series: {
	        pie: {
	            show: true,  
	            innerRadius: 0.4, 
	            offset: {
	                left: 0
	            }, 
	            stroke: {
	                width: 1,
	                color: "#ffffff"
	            }
	        }
	    }, 
	    legend: {
	        show: false
	    }, 
	    grid: {
	        hoverable: true
	    }
	};

	$.plot($("#chartPie01"), data, opts);


});
/*========= End of function =========*/