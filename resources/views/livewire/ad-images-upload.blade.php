<div>
    <form wire:submit.prevent="save">
        <input type="file" wire:model="photos" multiple>

        @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-success mt-2">ذخیره عکس‌ها</button>
    </form>

    {{-- پیش‌نمایش عکس‌ها --}}
    <div class="mt-3 d-flex flex-wrap">
        @if($photos)
            @foreach($photos as $index => $photo)
                <div class="position-relative me-2 mb-2">
                    <img src="{{ $photo->temporaryUrl() }}" 
                         width="120" 
                         class="rounded shadow">
                    {{-- دکمه حذف --}}
                    <button type="button" 
                            class="btn btn-sm btn-danger position-absolute top-0 end-0"
                            wire:click="removePhoto({{ $index }})">
                        ✕
                    </button>
                </div>
            @endforeach
        @endif
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif
</div>
