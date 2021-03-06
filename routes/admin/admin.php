<?php
/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin" middleware group. Enjoy building your API!
|
*/

// // SEO setting
// Route::get('user', 'Admin\UserController@index')->name('admin.user');

// Route::get('/user/form/{object?}', 'Admin\UserController@initForm')->name('admin.user.form');

// Route::post('/user/form/{object?}', 'Admin\UserController@actionForm');

// Route::get('/user/delete/{object}', 'Admin\UserController@delete');

// Route::get('/user/active/{object}', 'Admin\UserController@active');

// // SEO setting
// Route::get('setting/seo', 'Admin\SEOController@index')->name('admin.seo');

// Route::get('/setting/seo/form/{object?}', 'Admin\SEOController@initForm')->name('admin.seo.form');

// Route::post('/setting/seo/form/{object?}', 'Admin\SEOController@actionForm');

// Route::get('/setting/seo/delete/{object}', 'Admin\SEOController@delete');

// Route::get('/setting/seo/active/{object}', 'Admin\SEOController@active');


// // Header setting
// Route::get('setting/header', 'Admin\HeaderSettingController@index');

// Route::get('/setting/header/form/{object?}', 'Admin\HeaderSettingController@initForm');

// Route::post('/setting/header/form/{object?}', 'Admin\HeaderSettingController@actionForm');

// Route::get('/setting/header/delete/{object}', 'Admin\HeaderSettingController@delete');

// Route::get('/setting/header/active/{object}', 'Admin\HeaderSettingController@active');

// // Footer setting
// Route::get('setting/footer', 'Admin\FooterSettingController@index');

// Route::get('/setting/footer/form/{object?}', 'Admin\FooterSettingController@initForm');

// Route::post('/setting/footer/form/{object?}', 'Admin\FooterSettingController@actionForm');

// Route::get('/setting/footer/delete/{object}', 'Admin\FooterSettingController@delete');

// Route::get('/setting/footer/active/{object}', 'Admin\FooterSettingController@active');
// // About
// Route::get('about', 'Admin\AboutController@index')->name('admin.about');

// Route::get('/about/form/{object?}', 'Admin\AboutController@initForm')->name('admin.about.form');

// Route::post('/about/form/{object?}', 'Admin\AboutController@actionForm');

// Route::get('/about/delete/{object}', 'Admin\AboutController@delete');

// Route::get('/about/active/{object}', 'Admin\AboutController@active');

// // Project
// Route::get('projects', 'Admin\ProjectController@index')->name('admin.project');

// Route::get('/projects/form/{object?}', 'Admin\ProjectController@initForm')->name('admin.project.form');

// Route::post('/projects/form/{object?}', 'Admin\ProjectController@actionForm');

// Route::get('/projects/delete/{object}', 'Admin\ProjectController@delete');

// Route::get('/projects/active/{object}', 'Admin\ProjectController@active');
// Route::get('/projects/sort/{type}/{object}', 'Admin\ProjectController@actionSort');

// // Project Image
// Route::get('project/{project?}/image', 'Admin\ProjectImageController@main')->name('admin.image');

// Route::get('project/{project?}/image/form/{object?}', 'Admin\ProjectImageController@initForm');

// Route::post('/project-image/form/{object?}', 'Admin\ProjectImageController@actionForm');

// Route::get('/project-image/delete/{object}', 'Admin\ProjectImageController@delete');

// Route::get('/project-image/active/{object}', 'Admin\ProjectImageController@active');

// // Project Catalog
// Route::get('project/{project?}/catalog', 'Admin\ProjectCatalogController@main')->name('admin.catalog');

// Route::get('project/{project?}/catalog/form/{object?}', 'Admin\ProjectCatalogController@initForm')->name('admin.catalog.form');

// Route::post('/project-catalog/form/{object?}', 'Admin\ProjectCatalogController@actionForm');

// Route::get('/project-catalog/delete/{object}', 'Admin\ProjectCatalogController@delete');

// Route::get('/project-catalog/active/{object}', 'Admin\ProjectCatalogController@active');

// Route::get('/project-catalog/sort/{type}/{object}', 'Admin\ProjectCatalogController@actionSort');

// // Project properties
// Route::get('project/{project?}/catalog/{catalog?}/properties', 'Admin\ProjectPropertyController@main')->name('admin.property');

// Route::get('project/{project?}/catalog/{catalog?}/properties/form/{object?}', 'Admin\ProjectPropertyController@initForm')->name('admin.property.form');

// Route::post('/properties/form/{object?}', 'Admin\ProjectPropertyController@actionForm');

// Route::get('/properties/delete/{object}', 'Admin\ProjectPropertyController@delete');

// Route::get('/properties/active/{object}', 'Admin\ProjectPropertyController@active');

// Route::get('/properties/sort/{type}/{object}', 'Admin\ProjectPropertyController@actionSort');


// // ProjectType
// Route::get('project-types', 'Admin\ProjectTypeController@index')->name('admin.project_type');

// Route::get('/project-types/form/{object?}', 'Admin\ProjectTypeController@initForm')->name('admin.project_type.form');

// Route::post('/project-types/form/{object?}', 'Admin\ProjectTypeController@actionForm');

// Route::get('/project-types/delete/{object}', 'Admin\ProjectTypeController@delete');

// Route::get('/project-types/active/{object}', 'Admin\ProjectTypeController@active');

// Route::get('/project-types/sort/{type}/{object}', 'Admin\ProjectTypeController@actionSort');


// // Contact
// Route::get('contact', 'Admin\ContactController@index')->name('admin.contact');

// Route::get('/contact/form/{object?}', 'Admin\ContactController@initForm');

// Route::post('/contact/form/{object?}', 'Admin\ContactController@actionForm');

// Route::get('/contact/delete/{object}', 'Admin\ContactController@delete');

// Route::get('/contact/active/{object}', 'Admin\ContactController@active');

// // Baner
// Route::get('baner', 'Admin\BanerController@index')->name('admin.baner');

// Route::get('/baner/form/{object?}', 'Admin\BanerController@initForm')->name('admin.baner.form');

// Route::post('/baner/form/{object?}', 'Admin\BanerController@actionForm');

// Route::get('/baner/delete/{object}', 'Admin\BanerController@delete');

// Route::get('/baner/active/{object}', 'Admin\BanerController@active');

// Route::get('/baner/sort/{type}/{object}', 'Admin\BanerController@actionSort');



// SEO setting
Route::get('category', 'Admin\CategoryController@index')->name('admin.category');

Route::get('/category/form/{object?}', 'Admin\CategoryController@initForm')->name('admin.category.form');

Route::post('/category/form/{object?}', 'Admin\CategoryController@actionForm');

Route::get('/category/delete/{object}', 'Admin\CategoryController@delete');

Route::get('/category/active/{object}', 'Admin\CategoryController@active');

Route::get('/category/sort/{type}/{object}', 'Admin\CategoryController@actionSort');

Route::get('/category/put/{key}/{object}', 'Admin\CategoryController@put');

// About
Route::get('about', 'Admin\AboutController@index')->name('admin.about');

Route::get('/about/form/{object?}', 'Admin\AboutController@initForm')->name('admin.about.form');

Route::post('/about/form/{object?}', 'Admin\AboutController@actionForm');

Route::get('/about/delete/{object}', 'Admin\AboutController@delete');

Route::get('/about/active/{object}', 'Admin\AboutController@active');

Route::get('/about/sort/{type}/{object}', 'Admin\AboutController@actionSort');

Route::get('/about/put/{key}/{object}', 'Admin\AboutController@put');

// TradeMarkController setting
Route::get('trademark', 'Admin\TradeMarkController@index')->name('admin.trademark');

Route::get('/trademark/form/{object?}', 'Admin\TradeMarkController@initForm')->name('admin.trademark.form');

Route::post('/trademark/form/{object?}', 'Admin\TradeMarkController@actionForm');

Route::get('/trademark/delete/{object}', 'Admin\TradeMarkController@delete');

Route::get('/trademark/active/{object}', 'Admin\TradeMarkController@active');

Route::get('/trademark/sort/{type}/{object}', 'Admin\TradeMarkController@actionSort');

Route::get('/trademark/put/{key}/{object}', 'Admin\TradeMarkController@put');

// ProductController
Route::get('product', 'Admin\ProductController@index')->name('admin.product');

Route::get('/product/form/{object?}', 'Admin\ProductController@initForm')->name('admin.product.form');

Route::post('/product/form/{object?}', 'Admin\ProductController@actionForm');

Route::get('/product/delete/{object}', 'Admin\ProductController@delete');

Route::get('/product/active/{object}', 'Admin\ProductController@active');

Route::get('/product/sort/{type}/{object}', 'Admin\ProductController@actionSort');

Route::get('/product/put/{key}/{object}', 'Admin\ProductController@put');

Route::get('/product/clone/{object}', 'Admin\ProductController@clone');

Route::get('/product/run-create-product', 'Admin\ProductController@cloneAll');

Route::get('api/product/{object}/imageList', 'Admin\ProductController@imageList');

Route::post('api/product/{object}/image/store', 'Admin\ProductController@storeImage')->name('admin.api.product.image.store');

Route::post('api/product/{object}/image/sort', 'Admin\ProductController@sortImage')->name('admin.api.product.image.sort');

Route::delete('api/product-image/{image}', 'Admin\ProductController@deleteImage')->name('admin.api.product.image.delete');

// TODO upload image
Route::post('/product/upload', 'Admin\ProductController@upload');


// ProductPropertyType
Route::get('product/{product}/property-type', 'Admin\ProductPropertyTypeController@main')->name('admin.product.property-type');

Route::get('/product/{product}/property-type/form/{object?}', 'Admin\ProductPropertyTypeController@initForm')->name('admin.product.property-type.form');

Route::post('/product-property-type/form/{object?}', 'Admin\ProductPropertyTypeController@actionForm');

Route::get('/product-property-type/delete/{object}', 'Admin\ProductPropertyTypeController@delete');

Route::get('/product-property-type/active/{object}', 'Admin\ProductPropertyTypeController@active');

Route::get('/product-property-type/sort/{type}/{object}', 'Admin\ProductPropertyTypeController@actionSort');

Route::get('/product-property-type/put/{key}/{object}', 'Admin\ProductPropertyTypeController@put');

// ProductPropertyDetail
Route::get('product/{product}/property-type/{productPropertyType}/property-detail', 'Admin\ProductPropertyDetailController@main')->name('admin.product.property-detail');

Route::get('/product/{product}/property-type/{productPropertyType}/property-detail/form/{object?}', 'Admin\ProductPropertyDetailController@initForm')->name('admin.product.property-detail.form');

Route::post('/product-property-detail/form/{object?}', 'Admin\ProductPropertyDetailController@actionForm');

Route::get('/product-property-detail/delete/{object}', 'Admin\ProductPropertyDetailController@delete');

Route::get('/product-property-detail/active/{object}', 'Admin\ProductPropertyDetailController@active');

Route::get('/product-property-detail/sort/{type}/{object}', 'Admin\ProductPropertyDetailController@actionSort');

Route::get('/product-property-detail/put/{key}/{object}', 'Admin\ProductPropertyDetailController@put');

// ProductImage
Route::get('product/{product}/image', 'Admin\ProductImageController@main')->name('admin.product.image');

Route::get('/product/{product}/image/form/{object?}', 'Admin\ProductImageController@initForm')->name('admin.product.image.form');

Route::post('/product-image/form/{object?}', 'Admin\ProductImageController@actionForm')->name('admin.product.image.store');

Route::get('/product-image/delete/{object}', 'Admin\ProductImageController@delete');

Route::get('/product-image/active/{object}', 'Admin\ProductImageController@active');

Route::get('/product-image/sort/{type}/{object}', 'Admin\ProductImageController@actionSort');

Route::get('/product-image/put/{key}/{object}', 'Admin\ProductImageController@put');


// Bill
Route::get('bill', 'Admin\BillController@index')->name('admin.bill');

Route::get('/bill/form/{object?}', 'Admin\BillController@initForm')->name('admin.bill.form');

Route::post('/bill/form/{object?}', 'Admin\BillController@actionForm');

Route::get('/bill/delete/{object}', 'Admin\BillController@delete');

Route::get('/bill/active/{object}', 'Admin\BillController@active');

Route::get('/bill/sort/{type}/{object}', 'Admin\BillController@actionSort');

Route::get('/bill/put/{key}/{object}', 'Admin\BillController@put');

// Bill product
Route::get('bill/{bill}/product', 'Admin\BillProductController@main')->name('admin.bill.product');

Route::get('/bill/{bill}/form/{object?}', 'Admin\BillProductController@initForm')->name('admin.bill.product.form');

Route::post('/bill-product/form/{object?}', 'Admin\BillProductController@actionForm');

Route::get('/bill-product/delete/{object}', 'Admin\BillProductController@delete');

Route::get('/bill-product/active/{object}', 'Admin\BillProductController@active');

Route::get('/bill-product/sort/{type}/{object}', 'Admin\BillProductController@actionSort');

Route::get('/bill-product/put/{key}/{object}', 'Admin\BillProductController@put');

Route::get('', 'Admin\IndexController@index');