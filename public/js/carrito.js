
    function carrito() {
        return {
            abrir: false,
            carrito: [],

            init() {
                this.obtenerCarrito();
            },

            get total() {
                return this.carrito.reduce(
                    (sum, item) => sum + (Number(item.precio) * item.cantidad),
                    0
                );
            },

            get cantidadTotal() {
                return this.carrito.reduce(
                    (sum, item) => sum + Number(item.cantidad),
                    0
                );
            },

            obtenerCarrito() {
                fetch('/carrito')
                    .then(r => r.json())
                    .then(data => {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    })
                    .catch(err => console.error("Error al obtener carrito:", err));
            },

            agregar(id) {
    fetch(`/carrito/agregar/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            // 1. Actualizamos los datos del componente actual
            this.carrito = data.carrito ? Object.values(data.carrito) : [];
            
            // 2. LANZAR EVENTO GLOBAL (Esto es lo que falta)
            window.dispatchEvent(new CustomEvent('carrito-actualizado', { 
                detail: { carrito: this.carrito } 
            }));
            
            this.abrir = true; // Opcional: abre el carrito para mostrar el cambio
        }
    });
},

            aumentar(id) {
                fetch(`/carrito/agregar/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                });
            },

            disminuir(id) {
                fetch(`/carrito/eliminar-unidad/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                });
            },

            eliminar(id) {
                fetch(`/carrito/eliminar/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    }
                });
            },

            vaciar() {
                fetch('/carrito/vaciar', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        this.carrito = [];
                    }
                });
            }
        }
    }

    