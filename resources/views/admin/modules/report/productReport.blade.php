@extends('admin.layouts.adminmaster')
@section('adminTitle')
Product Report- Admin Dashboard
@stop
@section('adminContent')
<?php 
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\report\ProductReportController;


?>
<style>
	input[type=text]:focus {
		border-color: inherit;
		-webkit-box-shadow: none;
		box-shadow: none;
		height:28px;
		font-size: inherit;
		border-color: rgba(229, 103, 23, 0.8);
		outline-color: gray;
		font-size: 15px;
		text-transform: none;

	}
	.table td{
		padding-bottom: 0px;
		vertical-align: middle;
	}

</style>
<div class="col-md-12 mt-5 pt-3 border-bottom">
	<div class="text-dark px-0" >
		<p class="mb-1"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Dashboard / </a><a href="" class="active-slink">Product Report</a> <span class="top-date">Total Products: {{$products->total()}}</span></p>

	</div>
</div>

<div class="container-fluid p-3">
	<div class="box">
		<div class="box-header">
			<div class="box-icon-left border-right" style="height:100%">
				<p class="btn mt-0 task-icon"><i class="fa fa-barcode"></i></p>
			</div>
			<h2 class="blue task-label">Product Report</h2>

			<div class="box-icon border-left" style="height:100%">
				<div class="dropdown mt-0">
					

					
					<p class="task-btn" title="Actions">
						<i class="fa fa-th-list"></i>
					</button>
					<div class="task-menu p-2">
						
                        <a href="{{route('admin.product.export.excel')}}" class="dropdown-item pl-1" type="button">
							<i class="fa fa-file-excel"></i> Export Excel
						</a>
						<a class="dropdown-item pl-1" type="button">
							<i class="fa fa-file-pdf"></i> Export PDF
						</a>
					</div>
					
				</div>
			</div>
		</div>
		<div class="box-content">
			<div class="row">
				<div class="col-lg-12">
					<p class="introtext mb-0">Please use the table below to navigate or filter the results. You can download the table as excel and pdf.</p>
					<div class="row">
						@if(Session::has('error-message'))
						<p class="alert alert-danger">{{Session::get('error-message')}}</p>
						@endif
						<div class="col-8">
							<p class="pt-2 mb-0">Showing {{$products->count()}} of {{$products->total()}}</p>
						</div>
						<div class="col-4 mt-1">
							<input type="text" class="col-10 m-1 mx-0" id="searchKey" style="float: right;" placeholder="Search product by name or code ">
							<div id="search_list" class="col-10 px-0" style="position: absolute; margin-top: 35px;float: right;right:0px;z-index: 1;background: white;box-shadow: 0 0 15px 1px #dee2e6;display: none;">
								
							</div>
						</div>
					</div>
					<table class="table table-bordered table-hover">
						<thead class="blue-table-head">
							<tr>
								<th class="font-weight-bold text-center" scope="col">#</th>
								
								<th class="font-weight-bold text-center" scope="col">Name</th>
								<th class="font-weight-bold text-center" scope="col">Code</th>
								
								<th class="font-weight-bold text-center" scope="col">Purchased</th>
								<th class="font-weight-bold text-center" scope="col">Sold</th>
								<th class="font-weight-bold text-center" scope="col">Profit / Loss</th>
								<th class="font-weight-bold text-center" scope="col">Stock</th>
								

							</tr>
						</thead>
						<tbody id="table-data">
							<?php $counter=0;
                             $totalStock=0;
                             $totalStockPrice=0;
                             $totalProfit=0;
                             $purchaseQt=0;
                             $putchasePrice=0;
                             $soldQty=0;
                             $slodPrice=0;
							?>
							@foreach($products as $product)
							<?php $counter++;
							$stock=StockController::stock($product->id);
							$totalStock+=$stock;
							$totalStockPrice+=$stock*$product->purchase_price;
							$totalPurchased=ProductReportController::totalPurchased($product->id);
							$purchaseQt+=$totalPurchased;
							$totalPurchasePrice=ProductReportController::totalPurchasePrice($product->id);
							$putchasePrice+=$totalPurchasePrice;
							$totalSold=ProductReportController::totalSold($product->id);
							$soldQty+=$totalSold;
							$totalSoldPrice=ProductReportController::totalSoldPrice($product->id);
							$slodPrice+=$totalSoldPrice;
							$profitOrLoss=ProductReportController::profitOrLoss($product->id);
							$totalProfit+=$profitOrLoss;
							?>
							<tr>
								<td>{{$counter}}</td>
								<td>{{$product->name}}</td>
								<td>{{$product->code}}</td>
								<td style="text-align: right;">({{$totalPurchased}})<b>{{number_format($totalPurchasePrice,2)}}</b></td>
								<td style="text-align: right;">({{$totalSold}})<b>{{number_format($totalSoldPrice,2)}}</b></td>
								<td style="text-align: right;"><b>{{number_format($profitOrLoss,2)}}</b></td>
								<td style="text-align:right;">									
									({{$stock}})<b>{{number_format($stock*$product->purchase_price,2)}}</b>
								</td>
								
								
							</tr>
							@endforeach
							<tr>
								<th class="font-weight-bold text-center" scope="col">#</th>
								
								<th class="font-weight-bold text-center" scope="col">Name</th>
								<th class="font-weight-bold text-center" scope="col">Code</th>
								
								<th class="font-weight-bold text-right" scope="col">({{$purchaseQt}}){{number_format($putchasePrice,2)}}</th>
								<th class="font-weight-bold text-right" scope="col">({{$soldQty}}){{number_format($slodPrice,2)}}</th>
								<th class="font-weight-bold text-right" scope="col">{{number_format($totalProfit,2)}}</th>
								<th class="font-weight-bold text-right" scope="col">({{$totalStock}}){{number_format($totalStockPrice,2)}}</th>
								

							</tr>
						</tbody>
					</table>
					<br>
					{{$products->links()}}
				</div>
			</div>
		</div>
	</div>

</div>

@stop

