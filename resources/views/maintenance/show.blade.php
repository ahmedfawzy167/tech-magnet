@extends('layouts.503')
@section('page-title')
  503
@endsection
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
    }
    .maintenance-image {
        margin-top: 20px;
        margin-left: 20px;
    }
</style>

@section('page-content')
    <div>
      <h3 class="text-center">{{$message}}</h3>
      <img src="{{asset('assets/img/maintenance-mode.png')}}" width="600px" class="maintenance-image">
    </div>
@endsection
