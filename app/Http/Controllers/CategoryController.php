<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function showcategory() {

        return view('category');
    }

    public function showcategorydetail($catid) {

        $itemdata = $this->getCategoryDetail($catid);

        return view('categorydetail')->with('itemdata', $itemdata);
    }

    public function addCategory(Request $request) {


        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/categories';



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
                    ]
                ],
            ]);



            $body = $response->getBody();

            if ($response->getStatusCode() == 201) {
                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getAllCategories() {

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

    public function deleteCategory($itemid) {


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

    public function getCategoryDetail($itemid) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/' . $itemid;

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

    public function updateCategory(Request $request) {

        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/categories';



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
                        'name' => 'id',
                        'contents' => $data['catid']
                    ]
                ],
            ]);



            $body = $response->getBody();

            if ($response->getStatusCode() == 201) {
                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
