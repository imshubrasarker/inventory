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
	Route::get('/payment-list-print/supplier', 'PaymentsController@printPaymentViewSupplier');
	Route::get('/stock-list-print', 'StocksController@printStockView');
	Route::get('/product-list-print', 'ProductsController@printProductView');



	Route::get('/invoice-create/{id}', 'InvoicesController@invoiceCreateByCustomerId');

	Route::get('customer-ledger', 'CustomersController@customerLedgerSearchView');
	Route::get('/customer-ledger-search-data', 'CustomersController@customerLedgerSearchData');

	Route::get('/customer-ledger-print/{id}', 'CustomersController@customerLedgerView');

	Route::get('/supplier-ledger-print/{id}', 'SupplierController@supplyLedgerView');


	Route::resource('invoices', 'InvoicesController');
	Route::get('/list-print', 'InvoicesController@printInvoicedata');
	// Route::get('invoices/create', 'InvoicesController@create');

	Route::get('/invoices-print/{invoice_no}', 'InvoicesController@printInvoice');
	Route::resource('payments', 'PaymentsController');
	Route::get('/payment/create/{id}', 'PaymentsController@paymentsCreateByCustomer');
	Route::get('/payments/create/supplier', 'PaymentsController@paymentsCreateSupplier');

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
	Route::post('/get-supplier-detail', 'SearchController@getSupplierDetail')->name('get_supplier_detail');
	Route::get('/expenses-head', 'ExpensesHeadController@index')->name('expenses-head');
	Route::post('/expenses-head', 'ExpensesHeadController@store')->name('store-expenses-head');
	Route::patch('/edit-expense-head/{id}', 'ExpensesHeadController@update')->name('edit-expense-head');
	Route::delete('/delete-expense-head{id}', 'ExpensesHeadController@destroy')->name('delete-expense-head');
    Route::resource('expenses', 'ExpenseController');
    Route::get('/expenses-search', 'ExpenseController@search')->name('expenses-search');
    Route::get('/supplier/search', 'SupplierController@search')->name('search.supplier');
    Route::resource('supplier', 'SupplierController');
    Route::resource('purchase', 'PurchaseController');
    Route::get('/godown1', 'PurchaseController@godown')->name('godown1.name');
    Route::resource('godown-unit', 'GodownUnitController');
    Route::resource('godown2', 'Godown2Controller');
    Route::resource('godown-3', 'Godown3Controller');
    Route::post('move-to-stocks','Godown2Controller@moveToProduction' )->name('move-to-stocks');
    Route::get('print-purchase', 'PurchaseController@printView')->name('purchase.print');
    Route::get('print-supllier', 'SupplierController@printView')->name('supplier.print');
    Route::get('supllier/leadger/{id}', 'SupplierController@leadgerView')->name('supplier.leadger');
    Route::get('print-expence', 'ExpenseController@printShow')->name('expence.print');
    Route::get('payment/supplier', 'PaymentsController@supplierIndex')->name('supplier.payment.index');
});



