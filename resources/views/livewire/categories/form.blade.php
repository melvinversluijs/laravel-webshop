<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <form action="#" method="POST" wire:submit.prevent="saveCategory">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 space-y-6 sm:p-6">
                        <!-- Category Code. -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="code" value="{{ __('Code') }}" />
                            <x-jet-input id="code" type="text" class="mt-1 block w-full" wire:model.lazy="category.code" />
                            <x-jet-input-error for="category.code" class="mt-2" />
                        </div>

                        <!-- Category name. -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.lazy="category.name" autofocus />
                            <x-jet-input-error for="category.name" class="mt-2" />
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
