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
                <td class="px-3 py-2.5 border dark:border-gray-900">
                    <a href="/task/{{ $columns['id'] }}/edit" class="text-blue-700 dark:text-blue-300">{!! $columns['prefixed_number'] !!}</a>
                </td>
                <td class="px-3 py-2.5 border dark:border-gray-900">
                    {!! $columns['title'] !!}
                </td>
                <td class="px-3 py-2.5 border dark:border-gray-900">
                    {!! $columns['project_name'] !!}
                </td>
                <td class="px-3 py-2.5 border dark:border-gray-900">
                    {!! $columns['assignee_image'] !!} &nbsp; {!! $columns['assignee'] !!}
                </td>
                <td class="px-3 py-2.5 border dark:border-gray-900">
                    @switch($columns['status_name'])
                        @case('Not started')
                            <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-900 px-2 py-1 text-xs text-gray-600 dark:text-gray-100 ring-1 ring-inset ring-gray-500/10">{!! $columns['status_name'] !!}</span>
                            @break
                        @case('In progress')
                            <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900 px-2 py-1 text-xs text-blue-700 dark:text-blue-100 ring-1 ring-inset ring-blue-700/10">{!! $columns['status_name'] !!}</span>
                            @break
                        @case('On hold')
                            <span class="inline-flex items-center rounded-md bg-yellow-50 dark:bg-yellow-900 px-2 py-1 text-xs text-yellow-800 dark:text-yellow-100 ring-1 ring-inset ring-yellow-600/20">{!! $columns['status_name'] !!}</span>
                            @break
                        @case('Done')
                            <span class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-900 px-2 py-1 text-xs text-green-700 dark:text-green-100 ring-1 ring-inset ring-green-600/20">{!! $columns['status_name'] !!}</span>
                            @break
                    @endswitch

                </td>
                <td class="px-3 py-2.5 border dark:border-gray-900">
                    {!! $columns['due'] !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <span class="">{{ __('No data to be displayed.') }}</span>
@endif
