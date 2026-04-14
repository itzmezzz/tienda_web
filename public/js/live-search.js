const buscador = document.getElementById("buscador");
const resultados = document.getElementById("resultados");
let timeout = null;

buscador.addEventListener("keyup", function() {
    clearTimeout(timeout); // Limpia el temporizador anterior
    let query = this.value.trim();

    if (query.length < 1) {
        resultados.classList.add("hidden");
        resultados.innerHTML = "";
        return;
    }

    // Espera 300ms después de que el usuario deja de teclear
    timeout = setTimeout(() => {
        fetch(`/producto/live-search?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                resultados.innerHTML = "";

                if (data.length === 0) {
                    resultados.innerHTML = '<div class="p-2 text-gray-400">Sin resultados</div>';
                } else {
                    // Creamos un string único para evitar múltiples inserciones al DOM
                    let html = data.map(producto => `
                        <a href="/buscar?q=${encodeURIComponent(producto.nombre)}" 
                           class="flex items-center gap-3 p-3 hover:bg-slate-700 transition-colors border-b border-slate-600 last:border-0">
                            <div class="text-sm text-white">${producto.nombre}</div>
                        </a>
                    `).join('');
                    
                    resultados.innerHTML = html;
                }
                resultados.classList.remove("hidden");
            })
            .catch(err => console.error("Error en búsqueda:", err));
    }, 300);
});

// Cerrar resultados al hacer clic fuera
document.addEventListener('click', (e) => {
    if (!buscador.contains(e.target) && !resultados.contains(e.target)) {
        resultados.classList.add('hidden');
    }
});