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
    // return view('welcome');
});

Auth::routes();

// // du-an
// Route::get('/danh-sach-du-an.html', 'User\ProjectController@index')->name('user.projects');
// Route::get('/danh-sach-du-an/{type?}.html', 'User\ProjectController@projectType')->name('user.projects.type');
// Route::get('/du-an/{slug?}.html', 'User\ProjectController@projectDetail')->name('user.project');

// // lien-he
// Route::post('/lien-he.html', 'User\ContactController@store')->name('user.contact');
// Route::get('/lien-he.html', 'User\ContactController@index')->name('user.contact.index');
// // gioi-thieu
// Route::get('/gioi-thieu.html', 'User\AboutController@index')->name('user.about');
// // hinh-anh
// Route::get('/hinh-anh.html', 'User\ImageController@index')->name('user.image');

Route::get('/', 'Site\HomeController@index')->name('site.index');

Route::get('/san-pham-yeu-thich', 'Site\FavoriteController@index')->name('site.favorite');
Route::get('/san-pham', 'Site\ProductController@index')->name('site.product');
Route::get('/lien-he.html', 'Site\ContactController@index')->name('site.contact');
Route::get('/san-pham/{product}-{slug}.html', 'Site\ProductController@detail')->name('site.product.detail');
Route::post('/add-to-card', 'Site\ProductController@addToCart')->name('site.cart.add');
Route::get('/gio-hang', 'Site\ProductController@cart')->name('site.cart');
Route::get('/thanh-toan', 'Site\ProductController@payment')->name('site.payment');

Route::get('/thuong-hieu/{trademark}', 'Site\TrademarkController@trademark')->name('site.trademark');


Route::get('{category}', 'Site\CategoryController@category')->name('site.category');
Route::get('/{categoryParent}/{category}', 'Site\CategoryController@categoryParent')->name('site.category.parent');


// API
Route::post('/payment', 'Site\ProductController@storePayment')->name('site.payment.post');
Route::post('/list-cart', 'Site\ProductController@listCart')->name('site.cart.add');
Route::get('/product/all/list', 'Site\ProductController@productList')->name('site.product.all');
Route::get('/category/{category}/products', 'Site\CategoryController@categoryList')->name('site.category.product');
Route::get('/trademark/{trademark}/products', 'Site\TrademarkController@trademarkList')->name('site.trademark.product');
Route::get('/favorite/list/products', 'Site\FavoriteController@favoriteList')->name('site.favorite.product');

