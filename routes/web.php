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
PUSHER_APP_ID=1100499
PUSHER_APP_KEY=e9e4a073342959254078
PUSHER_APP_SECRET=8294f4e9f5eaef29b3a8
PUSHER_APP_CLUSTER=mt1

*/

Route::get('/', function () {
    /* return redirect()->route('home'); */
    return redirect()->route('home2');
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

    // Delete Product Image Route
    Route::delete('/delete_product_image/{id}','ProductController@delete_image')->name('ad_product_provider_image.delete');

    // Edit Product Route
    Route::get('/edit_product/{id}','ProductController@edit')->name('product.edit');

    // Update Product Route
    Route::put('/product/{id}','ProductController@update')->name('product.update');

    //Show Product Route 
    Route::get('/show_product/{id}','ProductController@show')->name('admin_product.show');

    // Orders Route
    Route::get('/all-orders','AdminOrdersController@allOrders')->name('admin.allOrders');

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

    // Notification Route 
    Route::get('/notifications','AdminController@all_notifications')->name('admin.allNotifications');
    Route::delete('/delete_notification/{id}','AdminController@delete_notification')->name('admin.notification.destroy');

});

Route::group(['prefix' => 'provider'], function () {

    // Login Routes
    Route::get('/login','Auth\ProviderLoginController@showLoginFrom')->name('provider.login');
    Route::post('/login','Auth\ProviderLoginController@login')->name('provider.login.submit');

    // Logout Route 
    Route::post('/logout','Auth\ProviderLoginController@providerLogout')->name('provider.logout');

    // Reset password
    Route::get('/password/reset','Auth\ProviderForgotPasswordController@showLinkRequestForm')->name('provider.password.request');
    Route::post('/password/email','Auth\ProviderForgotPasswordController@sendResetLinkEmail')->name('provider.password.email');
    Route::get('/password/reset/{token}','Auth\ProviderResetPasswordController@showResetForm')->name('provider.password.reset');
    Route::post('/password/reset','Auth\ProviderResetPasswordController@reset')->name('provider.password.update');

    // Check Subscribe Route
    Route::get('/renewal_subscribe','ProviderController@renewal_subscirbe')->name('subscribe_renewal');

    // Get Checkout Route
    Route::GET('/get-checkout-id','PaymentProviderController@getCheckoutId')->name('get.checkout');


    // Dashboard Route
    Route::get('/','ProviderController@index')->name('provider.dashboard')->middleware('preventbackbutton','verified','CheckSubscribe');
    
    
    // Register Route
    Route::get('/register','Auth\ProviderRegisterController@showRegisterForm')->name('provider.register');
    Route::post('/register','Auth\ProviderRegisterController@register')->name('provider.register.submit');

    // Provider Profile Routes
    Route::put('/update_provider/{id}','ProviderController@update')->name('provider_profile.update');

    // Manage Admins of Providers Route 
    Route::get('/manage_admin','AdminProviderController@create')->name('admin_provider.create')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Store Admin-Provider Route
    Route::post('/store_admin_provider','AdminProviderController@store')->name('admin_provider.store');

    // Edit Admin-Provider Route
    Route::get('/edit_admin/{id}','AdminProviderController@edit')->name('admin_provider.edit')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Update Admin-Provider Route
    Route::put('/admin_provider/{id}','AdminProviderController@update')->name('admin_provider.update');

    // Delete Admin-Provider Route
    Route::delete('/delete_admin/{id}','AdminProviderController@destroy')->name('admin_provider.destroy');

    // Manage Provider-Product Route
    Route::get('/manage_product','ProviderProductController@create')->name('product_provider.create')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Store Provider-Product Route
    Route::post('/store_product','ProviderProductController@store')->name('product_provider.store');

    // Edit Provider-product Route
    Route::get('/edit_product/{id}','ProviderProductController@edit')->name('product_provider.edit')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Update Provider-Product Route
    Route::put('/product/{id}','ProviderProductController@update')->name('product_provider.update');

    // Show Provider-Product Route
    Route::get('/show_product/{id}','ProviderProductController@show')->name('product_provider.show')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Delete Provider-Product Route
    Route::delete('/delete_product/{id}','ProviderProductController@destroy')->name('product_provider.destroy');

    // Delete Product Image Route
    Route::delete('/delete_product_image/{id}','ProviderProductController@delete_image')->name('product_provider_image.delete');

    // Manage Provider-Related Route
    Route::get('/manage_related','ProviderRelatedController@create')->name('related_provider.create')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Store Related Route 
    Route::post('/related','ProviderRelatedController@store')->name('related_provider.store');

    // Edit Related Route 
    Route::get('/related/{id}/edit','ProviderRelatedController@edit')->name('related_provider.edit')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Update Related Route 
    Route::put('/related/{id}','ProviderRelatedController@update')->name('related_provider.update');

    // Delete Related Route 
    Route::delete('/related/{id}','ProviderRelatedController@destroy')->name('related_provider.destroy');

    // Show Feedbacks Routes
    Route::get('/feedback','ProviderFeedbacksController@index')->name('provider_feedback.index')->middleware('preventbackbutton','verified','CheckSubscribe');
    Route::get('/show_feedback/{id}','ProviderFeedbacksController@show')->name('provider_feedback.show')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Profile Route
    Route::get('/profile','ProviderController@profile')->name('provider.profile')->middleware('preventbackbutton','verified','CheckSubscribe');

    // Category Routes
    Route::get('/categories_show','ProviderCategoryShow@index')->name('provider_category.index');
    Route::get('/show_category/{id}','ProviderCategoryShow@show')->name('provider_category.show');

    // Order Routes
    Route::get('/orders','OrderController@index')->name('order.index')->middleware('preventbackbutton','verified','CheckSubscribe');
    Route::get('/orders/{order_id}','OrderController@show')->name('order.show')->middleware('preventbackbutton','verified','CheckSubscribe');
    Route::get('/order_details/{order_id}','OrderController@show_details')->name('order.showDetails')->middleware('preventbackbutton','verified','CheckSubscribe');
    Route::get('/orders-filter/{status}','OrderController@order_filter')->name('order.filters');
    Route::delete('/delete_order/{id}','OrderController@destroy')->name('order.destroy');
    Route::get('/accept_order','OrderController@accept')->name('orders.accept');
    Route::get('/decline_order','OrderController@decline')->name('orders.decline');
    Route::get('/delivery_process_order','OrderController@delivery_process')->name('orders.delivery_process');
    Route::get('/received_order','OrderController@received_order')->name('orders.received');
    Route::get('/unreceived_order','OrderController@unreceived_order')->name('orders.unreceived');
    

    // Notifications Route
    Route::get('/notifications','ProviderController@all_notifications')->name('provider.allNotifications')->middleware('preventbackbutton','verified','CheckSubscribe');
    Route::delete('/delete_notification/{id}','ProviderController@delete_notification')->name('notification.destroy');

    // Messages Routes 

    Route::get('messages','ProviderController@chat')->name('messages.index')->middleware('preventbackbutton','verified','CheckSubscribe');;
    Route::get('message/{id}','ProviderController@getMessage')->name('message')->middleware('preventbackbutton','verified','CheckSubscribe');;
    Route::post('message','ProviderController@sendMessage')->middleware('preventbackbutton','verified','CheckSubscribe');;

});


Route::group(['prefix' => 'adminsOfProvider'], function () {
    // Login Routes
    Route::get('/login','Auth\ProvAdminLoginController@showLoginFrom')->name('provAdmin.login')->middleware('preventbackbutton');
    Route::post('/login','Auth\ProvAdminLoginController@login')->name('provAdmin.login.submit');

    // Logout Route 
    Route::post('/logout','Auth\ProvAdminLoginController@providerLogout')->name('provAdmin.logout');

    Route::get('/expire_subscribe','ProvAdminController@expire')->name('provAdmin.expire')->middleware('preventbackbutton');

    // Dashboard Route
    Route::get('/','ProvAdminController@index')->name('provAdmin.dashboard')->middleware('preventbackbutton','expire');
    
    // Show Feedbacks Routes
    Route::get('/feedback','ProvAdminFeedbackController@index')->name('provAdmin_feedback.index')->middleware('preventbackbutton','verified','expire');
    Route::get('/show_feedback/{id}','ProvAdminFeedbackController@show')->name('provAdmin_feedback.show')->middleware('preventbackbutton','verified','expire');

    // Profile Route
    Route::get('/profile','ProvAdminController@profile')->name('provAdmin.profile')->middleware('preventbackbutton','verified','expire');
    Route::put('/update_provAdmin/{id}','ProvAdminController@update')->name('provAdmin.profile.update');
    // Category Routes
    Route::get('/categories_show','ProvAdminCategoryController@index')->name('provAdmin_category.index')->middleware('preventbackbutton','verified','expire');;
    Route::get('/show_category/{id}','ProvAdminCategoryController@show')->name('provAdmin_category.show')->middleware('preventbackbutton','verified','expire');;

    // Order Routes
    Route::get('/orders','ProvAdminOrderController@index')->name('provAdmin.order.index')->middleware('preventbackbutton','verified','expire');
    Route::get('/orders/{order_id}','ProvAdminOrderController@show')->name('provAdmin.order.show')->middleware('preventbackbutton','verified','expire');
    Route::get('/order_details/{order_id}','ProvAdminOrderController@show_details')->name('provAdmin.order.showDetails')->middleware('preventbackbutton','verified','expire');
    Route::get('/orders-filter/{status}','ProvAdminOrderController@order_filter')->name('provAdmin.order.filters');
    Route::delete('/delete_order/{id}','ProvAdminOrderController@destroy')->name('provAdmin.order.destroy');
    Route::get('/accept_order','ProvAdminOrderController@accept')->name('provAdmin.orders.accept');
    Route::get('/decline_order','ProvAdminOrderController@decline')->name('provAdmin.orders.decline');
    Route::get('/delivery_process_order','ProvAdminOrderController@delivery_process')->name('provAdmin.orders.delivery_process');
    Route::get('/received_order','ProvAdminOrderController@received_order')->name('provAdmin.orders.received');
    Route::get('/unreceived_order','ProvAdminOrderController@unreceived_order')->name('provAdmin.orders.unreceived');
    

    // Notifications Route
    Route::get('/notifications','ProvAdminController@all_notifications')->name('provAdmin.allNotifications');
    Route::delete('/delete_notification/{id}','ProvAdminController@delete_notification')->name('notification.destroy');


    // Messages Routes 

    Route::get('messages','provAdminController@chat')->name('provAdmin.messages.index')->middleware('preventbackbutton','verified','expire');
    Route::get('message/{id}','provAdminController@getMessage')->name('provAdmin.message');
    Route::post('message','provAdminController@sendMessage');
});


// Public Routes 

Route::get('/home','HomeController@index2')->name('home2')->middleware('preventbackbutton');
/* Route::get('/category2/{id}','PublicCategoryController@show2')->name('category.show2')->middleware('preventbackbutton'); */
Route::get('/category-filter','PublicProductController@filter_category2')->name('filter_category2.price');
Route::get('/search/singleCategory2','PublicProductController@search_in_singleCategory2')->name('single_category2.search');
/* Route::get('/category2/{id}/{gender}','PublicCategoryController@gender_show2')->name('category_gender2.show')->middleware('preventbackbutton');*/
Route::get('/search/singleGender2','PublicProductController@search_in_singleGender2')->name('single_gender.search2');
Route::get('/gender-filter2','PublicProductController@filter_gender2')->name('filter_gender.price2');
Route::get('/stores','PublicProviderController@all2')->name('provider.all2')->middleware('preventbackbutton');
Route::get('/search_vendor2','PublicProviderController@search_vendors2')->name('search.vendors2');
Route::get('/store/{id}','PublicProviderController@profile2')->name('public_provider.profile2')->middleware('preventbackbutton');
Route::get('/search-vendors-products2','PublicProductController@search_vendors_products2')->name('vendors_product.search2');
Route::get('/vendor-filter2','PublicProductController@vendorFilter2')->name('vendors_filter.price2');
Route::get('/store/{prov_id}/{cat_id}','PublicProviderController@profile_categories2')->name('profile_category.show2')->middleware('preventbackbutton');
Route::get('/store/{prov_id}/{cat_id}/{gender}','PublicProviderController@profile_gender2')->name('profile_gender.show2')->middleware('preventbackbutton');
Route::get('/search-vendorsCategory-products','PublicProductController@search_vendorsCategory_products2')->name('vendorsCategory_product.search2');
Route::get('/search-vendorsGender-products','PublicProductController@search_vendorsGender_products2')->name('vendorsGender_product.search2');
Route::get('/vendor-Category-filter','PublicProductController@vendorCategoryFilter2')->name('vendors_Categoryfilter.price2');
Route::get('/vendor-Gender-filter','PublicProductController@vendorGenderFilter2')->name('vendors_Genderfilter.price2');


Route::get('/contact', 'HomeController@contact_us2')->name('contact-us2')->middleware('preventbackbutton');
Route::get('/singleProduct/{id}','PublicProductController@show2')->name('product.show2')->middleware('preventbackbutton');
Route::get('/trackingOrder','PublicOrderController@tracking2')->name('order.tracking2')->middleware('preventbackbutton');
Route::get('/shoppingCart','CartController@shoppingcart2')->name('cart.index2')->middleware('preventbackbutton');
Route::get('/checkout2','PublicOrderController@checkout2')->name('checkout2')->middleware('preventbackbutton');
Route::get('/allProducts','PublicProductController@all2')->name('product.all2')->middleware('preventbackbutton');
Route::get('/search2','PublicProductController@search2')->name('search2');
Route::get('/filter2','PublicProductController@filter2')->name('filter.price2');
Route::post('/checkoutProcess','PublicOrderController@checkout_process2')->name('order.payment2')->middleware('preventbackbutton');
Route::get('/orderDone','PublicOrderController@orderDone2')->name('orders.done2')->middleware('preventbackbutton');
Route::get('/userProfile','Auth\UserLoginController@profile2')->name('user.profile2');

/* Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout'); */
Route::get('/addtocart','CartController@addtocart')->name('addtocart');
Route::get('/products','PublicProductController@all')->name('product.all')->middleware('preventbackbutton');
Route::get('/profile/{provider_id}','PublicProductController@vendor_product_all')->name('vendor_product.all')->middleware('preventbackbutton');
Route::get('/category/{id}','PublicCategoryController@show2')->name('category.show2')->middleware('preventbackbutton');

Route::get('/category/{id}/{gender}','PublicCategoryController@gender_show2')->name('category_gender2.show')->middleware('preventbackbutton');



Route::get('/send-feedback','PublicFeedbackController@provider_feedback')->name('feedback.send');
Route::post('/feedback','PublicFeedbackController@admin_feedback')->name('admin_feedback.send');

Route::get('/remove-from-cart/{prov_id}/{prod_id}','CartController@removeFromCart')->name('cart.remove');

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

// Messages Routes 

Route::get('/user_message','PublicProviderController@getMessage')->name('message.user');
Route::post('message_user','PublicProviderController@sendMessage')->name('message_user.send');
Route::get('/chat/{id}','PublicProviderController@chat_show')->name('chat.show');


// End Public Routes !!
