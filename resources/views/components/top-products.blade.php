<div class="bg-slate-800/50 rounded-2xl border">
<div class="p-6 border-b">
<h3 class="text-lg font-bold">Top Productos</h3>
</div>

<div class="p-6 space-y-4">
@foreach($topProducts as $product)
<div class="flex items-center gap-4">
<img src="{{ $product->imagen }}" class="w-12 h-16 rounded">
<div>
<p class="text-white">{{ $product->nombre }}</p>
<p class="text-slate-400 text-sm">{{ $product->ventas }} vendidos</p>
</div>
</div>
@endforeach
</div>
</div>