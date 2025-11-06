document.addEventListener('DOMContentLoaded', function() {
    cargarArchivos();
    cargarUsoAlmacenamiento();
});

function cargarArchivos() {
    fetch('/api/user/files')
        .then(res => res.json())
        .then(data => {
            const cont = document.getElementById('userFiles');
            if (data.length === 0) {
                cont.innerHTML = '<p>No tienes archivos subidos.</p>';
            } else {
                cont.innerHTML = '<ul class="list-group">' +
                    data.map(f => `<li class="list-group-item d-flex justify-content-between align-items-center">
                        ${f.name} <span class="badge bg-secondary">${(f.size/1024/1024).toFixed(2)} MB</span>
                    </li>`).join('') + '</ul>';
            }
        });
}

function cargarUsoAlmacenamiento() {
    fetch('/api/user/storage-usage')
        .then(res => res.json())
        .then(data => {
            document.getElementById('storageUsage').innerHTML =
                `<strong>Uso actual:</strong> ${(data.used/1024/1024).toFixed(2)} MB / ${(data.limit/1024/1024).toFixed(2)} MB`;
        });
}

document.getElementById('uploadForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/user/upload');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const percent = Math.round((e.loaded / e.total) * 100);
            const bar = document.getElementById('progressBar');
            const container = document.getElementById('progressBarContainer');
            container.style.display = 'block';
            bar.style.width = percent + '%';
            bar.textContent = percent + '%';
        }
    };
    xhr.onload = function() {
        document.getElementById('progressBarContainer').style.display = 'none';
        const result = JSON.parse(xhr.responseText);
        const notification = document.getElementById('notification');
        if (result.success) {
            notification.innerHTML = `<div class='alert alert-success'>${result.message}</div>`;
            cargarArchivos();
            cargarUsoAlmacenamiento();
        } else {
            notification.innerHTML = `<div class='alert alert-danger'>${result.message}</div>`;
        }
    };
    xhr.send(formData);
});
