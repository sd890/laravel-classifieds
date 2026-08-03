<div class="mb-2 {{ $message->sender_id == auth()->id() ? 'text-end' : 'text-start' }}">
    <div class="p-2 d-inline-block rounded 
        {{ $message->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
        {{ $message->message }}
    </div>
    <br>
    <small class="text-muted">
        {{ $message->created_at->timezone('Asia/Tehran')->format('H:i Y/m/d') }}
    </small>
</div>
