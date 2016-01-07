  <div class="container">
    <div class="row"> 
     
      <div class="footer_LftPrt">
        <h5>Help</h5>
        <div class="footerUL">
          <ul>
            <li><a href="{{ URL::to('pages/faq')}}">Faq</a></li>
            <li><a href="{{ URL::to('pages/terms-and-conditions')}}">Terms and Conditions</a></li>
            <li><a href="{{ URL::to('pages/privacy-policy')}}">Privacy Policy</a></li>
            <li><a href="{{ URL::to('pages/trusts-security')}}">Trusts & Security</a></li>
            <li><a href="{{ URL::to('pages/fraud-alert')}}">Fraud Alert</a></li>
          </ul>
        </div>
      </div>

      <div class="footer_MidPrt">
        <h5>How it works</h5>
        <div class="footerUL">
          <ul>
            <li><a href="{{ URL::to('pages/are-you-a-seeker')}}">Are you a seeker</a></li>
            <li><a href="{{ URL::to('pages/are-you-a-music-lover')}}">Are you a music lover</a></li>
          </ul>
        </div>
        <h5>Careers</h5>
      </div>

      <div class="footer_RgtPrt">
        <h5>Contact Us</h5>
        <p>{!! $_settings_data->contact_address !!}</p>	
        <div class="footer_social">
          <ul>
            <li><a href="#"><img src="/images/frontend/footer-icon/footer-fb-icon.png" alt="" border="0"></a></li>
            <li><a href="#"><img src="/images/frontend/footer-icon/footer-twitter-icon.png" alt="" border="0"></a></li>
            <li><a href="#"><img src="/images/frontend/footer-icon/footer-linkd-icon.png" alt="" border="0"></a></li>
            <li><a href="#"><img src="/images/frontend/footer-icon/footer-youtube-icon.png" alt="" border="0"></a></li>
          </ul>
        </div>
      </div>
 
      
      <div class="copywrt">{!! $_settings_data->copyright_text !!}</div>
	  
    </div>
	@include('partials._authmodal')
  </div>
  
  
  
  
 

  
  
  
  
  
  
  
  
  
  