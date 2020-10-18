<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    private $token = "";

    protected function callApiGuzzle($method, $uri, $params){
        $client = new Client(['base_uri' => 'http://api-voxus.local/']);
        $response =  $client->request($method, $uri, $params );
        return json_decode((string)$response->getBody()->getContents());
    }

    protected function login(){
        $payload = [
            'form_params' => [
                'email' => 'ackeley@gmail.com',
                'password' => 'test1234'
            ]
        ];
        $response = $this->callApiGuzzle('POST', '/api/login', $payload);
        $token = $response->token;
        return $token;

    }

    /**
     * @doesNotPerformAssertions
     */
    public function testCreateUser(){
        $payload = [
            'form_params' => [
                'name'  => 'Api User',
                'email' => 'apiuser@apiuser.com',
                'password' => '12345678'
            ]
        ];
        $response = $this->callApiGuzzle('POST', '/api/register', $payload);
        echo $response->success.PHP_EOL;

    }

    public function testSaveLocation(){

        $token = $this->login();
        $payload = [
            'headers' => [
                    'Authorization' => 'Bearer ' .$token,
                    'Accept'        => 'application/json'
            ],
            'form_params' => [
                'user_id'   => '13',
                'latitude'  => '-23.561297',
                'longitude' => '-46.656476'
            ]
        ];

        $response = $this->callApiGuzzle('POST', '/api/save-location', $payload);
        echo $response->success.PHP_EOL;
    }

    public function testGetUser(){
        $token = $this->login();
        $payload = [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Accept'        => 'application/json'
            ]
        ];

        $response = $this->callApiGuzzle('GET', '/api/user/13', $payload);
        print_r($response);
    }
}
