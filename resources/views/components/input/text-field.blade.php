<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    
    @if($type === 'password')
        <div class="input-password-wrapper">
            <input 
                id="{{ $name }}"
                name="{{ $name }}"
                type="password"
                class="form-input @error($name) is-invalid @enderror"
                value="{{ $value ?? old($name) }}"
                @if($placeholder) placeholder="{{ $placeholder }}" @endif
                @if($required) required @endif
                @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                @if($autofocus) autofocus @endif
                {{ $attributes }}
            >
            <button type="button" class="password-toggle" onclick="togglePassword('{{ $name }}')">
                <svg class="eye-icon eye-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <svg class="eye-icon eye-closed" style="display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                </svg>
            </button>
        </div>
    @else
        <input 
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            class="form-input @error($name) is-invalid @enderror"
            value="{{ $value ?? old($name) }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if($autofocus) autofocus @endif
            {{ $attributes }}
        >
    @endif
    
    @error($name)
        <span class="error-message">
            {{ $message }}
        </span>
    @enderror
</div>

@once
    @push('scripts')
    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const wrapper = input.closest('.input-password-wrapper');
            const eyeOpen = wrapper.querySelector('.eye-open');
            const eyeClosed = wrapper.querySelector('.eye-closed');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
    @endpush
@endonce