 @extends('admin.layout')

@section('content')
                <div class="container">
                    <!-- start: PAGE HEADER -->
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: PAGE TITLE & BREADCRUMB -->
                            <ol class="breadcrumb">
                                <li>
                                    <i class="clip-home-3"></i>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                    Masters - Music Category
                                </li> 
                            </ol>
                            <div class="page-header">
                                <h1>Music Category Management<small> Manage core config data</small>
                                    <a href="<?php echo url(); ?>/admin/category" class="btn btn-primary custom-button pull-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
                                    <span style="margin-left:-20px;">Category Details</span> 
                                </div>
 

                                <div class="panel-body"> 
                                        
                                <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1"> 
                                    <tbody>
                                
                                        <tr>
                                            <td width="20%"><strong>Name :</strong></td> 
                                            <td width="80%"><?php echo $data['category']['name']; ?> </td>
                                        </tr>      

                                        <tr>
                                            <td width="20%"><strong>Date :</strong></td> 
                                            <td width="80%"><?php echo $data['category']['updated_at']; ?> </td>
                                        </tr>                           
                                    
                                        
                                    </tbody>
                                </table> 
                                  <button class="btn btn-primary" type="button" 
                                onClick="window.location.href='<?php echo url(); ?>/admin/category'"  ><i class="fa fa-arrow-circle-left"></i> Back </button>   
                                </div>


                            </div>
                            <!-- end: DYNAMIC TABLE PANEL -->
                        </div>
                    </div>
                    <!-- end: PAGE CONTENT-->
                </div> 
@stop
@include('admin.category.partials._relatedfiles')