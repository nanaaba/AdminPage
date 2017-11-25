<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function showcustomers() {

        return view('customers');
    }

    public function showsystemusers() {

        return view('systemusers');
    }

    public function getAllCustomers() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getAllUsers() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function deleteUser($userid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/' . $itemid;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('DELETE', $baseurl);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function registerUser(Request $request) {

        /* function to register user 
         * send email to user after registering
         * email contain username and password
         */

        $data = $request->all();


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/Account/Register';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'platform' => 'Web',
                'appVersion' => 'Beta'
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "fullname" => $data['name'],
                "email" => $data['email'],
                "phone" => $data['telephone'],
                "deviceImei" => rand(0, 100) . time(),
                "key" => rand(0, 100) . time(),
                "av" => "",
                "userAgent" => "Web",
                "platform" => "Web",
                "notoficationId" => "Web",
                "password" => $data['password']
            );

            // return json_encode($arr);
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            $bodobj = json_decode($body, true);

            $status = $bodobj['status'];

            if ($status == 0) {
                $userid = $bodobj['data']['customer']['userID'];
//            $userID = $userid['userID'];
                if (!empty($data['categories'])) {
                    $results = $this->AddUserCategories($userid, $data['categories']);
                }
            }



            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function updateUser(Request $request) {

        /* function to register user 
         * send email to user after registering
         * email contain username and password
         */

        $data = $request->all();


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/Account/Register';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'platform' => 'Web',
                'appVersion' => 'Beta'
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "fullname" => $data['name'],
                "email" => $data['email'],
                "phone" => $data['telephone'],
                "deviceImei" => rand(0, 100) . time(),
                "key" => rand(0, 100) . time(),
                "av" => "",
                "userAgent" => "Web",
                "platform" => "Web",
                "notoficationId" => "Web",
                "password" => $data['password']
            );

            // return json_encode($arr);
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            $bodobj = json_decode($body, true);

            $status = $bodobj['status'];

            if ($status == 0) {
                $userid = $bodobj['data']['customer']['userID'];
//            $userID = $userid['userID'];
                if (!empty($data['categories'])) {
                    $results = $this->AddUserCategories($userid, $data['categories']);
                }
            }



            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
