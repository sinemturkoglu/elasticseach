document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form.card');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(errorData => {
                        throw new Error(JSON.stringify(errorData));
                    });
                }
                return response.json(); // Başarılıysa JSON yanıtını oku
            })
            .then(data => {
                console.log('Başarılı:', data);
                alert('Veriler başarıyla kaydedildi!');
                form.reset();
                window.location.href = '/index';
            })
            .catch(error => {
                console.error('Hata:', error);
                alert('Bir hata oluştu: ' + error.message);
            });
    });

});

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            if (!confirm('Bu içeriği silmek istediğinizden emin misiniz?')) {
                return;
            }

            const id = this.getAttribute('data-id');
            const deleteUrl = `/blogs/${id}`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(JSON.stringify(errorData));
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                    // Başarılı olursa, silinen satırı DOM'dan kaldır
                    const row = this.closest('tr');
                    if (row) {
                        row.remove();
                    }
                })
                .catch(error => {
                    console.error('Hata:', error);
                    alert('Silme işlemi başarısız oldu: ' + error.message);
                });
        });
    });
});

