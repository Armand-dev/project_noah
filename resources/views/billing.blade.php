<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Billing') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        Your subscription is inactive. Redirecting to billing portal in <span id="seconds">6</span> seconds...
    </div>

    <script>
        setInterval(() => {
            document.querySelector('#seconds').innerHTML = parseInt(document.querySelector('#seconds').innerHTML) - 1;
        }, 1000);

        setTimeout(()=>{
            window.location.href = '{{ config('billing.portal_url') }}'
        }, 5000);
    </script>
</x-app-layout>
