 

  <?php $counter=1; ?>
  @foreach ($categorylist as $category)
  <tr>
  <td class="center" >
  <div class="checkbox-table listChk">
  <label>
  <input type="checkbox" class="ulistcheckbox" name="ulist" value="{{ $category->id }}">
  </label>
  </div>
  </td> 
  <td>{{ $category->name }}</td>    
  <td>{{ $category->category_slug }}</td>  
  <td><?php if($category->is_hidden == 0 ) { ?><span class="badge badge-danger">No</span><?php } else { ?><span class="badge badge-success">Yes</span><?php } ?></td>  
  <td> {{ date('M d, Y' , strtotime($category->updated_at) ) }} </td>   
  <td>
    <?php if( $category->active == 1 ) { ?><a class="label label-sm label-success" href="javascript:changestatus( <?php echo $category->id; ?>, '0' )" id="activespn_<?php echo $category->id; ?>"  >Active</a><a class="label label-sm label-danger"   href="javascript:changestatus( <?php echo $category->id; ?>, '1' )"  id="inactivespn_<?php echo $category->id; ?>" style="display:none;"  >Inactive</a><?php } else { ?><a class="label label-sm label-danger"   href="javascript:changestatus( <?php echo $category->id; ?>, '1' )"  id="inactivespn_<?php echo $category->id; ?>"   >Inactive</a><a class="label label-sm label-success" href="javascript:changestatus( <?php echo $category->id; ?>, '0' )" id="activespn_<?php echo $category->id; ?>"  style="display:none;"  >Active</a><?php } ?>  

  </td>    
  
  <td class="center"  > 
  <div class="btn-group">
  <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
  <i class="fa fa-cog"></i> <span class="caret"></span>
  </a>
  <ul role="menu" class="dropdown-menu pull-right">  
    
    <li role="presentation">
    <a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/category/edit/{{ $category->id }}">
    <i class="fa fa-edit"></i> Edit
    </a>
    </li> 

    <li role="presentation">
    <a role="menuitem" tabindex="-1" href="<?php echo url(); ?>/admin/category/details/{{ $category->id }}">
    <i class="fa fa-share"></i> View
    </a>
    </li> 

    <li role="presentation">
    <a class="deleteRecord" role="menuitem" tabindex="-1" href="javascript:void(0)" data-value="{{ $category->id }}"  data-token="{{ csrf_token() }}" data-url="/admin/category"><i class="fa fa-times"></i> Remove</a>
    </li>
  </ul>
  </div> 
  </td> 

  </tr>
  <?php $counter++; ?>  
  @endforeach 