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
	<span style="margin-left:-20px;">Edit Genre</span> 
	</div>

	<div>
	@foreach($errors->all() as $error)
	<div class="col-md-12 customError">
	<div class="alert alert-danger" ><i class="fa fa-times-circle"></i>&nbsp;{{ $error }}<button class="close" data-dismiss="alert">×</button></div></div> 
	@endforeach
	</div> 


	<div class="panel-body"> 



	{!! Form::model($genre, ['url' => ['admin/genre/update', $genre->id], 'method' => 'put', 'name' => 'form3', 'id' => 'form3', 'files' => true   ]) !!}                    
 	{!! Form::hidden('id', $genre->id) !!}
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
                                                    <input type="text" placeholder="Genre Name" class="form-control" id="name" name="name" value="<?php echo $genre->name; ?>"  >
                                                </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                                    <label class="control-label" style="width:100%;">
                                                        &nbsp;
                                                    </label>
                                                    <label class="control-label" style="margin-top:5px;">
                                                        Slug : <input name="slug" id="slug" value="<?php echo $genre->genre_slug; ?>" class="slug" style="display: none;" /><span class="slug" style="color: #3c763d; "><?php echo $genre->genre_slug; ?></span>
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
                                                        <input type="checkbox" class="square-green" name="is_hidden" value="1" 
                                                        <?php if($genre->is_hidden == 1 ) { ?> checked="checked" <?php } ?>  > 
                                                    </label>
                                                </div>

                                     
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group connected-group">
                                                    <label class="control-label">
                                                        Active Status : 
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="square-green"  name="active"  value="1" <?php if($genre->active == 1 ) { ?> checked="checked" <?php } ?>   > 
                                                    </label>
                                                </div>
                                </div>
                                </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                <div class="col-md-6"> 

                                    <div id="bnruplddiv" class="form-group">
                                        <label  id="bannerclassiu" >
                                            Banner Image :
                                        </label>
                                        <div class="fileupload fileupload-new" data-provides="fileupload"> 
                                            <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/uploaded/genre/thumb/<?php echo $genre->banner_img;  ?>" border="0"  width="350" > 
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
                                            <div>
                                                <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select Banner image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
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


                                 <div id="bnruplddivr" class="form-group">
                                                    <label  id="bannerclassit" >
                                                       Background Image :
                                                    </label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload"> 
                                                        <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/uploaded/genre/thumb/<?php echo $genre->background_img;  ?>" border="0"  width="350" > 
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
                                                        <div>
                                                            <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select Background image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
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


                                 <div id="bnrulddivr" class="form-group">
                                                    <label  id="banerclassit" >
                                                       Icon Image :
                                                    </label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload"> 
                                                        <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/uploaded/genre/thumb/<?php echo $genre->icon_img;  ?>" border="0"  width="350" > 
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
                                                        <div>
                                                            <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select Icon image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                                                             <input type="file" name="icon_img" id="icon_img"  >
                                                            </span>
                                                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                                <i class="fa fa-times"></i> Remove
                                                            </a>
                                                        </div> 
                                                    </div>                                  
                                </div> 

                           
                                </div>
                             <input type="hidden"  name="oldbackgndimg" value="<?php echo $genre->background_img; ?>" >
                              <input type="hidden"  name="oldbannerimage" value="<?php echo $genre->banner_img; ?>" >
                             <input type="hidden"  name="oldiconimage" value="<?php echo $genre->icon_img; ?>" >
                            

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