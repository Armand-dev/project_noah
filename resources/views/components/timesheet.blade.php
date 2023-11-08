@props([
    'headings',
    'timesheet',
    'clients' => [],
    'projects' => [],
    'activities' => [],
])

<div id="overlay" class="hidden"></div>
<div id="drawer" class="bg-white dark:bg-gray-700">
    <div id="drawer-head" class="mb-2 text-gray-500 dark:text-gray-400">
        <h5
            id="work-day"
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 font-bold"
        ></h5>
    </div>
    <div id="drawer-body">
        <div id="workday">
        </div>
        <div class="flex">
            <div id="add-human-work" class="mb-2 mr-1 cursor-pointer w-1/2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-500 dark:text-gray-400">+ add human work</p>
            </div>
            <div id="add-machine-work" class="mb-2 cursor-pointer ml-1 w-1/2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <p class="font-normal text-gray-500 dark:text-gray-400">+ add machine work</p>
            </div>
        </div>
    </div>
</div>

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
                    @if(\Carbon\Carbon::parse($day)->isToday())
                        bg-green-100
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
                @if(\Carbon\Carbon::parse($day)->isToday())
                    bg-green-100
                @elseif($row['meta']['is_weekend'])
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
    let drawerHead = drawer.querySelector('#drawer-head');
    let drawerBody = drawer.querySelector('#drawer-body');
    let drawerWorkday = drawerBody.querySelector('#workday');

    document.querySelectorAll('[dt-col="edit"]').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();

            overlay.style.display = 'block';
            drawer.style.right = '0px';

            let row = e.target.closest('tr');
            let day = row.getAttribute('dt-id');

            drawerHead.querySelector('h5').innerHTML = "Day " + day;
            drawerHead.setAttribute('dt-day', day);

            axios
                .get('/getWorkday?day=' + day)
                .then(res => {
                    res.data.forEach(workday => {
                        let content = `<div class="mb-2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"> <div class="flex gap-1" style="float:right;">                                    <x-icons.edit id="edit-work" class="flex-shrink-0 cursor-pointer" style="width: 10px;" aria-hidden="true" /> <x-icons.trash id="delete-work" class="flex-shrink-0 cursor-pointer" style="width: 10px;" aria-hidden="true" /> </div>               <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400">                    <thead></thead>                        <tbody>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Client</th>                            <td>` + workday.client + `</td>                        </tr>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Project</th>                            <td>` + workday.project + `</td>                        </tr>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Activity</th>                            <td>` + workday.activity + `</td>                        </tr><tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Subactivity</th>                            <td>` + workday.activity + `</td>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Hours</th>                            <td>` + workday.hours + `</td>                        </tr>         <tr class="px-6 py-4">                            <th>Observation</th>                            <td>` + workday.observation + `</td>                        </tr>           </tbody>                </table>            </div>`;
                        drawerWorkday.insertAdjacentHTML('beforeend', content);
                    });
                })
                .catch(err => alert(err));
        });
    });

    document.addEventListener('keydown', (e) => {

        if(overlay.style.display === 'block' && e.key === 'Escape') {
            dismissDrawer();
        }
    });

    overlay.addEventListener('click', (e) => {
        e.preventDefault();

        dismissDrawer();
    });

    let dismissDrawer = function () {
        drawerWorkday.innerHTML = '';

        overlay.style.display = 'none';
        drawer.style.right = '-1000px';
    }

    document.querySelector('#add-human-work').addEventListener('click', (e) => {
        let content = `<div class="mb-2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">          <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400">                    <thead></thead>                        <tbody>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Client</th>                            <td> <select name="client" id=""><option value="">...</option>@foreach($clients as $client) <option value="{{ $client->id }}">{{ $client->name }}</option> @endforeach</select> </td>                        </tr>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Project</th>                            <td><select name="project" id=""><option value="">...</option>@foreach($projects as $project) <option value="{{ $project->id }}">{{ $project->name }}</option> @endforeach</select></td>                        </tr>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Activity</th>                            <td><select name="activity" id=""><option value="">...</option>@foreach($activities as $activity) <option value="{{ $activity->id }}">{{ $activity->name }}</option> @endforeach</select></td>                        </tr><tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Subactivity</th>                            <td><select name="subactivity" id=""><option value="">...</option>@foreach($activities as $activity) <option value="{{ $activity->id }}">{{ $activity->name }}</option> @endforeach</select></td>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Hours</th>                            <td> <input name="hours" placeholder="..." type="text"> </td>                        </tr>         <tr class="px-6 py-4">                            <th>Observation</th>                            <td><textarea  name="observation" placeholder="..."></textarea></td>                        </tr>           </tbody>                </table>  <button id="save-work" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">  Save</button>           </div>`;
        drawerWorkday.insertAdjacentHTML('beforeend', content);
        drawerWorkday.scrollTop = drawerWorkday.scrollHeight;

        drawerWorkday.querySelector('#save-work').addEventListener('click', (e) => {
            axios
                .post('/timesheet', {
                    client_id: drawerWorkday.querySelector('[name="client"]').value,
                    project_id: drawerWorkday.querySelector('[name="project"]').value,
                    activity_id: drawerWorkday.querySelector('[name="activity"]').value,
                    hours: drawerWorkday.querySelector('[name="hours"]').value,
                    day: drawerHead.getAttribute('dt-day'),
                })
                .then(res => {
                    axios
                        .get('/getWorkday?day=' + drawerHead.getAttribute('dt-day'))
                        .then(res => {
                            drawerWorkday.innerHTML = '';
                            res.data.forEach(workday => {
                                let content = `<div class="mb-2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">      <div class="flex gap-1" style="float:right;">                                    <x-icons.edit id="edit-work" class="flex-shrink-0 cursor-pointer" style="width: 10px;" aria-hidden="true" /> <x-icons.trash id="delete-work" class="flex-shrink-0 cursor-pointer" style="width: 10px;" aria-hidden="true" /> </div>          <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400">                    <thead></thead>                        <tbody>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Client</th>                            <td>` + workday.client + `</td>                        </tr>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Project</th>                            <td>` + workday.project + `</td>                        </tr>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Activity</th>                            <td>` + workday.activity + `</td>                        </tr><tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Subactivity</th>                            <td>` + workday.activity + `</td>                        <tr class="px-6 py-4 border-b dark:border-gray-700">                            <th>Hours</th>                            <td>` + workday.hours + `</td>                        </tr>         <tr class="px-6 py-4">                            <th>Observation</th>                            <td>` + workday.observation + `</td>                        </tr>           </tbody>                </table>            </div>`;
                                drawerWorkday.insertAdjacentHTML('beforeend', content);
                            });
                        })
                        .catch(err => alert(err));
                })
        });
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
        right: -1000px;
        width: 35%;
        height: 100vh;
        box-shadow: -10px 0px 40px rgba(0,0,0,0.1);
        padding: 40px 20px;
    }

    @media only screen and (max-width: 600px) {
        #drawer {
            width: 80%;
        }
    }

    #drawer-head {
        margin-top: 50px;
    }

    #drawer-body {
        overflow-y: scroll;
        max-height: 75vh;
    }
</style>
