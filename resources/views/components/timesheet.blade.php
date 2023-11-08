@props([
    'headings',
    'timesheet',
    'clients' => [],
    'projects' => [],
    'activities' => [],
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
        @foreach($timesheet as $day => $row)
            @if(count($row['data']))

                @foreach($row['data'] as $work)
                    <tr class="
                    @if($row['meta']['is_weekend'])
                        bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                    @else
                        bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                    @endif
                    ">
                        <th dt-col="day" scope="row" class="@if($loop->last) border-b dark:border-gray-700 @endif px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if($loop->first)
                                {{ $day ?? '' }}
                            @endif
                        </th>
                        <td dt-col="client" class="px-6 py-4 border-b dark:border-gray-700">
                            {{ $work['client'] ?? '' }}
                        </td>
                        <td dt-col="project" class="px-6 py-4 border-b dark:border-gray-700">
                            {{ $work['project'] ?? '' }}
                        </td>
                        <td dt-col="activity" class="px-6 py-4 border-b dark:border-gray-700">
                            {{ $work['activity'] ?? '' }}
                        </td>
                        <td dt-col="subactivity" class="px-6 py-4 border-b dark:border-gray-700">
                            {{ $work['subactivity'] ?? '' }}
                        </td>
                        <td dt-col="hours" class="px-6 py-4 border-b dark:border-gray-700">
                            {{ $work['hours'] ?? '' }}
                        </td>

                        <td class="px-6 py-4 text-center @if($loop->last) border-b dark:border-gray-700 @endif">
                            @if($loop->first)
                                <a
                                    dt-col="edit"
                                    href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    id="editTimesheet"
                                >
                                    <x-icons.edit class="flex-shrink-0" style="width: 10px;" aria-hidden="true" />
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="
                @if($row['meta']['is_weekend'])
                    bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                @else
                    bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                @endif
                ">
                    <th dt-col="day" scope="row" class="border-b dark:border-gray-700 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $day ?? ''}}
                    </th>
                    <td dt-col="client" class="px-6 py-4 border-b dark:border-gray-700"></td>
                    <td dt-col="project" class="px-6 py-4 border-b dark:border-gray-700"></td>
                    <td dt-col="activity" class="px-6 py-4 border-b dark:border-gray-700"></td>
                    <td dt-col="subactivity" class="px-6 py-4 border-b dark:border-gray-700"></td>
                    <td dt-col="hours" class="px-6 py-4 border-b dark:border-gray-700"></td>

                    <td class="px-6 py-4 text-center border-b dark:border-gray-700">
                        <a
                            dt-col="edit"
                            href="#"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            id="editTimesheet"
                        >
                            <x-icons.edit class="flex-shrink-0" style="width: 10px;" aria-hidden="true" />
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
<script>
    document.querySelectorAll('[dt-col="edit"]').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault()
            let row = e.target.parentNode.parentNode;

            let clientSelect = '<select name="clients"><option value="">Select client...</option>@foreach($clients as $client)<option value="{{ $client->id }}">{{ $client->name }}</option>@endforeach</select>';
            let projectSelect = '<select name="projects"><option value="">Select project...</option>@foreach($projects as $project)<option value="{{ $project->id }}">{{ $project->name }}</option>@endforeach</select>';
            let activitySelect = '<select name="activities"> <option value="">Select activity...</option>@foreach($activities as $activity)<option value="{{ $activity->id }}">{{ $activity->name }}</option>@endforeach</select>';
            let hoursInput = '<input name="hours" type="number" placeholder="Input hours"/>';

            row.querySelector('[dt-col="client"]').innerHTML = clientSelect;
            row.querySelector('[dt-col="project"]').innerHTML = projectSelect;
            row.querySelector('[dt-col="activity"]').innerHTML = activitySelect;
            row.querySelector('[dt-col="hours"]').innerHTML = hoursInput;

            row.querySelector('[dt-col="edit"]').style.display = 'none';
            row.querySelector('[dt-col="save"]').style.display = 'block';
        });
    });
</script>
