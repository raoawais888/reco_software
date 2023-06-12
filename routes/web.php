<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AccounttypeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\SaleReturnController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CashonhandController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\QuatationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Reportshop2Controller;
use App\Http\Controllers\StockActivityController;
use App\Models\bill;
use App\Models\category;

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
Route::get('cache',function(){
 Artisan::call('cache:clear');
Artisan::call('optimize');
 Artisan::call('route:cache');
 Artisan::call('route:clear');
Artisan::call('view:clear');
Artisan::call('config:cache');
return "<h1>All Cache Clear</h>";




});
Route::get('/', function () {
    return view('welcome');
});
Route::Post('/', [UserController::class,'auth']);
Route::get('logout', [UserController::class,'logout']);
Route::get('dashboard', function () {
    return view('admin.dashboard');
});


// Routes Product



Route::get('product',[ProductController::class,'index']);
Route::get('add_product',[ProductController::class,'store']);
Route::get('product_remove',[ProductController::class,'product_remove']);
Route::get('edit_product',[ProductController::class,'edit_product']);
Route::get('update_product',[ProductController::class,'update_product']);




// category routes start


Route::get('category',[CategoryController::class,'index'] );
Route::post('add_category',[CategoryController::class,'add_category'] );
Route::post('edit_category',[CategoryController::class,'edit_category'] );
Route::get('update_category',[CategoryController::class,'update_category'] );
Route::post('remove_category',[CategoryController::class,'remove_category'] );




// Brand routes start
Route::get('brand',[BrandController::class,'index'] );
Route::post('add_brand',[BrandController::class,'add_brand'] );
Route::post('edit_brand',[BrandController::class,'edit_brand'] );
Route::get('update_brand',[BrandController::class,'update_brand'] );
Route::post('remove_brand',[BrandController::class,'remove_brand'] );



// category routes start
Route::get('salary',[SalaryController::class,'index'] );
Route::post('salary',[SalaryController::class,'update_salary'] );
Route::post('add_salary',[SalaryController::class,'add_salary'] );
Route::post('add_salary_show',[SalaryController::class,'add_salary_show'] );
Route::post('salary_edit',[SalaryController::class,'salary_edit'] );
// Route::get('update_salary',[SalaryController::class,'update_salary'] );
Route::get('salary_remove',[salaryController::class,'salary_remove'] );
Route::get('salary_select',[SalaryController::class,'salary_select'] );







// Entry routes start
Route::get('form',function(){

    return view('admin.form');

});

Route::get('entry',[EntryController::class,'index'] );
Route::get('add_entry',[EntryController::class,'show_add_entry'] );
Route::get('entry_category',[EntryController::class,'entry_category'] );
Route::post('add_entry',[EntryController::class,'add_entry'] );
Route::post('edit_entry',[EntryController::class,'edit_entry'] );
Route::post('update_entry',[EntryController::class,'update_entry'] );
Route::post('remove_entry',[EntryController::class,'remove_entry'] );
Route::get('check_stock',[EntryController::class,'check_stock'] );
Route::get('edit_stock_delete',[EntryController::class,'edit_stock_delete'] );



// bill routes start


Route::get('bill',[BillController::class,'index'] );
Route::post('bill',[BillController::class,'update_bill'] );
Route::post('add_bill',[BillController::class,'add_bill'] );
Route::get('add_bill',[BillController::class,'add_bill_show'] );
Route::post('bill_edit',[BillController::class,'bill_edit'] );
Route::post('update_bill',[BillController::class,'update_bill'] );
Route::post('remove_bill',[BillController::class,'remove_bill']);
Route::post('paid_bill',[BillController::class,'paid_bill']);
Route::get('update_bill_status',[BillController::class,'update_bill_status']);
Route::get('invoice_bill',[BillController::class,'invoice_genrate'])->name('invoice_bill_back');
Route::get('generate-pdf/{number}', [BillController::class, 'generatePDF']);
Route::get('bill_category',[BillController::class,'bill_category'] );
Route::get("bill_price",[BillController::class , "price"]);
// quatation routes start


Route::get('quotation',[QuatationController::class,'index'] );
Route::post('quotation',[QuatationController::class,'update_quotation'] );
Route::post('add_quotation',[QuatationController::class,'add_quotation'] );
Route::get('add_quotation',[QuatationController::class,'add_quotation_show'] );
Route::post('quotation_edit',[QuatationController::class,'quotation_edit'] );
Route::post('update_quotation',[QuatationController::class,'update_quotation'] );
Route::post('remove_quotation',[QuatationController::class,'remove_quotation']);
Route::get('invoice_quotation',[QuatationController::class,'invoice_genrate'])->name('invoice_quotation_back');





Route::get('user',[UserController::class,'index']);
Route::post('add_user',[UserController::class,'add_user']);
Route::get('edit_user',[UserController::class,'edit_user']);
Route::post('update_user',[UserController::class,'update_user']);
Route::post('remove_user',[UserController::class,'remove_user']);


// Expense Route



Route::get("expense",[ExpenseController::class,'index']);
Route::post("add_expense",[ExpenseController::class,'add_expense']);
Route::get("add_expense",[ExpenseController::class,'add_expense_show']);
Route::post("edit_expense",[ExpenseController::class,'edit_expense']);
Route::post("update_expense",[ExpenseController::class,'update_expense']);
Route::get("remove_expense",[ExpenseController::class,'remove_expense']);



// Branch Route


Route::get("branch",[BranchController::class,'index']);
Route::get("add_branch",[BranchController::class,'show']);
Route::post("add_branch",[BranchController::class,'store']);
Route::get("edit_branch",[BranchController::class,'edit_branch']);
Route::get("update_branch",[BranchController::class,'update_branch']);
Route::get("remove_branch",[BranchController::class,'remove_branch']);



// Price add Routes

Route::get("price",[PriceController::class,'index']);
Route::post("price",[PriceController::class,'update']);
Route::get("add_price",[PriceController::class,'show']);
Route::post("add_price",[PriceController::class,'store']);
Route::post("edit_price",[PriceController::class,'edit_price']);
Route::post("remove_price",[PriceController::class,'remove_price']);
Route::get('price_category',[PriceController::class,'price_category'] );

// Account Type Route


Route::get("account_type",[AccounttypeController::class,'index']);
Route::get("add_account_type",[AccounttypeController::class,'show']);
Route::post("add_account_type",[AccounttypeController::class,'store']);
Route::get("edit_account_type",[AccounttypeController::class,'edit_account_type']);
Route::get("account_type_update",[AccounttypeController::class,'account_type_update']);
Route::get("remove_account_type",[AccounttypeController::class,'remove_account_type']);



// Purchase Route Pe


Route::get('purchase',[PurchaseController::class,'index'] );
Route::post('purchase',[PurchaseController::class,'update_purchase'] );
Route::post('add_purchase',[PurchaseController::class,'add_purchase'] );
Route::get('add_purchase',[PurchaseController::class,'add_purchase_show'] );
Route::post('edit_purchase',[PurchaseController::class,'edit_purchase'] );
Route::post('update_purchase',[PurchaseController::class,'update_purchase'] );
Route::post('remove_purchase',[PurchaseController::class,'remove_purchase']);
Route::post('paid_purchase',[PurchaseController::class,'paid_purchase']);
Route::get('update_purchase_status',[PurchaseController::class,'update_purchase_status']);
Route::get('purchase_bill/{number}',[PurchaseController::class,'invoice_genrate'])->name('invoice_purchase_back');
Route::get('generate-pdf/{number}', [PurchaseController::class, 'generatePDF']);
Route::get('purchase_category',[PurchaseController::class,'purchase_category'] );


// Employee Route

Route::get('add_employee',[EmployeeController::class,'show']);
Route::post('add_employee',[EmployeeController::class,'store']);
Route::get('employee',[EmployeeController::class,'index']);
Route::post('employee',[EmployeeController::class,'update']);
Route::get('employee_remove',[EmployeeController::class,'employee_remove']);
Route::get('employee_edit',[EmployeeController::class,'employee_edit']);
// Route::post('update_employee',[EmployeeController::class,'update']);


// Account Route
Route::get('add_account',[AccountController::class,'show']);
Route::post('add_account',[AccountController::class,'store']);
Route::get('account',[AccountController::class,'index']);



// Route Attendance
Route::get('attendance',[AttendanceController::class,'index']);
Route::POST('add_attendance',[AttendanceController::class,'store']);
Route::get('view_attendance',[AttendanceController::class,'show']);


// Route Advance
Route::get('advance',[AdvanceController::class,'index']);
Route::post('add_advance',[AdvanceController::class,'store']);



// purchase Return Routes
Route::get('add_purchase_return',[PurchaseReturnController::class,'show']);
Route::post('add_purchase_return',[PurchaseReturnController::class,'store_db']);
Route::post('add_purchase_return_show',[PurchaseReturnController::class,'store']);
Route::get('purchase_return',[PurchaseReturnController::class,'index']);
Route::post('purchase_return',[PurchaseReturnController::class,'update']);
Route::post('add_purchase_return_store',[PurchaseReturnController::class,'add_purchase_return_store']);
Route::post('edit_purchase_return',[PurchaseReturnController::class,'edit']);
Route::post('remove_purchase_return',[PurchaseReturnController::class,'remove']);



// Sales Return Routes
Route::get('add_sale_return',[SaleReturnController::class,'show']);
Route::post('add_sale_return_show',[SaleReturnController::class,'store']);
Route::get('sale_return',[SaleReturnController::class,'index']);
Route::post('store_sale_return',[SaleReturnController::class,'update']);
Route::post('add_sale_return',[SaleReturnController::class,'store_sale_return']);
Route::post('remove_bill_return',[SaleReturnController::class,'remove_bill_return']);
Route::post('bill_return_edit',[SaleReturnController::class,'bill_return_edit']);
Route::get('invoice_bill_return/{number}',[SaleReturnController::class,'invoice_bill_return'])->name('invoice_bill_return');






Route::get('cash',[CashonhandController::class,'index']);
Route::post('cash',[CashonhandController::class,'store']);
Route::get('cashonhand_detail',[CashonhandController::class,'cashonhand_detail']);
Route::get('cash_edit',[CashonhandController::class,'cash_edit']);
Route::get('cash_update',[CashonhandController::class,'cash_update']);
Route::get('cash_delete',[CashonhandController::class,'cash_delete']);


// Stock Routes
// Purchase Route Pe


Route::get('stock',[StockController::class,'index'] );
Route::post('stock',[StockController::class,'update_stock'] );
Route::post('add_stock',[StockController::class,'add_stock'] );
Route::get('add_stock',[StockController::class,'add_stock_show'] );
Route::post('edit_stock',[StockController::class,'edit_stock'] );
Route::post('update_stock',[StockController::class,'update_stock'] );
Route::post('remove_stock',[StockController::class,'remove_stock']);
Route::post('paid_stock',[StockController::class,'paid_stock']);
Route::get('update_stock_status',[StockController::class,'update_stock_status']);
Route::get('stock_bill/{number}',[StockController::class,'invoice_genrate'])->name('invoice_stock_back');
Route::get('generate-pdf/{number}', [StockController::class, 'generatePDF']);
Route::get('stock_category',[StockController::class,'stock_category'] );
Route::get('stock_detail',[StockController::class,'stock_detail_show'] );
Route::get('stocke_check',[StockController::class,'stocke_check'] );
Route::get('show_ajax_stock',[StockController::class,'show_ajax_stock'] );
Route::get('out_stock',[StockController::class,'out_stock'] );
Route::get('less_stock',[StockController::class,'less_stock'] );
Route::get('all',[StockController::class,'all'] );




// Report Router


Route::get('sale',[ReportController::class,'sale_show']);
Route::post('sale',[ReportController::class,'sale_store']);
Route::get('purchase_report',[ReportController::class,'purchase_show']);
Route::post('purchase_report',[ReportController::class,'purchase_report_store']);
Route::get('profit',[ReportController::class,'profit_show']);
Route::post('profit',[ReportController::class,'profit_store']);


Route::get('today',[ReportController::class,'today']);
Route::get('week',[ReportController::class,'week']);
Route::get('month',[ReportController::class,'month']);
Route::get('year',[ReportController::class,'year']);
Route::get('purchase_today',[ReportController::class,'purchase_today']);
Route::get('purchase_week',[ReportController::class,'purchase_week']);
Route::get('purchase_month',[ReportController::class,'purchase_month']);
Route::get('purchase_year',[ReportController::class,'purchase_year']);

// Reports genrate by invoice number
Route::post('report_genrate_sale',[ReportController::class,'report_genrate_sale']);
Route::get('sale_report_view',[ReportController::class,'sale_report_view']);
Route::post('sale_report_view',[ReportController::class,'sale_report_store']);







// purchase Report  Routes start here


Route::post('purchase_report_genrate',[ReportController::class,'purchase_report_genrate']);
Route::get('purchase_report_view',[ReportController::class,'purchase_report_view']);
Route::post('purchase_report_view',[ReportController::class,'purchase_report_invoice_store']);


// Profit Routes start here

Route::post('report_genrate_profit',[ReportController::class,'profit_report']);
Route::get('today_activity',[ReportController::class,'today_activity']);
Route::post('today_activity',[ReportController::class,'today_activity_store']);
// Route::get('profit_year',[ReportController::class,'profit_year']);



// Routes  edit stock manage

Route::get('edit_stock_manage',[StockController::class, 'stock_manage']);
Route::get('update_stock_manage',[StockController::class, 'update_stock_manage']);


// Stock Activity

Route::get("stock_activity",[StockActivityController::class, 'index']);
Route::post("stock_activity",[StockActivityController::class, 'store']);
