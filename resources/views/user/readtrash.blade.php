@extends('layouts.page.master')

@section('customstyle') 
<link href="/css/imageupload.css" rel="stylesheet">
@endsection

@section('pagecontent')
  <div class='row'>
      <div class='col-md-12'>
          <!-- Box -->
          <div class="box box-primary">
              <div class='row'>
                <div class='col-lg-12 col-md-12 col-xs-12 col-sm-12'>
                  <div>
                    <div class="modal-body">

                      <div class="box-header">
                        <h3 class="box-title">Read Mail</h3>                
                      </div><!-- /.box-header -->
                      <div class='row'>
                        <div class='col-lg-3 col-md-3 col-xs-3 col-sm-3'>
                          <div>
                            <img class="img-circle" src="/p/user.gif" alt="Admin" style="max-width:100%;max-height:100%;">
                          </div>
                        </div>
                        <div class='col-lg-9 col-md-9 col-xs-9 col-sm-9 no-padding'>
                          <div class="box-header with-border">
                              <h3 class="box-title">{!!$mail->fromUser->username!!}</h3>
                              <h5>{!!$mail->fromUser->getLocation()!!}</h5>
                              <h5>{!!$mail->fromUser->getWorkEdu()!!}</h5>
                          </div>
                          <div class="box-body">
                              <h5>Age: {!!$mail->fromUser->getAge()!!} years</h5>
                              <h5>Apperence: {!!$mail->fromUser->getAppearance()!!} </h5>
                              <h5>Status: {!!$mail->fromUser->maritalstatus!!} </h5>                        
                          </div>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="txtSendMailSubject" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">Received</label>
                        <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                          <span id="lblMailDate">{!!$mail->receivedAt()!!}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="txtSendMailSubject" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">Subject</label>
                        <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                          <span id="lblMailSubject">{!!$mail->subject!!}</span>
                        </div>
                      </div>
                      <div>
                        <div class="col-sm-12">                          
                          <textarea rows="12" class="form-control mail-body" readonly>{!!$mail->body!!}</textarea>
                        </div>
                      </div>
                      <input id="hdnSendMailToId" name="hdnSendMailToId" type="hidden">
                      <input id="hdnSendMailToName" name="hdnSendMailToName" type="hidden">
                    </div>                    
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class='col-lg-9 col-md-9 col-xs-9 col-sm-9'>
                  @if ($mail->touser_id == Auth::user()->id && $mail->touser_status == 1)
                    <a name="linkDeleteMessage" title="restore" href="/message/restore/{!!common::getEncrypt($mail->id)!!}">
                      <img src="/img/restore.png" title="restore" style="width:16px;height:16px;border:0;"> Move to inbox
                    </a>
                    <a class="text-nowrap" name="linkDeleteMessage" title="Delete Permenatly" href="/message/trash/delete/{!!common::getEncrypt($mail->id)!!}">
                      <img src="/img/trashbin.png" title="Delete Permenatly" style="width:16px;height:16px;border:0;"> Delete Permenatly
                    </a>
                  @endif
                  &nbsp;&nbsp;
                  @if ($mail->touser_status == 1)
                    <a class="text-nowrap" href="{{ URL::previous() }}" class="small-box-footer"> <i class="fa fa-arrow-circle-left"></i> go back</a>
                  @else
                    <a class="text-nowrap" href="/message/trash" class="small-box-footer"> <i class="fa fa-arrow-circle-left"></i> go back</a>
                  @endif
                </div>
                <div class='col-lg-3 col-md-3 col-xs-3 col-sm-3'>
                  
                </div>                  
              </div><!-- /.box-footer-->
          </div><!-- /.box -->
      </div><!-- /.col -->
  </div><!-- /.row -->

  <style type="text/css">

  .mail-body {
    background-color: #fff !important;
    padding: 10px;
    border: 1px solid #f4f4f4;
    margin-bottom: 10px;
}

    textarea.form-control {
        height: auto !important;
    }
    
    
    .modal-body {
        padding: 15px;
    }

  </style>
  <div id="popupSendMail" class="popup">    
    <div class="container-fluid demo-wrapper">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Compose Reply</h3>
        </div>
        <div class="modal-content">
          <div class="modal-body">
            {!! Form::open(array('id'=>'frmReplyMail','url'=>'message/send', 'class'=>'form-horizontal', 'role'=>'form')) !!}
              <div class="form-group">
                <label for="inputTo" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">To</label>
                <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                  <span id="lblReplyMailTo">{!!$mail->fromUser->username!!}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="txtReplyMailSubject" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">Subject</label>
                <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                  <input type="text" value="Re: {!!$mail->subject!!}" placeholder="subject" id="txtReplyMailSubject" name="txtReplyMailSubject" class="form-control">
                </div>
              </div>
              <div class="form-group">

                <label for="txtReplyMailBody" class="col-sm-12">Message</label>
                <div class="col-sm-12"><textarea rows="12" id="txtReplyMailBody" name="txtReplyMailBody" class="form-control"></textarea></div>
              </div>
              <input id="hdnReplyMailToId" name="hdnReplyMailToId" type="hidden" value="{!!common::getEncrypt($mail->id)!!}">              
            {!! Form::close() !!}
          </div>
          <div class="modal-footer">
            <button id="btnReplyMailCancel" data-dismiss="modal" class="btn btn-default pull-left" type="button">Cancel</button> 

            <button id="btnReplyMailSave" class="btn btn-warning pull-left display-hidden" type="button">Save Draft</button>
            <button id="btnReplyMailSend" class="btn btn-primary " type="submit">Send <i class="fa fa-arrow-circle-right fa-lg"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('customscripts') 
<script src="/js/popup.js"></script>
<script src="/js/online.js"></script>
@endsection