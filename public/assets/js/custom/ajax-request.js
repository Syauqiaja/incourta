class AjaxForm {
    constructor(selector, options = {}) {
        this.form = document.querySelector(selector);
        if (!this.form) return;

        this.options = {
            showLoader: true,
            redirectDelay: 1500,

            beforeSubmit: null,
            afterSubmit: null,
            onSuccess: null,
            onError: null,

            ...options
        };

        this.bind();
    }

    bind() {
        this.form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.send();
        });
    }

    send() {
        const formData = new FormData(this.form);

        // 🔹 BEFORE SUBMIT
        if (this.options.beforeSubmit) {
            const proceed = this.options.beforeSubmit(this.form, formData);
            if (proceed === false) return;
        }

        if (this.options.showLoader) {
            Swal.fire({
                title: 'Memproses...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        }

        fetch(this.form.action, {
            method: this.form.method || 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content')
            },
            body: formData
        })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;

                this.success(data);
            })
            .catch(err => {
                this.error(err);
            })
            .finally(() => {
                // 🔹 AFTER SUBMIT (always)
                this.options.afterSubmit?.();
            });
    }

    success(data) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: data.message || 'Data berhasil diproses',
            timer: this.options.redirectDelay,
            showConfirmButton: false
        });

        this.options.onSuccess?.(data);

        if (data.redirect) {
            setTimeout(() => {
                window.location.href = data.redirect;
            }, this.options.redirectDelay);
        }
    }

    error(err) {
        // if (err.errors) {
        //     const messages = Object.values(err.errors).flat().join('<br>');
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Validasi Gagal',
        //         html: messages
        //     });
        // } else {
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Gagal',
        //         text: err.message || 'Terjadi kesalahan'
        //     });
        // }

        this.options.onError?.(err, this.form);
    }
}