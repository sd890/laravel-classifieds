@extends('web.layout.site')
@section('content')
    <main class="main-content">
    @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <livewire:web.public-ads>
                </div>
            </div>
        </div>
    </main>
@endsection
