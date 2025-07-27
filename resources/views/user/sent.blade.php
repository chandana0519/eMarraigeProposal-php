@extends('layouts.page.master')

@section('customstyle') 
<link href="css/imageupload.css" rel="stylesheet">
@endsection
@section('pagecontent')      
    <div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box box-primary">

                <div class="box-header">
                  <h3 class="box-title">Sent</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th style="width:100px;">User</th>
                      <th style="width:110px;">Date</th>
                      <th>Subject</th>
                      <th style="width:54px;"></th>
                    </tr>
                    @foreach($content as $mail)  
                      <tr>
                        <td>{!!$mail->fromuser_name!!}</td>
                        <td>{!!$mail->receivedAt()!!}</td>
                        <td>{!!$mail->subject!!}</td>
                        <td>
                          <a title="read mail" href="/message/read/{!!common::getEncrypt($mail->id)!!}">
                            <img src="/img/view.png" title="read mail" style="width:16px;height:16px;border:0;">
                          </a>
                          <a title="delete" href="/message/read/{!!common::getEncrypt($mail->id)!!}">
                            <img src="/img/delete.png" alt="delete" style="width:16px;height:16px;border:0;">
                          </a>
                        </td>
                      </tr>                    
                    @endforeach                    
                  </table>
                </div><!-- /.box-body -->                 
                <div class="box-footer clearfix">
                  <div style="text-align:center;width: 60%;display: inline-block;">
                    <div style="display: inline-block;">page {!! $content->currentPage() !!} of {!! $content->lastPage() !!}</div>
                  </div>
                  <div class="pagination pagination-sm no-margin pull-right">                    
                    {!! $content->render() !!}
                  </div>                  
                </div><!-- /.box-footer-->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row --> 
@endsection

@section('customscripts') 
<script src="/js/section.js"></script>
<script src="/js/profile.js"></script>
<script src="js/imageupload.js"></script>
<script src="js/dmuploader.min.js"></script>
<script src="/js/popup.js"></script>
@endsection