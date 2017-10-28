<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("simpleMailer.php");


$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$to = $request->to;
$subject = $request->subject;
$body = $request->body;

SendMail($to, $subject, $body);


$cookie_name = "landingPage";
$cookie_value = "visited";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

function SendMail(string $to, string $subject, string $body) {
    $apikey = 'b20321ec69bf4bfbc8d8ecb3fc07ec8a';
    $apisecret = '5cb7af70eb09c3569a65f7b58ed3cf63';
    $from = 'david.vanhoecke@delair-tech.com';
    
    $mj = new Mailjet($apikey, $apisecret);
    $params = array(
        "method" => "POST",
        "from" => $from,
        "to" => $to,
        "subject" => $subject,
        "text" => $body
    );

    $result = $mj->sendEmail($params);

    if ($mj->_response_code == 200)
    {
        // set cookie
        $cookie_name = "landingPage";
        $cookie_value = "visited";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        echo "success - email sent";
    }
    else
    {
        echo "error - " . $mj->_response_code;
    }

    return $result;
}

?>

