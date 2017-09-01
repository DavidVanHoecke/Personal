<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html style="height: 90%;">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="300" >
        <title>Muro Control</title>
        <script src="libraries/jquery-3.1.1.min.js"></script>
        <script src="libraries/RGraph.common.core.js"></script>
        <script src="libraries/RGraph.common.key.js"></script>
        <script src="libraries/RGraph.common.dynamic.js"></script>
        <script src="libraries/RGraph.line.js"></script>
        
        <style>
            body{
                font-family: verdana;
                color: #999;
                background-image: url(img/kintsugi-9.jpg);
                background-position: left top;
                background-repeat: no-repeat;
                background-size: 150px;
                background-position-y: 00px;
            }
            H1{
                color: orange;
                margin-left: 150px;
            }
            #graphContainer
            {
                height: 100%;
                width: 100%;
            }
            div.ext-box { 
                display: table; 
                
                border: 0px solid green;
                height: 75px;
                text-align: center;
                float: left;
                margin: 5px;
            }
            div.int-box { 
                display: table-cell; 
                vertical-align: middle; 
            }
            .rgraph_domtext_wrapper{
                margin-left: 50px;
            }
            
            .button{
                padding: 20px;
                font-size: 18px;
                color: white;
                width: 200px;
                background-color: #4285F4;
                border: 1px solid #4285F4;
                border-radius: 4px;
            }
s        </style>
    </head>
    <body style="height: 100%;">
        
        <?php 
                    if (isset($_POST['action'])) {
                        switch ($_POST['action']) {
                            case 'Shutdown':
                                shutdown();
                                break;
                            case 'Restart':
                                restart();
                                break;
                            
                            case 'Reset data':
                                deleteCSVs();
                                break;
                        }
                    }
                    
                    function deleteCSVs() {
                        exec("sudo python /usr/src/deleteCSVs.py");
                        exit;
                    }

                    function shutdown() {
                        exec("sudo python /usr/src/shutdown.py");
                        exit;
                    }

                    function restart() {
                        exec("sudo python /usr/src/restart.py");
                        
                        exit;
                    }
        ?>
        
        
        
        <h1>Muro Control</h1>
        
        
        <script>
            var text_size = "";
            var linewidth = "";
            
        $(document).ready(function(){
            
            $('.button').click(function(){
                var clickBtnValue = $(this).val();
                if(clickBtnValue == "Download CSV"){
                    window.location.href = "/data";
                    return;
                }
                
                if(clickBtnValue == "Reset data"){
                    if(!confirm("Are you sure? This will delete all CSV's...")){
                        return;
                    }
                }
                
                //Reset data
                //alert(clickBtnValue);
                var ajaxurl = 'index.php',
                data =  {'action': clickBtnValue};
                $.post(ajaxurl, data, function (response) {
                    // Response div goes here.
                    //alert("Command failed!");
                });
            });           
            
            sizeGraph();

            var mline = new RGraph.Line({
                id: 'graphContainer',
                data: [
                    <?php
                    $valH = 0.0;
                    $valT = 0.0;
                    $nrOfPointsToAverage = 1; 
                    $currentPointIndex = 0;
                    $dir    = 'data/';
                    $files1 = scandir($dir);
                    $tArrayString = "[";
                    $hArrayString = "[";
                    $xLabelString = "[";
                    foreach ($files1 as $file){
                        if (strpos($file, 'DHT_DATA_') !== false){
                            if (($handle = fopen("data/" . $file, "r")) !== FALSE) {
                                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                                    $currentPointIndex++;
                                    $tArrayString = $tArrayString . "$data[6],";
                                    $hArrayString = $hArrayString . "$data[5],";
                                    if($currentPointIndex == $nrOfPointsToAverage){
                                        $valH = $data[5];
                                        $valT = $data[6];
                                        $currentPointIndex = 0;
                                    }
                                }
                                
                            }
                        }
                    }
                    echo substr($tArrayString, 0, strlen($tArrayString)-1) . "],";
                    echo substr($hArrayString, 0, strlen($hArrayString)-1) . "]";
                    ?>
                ],
                options: {
                    gutterTop: 50,
                    colors: ['orange', '#7CB5EC'],
                    shadow: true,
                    hmargin: 15,
                    linewidth: linewidth,
                    ymin: 0,
                    ymax: 100,
                    ylabelsCount: 10,
                    xlabelsCount: 2,
                    backgroundGridAutofitNumhlines: 7,
                    backgroundGridVlines: false,
                    axisColor: 'gray',
                    textSize: text_size,
                    textAccessible: true,
                    resizable: false,
                    tickmarks: 'line',
                    ticksize: 10,
                    numyticks: 7,
                    title: 'Average T and H',
                    key: ['T','H'],
                    labels: ["<?php 
                        $c = 0;
                        $labelString = "";
                        foreach ($files1 as $file){
                            if (strpos($file, 'DHT_DATA_') !== false){
                                $labelString = $labelString . $file . "\", \"";
                            }
                        }
                        echo substr_replace($labelString, '', -4);
                        
                            ?>"],
                    keyPosition: 'graph',
                    highlightStyle: 'halo'
                }
            }).on('beforedraw', function (obj)
            {
                RGraph.clear(obj.canvas, 'white');
            })
            .draw();
        });
        
        function sizeGraph(){
            var screenWidth = screen.width;
            var canvas  = document.getElementById("graphContainer");
            canvas.width = screenWidth -100;
            RGraph.Reset(canvas);

            canvas.width  = $(window).width() * 0.92;
            canvas.height = $(window).height() * 0.75;
            text_size = Math.min(12, ($(window).width() / 1000) * 10 );
            linewidth = $(window).width() > 500 ? 2 : 1;
            linewidth = $(window).width() > 750 ? 3 : linewidth;
        }
    </script>
        <div class="ext-box" style="border: 1px solid #4285F4; width: 200px; height: 61px; border-radius: 4px; margin-top: 11px;margin-left: 150px;">
            <div class="int-box">
                <span>Current stats <br/><span style="color: orange;">T</span>: <?php echo number_format((float)$valT, 0, '.', '') ?>°, <span style="color: lightblue;">H</span>: <?php echo number_format((float)$valH, 0, '.', '') ?>%</span>
            </div>
        </div>
        <div class="ext-box">
            <div class="int-box">
            <input type="button" class="button" value="Shutdown" />
            </div>
        </div>
        <div class="ext-box">
            <div class="int-box">
            <input type="button" class="button" value="Restart" />
            </div>
        </div>
        <div class="ext-box">
            <div class="int-box">
                <input type="button" class="button" value="Download CSV" />
            </div>
        </div>
        <div class="ext-box">
            <div class="int-box">
                <input type="button" class="button" value="Reset data" />
            </div>
        </div>


        <canvas id="graphContainer">[No canvas support]</canvas>

           
    </body>
</html>
