<?php
Route::group(['middleware' => 'auth:admin','namespace'=>'report'], function()
{
//sales report	
Route::get('/daily-sales-report','SalesReportController@dailySalesReport')->name('admin.report.dailySalesReport');
Route::post('/date-wise-sales-report','SalesReportController@sateWiseSalesReport')->name('admin.report.sateWiseSalesReport');
Route::post('/sales-report-between-two-date','SalesReportController@salesBetweenTwoDate')->name('admin.report.salesBetweenTwoDate');
//purchase report
Route::get('/daily-Purchase-report','PurchaseReportController@dailyPurchaseReport')->name('admin.report.dailyPurchaseReport');
Route::post('/date-wise-purchase-report','PurchaseReportController@dateWisePurchaseReport')->name('admin.report.dateWisePurchaseReport');
Route::post('/purchase-between-two-date','PurchaseReportController@purchaseBetweenTwoDate')->name('admin.report.purchaseBetweenTwoDate');

//payment report
Route::get('/payment-report','PaymentReportController@paymentReport')->name('admin.report.paymentReport');
Route::post('/date-wise-payment-report','PaymentReportController@dateWisePaymentReport')->name('admin.report.dateWisePaymentReport');
Route::post('/payment-report-betweenTwo-date','PaymentReportController@paymentBetweenTwoDate')->name('admin.report.paymentBetweenTwoDate');
//customer report
Route::get('/customer-report','CustomerReportController@customerReport')->name('admin.report.customerReport');
Route::post('customer-search-report','CustomerReportController@searchCustomer')->name('admin.report.searchCustomer');
//expense report 
Route::get('/expense-report','ExpenseReportController@expenseReport')->name('admin.report.expenseReport');
Route::post('/date-wise-expense-report','ExpenseReportController@dateWiseExpenseReport')->name('admin.report.dateWiseExpenseReport');
Route::post('/expense between-two-date','ExpenseReportController@expenseBetweenTwoDate')->name('admin.report.expenseBetweenTwoDate');

//product report 
Route::get('/product-report','ProductReportController@productReport')->name('admin.report.productReport');
});