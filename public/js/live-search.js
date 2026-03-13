const buscador = document.getElementById("buscador");
const resultados = document.getElementById("resultados");

buscador.addEventListener("keyup", function(){

    let query = this.value;

    if(query.length < 1){
        resultados.classList.add("hidden");
        resultados.innerHTML = "";
        return;
    }

    fetch("/producto/live-search?q=" + encodeURIComponent(query))
    .then(res => res.json())
    .then(data => {

        resultados.innerHTML = "";

        if(data.length === 0){
            resultados.innerHTML = `<div class="p-2 text-gray-400">Sin resultados</div>`;
        }

        data.forEach(producto => {

            resultados.innerHTML += `
            <a href="/buscar?q=${encodeURIComponent(producto.nombre)}"
            class="flex items-center gap-3 p-2 hover:bg-slate-700 cursor-pointer border-b border-slate-600">

                <div class="text-sm">
                    ${producto.nombre}
                </div>

            </a>
            `;
        });

        resultados.classList.remove("hidden");

    });

});
