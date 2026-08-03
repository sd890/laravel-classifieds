<div>
    {{-- پنمایش عکس‌ها--}}
    <div class="mt-3 d-flex flex-wrap">
        @if($photos)
            @foreach($photos as $photo)
                <div class="position-relative me-2 mb-2">
                    <img src="{{asset('storage/'.$photo->image)}}" 
                         width="120" 
                         class="rounded shadow">
                    {{-- دکمه حذف --}}
                    <button type="button" 
                            class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            wire:click="removePhoto({{ $photo->id }})">
                        ✕
                    </button>
                </div>
            @endforeach
        @endif
    </div>
</div>
