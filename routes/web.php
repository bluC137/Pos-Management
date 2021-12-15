<?php

use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/orders', 'OrderController'); //orders.index
Route::resource('/products', 'ProductController'); //products.index
Route::resource('/suppliers', 'SupplierController'); //suppliers.index
Route::resource('/users', 'UserController'); //users.index
Route::resource('/stocks', 'StockinController'); //stocks.index
Route::resource('/transactions', 'TransactionController'); //transactions.index
Route::get('barcode', 'ProductController@GetProductBarcodes')->name('products.barcode');
Route::resource('/sections', 'SectionController'); //sections.
// ============================== Dynamic Function (return view,edit,delete)
Route::prefix('home-function')->group(function(){
    Route::post('{id}', 'HomeController@showFunctions')->name('home-functions');
});
Route::prefix('product-function')->group(function(){
    Route::post('/update', 'ProductController@update')->name('product-update');
});
Route::prefix('product-desctroy')->group(function(){
    Route::post('/delete', 'ProductController@destroy')->name('product-desctroy');
});
Route::prefix('product-retrieve')->group(function(){
    Route::post('/retrieve', 'ProductController@retrieve')->name('product-retrieve');
});
Route::prefix('orders-data')->group(function(){
    Route::get('for-approval', 'OrderTransactionController@for_approval')->name('order-for-approval');
});
Route::prefix('reports')->group(function(){
    Route::get('sales-report', 'HomeController@print_sales_report')->name('sales-report');
    Route::get('product-report', 'HomeController@print_product_sales')->name('product-report');
});
Route::get('cashier', 'OrderController@index')->name('cashier-content');

// ==============================
Route::delete('/service-cate-delete/{id}','OrderController@delete');


// Route::get('barcodes', function () {
//     return $products = Product::select('barcode') ->get() ;
//     return view('products.barcode.index');

// })-> name('products.barcode');
