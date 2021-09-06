@extends('layouts.app', ['page' => __('Manage Driver'), 'pageSlug' => 'drivers-manager'])
@section('content')

@endsection
@push('app-js')

    <script src="{{ mix('js/app.js') }}"></script>
@endpush