// JS para panel de administración. Puedes expandirlo para manejar usuarios, grupos y configuraciones.

document.addEventListener('DOMContentLoaded', function() {
    cargarVista('users');
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            if (this.href.includes('users')) cargarVista('users');
            if (this.href.includes('groups')) cargarVista('groups');
            if (this.href.includes('configs')) cargarVista('configs');
        });
    });
});

function cargarVista(tipo) {
    fetch(`/api/admin/${tipo}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('adminContent').innerHTML = html;
        });
}
