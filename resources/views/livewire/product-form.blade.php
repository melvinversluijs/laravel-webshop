<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if ($product !== null)
            {{ __('Edit :Product', ['product' => $product->name]) }}
        @else
            {{ __('Create new product') }}
        @endif
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form action="#" method="POST" wire:submit.prevent="saveLink">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    Name
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input wire:model.lazy="product.name" type="text" name="name" id="name"
                                             class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="sku" class="block text-sm font-medium text-gray-700">
                                    Sku
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input wire:model.lazy="product.sku" type="text" name="sku" id="sku"
                                             class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                                <label for="slug" class="block text-sm font-medium text-gray-700">
                                    Slug
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input wire:model.lazy="product.slug" type="text" name="slug" id="slug"
                                             class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                    />
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                    $
                                </span>
                                <input wire:model.lazy="product.price" type="text" name="price" id="price"
                                       class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-r-md sm:text-sm border-gray-300"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="button"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Delete
                        </button>
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
