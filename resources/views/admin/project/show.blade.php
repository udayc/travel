@extends('admin.layout')

@section('content')
<!-- Start: PAGE CONTENT-->
<div class="container">
<!-- start: PAGE HEADER --> 
@include('admin.project.partials._pageheaderother' , ['settings_form' => 'Project Details'  ]) 
<!-- end: PAGE HEADER -->
					
<!-- Start .flash-message -->	
@include('admin.partials._flashmsg')
<!-- end .flash-message -->




<div class="row">
<div class="col-sm-6 col-md-6">

<div class="user-left">
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Basic</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>posted:</td>
			<td>
			<a href="#">
			{{ $project->user()->first()->name }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>name:</td>
			<td>
			<a href="">
			{{ $project->name }}
			</a></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>category:</td>
			<td>{{ $project->category->name or null}}</td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td valign="top">short note</td>
			<td>
			<p>
			{{ $project->short_description }}
			</p></td>
			<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Attached Image</td>
			<td>
		
			<img src="/images/file-attached-to-project/resize/{{$project->file_attachment}} " />
			</td>
			<td>&nbsp;</td>
			</tr>			
			</tbody>
			</table>
			
			
			
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Funding Details</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>payment method</td>
			<td>
			<a href="#">
				{{ $project->payment_method }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>funding goal($):</td>
			<td>
			<a href="">
			{{ $project->funding_goal }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>allowe overfunding:</td>
			<td>{{ $project->allow_overfunding }}</td>
			<td></td>
			</tr>
			<tr>
			<td>Project funding end date:</td>
			<td>{{ $project->funding_end_date }}</td>
			<td></td>
			</tr>			
			

			</tbody>
			</table>			
			
			
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Websites</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>linkedIn_url:</td>
			<td>
			<a href="#">
			{{ $project->linkedIn_url  }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>twitter_url:</td>
			<td>
			<a href="">
			{{ $project->twitter_url }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>myspace_url:</td>
			<td>{{ $project->myspace_url  }}</td>
			<td></td>
			</tr>
			<tr>
			<td>homepage_url:</td>
			<td>
			<a href="">
			{{ $project->homepage_url or Null }}
			</a></td>
			<td></td>
			</tr>
			
			<tr>
			<td>facebook_url:</td>
			<td>
			<a href="">
			{{ $project->facebook_url }}
			</a></td>
			<td></td>
			</tr>			
			
			
			<tr>
			<td>imdb_url:</td>
			<td>
			<a href="">
			{{ $project->imdb_url  }}
			</a></td>
			<td></td>
			</tr>

			<tr>
			<td>google_plus_url:</td>
			<td>
			<a href="">
			{{ $project->google_plus_url  }}
			</a></td>
			<td></td>
			</tr>



			
			
			
			
			</tbody>
			</table>			
			
			


</div>


</div>

<div class="col-sm-6 col-md-6">


			<p>{!! $project->details_description !!}</p>


			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Details Address/Info</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>Address</td>
			<td>
			<a href="#">
			{{ $project->address }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>city:</td>
			<td>
			<a href="">
			{{ $project->cityById($project->city) }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>state:</td>
			<td>{{ $project->state }}</td>
			<td></td>
			</tr>
			<tr>
			<td>Country</td>
			<td>
			<a href="">
			{{ $project->country_id or null}}
			</a></td>
			<td></td>
			</tr>
			
			<tr>
			<td>pincode</td>
			<td>
			<a href="">
			{{ $project->pincode }}
			</a></td>
			<td></td>
			</tr>			
			
			
			
			
			</tbody>
			</table>
			
			
			<table class="table table-condensed table-hover">
			<thead>
			<tr>
			<th colspan="3">Other Info</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td>feed_url</td>
			<td>
			<a href="#">
			{{ $project->feed_url }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>external_video_url:</td>
			<td>
			<a href="">
			{{ $project->external_video_url }}
			</a></td>
			<td></td>
			</tr>
			<tr>
			<td>media_file_attachment:</td>
			<td>{{ $project->media_file_attachment }}</td>
			<td></td>
			</tr>
			<tr>
			<td>media_file_short_note</td>
			<td>
			<a href="">
			{{ $project->media_file_short_note }}
			</a></td>
			<td></td>
			</tr>
			</tbody>
			</table>			
			
			
			
				
			<table class="table table-striped table-bordered table-hover" id="projects">
			<thead>
			<tr><th colspan="4">Rewards Details</th></tr>
			<tr><th>Pledge($)</th><th>user limit</th> <th>estimated delivery</th><th>short note</th</tr>
			</thead>
			@if(count($rewards) > 0 )<tbody>
			
			@foreach($rewards as $reward)
			<tr>
			<td>{{ $reward->pledge_amount}}</td>
			<td>{{ $reward->user_limit}}</td>
			<td>{{ date("M d, Y" , strtotime($reward->estimated_delivery)) }}</td>
			<td>{{ $reward->short_note}}</td>
			</tr>
			@endforeach
			@else
			<tr><th colspan="4">No rewards has been created !</th></tr>
			@endif


			</tbody>
			</table>		
			
			








<div>



</div>

</div>
</div>	


	<fieldset>
	<legend>&nbsp;</legend>
	<div class="row">
		<div class="col-sm-12">										
		<a href="/admin/project" class="btn btn-orange" name="submit" value="add-user-form">Back</a>							
		</div>
	</div>
	<div class="row"><div class="col-sm-2 col-sm-offset-2">&nbsp;</div>	</div>
		
	</fieldset>





<!-- end: PAGE CONTENT-->
</div>

@stop

@include('admin.project.partials._relatedfiles')