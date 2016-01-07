 @extends('admin.layout')

@section('content')

<link rel="stylesheet" href="<?php echo url(); ?>/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">

	<div class="container">
	<!-- start: PAGE HEADER -->
	<div class="row">
	<div class="col-sm-12">
	<!-- start: PAGE TITLE & BREADCRUMB -->
	<ol class="breadcrumb">
	<li>
	<i class="clip-home-3"></i>
	<a href="<?php echo url(); ?>/admin/dashboard">
	Home
	</a>
	</li>
	<li class="active">
	Masters - Music Genre
	</li> 
	</ol>
	<div class="page-header">
	<h1>Music Genre Management<small> Manage core config data</small>
	<a href="<?php echo url(); ?>/admin/genre" class="btn btn-primary custom-button pull-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
	</h1>

	<div class="clearfix"></div>
	</div>
	<!-- end: PAGE TITLE & BREADCRUMB -->
	</div>
	</div>
	<!-- end: PAGE HEADER -->
	<!-- start: PAGE CONTENT -->



	<div class="row">
	<div class="col-md-12">
	<!-- start: DYNAMIC TABLE PANEL -->
	<div class="panel panel-default">
	<div class="panel-heading"> 
	<span style="margin-left:-20px;">Add Genre</span> 
	</div>

	<div>
	@foreach($errors->all() as $error)
	<div class="col-md-12 customError">
	<div class="alert alert-danger" ><i class="fa fa-times-circle"></i>&nbsp;{{ $error }}<button class="close" data-dismiss="alert">×</button></div></div> 
	@endforeach
	</div> 


	<div class="panel-body"> 

	{!! Form::open(['url' => 'admin/genre/store', 'method' => 'post', 'name' => 'form4', 'id' => 'form4', 'files' => true  ]) !!}  
 
 <div class="row">
                                    <div class="col-md-12"> 
                                        <div class="errorHandler alert alert-danger no-display">
                                        <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                        </div> 
                                    </div>

                                <div class="row">
                                <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                                    <label class="control-label"> 
                                                        Name <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" placeholder="Genre Name" class="form-control" id="name" name="name">
                                                </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                                    <label class="control-label" style="width:100%;">
                                                        &nbsp;
                                                    </label>
                                                    <label class="control-label" style="margin-top:5px;">
                                                        Slug : <input name="slug" id="slug" value="genre-name" class="slug" style="display: none;" /><span class="slug" style="color: #3c763d; ">genre-name</span>
                                                    </label> 
                                                </div>
                                </div>
                                </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                <div class="col-md-6">

                                    <div class="form-group connected-group">
                                                    <label class="control-label">
                                                        Hidden Status :  
                                                    </label>
                                                   <label class="checkbox-inline">
                                                        <input type="checkbox" class="square-green" name="is_hidden" value="1" > 
                                                    </label>
                                                </div>

                                     
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group connected-group">
                                                    <label class="control-label">
                                                        Active Status : 
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="square-green"  name="active"  value="1" > 
                                                    </label>
                                    </div>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                <div class="col-md-6">
                                    <div id="bnruplddivs" class="form-group">
                                                    <label  id="bannerclassih" >
                                                        Banner Image :
                                                    </label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="border: none;"> 
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div> 
                                                        <div>
                                                            <span class="btn btn-light-grey btn-file upImg"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select Banner image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                                                           <input type="file" name="banner_img" id="banner_img"  >
                                                            </span>
                                                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                                <i class="fa fa-times"></i> Remove
                                                            </a>
                                                        </div> 
                                                    </div> 
                                                </div> 

                                </div>

                                 <div class="col-md-6">

                                    <div id="bnruplddivf" class="form-group">
                                                    <label  id="bannerclassio" >
                                                        Background Image :
                                                    </label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <div class="fileupload-new thumbnail" style="border: none;"> 
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div> 
                                                        <div>
                                                            <span class="btn btn-light-grey btn-file upImg"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select Background image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                                                           <input type="file" name="background_img" id="background_img"  >
                                                            </span>
                                                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                                <i class="fa fa-times"></i> Remove
                                                            </a>
                                                        </div> 
                                                    </div> 
                                                </div>
                                </div>
                                </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-12">
                                <div class="col-md-6">
                                    <div id="bnruplddivt" class="form-group">
                                                <label  id="bannerclassibr" >
                                                    Icon Image :
                                                </label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new thumbnail" style="border: none;"> 
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div> 
                                                    <div>
                                                        <span class="btn btn-light-grey btn-file upImg"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select Icon image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                                                       <input type="file" name="icon_img" id="icon_img"  >
                                                        </span>
                                                        <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                            <i class="fa fa-times"></i> Remove
                                                        </a>
                                                    </div> 
                                                </div> 
                                            </div> 
                                </div>
                                <div class="col-md-6">

                                </div>
                                </div>
                                </div>
 
 

                                        <div class="row"> 
                                        <div class="col-md-12">
                                            <div class="col-md-4"> 
                                                <input type="submit" name="Submit" value="Submit" class="btn btn-primary btn-lg" > 
                                            </div>
                                            </div>
                                        </div>  
                                </div>

	{!! Form::close() !!}
	</div>


	</div>
	<!-- end: DYNAMIC TABLE PANEL -->
	</div>
	</div>
	<!-- end: PAGE CONTENT-->
	</div> 
@stop
@include('admin.genre.partials._relatedfiles')