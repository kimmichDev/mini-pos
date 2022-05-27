<div class="mb-3 d-flex justify-content-center">
    <div selectPhotoContainer class="w-75 position-relative">
        @if (!is_null($photo))
            <img src="{{ $photo }}" class="w-100 mb-3 rounded">
            <br>
        @endif
        <p class="p-3 mb-0 border-1 border text-center rounded shadow" style="cursor: pointer" onclick="openInput()">
            Click
            to upload image</p>
    </div>
    @error('photo')
        <small class="small text-danger">{{ $message }}</small>
    @enderror
</div>
