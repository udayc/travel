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
                                    <a href="<?php echo url(); ?>/admin/dashboard">
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                   Site Mgt - Header Menu
                                </li> 
                            </ol>
                            <div class="page-header">
                                <h1>Header Menu Management<small> Manage core config data</small></h1> 
                                    <a href="<?php echo url(); ?>/admin/menu" class="btn btn-primary custom-button pull-right"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
                                    <span style="margin-left:-20px;">Edit Menu</span> 
                                </div>

                                <div>
                                    @foreach($errors->all() as $error)
                                    <div class="col-md-12 customError">
                                        <div class="alert alert-danger" ><i class="fa fa-times-circle"></i>&nbsp;{{ $error }}<button class="close" data-dismiss="alert">×</button></div></div> 
                                    @endforeach
                                </div> 


                                <div class="panel-body"> 
                                  
 

	{!! Form::model($menu, ['url' => ['admin/menu/update', $menu->id], 'method' => 'put', 'name' => 'form5', 'id' => 'form5'  ]) !!}  
	{!! Form::hidden('id', $menu->id) !!}
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
	Name <span class="symbol required"></span>
	</label>
	<input type="text" placeholder="Menu Name" class="form-control" id="name" name="name" value="<?php echo $menu->name; ?>" >
	</div>  
	</div>   
	</div>


	<div class="row">           
	<div class="col-md-4">
	<div class="form-group">
	<label class="control-label">
	slug url key : <input name="slug" id="slug" value="<?php echo $menu->menu_slug; ?>" class="slug" style="display: none;" /><span class="slug" style="color: #3c763d; "><?php echo $menu->menu_slug; ?></span> 
	</label> 
	</div>  
	</div>    
	</div>
	
	
	<div class="row">
	<div class="col-md-4">
	<div class="form-group">
	<label class="control-label">
	Parent Menu <span class="symbol required"></span>
	</label>
	
	{!! Form::select('parent_id', 
        (['0' => 'Select Option'] + $menus), 
           (empty($menu) ? null : $menu->parent_id ) , 
            ['class' => 'form-control']) !!}
	</div>  
	</div>    
	</div>	
	
	<div class="row">
	<div class="col-md-4">

			<div class="form-group">
			
		<div>	
			<div class="checkbox">
			<label>
			<input type="hidden" name="add_to_header_menu" value="off">
			<input type="checkbox"  class="green" name="add_to_header_menu" id="add_to_header_menu"    @if( $menu->add_to_header_menu == 'on') checked @endif  >
			Add to header menu
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, title will be added to header menu.</span>
			</div>			

			<div class="checkbox">
			<label><input type="hidden" name="add_to_footer_menu" value="off">
			<input type="checkbox"  class="green" name="add_to_footer_menu" id="add_to_footer_menu"   @if( $menu->add_to_footer_menu == 'on') checked @endif >
			Add to footer link
			</label>
			<span class="help-block"><i class="fa fa-info-circle"></i> 
			By enabling this feature, title will be added to footer link.</span>
			</div>
		</div>
			
	</div>	
	</div>
	</div>	

	<div class="row">
	<div class="col-md-4">
	<div class="form-group">
	<label class="control-label">
	Add Page Link <span class="symbol required"></span>
	</label>
	
	{!! Form::select('page_id', 
        (['0' => 'Select Option'] + $pages), 
             (empty($menu) ? null : $menu->page_id ) ,  
            ['class' => 'form-control' , 'required']) !!}
	</div>  
	</div>    
	</div>		
	
	
	
	
	
	
	
	
	
	
	


	<div class="row"> 
	<div class="col-md-4">
	<div class="form-group">
	<label class="control-label">
	Weight <span class="symbol required"></span>
	</label>
	<input type="text" placeholder="Weight" class="form-control" id="weight" name="weight" value="<?php echo $menu->weight; ?>" >
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
@include('admin.menu.partials._relatedfiles')