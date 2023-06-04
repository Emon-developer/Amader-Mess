<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>SL</th>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
	@if(isset(json_decode($expense->details)[0]))
	@foreach(json_decode($expense->details) as $key => $item)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $item->name }}</td>
			<td>{{ $item->quantity }}</td>
			<td class="text-right">{{ $item->price }}</td>
		</tr>
	@endforeach
	@endif
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="text-right"><strong>Total :</strong></td>
			<td class="text-right">{{ $expense->expenses }}</td>
		</tr>
	</tfoot>
</table>