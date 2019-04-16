@extends('layouts.app')

@section('content')
  @if (Auth::check())
    <div class="row">
      <div class="col-md-8">
        
        <h4>TIMELINE</h4>
        
        <hr>
        @if ($feed_items->count() > 0)
          <ul class="list-unstyled">
          @foreach ($feed_items as $topics)
            <li class="media mt-4 mb-4">
              <!--<a href="{{ route('users.show', Auth::user()->id )}}">-->
                <img src="{{ Auth::user()->avatar }}"  class="mr-3 avatar"/>
              <!--</a>-->
        <div class="media-body">
          <h5 class="mt-0 mb-1"><!--{{ Auth::user()->name }} --><small> / {{ $topics->created_at->diffForHumans() }}</small></h5>
         {{ $topics->content }}
        </div>

  @can('destroy', $topics)
    <form action="{{ route('topics.destroy', $topics->id) }}" method="POST" onsubmit="return confirm('您确定要删除本条微博吗？');">
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type="submit" class="btn btn-sm btn-danger">删除</button>
    </form>
  @endcan
</li>
        @endforeach
          </ul>
  <div class="mt-5">
    {!! $feed_items->render() !!}
  </div>
@else
  <p>没有数据！</p>
@endif
      </div>
    </div>
  @else
    <div class="jumbotron">
      <h1>Hello Laravel</h1>
      <p class="lead">
        你现在所看到的是 <a href="https://laravel-china.org/courses/laravel-essential-training">?</a> 的示例项目主页。
      </p>
    </div>
  @endif
@stop

<!--
@extends('layouts.app')
@section('title', $user->name)




@section('content')

  <div class="row">

    <div class="col-md-3 col-sm-12 col-xs-12 " aria-label="Right Align">
      <div class="card ">
        <div class="card-body">
          <div class="media">
            <div align="center">
              
                <img class="thumbnail img-fluid" src="{{ Auth::user()->avatar }}" width="300px" height="300px">
              
              <hr>
              <div class="text-center">
                
                {{ Auth::user()->name }}
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    


  <div class="col-md-6">
    <div class="card ">
      
    </div>
    <hr>

    {{-- 用户发布的内容 --}}
    <div class="card ">
      <div class="card-body">
        暂无数据 ~_~
      </div>
      <div>
       
      </div>
    </div>
  
  </div>

  <div class="col-md-3">
    <div class="card">
    <div class="card-body">
      推荐用户
      <hr>
    </div>
    </div>
  </div>
@stop
<-->