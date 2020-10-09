<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use DB;

class ProductReportController extends Controller
{
    //productReport
    public function productReport()
    {
  $products=Products::paginate(15);

  return view('admin.modules.report.productReport')->with(['products'=>$products]);
    }

    public static function totalPurchased($id)
    {
    $start=DB::table('products')->where('id',$id)->value('start_inventory');
    $totalPurchase=DB::table('purchase_product_lists')->where('pro_id',$id)->sum('qty');
    $totalPurchase=$start+$totalPurchase;
   return $totalPurchase;
    }
    public static function totalPurchasePrice($id)
    {
    $startPrice=DB::table('products')->where('id',$id)->value('start_cost');
    $totalPurchasePrice=DB::table('purchase_product_lists')->where('pro_id',$id)->sum('subtotal');
    $totalPurchasePrice=$startPrice+$totalPurchasePrice;
   return $totalPurchasePrice;
    }

    public static function totalSold($id)
    {
    	$totalSold=DB::table('sales_products')->where('pro_id',$id)->sum('qty');
    	return $totalSold;
    }
    public static function totalSoldPrice($id)
    {
    	$totalSoldPrice=DB::table('sales_products')->where('pro_id',$id)->sum('subtotal');
    	return $totalSoldPrice;
    }
   public static function profitOrLoss($id)
    {
    	$profitOrLoss=DB::table('sales_products')->where('pro_id',$id)->sum('product_revenue');
    	return $profitOrLoss;
    }

}
