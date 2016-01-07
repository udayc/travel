  <div class="container">
    <div class="row"> 
      
      <!-- menu open -->
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div id="cssmenu">
		@if( count($_menus) > 0 )
          <ul>
		  @foreach($_menus as $menu )
            <li><a href=" {{ URL::to('pages/' . $menu->menu_slug) }}">{!! $menu->name !!} </a></li>
			@endforeach
          </ul>
		  @endif
        </div>
      </div>
      <!-- menu area closed --> 
      
      <!-- search area open -->
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="hdrSearch">
      <form>
      <input name="" type="text" class="serchFld" placeholder="What are you looking for?">
      <input name="" type="submit" class="serchBtn">
      </form>
      </div>
      </div>
      <!-- search area closed -->
      
    </div>
  </div>