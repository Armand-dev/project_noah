@props([
    'task' => null
])
<div>
    <div class="text-2xl">{{ $task->title }}</div>
    <div class="flex mt-2 gap-3 mt-6">
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

        <div>
            <button class="button text-xs bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-700 rounded-md px-3 py-1 text-gray-800 dark:text-gray-200">
                <div class="flex items-center">
                    <div style="line-height: 24px;">...</div>
                </div>
            </button>
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
                    <div><span class="mr-1">{!! $task->assignee->getAvatarUrl(28) !!}</span> {{ $task->assignee->name }}</div>
                    <div class="mt-2">
                        <button class=" flex align-middle items-center">
                            <div class="bg-purple text-white text-xs mr-2" style="border-radius: 50%; height: 20px; width: 20px; line-height: 17px;">+</div>
                            <div style="line-height: 33px;" class="font-medium text-xs">Add assignee</div>
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Item /-->
            <!-- Item /-->
            <div class="flex mt-6">
                <div style="width: 25%; line-height: 24px;" class="text-xs font-medium">
                    Status:
                </div>
                <div style="width: 75%; line-height: 24px;" class="text-sm">

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
                </div>
            </div>
            <!-- End Item /-->
            <!-- Item /-->
            <div class="flex mt-6">
                <div style="width: 25%; line-height: 24px;" class="text-xs font-medium">
                    Due Date:
                </div>
                <div style="width: 75%; line-height: 24px;" class="text-sm flex gap-1 text-gray-700 dark:text-gray-200">
                    <x-icons.calendar />
                    <div class="text-xs" style="line-height: 26px;">{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</div>
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
