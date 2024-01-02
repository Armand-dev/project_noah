@props([
    'task' => null
])
<div>
    <div class="text-2xl">{{ $task->title }}</div>
    <div class="flex mt-2 justify-start gap-2 mt-6">
        <div>
            <button class="button text-xs bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md px-3 py-1 text-gray-800 dark:text-gray-200">
                <div class="flex items-center">
                    <div class="mr-1"><x-icons.attach /> </div>
                    <div>Attach file</div>
                </div>
            </button>
        </div>

        <div>
            <button class="button text-xs bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md px-3 py-1 text-gray-800 dark:text-gray-200">
                <div class="flex items-center">
                    <div class="mr-1"><x-icons.link /> </div>
                    <div>Attach link</div>
                </div>
            </button>
        </div>

        <div class="relative inline-block text-left">
            <div>
                <button type="button" style="line-height: 24px;" class="button text-xs bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md px-3 py-1 text-gray-800 dark:text-gray-200" id="menu-button" aria-expanded="true" aria-haspopup="true">
                    ...
                </button>
            </div>

            <div class="dark:bg-gray-700 absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
{{--                    <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">License</a>--}}
                    <form method="POST" class="" action="{{ route('task.destroy', $task->id) }}" role="none">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dark:hover:bg-gray-900 hover:bg-gray-50 flex items-center text-red-600 dark:text-red-400 block w-full px-4 py-2 text-left text-sm" role="menuitem" tabindex="-1" id="menu-item-3">
                            <x-icons.trash /> <span class="ml-1">Delete</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <hr class="mt-6 border-gray-200 dark:border-gray-900 mb-2">
    <!-- Two columns /-->
    <div class="flex mt-6">
        <div style="width: 33%;">
            <!-- Item /-->
            <div class="flex">
                <div style="width: 25%; line-height: 24px;" class="text-xs font-medium">
                    Assignee:
                </div>
                <div style="width: 75%; line-height: 24px;" class="text-sm">
                        <div class="relative ">
                            <button type="button" id="user-list" class="relative w-48 cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">
                                  <span class="flex items-center">
                                      <span id="selected-user-avatar">
                                      {!! $task->assignee->getAvatarUrl(20) !!}
                                      </span>
                                    <span class="ml-3 block truncate" id="selected-user-name">{{ $task->assignee->name }}</span>
                                  </span>

                                <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                    </svg>
                                  </span>
                            </button>

                            <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="user-list" aria-activedescendant="listbox-option-3">
                                <!--
                                  Select option, manage highlight styles based on mouseenter/mouseleave and keyboard navigation.

                                  Highlighted: "bg-indigo-600 text-white", Not Highlighted: "text-gray-900"
                                -->
                                @foreach(auth()->user()->employerCompany->employees as $user)
                                    <li dt-user-id="{{ $user->id }}" class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="user-list-option">
                                        <div class="flex items-center">
                                            {!! $user->getAvatarUrl(20) !!}
                                            <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                                            <span class="font-normal ml-3 block truncate">{{ $user->name }}</span>
                                        </div>

{{--                                        @if($user->id === $task->assignee->id)--}}
{{--                                            <!----}}
{{--                                              Checkmark, only display for selected option.--}}

{{--                                              Highlighted: "text-white", Not Highlighted: "text-indigo-600"--}}
{{--                                            -->--}}
{{--                                            <span class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">--}}
{{--                                              <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />--}}
{{--                                              </svg>--}}
{{--                                            </span>--}}
{{--                                        @endif--}}
                                    </li>
                                @endforeach

                                <!-- More items... -->
                            </ul>
                        </div>
{{--                    <div><span class="mr-1">{!! $task->assignee->getAvatarUrl(28) !!}</span> {{ $task->assignee->name }}</div>--}}
{{--                    <div class="mt-2">--}}
{{--                        <button class=" flex align-middle items-center">--}}
{{--                            <div class="bg-purple text-white text-xs mr-2" style="border-radius: 50%; height: 20px; width: 20px; line-height: 17px;">+</div>--}}
{{--                            <div style="line-height: 33px;" class="font-medium text-xs">Add assignee</div>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!-- End Item /-->
            <!-- Item /-->
            <div class="flex mt-6">
                <div style="width: 25%; line-height: 24px;" class="text-xs font-medium">
                    Status:
                </div>
                <div style="width: 75%; line-height: 24px;" class="text-sm">
                    <div class="relative ">
                        <button type="button" id="status-list" class="relative w-48 cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" aria-haspopup="listbox" aria-expanded="true" aria-labelledby="listbox-label">

                            <span id="selected-status">
                                @switch($task->status)
                                    @case(1)
                                        <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-900 px-2 py-1 text-xs text-gray-600 dark:text-gray-100 ring-1 ring-inset ring-gray-500/10">Not started</span>
                                        @break
                                    @case(2)
                                        <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900 px-2 py-1 text-xs text-blue-700 dark:text-blue-100 ring-1 ring-inset ring-blue-700/10">In progress</span>
                                        @break
                                    @case(3)
                                        <span class="inline-flex items-center rounded-md bg-yellow-50 dark:bg-yellow-900 px-2 py-1 text-xs text-yellow-800 dark:text-yellow-100 ring-1 ring-inset ring-yellow-600/20">On hold</span>
                                        @break
                                    @case(4)
                                        <span class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-900 px-2 py-1 text-xs text-green-700 dark:text-green-100 ring-1 ring-inset ring-green-600/20">Done</span>
                                        @break
                                @endswitch
                            </span>

                            <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                                    </svg>
                                  </span>
                        </button>

                        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="status-list" aria-activedescendant="listbox-option-3">
                                <li dt-status-id="1" class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="status-list-option">
                                    <span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-900 px-2 py-1 text-xs text-gray-600 dark:text-gray-100 ring-1 ring-inset ring-gray-500/10">Not started</span>
                                </li>

                                <li dt-status-id="2" class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="status-list-option">
                                    <span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900 px-2 py-1 text-xs text-blue-700 dark:text-blue-100 ring-1 ring-inset ring-blue-700/10">In progress</span>
                                </li>

                                <li dt-status-id="3" class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="status-list-option">
                                    <span class="inline-flex items-center rounded-md bg-yellow-50 dark:bg-yellow-900 px-2 py-1 text-xs text-yellow-800 dark:text-yellow-100 ring-1 ring-inset ring-yellow-600/20">On hold</span>
                                </li>

                                <li dt-status-id="4" class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-0" role="status-list-option">
                                    <span class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-900 px-2 py-1 text-xs text-green-700 dark:text-green-100 ring-1 ring-inset ring-green-600/20">Done</span>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Item /-->
            <!-- Item /-->
            <div class="flex mt-6">
                <div style="width: 25%; line-height: 24px;" class="text-xs font-medium">
                    Due Date:
                </div>
                <div style="width: 75%; line-height: 24px;" class="text-sm flex gap-1 text-gray-700 dark:text-gray-200">
{{--                    <x-icons.calendar />--}}
{{--                    <div class="text-xs" style="line-height: 26px;">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>--}}
                    <input type="date" class="w-48 text-xs text-dark-eval-0 border-gray-300 rounded-md" value="{{ $task->due_date }}">
                </div>
            </div>
            <!-- End Item /-->
            <!-- Item /-->
            <div class="flex mt-6">
                <div>
                    <a href="#" class="inline-flex items-center transition-colors  select-none disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-eval-2 px-4 py-2 text-base bg-purple text-white hover:bg-green-600 focus:ring-green-500 rounded-md px-6 py-2 text-sm">Add sub-task &nbsp;&nbsp;&nbsp;+</a>
                </div>
            </div>
            <!-- End Item /-->
        </div>
        <div style="width: 67%;">
            <!-- Item /-->
            <div>
                <div class="font-medium text-xs mb-2">Description</div>
                <div>
                    <textarea class="w-full rounded-md border-gray-200 dark:border-gray-700 dark:bg-dark-eval-0 text-sm">{{ $task->description }}</textarea>
                </div>
            </div>
            <!-- End Item /-->
        </div>
    </div>
    <!-- END Two columns /-->
    <div class="mt-16 w-full">
        <div class="flex justify-between">
            <div>
                All Comments
            </div>
            <div>
                <button class="text-xs font-medium border border-gray-200 p-2 rounded-md">Newest first</button>
            </div>
        </div>
        <div class="mt-4 flex align-middle items-center gap-4">
            <div>
                {!! auth()->user()->getAvatarUrl(36) !!}
            </div>
            <div class="w-full">
                <input class="text-xs w-full rounded-md border-gray-200 dark:border-gray-700 dark:bg-dark-eval-0"  type="text" placeholder="Type your comment">
            </div>
        </div>
    </div>
</div>

<script>
    const users = {!! json_encode(auth()->user()->employerCompany->employees->keyBy('id')->toArray())  !!}

    $('[aria-labelledby="menu-button"]').hide();
    $('#menu-button').click(() => {
        $('[aria-labelledby="menu-button"]').toggle();
    });

    $('[aria-labelledby="user-list"]').hide();
    $('#user-list').click(() => {
        $('[aria-labelledby="user-list"]').toggle();

    $('li[role="user-list-option"]').click((e) => {
        let target = null;
        if (e.target.tagName !== 'LI') {
            target = $(e.target).closest('li[role="user-list-option"]')[0];
        } else {
            target = e.target;
        }

        const selectedUser = users[target.getAttribute('dt-user-id')];

        $('#selected-user-name').html(selectedUser.name);
        $('#selected-user-avatar').html(selectedUser.avatar);


        $('[aria-labelledby="user-list"]').hide();
    });



    });

    $('[aria-labelledby="status-list"]').hide();
    $('#status-list').click(() => {
        $('[aria-labelledby="status-list"]').toggle();
    });

    $('li[role="status-list-option"]').click((e) => {
        let target = null;
        if (e.target.tagName !== 'LI') {
            target = $(e.target).closest('li[role="status-list-option"]')[0];
        } else {
            target = e.target;
        }

        console.log(target.getAttribute('dt-status-id'));

        selectedStatus = '';
        if (target.getAttribute('dt-status-id') == 1) {
            selectedStatus = '<span class="inline-flex items-center rounded-md bg-gray-50 dark:bg-gray-900 px-2 py-1 text-xs text-gray-600 dark:text-gray-100 ring-1 ring-inset ring-gray-500/10">Not started</span>';
        } else if (target.getAttribute('dt-status-id') == 2) {
            selectedStatus = '<span class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900 px-2 py-1 text-xs text-blue-700 dark:text-blue-100 ring-1 ring-inset ring-blue-700/10">In progress</span>';
        } else if (target.getAttribute('dt-status-id') == 3) {
            selectedStatus = '<span class="inline-flex items-center rounded-md bg-yellow-50 dark:bg-yellow-900 px-2 py-1 text-xs text-yellow-800 dark:text-yellow-100 ring-1 ring-inset ring-yellow-600/20">On hold</span>';
        } else if (target.getAttribute('dt-status-id') == 4) {
            selectedStatus = '<span class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-900 px-2 py-1 text-xs text-green-700 dark:text-green-100 ring-1 ring-inset ring-green-600/20">Done</span>';
        }




        $('#selected-status').html(selectedStatus);

        $('[aria-labelledby="status-list"]').hide();
    });

</script>
