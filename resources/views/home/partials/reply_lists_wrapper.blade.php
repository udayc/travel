

					
	<table class="table table-bordered table-hover" id="sample-table-1">

		<tbody>
		@if( count($myInboxLists)  > 0 )
		@foreach($myInboxLists as $val)						
		<tr>
		<td class="center">{{ $val->content }} </td>
		<td>{{ $val->created_at}}</td>
		</tr>
		@endforeach
		@else
		<tr><td colspan="4">No result found !</td></tr>
		@endif
		</tbody>
	</table>

			
