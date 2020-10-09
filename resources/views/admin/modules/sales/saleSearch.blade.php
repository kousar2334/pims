@if(!$sales->isEmpty())
<?php $counter=0;?>
@foreach($sales as $sale)
<?php $counter++;?>
<tr>
	<td>{{$counter}}</td>
	<td>{{$sale->sales_date}}</td>
	<td>{{$sale->billerInfo['name']}}</td>
	<td>{{$sale->customerInfo['name']}}</td>
	<td>
	@if($sale->sales_status=='completed')
                                  <p class="badge badge-success">{{$sale->sales_status}}</p>
                                  @else
                                  <p class="badge badge-danger">{{$sale->sales_status}}</p>
                                  @endif
                              </td>
	<td style="text-align: right;">{{number_format($sale->grand_total)}}</td>

	<td style="text-align: right;">{{number_format($sale->paid_amount)}}</td>
	<td style="text-align: right;">{{number_format($sale->due)}}</td>

	<td style="text-align: center;">
		@if($sale->due==0)
		<p class="badge badge-success">Paid</p>
		@else
		<p class="badge badge-danger">Due</p>
		@endif

	</td>
	<td style="width:120px;" >
		<p class="btn btn-success p-1 px-2 mb-0 vSale" data-sales_id="{{$sale->id}}"style="font-size: 13px;cursor:pointer;" title="Sales Details"> <i class="fa-fw fa fa-eye"></i></p>
		
<a href="{{route('admin.salesReturn',$sale->id)}}"><p class="btn btn-info p-1 px-2 mb-0" style="font-size: 13px;cursor:pointer;" title="Sales Return"> <i class="fa fa-undo"></i></p></a>
		<div class="del-modal <?php echo 'modal'.$counter?>">
			<p><b>Record delete confirmation.</b></p>
			<p>Are you want to really delete ?</p>

			<button class="btn btn-info py-1 del-close" style="background-color: #808080a6;border-color: #808080a6;">Cancel</button>
			<form method="post"  action="{{route('admin.sales.deleteSale')}}"style="float:right;">
				@csrf
				<input type="hidden" name="id" value="{{$sale->id}}">
				<button class="btn btn-danger py-1">Confirm</button>
			</form>
		</div>
		<script>
			$(document).ready(function(){
				$(".<?php echo 'btn'.$counter?>").click(function(){
					$(".<?php echo 'modal'.$counter?>").show('fadeOut');

				});
				$(".del-close").click(function(){
					$(".del-modal").hide('fadeIn');

				});
			});
		</script>
		<p class="btn btn-danger mb-0 p-1 px-2 del-btn <?php echo 'btn'.$counter?>" data-store_id="{{$sale->id}}" style="font-size: 13px;relative;cursor:pointer;" title="Delete Sale"> <i class="fa fa-trash"></i></p>
	</td>

</tr>
@endforeach
@else
<p>No result found</p>
@endif
<script>
	$(document).ready(function(){
		$(".vSale").click(function(){
			var saleId=$(this).data('sales_id');
			viewSale(saleId);
		});

		function viewSale(code)
		{
       	//ajax
       	$.ajax({
       		headers: {
       			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       		},
       		url:"{{route('admin.sales.salesDetails')}}",
       		type:"POST",
       		data:{'saleId':code},
		        //dataType:'json',
		        success:function(data){
		        	$(".modal-data").html(data);
		        	$('.saleInfoModal').modal('show'); 
		        },
		        error:function(){
		        	toastr.error("Something went Wrong, Please Try again.");
		        }
		    });

		  //end ajax
       }
       
   });
</script>
