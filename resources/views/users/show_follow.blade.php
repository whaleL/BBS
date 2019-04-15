@extends('layouts.app')
@section('title', $title)

@section('content')
<div class="col-md-offset-2 col-md-8">
  <h1>{{ $title }}</h1>
  <ul class="users">
    @foreach ($users as $user)
      <li class="list-group-item" >
        <img class="card-img-limit" src="{{ $user->avatar }}" alt="{{ $user->name }}"/>
        <a href="{{ route('users.show', $user->id )}}" class="username">{{ $user->name }}</a>
      </li>
    @endforeach
  </ul>

  {!! $users->render() !!}
</div>
@stop