/**
 * ========================================
 * DROPZONE HANDLER - USAGE EXAMPLES
 * ========================================
 * 
 * This file contains examples of how to use the DropzoneHandler class
 * in different scenarios throughout your application.
 */

// ========================================
// EXAMPLE 1: Basic Usage with Component
// ========================================
// In your Blade template:
/*
<x-admin.image-upload
    name="product_images"
    label="Product Images"
    :maxFiles="10"
    :maxFilesize="5"
    helpText="Upload product photos"
/>
*/

// ========================================
// EXAMPLE 2: Manual Initialization
// ========================================
/*
<div id="my-dropzone" class="dropzone"></div>

<script>
    const myDropzone = new DropzoneHandler('#my-dropzone', {
        uploadUrl: '/admin/upload/image',
        maxFiles: 3,
        maxFilesize: 2,
        acceptedFiles: 'image/*',
        
        onSuccess: (file, response) => {
            console.log('Uploaded:', response.path);
        },
        
        onError: (file, error) => {
            console.error('Error:', error);
        }
    });
</script>
*/

// ========================================
// EXAMPLE 3: With Form Submission
// ========================================
/*
<form id="product-form">
    <input type="text" name="name" required>
    
    <div id="dropzone-images" class="dropzone"></div>
    <input type="hidden" name="images" id="images-input">
    
    <button type="submit">Submit</button>
</form>

<script>
    const uploadedImages = [];
    
    const dropzone = new DropzoneHandler('#dropzone-images', {
        uploadUrl: '/admin/upload/image',
        maxFiles: 5,
        autoProcessQueue: true,
        
        onSuccess: (file, response) => {
            uploadedImages.push(response.path);
            document.getElementById('images-input').value = JSON.stringify(uploadedImages);
        },
        
        onRemovedFile: (file) => {
            if (file.response && file.response.path) {
                const index = uploadedImages.indexOf(file.response.path);
                if (index > -1) {
                    uploadedImages.splice(index, 1);
                    document.getElementById('images-input').value = JSON.stringify(uploadedImages);
                }
            }
        }
    });
</script>
*/

// ========================================
// EXAMPLE 4: Manual Queue Processing
// ========================================
/*
const dropzone = new DropzoneHandler('#my-dropzone', {
    uploadUrl: '/admin/upload/image',
    autoProcessQueue: false, // Don't auto upload
    
    onAddedFile: (file) => {
        console.log('File added:', file.name);
    }
});

// Upload on button click
document.getElementById('upload-btn').addEventListener('click', () => {
    dropzone.processQueue();
});
*/

// ========================================
// EXAMPLE 5: With Custom Validation
// ========================================
/*
const dropzone = new DropzoneHandler('#dropzone-custom', {
    uploadUrl: '/admin/upload/image',
    maxFiles: 5,
    maxFilesize: 3,
    acceptedFiles: 'image/jpeg,image/png',
    
    onAddedFile: (file, dzInstance) => {
        // Custom validation
        if (file.size > 3 * 1024 * 1024) {
            Toast.fire({
                icon: 'error',
                title: 'File too large! Max 3MB'
            });
            dzInstance.removeFile(file);
            return;
        }
        
        console.log('File validated:', file.name);
    },
    
    onSending: (file, xhr, formData) => {
        // Add custom data to upload
        formData.append('category', 'products');
        formData.append('user_id', '123');
    },
    
    onSuccess: (file, response) => {
        Toast.fire({
            icon: 'success',
            title: 'Image uploaded successfully'
        });
    }
});
*/

// ========================================
// EXAMPLE 6: Multiple Dropzones on One Page
// ========================================
/*
// Logo upload
const logoDropzone = new DropzoneHandler('#dropzone-logo', {
    uploadUrl: '/admin/upload/image',
    maxFiles: 1,
    maxFilesize: 1,
    dictDefaultMessage: 'Upload company logo',
    
    onSuccess: (file, response) => {
        document.getElementById('logo-path').value = response.path;
    }
});

// Gallery upload
const galleryDropzone = new DropzoneHandler('#dropzone-gallery', {
    uploadUrl: '/admin/upload/image',
    maxFiles: 10,
    maxFilesize: 5,
    dictDefaultMessage: 'Upload gallery images',
    
    onSuccess: (file, response) => {
        // Handle gallery images
    }
});
*/

// ========================================
// EXAMPLE 7: Get Uploaded Files Info
// ========================================
/*
const dropzone = new DropzoneHandler('#my-dropzone', {
    uploadUrl: '/admin/upload/image'
});

// Get all uploaded files
const files = dropzone.getUploadedFiles();
console.log('Uploaded files:', files);

// Check if has files
if (dropzone.hasFiles()) {
    console.log('Has files:', dropzone.getFilesCount());
}

// Get dropzone instance for advanced usage
const dzInstance = dropzone.getInstance();
*/

// ========================================
// EXAMPLE 8: Remove All Files Programmatically
// ========================================
/*
const dropzone = new DropzoneHandler('#my-dropzone', {
    uploadUrl: '/admin/upload/image'
});

// Clear all files
document.getElementById('clear-btn').addEventListener('click', () => {
    dropzone.removeAllFiles();
    console.log('All files removed');
});
*/

// ========================================
// AVAILABLE OPTIONS
// ========================================
/*
{
    uploadUrl: '/upload',              // Upload endpoint
    maxFiles: 5,                       // Maximum number of files
    maxFilesize: 2,                    // Maximum file size in MB
    acceptedFiles: 'image/*',          // Accepted file types
    autoProcessQueue: false,           // Auto upload or manual
    uploadMultiple: false,             // Upload files one by one or all at once
    parallelUploads: 1,                // Number of parallel uploads
    dictDefaultMessage: 'Drop files',  // Default message
    
    // Callbacks
    onSuccess: (file, response, dropzone) => {},
    onError: (file, error, xhr, dropzone) => {},
    onAddedFile: (file, dropzone) => {},
    onRemovedFile: (file, dropzone) => {},
    onComplete: (file, dropzone) => {},
    onSending: (file, xhr, formData, dropzone) => {}
}
*/
