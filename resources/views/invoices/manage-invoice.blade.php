@extends('layouts.app', ['page' => __('Manage Invoice'), 'pageSlug' => 'invoices-manage'])
@section('content')
    <invoice-manage-component></invoice-manage-component>
@endsection
@push('app-js')

<script src="{{ mix('js/app.js') }}"></script>
@endpush
