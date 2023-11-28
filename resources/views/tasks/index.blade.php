<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('To Do') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <a href="/task/create" class="mb-4 inline-flex items-center transition-colors font-medium select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-green-500 text-white hover:bg-green-600 focus:ring-green-500 rounded-md">+ Add task</a>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <x-tasks
                :tasks="$tasks"
            ></x-tasks>
        </div>

    </div>

</x-app-layout>
