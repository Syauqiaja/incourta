@props([
    'name',
    'label',
    'required' => false,
    'helpText' => null,
])

<div class="form-group">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <input 
        id="{{ $name }}"
        name="{{ $name }}"
        type="file"
        class="form-control @error($name) is-invalid @enderror"
        accept="image/*"
        @if($required) required @endif
        {{ $attributes }}
        onchange="previewImage(this, '{{ $name }}_preview')"
    >
    
    @if($helpText)
        <small class="form-text text-muted d-block mt-1">{{ $helpText }}</small>
    @endif
    
    <!-- Image Preview -->
    <div id="{{ $name }}_preview" class="mt-2" style="display: none;">
        <img src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
    </div>
    
    @error($name)
        <span class="invalid-feedback d-block">
            {{ $message }}
        </span>
    @enderror
</div>

@once
@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const img = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
            img.src = '';
        }
    }
</script>
@endpush
@endonce
