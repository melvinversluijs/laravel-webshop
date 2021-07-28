<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($product->exists)
            {{ __('Edit :Product', ['product' => $product->name]) }}
        @else
            {{ __('Create new product') }}
        @endif
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form action="#" method="POST" wire:submit.prevent="saveProduct">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 space-y-6 sm:p-6">
                        <!-- Product name. -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="product.name" autofocus />
                            <x-jet-input-error for="product.name" class="mt-2" />
                        </div>

                        <!-- Product Sku. -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="sku" value="{{ __('Sku') }}" />
                            <x-jet-input id="sku" type="text" class="mt-1 block w-full" wire:model.lazy="product.sku" />
                            <x-jet-input-error for="product.sku" class="mt-2" />
                        </div>

                        <!-- Slug. -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="slug" value="{{ __('Slug') }}" />
                            <x-jet-input id="slug" type="text" class="mt-1 block w-full" wire:model.lazy="slug.slug" />
                            <x-jet-input-error for="slug.slug" class="mt-2" />
                        </div>

                        <!-- Product Price. -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="price" value="{{ __('Price') }}" />
                            <x-jet-input id="price" type="text" class="mt-1 block w-full" wire:model.lazy="product.price" />
                            <x-jet-input-error for="product.price" class="mt-2" />
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right sm:px-6">
                        <x-jet-button>{{ __('Save') }}</x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
