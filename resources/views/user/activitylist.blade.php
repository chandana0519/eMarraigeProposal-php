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
                    @foreach ($content as $activity)
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/p/{{$activity->fromUser->profileimage}}" alt="User Avatar" style="max-width:100px;max-height:100px;"><span class="badge alert-danger badge-image">new</span>
                          <a class="users-list-name col-centered" href="/profile/{{$activity->fromUser->id}}">{{$activity->fromUser->username}}, {{$activity->fromUser->getAge()}}</a>
                          <span class="users-list-date">{{$activity->receivedAt()}}</span>
                        </div>                    
                    @endforeach
                  </div>
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
@endsection