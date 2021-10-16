@extends('layouts.app', ['page' => __('Manage Invoice'), 'pageSlug' => 'client-create'])
@section('content')
    <div class="container mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow bg-secondary">
                    <div class="card-header bg-white">
                        <h5 class="title">{{ __('ADD New Client') }}</h5>
                    </div>

                    <form method="post" action="{{ route('clients.store') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('alerts.success')
                            <div class="row">
                                <div class="col-6 form-group{{ $errors->has('client_name') ? ' has-danger' : '' }}">
                                    <label>{{ __('Name') }}</label>
                                    <input type="text" name="client_name"
                                           class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Name') }}" value="{{old('client_name')}}">
                                    @include('alerts.feedback', ['field' => 'client_name'])
                                </div>

                                <div class="col-6 form-group{{ $errors->has('client_contact') ? ' has-danger' : '' }}">
                                    <label>{{ __('Contact') }}</label>
                                    <input type="text" name="client_contact"
                                           class="form-control form-control-alternative {{ $errors->has('client_contact') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Add Contact Number') }}" value="{{ old('client_contact')}}">
                                    @include('alerts.feedback', ['field' => 'client_contact'])
                                </div>

                                <div class="col-12 form-group{{ $errors->has('client_address') ? ' has-danger' : '' }}">
                                    <label>{{ __('Address') }}</label>
                                    <input type="text" name="client_address"
                                           class="form-control form-control-alternative{{ $errors->has('client_address') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('Address') }}" value="{{old('client_address')}}">
                                    @include('alerts.feedback', ['field' => 'client_address'])
                                </div>

                                <div class="col-8 form-group{{ $errors->has('client_email') ? ' has-danger' : '' }}">
                                    <label>{{ __('E-mail') }}</label>
                                    <input type="email" name="client_email"
                                           class="form-control form-control-alternative {{ $errors->has('client_email') ? ' is-invalid' : '' }}"
                                           placeholder="{{ __('E-mail') }}" value="{{old('client_email')}}">
                                    @include('alerts.feedback', ['field' => 'client_email'])
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-6 form-group{{ $errors->has('representative_name') ? ' has-danger' : '' }}">
                                        <label>{{ __('Representative Name') }}</label>
                                        <input type="text" name="representative_name"
                                               class="form-control form-control-alternative {{ $errors->has('representative_name') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Add Representative Name') }}" value="{{ old('representative_name')}}">
                                        @include('alerts.feedback', ['field' => 'contact'])
                                    </div>
                                    <div class="col-6 form-group{{ $errors->has('representative_contact') ? ' has-danger' : '' }}">
                                        <label>{{ __('Representative Contact') }}</label>
                                        <input type="text" name="representative_contact"
                                               class="form-control form-control-alternative {{ $errors->has('representative_contact') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Add Representative Contact') }}" value="{{ old('representative_contact')}}">
                                        @include('alerts.feedback', ['field' => 'representative_contact'])
                                    </div>
                                    <div class="col-12 form-group{{ $errors->has('client_other_info') ? ' has-danger' : '' }}">
                                        <label>{{ __('Client Other Info') }}</label>
                                        <input type="text" name="client_other_info"
                                               class="form-control form-control-alternative {{ $errors->has('client_other_info') ? ' is-invalid' : '' }}"
                                               placeholder="{{ __('Add Client Other Info') }}" value="{{ old('client_other_info')}}">
                                        @include('alerts.feedback', ['field' => 'client_other_info'])
                                    </div>
                                </div>

                        </div>
                        <div class="text-center m-4">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection