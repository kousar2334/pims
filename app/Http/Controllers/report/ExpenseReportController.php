<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use DB;

class ExpenseReportController extends Controller
{
    //expenseReport
    public function expenseReport()
    {
    	$totalExpense=DB::table('expenses')->sum('cost');
     $expenses=Expense::paginate(10);
    return view('admin.modules.report.expenseReport')->with(['expenses'=>$expenses,'totalExpense'=>$totalExpense]);
    }
    //dateWiseExpenseReport
    public function dateWiseExpenseReport(Request $request)
    {
    $eDate=$request->eDate;
    $totalExpense=DB::table('expenses')->where('eDate',$eDate)->sum('cost');
    $expenses=Expense::where('eDate',$eDate)->get();

    return view('admin.modules.report.dateWiseExpenseReport')->with(['expenses'=>$expenses,'totalExpense'=>$totalExpense,'eDate'=>$eDate]);
    }
    //expenseBetweenTwoDate
    public function expenseBetweenTwoDate(Request $request)
    {
     $startDate=$request->startDate;
     $endDate=$request->endDate;
     $totalExpense=DB::table('expenses')->whereBetween('eDate',[$startDate, $endDate])->sum('cost');
     $expenses=Expense::whereBetween('eDate',[$startDate, $endDate])->get();
     return view('admin.modules.report.expenseBetweenTwoDate')->with(['expenses'=>$expenses,'totalExpense'=>$totalExpense,'startDate'=>$startDate,'endDate'=>$endDate]);
    }
}
