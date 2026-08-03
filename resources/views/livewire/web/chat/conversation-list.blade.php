@php
    use Illuminate\Support\Str;
@endphp

<div class="chat-box d-flex flex-column" style="height:auto;" wire:poll.5s="loadListMessages">
    @if(collect($conversations)->isEmpty())
        <div class="alert alert-info">
            هنوز هیچ گفتگویی شروع نکردی.
        </div>
    @else
        <div class="list-group">
            @foreach($conversations as $conv)
                @php
                    $otherUser = $conv->userOne->id == auth()->id()
                        ? $conv->userTwo
                        : $conv->userOne;
                    $lastMessage = $conv->messages->first();
                @endphp

                <a href="{{ route('chat.show', $conv->id) }}" 
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                    <div class="d-flex align-items-center">
                        <img src="{{ $otherUser->image ? url('images/user/smallImages/'.$otherUser->image) : asset('images/no-image.jpg') }}"
                             alt="user"
                             class="rounded-circle me-3"
                             width="50" height="50" style="object-fit:cover;">
                        <div>
                            <h6 class="mb-1">{{ $otherUser?->name }}</h6>
                            <small class="text-muted">
                                {{ $lastMessage ? Str::limit($lastMessage->message, 30) : 'بدون پیام' }}
                            </small>
                        </div>
                    </div>

                    <small class="text-muted">
                        {{ $lastMessage ? $lastMessage->created_at->timezone('Asia/Tehran')->format('Y-m-d H:i') : '' }}
                    </small>
                </a>
            @endforeach
        </div>
    @endif
   <div>
    {{-- دکمه شروع گفتگو --}}
    <button class="btn btn-success" wire:click="newConversation">شروع گفتگو جدید</button>

    {{-- فرم انتخاب کاربر --}}
    @if($showNewConversationForm)
        <div class="mt-3 card card-body">
            <h6>انتخاب کاربر برای شروع گفتگو:</h6>
            <select class="form-control mb-2" wire:model="selectedUser">
                <option value="">-- انتخاب کاربر --</option>
                @foreach($users as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary" wire:click="startConversation">شروع</button>
            <button class="btn btn-secondary" wire:click="$set('showNewConversationForm', false)">انصراف</button>
        </div>
    @endif
</div>

</div>
