<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$desiredTemp = $request->desiredTemp;

SetDesiredTemp($desiredTemp);


function SetDesiredTemp(int $desiredTemp) {
    echo("Start cmd execution.<br />");
    $cmd = "sudo python setTempAndWriteResults.py " . $desiredTemp;
    exec($cmd);
    echo($cmd . "<br />");
    echo("Cmd executed");
    exit;
}

?>

