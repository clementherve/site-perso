<div class="stats" id="stats"></div>
<div class="statbox">
	<div class="stats" id="ipgraph"></div>
	<div class="stats" id="pagegraph"></div>
</div>
<?php
$log = file_get_contents("../log/log.php");
$log = preg_replace("#<\?php|\?>#", "", $log);
$log = json_decode($log, true);
$graph = "";
$c = 0;
$total = 0;
ksort($log, SORT_NATURAL);
foreach($log as $day => $data){
	$d = (int) explode("/", $day)[1];
	$m = (int) explode("/", $day)[0];
	$y = (int) explode("/", $day)[2];
	$n = count($data);
	$graph .= "[Date.UTC({$y}, ".($m-1).", {$d}), {$n}],\n";
	$total += count($data);
	foreach($data as $entry){
		$ip2 = explode(" - ", $entry)[2];
		(isset($ip[$ip2]))?$ip[$ip2]++:$ip[$ip2]=1;

		$page2 = explode(" - ", $entry)[1];
		(isset($page[$page2]))?$page[$page2]++:$page[$page2]=1;

	}
}
//ip pie graph
arsort($ip, SORT_NATURAL);
$i=0;
$ipgraph="";
foreach($ip as $key => $ipcount){
	$i++;
	if($i>9){ break; }
	$ipgraph .= "{name: \"".$key."\", y: ".$ipcount."},";
}
//page pie graph
arsort($page, SORT_NATURAL);
$pagegraph="";
foreach($page as $key => $pagecount){
	$pagegraph .= "{name: \"".$key."\", y: ".$pagecount."},";
}

echo "<div class=\"total_view\">{$total} pages vues</div>";
krsort($log, SORT_NATURAL);
foreach($log as $day=>$array){
	$c++;
	if($c > 1){break;}

	echo "<h3 class=\"list_head\">{$day}<h3>\n";
    krsort($array, SORT_NATURAL);
	foreach($array as $data){
		if(preg_match("#search#", $data)){
			echo "<div class=\"list nocursor search_stat\">\n";
		} else if(preg_match("#json#", $data)){
			echo "<div class=\"list nocursor article_stat\">\n";
		} else {
			echo "<div class=\"list nocursor\">\n";
		}
		echo "\t<div class=\"first\">\n";
		$ip = explode(" - ", $data)[2];
		$page = $page = explode(" - ", $data)[1];
		if(file_exists("../articles/".$page)){
			$page = json_decode(file_get_contents("../articles/".explode(" - ", $data)[1]), true)["title"];
		}
		$date = explode(" - ", $data)[0];
		echo "\t\t<div>".$date."</div>\n\t\t<div>".$page."</div>\n\t\t<div class=\"ip\">".$ip."</div>\n";
		echo "\t</div>\n\t<div class=\"ip_data\"></div>\n</div>\n";
	}
}

?>

<script>

	$(".nocursor").on("click", function(){
		var ip = $(this).find(".ip").html();
		var ip_data = $(this).find(".ip_data");
		if(ip_data.html() == ""){
			$(".ip_data").css({"height":"0px"});
			$(".ip_data").empty();
			$.post("admin/functions/ip_lookup.php", {"ip": ip})
			.always(function(data){
				ip_data.css({"height":"160px"});
				ip_data.html(data);
			});
		} else {
			$(".ip_data").css({"height":"0px"});
			$(".ip_data").empty();
		}
	});
	/*===============================*/
	/*          GRAPH JS             */
	/*===============================*/
	Highcharts.chart('stats', {
	    title: {
	        text: " ",
	    },
	    yAxis: {
	        title: {
	            text: "",
	        }
	    },
	    xAxis: {
	        type: "datetime",
	        dateTimeLabelFormats: {
	            day: "%e. %b",
	            year: ""
	        },
	        title: {
	            text: ""
	        }
	    },
	    chart: {
	        backgroundColor: "transparent",
	    },
	    credits: {
	        enabled: false,
	    },
	    legend: {
        	enabled: false
    	},
	    tooltip: {
	        borderColor: "transparent",
	    },
	    //data
	    series: [{
	        name: "Pages vues",
	        data: [
	            <?php echo $graph ?>
	        ]
	    }]
	});

    //PIE CHART FOR IPS
    Highcharts.chart('ipgraph', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Ip Fréquentes'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        credits: {
	        enabled: false,
	    },
        series: [{
            name: 'ip',
            colorByPoint: true,
            data: [
            <?php echo $ipgraph ?>
            /*
            {
                name: 'article 1',
                y: 50
            }*/
                ]
        }]
    });
    //PIE CHART FOR PAGES
    Highcharts.chart('pagegraph', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Pages Fréquentes'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: false
            }
        },
        credits: {
	        enabled: false,
	    },
        series: [{
            name: 'pages',
            colorByPoint: true,
            data: [
            <?php echo $pagegraph ?>
            /*
            {
                name: 'article 1',
                y: 50
            }*/
                ]
        }]
    });
</script>