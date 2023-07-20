

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

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\VericationController;


//route to the login form
Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();



Route::group(['middleware' => ['auth','verified']], function () {
	// DASHBOARD ROUTES AFTER LOGIN
	Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

	Route::get('dashboard', function () {
		return view('layouts.master');
	});


	Route::resource('categories', 'App\Http\Controllers\CategoryController');
	Route::get('/Catergory', 'App\Http\Controllers\CategoryController@addcategory')->name('AddCatergory');
	Route::get('/DeleteCatergory/{id}', 'App\Http\Controllers\CategoryController@delete_category')->name('delete_category');
	Route::get('/displaySubCatergory/{id}', 'App\Http\Controllers\CategoryController@display_Subcategory')->name('display_Subcategory');
	Route::get('/addSubCatergory/{id}', 'App\Http\Controllers\CategoryController@add_Subcategory')->name('add_Subcategory');
	Route::post('/storeSubcatergory', 'App\Http\Controllers\CategoryController@store_subcatergory')->name('store_subcatergory');
	Route::get('/apiCategories', 'App\Http\Controllers\CategoryController@apiCategories')->name('api.categories');
	Route::get('/exportCategoriesAll', 'App\Http\Controllers\CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
	Route::get('/exportCategoriesAllExcel', 'App\Http\Controllers\CategoryController@exportExcel')->name('exportExcel.categoriesAll');

   //subcategoryfields
   Route::get('/subcategoryfield/{id}/{id2}', 'App\Http\Controllers\CategoryController@displaysubcategoryfield')->name('display_Subcategoryfield');
   Route::get('/addsubcategoryfield/{id}/{id2}', 'App\Http\Controllers\CategoryController@addsubcategoryfield')->name('add_Subcategoryfield');
   Route::post('/storeSubcatergoryfield', 'App\Http\Controllers\CategoryController@store_subcatergoryfield')->name('store_subcatergoryfield');

   //FieldOption
    Route::get('fieldOption/{id}/{id2}', 'App\Http\Controllers\fieldOptionController@index')->name('displayFieldOption');
	Route::post('storefieldOption', 'App\Http\Controllers\fieldOptionController@storefieldOption')->name('storeFieldOption');
	Route::get('addfieldOption/{id}', 'App\Http\Controllers\fieldOptionController@displaypage')->name('storeFieldOptionpage');


	//routes country
	Route::resource('country', 'App\Http\Controllers\CountryController');
	Route::get('/addcountry', 'App\Http\Controllers\CountryController@addcountry')->name('AddCountry');
	Route::get('/delete/{id}', 'App\Http\Controllers\CountryController@deletecountry')->name('deleteCountry');

	Route::resource('payement', 'App\Http\Controllers\payementController');
	Route::get('/deletepayement/{id}', 'App\Http\Controllers\payementController@deletepayement')->name('payementdelete');

	Route::resource('customers', 'App\Http\Controllers\CustomerController');
	Route::get('/apiCustomers', 'App\Http\Controllers\CustomerController@apiCustomers')->name('api.customers');
	Route::post('/importCustomers', 'App\Http\Controllers\CustomerController@ImportExcel')->name('import.customers');
	Route::get('/exportCustomersAll', 'App\Http\Controllers\CustomerController@exportCustomersAll')->name('exportPDF.customersAll');
	Route::get('/exportCustomersAllExcel', 'App\Http\Controllers\CustomerController@exportExcel')->name('exportExcel.customersAll');

	Route::resource('sales', 'App\Http\Controllers\SaleController');
	Route::get('/apiSales', 'App\Http\Controllers\SaleController@apiSales')->name('api.sales');
	Route::post('/importSales', 'App\Http\Controllers\SaleController@ImportExcel')->name('import.sales');
	Route::get('/exportSalesAll', 'App\Http\Controllers\SaleController@exportSalesAll')->name('exportPDF.salesAll');
	Route::get('/exportSalesAllExcel', 'App\Http\Controllers\SaleController@exportExcel')->name('exportExcel.salesAll');

	Route::resource('suppliers', 'App\Http\Controllers\SupplierController');
	Route::get('/apiSuppliers', 'App\Http\Controllers\SupplierController@apiSuppliers')->name('api.suppliers');
	Route::post('/importSuppliers', 'App\Http\Controllers\SupplierController@ImportExcel')->name('import.suppliers');
	Route::get('/exportSupplierssAll', 'App\Http\Controllers\SupplierController@exportSuppliersAll')->name('exportPDF.suppliersAll');
	Route::get('/exportSuppliersAllExcel', 'App\Http\Controllers\SupplierController@exportExcel')->name('exportExcel.suppliersAll');

	Route::resource('products', 'App\Http\Controllers\ProductController');
	Route::post('/StoreProduct', 'App\Http\Controllers\ProductController@store_product')->name('store_product');
	Route::get('/DisplayProduct', 'App\Http\Controllers\ProductController@Display_product')->name('DiaplayProducts');
	Route::get('/apiProducts', 'App\Http\Controllers\ProductController@apiProducts')->name('api.products');
    
	//PRODUCTS DEMO
    
	Route::get('product-form', 'App\Http\Controllers\manageproductcontroller@showform')->name('productform');

	Route::resource('productsOut', 'App\Http\Controllers\ProductKeluarController');
	Route::get('/apiProductsOut', 'App\Http\Controllers\ProductKeluarController@apiProductsOut')->name('api.productsOut');
	Route::get('/exportProductKeluarAll', 'App\Http\Controllers\ProductKeluarController@exportProductKeluarAll')->name('exportPDF.productKeluarAll');
	Route::get('/exportProductKeluarAllExcel', 'App\Http\Controllers\ProductKeluarController@exportExcel')->name('exportExcel.productKeluarAll');
	Route::get('/exportProductKeluar/{id}', 'App\Http\Controllers\ProductKeluarController@exportProductKeluar')->name('exportPDF.productKeluar');

	Route::resource('productsIn', 'App\Http\Controllers\ProductMasukController');
	Route::get('/apiProductsIn', 'App\Http\Controllers\ProductMasukController@apiProductsIn')->name('api.productsIn');
	Route::get('/exportProductMasukAll', 'App\Http\Controllers\ProductMasukController@exportProductMasukAll')->name('exportPDF.productMasukAll');
	Route::get('/exportProductMasukAllExcel', 'App\Http\Controllers\ProductMasukController@exportExcel')->name('exportExcel.productMasukAll');
	Route::get('/exportProductMasuk/{id}', 'App\Http\Controllers\ProductMasukController@exportProductMasuk')->name('exportPDF.productMasuk');

	Route::resource('user','App\Http\Controllers\UserController');


	Route::get('/apiUser', 'App\Http\Controllers\UserController@apiUsers')->name('api.users');
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('permissions', 'App\Http\Controllers\PermissionController');
	//editing user profile route
    Route::resource('profile', 'App\Http\Controllers\Auth\ProfileController');
    Route::resource('profile_photo', 'App\Http\Controllers\Auth\ProfilePhotoController');
	


	//route for adding user by the admin
	Route::post('/user/add', 'App\Http\Controllers\UserController@addUser')->name('add_user');

	// vendor profile routes
	// Route::get('/ShopInformation', fn () => view('profile.shopInfo'))->name('shopInfo');
	Route::get('/businessInformation', fn () => view('profile.businessInfo'))->name('businessInfo');
	// Route::get('/paymentInformation', fn () => view('profile.paymentInfo'))->name('paymentInfo');

	Route::patch('/shopInformation',[App\Http\Controllers\Auth\ProfileController::class,'updateshop'])->name('shopInfo');
	Route::get('/payment',[App\Http\Controllers\Auth\ProfileController::class,'createPayment'])->name('payment');
	Route::patch('/paymentInformation',[App\Http\Controllers\Auth\ProfileController::class,'updatePayment'])->name('paymentInfo');

	// buyer profile
    Route::resource('account', 'App\Http\Controllers\Auth\BuyerProfileController');
	Route::get('/create new address', fn () => view('profile.buyer_profile.address'))->name('addAddress');
	Route::patch('/businessInformation',[App\Http\Controllers\Auth\ProfileController::class,'createOrUpdate'])->name('createOrUpdateVendorBusiness');
	
	Route::get('/businessInformation',[App\Http\Controllers\Auth\ProfileController::class,'returnVendorBusiness'])->name('businessInfo');







	



});
	// facebook auth routes
Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
Route::get('auth/facebook/callback', [SocialController::class, 'facebookCallback']);

// google auth routes
Route::get('auth/google', [SocialController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']);

// REGISTERING THE ROUTES FOR USER ACCOUNT CREATION

 //used when a user creates account themselves
Route::get('create-account', [App\Http\Controllers\UserController::class,'createUser'])->name('create-account');
Route::post('account created',[App\Http\Controllers\UserController::class,'storeUser'])->name('save-account');


//routes for user email verification
Route::get('/email/verify', 'App\Http\Controllers\Auth\EmailVerificationController@show')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\EmailVerificationController@verify')->name('verification.verify');
Route::post('/email/resend', 'App\Http\Controllers\Auth\EmailVerificationController@resend')->name('verification.resend');

//routes for password reset
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


