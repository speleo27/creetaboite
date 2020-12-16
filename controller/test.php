<?php


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "SandboxMode": false,
    "Messages": [
        {
            "From": {
                "Email": "sebastien.rossi@gretasudchampagne.com"
           
            },
            
            "To": [
                {
                    "Email": "seb10400@orange.fr"
                   
                }
            ],
          
            "Subject": "envoyer par localhost",
           
            "HTMLPart": "blabla",
           
            
            
          
            "Priority": 2
            
        }
    ]
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Basic ZWU4N2VjOWMwNjU1ZDE3ZjZlZTRiZWZmZGIyMTgzMWY6ZmIzNTc3OWZmMzhhZDBhOThiNWVjOWE3Njg3NzNmOWM='
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
