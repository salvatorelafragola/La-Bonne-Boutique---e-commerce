<?php

namespace App\Classe;

use Mailjet\Client;
use \Mailjet\Resources;

class Mail 
{

    private $api_key = '277dba5c6f6249c9da02b085930901f7';
    private $api_key_secret = 'fc59406c846c2435342be76d32f73b66';

    public function send($to_mail, $to_name, $subject, $content){
        /*
        This call sends a message based on a template.
        */
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "totorkamen93@hotmail.it",
                        'Name' => "La Bonne Boutique"
                    ],
                    'To' => [
                        [
                            'Email' => $to_mail,
                            'Name' => $to_name
                        ]
                    ],
                    'TemplateID' => 2127812,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    "Variables" => [
                        "content" => $content
                    ]
				]
		    ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}
