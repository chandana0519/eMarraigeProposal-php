@extends('layouts.site.master')

@section('pagestyle')    
  <link href="/css/jquery-ui.min.css" rel="stylesheet">
  <link href="/css/formValidation.min.css" rel="stylesheet">  
  <style>
    #loginForm .has-error .control-label,
    #loginForm .has-error .help-block,
    #loginForm .has-error .form-control-feedback {
        color: #f39c12;
    }
    .help-block{
      margin-top: -5px;
    }
    .form-group {
      margin-bottom: 5px;
    }
    #registrationForm .selectContainer .form-control-feedback {
      /* Adjust feedback icon position */
      right: 10px;
    }
    .form-group {
      margin-bottom: 5px;
    }
    .ui-datepicker{
      z-index:2 !important;
    }
  </style>
@endsection

@section('content')
          <div class="row">
            <div class="col-md-4">                
              <div class="block">
                <h3><i class="fa fa-sign-in"></i> Login</h3>
                <form id="loginForm" method="POST" action="/">
                  {!! csrf_field() !!}
                  <div class="form-group">
                    <label for="username" >User Name</label>
                    <input id="username" name="username" value="{{ old('username') }}" type="username" class="form-control" placeholder="User name">
                  </div>  
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="remember"><label for="username" >Remember Me</label>
                  </div>
                  <button type="submit" class="btn">Login</button>                  
                  @if (count($errors))
                    @if ($errors->has('LoginValidator')) 
                      <div id="divLoginErr" class="error">
                        <ul>                                      
                          <li>{{ $errors->first('errorMesg') }}</li>
                        </ul>                      
                      </div>
                    @endif
                  @endif
                </form>                
              </div>
              <hr>
              <div id="quickSearchFrame" class="block">
                <h3><i class="fa fa-search-plus"></i> Quick Search</h3>
                <form role="form">
                  <div class="form-group">
                    <label for="searchsex">I am Searching </label>
                    <select name="searchsex" class="form-control">
                        <option selected="selected">Groom</option>
                        <option>Bride</option>
                    </select>
                  </div>  
                  <div class="form-group">
                    <label for="searchcountry">From</label>
                    {!! Form::select('searchcountry', Config::get('constants.country'), old('country_id') ? '' : '206',array('class' => 'form-control')) !!}
                  </div>
                  <div class="form-group">
                    <label for="withphoto">profile with photo</label>
                    <input id="withphoto" type="checkbox" name="photo" value="1" />
                  </div>
                  <button type="submit" class="btn">Search</button>
                </form>
              </div>
            </div>
            <div class="col-md-4">
              <div class="block">
                <h3><i class="fa fa-user-plus"></i> Registration</h3>
                <form id="registrationForm" name="registration" action="/register" method="post">
                    {!! csrf_field() !!}
                  <div class="form-group">
                    <label for="username" >User Name</label>
                    <input id="username" name="username" value="{{ old('username') }}" type="username" class="form-control" placeholder="User name">
                    @if (count($errors))
                      @if ($errors->has('username')) 
                        <div id="divLoginErr" class="error">
                          <ul>
                            @foreach ($errors->get('username') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                          </ul>                      
                        </div>
                      @endif
                    @endif                    
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                    @if (count($errors))
                      @if ($errors->has('password')) 
                        <div id="divLoginErr" class="error">
                          <ul>
                            @foreach ($errors->get('password') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                          </ul>                      
                        </div>
                      @endif
                    @endif                    
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email Address">
                    @if (count($errors))
                      @if ($errors->has('email')) 
                        <div id="divLoginErr" class="error">
                          <ul>
                            @foreach ($errors->get('email') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                          </ul>                      
                        </div>
                      @endif
                    @endif
                  </div>
                  <div class="form-group selectContainer">
                    <label for="sex">I am a </label>
                    {!! Form::select('sex', Config::get('constants.sex'), old('sex_id') ? '' : '', array('class' => 'form-control')) !!}
                    @if (count($errors))
                      @if ($errors->has('sex')) 
                        <div id="divLoginErr" class="error">
                          <ul>
                            @foreach ($errors->get('sex') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                          </ul>                      
                        </div>
                      @endif
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input id="dob" name="dob" type="text" class="form-control datepicker" placeholder="Date of Birth" readonly>
                    @if (count($errors))
                      @if ($errors->has('dob')) 
                        <div id="divLoginErr" class="error">
                          <ul>
                            @foreach ($errors->get('dob') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                          </ul>                      
                        </div>
                      @endif
                    @endif
                  </div>
                  <div class="form-group selectContainer">
                    <label for="country">Country</label>
                    {!! Form::select('country', Config::get('constants.country'), old('country_id') ? '' : '',array('class' => 'form-control')) !!}
                    @if (count($errors))
                      @if ($errors->has('country')) 
                        <div id="divLoginErr" class="error">
                          <ul>
                            @foreach ($errors->get('country') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                          </ul>                      
                        </div>
                      @endif
                    @endif 
                  </div>
                  <button type="submit" class="btn">Sign Up</button><br>
                  By continuing, you're confirming that you've read and agree to our <a>Terms and Conditions</>, <a>Privacy Policy</a> and <a>Cookie Policy</a>
              </form>
              </div>
            </div>
            <div class="col-md-4">
              <div class="block">
                <h3><i class="fa fa-check"></i> Welcome </h3> to
                <b>eMarriageProposal Marriage Service</b><br>
                eMarriageProposal is rich with fresh profiles, the intention of this site is to end your long journey you spent on searching for the marriage partner. It's now within your reach. 
              </div>
                <div class=".container-fluid">
                    <h3><i class="fa fa-spinner fa-spin"></i></i> New Members</h3>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="block block-light block-center">
                                <i class="fa fa-html5 fa-primary fa-6 fa-border"></i>                                
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="block block-light block-center">
                                <i class="fa fa-pie-chart fa-primary fa-6 fa-border"></i>                                
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <div class="block block-light block-center">
                                <i class="fa fa-html5 fa-primary fa-6 fa-border"></i>                                
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <div class="block block-light block-center">
                                <i class="fa fa-pie-chart fa-primary fa-6 fa-border"></i>                                
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
          </div>
            </div>
    <div style="margin:0 auto;">
    <!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider1_container" style="position: relative; margin:0 auto; width: 960px; height: 150px; overflow: hidden;">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 960px; height: 150px; overflow: hidden;">
            <div><img u="image" src="img/ancient-lady/005.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/006.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/011.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/013.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/014.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/019.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/020.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/021.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/022.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/024.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/025.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/027.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/029.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/030.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/031.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/032.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/034.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/038.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/039.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/043.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/044.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/047.jpg" /></div>
            <div><img u="image" src="img/ancient-lady/050.jpg" /></div>
        </div>
        
        <!--#region Bullet Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb03" style="bottom: 4px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype"><div u="numbertemplate"></div></div>
        </div>
        <!--#endregion Bullet Navigator Skin End -->
        
        <!--#region Arrow Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora03l" style="top: 123px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora03r" style="top: 123px; right: 8px;">
        </span>
        <!--#endregion Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
    </div>
    <!-- Jssor Slider End -->
    </div>  
@endsection

@section('pagescripts')    
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/jssor.slider.js"></script>
    <script src="/js/sliderbar.js"></script>    
    <script src="/js/site.js"></script>
    <script src="/js/formValidation.min.js"></script>
    <script src="/js/framework.bootstrap.min.js"></script>
    <script src="/js/login.js"></script>
@endsection