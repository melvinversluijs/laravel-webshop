<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Products') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>ID</x-table.heading>
                    <x-table.heading>Sku</x-table.heading>
                    <x-table.heading>Slug</x-table.heading>
                    <x-table.heading>Name</x-table.heading>
                    <x-table.heading>Price</x-table.heading>
                    <x-table.heading>Created at</x-table.heading>
                    <x-table.heading>Last updated at</x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @foreach($products as $product)
                        <tr>
                            <x-table.cell>{{ $product->id }}</x-table.cell>
                            <x-table.cell>{{ $product->sku }}</x-table.cell>
                            <x-table.cell>{{ $product->slug }}</x-table.cell>
                            <x-table.cell>{{ $product->name }}</x-table.cell>
                            <x-table.cell>{{ $product->formatted_price }}</x-table.cell>
                            <x-table.cell>{{ $product->formatted_created_at }}</x-table.cell>
                            <x-table.cell>{{ $product->formatted_updated_at }}</x-table.cell>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
</div>
