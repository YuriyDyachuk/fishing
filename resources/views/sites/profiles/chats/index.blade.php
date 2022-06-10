@extends('sites.layouts.main')

@section('content')
    <div id="app">
        <div class="content-box profile-page dashboard-content" id="dashboard">
{{--            <example-component :chats='{{ json_encode($chats) }}'></example-component>--}}
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Custom scripts -->
{{--    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>--}}
@endpush