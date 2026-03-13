document.addEventListener("DOMContentLoaded", function () {

const input = document.getElementById('searchInput');
const results = document.getElementById('searchResults');

input.addEventListener('input', function () {

    let query = this.value;

    if(query.length < 1){
        results.innerHTML = "";
        results.classList.add("hidden");
        return;
    }

    fetch(`/producto/live-search?q=${encodeURIComponent(query)}`)
    .then(res => res.json())
    .then(data => {

        results.innerHTML = "";

        if(data.length === 0){
            results.classList.add("hidden");
            return;
        }

        data.forEach(producto => {

            let item = document.createElement("div");

            item.classList.add(
                "p-2",
                "cursor-pointer",
                "hover:bg-gray-200"
            );

            item.textContent = producto.nombre;

            item.onclick = function(){
                input.value = producto.nombre;
                results.classList.add("hidden");
            };

            results.appendChild(item);

        });

        results.classList.remove("hidden");

    });

});

});