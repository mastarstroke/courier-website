<?php

// Used Models, Route and Auth
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Front_Service;
use App\Models\Company_master;
use App\Models\SectionOne;
use App\Models\SectionTwo;
use App\Models\OrderCourier;

use Illuminate\Support\Facades\Auth;

// welcome page route view
Route::get('/', function () {
    $user = User::where('id', Auth::id())->first();
    $service = Front_Service::latest()->get();
    $company_details = Company_master::where('id', 1)->first();
    $setting_one = SectionOne::first();
    $setting_two = SectionTwo::first();
    $reviews = OrderCourier::query()
    ->join('users', 'order_couriers.user_id', '=', 'users.id')
    ->paginate(9);
    return view('welcome', compact('user', 'service', 'company_details','setting_one', 'setting_two','reviews'));
})->name('welcome');

Auth::routes(); // routes Auth call

// Grouped middlewares and Auth for admin routes with 'admin' prefix
Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function(){

    // Routes for admin dashboard index view, add todo list and delete todo
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('add-todo-list', [App\Http\Controllers\Admin\DashboardController::class, 'addTodo'])->name('add-todo-list');
    Route::delete('delete-todo-list/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'deleteTodo'])->name('delete-todo-list');

    // Routes for order index view, delete, view order, order history and update orders
    Route::get('company-master/orders', [App\Http\Controllers\Admin\OrderController::class, 'orders'])->name('orders.view');
    Route::delete('action-master/delete/{id}', [App\Http\Controllers\Admin\OrderController::class, 'order_delete'])->name('order.delete');
    Route::get('action-master/edit/{id}', [App\Http\Controllers\Admin\OrderController::class, 'vieworder'])->name('orderView');
    Route::get('action-master/history', [App\Http\Controllers\Admin\OrderController::class, 'orderHistory'])->name('order-history');
    Route::post('action-master/update/{id}', [App\Http\Controllers\Admin\OrderController::class, 'updateorder'])->name('update-order');

    // Routes for company index view, store new data and update the company details
    Route::get('company-master', [App\Http\Controllers\Admin\CompanyController::class, 'index'])->name('company.view');
    Route::post('company-master', [App\Http\Controllers\Admin\CompanyController::class, 'store'])->name('company.store');
    Route::put('company-master/update', [App\Http\Controllers\Admin\CompanyController::class, 'update'])->name('company.update');

    // Routes for users index view, edit view, update and delete the users data
    Route::get('company-master/users', [App\Http\Controllers\Admin\CompanyController::class, 'users'])->name('company.users');
    Route::get('company-master/edit/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'edit_view'])->name('user.edit');
    Route::post('company-master/modify/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'update_user'])->name('update.user');
    Route::delete('company-master/delete/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'user_delete'])->name('user.delete');

    // Routes for messages views, update seen messages, delete messages and applied couriers
    Route::get('action-master/message', [App\Http\Controllers\Admin\CompanyController::class, 'messages'])->name('messages');
    Route::post('action-master/unread-message/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'messagesRead'])->name('read-messages');
    Route::delete('action-master/message-delete/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'message_delete'])->name('message.delete');
    Route::get('action-master/applied', [App\Http\Controllers\Admin\CompanyController::class, 'appliedCourier'])->name('applied-courier');
  
    // Routes for services index add view, edit and delete
    Route::get('company-service/add', [App\Http\Controllers\Admin\CompanyController::class, 'add'])->name('service.add');
    Route::get('company-service', [App\Http\Controllers\Admin\CompanyController::class, 'service'])->name('service.view');
    Route::get('company-service/edit/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'edit'])->name('service.edit');
    Route::delete('company-service/delete/{id}', [App\Http\Controllers\Admin\CompanyController::class, 'delete'])->name('service.delete');

    // Routes for courier index view, edit, store function, delete and suspension view page
    Route::get('courier-master', [App\Http\Controllers\Admin\CourierController::class, 'index'])->name('courier.view');
    Route::get('courier-master/add', [App\Http\Controllers\Admin\CourierController::class, 'add'])->name('courier.add');
    Route::post('courier-master/add', [App\Http\Controllers\Admin\CourierController::class, 'addCourier'])->name('courier.store');
    Route::get('courier-master/edit/{id}', [App\Http\Controllers\Admin\CourierController::class, 'edit'])->name('courier.edit');
    Route::post('courier-master/update/{id}', [App\Http\Controllers\Admin\CourierController::class, 'updateCourier'])->name('courier.update');
    Route::delete('courier-master/delete/{user_id}', [App\Http\Controllers\Admin\CourierController::class, 'delete'])->name('courier.delete');
    Route::post('courier-master/suspend/{user_id}', [App\Http\Controllers\Admin\CourierController::class, 'suspendCourier'])->name('suspend-courier');

    // Routes for Settings, App settings, Payment Settings and appearances
    Route::get('settings-master/paymentSettings', [App\Http\Controllers\Admin\SettingsController::class, 'paymentSettings'])->name('payment.settings');
    Route::post('settings-master/paymentSetting', [App\Http\Controllers\Admin\SettingsController::class, 'paymentSetting'])->name('payment.setting');
    Route::get('settings-master/currencyAdd', [App\Http\Controllers\Admin\SettingsController::class, 'currencyAdd'])->name('currency.add');
    Route::post('settings-master/currencyStore', [App\Http\Controllers\Admin\SettingsController::class, 'currencyStore'])->name('currency.store');
    Route::get('settings-master/appearanceSettings', [App\Http\Controllers\Admin\SettingsController::class, 'appearances'])->name('appearances.settings');
    Route::post('settings-master/section-one', [App\Http\Controllers\Admin\SettingsController::class, 'sectionOne'])->name('section-one');
    Route::post('settings-master/section-two', [App\Http\Controllers\Admin\SettingsController::class, 'sectionTwo'])->name('section-two');

    // Routes for front_service index view, edit and delete. Displayed on welcome page view
    Route::get('settings-master/services', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('service.index');
    Route::get('services/edit/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'edit'])->name('services.edit');
    Route::delete('services/delete/{id}', [App\Http\Controllers\Admin\SettingsController::class, 'delete'])->name('services.delete');
});

// Grouped middlewares and Auth for courier routes with 'courier' prefix
Route::group(['as' => 'courier.','prefix' => 'courier','namespace' => 'Courier', 'middleware' => ['auth', 'courier']], function(){

    // Routes for Courier dashboard index page, orders index view, order views, update order, courier ride and order history
    Route::get('dashboard', [App\Http\Controllers\Courier\DashboardController::class, 'index'])->name('dashboard');
    Route::get('courier/orders', [App\Http\Controllers\Courier\OrderController::class, 'newOrders'])->name('orders');
    Route::get('courier/edit/{id}', [App\Http\Controllers\Courier\OrderController::class, 'vieworder'])->name('orderView');
    Route::post('courier/update/{id}', [App\Http\Controllers\Courier\OrderController::class, 'updateorder'])->name('update-order');
    Route::get('courier/ride/{id}', [App\Http\Controllers\Courier\OrderController::class, 'courierRide'])->name('courier-ride');
    Route::get('courier/order/history', [App\Http\Controllers\Courier\OrderController::class, 'orderCompleted'])->name('order-completed');
    Route::get('courier/myinfo', [App\Http\Controllers\Courier\InfoController::class, 'courierInfo'])->name('courier-info');
    Route::post('courier/myinfos', [App\Http\Controllers\Courier\InfoController::class, 'courierInfos'])->name('courier-infos');

});

// Routes for suspended couriers view page.
Route::get('suspended/page', [App\Http\Controllers\Courier\DashboardController::class, 'SuspendedPage'])->name('courier-suspended');

// Routes for order couriers view, check my orders, order history, view my orders, review completed orders and checkout page.
Route::get('order-index', [App\Http\Controllers\User\OrderCourierController::class, 'index'])->name('order-index');
Route::post('order-courier', [App\Http\Controllers\User\OrderCourierController::class, 'orderCourier'])->name('order-courier');
Route::get('myorders', [App\Http\Controllers\User\OrderCourierController::class, 'orders'])->name('myorders');
Route::get('order-history', [App\Http\Controllers\User\OrderCourierController::class, 'orderHistory'])->name('order-history');
Route::get('view-order/{id}', [App\Http\Controllers\User\OrderCourierController::class, 'viewOrders'])->name('view-order');
Route::post('order-reviews/{id}', [App\Http\Controllers\User\OrderCourierController::class, 'orderReview'])->name('order-review');
Route::post('cancel-order/{id}', [App\Http\Controllers\User\OrderCourierController::class, 'cancel_orders'])->name('cancel-order');

// Routes for place orders
Route::get('checkout-index', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout-index');
Route::post('place-order', [App\Http\Controllers\CheckoutController::class, 'placeorder'])->name('place-order');

// Route for payment with paypal
Route::post('proceed-with-paypal', [App\Http\Controllers\Payment\PaypalController::class, 'paypal'])->name('payment');
Route::get('status', [App\Http\Controllers\Payment\PaypalController::class, 'paymentStatus'])->name('payment-status');

// Routes for payment with card/stripe
Route::post('proceed-with-card', [App\Http\Controllers\Payment\StripeController::class, 'card_payment'])->name('card-payment');

// Paystack 
Route::post('/paystack', [App\Http\Controllers\Payment\PaystackController::class, 'redirectToGateway'])->name('paystack');
Route::get('/payment/callback', [App\Http\Controllers\Payment\PaystackController::class, 'handleGatewayCallback']);

// RazorPay
Route::post('razorpay-payment', [App\Http\Controllers\Payment\RazorpayController::class, 'store']);
Route::post('razorpay/callback', [App\Http\Controllers\Payment\RazorpayController::class, 'razorCallBack']);

// Home Route and features from home page, like contact us and applying for courier.
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('courier-form', [App\Http\Controllers\HomeController::class, 'courierForm'])->name('courier-form');
Route::post('contact-form', [App\Http\Controllers\HomeController::class, 'contactForm'])->name('contact-form');