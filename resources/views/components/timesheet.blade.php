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

<table id="timesheet" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border dark:border-gray-900">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            @foreach($headings as $heading)
                <th scope="col" class="px-1 py-1 border-r border-gray-200 dark:border-gray-900">
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
                    border-b
                    border-gray-200
                    dark:border-gray-900
                    @if(\Carbon\Carbon::parse($day)->isToday())
                        bg-purple-200 dark:bg-purple-800
                    @elseif($row['meta']['is_weekend'])
                        bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                    @else
                        bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                    @endif
                    "
                    dt-day="{{ $day }}"
                    dt-id="{{ $work['id'] }}"
                    >
                        <th dt-col="day" scope="row" class=" border-r border-gray-200 dark:border-gray-900 @if($loop->last) border-b dark:border-gray-700 @endif px-2 py-2  text-gray-900 whitespace-nowrap @if(\Carbon\Carbon::parse($day)->isToday()) dark:text-gray-700 @else dark:text-white @endif">@if($loop->first)
                                {{ $day ?? '' }}
                            @endif</th>
                        <td dt-col="client" class="px-2 py-2  border-r border-gray-200 dark:border-gray-900">
                            {{ $work['client'] ?? '' }}
                        </td>
                        <td dt-col="project" class="px-2 py-2  border-r border-gray-200 dark:border-gray-900">
                            {{ $work['project'] ?? '' }}
                        </td>
                        <td dt-col="activity" class="px-2 py-2  border-r border-gray-200 dark:border-gray-900">
                            {{ $work['activity'] ?? '' }}
                        </td>
                        <td dt-col="subactivity" class="px-2 py-2  border-r border-gray-200 dark:border-gray-900">
                            {{ $work['subactivity'] ?? '' }}
                        </td>
                        <td dt-col="user" class="px-2 py-2  border-r border-gray-200 dark:border-gray-900">
                            {{ $work['user'] ?? '' }}
                        </td>
                        <td dt-col="hours" class="px-2 py-2 border-r border-gray-200 dark:border-gray-900">
                            {{ $work['hours'] ?? '' }}
                        </td>
                        <td dt-col="observations" class="px-2 py-2  border-r border-gray-200 dark:border-gray-900">
                            {{ $work['observations'] ?? '' }}
                        </td>

                        <td class="px-2 py-2 text-center

                        @if(\Carbon\Carbon::parse($day)->isToday())
                            bg-purple-200 dark:bg-purple-800
                        @elseif($row['meta']['is_weekend'])
                            bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                        @else
                            bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                        @endif
                         sticky right-0 @if($loop->last) border-b dark:border-gray-700 @endif">
                            @if($loop->first)
                                <a
                                    dt-col="edit"
                                    href="#"
                                    class=" text-blue-600 dark:text-blue-500 hover:underline"
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
                border-b
                border-gray-200
                dark:border-gray-900
                @if(\Carbon\Carbon::parse($day)->isToday())
                    bg-purple-200 dark:bg-purple-800
                @elseif($row['meta']['is_weekend'])
                    bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                @else
                    bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                @endif
                "
                dt-day="{{ $day }}"
                >
                    <th dt-col="day" scope="row" class="border-r border-gray-200 dark:border-gray-900 px-2 py-2  text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $day ?? ''}}
                    </th>
                    <td dt-col="client" class="px-2 py-2 border-r border-gray-200 dark:border-gray-900"></td>
                    <td dt-col="project" class="px-2 py-2 border-r border-gray-200 dark:border-gray-900"></td>
                    <td dt-col="activity" class="px-2 py-2 border-r border-gray-200 dark:border-gray-900"></td>
                    <td dt-col="subactivity" class="px-2 py-2 border-r border-gray-200 dark:border-gray-900"></td>
                    <td dt-col="user" class="px-2 py-2 border-b border-r border-gray-200 dark:border-gray-900"></td>
                    <td dt-col="hours" class="px-2 py-2 border-b border-r border-gray-200 dark:border-gray-900"></td>
                    <td dt-col="observations" class="px-2 py-2 border-b border-r border-gray-200 dark:border-gray-900"></td>

                    <td class="px-2 py-2 text-center border-r border-gray-200 dark:border-gray-900 sticky right-0

                        @if(\Carbon\Carbon::parse($day)->isToday())
                            bg-purple-200 dark:bg-purple-800
                        @elseif($row['meta']['is_weekend'])
                            bg-gray-100 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600
                        @else
                            bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600
                        @endif
                    ">
                        <a
                            dt-col="edit"
                            href="#"
                            class=" text-blue-600 dark:text-blue-500 hover:underline"
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
    let timesheet = document.querySelector('#timesheet');
    let overlay = document.querySelector('#overlay');
    let drawer = document.querySelector('#drawer');
    let drawerHead = drawer.querySelector('#drawer-head');
    let drawerBody = drawer.querySelector('#drawer-body');
    let drawerWorkday = drawerBody.querySelector('#workday');

    let handleEditButton = function () {

    }

    document.querySelectorAll('[dt-col="edit"]').forEach((item) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();

            overlay.style.display = 'block';
            drawer.style.right = '0px';

            let row = e.target.closest('tr');
            let day = row.getAttribute('dt-day');

            drawerHead.querySelector('h5').innerHTML = "Day " + day;
            drawerHead.setAttribute('dt-day', day);

            axios
                .get('/getWorkday?day=' + day)
                .then(res => {
                    res.data.forEach(workday => {
                        let content = `<div dt-id="` + workday.id + `" dt-scope="drawer-workday" class="mb-2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                            <div class="flex gap-4" style="float:right;">
                                                <span id="edit-work" dt-id="` + workday.id + `">
                                                    <x-icons.edit class="flex-shrink-0 cursor-pointer" aria-hidden="true" />
                                                </span>
                                                <span id="delete-work" dt-id="` + workday.id + `" class="cursor-pointer">
                                                    <x-icons.trash class="flex-shrink-0 cursor-pointer" aria-hidden="true" />
                                                </span>
                                            </div>
                                            <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400">
                                                <thead></thead>
                                                <tbody>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Client</th>
                                                        <td>` + workday.client + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Project</th>
                                                        <td>` + workday.project + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Activity</th>
                                                        <td>` + workday.activity + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Subactivity</th>
                                                        <td>` + workday.activity + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Hours</th>
                                                        <td>` + workday.hours + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2">
                                                        <th>Observation</th>
                                                        <td>` + workday.observations + `</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>`;
                        drawerWorkday.insertAdjacentHTML('beforeend', content);
                    });

                    drawerWorkday.querySelectorAll('#delete-work').forEach(item => {
                        item.addEventListener('click', (e) => {
                            let id = e.target.closest('#delete-work').getAttribute('dt-id');

                            if(confirm('Are you sure want to delete this?')) {
                                axios
                                    .delete('/timesheet/' + id)
                                    .then(res => {
                                        axios
                                            .get('/getWorkday?day=' + drawerHead.getAttribute('dt-day'))
                                            .then(res => {
                                                drawerWorkday.querySelector('div[dt-id="'+id+'"]').remove();
                                                let timesheetRow = timesheet.querySelector('tr[dt-id="'+id+'"]');

                                                if(timesheetRow.children[0].childNodes.length) {
                                                    // is row with date
                                                    let rowDay = timesheetRow.getAttribute('dt-day');
                                                    let sameDayWork = timesheet.querySelectorAll('tr[dt-day="'+ rowDay +'"]');

                                                    if(sameDayWork.length > 1) {
                                                        // move date and edit button to next row

                                                        // copy day to next row
                                                        sameDayWork[1].querySelector('th').innerHTML = sameDayWork[0].querySelector('th').innerHTML;

                                                        // copy action column to next row
                                                        sameDayWork[1].querySelector('.sticky').innerHTML = sameDayWork[0].querySelector('.sticky').innerHTML

                                                        // delete row
                                                        timesheet.querySelector('tr[dt-id="'+id+'"]').remove();
                                                    } else {
                                                        // empty this row
                                                        timesheetRow.querySelectorAll('td').forEach(col => {
                                                            if(!col.classList.contains('sticky')) { // skip edit button
                                                                col.innerHTML = '';
                                                            }
                                                        });
                                                    }
                                                } else {
                                                    // is not row with date
                                                    timesheet.querySelector('tr[dt-id="'+id+'"]').remove();
                                                }
                                            })
                                            .catch(err => alert(err));
                                    })
                                    .catch(err => alert(err));
                            }
                        });
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
        if (document.querySelectorAll('#save-work').length) {
            return;
        }

        let content = `<div class="mb-2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">          <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400">                    <thead></thead>                        <tbody>                        <tr class="px-2 py-2 border-b dark:border-gray-700">                            <th>Client</th>                            <td> <select name="client" id="" ><option value="">...</option>@foreach($clients as $client) <option value="{{ $client->id }}">{{ $client->name }}</option> @endforeach</select> </td>                        </tr>                        <tr class="px-2 py-2 border-b dark:border-gray-700">                            <th>Project</th>                            <td><select name="project" id=""><option value="">...</option>@foreach($projects as $project) <option value="{{ $project->id }}">{{ $project->name }}</option> @endforeach</select></td>                        </tr>                        <tr class="px-2 py-2 border-b dark:border-gray-700">                            <th>Activity</th>                            <td><select name="activity" id=""><option value="">...</option>@foreach($activities as $activity) <option value="{{ $activity->id }}">{{ $activity->name }}</option> @endforeach</select></td>                        </tr><tr class="px-2 py-2 border-b dark:border-gray-700">                            <th>Subactivity</th>                            <td><select name="subactivity" id=""><option value="">...</option>@foreach($activities as $activity) <option value="{{ $activity->id }}">{{ $activity->name }}</option> @endforeach</select></td>                        <tr class="px-2 py-2 border-b dark:border-gray-700">                            <th>Hours</th>                            <td> <input name="hours" placeholder="..." type="text"> </td>                        </tr>         <tr class="px-2 py-2">                            <th>Observation</th>                            <td><textarea  name="observations" placeholder="..."></textarea></td>                        </tr>           </tbody>                </table>  <button id="save-work" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">  Save</button>           </div>`;
        drawerWorkday.insertAdjacentHTML('beforeend', content);
        drawerWorkday.scrollTop = drawerWorkday.scrollHeight;

        drawerWorkday.querySelector('#save-work').addEventListener('click', (e) => {
            let day = drawerHead.getAttribute('dt-day');

            axios
                .post('/timesheet', {
                    client_id: drawerWorkday.querySelector('[name="client"]').value,
                    project_id: drawerWorkday.querySelector('[name="project"]').value,
                    activity_id: drawerWorkday.querySelector('[name="activity"]').value,
                    hours: drawerWorkday.querySelector('[name="hours"]').value,
                    observations: drawerWorkday.querySelector('[name="observations"]').value,
                    day: drawerHead.getAttribute('dt-day'),
                })
                .then(res => {
                    axios
                        .get('/getWorkday?day=' + drawerHead.getAttribute('dt-day'))
                        .then(res => {
                            drawerWorkday.innerHTML = '';
                            res.data.forEach(workday => {
                                let content = `
                                    <div class="mb-2 block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <div class="flex gap-1" style="float:right;">
                                            <x-icons.edit id="edit-work" class="flex-shrink-0 cursor-pointer" style="width: 10px;" aria-hidden="true" />
                                            <x-icons.trash id="delete-work" class="flex-shrink-0 cursor-pointer" style="width: 10px;" aria-hidden="true" />
                                        </div>
                                        <table class="w-full table-auto text-left text-gray-500 dark:text-gray-400">
                                            <thead></thead>
                                            <tbody>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Client</th>
                                                        <td>` + workday.client + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Project</th>
                                                        <td>` + workday.project + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Activity</th>
                                                        <td>` + workday.activity + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Subactivity</th>
                                                        <td>` + workday.activity + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2 border-b dark:border-gray-700">
                                                        <th>Hours</th>
                                                        <td>` + workday.hours + `</td>
                                                    </tr>
                                                    <tr class="px-2 py-2">
                                                        <th>Observation</th>
                                                        <td>` + workday.observations + `</td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>`;
                                drawerWorkday.insertAdjacentHTML('beforeend', content);
                            });
                        })
                        .catch(err => alert(err));


                    let timesheetRows = timesheet.querySelectorAll('tr[dt-day="'+day+'"]');
                    console.log(timesheetRows);

                    if(timesheetRows.length > 1 || (timesheetRows.length == 1 && timesheetRows[0].getAttribute('dt-id'))) {
                        // append new row after last
                        let newRow = timesheetRows[timesheetRows.length - 1].cloneNode(true);
                        newRow.setAttribute('dt-id', res.data.id);
                        newRow.querySelector('[dt-col="day"]').innerHTML = '';
                        newRow.querySelector('[dt-col="client"]').innerHTML = res.data.client;
                        newRow.querySelector('[dt-col="project"]').innerHTML = res.data.project;
                        newRow.querySelector('[dt-col="activity"]').innerHTML = res.data.activity;
                        newRow.querySelector('[dt-col="subactivity"]').innerHTML = res.data.subactivity;
                        newRow.querySelector('[dt-col="user"]').innerHTML = res.data.user;
                        newRow.querySelector('[dt-col="user"]').innerHTML = res.data.user;
                        newRow.querySelector('[dt-col="observations"]').innerHTML = res.data.observations;

                        timesheetRows[timesheetRows.length - 1].parentNode.insertBefore(newRow, timesheetRows[timesheetRows.length - 1].nextSibling);
                    } else {
                        timesheetRow = timesheetRows[0];

                        timesheetRow.setAttribute('dt-id', res.data.id);
                        timesheetRow.querySelector('[dt-col="client"]').innerHTML = res.data.client;
                        timesheetRow.querySelector('[dt-col="project"]').innerHTML = res.data.project;
                        timesheetRow.querySelector('[dt-col="activity"]').innerHTML = res.data.activity;
                        timesheetRow.querySelector('[dt-col="subactivity"]').innerHTML = res.data.subactivity;
                        timesheetRow.querySelector('[dt-col="user"]').innerHTML = res.data.user;
                        timesheetRow.querySelector('[dt-col="hours"]').innerHTML = res.data.hours;
                        timesheetRow.querySelector('[dt-col="observations"]').innerHTML = res.data.observations;
                    }
                })
                .catch(err => alert(Object.entries(err.response.data.errors).join("\n")));
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
        z-index: 1;
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

    #drawer-body select {
        padding: 2px 4px;
        width: 100%;
    }

    #drawer-body input {
        padding: 2px 4px;
        width: 100%;
    }

    #drawer-body textarea {
        padding: 2px 4px;
        width: 100%;
    }


</style>
