<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>
{{--    <span class="text-gray-500 bg-gray-100 rounded p-2"><span class="text-xs">Company:</span> <br><span class="text-sm font-semibold">{{ auth()->user()->companies()->first()->name }}</span></span>--}}

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
            Tasks
    </div>

    <x-sidebar.link
        title="Timesheet"
        href="{{ route('timesheet.index') }}"
        :isActive="request()->routeIs('timesheet.index')"
    >
        <x-slot name="icon">
            <x-icons.time class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <x-sidebar.link
        title="To Do"
        href="{{ route('task.index') }}"
        :isActive="request()->routeIs('task.index')"
    >
        <x-slot name="icon">
            <x-icons.todo class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

{{--    <x-sidebar.dropdown--}}
{{--        title="Buttons"--}}
{{--        :active="Str::startsWith(request()->route()->uri(), 'buttons')"--}}
{{--    >--}}
{{--        <x-slot name="icon">--}}
{{--            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />--}}
{{--        </x-slot>--}}

{{--        <x-sidebar.sublink--}}
{{--            title="Text button"--}}
{{--            href="{{ route('buttons.text') }}"--}}
{{--            :active="request()->routeIs('buttons.text')"--}}
{{--        />--}}
{{--        <x-sidebar.sublink--}}
{{--            title="Icon button"--}}
{{--            href="{{ route('buttons.icon') }}"--}}
{{--            :active="request()->routeIs('buttons.icon')"--}}
{{--        />--}}
{{--        <x-sidebar.sublink--}}
{{--            title="Text with icon"--}}
{{--            href="{{ route('buttons.text-icon') }}"--}}
{{--            :active="request()->routeIs('buttons.text-icon')"--}}
{{--        />--}}
{{--    </x-sidebar.dropdown>--}}

    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Communication
    </div>

    <x-sidebar.link
        title="Company chat"
        href="{{ route('chat.index') }}"
        :isActive="request()->routeIs('chat.index')"
    >
        <x-slot name="icon">
            <x-icons.chat class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @if(auth()->user()->hasRole('leader'))
        <div
            x-transition
            x-show="isSidebarOpen || isSidebarHovered"
            class="text-sm text-gray-500"
        >
            Admin
        </div>
    @endif
    @if(auth()->user()->hasPermissionTo('create users'))
        <x-sidebar.link
            title="Users"
                    href="{{ route('user.index') }}"
            :isActive="request()->routeIs('user.index')"
        >
            <x-slot name="icon">
                <x-icons.user class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif

    @if(auth()->user()->hasRole('leader'))
        <x-sidebar.link
            title="Clients"
            href="{{ route('client.index') }}"
            :isActive="request()->routeIs('client.index')"
        >
            <x-slot name="icon">
                <x-icons.client class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif

    @if(auth()->user()->hasRole('leader'))
        <x-sidebar.link
            title="Projects"
            href="{{ route('project.index') }}"
            :isActive="request()->routeIs('project.index')"
        >
            <x-slot name="icon">
                <x-icons.projects class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif

    @if(auth()->user()->hasRole('leader'))
        <x-sidebar.link
            title="Activities"
            href="{{ route('activity.index') }}"
            :isActive="request()->routeIs('activity.index')"
        >
            <x-slot name="icon">
                <x-icons.activities class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif

    @if(auth()->user()->hasRole('leader'))
        <x-sidebar.link
            title="Reports"
            href="{{ route('report.index') }}"
            :isActive="request()->routeIs('report.index')"
        >
            <x-slot name="icon">
                <x-icons.reports class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endif


{{--    @php--}}
{{--        $links = array_fill(0, 20, '');--}}
{{--    @endphp--}}

{{--    @foreach ($links as $index => $link)--}}
{{--        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />--}}
{{--    @endforeach--}}

</x-perfect-scrollbar>
