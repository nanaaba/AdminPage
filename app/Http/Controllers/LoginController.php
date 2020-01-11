<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ConfigurationController;

class LoginController extends Controller {

    public function authenticateuser(Request $request) {

        $data = $request->all(); // This will get all the request data.

        $username = $request['username'];
        $password = $request['password'];

        return $this->userAuthentication($username, $password);
    }

    public function userAuthentication($username, $password) {




        $url = config('constants.TEST_URL');

        $baseurl = $url . 'account/token';



        $client = new Client();

        try {


            $response = $client->post($baseurl, [
                'form_params' => [
                    'grant_type' => 'password',
                    'username' => $username,
                    'password' => $password
                ]
            ]);
            $body = $response->getBody();

            $bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

             //   $this->setSettings();
                session(['username' => $bodyObj->fullname]);
                session(['role' => $bodyObj->role]);

                session(['token' => $bodyObj->access_token]);
                $data = array('status' => 0, 'message' => 'success' . $bodyObj->userName);
                return json_encode($data);
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {


            $data = array('status' => 1, 'message' => "Username or password mismatch");
            return json_encode($data);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $data = array('status' => 1, 'message' => "System Error.PLease Contact System Administrator.");
            return json_encode($data);
        }
    }

}
