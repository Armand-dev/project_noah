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
    <div id="overlay" class="hidden"></div>
    <div id="drawer" class="">
        <div id="drawer-head" class="mb-2">
            <h5
                id="work-day"
                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 font-bold"
            ></h5>
        </div>
        <div id="drawer-body">
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">Client: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Project: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Activity: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Hours: NEURON ENG SRL</p>
            </div>
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">Client: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Project: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Activity: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Hours: NEURON ENG SRL</p>
            </div>
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">Client: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Project: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Activity: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Hours: NEURON ENG SRL</p>
            </div>
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">Client: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Project: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Activity: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Hours: NEURON ENG SRL</p>
            </div>
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">Client: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Project: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Activity: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Hours: NEURON ENG SRL</p>
            </div>
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">Client: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Project: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Activity: NEURON ENG SRL</p>
                <p class="font-normal text-gray-700 dark:text-gray-400">Hours: NEURON ENG SRL</p>
            </div>
            <div class="mb-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-700 dark:text-gray-400">+ add work</p>
            </div>
        </div>
    </div>
        @foreach($timesheet as $day => $row)
            @if(count($row['data']))

                @foreach($row['data'] as $work)
                    <tr class="
                    @if($row['meta']['is_weekend'])
                        bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                    @else
                        bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                    @endif
                    "
                    dt-id="{{ $day }}"
                    >
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
                "
                dt-id="{{ $day }}"
                >
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
    let overlay = document.querySelector('#overlay');
    let drawer = document.querySelector('#drawer');

    document.querySelectorAll('[dt-col="edit"]').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();

            overlay.style.display = 'block';
            drawer.style.right = '0px';

            let row = e.target.closest('tr');
            let day = row.getAttribute('dt-id');

            drawer.querySelector('#drawer-head > #work-day').innerHTML = "Day " + day;
        });
    });

    document.addEventListener('keydown', (e) => {
        e.preventDefault();

        if(overlay.style.display === 'block' && e.key === 'Escape') {
            overlay.style.display = 'none';
            drawer.style.right = '-500px';
        }
    });

    overlay.addEventListener('click', (e) => {
        e.preventDefault();

        overlay.style.display = 'none';
        drawer.style.right = '-500px';
    });
</script>
<style>
    #overlay {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.3);
    }

    #drawer {
        transition: all .1s ease-out;
        position: fixed;
        top: 0px;
        right: -500px;
        background: #ffffff;
        width: 25%;
        height: 100vh;
        box-shadow: -10px 0px 40px rgba(0,0,0,0.1);
        padding: 80px 40px;
    }

    #drawer-head {
        margin-top: 50px;
    }

    #drawer-body {
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow-y: scroll;
        height: 60vh;
    }
</style>
