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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
	return view('auth.login');
});

Auth::routes();

Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/users', 'UsersController@index');
	Route::get('users/create', 'UsersController@create');
	Route::post('users', 'UsersController@store');
	Route::get('/users/{id}', 'UsersController@show');
	Route::post('/assign-role', 'UsersController@assignRole')->name('assign-role');
	Route::delete('/users/{id}', 'UsersController@destroy');
	Route::get('/user-active/{id}', 'UsersController@activeUser');
	Route::get('/user-deactive/{id}', 'UsersController@deactiveUser');

	Route::resource('roles', 'RolesController');
	Route::resource('units', 'UnitsController');
	Route::resource('categories', 'CategoriesController');

	Route::resource('products', 'ProductsController');

	Route::resource('stocks', 'StocksController');
	Route::get('/product-ledger/{id}', 'StocksController@productLedgerView');
	Route::get('/product-ledger-print/{id}', 'StocksController@productLedgerViewPrint');

	Route::post('/stocks-add-update', 'StocksController@store');

	Route::resource('customers', 'CustomersController');
	Route::get('customers/{id}','CustomersController@show');

	Route::get('/customer-list-print', 'CustomersController@printCustomerView');
	Route::get('/payment-list-print', 'PaymentsController@printPaymentView');
	Route::get('/stock-list-print', 'StocksController@printStockView');
	Route::get('/product-list-print', 'ProductsController@printProductView');



	Route::get('/invoice-create/{id}', 'InvoicesController@invoiceCreateByCustomerId');

	Route::get('customer-ledger', 'CustomersController@customerLedgerSearchView');
	Route::get('/customer-ledger-search-data', 'CustomersController@customerLedgerSearchData');

	Route::get('/customer-ledger-print/{id}', 'CustomersController@customerLedgerView');


	Route::resource('invoices', 'InvoicesController');
	Route::get('/list-print', 'InvoicesController@printInvoicedata');
	// Route::get('invoices/create', 'InvoicesController@create');

	Route::get('/invoices-print/{invoice_no}', 'InvoicesController@printInvoice');
	Route::resource('payments', 'PaymentsController');
	Route::get('/payment/create/{id}', 'PaymentsController@paymentsCreateByCustomer');

	Route::get('/payment-sms/{id}', 'PaymentsController@sentSmsByPayment');
	Route::get('/invoice-sms/{id}', 'InvoicesController@sentSmsByInvoice');

	Route::get('/product-by-stock/{id}', 'StocksController@getInvoiceInfo');


	Route::get('/password-change', 'UsersController@passwordChangeView');
	Route::post('/password-change-save', 'UsersController@passwordChanged')->name('password-change');
	Route::get('/print-customer-ledger/{id}', 'CustomersController@customerLedgerView');
	Route::resource('smses', 'SmsesController');
	Route::resource('companies', 'CompaniesController');



	Route::get('/autocomplete', 'SearchController@autocomplete');
	Route::post('/get-product-detail', 'SearchController@getProductDetail')->name('get_product_detail');
	Route::post('/get-customer-detail', 'SearchController@getCustomerDetail')->name('get_customer_detail');
	Route::get('/expenses-head', 'ExpensesHeadController@index')->name('expenses-head');
	Route::post('/expenses-head', 'ExpensesHeadController@store')->name('store-expenses-head');
	Route::patch('/edit-expense-head/{id}', 'ExpensesHeadController@update')->name('edit-expense-head');
	Route::delete('/delete-expense-head{id}', 'ExpensesHeadController@destroy')->name('delete-expense-head');
    Route::resource('expenses', 'ExpenseController');
    Route::get('/expenses-search', 'ExpenseController@search')->name('expenses-search');
    Route::get('/supplier/search', 'SupplierController@search')->name('search.supplier');
    Route::resource('supplier', 'SupplierController');


});



