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
<div class="col-sm-12 col-md-12">

<div class="user-left">
            <table class="table table-condensed table-hover">
            <thead>
            <tr>
            <th colspan="3">Music Genre Details</th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td>Genre Name :</td>
            <td class="left" align="left">          
            <?php echo $data['genre']['name']; ?>
            </td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>Slag :</td>
            <td><?php echo $data['genre']['genre_slug']; ?>
            </td>
            <td>&nbsp;</td>
            </tr>
            <tr>
            <td>Hidden Status :</td>
            <td><?php if($data['genre']['is_hidden'] ==0 ) { ?><span class="badge badge-danger">No</span><?php } else { ?> <span class="badge badge-success">Yes</span><?php } ?></td>
            <td>&nbsp;</td>
            </tr>
            
            <tr>
            <td>Visible Status :</td>
            <td><?php if($data['genre']['is_visible'] ==0 ) { ?><span class="badge badge-danger">No</span><?php } else { ?> <span class="badge badge-success">Yes</span><?php } ?></td>
            <td>&nbsp;</td>
            </tr>
            
            <tr>
            <td>Banner Image :</td>
            <td><img src="<?php echo url(); ?>/uploaded/genre/thumb/<?php echo $data['genre']['banner_img'];  ?>" border="0"  width="140" ></td>
            <td>&nbsp;</td>
            </tr>

            <tr>
            <td>Background Image :</td>
            <td><img src="<?php echo url(); ?>/uploaded/genre/thumb/<?php echo $data['genre']['background_img'];  ?>" border="0"  width="140" ></td>
            <td>&nbsp;</td>
            </tr>   
            
            <tr>
            <td>Icon Image :</td>
            <td><img src="<?php echo url(); ?>/uploaded/genre/thumb/<?php echo $data['genre']['icon_img'];  ?>" border="0"  width="140" ></td>
            <td>&nbsp;</td>
            </tr>               
            

            
            
    
        
            </tbody>
            </table>
            
        
            
            
        
            
            


</div>


</div>


</div>  


    <fieldset>
    <legend>&nbsp;</legend>
    <div class="row">
        <div class="col-sm-12">                                     
        <a href="/admin/genre" class="btn btn-orange" name="submit" value="add-user-form">Back</a>                          
        </div>
    </div>
    <div class="row"><div class="col-sm-2 col-sm-offset-2">&nbsp;</div> </div>
        
    </fieldset>                 
                     
       
                </div> 
@stop
@include('admin.genre.partials._relatedfiles')