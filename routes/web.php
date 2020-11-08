<?php


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

Route::get('/', function () {
    /* return redirect()->route('home'); */
    return view('welcome');
});

Auth::routes(['verify'=>true]);




Route::group(['prefix' => 'admin'], function () {
    
    // Login Routes
    Route::get('/login','Auth\AdminLoginController@showLoginFrom')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');

    // Logout Route 
    Route::post('/logout','Auth\AdminLoginController@adminLogout')->name('admin.logout');

    // Dashboard Route
    Route::get('/','AdminController@index')->name('admin.dashboard');

    // Manage Admin Route
    Route::get('/manage_admin','AdminController@create')->name('admin.create');

    // Store Admin Route
    Route::post('/','AdminController@store')->name('admin.store');

    // Edite Admin Route
    Route::get('/edit/{id}','AdminController@edit')->name('admin.edit');

    // Update Admin Route
    Route::put('/{id}','AdminController@update')->name('admin.update');

    // Delete Admin Route
    Route::delete('/{id}','AdminController@destroy')->name('admin.destroy');

    // Manage Provider Route
    Route::get('/manage_provider','ManageProviderController@create')->name("manage_provider.create");

    // Store Provider Route
    Route::post('/add_provider','ManageProviderController@store')->name('manage_provider.store');

    // Delete Provider Route
    Route::delete('/delete_provider/{id}','ManageProviderController@destroy')->name('manage_provider.destroy');

    // Edit Provider Route
    Route::get('/edit_provider/{id}','ManageProviderController@edit')->name('manage_provider.edit');

    // Update Provider Route
    Route::put('/update_provider/{id}','ManageProviderController@update')->name('manage_provider.update');

    // Show Provider Route
    Route::get('/show_provider/{id}','ManageProviderController@show')->name('manage_provider.show');

    // Manage Category Route
    Route::get('/manage_category','CategoryController@create')->name('category.create');

    // Store Category Route
    Route::post('/category','CategoryController@store')->name('category.store');

    // Edit Category Route
    Route::get('/edit_category/{id}','CategoryController@edit')->name('category.edit');

    // Update Category Route
    Route::put('/category/{id}','CategoryController@update')->name('category.update');

    // Delete Category Route
    Route::delete('/delete_category/{id}','CategoryController@destroy')->name('category.destroy');

    // Manage Product Route
    Route::get('/manage_product','ProductController@create')->name('product.create');

    // Store Product Route
    Route::post('/product','ProductController@store')->name('product.store');

    // Delete Product Route
    Route::delete('/delete_product/{id}','ProductController@destroy')->name('product.destroy');

    // Edit Product Route
    Route::get('/edit_product/{id}','ProductController@edit')->name('product.edit');

    // Update Product Route
    Route::put('/product/{id}','ProductController@update')->name('product.update');

    //Show Product Route 
    Route::get('/show_product/{id}','ProductController@show')->name('admin_product.show');

    // Manage City Delivery Price Route
    Route::get('/manage_delivery','CityController@create')->name('delivery.price');

    
    // Store City Delivery Price
    Route::post('/city','CityController@store')->name('city.store');

    // Edit City Delivery Price Route
    Route::get('/edit_delivery/{id}','CityController@edit')->name('delivery.edit');

    // Update City Delivery Price Route
    Route::put('/city/{id}','CityController@update')->name('delivery.update');

    // Delete City Delivery Price Route
    Route::delete('/delete_city/{id}','CityController@destroy')->name('delivery.destroy');

    // Manage Related Route
    Route::get('/related/create','RelatedController@create')->name('related.create');

    // Store Related Route 
    Route::post('/related','RelatedController@store')->name('related.store');

    // Edit Related Route 
    Route::get('/related/{id}/edit','RelatedController@edit')->name('related.edit');

    // Update Related Route 
    Route::put('/related/{id}','RelatedController@update')->name('related.update');

    // Delete Related Route 
    Route::delete('/related/{id}','RelatedController@destroy')->name('related.destroy');

    Route::get('/Messages','AdminMessagesController@index')->name('message.index');

    // Profile Route
    Route::get('/profile','AdminController@profile')->name('admin.profile');

    
});

Route::group(['prefix' => 'provider'], function () {

    // Login Routes
    Route::get('/login','Auth\ProviderLoginController@showLoginFrom')->name('provider.login');
    Route::post('/login','Auth\ProviderLoginController@login')->name('provider.login.submit');

    // Logout Route 
    Route::post('/logout','Auth\ProviderLoginController@providerLogout')->name('provider.logout');

    // Dashboard Route
    Route::get('/','ProviderController@index')->name('provider.dashboard')->middleware('preventbackbutton','verified');
    
    // Register Route
    Route::get('/register','Auth\ProviderRegisterController@showRegisterForm')->name('provider.register');
    Route::post('/register','Auth\ProviderRegisterController@register')->name('provider.register.submit');

    // Provider Profile Routes
    Route::put('/update_provider/{id}','ProviderController@update')->name('provider_profile.update');

    // Manage Admins of Providers Route 
    Route::get('/manage_admin','AdminProviderController@create')->name('admin_provider.create')->middleware('preventbackbutton');

    // Store Admin-Provider Route
    Route::post('/store_admin_provider','AdminProviderController@store')->name('admin_provider.store');

    // Edit Admin-Provider Route
    Route::get('/edit_admin/{id}','AdminProviderController@edit')->name('admin_provider.edit')->middleware('preventbackbutton');

    // Update Admin-Provider Route
    Route::put('/admin_provider/{id}','AdminProviderController@update')->name('admin_provider.update');

    // Delete Admin-Provider Route
    Route::delete('/delete_admin/{id}','AdminProviderController@destroy')->name('admin_provider.destroy');

    // Manage Provider-Product Route
    Route::get('/manage_product','ProviderProductController@create')->name('product_provider.create')->middleware('preventbackbutton');

    // Store Provider-Product Route
    Route::post('/store_product','ProviderProductController@store')->name('product_provider.store');

    // Edit Provider-product Route
    Route::get('/edit_product/{id}','ProviderProductController@edit')->name('product_provider.edit')->middleware('preventbackbutton');

    // Update Provider-Product Route
    Route::put('/product/{id}','ProviderProductController@update')->name('product_provider.update');

    // Show Provider-Product Route
    Route::get('/show_product/{id}','ProviderProductController@show')->name('product_provider.show')->middleware('preventbackbutton');

    // Delete Provider-Product Route
    Route::delete('/delete_product/{id}','ProviderProductController@destroy')->name('product_provider.destroy');

    // Delete Provider Image Route
    Route::delete('/delete_product_image/{id}','ProviderProductController@delete_image')->name('product_provider_image.delete');

    // Manage Provider-Related Route
    Route::get('/manage_related','ProviderRelatedController@create')->name('related_provider.create')->middleware('preventbackbutton');

    // Store Related Route 
    Route::post('/related','ProviderRelatedController@store')->name('related_provider.store');

    // Edit Related Route 
    Route::get('/related/{id}/edit','ProviderRelatedController@edit')->name('related_provider.edit')->middleware('preventbackbutton');

    // Update Related Route 
    Route::put('/related/{id}','ProviderRelatedController@update')->name('related_provider.update');

    // Delete Related Route 
    Route::delete('/related/{id}','ProviderRelatedController@destroy')->name('related_provider.destroy');

    // Show Feedbacks Route
    Route::get('/feedback','ProviderFeedbacksController@index')->name('provider_feedback.index')->middleware('preventbackbutton');

    // Profile Route
    Route::get('/profile','ProviderController@profile')->name('provider.profile')->middleware('preventbackbutton');

    // Order Routes
    Route::get('/orders','OrderController@index')->name('order.index')->middleware('preventbackbutton');
    Route::get('/orders/{order_id}','OrderController@show')->name('order.show')->middleware('preventbackbutton');
    Route::get('/order_details/{order_id}','OrderController@show_details')->name('order.showDetails')->middleware('preventbackbutton');
    Route::get('/orders-filter/{status}','OrderController@order_filter')->name('order.filters');
    Route::delete('/delete_order/{id}','OrderController@destroy')->name('order.destroy');
    Route::get('/accept_order','OrderController@accept')->name('orders.accept');
    Route::get('/decline_order','OrderController@decline')->name('orders.decline');
    Route::get('/delivery_process_order','OrderController@delivery_process')->name('orders.delivery_process');
    Route::get('/received_order','OrderController@received_order')->name('orders.received');
    Route::get('/unreceived_order','OrderController@unreceived_order')->name('orders.unreceived');
    


});


// Public Routes 
Route::get('/home', 'HomeController@index')->name('home')->middleware('preventbackbutton');
Route::get('/contact-us', 'HomeController@contact_us')->name('contact-us')->middleware('preventbackbutton');
/* Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout'); */
Route::get('/addtocart','CartController@addtocart')->name('addtocart');
Route::get('/products','PublicProductController@all')->name('product.all')->middleware('preventbackbutton');
Route::get('/profile/{provider_id}','PublicProductController@vendor_product_all')->name('vendor_product.all')->middleware('preventbackbutton');
Route::get('/category/{id}','PublicCategoryController@show')->name('category.show')->middleware('preventbackbutton');
Route::get('/search','PublicProductController@search')->name('search');
Route::get('/search/singleCategory','PublicProductController@search_in_singleCategory')->name('single_category.search');
Route::get('/search-vendors-products','PublicProductController@search_vendors_products')->name('vendors_product.search');
Route::get('/search-vendorsCategory-products','PublicProductController@search_vendorsCategory_products')->name('vendorsCategory_product.search');
Route::get('/filter','PublicProductController@filter')->name('filter.price');
Route::get('/category-filter','PublicProductController@filter_category')->name('filter_category.price');
Route::get('/vendor-filter','PublicProductController@vendorFilter')->name('vendors_filter.price');
Route::get('/providers','PublicProviderController@all')->name('provider.all')->middleware('preventbackbutton');
Route::get('/vendor-profile/{id}','PublicProviderController@profile')->name('public_provider.profile')->middleware('preventbackbutton');
Route::get('/search_vendor','PublicProviderController@search_vendors')->name('search.vendors');
Route::get('/profile/{prov_id}/{cat_id}','PublicProviderController@profile_categories')->name('profile_category.show')->middleware('preventbackbutton');
Route::get('/send-feedback','PublicFeedbackController@provider_feedback')->name('feedback.send');
Route::post('/feedback','PublicFeedbackController@admin_feedback')->name('admin_feedback.send');
Route::get('/shopping-cart','CartController@shoppingcart')->name('cart.index')->middleware('preventbackbutton');
Route::get('/checkout','PublicOrderController@checkout')->name('checkout')->middleware('preventbackbutton');
Route::get('/remove-from-cart/{prov_id}/{prod_id}','CartController@removeFromCart')->name('cart.remove');
Route::get('/singe-product/{id}','PublicProductController@show')->name('product.show')->middleware('preventbackbutton');
Route::get('/tracking-order','PublicOrderController@tracking')->name('order.tracking')->middleware('preventbackbutton');
Route::post('/checkout-process','PublicOrderController@checkout_process')->name('order.payment')->middleware('preventbackbutton');
Route::get('/order_done','PublicOrderController@orderDone')->name('orders.done')->middleware('preventbackbutton');
Route::get('/tracking','PublicOrderController@show_tracking')->name('show.tracking')->middleware('preventbackbutton');
Route::get('/show_user_orders','PublicOrderController@show_orders')->name('show.user.orders')->middleware('preventbackbutton');
Route::post('/comment','PublicCommentController@store')->name('comment.store');
Route::get('/comment_delete','PublicCommentController@destroy')->name('comment.destroy');

Route::get('/product_rating','PublicProductController@rating_store')->name('rating.store');


// User Login & Logout Routes

Route::post('user_login','Auth\UserLoginController@user_login')->name('user.login');
Route::get('/user/login','Auth\UserLoginController@user_login_view')->name('view.login');
Route::get('user_logout','Auth\UserLoginController@user_logout')->name('user.logout');
Route::get('register','Auth\UserLoginController@user_register_view')->name('view.register');
Route::post('user-register','Auth\UserLoginController@user_register')->name('user.register');
Route::get('/user_profile','Auth\UserLoginController@profile')->name('user.profile');
Route::put('/user_update/{id}','Auth\UserLoginController@update')->name('user.update');