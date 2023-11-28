<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create Task') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg content-center flex items-center justify-center">
            <div style="width: 50%;" class="">
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('task.store') }}">
                    @csrf

                    <div class="grid gap-6">
                        <!-- Name -->
                        <div class="space-y-2">
                            <x-form.label
                                for="title"
                                :value="__('Title')"
                            />

                            <x-form.input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                                </x-slot>

                                <x-form.input
                                    withicon
                                    id="title"
                                    class="block w-full"
                                    type="text"
                                    name="title"
                                    :value="old('title')"
                                    required
                                    autofocus
                                    placeholder="{{ __('Title') }}"
                                />
                            </x-form.input-with-icon-wrapper>
                        </div>


                        <!-- Description -->
                        <div class="space-y-2">
                            <x-form.label
                                for="description"
                                :value="__('Description')"
                            />

                            <textarea name="description" id="description"></textarea>
                        </div>

{{--                        <!-- Client -->--}}
{{--                        <div class="space-y-2">--}}
{{--                            <x-form.label--}}
{{--                                for="client_id"--}}
{{--                                :value="__('Client')"--}}
{{--                            />--}}


{{--                            <select--}}
{{--                                name="client_id"--}}
{{--                                id="client_id"--}}
{{--                                class="block w-full"--}}
{{--                                :value="old('client_id')"--}}
{{--                                required--}}
{{--                                placeholder="{{ __('Client') }}"--}}

{{--                            >--}}
{{--                                <option value=""></option>--}}
{{--                                @foreach(auth()->user()->companies()->first()->clients()->orderBy('name')->get() as $client)--}}
{{--                                    <option value="{{ $client->id }}">{{ $client->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <!-- User -->
                        <div class="space-y-2">
                            <x-form.label
                                for="client_id"
                                :value="__('User')"
                            />


                            <select
                                name="user_id"
                                id="user_id"
                                class="block w-full"
                                :value="old('user_id')"
                                required
                                placeholder="{{ __('User') }}"

                            >
                                <option value=""></option>
                                @foreach(auth()->user()->companies()->first()->employees()->get() as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Priority -->
                        <div class="space-y-2">
                            <x-form.label
                                for="client_id"
                                :value="__('Priority')"
                            />


                            <select
                                name="priority"
                                id="priority"
                                class="block w-full"
                                :value="old('priority')"
                                required
                                placeholder="{{ __('Priority') }}"

                            >
                                <option value=""></option>
                                @foreach(\App\Models\Task::PRIORITIES as $id => $priority)
                                    <option value="{{ $id }}">{{ $priority }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <x-form.label
                                for="client_id"
                                :value="__('Status')"
                            />


                            <select
                                name="status"
                                id="status"
                                class="block w-full"
                                :value="old('priority')"
                                required
                                placeholder="{{ __('Status') }}"

                            >
                                <option value=""></option>
                                @foreach(\App\Models\Task::STATUSES as $id => $status)
                                    <option value="{{ $id }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Due Date -->
                        <div class="space-y-2">
                            <x-form.label
                                for="due_date"
                                :value="__('Due Date')"
                            />

                            <x-form.input
                                withicon
                                id="due_date"
                                class="block w-full"
                                type="date"
                                name="due_date"
                                :value="old('due_date')"
                                autofocus
                                placeholder="{{ __('Due date') }}"
                            />
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
