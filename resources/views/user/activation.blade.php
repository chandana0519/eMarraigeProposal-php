@extends('layouts.page.master')

@section('customstyle') 
@endsection

@section('pagecontent')      
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">

                <div class="box-body">
                  <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <h3 class="box-title text-green">Your account is successfully Activated.</h3>
                          <br>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <ul class="timeline">
                              <li class="time-label">
                                  <span class="bg-red">
                                      Important 
                                  </span>
                              </li>
                              <li>
                                  <i class="fa fa-user bg-blue"></i>
                                  <div class="timeline-item">
                                      <div class="timeline-body">
                                          You should have a profile picture and completed profile to allow <span class="text-yellow">other members to see</span> your profile
                                      </div>                                    
                                  </div>                                
                              </li>
                              <li>
                                  <i class="fa fa-comment bg-blue"></i>
                                  <div class="timeline-item">
                                      <div class="timeline-body">
                                          You should have a completed profile to <span class="text-yellow">chat</span> with other members
                                      </div>                                    
                                  </div>
                              </li>
                              <li>
                                  <i class="fa fa-envelope bg-blue"></i>
                                  <div class="timeline-item">
                                      <div class="timeline-body">
                                          You should have completed a profile to <span class="text-yellow">send mail</span> to other members
                                      </div>                                    
                                  </div>
                              </li>
                          </ul>                          
                        </div>
                  </div>
                   <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          Click <a href="/myprofile">My Profile</a> to update your profile.
                          <br><br>
                        </div>
                  </div>
                  
                </div><!-- /.box-body -->                
                <div class="box-footer clearfix unsubscribe">
                  Please check, whether the email is in the junk folder of your email account,
                  since confirmation mails with backlinks are sometimes classified as spam.
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row --> 
@endsection

@section('customscripts') 
@endsection