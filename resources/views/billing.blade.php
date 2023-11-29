<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Billing') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

        <script async src="https://js.stripe.com/v3/pricing-table.js"></script>
        <stripe-pricing-table
            pricing-table-id="prctbl_1OHvnkHKKgkGW03ID2ctpWMA"
            publishable-key="pk_test_51OHvY4HKKgkGW03IGAHW50OT4mOucOpPDougtERJyQ5Eli0WT38gUVSxy5XZw8p0domg7NEin4cVs34MpSiooJwh00nMt42koJ"
            client-reference-id="{{ auth()->user()->id }}"
            customer-email="{{ auth()->user()->email }}"
        >
        </stripe-pricing-table>

    </div>
</x-app-layout>
