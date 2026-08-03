@extends('web.profile.layout.site')
@section('content')
    <main class="main-content">
    @include('admin.layout.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                 <livewire:web.show-ad-images :ad_id="$id"/>                 
                </div>
            </div>
        </div>
    </main>

   @endsection