@extends('layouts.app', ['page' => __('New Invoice'), 'pageSlug' => 'invoices-create'])
@section('content')
    <invoice-component></invoice-component>
@endsection
@push('app-js')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
