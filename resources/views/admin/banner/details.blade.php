<div id="responsive"   tabindex="-1" data-width="760"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Banner Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <table class="table table-striped table-bordered table-hover table-full-width" id="sample_1"> 
                                    <tbody>
                                
                                        <tr>
                                            <td width="30%"><strong>Title :</strong></td> 
                                            <td width="70%"><?php echo $data['banner']['banner_title']; ?></td>
                                        </tr>        
                                        <tr>
                                            <td width="30%"><strong>Description :</strong></td> 
                                            <td width="70%"><?php echo $data['banner']['banner_desc']; ?></td>
                                        </tr> 
                                        <tr>
                                            <td width="30%"><strong>Banner Link :</strong></td> 
                                            <td width="70%"><?php echo $data['banner']['banner_link']; ?></td>
                                        </tr> 
                                        <tr>
                                            <td width="30%"><strong>Banner :</strong></td> 
                                            <td width="70%"><img src="<?php echo url(); ?>/uploaded/homebanner/thumb/<?php echo $data['banner']['banner_picture'];  ?>" border="0" height="50" width="50" ></td>
                                        </tr>  

                                    </tbody>
                        </table>  
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-light-grey">Close</button> 
            </div>
        </div>
 