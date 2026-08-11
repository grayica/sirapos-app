<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 space-y-6">

        @include('dashboard.hero')

        @include('dashboard.stats')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <div class="xl:col-span-2">
                @include('dashboard.chart')
            </div>

            @include('dashboard.system-status')

        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            @include('dashboard.today-schedule')

            @include('dashboard.quick-action')

        </div>

        @include('dashboard.activity')

        @include('dashboard.insight')

    </div>

</x-app-layout>
