@extends('admin.layouts.adminmaster')
@section('adminTitle')
Expense report- Admin Dashboard
@stop
@section('adminContent')
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
	p{
		margin-bottom:0px;
	}

</style>
<div class="col-md-12 mt-5 pt-3 border-bottom">
	<div class="text-dark px-0" >
		<p class="mb-1"><a href="{{route('admin.dashboard')}}"><i class="fa fa-home"></i> Dashboard / </a><a href="" class="active-slink">Expense</a> <span class="top-date"></p>

	</div>
</div>


<div class="container-fluid p-3">
	<div class="box">
		<div class="box-header">
			<div class="box-icon-left border-right" style="height:100%">
				
				

				<p class="btn mt-0 task-icon"><i class="fa fa-star"></i></p>
				
			</div>
			<h2 class="blue task-label">Expense  Report</h2>

			<div class="box-icon border-left" style="height:100%">
				<div class="dropdown mt-0">
                    <p class="task-btn" title="Print Report" onclick="printContent('purchaseReport')">
						<i class="fa fa-print"></i>
					</p>
				</div>
			</div>
		</div>
		<div class="box-content pt-0">
			<div class="row">
				<div class="col-lg-12">
					<div class="col-12 mt-1 px-0 py-1" style="border-bottom: 1px solid #dee2e6">
							<label>Select date</label>
							<input type="date" class="mx-0" id="purchaseDate">

							<label class="offset-4">Start date</label>
							<input type="date" class="mx-0" id="startDate">
							<label class="ml-5">End date</label>
							<input type="date" class="mx-0" id="endDate">
						</div>
					
				</div>
				<div class="col-lg-12" id="reportArea">
					
					<div class="row">
						<div class="offset-md-4 col-4 p-3" id="purchaseReport">
							<center>
								<h2>Expense Report</h2>
								
                             <table class="table">
								<tr>
									<td class="px-2">Total Expense</td>
									<td style="text-align: right;"><b>{{number_format($totalExpense,2)}}৳</b></td>
								</tr>
								
							</table>
							</center>
							
						</div>
					</div>
					<table class="table table-bordered table-hover">
						<thead class="blue-table-head">
							<tr>
								<th class="font-weight-bold" scope="col">#</th>
								<th class="font-weight-bold" scope="col">Reference No</th>
								<th class="font-weight-bold" scope="col">Category</th>
								<th class="font-weight-bold" scope="col">Amount</th>
								<th class="font-weight-bold" scope="col">Note</th>
								<th class="font-weight-bold" scope="col">Date</th>
								<th class="font-weight-bold" scope="col">Added By</th>
								
							</tr>
						</thead>
						<tbody>
							<?php $counter=0;?>
							@foreach($expenses as $expense)
							<?php $counter++;?>
							<tr>
								<td>{{$counter}}</td>
								<td>{{$expense->reference}}</td>
								<td>{{$expense->categoryInfo['name']}}</td>
								<td>{{number_format($expense->cost)}}</td>
								<td>{{$expense->note}}</td>
								<td>{{$expense->eDate}}</td>
								<td>{{$expense->adminInfo['first_name']}}</td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- Modal -->
<div class="modal fade purchase_details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3 modal-data">

		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#purchaseDate").on('change',function(){
			var eDate=$(this).val();
			
			//ajax
       	$.ajax({
       		headers: {
       			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       		},
       		url:"{{route('admin.report.dateWiseExpenseReport')}}",
       		type:"POST",
       		data:{'eDate':eDate},
		        //dataType:'json',
		        success:function(data){
		        	
		           $("#reportArea").html(data);
		        },
		        error:function(){
		        	toastr.error("Something went Wrong, Please Try again.");
		        }
		    });

		  //end ajax
			
		});

		
       $("#endDate").on('change',function(){
       	var endDate=$(this).val();
       	var startDate=$("#startDate").val();
       	if(startDate==''){
       		toastr.error('Select Start date');
       	}else{
       		$.ajax({
      			headers: {
      				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      			},
      			url:"{{route('admin.report.expenseBetweenTwoDate')}}",
      			type:"POST",
      			data:{'endDate':endDate,'startDate':startDate},
		        //dataType:'json',
		        success:function(data){
		        	 $("#reportArea").html(data);
		        },
		        error:function(){
		         toastr.error("Something went Wrong, Please Try again.");
		     }
		 });
       	}
	});
      
   });
</script>
@stop

