@props([
    'headings' => [],
    'rows' => [],
])

@if(count($rows))
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        @foreach($headings as $heading)
            <th scope="col" class="px-2.5 py-3">
                {{ __($heading) }}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($rows as $columns)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                @foreach($columns as $column)
                    <td class="px-2.5 py-4 ">
                        {!! $column !!}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <span class="">{{ __('No data to be displayed.') }}</span>
@endif
