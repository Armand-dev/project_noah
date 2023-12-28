<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between px-4">
            <div>
                <h2 class="text-xl leading-tight">
                    {{ __('Users') }}
                </h2>
            </div>

            <div>
                <a href="/user/create" class="mb-4 inline-flex items-center transition-colors  select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-purple text-white hover:bg-green-600 focus:ring-green-500 rounded-md px-6 py-2 text-sm">Add User &nbsp;&nbsp;&nbsp;+</a>
            </div>
        </div>
    </x-slot>

    <div class="overflow-hidden bg-white rounded-lg dark:bg-dark-eval-1">
            <x-datatable
                :headings="$heading"
                :rows="$users"
            ></x-datatable>
    </div>
</x-app-layout>
