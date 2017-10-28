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


//$pipo = filter_input_array(INPUT_POST);

//SendMail("david.vanhoecke@delair-tech.com", "Test", serialize($_POST));

//SendMail("david.vanhoecke@delair-tech.com", "Test", print_r($_POST));

/*
filter_input(INPUT_POST, 'var_name')

if ($_POST['cmd']) {
  if ($_POST['cmd'] == 'SendMail') {
    SendMail($_POST['to'], $_POST['subject'], $_POST['body'] );
  }
  
  return "yay";
}
*/
function SendMail(string $to, string $subject, string $body) {
    $apikey = 'b20321ec69bf4bfbc8d8ecb3fc07ec8a';
    $apisecret = '5cb7af70eb09c3569a65f7b58ed3cf63';
    $from = 'david.vanhoecke@delair-tech.com';
    //$from = 'davidvanhoecke@gmail.com';
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
        echo "success - email sent";
    else
        echo "error - " . $mj->_response_code;

    return $result;
}


//SendMail("david.vanhoecke@delair-tech.com", "hallo", "machtig vindje, prachtig");
?>

