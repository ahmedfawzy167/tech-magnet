@extends('layouts.master')

@section('page-title')
  {{__('admin.Settings')}}
@endsection

@section('page-content')
    <div class="row">
        <div class="card">
         <div class="card-body">
            <h1 class="text-center bg-dark text-light"><i class="fa-solid fa-gear"></i> {{__('admin.Configuration Settings')}}</h1>
              <a href="{{route('settings.create')}}" class="btn btn-primary">{{__('admin.Add New Setting')}}</a>
                <table class="table table-hover table-bordered mt-2" id="data-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">{{__('admin.Logo')}}</th>
                            <th class="text-center">{{__('admin.Email')}}</th>
                            <th class="text-center">{{__('admin.Phone')}}</th>
                            <th class="text-center">{{__('admin.Location')}}</th>
                            <th class="text-center">{{__('admin.Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                        <tr>
                            <td class="text-center"><img src="{{asset('storage/'.$setting->logo)}}" width="100px"></td>
                            <td class="text-center">{{$setting->email}}</td>
                            <td class="text-center">{{$setting->phone}}</td>
                            <td class="text-center">{{$setting->location}}</td>
                            <td class="text-center">
                                <a href="{{ route('settings.edit', $setting->id) }}"><i class="fa-solid fa-file-signature text-success"></i></a>
                                <a href="#" class="btn-delete" data-url="{{ route('settings.destroy', $setting->id) }}">
                                    <i class="fa-solid fa-trash text-danger"></i>
                                </a>
                                <form action="{{ route('settings.destroy', $setting->id) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    </div>


@endsection
