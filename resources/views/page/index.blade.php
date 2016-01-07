@extends('app')

@section('content')

<!-- inner page area start -->
<div class="innrPgArea login">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        
        <!-- form box open -->
        <div class="formBox">
          <h3>	{!! $page->title !!}</h3>
			@if (count($errors) > 0)
				<div class="row">
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				</div>	
			@endif		  
		  
		  
		  
		  
          <div class="row">
          <!-- left part open-->
            <div class="col-md-12 col-sm-12 col-xs-12 loginColumn">
			{!! $page->content !!}
            </div>
            <!-- left part closed -->
            
            <!-- right part open -->

          </div>
          
          
        </div>
        <!-- form box closed --> 
 
        
         </div>
    </div>
  </div>
</div>
<!-- inner page area closed -->










@endsection
