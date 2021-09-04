@extends('layouts.app', ['page' => __('New Driver'), 'pageSlug' => 'drivers-create'])
@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="title">{{ __('ADD New Driver') }}</h5>
                    </div>

                    <form method="post" action="{{ route('drivers.store') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Name') }}" value="{{old('name')}}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('contact') ? ' has-danger' : '' }}">
                                <label>{{ __('Contact') }}</label>
                                <input type="text" name="contact"
                                       class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Add Contact Number') }}" value="{{ old('contact')}}">
                                @include('alerts.feedback', ['field' => 'contact'])
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
