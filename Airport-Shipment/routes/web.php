<?php

use App\Models\Trip;
use App\Models\Coupon;
use App\Models\Shipment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShipmentController;

//use Auth;

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

// Laravel Default Auth
// reset => false disabled the password reset option for client
Auth::routes(['reset' => false]);

// Auth::routes();
// Route::get('/home', [HomeController::class, 'index'])->name('home');



// Admin Routes
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'isAdmin']], function () {
    // Admin Dashboard
    Route::get('/dashboard', [HomeController::class, 'getAdminDashboard'])->name('admin.dashboard');

    // User Part
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Trip Part
    Route::get('/trips', [TripController::class, 'index'])->name('admin.trips.index');
    Route::get('/trips/{id}/destroy', [TripController::class, 'destroy'])->name('admin.trips.destroy');
    Route::get('/trips/payment-list', [TripController::class, 'paymentList'])->name('admin.trips.paylist');

    // Shipment Part
    Route::get('/shipments', [ShipmentController::class, 'index'])->name('admin.shipments.index');
    Route::get('/shipments/{id}/destroy', [ShipmentController::class, 'destroy'])->name('admin.shipments.destroy');
    Route::get('/shipments/payment-list', [ShipmentController::class, 'paymentList'])->name('admin.shipments.paylist');

    // Coupon Part
    Route::get('/coupons', [CouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/coupons/{id}/edit', [CouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::post('/coupons/{id}/update', [CouponController::class, 'update'])->name('admin.coupons.update');
    Route::get('/coupons/{id}/destroy', [CouponController::class, 'destroy'])->name('admin.coupons.destroy');

    Route::get('/coupons/payment-list', [CouponController::class, 'paymentList'])->name('admin.coupon.paylist');

});



// Client Routes
Route::get('/', function () {
    $currentDate = Carbon::now()->toDateString();
    $activeCoupons = Coupon::where('is_active', 1)
                        ->where('expired_at', '>', $currentDate)
                        ->get();

    // return $activeCoupons;
    // return view('layouts.client');
    return view('client.home', compact('activeCoupons'));
});


Route::group(['middleware' => ['auth']], function () {
    // Client Dashboard
    Route::get('/dashboard', [ClientController::class, 'getClientDashboard'])->name('client.dashboard');

    // Client Profile
    Route::get('/my-profile', [ClientController::class, 'getMyProfile'])->name('show.profile');
    Route::post('/my-profile/update', [ClientController::class, 'updateMyProfile'])->name('update.profile');

    // Client Trips
    Route::get('/my-trips', [TripController::class, 'getMyTrips'])->name('show.trips');
    Route::get('/my-trips/add', [TripController::class, 'addMyTrip'])->name('add.trip');
    Route::post('/my-trips/save', [TripController::class, 'saveMyTrip'])->name('save.trip');
    Route::get('/my-trips/{id}/edit', [TripController::class, 'editMyTrip'])->name('edit.trip');
    Route::post('/my-trips/{id}/update', [TripController::class, 'updateMyTrip'])->name('update.trip');
    Route::get('/my-trips/{id}/delete', [TripController::class, 'deleteMyTrip'])->name('delete.trip');


    // Client Trips Payment    
    Route::post('/trip/payment-stripe', [StripeController::class, 'requestTripPayment'])->name('req.trip.pay');
    Route::get('/stripe/trip-payment-form', [StripeController::class, 'getStripeTripPaymentForm'])->name('stripe.trip.form');
    Route::post('/stripe/trip-payment-process', [StripeController::class, 'processStripeTripPayment'])->name('process.trip.stripe');


    // Client Shipments Payment
    Route::post('/shipment/payment-stripe', [StripeController::class, 'requestShipmentPayment'])->name('req.shipment.pay');
    Route::get('/stripe/shipment-payment-form', [StripeController::class, 'getStripeShipmentPaymentForm'])->name('stripe.shipment.form');


    // Client Shipment Plan Choose
    Route::get('/shipment-plan/choose', [StripeController::class, 'getChoosePlan'])->name('get.shipment.plan');
    Route::post('/shipment-plan/payment-process', [StripeController::class, 'processStripeShipmentPayment'])->name('process.shipment.plan');

    Route::post('/shipment-plan/choose/basic', [StripeController::class, 'choooseBasicPlan'])->name('choose.basic.plan');
    Route::post('/shipment-plan/choose/month', [StripeController::class, 'choooseMonthPlan'])->name('choose.month.plan');
    Route::post('/shipment-plan/choose/year', [StripeController::class, 'choooseYearPlan'])->name('choose.year.plan');

    // Route::post('/shipment-plan/basic/save', [StripeController::class, 'saveBasicPlan'])->name('save.shipment.plan');

    // Client Shipment Coupon Payment
    Route::post('/shipment-coupon/choose', [StripeController::class, 'chooseShipmentCoupon'])->name('choose.shipment.coupon');
    Route::get('/shipment-coupon/choose', [StripeController::class, 'getStripeCouponForm'])->name('stripe.coupon.form');
    Route::post('/shipment-coupon/payment-process', [StripeController::class, 'processStripeCouponPayment'])->name('process.shipment.coupon');




    // Client Shipments
    Route::get('/my-shipments', [ShipmentController::class, 'getMyShipments'])->name('show.shipments');
    Route::get('/my-shipments/add', [ShipmentController::class, 'addMyShipment'])->name('add.shipment');
    Route::post('/my-shipments/save', [ShipmentController::class, 'saveMyShipment'])->name('save.shipment');
    Route::get('/my-shipments/{id}/edit', [ShipmentController::class, 'editMyShipment'])->name('edit.shipment');
    Route::post('/my-shipments/{id}/update', [ShipmentController::class, 'updateMyShipment'])->name('update.shipment');
    Route::get('/my-shipments/{id}/delete', [ShipmentController::class, 'deleteMyShipment'])->name('delete.shipment');

    // client shipments matched trips
    Route::get('/my-shipments/{id}/matched-trips', [ShipmentController::class, 'findMatchedTripsForShipment'])->name('matched.trips');

    // client Hire Traveller for Shipment
    Route::post('/hire-trip', [ShipmentController::class, 'hireTripForShipment'])->name('hire.trip');

    // show travellers and shippers
    Route::get('/hired-travellers', [ShipmentController::class, 'hiredTravellers'])->name('hired.travellers');
    // Route::get('/hired-shippers', [ShipmentController::class, 'hiredByShippers'])->name('hired.shippers');



});



