<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OrderController extends Controller {

    public function showorders() {
        $status = $this->getAllOrderStatus();

        return view('orders')->with('statuses', $status);
    }

    public function getOrdertypeOrders($ordertype) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/orders/status/' . $ordertype;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getAllOrders() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/orders';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getAllOrderStatus() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/orders/status';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);

            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getOrderDetail($orderno) {

        $details = $this->getOrderDetailServer($orderno);
        $bodyObj = json_decode($details, true);
       // print_r($bodyObj);
        if (array_key_exists('data', $bodyObj)) {
            //key exists, do stuff
            $orderInfo = $bodyObj['data'];
            return view('orderinvoice')->with('orderinfo',$orderInfo);
        } else {
            return 'bad';
        }
    }

    public function getOrderDetailServer($orderno) {
        $url = config('constants.TEST_URL');

        $baseurl = $url . '/orders/'.$orderno;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
