@extends('app')

@section('content')


<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">




	<div class="row">	
	<div class="col-md-12">
	<h3>Payment	</h3> 

	
		<form action="/checkout/newpayments" method="post" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<table width="50%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td>Enetr Amount</td>
					<td>:</td>
					<td><input type="text" name="amount" value="" /></td>
				</tr>
				
				<tr>
					<td colspan="3"><input type="submit" name="submit" value="Pay" /></td>
				</tr>				
			</table>
		 </form>
	
	
	</div>
	</div>

</div>
</div>
<!-- inner page area closed --> 



@endsection




@section('styles')	
@endsection

@section('scripts')
@stop