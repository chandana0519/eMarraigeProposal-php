@extends('layouts.page.master')

@section('customstyle') 
<link href="/css/imageupload.css" rel="stylesheet">
<link href="/css/jquery.Jcrop.min.css" rel="stylesheet">
@endsection

@section('pagecontent')
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#activity" data-toggle="tab">About Me</a></li>
      <li><a href="#timeline" data-toggle="tab">About Partner</a></li>
      <li><a href="#photos" data-toggle="tab">Photos</a></li>
      <li><a href="#settings" data-toggle="tab">Settings</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="activity">
            <div id="ChatContainer">
              <diV class="profilePicpreview">
                <img id="profilePicpreview" src="/p/{{$profile->profileimage}}" class="profilePicPreview" />
              </div>
              <div class="choose_file">
                <span>Upload Profile Image</span>
                <input id="profilePicSelect" type="file" />
              </div>
            </div>  
             
            <div id="modal-background" class="display-hidden"></div>
            <div id="hdnmodal-content" class="display-hidden">
              <div>
                <img id="blaha" src="#" class="profilePicUpload" />
                <button id="profilepic-close" class="btn btn-danger">Done</button>
                <input id="p-x" nama="p-x" type="hidden">
                <input id="p-y" nama="p-y" type="hidden">
                <input id="p-w" nama="p-w" type="hidden">
                <input id="p-h" nama="p-h" type="hidden">
              </div>      
            </div>
            <div class="js-section js-personal-info">
                <div class="section section-profile js-section-editable">
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">Personal info </h2>
                        <i class="fa fa-pencil fa-2x ui-icon"></i>
                        <span class="grey section-fill-status"><span id="completePercentage">{{$profile->percentagePersonalInfo()}}</span>% complete</span>
                    </div>              
                    <div class="section-editable-view view-mode">
                        <div class="form">
                          <div class="table table-pading5">
                            <div class="table-cell">
                                <label for="title">Title:</label>
                            </div>
                            <div class="table-cell">
                              <span id="lbltitle">{{$profile->title}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                            <div class="table-cell table-cell--top">
                                <label for="aboutme">About me:</label>
                            </div>
                            <div class="table table-pading10">
                              <span id="lblaboutme">{{$profile->description}}</span>
                            </div>
                          </div>
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
                    <div class="section-editable-edit hidden-mode">                 
                        <div class="form">
                          <div class="table">
                            <div class="table-cell">
                                <label for="title">Title:</label>
                            </div>
                            <div class="table-cell">
                              <input type="title" id="title" class="input input--sm" placeholder="Title" value={{$profile->title}}>
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell table-cell--top">
                                <label for="aboutme">About me:</label>
                            </div>
                            <div class="table-cell">
                              <textarea id="aboutme" name="aboutme" class="textarea" rows="6" placeholder="Type about you (up to 5000 charactors)">{{$profile->description}}</textarea>
                            </div>
                          </div>
                          <hr>
                          <div class="table">
                            <div class="table-cell">
                                <label for="maritalstatus">Marital Status:</label>                    
                            </div>                
                            <div class="table-cell70">
                                {!! Form::select('maritalstatus', Config::get('constants.maritalstatus'), $profile->maritalstatus_id, ['id'=>'maritalstatus','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="height">Height:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('height', Config::get('constants.height'), $profile->height_id, ['id'=>'height','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="weight">Weight:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('weight', Config::get('constants.weight'), $profile->weight_id, ['id'=>'weight','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="bodytype">Body Type:</label>                    
                            </div>                
                            <div class="table-cell70">
                                {!! Form::select('bodytype', Config::get('constants.bodytype'), $profile->body_type,['id'=>'bodytype','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="complexion">Complexion:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('complexion', Config::get('constants.complexion'), $profile->appearance, ['id'=>'complexion','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <hr>
                          <div class="table">
                            <div class="table-cell">
                                <label for="living">Living:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('living', Config::get('constants.living'), $profile->living_with, ['id'=>'living','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="kids">Kids:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('kids', Config::get('constants.kids'), $profile->kids_id, ['id'=>'kids','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="smoking">Smoking:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('smoking', Config::get('constants.smoking'), $profile->smoking_id, ['id'=>'smoking','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                           <div class="table">
                            <div class="table-cell">
                                <label for="drinking">Drinking:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('drinking', Config::get('constants.drinking'), $profile->drinking_id, ['id'=>'drinking','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="js-section-editable-btnbar"> 
                            <button id="btnPersonalInfo" type="button" class="btn-normal js-section-editable-save">Save</button>
                          </div>             
                        </div>                  
                    </div>
                </div>
            </div>
            <div class="js-section js-work-education">
                <div class="section section-profile js-section-editable">
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">Work & Education </h2>
                        <i class="fa fa-pencil fa-2x ui-icon"></i>
                        <span class="grey section-fill-status"><span id="completePercentage">{{$profile->percentageWorkEducation()}}</span>% complete</span>
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
                    <div class="section-editable-edit hidden-mode">                 
                        <div class="form">
                          <div class="table">
                            <div class="table-cell">
                                <label for="maritalstatus">Work:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('work', Config::get('constants.work'), $profile->work_id, ['id'=>'work','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="maritalstatus">Education:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('education', Config::get('constants.education'), $profile->education_id, ['id'=>'education','class'=>'input input--sm']) !!}
                            </div>
                          </div>                              
                          <div class="js-section-editable-btnbar"> 
                            <button id="btnWorkEdu" type="button" class="btn-normal js-section-editable-save">Save</button>
                          </div>             
                        </div>                  
                    </div>
                </div>
            </div>
            <div class="js-section js-location-residency">
                <div class="section section-profile js-section-editable">
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">Location </h2>
                        <i class="fa fa-pencil fa-2x ui-icon"></i>
                        <span class="grey section-fill-status"><span id="completePercentage">{{$profile->percentageLocationResidency()}}</span>% complete</span>
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
                    <div class="section-editable-edit hidden-mode">                 
                        <div class="form">
                          <div class="table">
                            <div class="table-cell">
                                <label for="country">Country:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('country', Config::get('constants.country'), $profile->country_id, ['id'=>'country','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="state">State/Province:</label>                    
                            </div>                
                            <div class="table-cell70">
                                {!! Form::select('state', $state , $profile->state_id, ['id'=>'state','class'=>'input input--sm']) !!}
                                <div id="divProgressState"  class="progress progress-striped active display-hidden">
                                    <div style="width: 100%;" class="progress-bar progress-bar-danger">            
                                    </div>            
                                </div>
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="city">City:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('city', $city, $profile->city_id, ['id'=>'city','class'=>'input input--sm']) !!}
                                <div id="divProgressCity"  class="progress progress-striped active display-hidden">
                                    <div style="width: 100%;" class="progress-bar progress-bar-danger">            
                                    </div>            
                                </div> 
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="residency">Residency:</label>                    
                            </div>                
                            <div class="table-cell70">                                    
                                {!! Form::select('residency', Config::get('constants.residency'), $profile->residency, ['id'=>'residency','class'=>'input input--sm']) !!}
                            </div>
                          </div>                              
                          <div class="js-section-editable-btnbar"> 
                            <button id="btnLocResidency" type="button" class="btn-normal js-section-editable-save">Save</button>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.tab-pane -->
        <div class="tab-pane" id="timeline">
            <div class="js-section js-abt-partner">
                <div class="section section-profile js-section-editable">
                    <div class="btn js-section-editable-btn">
                        <h2 class="js-section-editable-header">I am here to </h2>
                        <i class="fa fa-pencil fa-2x ui-icon"></i>                            
                    </div>              
                    <div class="section-editable-view view-mode">
                        <div class="form">
                          <div class="table table-pading5">
                            <div class="table-cell">
                                <label for="lblrelationship">Relationship:</label>
                            </div>
                            <div class="table-cell">
                              <span id="lblrelationship">{{$profile->relationship}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="lblagepreference">Preferred Age:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblagepreference">{{$profile->age_preference}}</span>
                            </div>
                          </div>
                          <div class="table table-pading5">
                             <div class="table-cell">
                                <label for="lblprefreredage">Age Range:</label>
                            </div>
                            <div class="table-cell">
                                <span id="lblprefreredage">{{ $profile->age_min>0 ? $profile->age_min.' to '.$profile->age_max : '' }}</span>
                            </div>
                          </div>
                        </div>                  
                    </div>
                    <div class="section-editable-edit hidden-mode">                 
                        <div class="form">
                          <div class="table">
                            <div class="table-cell">
                                <label for="relationship">Relationship:</label>                    
                            </div>                
                            <div class="table-cell">                                    
                                {!! Form::select('relationship', Config::get('constants.relationship'), $profile->relationship_id, ['id'=>'relationship','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="agepreference">Relationship:</label>                    
                            </div>                
                            <div class="table-cell">                                    
                                {!! Form::select('agepreference', Config::get('constants.agepreference'), $profile->agepreference, ['id'=>'agepreference','class'=>'input input--sm']) !!}
                            </div>
                          </div>
                          <div class="table">
                            <div class="table-cell">
                                <label for="prefreredage">Preferred Age:</label>                    
                            </div>                
                            <div class="table-cell">                                    
                                <input id="prefreredage" type="text" value="" class="slider form-control" data-slider-min="18" data-slider-max="65" data-slider-step="1" data-slider-value="[{{$profile->age_min}},{{$profile->age_max}}]" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">
                            </div>
                          </div>                                          
                        </div> 
                        <div class="js-section-editable-btnbar"> 
                            <button id="btnAbtPartner" type="button" class="btn-normal js-section-editable-save">Save</button>
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
                        <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
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
        <button id="btnUploadPhotos" onclick="openpopup('popup1')" type="button" class="btn-normal js-section-editable-save">Add Photos</button>
        <div id="popup1" class="popup">    
          <div class="container-fluid demo-wrapper">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Uploads</h3>
              </div>
              <div class="panel-body demo-panel-files panel-body-borer0" id='demo-files'>
                <span class="demo-note">No Files have been selected/droped yet...</span>
              </div>
              <div id="drag-and-drop-zone" class="uploader">
                
                <div>Drag &amp; Drop Images Here</div>
                <div class="or">-or-</div>
                <div class="browser">
                  <label>
                    <span>Click to open the file Browser</span>
                    <input type="file" name="files[]"  accept="image/*" multiple="multiple" title='Click to add Images'>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>        
      </div><!-- /.tab-pane -->

      <div class="tab-pane" id="settings">
        <div class="js-section js-basic-settings">
            <div class="section section-profile js-section-editable">
              <div class="btn js-section-editable-btn">
                  <h2 class="js-section-editable-header">Basic Settings </h2>
                  <i class="fa fa-pencil fa-2x ui-icon"></i>                            
              </div>
              <div class="section-editable-view view-mode">
                  <div class="form">
                    <div class="table table-pading5">
                      <div class="table-cell">
                          <label for="lblusername">User Name:</label>
                      </div>
                      <div class="table-cell">
                        <span id="lblusername">{{$profile->username}}</span>
                      </div>
                    </div>
                    <div class="table table-pading5">
                       <div class="table-cell">
                          <label for="lblemail">Email:</label>
                      </div>
                      <div class="table-cell">
                          <span id="lblemail">{{$profile->email}}</span>
                      </div>
                    </div>
                    <div class="table table-pading5">
                       <div class="table-cell">
                          <label for="lbldateofbirth">Date of Birth:</label>
                      </div>
                      <div class="table-cell">
                          <span id="lbldateofbirth">{{ $profile->dateofbirth }}</span>
                      </div>
                    </div>
                  </div>                  
              </div>
              <div class="section-editable-edit hidden-mode">
                {!! Form::open(array('id'=>'frmBasicSettings','url'=>'/update', 'class'=>'form', 'role'=>'form')) !!}
                  <div class="table">
                    <div class="table-cell">
                      <label for="lblusername">User Name:</label>
                    </div>
                    <div class="table-cell70">
                      <span id="lblusername">{{$profile->username}}</span>
                    </div>
                  </div>
                  <div class="table">
                    <div class="table-cell">
                      <label for="email">Email:</label>
                    </div>
                    <div class="table-cell70">
                      <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{$profile->email}}">                      
                    </div>
                  </div>
                  <div class="table">
                    <div class="table-cell">
                      <label for="dateofbirth">Date of Birth:</label>
                    </div>
                    <div class="table-cell60">
                      <input type="text" class="form-control" id="dateofbirth" name="dateofbirth" placeholder="Date of Borth" value="{{$profile->dateofbirth}}">
                    </div>
                  </div>
                  <div class="js-section-editable-btnbar"> 
                    <button type="submit" id="btnBasicSettings" class="btn btn-danger">Save</button>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
        </div>
        <div class="js-section js-change-password">
          <div class="section section-profile js-section-editable">
            <div class="btn js-section-editable-btn">
              <h2 class="js-section-editable-header">Change Password </h2>
              <i class="fa fa-pencil fa-2x ui-icon"></i>
            </div>            
            <div class="section-editable-view view-mode">
              <div id="divClientMessagePasswordSuccess" class="alert display-hidden">
                  <button type="button" class="close">&times;</button>                    
              </div>
            </div>
            <div class="section-editable-edit hidden-mode">              
              {!! Form::open(array('id'=>'frmChangePassword','url'=>'/update', 'class'=>'form', 'role'=>'form')) !!}
                <div id="divClientMessagePasswordError" class="alert display-hidden">
                    <button type="button" class="close">&times;</button>                    
                </div>
                <div class="table">
                  <div class="table-cell">
                    <label for="CurrentPassword">Current Password:</label>
                  </div>
                  <div class="table-cell70">
                    <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword" placeholder="Current Password">
                  </div>
                </div>
                <div class="table">
                  <div class="table-cell">
                    <label for="NewPassword">New Password:</label>
                  </div>
                  <div class="table-cell70">
                    <input type="password" class="form-control" id="NewPassword" name="NewPassword" placeholder="New Password">
                  </div>
                </div>
                <div class="table">
                  <div class="table-cell">
                    <label for="ConfirmPassword">Confirm Password:</label>
                  </div>
                  <div class="table-cell70">
                    <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="js-section-editable-btnbar"> 
                  <button type="submit" id="btnChangePassword" class="btn btn-danger">Save</button>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
        <div class="js-section js-profile-status">
          <div class="section section-profile js-section-editable">
            <div class="btn js-section-editable-btn">
              <h2 class="js-section-editable-header">Profile Status </h2>
              <i class="fa fa-pencil fa-2x ui-icon"></i>
            </div>
            <div class="section-editable-view view-mode">
            </div>
            <div class="section-editable-edit hidden-mode">
              <div class="form">
                <div class="table">
                  <div class="table-cell">
                    <label for="btntext">Profile Status:</label>
                  </div>
                  <div class="table-cell">
                      <div class="center toggle-active-button toggle-active-button-selected">
                          <span id="btntext" style="font-weight: 900;">Active</span>
                          <button></button>
                      </div>
                  </div>
                </div>
                <div class="js-section-editable-btnbar"> 
                  <button type="submit" class="btn btn-danger">Save</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
        <div class="js-section js-email-notification">
          <div class="section section-profile js-section-editable">
            <div class="btn js-section-editable-btn">
              <h2 class="js-section-editable-header">Email Notification </h2>
              <i class="fa fa-pencil fa-2x ui-icon"></i>
            </div>
            <div class="section-editable-view view-mode">
            </div>
            <div class="section-editable-edit hidden-mode">
              <div class="form">
                <div class="table">
                  <div class="table-cell70">
                    <label>New Mail:</label>
                  </div>
                  <div class="table-cell">
                    <div class="center toggle-yes-button toggle-yes-button-selected">
                          <span id="btntext" style="font-weight: 900;">&nbsp;</span>
                          <button></button>
                      </div>
                  </div>
                </div>
                <div class="table">
                  <div class="table-cell70">
                    <label>New Interest:</label>
                  </div>
                  <div class="table-cell">
                    <div class="center toggle-yes-button toggle-yes-button-selected">
                          <span id="btntext" style="font-weight: 900;">&nbsp;</span>
                          <button></button>
                      </div>
                  </div>
                </div>
                <div class="table">
                  <div class="table-cell70">
                    <label>New Favourited:</label>
                  </div>
                  <div class="table-cell">
                    <div class="center toggle-yes-button toggle-yes-button-selected">
                          <span id="btntext" style="font-weight: 900;">&nbsp;</span>
                          <button></button>
                      </div>
                  </div>
                </div>
                <div class="table">
                  <div class="table-cell70">
                    <label>New Members:</label>
                  </div>
                  <div class="table-cell">
                    <div class="center toggle-yes-button toggle-yes-button-selected">
                          <span id="btntext" style="font-weight: 900;">&nbsp;</span>
                          <button></button>
                      </div>
                  </div>
                </div>
                <div class="table">
                  <div class="table-cell70">
                    <label>New Photo:</label>
                  </div>
                  <div class="table-cell">
                    <div class="center toggle-yes-button toggle-yes-button-selected">
                          <span id="btntext" style="font-weight: 900;">&nbsp;</span>
                          <button></button>
                      </div>
                  </div>
                </div>
                <div class="js-section-editable-btnbar"> 
                  <button type="submit" class="btn btn-danger">Save</button>
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.tab-pane -->
    </div><!-- /.tab-content -->
  </div><!-- /.nav-tabs-custom -->
@endsection

@section('customscripts') 
<script src="/js/jssor.slider.js"></script>
<script src="/js/section.js"></script>
<script src="/js/photoslider.js"></script>
<script src="/js/profile.js"></script>
<script src="/js/dmuploader.min.js"></script>
<script src="/js/imageupload.js"></script>
<script src="/js/imagecrop.js"></script>
<script src="/js/jquery.Jcrop.min.js"></script>
<script src="/js/popup.js"></script>
@endsection
