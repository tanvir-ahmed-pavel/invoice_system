@extends('layouts.app', ['page' => __('Show Invoice'), 'pageSlug' => 'invoices-show'])
@section('content')
    <invoice-show-component :invoice="{{json_encode($invoice)}}"></invoice-show-component>
@endsection

@push('app-js')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
