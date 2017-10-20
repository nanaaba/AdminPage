<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   
    return view('login');
 
});
Route::get('dashboard', 'DashboardController@showdashboard');
Route::get('category', 'CategoryController@showcategory');
Route::get('product/new', 'ProductController@showproduct');
Route::get('product/all', 'ProductController@showproducts');
Route::get('orders/pending', 'OrderController@showpending');
Route::get('orders/processed', 'OrderController@showprocessed');
Route::get('orders/shipped', 'OrderController@showshipped');
Route::get('orders/delievered', 'OrderController@showdeleivered');
Route::get('users/customers', 'UserController@showcustomers');
Route::get('users/system', 'UserController@showsystemusers');
Route::get('product/detail/{itemid}', 'ProductController@showproductdetail');
Route::get('category/detail/{catid}', 'CategoryController@showcategorydetail');
Route::get('promotion/detail/{promoid}', 'ProductController@showpromotiondetail');

Route::get('product/featured', 'ProductController@showfeaturedproducts');
Route::get('banners', 'ProductController@showbanners');
Route::get('promotions', 'ProductController@showpromotions');


//featured

//apis  saveitem

//products
Route::get('product/allitems', 'ProductController@getAllItems');
Route::post('product/saveitem', 'ProductController@addNewItem');
Route::post('product/updateitem', 'ProductController@updateItem');
Route::delete('product/deleteitem/{itemid}', 'ProductController@deleteItem');
Route::get('product/featureditems', 'ProductController@getFeaturedItems');
Route::post('product/addfeatureditem', 'ProductController@addfeaturedItems');
Route::delete('product/removefeatured/{itemid}', 'ProductController@removeFeaturedItem');

//addfeatureditem
//removefeatured
//categories
Route::get('category/all', 'CategoryController@getAllCategories');
Route::post('category/save', 'CategoryController@addCategory');
Route::delete('category/deletecategory/{itemid}', 'CategoryController@deleteCategory');
Route::get('category/{itemid}', 'CategoryController@getCategoryDetail');
Route::post('category/update', 'CategoryController@updateCategory');
Route::delete('product/deleteitem/{itemid}', 'ProductController@deleteItem');

//banners
Route::get('banner/all', 'ProductController@getAllBanners');
Route::delete('banner/{itemid}', 'ProductController@deleteBanner');
Route::post('banner/save', 'ProductController@addBanner');

//promotions promotion/item/save
Route::get('promotions/all', 'ProductController@getAllPromotions');
Route::post('promotion/save', 'ProductController@addPromotion');
Route::delete('promotion/{promoid}', 'ProductController@deletePromotion');
Route::post('promotion/item/save', 'ProductController@addPromotionItem');
Route::post('promotion/update', 'ProductController@editPromotion');
