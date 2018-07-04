<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use File;

class AuthModeuleTest extends TestCase
{
    /**
    *@test
    **/
    public function AuthLogin()
    {
        $data = [
          'email' => 'jlaucho@gmail.com',
          'password'=> '14460484'
        ];
        // $response = $this->post('validacion', ['_token' => csrf_token()]);
        $response = $this->post(env("PREFIX_API").'auth/login', $data);

        if (!$response->baseResponse->original["ok"]) {
            dd('Fallo la validacion verifique los datos del usuario ');
        }
        $headers = [
          'token' => 'Bearer '.$response->baseResponse->original["token"]
        ];
        File::put(public_path('/token.json'), json_encode($headers));
        $this->assertEquals(true, $response->baseResponse->original["ok"]);
    }

    public function testAuthMe()
    {
        $token = json_decode(file_get_contents(public_path('/token.json', true)));
        $headers = ['Authorization' => $token->token];
        $response = $this->withHeaders($headers)->json('POST', env("PREFIX_API").'auth/me');
        //     $response = $this->postJson(env("PREFIX_API").'auth/me', [ '', $headers]);
        // $response->assertForbidden();
        $this->assertEquals(true, $response->baseResponse->original["ok"]);
    }
}
