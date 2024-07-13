@extends('layouts.master')

@section('page-title')
   Activity Log
@endsection

@section('page-content')

<div class="d-flex justify-content-center align-items-center vh-60 mt-3">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title text-center bg-info text-white"><i class="fa-solid fa-eye"></i> Activity Log Details</h2>
      </div>
      <ul class="list-group list-group-flush">
        <h6 class="list-group-item">Name: {{$lastActivity->getExtraProperty('name')}}</h6>
        <h6 class="list-group-item">Description: {{$lastActivity->description}}</h6>
        <h6 class="list-group-item">Event: {{$lastActivity->event}} </h6>
        <h6 class="list-group-item">Causer: {{$lastActivity->causer}}</h6>
      </ul>
    </div>
  </div>
 
@endsection
