<form action="{{ route('direccion.guardar') }}" method="POST" class="bg-white p-6 rounded-xl shadow-md space-y-4">
    @csrf
    <h3 class="text-xl font-bold border-b pb-2">Información de Envío</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Calle y Número</label>
            <input type="text" name="calle" value="{{ $direccion->calle ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Código Postal</label>
            <input type="text" name="codigo_postal" value="{{ $direccion->codigo_postal ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Ciudad</label>
            <input type="text" name="ciudad" value="{{ $direccion->ciudad ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <input type="text" name="estado" value="{{ $direccion->estado ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Referencia (Ej: Portón azul, entre calles...)</label>
        <textarea name="referencia" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">{{ $direccion->referencia ?? '' }}</textarea>
    </div>

    <button type="submit" class="w-full bg-black text-white py-2 rounded-lg hover:bg-red-600 transition font-bold">
        Guardar Dirección
    </button>
</form>