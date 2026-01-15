<div class="mb-3">
    <label class="form-label" for="{{ $name }}">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <select 
        class="form-select @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
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
    
    @if($helpText)
        <small class="form-text text-muted">{{ $helpText }}</small>
    @endif
    
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>
