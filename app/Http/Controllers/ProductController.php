<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function showproduct() {


        return view('newproduct');
    }

    public function showproducts() {


        return view('products');
    }

    public function showbanners() {
        return view('banners');
    }

    public function showpromotions() {
        return view('promotions');
    }

    public function showpromotiondetail($promoid) {

        $promoinfo = $this->getPromotionDetail($promoid);
        return view('promotiondetail')->with('promodata',$promoinfo);
    }

     public function getPromotionDetail($promoid) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/promotions/'.$promoid;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body,true); 
            if ($response->getStatusCode() == 200) {

                return $bodyObj['data'];
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    
    
    public function getAllBanners() {
        $url = config('constants.TEST_URL');

        $baseurl = $url . '/banners';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http-errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

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

    public function deleteBanner($bannerid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/banners/' . $bannerid;

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

    public function addBanner(Request $request) {


        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/banners';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);

        $type = $data['type'];
        if ($type == "category") {
            $identifier = $data['categories'];
        }

        if ($type == "promotion") {
            $identifier = $data['promotions'];
        }
        if ($type == "item") {
            $identifier = $data['items'];
        }


        if ($request->hasFile('banner')) {
            if ($request->file('banner')) {
                $bannerfile = file_get_contents($_FILES['banner']['tmp_name']);
            }
        } else {
            $bannerfile = "";
        }

        try {

            $response = $client->request('POST', $baseurl, [
                'multipart' => [

                    [
                        'name' => 'banner',
                        'contents' => $bannerfile,
                        'filename' => $_FILES['banner']['name']
                    ],
                    [
                        'name' => 'title',
                        'contents' => $data['name']
                    ],
                    [
                        'name' => 'type',
                        'contents' => $data['type']
                    ],
                    [
                        'name' => 'identifier',
                        'contents' => $identifier
                    ]
                ],
            ]);



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

    public function addPromotion(Request $request) {



        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/promotions';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);



        if ($request->hasFile('banner')) {
            if ($request->file('banner')) {
                $bannerfile = file_get_contents($_FILES['banner']['tmp_name']);
            }
        } else {
            $bannerfile = "";
        }

        try {

            $response = $client->request('POST', $baseurl, [
                'multipart' => [

                    [
                        'name' => 'banner',
                        'contents' => $bannerfile,
                        'filename' => $_FILES['banner']['name']
                    ],
                    [
                        'name' => 'name',
                        'contents' => $data['name']
                    ],
                    [
                        'name' => 'expiryDate',
                        'contents' =>  date("Y-m-d", strtotime($data['enddate']) )
                    ]
                ],
            ]);



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

    public function getAllPromotions() {
        $url = config('constants.TEST_URL');

        $baseurl = $url . '/promotions';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http-errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

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

    public function deletePromotion($promoid) {



        $url = config('constants.TEST_URL');

        $baseurl = $url . '/promotions/' . $promoid;

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

    public function editPromotion(Request $request) {



        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/promotions';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);



        if ($request->hasFile('banner')) {
            if ($request->file('banner')) {
                $bannerfile = file_get_contents($_FILES['banner']['tmp_name']);
            }
        } else {
            $bannerfile = "";
        }

        try {

            $response = $client->request('PUT', $baseurl, [
                'multipart' => [

                    [
                        'name' => 'banner',
                        'contents' => $bannerfile,
                        'filename' => $_FILES['banner']['name']
                    ],
                    [
                        'name' => 'name',
                        'contents' => $data['name']
                    ],
                    [
                        'name' => 'expiryDate',
                        'contents' => $data['enddate']
                    ],
                    [
                        'name' => 'promotionId',
                        'contents' => $data['promotionId']
                    ]
                //
                ],
            ]);



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

    public function addPromotionItem(Request $request) {



        $data = $request->all();

        $baseurl = 'tfs.knust.edu.gh/ecommerce/promotions/items';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);

 $type = $data['type'];
        if ($type == "category") {
            $identifier = $data['categories'];
        }

        if ($type == "promotion") {
            $identifier = $data['promotions'];
        }
        if ($type == "item") {
            $identifier = $data['items'];
        }

        if ($request->hasFile('banner')) {
            if ($request->file('banner')) {
                $bannerfile = file_get_contents($_FILES['banner']['tmp_name']);
            }
        } else {
            $bannerfile = "";
        }

        try {

            $response = $client->request('POST', $baseurl, [
                'multipart' => [

                    [
                        'name' => 'banner',
                        'contents' => $bannerfile,
                        'filename' => $_FILES['banner']['name']
                    ],
                    [
                        'name' => 'name',
                        'contents' => $data['name']
                    ],
                    [
                        'name' => 'itemId',
                        'contents' => $identifier
                    ],
                    [
                        'name' => 'itemType',
                        'contents' => $data['type']
                    ],
                    [
                        'name' => 'promotionId',
                        'contents' => $data['promotionId']
                    ]
                ],
            ]);



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

    public function deletePromotionItem($promoid) {


//
//        $url = config('constants.TEST_URL');
//
//        $baseurl = $url . '/promotions/' . $promoid;
//
//        $client = new Client([
//            'headers' => [
//                'Accept' => 'application/json'
//            ],
//        ]);
//        try {
//
//            $response = $client->request('DELETE', $baseurl);
//
//            $body = $response->getBody();
//
//            if ($response->getStatusCode() == 200) {
//
//                return $body;
//            }
//        } catch (RequestException $e) {
//            return 'Http Exception : ' . $e->getMessage();
//        } catch (Exception $e) {
//            return 'Internal Server Error:' . $e->getMessage();
//        }
    }

    public function showproductdetail($itemid) {

        $itemdata = $this->getItemDetail($itemid);
       // print_r($itemdata);
        return view('itemdetail')->with('itemdata', $itemdata);
    }

    public function addNewItem(Request $request) {


        $data = $request->all();


        $url = config('constants.TEST_URL');
        $baseurl = $url . 'items';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);

        if ($request->hasFile('icon')) {
            if ($request->file('icon')) {
                $iconfile = file_get_contents($_FILES['icon']['tmp_name']);
            }
        } else {
            $iconfile = "";
        }

        if ($request->hasFile('banner')) {
            if ($request->file('banner')) {
                $bannerfile = file_get_contents($_FILES['banner']['tmp_name']);
            }
        } else {
            $bannerfile = "";
        }

        try {

            $response = $client->request('POST', $baseurl, [
                'multipart' => [
                    [
                        'name' => 'icon',
                        'contents' => $iconfile,
                        'filename' => $_FILES['icon']['name']
                    ],
                    [
                        'name' => 'banner',
                        'contents' => $bannerfile,
                        'filename' => $_FILES['banner']['name']
                    ],
                    [
                        'name' => 'name',
                        'contents' => $data['name']
                    ],
                    [
                        'name' => 'price',
                        'contents' => $data['price']
                    ],
                    [
                        'name' => 'description',
                        'contents' => $data['description']
                    ],
                    [
                        'name' => 'ingredients',
                        'contents' => $data['ingredients']
                    ],
                    [
                        'name' => 'quantity',
                        'contents' => $data['quantity']
                    ],
                    [
                        'name' => 'categoryid',
                        'contents' => $data['categoryid']
                    ],
                    [
                        'name' => 'barcode',
                        'contents' => $data['barcode']
                    ]
                ],
            ]);



            $body = $response->getBody();
            $bodyObj = json_decode($body);


            //   return 'code'. $response->getStatusCode();
//
            if ($response->getStatusCode() == 200) {
                return json_encode($bodyObj);
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getAllItems() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . 'items';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            } else {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function deleteItem($itemid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/' . $itemid;

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

    public function getItemDetail($itemid) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/' . $itemid;

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

                return $bodyObj->data;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function updateItem(Request $request) {


        $data = $request->all();


        $url = config('constants.TEST_URL');
        $baseurl = $url . 'items';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);


        if ($request->hasFile('icon')) {
            if ($request->file('icon')) {
                $iconfile = file_get_contents($_FILES['icon']['tmp_name']);
            }
        } else {
            $iconfile = "";
        }

        if ($request->hasFile('banner')) {
            if ($request->file('banner')) {
                $bannerfile = file_get_contents($_FILES['banner']['tmp_name']);
            }
        } else {
            $bannerfile = "";
        }
        try {

            $response = $client->request('PUT', $baseurl, [
                'multipart' => [
                    [
                        'name' => 'icon',
                        'contents' => $iconfile,
                        'filename' => $_FILES['icon']['name']
                    ],
                    [
                        'name' => 'banner',
                        'contents' => $bannerfile,
                        'filename' => $_FILES['banner']['name']
                    ],
                    [
                        'name' => 'name',
                        'contents' => $data['name']
                    ],
                    [
                        'name' => 'price',
                        'contents' => $data['price']
                    ],
                    [
                        'name' => 'description',
                        'contents' => $data['description']
                    ],
                    [
                        'name' => 'ingredients',
                        'contents' => $data['ingredients']
                    ],
                    [
                        'name' => 'quantity',
                        'contents' => $data['quantity']
                    ],
                    [
                        'name' => 'categoryid',
                        'contents' => $data['categoryid']
                    ],
                    [
                        'name' => 'barcode',
                        'contents' => $data['barcode']
                    ],
                    [
                        'name' => 'id',
                        'contents' => $data['itemid']
                    ]
                ],
            ]);



            $body = $response->getBody();
            $bodyObj = json_decode($body);


            //   return 'code'. $response->getStatusCode();
//
            if ($response->getStatusCode() == 200) {
                return json_encode($bodyObj);
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function showfeaturedproducts() {

        return view('featuredproducts');
    }

    public function getFeaturedItems() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . 'items/featured';

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

    public function addfeaturedItems(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . 'items/featured';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        $arr = array(
            "userid" => 1,
            "items" => $request['items']
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $arr]);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function removeFeaturedItem($itemid) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/featured/' . $itemid;

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

}
