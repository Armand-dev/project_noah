@props([
    'task' => null
])

<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between px-4">
            <div>
                <h2 class="text-xl leading-tight">
                    <small class="text-gray-400 dark:text-gray-600">Task#</small> {{ __($task->prefixed_number) }}
                </h2>
            </div>

            <div>
                <a href="#" class="inline-flex items-center transition-colors  select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-purple text-white hover:bg-green-600 focus:ring-green-500 rounded-md px-6 py-2 text-sm">Add task &nbsp;&nbsp;&nbsp;+</a>
            </div>
        </div>
    </x-slot>

    <div class="p-2 overflow-hidden bg-white rounded-md  dark:bg-dark-eval-1">
        <x-tasks.edit
            :task="$task"
        />
    </div>
</x-app-layout>
