<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    @if($type === 'password')
        <div class="position-relative">
            <input 
                type="password"
                class="form-control @error($name) is-invalid @enderror"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ $value ?? old($name) }}"
                @if($placeholder) placeholder="{{ $placeholder }}" @endif
                @if($required) required @endif
                @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                @if($autofocus) autofocus @endif
                {{ $attributes }}
            >
            <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y text-muted" 
                    onclick="togglePasswordField('{{ $name }}')" 
                    style="z-index: 10; text-decoration: none;">
                <i class="bi bi-eye-slash" id="{{ $name }}-icon"></i>
            </button>
        </div>
    @elseif($type === 'textarea')
        <textarea 
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            rows="4"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            {{ $attributes }}
        >{{ $value ?? old($name) }}</textarea>
    @else
        <input 
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value ?? old($name) }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if($autofocus) autofocus @endif
            {{ $attributes }}
        >
    @endif
    
    @if($helpText)
        <small class="form-text text-muted">{{ $helpText }}</small>
    @endif
    
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

@once
    @push('scripts')
    <script>
        function togglePasswordField(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>
    @endpush
@endonce
