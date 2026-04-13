<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
</div><div class="lg:col-span-2 bg-slate-800/50 rounded-2xl border overflow-hidden">

<div class="p-6 border-b">
    <h3 class="text-lg font-bold">Pedidos Recientes</h3>
</div>

<table class="w-full">
<thead>
<tr>
<th>Pedido</th>
<th>Cliente</th>
<th>Total</th>
<th>Estado</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
<td>#{{ $order->id }}</td>
<td>{{ $order->cliente }}</td>
<td>${{ $order->total }}</td>
<td>{{ $order->estado }}</td>
</tr>
@endforeach
</tbody>
</table>

</div>