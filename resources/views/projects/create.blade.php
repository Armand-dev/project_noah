<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create Projects') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg content-center flex items-center justify-center">
            <div style="width: 50%;" class="">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('project.store') }}">
                    @csrf

                    <div class="grid gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <x-form.label
                                for="name"
                                :value="__('Name')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="name"
                                    class="block w-full"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Name') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>

                        <!-- Client -->
                        <div class="space-y-2">
                            <x-form.label
                                for="client_id"
                                :value="__('Client')"
                            />


                            <select
                                name="client_id"
                                id="client_id"
                                class="block w-full"
                                :value="old('client_id')"
                                required
                                placeholder="{{ __('Client') }}"

                            >
                                @foreach(auth()->user()->companies()->first()->clients()->orderBy('name')->get() as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-button class="justify-center w-full gap-2">
                                <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                                <span>{{ __('Create') }}</span>
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
