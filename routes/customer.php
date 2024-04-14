<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Customer\{
    CustomerAuthController,
    BasicApiController,
    ShopApiController,
    SettingApiController,
    CartApiController,
    AddressApiController,
    ProductApiController,
    OrderApiController,
    SectionsApiController,
    WithdrawalApiController,
};

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: *");

Route::group(['middleware' => ['customer.provider']], function () {

    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::get('login', [CustomerAuthController::class, 'notLogin'])->name('login');
    Route::post('add_fcm_token', [CustomerAuthController::class, 'addFcmToken']);
    Route::post('account-details/add', [CustomerAuthController::class, 'addAccountDetail']);

    // Guest
    /*Route::post('products_offline', [ProductApiController::class, 'getProductsOffline']);
    Route::post('products/variants_offline', [ProductApiController::class, 'getVariantsOffline']);*/
    Route::get('categories', [BasicApiController::class, 'getCategories']);
    Route::get('shop', [ShopApiController::class, 'getShopData']);
    Route::get('brands', [BasicApiController::class, 'getBrands']);
    Route::get('sales-channels', [CustomerAuthController::class, 'getSalesChannels']);

    Route::get('sellers', [BasicApiController::class, 'getSellers']);

    Route::middleware('customer.status')->group(function () {
        Route::group(['prefix' => 'products'], function () {
            Route::post('/', [ProductApiController::class, 'getProducts']);
            Route::post('similar', [ProductApiController::class, 'getSimilarProducts']);
            Route::post('search', [ProductApiController::class, 'getSearchProducts']);
            Route::get('all_names', [ProductApiController::class, 'getAllProductNames']);
        });
        Route::post('/product_by_id', [ProductApiController::class, 'getProduct']);
    });
    Route::get('/faqs', [BasicApiController::class, 'getFaqs']);
    Route::get('social_media', [BasicApiController::class, 'getSocialMedia']);
    Route::get('newsletter', [BasicApiController::class, 'getNewsletter']);

    // Settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingApiController::class, 'getSettings']);
        Route::get('time_slots', [SettingApiController::class, 'getTimeSlots']);
        Route::get('payment_methods', [SettingApiController::class, 'getPaymentMethods']);
    });

    //Languages
    Route::get('system_languages', [\App\Http\Controllers\API\LanguageApiController::class, 'getSystemLanguages']);

    // city deliverable
    Route::get('/cities', [BasicApiController::class, 'getCities']);
    Route::get('/city', [BasicApiController::class, 'getCity']);

    Route::get('offers', [BasicApiController::class, 'getOffers']);
    Route::get('/sliders', [BasicApiController::class, 'getSliders']);
    Route::get('notifications', [BasicApiController::class, 'getNotifications']);
    Route::get('/sections', [SectionsApiController::class, 'getSections']);


    /***********************************************************************************************/
    // API After Login here

    Route::group(['middleware' => ['auth:api-customers', 'customer.status']], function () {

        //Route::group(['middleware' => ['auth:api']], function () {

        // User
        Route::post('logout', [CustomerAuthController::class, 'logout']);
        Route::post('delete_account', [CustomerAuthController::class, 'deleteAccount']);
        Route::post('edit_profile', [CustomerAuthController::class, 'editProfile']);
        Route::post('change_password', [CustomerAuthController::class, 'changePassword']);
        Route::post('upload_profile', [CustomerAuthController::class, 'uploadProfile']);
        Route::post('update_fcm_token', [CustomerAuthController::class, 'updateFcmToken']);
        Route::get('user_details', [CustomerAuthController::class, 'getLoginUserDetails']);

        // Transactions
        Route::get('get_user_transactions', [BasicApiController::class, 'getUserTransactions']);
        Route::post('add_wallet_balance', [BasicApiController::class, 'addWalletBalance']);

        // Address
        Route::group(['prefix' => 'address'], function () {
            Route::get('/', [AddressApiController::class, 'getAddress']);
            Route::post('/add', [AddressApiController::class, 'save']);
            Route::post('/update', [AddressApiController::class, 'update']);
            Route::post('/delete', [AddressApiController::class, 'delete']);
        });


        // Withdrawal Requests
        Route::group(['prefix' => 'withdrawal_requests'], function () {
            Route::get('/', [WithdrawalApiController::class, 'getRequest']);
            Route::post('/add', [WithdrawalApiController::class, 'save']);
        });


        // Favorites
        Route::group(['prefix' => 'favorites'], function () {
            Route::get('/', [BasicApiController::class, 'getFavorites']);
            Route::post('/add', [BasicApiController::class, 'addToFavorite']);
            Route::post('/remove', [BasicApiController::class, 'removeFromFavorite']);
        });

        // Carts
        Route::group(['prefix' => 'cart'], function () {
            Route::get('/', [CartApiController::class, 'getUserCart']);
            Route::post('/add', [CartApiController::class, 'addToCart']);
            Route::post('/remove', [CartApiController::class, 'removeFromCart']);
            Route::post('/save_for_later', [CartApiController::class, 'addToSaveForLater']);
        });



        // Offers
        Route::group(['prefix' => 'offers'], function () {
            Route::post('/add', [BasicApiController::class, 'addOffers']);
            Route::post('/remove/{id}', [BasicApiController::class, 'removeOffers']);
        });

        // stripeTest
        Route::get('/stripeTest', [BasicApiController::class, 'stripeTest']);

        Route::group(['prefix' => 'sliders'], function () {
            Route::post('/add', [BasicApiController::class, 'addSliders']);
            Route::post('/remove/{id}', [BasicApiController::class, 'removeSliders']);
        });

        // Promo Code
        Route::group(['prefix' => 'promo_code'], function () {
            Route::get('/', [BasicApiController::class, 'getPromoCode']);
            Route::post('/validate', [BasicApiController::class, 'validatePromoCode']);
        });

        // Sections
        Route::group(['prefix' => 'sections'], function () {
            Route::get('/delivery_boy_notifications', [SectionsApiController::class, 'getDeliveryBoyNotifications']);
            Route::post('/remove/{id}', [SectionsApiController::class, 'removeSection']);
            //Route::post('/add', [SectionsApiController::class, 'addSection']);
        });


        // order
        Route::get('orders', [OrderApiController::class, 'getOrders']);
        Route::post('invoice', [OrderApiController::class, 'generateOrderInvoice'])->name('customerInvoice');
        Route::post('invoice_download', [OrderApiController::class, 'downloadOrderInvoice']);

        Route::get('order_status_lists', [BasicApiController::class, 'getOrderStatusLists']);

        Route::post('order_test', [OrderApiController::class, 'orderTest']);

        //Checkout
        Route::post('place_order', [OrderApiController::class, 'placeOrder']);
        Route::post('initiate_transaction', [OrderApiController::class, 'initiateTransaction']);
        Route::post('add_transaction', [OrderApiController::class, 'addTransaction']);
        Route::post('update_order_status', [OrderApiController::class, 'updateOrderStatus']);
        Route::post('delete_order', [OrderApiController::class, 'deletePaymentPendingOrder']);


        //Paypal
        /*Route::get('paypal_redirect', [OrderApiController::class, 'paypalRedirect']);*/
        /*Route::post('ipn', [OrderApiController::class, 'ipn']);*/

        //PayTm
        Route::get('paytm_checksum', [OrderApiController::class, 'generatePaytmChecksum']);
        Route::get('paytm_txn_token', [OrderApiController::class, 'generatePaytmTxnToken']);

        // Seller
        Route::get('/seller', [BasicApiController::class, 'getSeller']);

        // mail_settings
        Route::group(['prefix' => 'mail_settings'], function () {
            Route::get('/', [BasicApiController::class, 'getMailSetting']);
            Route::post('save', [BasicApiController::class, 'saveMailSetting']);
        });


        //});
    });

    //Paypal
    Route::get('paypal_payment_url', [OrderApiController::class, 'paypalPaymentUrl']);
    // Route::get('paypal_redirect', [OrderApiController::class, 'paypalRedirect']);
    Route::match(array('GET', 'POST'), 'paypal_redirect/success', [OrderApiController::class, 'paypalRedirect']);
    Route::match(array('GET', 'POST'), 'paypal_redirect/fail', [OrderApiController::class, 'paypalRedirect']);
    Route::post('ipn', [OrderApiController::class, 'ipn']);

    //Calculate Distance Testing for development
    Route::get('distance_test', [BasicApiController::class, 'findGoogleMapDistanceTest']);
});
