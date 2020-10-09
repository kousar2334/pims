					
					<div class="row">
						<div class="offset-md-4 col-4 p-3" id="purchaseReport">
							<center>
								<h2>Expense Report</h2>
								<p>Expense Date: {{$eDate}}</p>
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