@extends('web.profile.layout.site')

@section('content')
<div class="container">
    <livewire:web.chat.conversations :conversationId="$conversationId"/>
</div>
@endsection

