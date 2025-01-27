document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = 'http://localhost/www/concursoTapas/api';

    // Login
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const user = document.getElementById('user').value;
        const pass = document.getElementById('pass').value;

        const response = await fetch(`${apiUrl}/clientes/login/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user=${user}&pass=${pass}`
        });

        const data = await response.json();
        document.getElementById('loginOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Registro
    document.getElementById('registroForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const usuario = document.getElementById('usuario').value;
        const pass = document.getElementById('pass2').value;
        const email = document.getElementById('email').value;

        const response = await fetch(`${apiUrl}/clientes/registro/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `usuario=${usuario}&pass=${pass}&email=${email}`
        });

        const data = await response.json();
        document.getElementById('registroOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Ver Perfil
    document.getElementById('perfil').addEventListener('click', async () => {
        const token = prompt('Introduce el token:');
        const response = await fetch(`${apiUrl}/clientes/perfil/`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const data = await response.json();
        document.getElementById('perfilOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Listar Bares
    document.getElementById('listarBares').addEventListener('click', async () => {
        const response = await fetch(`${apiUrl}/bares/`, {
            method: 'GET'
        });

        const data = await response.json();
        document.getElementById('baresOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Insertar Bar
    document.getElementById('insertarBarForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nombre = document.getElementById('nombreBar').value;
        const direccion = document.getElementById('direccion').value;
        const telefono = document.getElementById('telefono').value;
        const hora_apertura = document.getElementById('hora_apertura').value;
        const hora_cierre = document.getElementById('hora_cierre').value;
        const token = prompt('Introduce el token:');

        const response = await fetch(`${apiUrl}/bares/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': `Bearer ${token}`
            },
            body: `nombre=${nombre}&direccion=${direccion}&telefono=${telefono}&hora_apertura=${hora_apertura}&hora_cierre=${hora_cierre}`
        });

        const data = await response.json();
        document.getElementById('insertarBarOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Listar Tapas
    document.getElementById('listarTapas').addEventListener('click', async () => {
        const response = await fetch(`${apiUrl}/tapas/`, {
            method: 'GET'
        });

        const data = await response.json();
        document.getElementById('tapasOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Insertar Tapa
    document.getElementById('insertarTapaForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nombre = document.getElementById('nombreTapa').value;
        const ingredientes = document.getElementById('ingredientes').value;
        const bar = document.getElementById('barTapa').value;
        const token = prompt('Introduce el token:');

        const response = await fetch(`${apiUrl}/tapas/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': `Bearer ${token}`
            },
            body: `nombre=${nombre}&ingredientes=${ingredientes}&bar=${bar}`
        });

        const data = await response.json();
        document.getElementById('insertarTapaOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Registrar Consumo
    document.getElementById('registrarConsumoForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const id_tapa = document.getElementById('id_tapa').value;
        const fecha = document.getElementById('fecha').value;
        const hora = document.getElementById('hora').value;
        const valoracion = document.getElementById('valoracion').value;
        const token = prompt('Introduce el token:');

        const response = await fetch(`${apiUrl}/consumos/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': `Bearer ${token}`
            },
            body: `id_tapa=${id_tapa}&fecha=${fecha}&hora=${hora}&valoracion=${valoracion}`
        });

        const data = await response.json();
        document.getElementById('registrarConsumoOutput').textContent = JSON.stringify(data, null, 2);
    });

    // Obtener Consumos
    document.getElementById('obtenerConsumos').addEventListener('click', async () => {
        const token = prompt('Introduce el token:');
        const response = await fetch(`${apiUrl}/consumos/`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const data = await response.json();
        document.getElementById('consumosOutput').textContent = JSON.stringify(data, null, 2);
    });
});