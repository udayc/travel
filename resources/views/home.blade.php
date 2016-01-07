@extends('app' )



@section('content')

<!-- inner page area start -->
<div class="innrPgArea registration">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Dashboard
	</h3>
        
        <!-- menu open -->
        <div class="Resgister_Dash_menu">
          <ul>
            <li><a href="/home/dashboard">Dashboard</a></li>
            <li><a href="/home/account">Account</a></li>
            <li><a href="/home/backer-lists">Backer Profile</a></li>
            <li><a href="#">Creator Profile</a></li>
            <li><a href="/home/payment-account">Payment Account</a></li>
            <li><a href="/home/my-projects" class="actvMenu">My Projects</a></li>
          </ul>
        </div>
        <!-- menu closed --> 
        
        <!-- form part 1 open -->
        <div class="formBox">
          <h3>Team Information</h3>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Company Name</span><span class="star">*</span></label>
              <input name="" type="text" class="form-control" placeholder="What is your company’s name?">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea <a href="#">commodo consequat</a>. </p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Company Logo</span></label>
              <div class="custom-file-upload form-control">
                <input type="file" id="file" name="myfiles[]" class="form-control" />
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Company Location</span></label>
              <input name="" type="text" class="form-control" placeholder="Where is your company located?">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea <a href="#">commodo consequat</a>. </p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Company URL</span></label>
              <input name="" type="text" class="form-control" placeholder="Your company’s website">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Company Location</span></label>
              <input name="" type="text" class="form-control" placeholder="Your facebook account URL">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt. </p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Company URL</span></label>
              <input name="" type="text" class="form-control" placeholder="Your twitter link">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud. </p>
            </div>
          </div>
        </div>
        <!-- form part 1 closed --> 
        
        <!-- form part 2 open -->
        <div class="formBox">
          <h3>Project Information</h3>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Project Title</span><span class="star">*</span></label>
              <input name="" type="text" class="form-control" placeholder="What is your projects name?">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Goal Amount</span><span class="star">*</span></label>
              <input name="" type="text" class="form-control" placeholder="What is your goal amount?">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Project Category</span><span class="star">*</span></label>
              <input name="" type="text" class="form-control" placeholder="What is your project category?">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 formFldArea">
              <label><span>Project Duration</span><span class="star">*</span></label>
              <input name="" type="text" class="form-control HalfFld calenderIcon" placeholder="Start Date" id="dp1" readonly>
              <input name="" type="text" class="form-control HalfFld mragin0 calenderIcon" placeholder="End Date" id="dp2" readonly>
            </div>
          </div>
        </div>
        <!-- form part 2 closed --> 
        
        <!-- form part 3 open -->
        <div class="formBox">
          <h3>Campaign End Options</h3>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 formFldArea">
              <div class="chkbox_area">
                <input type="radio" name="radio" value="1" checked="checked">
                <label for="checkbox1">Close on End</label>
              </div>
              <div class="chkbox_area">
                <input type="radio" name="radio" value="2">
                <label for="checkbox1">Leave Open</label>
              </div>
            </div>
          </div>
        </div>
        <!-- form part 3 closed --> 
        
        <a class="btn btn-warning MidButton pull-left">Start a Project</a> <a class="btn btn-default midGrayButton pull-left grayBtnGap">Save draft</a> </div>
    </div>
  </div>
</div>
<!-- inner page area closed --> 
@endsection

@section('scripts')

<!-- datepicker script --> 
<script src="/js/frontend/bootstrap-datepicker.js"></script> 
<script>
	if (top.location != location) {
    top.location.href = document.location.href ;
  }
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'dd-mm-yyyy'
			});
			$('#dp2').datepicker({
				format: 'dd-mm-yyyy'
			});
		});
</script> 

<!-- upload script --> 
<script src="/js/frontend/custom-upload-script.js"></script>
<script src="/js/frontend/customjs.js"></script> 
@endsection
