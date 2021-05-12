<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cot_mail_custom($fmail, $subject, $body, $headers = '', $customtemplate = false, $additional_parameters = null, $html = true) {
    global $cfg;
    
    define("DOMAIN", $cfg["plugin"]["mailgun"]["domain"]);
    define("API", $cfg["plugin"]["mailgun"]["key"]);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:'.API);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v2/'.DOMAIN.'/messages');
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => $cfg["plugin"]["mailgun"]["sender"],
        'to' => $fmail,
        'subject' => $subject,
        'html' => $body));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
