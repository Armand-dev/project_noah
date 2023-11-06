@props([
    'headings',
    'timesheet',
])

<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
        @foreach($headings as $heading)
            <th scope="col" class="px-6 py-3">
                {{ __($heading) }}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($timesheet as $entry)
            <tr class="
            @if($entry['meta']['is_weekend'])
                bg-gray-100 border-b dark:bg-gray-700 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
            @else
                bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
            @endif
            ">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $entry['day'] ?? ''}}
                    </th>
                    <td class="px-6 py-4">
                        {{ $entry['client'] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $entry['project'] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $entry['activity'] ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $entry['subactivity'] ?? '' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
            </tr>
        @endforeach
    </tbody>
</table>
