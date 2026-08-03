<div class="chat-box d-flex flex-column" style="height: 80vh;" wire:poll.3s="loadMessages">
    {{-- لیست پیام‌ها --}}
    <div class="messages flex-grow-1 overflow-auto p-3 border rounded">
        @foreach($messages as $msg)
            <div class="mb-2 {{ $msg->sender_id == Auth::id() ? 'text-end' : 'text-start' }}">
                <div class="d-inline-block p-2 rounded 
                    {{ $msg->sender_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }}">
                    <strong>{{ $msg->sender->name }}</strong><br>
                    {{ $msg->message }}
                </div>
                <div class="small text-muted">
                    {{ $msg->created_at->diffForHumans() }}
                </div>  
            </div>
        @endforeach
    </div>

    {{-- فرم ارسال پیام --}}
    <form wire:submit.prevent="sendMessage" class="d-flex mt-2">
        <input type="text" wire:model="newMessage" class="form-control me-2" placeholder="پیام خود را بنویسید...">
        <button class="btn btn-success">ارسال</button>
    </form>
</div>
