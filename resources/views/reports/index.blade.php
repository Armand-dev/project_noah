<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Reports') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-1 overflow-hidden">

        <div class="relative overflow-x-auto">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <!-- Report W-001 -->
                <div class="border rounded p-4 bg-white shadow-md dark:bg-gray-700 dark:border-gray-500">
                    <div class="text-left text-gray-700 font-bold text-lg dark:text-gray-100">
                        Report W-001
                        <button  onclick="modalW001Handler(true)" class="text-sm bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded float-right">
                            Download
                        </button>
                    </div>
                    <div class="text-left text-gray-700 text-sm mt-4 dark:text-gray-100">Displays worked hours by specific human resources, split between different projects and activities. Perfect for work overview and help create customer invoices.</div>
                </div>


                <!-- Report W-002 -->
                <div class="border rounded p-4 bg-white shadow-md dark:bg-gray-700 dark:border-gray-500">
                    <div class="text-left text-gray-700 font-bold text-lg dark:text-gray-100">
                        Report W-002
{{--                        <button  onclick="modalW002Handler(true)" class="text-sm bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded float-right">--}}
{{--                            Download--}}
{{--                        </button>--}}
                    </div>
                    <div class="text-left text-gray-700 text-sm mt-4 dark:text-gray-100">Displays worked hours by specific human resources, split between different projects and activities. Perfect for work overview and help create customer invoices.</div>
                </div>

                <!-- Report W-003 -->
                <div class="border rounded p-4 bg-white shadow-md dark:bg-gray-700 dark:border-gray-500">
                    <div class="text-left text-gray-700 font-bold text-lg dark:text-gray-100">
                        Report W-003
{{--                        <button  onclick="modalW002Handler(true)" class="text-sm bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded float-right">--}}
{{--                            Download--}}
{{--                        </button>--}}
                    </div>
                    <div class="text-left text-gray-700 text-sm mt-4 dark:text-gray-100">Displays worked hours by specific human resources, split between different projects and activities. Perfect for work overview and help create customer invoices.</div>
                </div>

                <!-- Report W-004 -->
                <div class="border rounded p-4 bg-white shadow-md dark:bg-gray-700 dark:border-gray-500">
                    <div class="text-left text-gray-700 font-bold text-lg dark:text-gray-100">
                        Report W-004
{{--                        <button  onclick="modalW002Handler(true)" class="text-sm bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded float-right">--}}
{{--                            Download--}}
{{--                        </button>--}}
                    </div>
                    <div class="text-left text-gray-700 text-sm mt-4 dark:text-gray-100">Displays worked hours by specific human resources, split between different projects and activities. Perfect for work overview and help create customer invoices.</div>
                </div>

                <!-- Report W-005 -->
                <div class="border rounded p-4 bg-white shadow-md dark:bg-gray-700 dark:border-gray-500">
                    <div class="text-left text-gray-700 font-bold text-lg dark:text-gray-100">
                        Report W-005
{{--                        <button  onclick="modalW002Handler(true)" class="text-sm bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded float-right">--}}
{{--                            Download--}}
{{--                        </button>--}}
                    </div>
                    <div class="text-left text-gray-700 text-sm mt-4 dark:text-gray-100">Displays worked hours by specific human resources, split between different projects and activities. Perfect for work overview and help create customer invoices.</div>
                </div>

            </div>
        </div>

    </div>

    <div style="background-color: rgba(0,0,0,0.3);" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full" id="W-001">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            W-001 Report Parameters
                        </h3>
                        <button type="button" onclick="modalW001Handler()"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <form action="#" class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                The W-001 Report requires some parameters. Please fill in below.
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Start date" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="End date" required="">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="projects" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Projects</label>
                                @foreach($projects as $project)
                                    <div class="flex items-center mb-4">
                                        <input id="{{ $project->name }}" type="checkbox" name="projects[]" value="{{ $project->id }}" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="{{ $project->name }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $project->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="users" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Users</label>
                                @foreach($users as $user)
                                    <div class="flex items-center mb-4">
                                        <input id="{{ $user->name }}" type="checkbox" name="users[]" value="{{ $user->id }}" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="{{ $user->name }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $user->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" id="downloadW001" dt-report="W-001" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Download
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }
        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }

        let modalW001 = document.getElementById("W-001");
        function modalW001Handler(val) {
            if (val) {
                fadeIn(modalW001);
            } else {
                fadeOut(modalW001);
            }
        }

        document.querySelector('#downloadW001').addEventListener('click', (e) => {
            e.preventDefault();

            let startDate = modalW001.querySelector('[name="start_date"]').value;
            let endDate = modalW001.querySelector('[name="end_date"]').value;
            let projects = [];
            let users = [];

            modalW001.querySelectorAll('[name="projects[]"]:checked').forEach(project => {
                projects.push(project.value);
            });

            modalW001.querySelectorAll('[name="users[]"]:checked').forEach(user => {
                users.push(user.value);
            });

            fadeOut(modalW001);

            axios
                .post('/report?report=W001', {
                    'startDate': startDate,
                    'endDate': startDate,
                    'projects': projects,
                    'users': users,
                })
                .then(res => {
                    alert(res.data.message);
                })
                .catch(err => alert(err));
        });


    </script>
</x-app-layout>
