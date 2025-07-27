@extends('layouts.page.master')

@section('customstyle') 
@endsection

@section('pagecontent')      
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">

                <div id="divVerifyEmail" class="box-body">
                  <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <h3 class="box-title">Thanks for using eMarriageProposal.</h3>
                          <br>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          Confirmation email has been sent to your <b>{{$email}}</b> email address.
                          <br><br>
                        </div>
                  </div>
                  <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          {!! Form::open(array('id'=>'frmVerifyEmail','url'=>'/verifyEmail', 'class'=>'form-horizontal', 'role'=>'form')) !!}
                            Verification Code 
                            <input id="verificationcode" name="verificationcode" type="text">
                            <a id="lnkVerifyEmail" name="lnkVerifyEmail" href="" class="btn-red">Submit</a>
                          {!! Form::close() !!}
                          <br>
                        </div>
                  </div>

                  <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                          <br>
                          Click <a href="/resendverification">here</a> to resend the Verification Code. You can change your email <a href="/myprofile">here</a>.
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
<script src="/js/activate.js"></script>
@endsection