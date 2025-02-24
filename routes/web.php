    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\Cashew_LayoutController;
    use App\Http\Controllers\OrderDetailsController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\PincodeController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\OTPController;

    Route::get('/otp-login', function () {
        return view('otp_login.otp_login');
    })->name('otp.login');

    Route::post('/send-otp', [OTPController::class, 'sendOTP'])->name('otp.send');
    Route::get('/otp/verify', [OTPController::class, 'showVerifyForm'])->name('otp.verify.form');
    Route::post('/otp/verify', [OTPController::class, 'verifyOTP'])->name('otp.verify');
        

    // Login
    Route::get('usercreate', [UserController::class, 'usercreate'])->name('user.usercreate');
    Route::post('userstore', [UserController::class, 'store'])->name('user.store');
    //Logout:
    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware('auth.user')->group(function () {

        Route::middleware(['auth', 'role:Admin'])->group(function () {
        //User
    Route::get('useredit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('userupdate/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('userindex', [UserController::class, 'index'])->name('user.index');
    Route::delete('userdestroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');


    //Product_Layout

    Route::get('productindex', [ProductController::class, 'index'])->name('product.index');
    Route::get('productcreate', [ProductController::class, 'create'])->name('product.create');
    Route::post('productstore', [ProductController::class, 'store'])->name('product.store');
    Route::get('productpdit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::match(['post', 'put'], 'ProductUpdate/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('productshow/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    //orders
    Route::get('/orders', [OrderDetailsController::class, 'OrderIndex'])->name('OrderDetails.OrderIndex');
        Route::get('/accept-order/{orderId}', [OrderDetailsController::class, 'acceptOrder'])->name('OrderDetails.acceptOrder');


    });

    //MainCashew_Layout

    Route::middleware(['auth', 'role:Client'])->get('/', [Cashew_LayoutController::class, 'index'])->name('app.cashew_Layout');


    //Cashew_Layout

    Route::get('account-details/{id} ', [Cashew_LayoutController::class, 'show'])->name('app.accountdetails');
    
    // Route::post('/account-details/update', [Cashew_LayoutController::class, 'update'])->name('App.AccountDetailsUpdate');
    Route::post('customer-save/{id}', [Cashew_LayoutController::class, 'Customerstore'])->name('app.accountdetailsupdate');


    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/get-cart-details', [CartController::class, 'getCartDetails'])->name('get-cart-details');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');


    Route::post('/update-cart-quantity', [CartController::class, 'updateCartQuantity']);
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart']);
        //payment
    Route::get('/OrderDetails/{productId}', [OrderDetailsController::class, 'index'])->name('orderdetails.orderdetails');
    Route::post('/OrderDetails', [OrderDetailsController::class, 'orderDetails'])->name('orderdetails.multiorderdetails');

    Route::post('/placeOrder', [OrderDetailsController::class, 'placeOrder'])->name('placeOrder');
    Route::get('/order-confirmation', function () { return view('OrderDetails.confirmation');})->name('orderdetails.confirmation');

    Route::get('order/{id}/details', [OrderDetailsController::class, 'showOrderDetails'])->name('orderdetails.show');
    Route::get('order/print/{id}', [OrderDetailsController::class, 'printOrder'])->name('orderdetails.print');


    Route::get('/get-location-data/{pincode}', [PincodeController::class, 'getLocationData']);

    //DashboardIndex
    Route::get('dashboardindex', [DashboardController::class, 'index'])->name('dashboard.index');





    });

    Route::get('/', [Cashew_LayoutController::class, 'index'])->name('app.cashew_layout');