<div class="mb-3">
    <label class="form-label">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    
    <div class="dropzone-wrapper">
        <div id="dropzone-{{ $name }}" class="dropzone">
            <div class="dz-message needsclick">
                <i class="bi bi-cloud-upload" style="font-size: 3rem; color: #667eea;"></i>
                <h5 class="mt-2">Drop images here or click to upload</h5>
                <span class="text-muted">
                    Maximum {{ $maxFiles }} files, {{ $maxFilesize }}MB each
                </span>
            </div>
        </div>
        
        <!-- Hidden input to store uploaded file paths -->
        <input type="hidden" name="{{ $name }}" id="{{ $name }}-input" value="">
    </div>
    
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
    @push('css')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        .dropzone {
            border: 2px dashed #667eea;
            border-radius: 8px;
            background: #f8f9fa;
            padding: 20px;
            transition: all 0.3s ease;
            min-height: 200px;
            cursor: pointer;
        }
        
        .dropzone:hover {
            border-color: #764ba2;
            background: #f0f0f5;
        }
        
        .dropzone .dz-message {
            text-align: center;
            margin: 2rem 0;
            pointer-events: none;
        }
        
        .dropzone.dz-drag-hover {
            border-color: #764ba2;
            background: #e8e8f5;
        }
        
        .dropzone .dz-preview .dz-image {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .dropzone .dz-preview .dz-remove {
            color: #dc3545;
            text-decoration: none;
            font-size: 12px;
        }
        
        .dropzone .dz-preview .dz-remove:hover {
            color: #bd2130;
            text-decoration: underline;
        }
        
        .dropzone .dz-preview.dz-success .dz-success-mark,
        .dropzone .dz-preview.dz-error .dz-error-mark {
            display: block;
        }
        
        .dropzone .dz-preview .dz-progress {
            height: 4px;
            border-radius: 2px;
        }
        
        .dropzone .dz-preview .dz-progress .dz-upload {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
    @endpush
    
    @push('scripts')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="{{ asset('assets/js/custom/dropzone-handler.js') }}"></script>
    @endpush
@endonce

@push('scripts')
<script>
    (function() {
        // Prevent multiple initializations
        if (document.getElementById('dropzone-{{ $name }}').classList.contains('dz-initialized')) {
            return;
        }
        
        const uploadedPaths{{ Str::camel($name) }} = [];
        const existingFiles{{ Str::camel($name) }} = @json($existingFiles ?? []);
        
        // Initialize Dropzone
        const dropzone{{ Str::camel($name) }} = new DropzoneHandler('#dropzone-{{ $name }}', {
            uploadUrl: '{{ $uploadUrl }}',
            maxFiles: {{ $maxFiles }},
            maxFilesize: {{ $maxFilesize }},
            acceptedFiles: 'image/*',
            autoProcessQueue: true,
            clickable: true,
            
            onSuccess: (file, response) => {
                // Store the uploaded file path
                if (response.path) {
                    uploadedPaths{{ Str::camel($name) }}.push(response.path);
                    updateHiddenInput{{ Str::camel($name) }}();
                }
            },
            
            onRemovedFile: (file) => {
                // Remove the path from array if file is removed
                if (file.response && file.response.path) {
                    const index = uploadedPaths{{ Str::camel($name) }}.indexOf(file.response.path);
                    if (index > -1) {
                        uploadedPaths{{ Str::camel($name) }}.splice(index, 1);
                        updateHiddenInput{{ Str::camel($name) }}();
                    }
                }
                // Handle existing files removal
                if (file.existingPath) {
                    const index = uploadedPaths{{ Str::camel($name) }}.indexOf(file.existingPath);
                    if (index > -1) {
                        uploadedPaths{{ Str::camel($name) }}.splice(index, 1);
                        updateHiddenInput{{ Str::camel($name) }}();
                    }
                }
            },
            
            onError: (file, errorMessage) => {
                console.error('Upload error:', errorMessage);
                Toast?.fire({
                    icon: 'error',
                    title: typeof errorMessage === 'string' ? errorMessage : 'Upload failed'
                });
            }
        });
        
        // Get the actual Dropzone instance
        const dzInstance{{ Str::camel($name) }} = dropzone{{ Str::camel($name) }}.getInstance();
        
        // Add existing files after initialization
        if (existingFiles{{ Str::camel($name) }}.length > 0) {
            existingFiles{{ Str::camel($name) }}.forEach(filePath => {
                const mockFile = { 
                    name: filePath.split('/').pop(), 
                    size: 12345,
                    existingPath: filePath
                };
                
                // Display existing file with full storage URL
                dzInstance{{ Str::camel($name) }}.displayExistingFile(mockFile, '/storage/' + filePath);
                
                // Add to uploaded paths
                uploadedPaths{{ Str::camel($name) }}.push(filePath);
            });
            
            // Adjust maxFiles to account for existing files
            const fileCountOnServer = existingFiles{{ Str::camel($name) }}.length;
            dzInstance{{ Str::camel($name) }}.options.maxFiles = dzInstance{{ Str::camel($name) }}.options.maxFiles - fileCountOnServer;
        }
        
        // Initialize hidden input
        updateHiddenInput{{ Str::camel($name) }}();
        
        function updateHiddenInput{{ Str::camel($name) }}() {
            const input = document.getElementById('{{ $name }}-input');
            input.value = JSON.stringify(uploadedPaths{{ Str::camel($name) }});
        }
    })();
</script>
@endpush
