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
        @foreach($timesheet as $entry)
            <tr class="
            @if($entry['meta']['is_weekend'])
                bg-gray-100 border-b dark:bg-gray-700 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
            @else
                bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
            @endif
            "
                dt-id="{{ $entry['id'] ? $entry['day'] . '-' . $entry['id'] : $entry['day'] }}"
            >
                    <th dt-col="day" scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $entry['day'] ?? ''}}
                    </th>
                    <td dt-col="client" class="px-6 py-4">
                        {{ $entry['client'] }}
                    </td>
                    <td dt-col="project" class="px-6 py-4">
                        {{ $entry['project'] }}
                    </td>
                    <td dt-col="activity" class="px-6 py-4">
                        {{ $entry['activity'] }}
                    </td>
                    <td dt-col="subactivity" class="px-6 py-4">
                        {{ $entry['subactivity'] ?? '' }}
                    </td>
                    <td dt-col="hours" class="px-6 py-4">
                        {{ $entry['hours'] }}
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a
                            dt-col="edit"
                            href="#"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                            id="editTimesheet"
                        >
                            Edit
                        </a>
                        <a
                            dt-col="save"
                            href="#"
                            class="font-medium text-green-600 dark:text-green-500 hover:underline hidden"
                            id="editTimesheet"
                        >
                            Save
                        </a>
                    </td>
            </tr>
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

    document.querySelectorAll('[dt-col="save"]').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault()
            let row = e.target.parentNode.parentNode;

            let client_id = row.querySelector('[dt-col="client"] > [name="clients"]').value;
            let project_id = row.querySelector('[dt-col="project"] > [name="projects"]').value;
            let activity_id = row.querySelector('[dt-col="activity"] > [name="activities"]').value;
            let hours = row.querySelector('[dt-col="hours"] > [name="hours"]').value;
            let day = row.querySelector('[dt-col="day"]').innerHTML;

            axios
                .post('/timesheet', {
                    client_id: client_id,
                    project_id: project_id,
                    activity_id: activity_id,
                    hours: hours,
                    day: day
                })
                .then(res => {
                    row.querySelector('[dt-col="client"]').innerHTML = client_id;
                    row.querySelector('[dt-col="project"]').innerHTML = project_id;
                    row.querySelector('[dt-col="activity"]').innerHTML = activity_id;
                    row.querySelector('[dt-col="hours"]').innerHTML = hours;

                    row.querySelector('[dt-col="edit"]').style.display = 'block';
                    row.querySelector('[dt-col="save"]').style.display = 'none';
                })
                .catch(err => alert(Object.entries(err.response.data.errors).join('\n')));
        });
    });
</script>
