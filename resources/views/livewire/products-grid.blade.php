<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Products') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-row-reverse">
            <a href="{{ route('products.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-700 disabled:opacity-25 transition">
                {{ __('Create') }}
            </a>
        </div>

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
                    <x-table.heading>Actions</x-table.heading>
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
                            <x-table.cell>
                                <div class="flex">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="text-yellow-500 hover:text-yellow-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" wire:click.prevent="deleteProduct('{{ $product->id }}')"
                                       class="ml-2 text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </a>
                                </div>
                            </x-table.cell>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
</div>
