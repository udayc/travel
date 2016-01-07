@extends('app')

@section('content')
 
<link rel="stylesheet" href="<?php echo url(); ?>/plugins/select2/select2.css">
  

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
                                    Users - Send Email to Users
                                </li> 
                            </ol>


                            <div class="page-header">
                                <h1>Email to users</h1>
                                <div class="clearfix"></div>
                            </div>


                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <!-- end: PAGE HEADER -->
                    <!-- start: PAGE CONTENT -->

            @include('admin.partials._flashmsg')     
                     
           <div class="row">
                        <div class="col-md-12">
                            <!-- start: DYNAMIC TABLE PANEL -->
                            <div class="panel panel-default">
                                <div class="panel-heading"> 
                                    <span style="margin-left:-20px;">Email</span> 
                                </div>

                                <div>
                                    @foreach($errors->all() as $error)
                                    <div class="col-md-12 customError">
                                        <div class="alert alert-danger" ><i class="fa fa-times-circle"></i>&nbsp;{{ $error }}<button class="close" data-dismiss="alert">×</button></div></div> 
                                    @endforeach
                                </div> 


                                <div class="panel-body"> 
                                  
{!! Form::open(['url' => 'admin/user/sendemail', 'method' => 'post', 'name' => 'form8', 'id' => 'form8'  ]) !!}  


                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="errorHandler alert alert-danger no-display">
                                                    <i class="fa fa-times-sign"></i> You have some form errors. Please check below.
                                                </div>
                                                <div class="successHandler alert alert-success no-display">
                                                    <i class="fa fa-ok"></i> Your form validation is successful!
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Bulk Mail Option <span class="symbol required"></span>
                                                    </label>
                                                    <div class="input select">
                                                        <select id="bulkmailopt" class="form-control" name="bulkmailopt"  >
                                                        <option value=""> -- Select -- </option>
                                                        <option value="1">All Users</option>
                                                        <option value="2">Inactive Users</option>
                                                        <option value="3">Active Users</option>
                                                        </select>
                                                    </div> 
                                                </div>  
                                            </div>  
                                      
                                        </div>

 
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                    Send To <span class="symbol required"></span>
                                                    </label> 


                                                    <div class="input select" id="alllist"> 
                                                        <select multiple="multiple" id="form-field-select-4" class="form-control search-select" name="selectedemails[]" placeholder="Select email" >
                                                        <?php
                                                        if(is_array($allarr) && count($allarr)>0) 
                                                        { 
                                                            foreach($allarr as $kyy=>$allval)
                                                            { 
                                                        ?>
                                                            <option value="<?php echo $allval['email']; ?>"><?php echo $allval['email']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select> 
                                                    </div> 


                                                <div class="input select" id="activelist" style="display:none;" > 
                                                        <select multiple="multiple" id="form-field-select-4" class="form-control search-select" name="selectedemails[]" placeholder="Select email" >
                                                        <?php
                                                        if(is_array($activearr) && count($activearr)>0) 
                                                        { 
                                                            foreach($activearr as $kyy=>$aactval)
                                                            { 
                                                        ?>
                                                            <option value="<?php echo $aactval['email']; ?>"><?php echo $aactval['email']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select> 
                                                    </div> 


                                              <div class="input select" id="inactivelist"  style="display:none;"  > 
                                                        <select multiple="multiple" id="form-field-select-4" class="form-control search-select" name="selectedemails[]" placeholder="Select email" >
                                                        <?php
                                                        if(is_array($inactivearr) && count($inactivearr)>0) 
                                                        { 
                                                            foreach($inactivearr as $kyy=>$inactval)
                                                            { 
                                                        ?>
                                                            <option value="<?php echo $inactval['email']; ?>"><?php echo $inactval['email']; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select> 
                                                    </div> 


                                                </div>  
                                            </div>   
                                        </div>



                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Subject <span class="symbol required"></span>
                                                    </label>
                                                    <input type="text" placeholder="Subject" class="form-control" id="emailsubject" name="emailsubject">
                                                </div>  
                                            </div>  
                                        </div>


                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">
                                                        Message <span class="symbol required"></span>
                                                    </label>
                                                    <textarea id="usrmsg" style="width:630px; height:250px;" name="usrmsg"></textarea>
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
@include('admin.user.partials._relatedfiles')