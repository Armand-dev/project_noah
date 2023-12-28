@props([
    'headings' => [],
    'rows' => [],
])

@if(count($rows))
<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border dark:border-gray-900">
    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        @foreach($headings as $heading)
            @if($loop->first)
                <th scope="col" class="px-3 py-2.5 text-center border dark:border-gray-900">
                    {{ __($heading) }}
                </th>
            @else
                <th scope="col" class="px-3 py-2.5 border dark:border-gray-900">
                    {{ __($heading) }}
                </th>
            @endif
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($rows as $columns)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                @foreach($columns as $column)
                    @if($loop->first)
                        <td class="px-3 py-2.5 text-center border dark:border-gray-900">
                            {!! $column !!}
                        </td>
                    @else
                        <td class="px-3 py-2.5 border dark:border-gray-900">
                            {!! $column !!}
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <span class="">{{ __('No data to be displayed.') }}</span>
@endif
