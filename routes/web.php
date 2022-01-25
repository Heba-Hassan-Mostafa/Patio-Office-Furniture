<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::feeds();


//social login
Route::get('/auth/redirect/{provider}', 'GoogleLoginController@redirect');
Route::get('/callback/{provider}', 'GoogleLoginController@callback');


Route::group(['prefix'=>'admin'],function(){

    Route::get('/patio' , 'AdminController@index')->name('admin.patio');
    Route::get('/login' , 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login' , 'Admin\LoginController@login');
    Route::any('/signout', 'AdminController@logout')->name('admin.signout');

    //forget password
    Route::get('reset/password', 'Admin\ForgotPasswordController@showRequestForm');
    Route::post('email', 'Admin\ForgotPasswordController@sendResetEmail')->name('email');
    Route::get('update/password', 'Admin\ResetPasswordController@resetForm')->name('update.pass');
    Route::post('update/password', 'Admin\ResetPasswordController@reset');


    //cahnge password
    Route::get('/password', 'AdminController@changePassword')->name('password.change');
    Route::post('/password', 'AdminController@changePasswordSave');


    //Category
    Route::post('category/reorder', 'BackendController\CategoryController@reorder')->name('category/reorder');
    Route::resource('/category', 'BackendController\CategoryController');


    //SubCategory
    Route::resource('/subcategory', 'BackendController\SubCategoryController');



    //Blog
    Route::resource('/post-category', 'BackendController\PostCategoryController');

    Route::get('post/active/{id}', 'BackendController\PostController@active');
    Route::get('post/inactive/{id}', 'BackendController\PostController@inactive');
    Route::put('post/update/image/{id}', 'BackendController\PostController@updateImage');
    Route::resource('/post', 'BackendController\PostController');

    //newsLetters
    Route::resource('/news', 'BackendController\NewsLetterController');


    //Products
    Route::post('product/reorder', 'BackendController\ProductController@reorder')->name('product/reorder');
    Route::get('product/active/{id}', 'BackendController\ProductController@active');
    Route::get('product/inactive/{id}', 'BackendController\ProductController@inactive');
    Route::get('product/subcategory/{category_id}', 'BackendController\ProductController@getSubCat');
    Route::put('product/update/image/{id}', 'BackendController\ProductController@updateImage');
    Route::resource('/product', 'BackendController\ProductController');


     //Image Category
     Route::resource('/imgcategory', 'BackendController\ImageCategoryController');

    //  Route::get('image/active/{id}', 'BackendController\CatalogueController@active');
    //  Route::get('image/inactive/{id}', 'BackendController\CatalogueController@inactive');
     Route::post('delete-image/{img_id}', 'BackendController\CatalogueController@delete_image')->name('delete.image');
     Route::resource('/image', 'BackendController\CatalogueController');

     //comments
     Route::post('comments/reorder', 'BackendController\CommentController@reorder')->name('comments/reorder');
     Route::get('comments/change', 'BackendController\CommentController@change');
    Route::resource('/comments', 'BackendController\CommentController');

    //comments
    Route::resource('/coupon', 'BackendController\CouponController');


    //brands
    Route::resource('/brand', 'BackendController\ClientBrandController');

    //pdf
    Route::resource('/pdf', 'BackendController\PdfFileController');

    Route::resource('/setting', 'BackendController\SettingController');

     Route::get('/new-order', 'BackendController\OrderController@newOrder')->name('new.order');
    Route::get('pdf/order/{id}', 'BackendController\OrderController@pdf')->name('pdf.order');
    Route::get('send/email/order/{id}', 'BackendController\OrderController@sendEmail')->name('send.email.order');
    Route::get('print/order/{id}', 'BackendController\OrderController@print')->name('print.order');
    Route::get('view/order/{id}', 'BackendController\OrderController@viewOrder');

    Route::get('accept/payment/{id}', 'BackendController\OrderController@acceptPayment');
    Route::get('cancel/payment/{id}', 'BackendController\OrderController@cancelPayment');
    Route::get('done/{id}', 'BackendController\OrderController@donePayment');


    Route::get('accept/order', 'BackendController\OrderController@acceptOrder')->name('accept.order');
    Route::get('cancel/order', 'BackendController\OrderController@cancelOrder')->name('cancel.order');
    Route::get('delivery/order', 'BackendController\OrderController@deliveryOrder')->name('delivery.order');


    //contacts
    Route::resource('/contacts', 'BackendController\ContactsController');


     //reports
    Route::get('today/order', 'BackendController\ReportController@todayOrder')->name('today.order');
    Route::get('today/deliver', 'BackendController\ReportController@todayDeliver')->name('today.deliver');
    Route::get('month/order', 'BackendController\ReportController@monthOrder')->name('month.order');
    Route::get('search/report', 'BackendController\ReportController@searchReport')->name('search.report');
    Route::post('search/by/year', 'BackendController\ReportController@searchYear')->name('search.by.year');
    Route::post('search/by/month', 'BackendController\ReportController@searchMonth')->name('search.by.month');
    Route::post('search/by/date', 'BackendController\ReportController@searchDate')->name('search.by.date');

    //clients
    Route::resource('client', 'BackendController\ClientController');
    
     //videos
     Route::post('video/reorder', 'BackendController\VideoController@reorder')->name('video/reorder');
     Route::resource('/video', 'BackendController\VideoController');



});



Route::get('maintenance', function () {

    if (setting()->status == 'open') {
        return redirect('/');
    }

    return view('frontend.design.maintenance');
});

Route::group(['middleware' => 'Maintenance'], function () {

//index
Route::get('/', 'FrontendController\IndexController@index');

//user home
Route::get('/user/account', 'HomeController@index')->name('user.account');

//cahnge password
Route::get('/change/password', 'FrontendController\ClientController@changePassword')->name('change.password');
Route::post('/change/password', 'FrontendController\ClientController@changePasswordSave');

//logout
Route::any('user/logout', 'HomeController@logout')->name('user.logout');

//news letters
Route::post('/subscriber', 'FrontendController\IndexController@subscriber')->name('subscriber');

//comment
Route::post('/comment', 'FrontendController\IndexController@comment')->name('comment');


//wishlist
Route::get('add/wishlist/{id}' , 'FrontendController\WishListController@addWishList');
Route::get('remove/wishlist/{id}', 'FrontendController\WishListController@removeWishlist');


//Cart
Route::get('/add/cart/{id}', 'FrontendController\CartController@addCart');
Route::get('check', 'FrontendController\CartController@check');
Route::get('show/cart', 'FrontendController\CartController@showCart')->name('show.cart');
Route::get('remove/cart/{rowId}', 'FrontendController\CartController@removeCart');
Route::post('update/cart', 'FrontendController\CartController@updateCart')->name('update.cart');
Route::get('/cart/product/view/{id}', 'FrontendController\CartController@productCartView');
Route::post('insert/cart/modal', 'FrontendController\CartController@insertCart')->name('insert.cart.modal');
Route::get('user/checkout', 'FrontendController\CartController@checkout')->name('user.checkout');
Route::get('user/wishlist', 'FrontendController\CartController@wishList')->name('user.wishlist');
Route::post('user/apply/coupon', 'FrontendController\CartController@coupon')->name('apply.coupon');
Route::get('remove/coupon', 'FrontendController\CartController@removeCoupon')->name('remove.coupon');
Route::get('user/order', 'FrontendController\CartController@order')->name('user.order');
Route::post('make/order', 'FrontendController\CartController@makeOrder');


//product details

Route::get('/all-products', 'FrontendController\ProductController@showProduct');
Route::get('/product/category/{cat_id}', 'FrontendController\ProductController@productCategory');
Route::get('get-product', 'FrontendController\ProductController@getProduct');


// Blog Post
Route::get('blog/post', 'FrontendController\BlogController@blog')->name('blog.post');
Route::get('blog/post-details/{id}', 'FrontendController\BlogController@blogContent');
Route::get('catalogue', 'FrontendController\IndexController@catalogue');


//contact-us
Route::get('contact-us', 'FrontendController\IndexController@contact');
Route::post('contact-us', 'FrontendController\IndexController@do_contact');

//about patio
Route::get('about-patio', 'FrontendController\IndexController@about');

//comment
Route::post('search', 'FrontendController\IndexController@search')->name('search');


//comment
Route::get('comments', 'FrontendController\IndexController@showComment');



});


