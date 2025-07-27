@extends('layouts.page.master')

@section('customstyle') 
@endsection

@section('pagecontent')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#activity" data-toggle="tab">About Me</a></li>
      <li><a href="#photos" data-toggle="tab">Photos</a></li>      
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="activity">
            <div class="form">
                <div class="table table-pading5">
                  <div class="table-cell5">&nbsp;</div>
                  <div class="table-cell">
                      <img id="profilePicpreview" src="/p/{{$profile->profileimage}}" class="profilePicPreview" />
                  </div>
                  <div class='col-lg-3 col-md-3 col-xs-3 col-sm-3'>
                    <div class="row"><label for="title">{{$profile->username}}</label></div>
                    <div class="row"><a name="linkOnlineMail" href="#" class="small-box-footer" data-params='{"id":"{!!$profile->id!!}","name":"{!!$profile->username!!}"}'> <i class="glyphicon glyphicon-envelope"></i> Mail</a></div>
                    <div class="row"><a name="linkOnlineFavourite" href="#" class="small-box-footer" data-params='{"id":"{!!$profile->id!!}","name":"{!!$profile->username!!}"}'> <i class="fa fa-heart"></i> Favourite</a></div>
                    <div class="row"><a name="linkOnlineInterest" href="#" class="small-box-footer" data-params='{"id":"{!!$profile->id!!}","name":"{!!$profile->username!!}"}'> <i class="fa fa-thumbs-up"></i> Interest</a></div>
                    <div class="row"><a href="#" class="small-box-footer"> <i class="fa fa-wechat"></i> Chat</a></div>
                  </div>                            
                </div>                
            </div>   
             
            <div id="modal-background" class="display-hidden"></div>
            <div id="hdnmodal-content" class="display-hidden">
              <div>
                <img id="blaha" src="#" class="profilePicUpload" />
                <button id="profilepic-close">Done</button>
                <input id="p-x" nama="p-x" type="hidden">
                <input id="p-y" nama="p-y" type="hidden">
                <input id="p-w" nama="p-w" type="hidden">
                <input id="p-h" nama="p-h" type="hidden">
              </div>      
            </div>
            <div class="js-section js-personal-info">
                <div class="section section-profile js-section-editable">
                    <div class="section-editable-view view-mode">
                        <br>
                        <div class="form">
                          <div class="table table-pading5">
                            <div class="table-cell">
                                <label for="title">{{$profile->title}}</label>
                            </div>                            
                          </div>
                          <div class="table table-pading5">
                            <div class="table table-pading10">
                              <textarea id="txtProfileDescription" class="profile-description" readonly>{{$profile->description}}</textarea>                              
                            </div>
                          </div>
                        </div>
                    </div>  
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">Personal info </h2>
                        <span class="grey section-fill-status">89% complete</span>
                    </div>              
                    <div class="section-editable-view view-mode">
                        <div class="form">
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="title">Marital Status:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblmaritalstatus">{{$profile->maritalstatus}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="title">Appearance:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblappearance">{{$profile->getAppearance()}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="title">Living:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblliving">{{$profile->living_with}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="title">Kids:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblkids">{{$profile->kids}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="title">Smoking:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblsmoking">{{$profile->smoking}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="title">Drinking:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lbldrinking">{{$profile->drinking}}</span>
                            </div>
                          </div>
                        </div>                  
                    </div>                    
                </div>
            </div>
            <div class="js-section js-work-education">
                <div class="section section-profile js-section-editable">
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">Work & Education </h2>                        
                    </div>              
                    <div class="section-editable-view view-mode">
                        <div class="form">
                          <div class="table table-pading5">
                            <div class="table-cell">
                                <label for="lblwork">Work:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblwork">{{$profile->work}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="lbleducation">Education:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lbleducation">{{$profile->education}}</span>
                            </div>
                          </div>                              
                        </div>                  
                    </div>                    
                </div>
            </div>
            <div class="js-section js-location-residency">
                <div class="section section-profile js-section-editable">
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">Location </h2>                        
                    </div>              
                    <div class="section-editable-view view-mode">
                        <div class="form">
                          <div class="table table-pading5">
                            <div class="table-cell">
                                <label for="lbllocation">Location:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lbllocation">{{$profile->getLocation()}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="lblresidency">Residency:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblresidency">{{$profile->residency}}</span>
                            </div>
                          </div>                              
                        </div>                  
                    </div>                    
                </div>
            </div>
        </div><!-- /.tab-pane -->        

      <div class="tab-pane" id="photos">


        <!-- Jssor Slider Begin -->
        <!-- To move inline styles to css file/block, please specify a class name for each element. -->     
        <div class="container-fluid jassorOuterDiv">
            <div class="container-fluid">
                <div class="container-fluid jassorInnerDiv" id="slider1_container" style="position: relative; width: 600px; height: 575px; background-color: #000; ">

                    <!-- Loading Screen -->
                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                            background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                        <div style="position: absolute; display: block; background: url(/img/loading.gif) no-repeat center center;
                            top: 0px; left: 0px;width: 100%;height:100%;">
                        </div>
                    </div>

                    <!-- Slides Container -->
                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 500px;
                        overflow: hidden;">
                        @if (count($profile->Images) > 0)                            
                          @foreach($profile->Images as $image)
                            <div>                            
                                <a u=image><img src="/p/{!! $image->name !!}" /></a>                            
                            </div>
                          @endforeach
                        @else
                          <div>                            
                                <a u=image><img src="/p/{{$profile->profileimage}}" /></a>                            
                            </div>
                        @endif                       
                    </div>
                    <!--#region Arrow Navigator Skin Begin -->
                    <style>
                        /* jssor slider arrow navigator skin 05 css */
                        /*
                        .jssora05l                  (normal)
                        .jssora05r                  (normal)
                        .jssora05l:hover            (normal mouseover)
                        .jssora05r:hover            (normal mouseover)
                        .jssora05l.jssora05ldn      (mousedown)
                        .jssora05r.jssora05rdn      (mousedown)
                        */
                        .jassorOuterDiv{
                            padding-left: 75px !important;
                            padding-right: 75px !important;
                            background-color: #000;
                        }
                        .jassorInnerDiv{
                            margin: 0 auto;                
                        }
                        .jssora05l, .jssora05r {
                            display: block;
                            position: absolute;
                            /* size of arrow element */
                            width: 40px;
                            height: 40px;
                            cursor: pointer;
                            background: url(/img/a17.png) no-repeat;
                            overflow: hidden;
                        }
                        .jssora05l { background-position: -10px -40px; }
                        .jssora05r { background-position: -70px -40px; }
                        .jssora05l:hover { background-position: -130px -40px; }
                        .jssora05r:hover { background-position: -190px -40px; }
                        .jssora05l.jssora05ldn { background-position: -250px -40px; }
                        .jssora05r.jssora05rdn { background-position: -310px -40px; }
                    </style>
                    <!-- Arrow Left -->
                    <span u="arrowleft" class="jssora05l" style="top: 158px; left: 8px;">
                    </span>
                    <!-- Arrow Right -->
                    <span u="arrowright" class="jssora05r" style="top: 158px; right: 8px">
                    </span>
                    <!--#endregion Arrow Navigator Skin End -->

                    <!--#region Thumbnail Navigator Skin Begin -->
                    <!-- Help: http://www.jssor.com/development/slider-with-thumbnail-navigator-jquery.html -->
                    <style>
                        /* jssor slider thumbnail navigator skin 07 css */
                        /*
                        .jssort07 .p            (normal)
                        .jssort07 .p:hover      (normal mouseover)
                        .jssort07 .pav          (active)
                        .jssort07 .pav:hover    (active mouseover)
                        .jssort07 .pdn          (mousedown)
                        */
                        .jssort07 {
                            position: absolute;
                            /* size of thumbnail navigator container */
                            width: 800px;
                            height: 100px;
                            top:485px;
                            z-index: 100;
                        }

                            .jssort07 .p {
                                position: absolute;
                                top: 0;
                                left: 0;
                                width: 99px;
                                height: 66px;
                            }

                            .jssort07 .i {
                                position: absolute;
                                top: 0px;
                                left: 0px;
                                width: 99px;
                                height: 66px;
                                filter: alpha(opacity=80);
                                opacity: .8;
                            }

                            .jssort07 .p:hover .i, .jssort07 .pav .i {
                                filter: alpha(opacity=100);
                                opacity: 1;
                            }

                            .jssort07 .o {
                                position: absolute;
                                top: 0px;
                                left: 0px;
                                width: 97px;
                                height: 64px;
                                border: 1px solid #000;
                                box-sizing: content-box;
                                transition: border-color .6s;
                                -moz-transition: border-color .6s;
                                -webkit-transition: border-color .6s;
                                -o-transition: border-color .6s;
                            }

                            .jssort07 .pav .o {
                                border-color: #0099ff;
                            }

                            .jssort07 .p:hover .o {
                                border-color: #fff;
                                transition: none;
                                -moz-transition: none;
                                -webkit-transition: none;
                                -o-transition: none;
                            }

                            .jssort07 .p.pdn .o {
                                border-color: #0099ff;
                            }

                            * html .jssort07 .o {
                                /* ie quirks mode adjust */
                                width /**/: 99px;
                                height /**/: 66px;
                            }
                    </style>
                    <!-- thumbnail navigator container -->
                    <div u="thumbnavigator" class="jssort07" style="width: 600px; height: 100px; left: 0px; bottom: 0px;">
                        <!-- Thumbnail Item Skin Begin -->
                        <div u="slides" style="cursor: default;">
                            <div u="prototype" class="p">
                                <div u="thumbnailtemplate" class="i"></div>
                                <div class="o"></div>
                            </div>
                        </div>
                        <!-- Thumbnail Item Skin End -->
                        <!--#region Arrow Navigator Skin Begin -->
                        <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
                        <style>
                            /* jssor slider arrow navigator skin 11 css */
                            /*
                            .jssora11l                  (normal)
                            .jssora11r                  (normal)
                            .jssora11l:hover            (normal mouseover)
                            .jssora11r:hover            (normal mouseover)
                            .jssora11l.jssora11ldn      (mousedown)
                            .jssora11r.jssora11rdn      (mousedown)
                            */
                            .jssora11l, .jssora11r {
                                display: block;
                                position: absolute;
                                /* size of arrow element */
                                width: 37px;
                                height: 37px;
                                cursor: pointer;
                                background: url(/img/a11.png) no-repeat;
                                overflow: hidden; 
                                top:32px !important;                                
                            }

                            .jssora11l {
                                background-position: -11px -41px;
                                left:0px !important;
                            }

                            .jssora11r {
                                background-position: -71px -41px;
                                right:0px !important;
                            }

                            .jssora11l:hover {
                                background-position: -131px -41px;
                            }

                            .jssora11r:hover {
                                background-position: -191px -41px;
                            }

                            .jssora11l.jssora11ldn {
                                background-position: -251px -41px;
                            }

                            .jssora11r.jssora11rdn {
                                background-position: -311px -41px;
                            }
                        </style>
                        <!-- Arrow Left -->
                        <span u="arrowleft" class="jssora11l" style="top: 123px; left: 8px;">
                        </span>
                        <!-- Arrow Right -->
                        <span u="arrowright" class="jssora11r" style="top: 123px; right: 8px;">
                        </span>
                        <!--#endregion Arrow Navigator Skin End -->
                    </div>
                    <!--#endregion Thumbnail Navigator Skin End -->                        
                </div>
            </div>
        </div>    
        <!-- Jssor Slider End -->  
        <br>            
      </div><!-- /.tab-pane -->

    </div><!-- /.tab-content -->
        <div class="box-footer">
            <div class="pull-right">
                <a href="{{ URL::previous() }}" class="small-box-footer"> <i class="fa fa-arrow-circle-left"></i> go back</a>
            </div>
        </div><!-- /.box-footer-->
  </div><!-- /.nav-tabs-custom -->

@endsection

@section('customscripts') 
<script src="/js/jssor.slider.js"></script>
<script src="/js/photoslider.js"></script>
<script src="/js/jquery.elastic.js"></script>
<script src="/js/popup.js"></script>
<script src="/js/online.js"></script>
@endsection