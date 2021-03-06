@extends('layouts.app')

@section('title', $user->name . ' 的个人主页')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
    <div class="card ">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
      
  <div class="card-body">
    <a href="{{ route('users.followings', $user->id) }}">
      <strong id="following" class="stat">
        {{ count($user->followings) }}
      </strong>关注
    </a>
    <a href="{{ route('users.followers', $user->id) }}">
      <strong id="followers" class="stat">
        {{ count($user->followers) }}
      </strong>粉丝
    </a>
    <p>
     @if (Auth::check())
      @include('users._follow_form')
    @endif
  </p>
  </div>
      
   

  
  
      <div class="card-body">
        <h5><strong>注册于</strong></h5>
        <p>{{ $user->created_at->diffForHumans() }}</p>
        <hr>
      </div>

    </div>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div class="card ">
      <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }}</h1>
      </div>
    </div>
    <hr>

    {{-- 用户发布的内容 --}}
<div class="card ">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', null)) }}" href="{{ route('users.show', $user->id) }}">
              Ta 的话题
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
              Ta 的回复
            </a>
          </li>
        </ul>
        @if (if_query('tab', 'replies'))
          @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
        @else
          @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
        @endif
      </div>
    </div>

    </div>
</div>

 
@stop
