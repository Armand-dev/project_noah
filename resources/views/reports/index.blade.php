<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Timesheet') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-1 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <x-timesheet
                :headings="$headings"
                :timesheet="$timesheet"
                :clients="$clients"
                :projects="$projects"
                :activities="$activities"
            ></x-timesheet>
        </div>

    </div>
</x-app-layout>
