/**
 * Reusable Dropzone Handler
 * Usage:
 * new DropzoneHandler('#dropzone-element', {
 *     maxFiles: 5,
 *     maxFilesize: 2,
 *     acceptedFiles: 'image/*',
 *     uploadUrl: '/upload-url'
 * });
 */

// Disable auto discover globally
if (typeof Dropzone !== 'undefined') {
    Dropzone.autoDiscover = false;
}

class DropzoneHandler {
    constructor(selector, options = {}) {
        this.element = document.querySelector(selector);
        if (!this.element) {
            console.error(`Dropzone eloptions.url || ement not found: ${selector}`);
            return;
        }

        // Check if Dropzone is already attached
        if (this.element.dropzone) {
            console.warn('Dropzone already attached to this element. Destroying old instance.');
            this.element.dropzone.destroy();
        }

        this.options = {
            url: options.uploadUrl || '/upload',
            maxFiles: options.maxFiles || 5,
            maxFilesize: options.maxFilesize || 2, // MB
            acceptedFiles: options.acceptedFiles || 'image/*',
            addRemoveLinks: true,
            dictDefaultMessage: options.dictDefaultMessage || 'Drop files here or click to upload',
            dictRemoveFile: 'Remove',
            dictCancelUpload: 'Cancel',
            dictMaxFilesExceeded: 'You can only upload up to ' + (options.maxFiles || 5) + ' files',
            thumbnailWidth: 150,
            thumbnailHeight: 150,
            autoProcessQueue: options.autoProcessQueue !== undefined ? options.autoProcessQueue : false,
            uploadMultiple: options.uploadMultiple || false,
            parallelUploads: options.parallelUploads || 1,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            ...options.dropzoneOptions
        };

        this.callbacks = {
            onSuccess: options.onSuccess || null,
            onError: options.onError || null,
            onAddedFile: options.onAddedFile || null,
            onRemovedFile: options.onRemovedFile || null,
            onComplete: options.onComplete || null,
            onSending: options.onSending || null
        };

        this.uploadedFiles = [];
        this.init();
    }

    init() {
        // Check if Dropzone is loaded
        if (typeof Dropzone === 'undefined') {
            console.error('Dropzone library not found. Please include Dropzone.js');
            return;
        }

        // Add clickable option to make the entire dropzone clickable
        this.options.clickable = true;

        // Initialize Dropzone
        this.dropzone = new Dropzone(this.element, this.options);

        // Bind events
        this.bindEvents();
        
        // Ensure the dropzone is clickable
        this.element.style.cursor = 'pointer';
    }

    bindEvents() {
        // File added
        this.dropzone.on('addedfile', (file) => {
            console.log('File added:', file.name);
            if (this.callbacks.onAddedFile) {
                this.callbacks.onAddedFile(file, this.dropzone);
            }
        });

        // File removed
        this.dropzone.on('removedfile', (file) => {
            console.log('File removed:', file.name);
            
            // Remove from uploaded files array
            const index = this.uploadedFiles.findIndex(f => f.name === file.name);
            if (index > -1) {
                this.uploadedFiles.splice(index, 1);
            }

            if (this.callbacks.onRemovedFile) {
                this.callbacks.onRemovedFile(file, this.dropzone);
            }
        });

        // Upload success
        this.dropzone.on('success', (file, response) => {
            console.log('Upload success:', file.name, response);
            
            // Store uploaded file info
            this.uploadedFiles.push({
                name: file.name,
                size: file.size,
                type: file.type,
                response: response
            });

            if (this.callbacks.onSuccess) {
                this.callbacks.onSuccess(file, response, this.dropzone);
            }
        });

        // Upload error
        this.dropzone.on('error', (file, errorMessage, xhr) => {
            console.error('Upload error:', file.name, errorMessage);

            if (this.callbacks.onError) {
                this.callbacks.onError(file, errorMessage, xhr, this.dropzone);
            } else {
                // Default error handling
                Toast?.fire({
                    icon: 'error',
                    title: `Error uploading ${file.name}: ${errorMessage}`
                });
            }
        });

        // Before sending
        this.dropzone.on('sending', (file, xhr, formData) => {
            console.log('Sending file:', file.name);

            if (this.callbacks.onSending) {
                this.callbacks.onSending(file, xhr, formData, this.dropzone);
            }
        });

        // All uploads complete
        this.dropzone.on('complete', (file) => {
            if (this.callbacks.onComplete) {
                this.callbacks.onComplete(file, this.dropzone);
            }
        });

        // Max files exceeded
        this.dropzone.on('maxfilesexceeded', (file) => {
            this.dropzone.removeFile(file);
            Toast?.fire({
                icon: 'warning',
                title: `Maximum ${this.options.maxFiles} files allowed`
            });
        });
    }

    // Process queue manually
    processQueue() {
        if (this.dropzone.getQueuedFiles().length > 0) {
            this.dropzone.processQueue();
        }
    }

    // Remove all files
    removeAllFiles() {
        this.dropzone.removeAllFiles();
        this.uploadedFiles = [];
    }

    // Get uploaded files
    getUploadedFiles() {
        return this.uploadedFiles;
    }

    // Get Dropzone instance
    getInstance() {
        return this.dropzone;
    }

    // Check if files are ready
    hasFiles() {
        return this.dropzone.files.length > 0;
    }

    // Get files count
    getFilesCount() {
        return this.dropzone.files.length;
    }
}

// Export for use in modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = DropzoneHandler;
}
