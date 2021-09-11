@extends('layouts.app', ['page' => __('Manage Invoice'), 'pageSlug' => 'client-create'])
@section('content')
    <div class="container mt--7">
        <div class="row">
            <div class="col ">
                <div class="card shadow bg-lighter">
                    <div class="card-header bg-lighter">
                        <h5 class="title">{{ __('ADD New Client') }}</h5>
                    </div>

                    <form method="#" action="#" autocomplete="off">
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

                            <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <label>{{ __('Address') }}</label>
                                <input type="text" name="address"
                                       class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Address') }}" value="{{old('address')}}">
                                @include('alerts.feedback', ['field' => 'address'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('E-mail') }}</label>
                                <input type="email" name="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('E-mail') }}" value="{{old('email')}}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <div class="form-group{{ $errors->has('contact') ? ' has-danger' : '' }}">
                                <label>{{ __('Contact') }}</label>
                                <input type="text" name="contact"
                                       class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('Add Contact Number') }}" value="{{ old('contact')}}">
                                @include('alerts.feedback', ['field' => 'contact'])
                            </div>
                        </div>
                        <div class="card-footer bg-lighter">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection