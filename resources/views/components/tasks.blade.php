@props([
    'tasks' => [],
])

@if(count($tasks))
    @foreach($tasks as $task)
        <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 p-4">
            <div class="">
                <small>{{ $task->prefixed_number }}</small>
                <div class="float-right">
                    <input scope="add-time-input" class="text-sm py-0 px-1 w-16"  type="number" dt-task="{{ $task->id }}" />
                    <button scope="add-time" class="button border text-sm p-1" type="button" dt-task="{{ $task->id }}" id="">Add spent time</button>
                </div>
            </div>
            <div class="flex justify-between">
                <div style="width: 35%;" class="font-bold">{{ $task->title }}</div>
            </div>
            <div class="flex justify-end">
                <div style="width: 35%;" class=""><span class="border p-1 text-sm">{{ $task->status_name }}</span></div>
                <div style="width: 30%;" class="">{!! $task->assignee_image !!}&nbsp;{{ $task->assignee }}</div>
                <div style="width: 10%;" class="">
                    @switch($task->priority)
                        @case(1)
                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">High</span>
                            @break
                        @case(2)
                            <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Medium</span>
                            @break
                        @case(3)
                            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Low</span>
                            @break
                    @endswitch
                </div>
                <div style="width: 15%;" class="flex"><x-icons.calendar class="flex-shrink-0" aria-hidden="true" />{{ $task->due }}</div>
                <div style="width: 10%;" class="flex"><x-icons.time class="flex-shrink-0" aria-hidden="true" /> &nbsp;{{ number_format($task->hours, 2) }}h</div>

            </div>

        </div>
    @endforeach
@else
    <span class="">{{ __('No data to be displayed.') }}</span>
@endif

<script>
    document.querySelectorAll('[scope="add-time"]').forEach(item => {
       item.addEventListener('click', (e) => {
           e.preventDefault();

           let taskId = e.target.getAttribute('dt-task');
           let timeSpent = document.querySelector('input[dt-task="' + taskId + '"]').value;

           axios
               .post('/task/' + taskId + '/add-spent-time', {
                   time: timeSpent
               })
               .then(res => {
                    window.location.reload();
               })
               .catch(err => alert(err));

       });
    });
</script>
