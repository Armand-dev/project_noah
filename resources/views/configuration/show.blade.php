<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Configurations') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-1 overflow-hidden">

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium">
                            {{ __('Task Prefix') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {!!  __("This will be added before your task IDs. This will not change existing task IDs.<br>   <i class='text-xs'> e.g. Task# EXAMPLE-12</i>")  !!}
                        </p>
                    </header>

                    <form
                        method="post"
                        action="{{ route('configuration.update-task-prefix') }}"
                        class="mt-6 space-y-6"
                    >
                        @csrf
                        @method('patch')

                        <div class="space-y-2">
                            <x-form.label
                                for="task_prefix"
                                :value="__('Task prefix')"
                            />

                            <x-form.input
                                id="task_prefix"
                                name="task_prefix"
                                type="text"
                                class="block w-full"
                                :value="old('task_prefix', auth()->user()->employerCompany->task_prefix)"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <x-form.error :messages="$errors->get('task_prefix')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-button>
                                {{ __('Save') }}
                            </x-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >
                                    {{ __('Saved.') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>
        </div>

    </div>
</x-app-layout>
