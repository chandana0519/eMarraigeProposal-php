@extends('layouts.page.master')

@section('customstyle') 
<link href="css/imageupload.css" rel="stylesheet">
@endsection

@section('pagecontent')
  @foreach($content as $online)
    <div class='row'>                  
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">
                <div class='row'>                  
                  <div class='col-lg-3 col-md-3 col-xs-3 col-sm-3'>
                    <div>
                      <img class="img-circle" src="/p/{!!$online->user->profileimage!!}" alt="{!!$online->user->username!!}" style="max-width:100%;max-height:100%;">
                    </div>
                  </div>
                  <div class='col-lg-9 col-md-9 col-xs-9 col-sm-9 no-padding'>
                    <div class="box-header with-border">
                        <h3 class="box-title">{!!$online->user->username!!}</h3>
                        <h5>{!!$online->user->getLocation()!!}</h5>
                        <h5>{!!$online->user->getWorkEdu()!!}</h5>
                    </div>
                    <div class="box-body">
                        <h5>Age: {!!$online->user->getAge()!!} years</h5>
                        <h5>Apperence: {!!$online->user->getAppearance()!!} </h5>
                        <h5>Status: {!!$online->user->maritalstatus!!} </h5>                        
                    </div>
                  </div>
                </div>                
                <div class="box-footer">
                  <div class='col-lg-9 col-md-9 col-xs-9 col-sm-9'>
                    <a href="#" class="small-box-footer IMChat" data-params='{"id":"{!!$online->user->id!!}","name":"{!!$online->user->username!!}"}'> <i class="fa fa-wechat"></i> Chat</a>
                    &nbsp;&nbsp;<a name="linkOnlineMail" href="#" class="small-box-footer" data-params='{"id":"{!!$online->user->id!!}","name":"{!!$online->user->username!!}"}'> <i class="glyphicon glyphicon-envelope"></i> Mail</a>
                    &nbsp;&nbsp;<a name="linkOnlineInterest" href="#" class="small-box-footer" data-params='{"id":"{!!$online->user->id!!}","name":"{!!$online->user->username!!}"}'> <i class="fa fa-thumbs-up"></i> Interest</a>
                  </div>
                  <div class='col-lg-3 col-md-3 col-xs-3 col-sm-3'>
                    <a href="/profile/{!!$online->user->id!!}" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i> View Profile</a>
                  </div>                  
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div id="divClientMessage{!!$online->user->id!!}" class="alert display-hidden">
            <button type="button" class="close">&times;</button>
            test
        </div>
    </div><!-- /.row -->
  @endforeach
  <div style="text-align:center;width: 60%;display: inline-block;">
    <div style="display: inline-block;">page {!! $content->currentPage() !!} of {!! $content->lastPage() !!}</div>
  </div>
  <div class="pagination pagination-sm no-margin pull-right clearfix">
    {!! $content->render() !!}
  </div>
                

  <style type="text/css">

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
          <h3 class="panel-title">Compose Mail</h3>
        </div>
        <div class="modal-content">
          <div class="modal-body">
            {!! Form::open(array('id'=>'frmSendMail','url'=>'mail/send', 'class'=>'form-horizontal', 'role'=>'form')) !!}
              <div class="form-group">
                <label for="inputTo" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">To</label>
                <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                  <span id="lblSendMailTo"></span>
                </div>
              </div>
              <div class="form-group">
                <label for="txtSendMailSubject" class="col-lg-2 col-md-2 col-xs-2 col-sm-2">Subject</label>
                <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10"><input type="text" placeholder="subject" id="txtSendMailSubject" name="txtSendMailSubject" class="form-control"></div>
              </div>
              <div class="form-group">

                <label for="txtSendMailBody" class="col-sm-12">Message</label>
                <div class="col-sm-12"><textarea rows="12" id="txtSendMailBody" name="txtSendMailBody" class="form-control"></textarea></div>
              </div>
              <input id="hdnSendMailToId" name="hdnSendMailToId" type="hidden">
              <input id="hdnSendMailToName" name="hdnSendMailToName" type="hidden">
            {!! Form::close() !!}
          </div>
          <div class="modal-footer">
            <button id="btnSendMailCancel" data-dismiss="modal" class="btn btn-default pull-left" type="button">Cancel</button> 

            <button id="btnSendMailSave" class="btn btn-warning pull-left display-hidden" type="button">Save Draft</button>
            <button id="btnSendMailSend" class="btn btn-primary " type="submit">Send <i class="fa fa-arrow-circle-right fa-lg"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="ChatContainer" class="ChatContainer">
    <div tabindex="-1" class="minimize-block">
    <div class="minimize minimize-close display-hidden">
      <span class="minimize-text"></span>
    </div>
    <div class="minimize-list display-hidden">
      <ul class="minimize-user-list">       
      </ul>
      <li  id="minimize-user" class="minimize-user display-hidden">
        <span class="minimize-user-text display-hidden">Chat from : <span class="minimize-user-name"></span></span>
        <span class="minimize-close-btn">x</span>
      </li>
    </div>
    </div>
    <div id="chatbox-hidden" class="msg_box display-hidden">
      <div class="msg_head">&nbsp;
        <div class="chatboxtitle"></div>
        <div class="chatbox-options">
          <a href="#" class="chatbox-minimize">-</a>
          <a href="#" class="chatbox-close">X</a>
        </div>    
      </div>
      <div class="msg_wrap">
        <div class="msg_body">
          <div class="msg_push"></div>
        </div>
        <div class="msg_footer">
          <div class="msg_input"><textarea class="chatboxtextarea" rows="2"></textarea></div>         
        </div>
      </div>
    </div>
  </div>    
@endsection

@section('customscripts') 
<script src="/js/jquery.cookie.js"></script>
<script src="/js/chat.js"></script>
<script src="/js/popup.js"></script>
<script src="/js/online.js"></script>
<script src="http://52.62.90.124:3000/socket.io/socket.io.js"></script>
@endsection