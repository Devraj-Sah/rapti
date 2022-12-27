<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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
Route::get('/', [
        'as' => 'website.home',
        'uses' => 'HomeController@home'
    ]
);


Auth::routes();

Route::post('/ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');

Route::group(['prefix' => config('frw.uri'), 'group' => 'Admin'], function () {
    Route::get('/login', 'Auth\AdminLoginController@index');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('login.submit');
});




Route::group(['prefix' => config('frw.uri'),'middleware' =>  ['auth:admin'], 'group' => 'Admin'], function () {

    Route::get('/change_profile', 'AdminController@change_profile')->name('admin.change_profile');
    Route::post('/change_profile', 'AdminController@update_profile')->name('admin.update_profile');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    Route::get('/navigation-list/{category}', 'Admin\NavigationController@index');
    Route::get('/navigation-list/{category}/create', 'Admin\NavigationController@create');


    //page type
    Route::resource('/pageType', 'Admin\PageTypeController');
    //photo gallery
    Route::get('/navigation-list/{category}/{id}/showList', 'Admin\NavigationController@showMediaList');
    Route::get('/navigation-list/{category}/{id}/showList/create', 'Admin\NavigationController@addMedia');
    Route::post('/navigation-list/{category}/{id}/addAlbum', 'Admin\NavigationController@storeAlbum');
    Route::get('/navigation-list/media/{id}/delete', 'Admin\NavigationController@deleteMedia');
    Route::post('/navigation-list/media/{id}/update', 'Admin\NavigationController@updateMedia');

    //video gallery
    Route::get('/navigation-list/{category}/{id}/vlink', 'Admin\VideoController@showVideoList');
    Route::get('/navigation-list/{category}/{id}/vlink/create', 'Admin\VideoController@addVideo');
    Route::post('/navigation-list/{category}/{id}/addVideoAlbum', 'Admin\VideoController@storeVideoAlbum');
    Route::post('/navigation-list/vlink/{id}/update', 'Admin\VideoController@updateLinks');
    Route::get('/navigation-list/vlink/{id}/delete', 'Admin\VideoController@deleteLink');
    Route::post('/navigation-list/{category}/{id?}', 'Admin\NavigationController@store');
    Route::get('/navigation-edit/{category}/{id}/edit', 'Admin\NavigationController@edit');
    Route::put('/navigation-edit/{category}/{id}', 'Admin\NavigationController@update');
    Route::get('/navigation-edit/{category}/{id}', 'Admin\NavigationController@deleteIconImage');
    Route::get('/navigation-edit/{category}/{id}/deleteimage2', 'Admin\NavigationController@deleteFeaturedImage');
    Route::get('/navigation-edit/{category}/{id}/deleteimage3', 'Admin\NavigationController@deleteBannerImage');
    Route::get('/navigation-edit/{category}/{id}/deletemainattachment', 'Admin\NavigationController@deletemainattachment');
    Route::get('/navigation-edit/{category}/{id}/deleteattachment', 'Admin\NavigationController@deleteattachment');
    Route::get('/navigation-list/{category}/{id}/delete', 'Admin\NavigationController@destroy');
    Route::get('/navigation-list/{category}/{id}', 'Admin\NavigationController@childNavigation')->where(['id' => '[0-9]+']);
    Route::get('/navigation-list/{category}/{id}/create', 'Admin\NavigationController@create')->where(['id' => '[0-9]+']);


    Route::get('/global-setting', 'Admin\GlobalSettingController@global_setting');
    //Route::post('/global-setting','Admin\GlobalSettingController@create')->name('create.global-setting');
    Route::post('/global_setting', 'Admin\GlobalSettingController@updateSettings')->name('update.global_setting');
    Route::get('/subscribers-list', 'Admin\SubscriberController@index');
    Route::get('/subscribers-list/{id}', 'Admin\SubscriberController@destroy');
    Route::put('/navigation-list/{id}', 'Admin\NavigationController@update_status')->name('update_status');

    // ............................. feedback.......................
    Route::get('/feedbacks-list', 'Admin\FeedbackController@index');
    Route::get('/feedbacks-view/{id}', 'Admin\FeedbackController@view');
    Route::get('/feedbacks-list/{id}', 'Admin\FeedbackController@destroy');
    Route::put('/feedbacks-list/{id}', 'Admin\FeedbackController@update_status')->name('update_status');

// ............................. Order .......................
//Order List
    Route::get('order/list', ['as' => 'order.index', 'uses' => 'Admin\OrderController@index']);
   Route::get('order/{id}/detail', ['as' => 'order.show', 'uses' => 'Admin\OrderController@show']);
    Route::post('order/history/update', ['as' => 'order.history.update', 'uses' => 'Admin\OrderController@updateStatus']);
   /* Route::get('/{id}/markAsRead', function (){
        foreach (auth()->user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }

    });*/

    /*// INDEX
    Route::get('order-status', ['as' => 'order.status.index', 'uses' => 'Admin\OrderStatusController@index']);

    // CREATE | STORE
    Route::get('order-status/create', ['as' => 'order.status.create', 'uses' => 'Admin\OrderStatusController@create']);
    Route::post('order-status', ['as' => 'order.status.store', 'uses' => 'Admin\OrderStatusController@store']);

    // SHOW
    Route::get('order-status/{id}', ['as' => 'order.status.show', 'uses' => 'Admin\OrderStatusController@show'])->where('id',
        '[0-9]+');

    // EDIT | UPDATE
    Route::get('order-status/{id}/edit', ['as' => 'order.status.edit', 'uses' => 'Admin\OrderStatusController@edit'])->where('id',
        '[0-9]+');
    Route::put('order-status/{id}', ['as' => 'order.status.update', 'uses' => 'Admin\OrderStatusController@update'])->where('id',
        '[0-9]+');

    // DELETE
    Route::delete('order-status', ['as' => 'order.status.destroy', 'uses' => 'Admin\OrderStatusController@destroy']);

    Route::get('order-status/status', ['as' => 'order.status.status', 'uses' => 'Admin\OrderStatusController@status']);*/

// ............................. comment.......................

    Route::get('/{id}/comment_list', 'Admin\CommentController@index');
    Route::get('/{id}/comment-delete', 'Admin\CommentController@destroy');
    Route::get('/comment-status/{id}', 'Admin\CommentController@updatestatus');

    //.............................Excel Import & Export.............................
    Route::get('product-categories/import-export-csv-excel', [
        'as' => 'category-excel.import',
        'uses' => 'Admin\FileController@importExportExcelORCSV'
    ]);

    Route::post('product-categories/import-csv-excel', [
        'as' => 'category-import-csv-excel',
        'uses' => 'Admin\FileController@importFileIntoDB'
    ]);

    Route::get('products/import-export-csv-excel', [
        'as' => 'products-excel.import',
        'uses' => 'Admin\FileController@importExportProductExcelORCSV'
    ]);

    Route::post('products/import-csv-excel', [
        'as' => 'products-import-csv-excel',
        'uses' => 'Admin\FileController@importProductsFileIntoDB'
    ]);

    //.............................Ecommerce Part.............................

    Route::put('/product-categories/update-status/{id}', 'Admin\CategoryController@update_status')->name('update_status');

    Route::resource('product-categories', 'Admin\CategoryController');

    Route::resource('products', 'Admin\ProductController');


    Route::get('productImage/{id}/delete', [
        'as' => 'productImage.delete',
        'uses' => 'Admin\ProductController@deleteProductImage'
    ]);
    Route::get('productFeaturedImage/{id}/delete', [
        'as' => 'productFeaturedImage.delete',
        'uses' => 'Admin\ProductController@deleteFeaturedImage'
    ]);

    Route::resource('catalogues', 'Admin\CatalogueController');
    Route::get('catalogueImage/{id}/delete', [
        'as' => 'catalogueImage.delete',
        'uses' => 'Admin\CatalogueController@deleteCatalogueImage'
    ]);

    Route::get('catalogueFile/{id}/delete', [
        'as' => 'catalogueFile.delete',
        'uses' => 'Admin\CatalogueController@deleteCatalogueFile'
    ]);
    //.............................Users Detail.............................
    Route::get('users-list', [
        'as' => 'users-list.index',
        'uses' => 'Admin\UserController@getUsersList'
    ]);

    Route::get('users-list/{id}/edit', [
        'as' => 'users.edit',
        'uses' => 'Admin\UserController@editUsers'
    ]);

    Route::put('users-list/{id}/update', [
        'as' => 'users.update',
        'uses' => 'Admin\UserController@updateUsers'
    ]);

});


/*Route::get('/addToCart/{id}', ['uses' => 'Admin\ProductController@getAddToCart',
    'as' => 'product.addToCart']);*/
//Cart Manager
Route::group(['prefix' => 'cart'], function () {
    Route::get('/list', ['as' => 'cart.index', 'uses' => 'CartController@index'])->middleware('cart');
    Route::post('/add', ['as' => 'cart.add', 'uses' => 'CartController@add']);
    Route::get('/update', ['as' => 'cart.update', 'uses' => 'CartController@update']);
    Route::get('/destroy', ['as' => 'cart.destroy', 'uses' => 'CartController@destroy']);
    Route::get('/{rowId}/delete', ['as' => 'cart.delete', 'uses' => 'CartController@delete']);

//Cart Checkout
   Route::get('/checkout', ['as' => 'cart.checkout', 'uses' => 'CheckoutController@checkout'])->middleware('cart');


    Route::post('/checkout/address', ['as' => 'cart.checkout.address.store', 'uses' => 'CheckoutController@checkoutStore'])->middleware('cart');
    Route::get('/checkout/payment', ['as' => 'cart.checkout.payment', 'uses' => 'CheckoutController@payment'])->middleware('cart');
    Route::post('/checkout/payment', ['as' => 'cart.checkout.payment.store', 'uses' => 'CheckoutController@paymentStore'])->middleware('cart');
    Route::get('/checkout/payment/success/{orderId}', ['as' => 'cart.checkout.payment.success', 'uses' => 'CheckoutController@success']);
});


Route::get('website/contact', [
    'as' => 'website.contact-us',
    'uses' => 'HomeController@getContactPage'
]);

Route::post('website/contact', [
    'as' => 'contact-us.store',
    'uses' => 'HomeController@storeContactUs'
]);

Route::any('category/{alias}', [
    'as' => 'category.pages',
    'uses' => 'HomeController@getCategoryPages'
]);

Route::any('product/list', [
    'as' => 'product.list.home',
    'uses' => 'HomeController@getProducts'
]);


Route::any('{alias}', [
    'as' => 'pages',
    'uses' => 'HomeController@getPages'
]);

Route::any('{alias}/details', [
    'as' => 'pages.details',
    'uses' => 'HomeController@getInnerPageDetails'
]);

//==================USERS REGISTER SECTION  ===============

Route::post('/users/register', [
    'as' => 'users.register',
    'uses' => 'Auth\RegisterController@registerUser'
]);


Route::post('/users/login', [
    'as' => 'users.login',
    'uses' => 'Auth\LoginController@userLogin'
]);

Route::get('user/logout', 'Auth\LoginController@logout')->name('user.logout');


//===============Enquiry form submission ========================
Route::post('{slug}/inquiry', [
    'as' => 'inquiry.request',
    'uses' => 'HomeController@inquiryRequest'
]);

//view pdf
Route::get('files/download/{id}', [
    'as' => 'pdf.view',
    'uses' => 'HomeController@viewPdfFile'
]);

Route::get('search/products/', [
    'as' => 'search.products',
    'uses' => 'HomeController@searchProducts'
]);

Auth::routes();



Route::get('/catalogue/list/{id}', [
    'as' => 'catalogue',
    'uses' => 'HomeController@getCatalogue'
]);




Route::group(['middleware' => ['web'], 'prefix' => 'user'], function() {

    Route::post('/login', 'Auth\UserLoginController@login')->name('user.login.submit');
    Route::get('/logout', 'Auth\UserLoginController@logout')->name('user.logout');

    Route::get('account', 'UserController@myAccount')->name('user.account');
    Route::post('account', 'UserController@updateInformation')->name('user.account.update');
    Route::get('changePassword', 'UserController@changePassword')->name('user.account.changePassword');
    Route::post('changePassword', 'UserController@updatePassword')->name('user.account.updatePassword');

    Route::get('myOrders', 'UserController@myOrders')->name('user.myOrders');
    Route::get('user/{orderId}/myOrders/', 'UserController@orderDetail')->name('user.orderDetail');
});
