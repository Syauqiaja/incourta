<div class="form-group">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    
    <select 
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-input form-select form-select-lg mb-3 @error($name) is-invalid @enderror"
        @if($required) required @endif
        {{ $attributes }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $optionValue => $optionLabel)
            <option 
                value="{{ $optionValue }}" 
                {{ (old($name, $value) == $optionValue) ? 'selected' : '' }}
            >
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    
    @error($name)
        <span class="error-message">
            {{ $message }}
        </span>
    @enderror
</div>
