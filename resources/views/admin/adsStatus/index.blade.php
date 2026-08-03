@extends('admin.layout.master')
@section('content')

    <main class="main-content">
        @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                  
                    <livewire:admin.ads-satus.ads-status/>
                </div>
            </div>
        </div>
    </main>

@endsection