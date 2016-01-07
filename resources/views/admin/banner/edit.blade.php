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
                                   Site Mgt - Header Banner
                                </li> 
                            </ol>
                            <div class="page-header">
                                <h1>Header Banner Management<small> Manage core config data</small></h1> 
                                    <a href="<?php echo url(); ?>/admin/banner" class="btn btn-primary custom-button pull-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
                                    <span style="margin-left:-20px;">Edit Banner</span> 
                                </div>

                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul> 


                                <div class="panel-body"> 
                                  
 

{!! Form::model($banner, ['url' => ['admin/banner/update', $banner->id], 'method' => 'put', 'name' => 'form7', 'id' => 'form7', 'files' => true  ]) !!}                    
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="errorHandler alert alert-danger no-display">
                                                    <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                                </div>
                                                <div class="successHandler alert alert-success no-display">
                                                    <i class="fa fa-ok"></i> Your form validation is successful!
                                                </div>
                                            </div>

                                            <div class="col-md-4">


                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Title <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" placeholder="Banner Title" class="form-control" id="banner_title" name="banner_title" value="<?php echo $banner->banner_title; ?>">
                                                </div>  

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Description <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" placeholder="Banner Description" class="form-control" id="banner_desc" name="banner_desc" value="<?php echo $banner->banner_desc; ?>" >
                                                </div>  

                                               <div class="form-group">
                                                    <label class="control-label">
                                                        Banner Link <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" placeholder="Banner link" class="form-control" id="banner_link" name="banner_link" value="<?php echo $banner->banner_link; ?>" >
                                                </div>

                                                <div id="bnruplddiv" class="form-group">
                                                    <label  id="bannerclassi" >
                                                        Image Upload <span id="bannererr" class="symbol required"></span>
                                                    </label>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload"> 
                                                        <div class="fileupload-new thumbnail" style="width: 350px; height: 160px;"><img src="<?php echo url(); ?>/uploaded/homebanner/thumb/<?php echo $banner->banner_picture;  ?>" border="0"  width="350" > 
                                                        </div>
                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 350px; max-height: 160px; line-height: 20px;"></div> 
                                                        <div>
                                                            <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                                                             <input type="file" name="banner_picture" id="banner_picture"  >
                                                            </span>
                                                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                                                <i class="fa fa-times"></i> Remove
                                                            </a>
                                                        </div> 
                                                    </div>                                  
                                                </div>
                                                <input type="hidden" id="oldimage" name="oldimage" value="<?php echo $banner->banner_picture; ?>" >

                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Weight 
                                                    </label>
                                                    <input type="text" placeholder="weight" class="form-control" id="weight" name="weight" value="<?php echo $banner->weight; ?>" >
                                                </div>

                                            </div>  




                                      
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-4"> 
                                                <input type="submit" name="Submit" value="Submit" class="btn btn-primary btn-lg" > 
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
@include('admin.banner.partials._relatedfiles')