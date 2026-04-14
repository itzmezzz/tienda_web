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

        // CORRECCIÓN 1: 'param' puede ser el ID o el objeto completo
        agregar(param) {
            // Si es un objeto, sacamos el ID. Si no, usamos el valor directamente.
            const id = typeof param === 'object' ? param.id : param;

            fetch(`/carrito/agregar/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // CORRECCIÓN 2: Forzar respuesta JSON para evitar error de parseo HTML
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                // CORRECCIÓN 3: Si es objeto, lo mandamos en el body
                body: typeof param === 'object' ? JSON.stringify(param) : null
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.carrito = data.carrito ? Object.values(data.carrito) : [];
                    
                    // Sincronizar con el evento exacto que tienes en tu carrito.blade
                    window.dispatchEvent(new CustomEvent('agregar-al-carrito', { 
                        detail: data.carrito 
                    }));
                    
                    this.abrir = true; 
                }
            })
            .catch(err => console.error("Error:", err));
        },

        aumentar(id) {
            fetch(`/carrito/agregar/${id}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
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
                    'Accept': 'application/json',
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
                    'Accept': 'application/json',
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
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.carrito = [];
                }
            });
        },
        irAlCheckout() {
            if (this.carrito.length === 0) {
                alert("Tu carrito está vacío");
                return;
            }
            // Redirige a la ruta que definiste en web.php
            window.location.href = "checkout/confirmar";
        }
    }
}