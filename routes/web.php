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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/home');
});

Route::get('/logout', function () {
    // return view('welcome');
    return redirect('/home');
});

Auth::routes();
// Route::group( ['middleware' => 'auth'], function(){
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@home')->name('home');

Route::get('/admin', function () {
    return view('admin.brand.index');
});

Route::resource('/brands', 'Admin\BrandController');
Route::resource('/categories', 'Admin\CategoryController');
Route::resource('/products', 'Admin\ProductController');
Route::resource('/store', 'Admin\StoreController');
// Route::resource('/stock', 'Admin\StockController');
// Route::POST('/user', 'Admin\UserController@index')->name('user.index');
Route::resource('/user', 'Admin\UserController');
Route::resource('/role', 'Admin\RoleController');


Route::resource('/customer', 'Admin\CustomerController');
Route::resource('/customertype', 'Admin\CustomerTypeController');
Route::get('/customerpoint', 'Admin\CustomerController@point')->name('customerpoint');
Route::post('/customer-point-update', 'Admin\CustomerController@pointUpdate')->name('customer-point-update');

Route::resource('/unit', 'Admin\UnitController');
Route::resource('/supplier_payment_alert', 'Admin\SupplierAlertController');
Route::resource('/supplier', 'Admin\SupplierController');
// Stock Module //

Route::GET('stocks', 'Admin\StockController@index')->name('stocks.index');
Route::GET('stocks/create', 'Admin\StockController@create')->name('stocks.create');
Route::POST('stocks', 'Admin\StockController@store')->name('stocks.store');
Route::GET('stocks-edit/{id}', 'Admin\StockController@edit')->name('stocks.edit');
Route::PUT('stocks/{id}', 'Admin\StockController@update')->name('stocks.update');
Route::DELETE('stocks/{id}', 'Admin\StockController@destroy')->name('stocks.destroy');

Route::GET('stocks/buy/{id}', 'Admin\AjaxController@purchase_price');

Route::GET('/stock_in', 'Admin\StockController@stock_in')->name('stock_in');
Route::GET('/stock_out', 'Admin\PurchaseController@stock_out')->name('stock_out');

// Stock Requisition //

Route::GET('stocks/requisition', 'Admin\StockController@requisition')->name('requisition.index');
Route::GET('stocks/requisition/{id}', 'Admin\StockController@requisition_check')->name('requisition.check');
Route::POST('stocks/requisition', 'Admin\StockController@requisition_store')->name('requisition.store');
Route::PUT('stocks/requisition/{id}', 'Admin\StockController@requisition_update')->name('requisition.update');
Route::DELETE('stocks/requisition/{id}', 'Admin\StockController@requisition_destroy')->name('requisition.destroy');


// Purchase Related Route
Route::get('/purchases', 'Admin\PurchaseController@purchase')->name('purchases');
Route::post('/purchases', 'Admin\PurchaseController@purchase_store')->name('purchases.store');
Route::PUT('/purchases/{id}', 'Admin\PurchaseController@purchase_update')->name('purchases.update');
Route::DELETE('purchases/{id}', 'Admin\PurchaseController@purchase_destroy')->name('purchases.destroy');
Route::get('/purchases_item', 'Admin\PurchaseController@purchase_item')->name('purchase_item');
Route::post('/purchases_item', 'Admin\PurchaseController@purchase_item_store')->name('purchase_item.store');
Route::PUT('/purchases_item/{id}', 'Admin\PurchaseController@purchase_item_update')->name('purchase_item.update');
Route::DELETE('/purchases_item/{id}', 'Admin\PurchaseController@purchase_item_destroy')->name('purchase_item.destroy');
// delivery

Route::GET('delivery/agent', 'Admin\DeliveryAgentController@index')->name('delivery.agent');
Route::POST('delivery/agent', 'Admin\DeliveryAgentController@store')->name('delivery.agent.store');
Route::PUT('delivery/agent/{id}', 'Admin\DeliveryAgentController@update')->name('delivery.agent.update');
Route::DELETE('delivery/agent/{id}', 'Admin\DeliveryAgentController@destroy')->name('delivery.agent.destroy');
Route::GET('delivery/persons', 'Admin\DeliveryPersonController@index')->name('delivery.persons');
Route::POST('delivery/persons', 'Admin\DeliveryPersonController@store')->name('delivery.persons.store');
Route::PUT('delivery/persons/{id}', 'Admin\DeliveryPersonController@update')->name('delivery.persons.update');
Route::DELETE('delivery/persons/{id}', 'Admin\DeliveryPersonController@destroy')->name('delivery.persons.destroy');
Route::GET('delivery/costs', 'Admin\DeliveryCostController@index')->name('delivery.costs');
Route::POST('delivery/costs', 'Admin\DeliveryCostController@store')->name('delivery.cost.store');
Route::PUT('delivery/costs/{id}', 'Admin\DeliveryCostController@update')->name('delivery.cost.update');
Route::DELETE('delivery/costs/{id}', 'Admin\DeliveryCostController@destroy')->name('delivery.cost.destroy');
Route::get('delivery/orders', 'Admin\DeliveryController@orders')->name('delivery.orders');
Route::get('delivery/cod', 'Admin\DeliveryController@cod')->name('delivery.cod');

//Promotion Managment//

// Route::resource('promotion', 'Admin\PromotionController');
Route::GET('promotion','Admin\PromotionController@index')->name('promotion.index');
Route::POST('promotion','Admin\PromotionController@store')->name('promotion.store');
Route::PUT('promotion/{id}','Admin\PromotionController@update')->name('promotion.update');
Route::DELETE('promotion/{id}','Admin\PromotionController@destroy')->name('promotion.destroy');
Route::get('promotion/add-promotion', 'Admin\PromotionController@create')->name('promotion.add-promotion');
Route::get('promotion/edit-promotion/{id}', 'Admin\PromotionController@edit')->name('promotion.edit-promotion');
Route::get('sub/category/{id}', 'Admin\PromotionController@subcategory');


Route::get('barcode', 'Admin\BarcodeController@generate')->name('barcode');

//Bnak Route
Route::get('banks', 'Admin\BankController@index')->name('bank.index');
Route::POST('banks', 'Admin\BankController@store')->name('bank.store');
Route::GET('banks/edit/{id}', 'Admin\AjaxController@banks_edit');
Route::PUT('banks/update/{id}', 'Admin\BankController@update')->name('bank.update');
Route::DELETE('banks/destroy/{id}', 'Admin\BankController@destroy')->name('bank.destroy');

// sales route
Route::get('/sales', 'Admin\SalesController@index')->name('sales.index');
Route::get('sales/sale-returns', 'Admin\SalesController@sale_returns')->name('sales.sale_returns');
Route::get('sales/print-chalan', 'Admin\SalesController@print_chalan')->name('sales.print_chalan');
Route::get('sales/sales-person', 'Admin\SalesController@sales_person')->name('sales.sales_person');
Route::get('sales/sale-commission', 'Admin\SalesController@sales_commission')->name('sales.sales_commission');
Route::get('sales/sale-commission/add-sales-transaction', 'Admin\SalesController@add_sales_transaction')->name('sales.add_sales_transaction');
Route::get('sales/sale-commission/edit-sales-transaction', 'Admin\SalesController@edit_sales_transaction')->name('sales.edit_sales_transaction');

//Sales Delivery
Route::POST('sales/delivery/add', 'Admin\SalesController@sales_delivery')->name('sales.delivery.add');

Route::get('customer/address/ad/{id}', 'Admin\AjaxController@cus_address');
Route::get('customer/address/ds/{id}', 'Admin\AjaxController@cus_address_ds');
Route::get('customer/address/dst/{id}', 'Admin\AjaxController@cus_address_dst');
Route::get('customer/address/dv/{id}', 'Admin\AjaxController@cus_address_dv');

// Sales Order
Route::get('sales/add-order', 'Admin\SalesOrderController@index')->name('sales.add_order');
Route::get('sales/add-order/add', 'Admin\SalesOrderController@create')->name('sales.add');
Route::post('sales/add-order/add', 'Admin\SalesOrderController@store')->name('sales.order.store');

Route::get('order/add/product/{id}', 'Admin\AjaxController@order_add_product');
Route::get('order/add/account/type/{id}', 'Admin\AjaxController@account_type');


// Sales Person
Route::resource('sales/person', 'Admin\SalesPersonController');

// Card Type
Route::get('account-settings/card-type', 'Admin\AccountSettingController@card_type')->name('account_settings.card_type');

// account setting
Route::get('account-settings/accounts', 'Admin\AccountSettingController@account')->name('account_settings.account');
Route::get('account-settings/accounts/create', 'Admin\AccountSettingController@create')->name('account.create');
Route::POST('account-settings/accounts', 'Admin\AccountSettingController@store')->name('account.store');
Route::get('account-settings/accounts/edit/{id}', 'Admin\AccountSettingController@edit')->name('account.edit');
Route::PUT('account-settings/accounts/update/{id}', 'Admin\AccountSettingController@update')->name('account.update');

// Transaction Categories
Route::GET('account-settings/categories', 'Admin\TransactionCategoryController@categories')->name('account_settings.categories');
Route::GET('transaction/categories/edit/{id}', 'Admin\AjaxController@cats_edit');
Route::POST('transaction/categories', 'Admin\TransactionCategoryController@categories_store')->name('transaction.category.store');
Route::PUT('transaction/categories/{id}', 'Admin\TransactionCategoryController@categories_update');
Route::DELETE('transaction/categories/destroy/{id}', 'Admin\TransactionCategoryController@categories_destroy')->name('transaction.category.destroy');

// account management
Route::get('account-management/transactions', 'Admin\AccountManagementController@transactions')->name('account_management.transactions');
Route::get('account-management/fund-transfer', 'Admin\AccountManagementController@fund_transfer')->name('account_management.fund_transfer');
Route::get('account-management/transaction-invoices', 'Admin\AccountManagementController@transaction_invoices')->name('account_management.transaction_invoices');

// account management transactions
Route::get('account-management/transactions/add-customer-transaction', 'Admin\AccountManagementController@add_customer_transaction')->name('account_management.add_customer_transaction');
Route::get('account-management/transactions/edit-customer-transaction', 'Admin\AccountManagementController@edit_customer_transaction')->name('account_management.edit_customer_transaction');
Route::get('account-management/transactions/add-supplier-transaction', 'Admin\AccountManagementController@add_supplier_transaction')->name('account_management.add_supplier_transaction');
Route::get('account-management/transactions/edit-supplier-transaction', 'Admin\AccountManagementController@edit_supplier_transaction')->name('account_management.edit_supplier_transaction');
Route::get('account-management/transactions/add-office-transaction', 'Admin\AccountManagementController@add_office_transaction')->name('account_management.add_office_transaction');
Route::get('account-management/transactions/edit-office-transaction', 'Admin\AccountManagementController@edit_office_transaction')->name('account_management.edit_office_transaction');
Route::get('account-management/transactions/add-employee-transaction', 'Admin\AccountManagementController@add_employee_transaction')->name('account_management.add_employee_transaction');
Route::get('account-management/transactions/edit-employee-transaction', 'Admin\AccountManagementController@edit_employee_transaction')->name('account_management.edit_employee_transaction');
Route::get('account-management/transactions/add-investor-transaction', 'Admin\AccountManagementController@add_investor_transaction')->name('account_management.add_investor_transaction');
Route::get('account-management/transactions/edit-investor-transaction', 'Admin\AccountManagementController@edit_investor_transaction')->name('account_management.edit_investor_transaction');

//Supplier Return
Route::GET('supplier-return/index','Admin\SupplierReturnController@index')->name('supplier_return.index');
Route::GET('supplier-return/create','Admin\SupplierReturnController@create')->name('supplier_return.create');
Route::GET('supplier-return/show','Admin\SupplierReturnController@show')->name('supplier_return.show');
Route::POST('supplier-return/store','Admin\SupplierReturnController@store')->name('supplier_return.store');
Route::GET('supplier-return/edit/{id}','Admin\SupplierReturnController@edit')->name('supplier_return.edit');
Route::PUT('supplier-return/update/{id}','Admin\SupplierReturnController@update')->name('supplier_return.update');
Route::DELETE('supplier-return/destroy/{id}','Admin\SupplierReturnController@destroy')->name('supplier_return.destroy');


Route::GET('supplier/purchase/{id}', 'Admin\AjaxController@store_Stock');
Route::GET('purchase/purchase_item/{id}', 'Admin\AjaxController@purchase_item');
Route::GET('agent/person/{id}', 'Admin\AjaxController@agent_person');
Route::GET('agent/person/service/{id}', 'Admin\AjaxController@agent_person_service');
Route::GET('agent/person/ranges/{id}', 'Admin\AjaxController@agent_person_ranges');
Route::GET('agent/person/service/charge/{id}', 'Admin\AjaxController@service_charge');

Route::GET('product/search/onkeyup', 'Admin\AjaxController@fetch_products');
Route::GET('product/search/cart/{id}', 'Admin\AjaxController@cart_product');
Route::GET('customer/commission/{id}', 'Admin\AjaxController@customerCommission');








// });