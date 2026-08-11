<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

    <div class="flex justify-between">

        <h2 class="font-bold text-xl">

            Jadwal Hari Ini

        </h2>

        <span class="text-gray-500">

            {{ $todaySchedules->count() }}

        </span>

    </div>

    <div class="mt-6 space-y-4">

        @forelse($todaySchedules as $jadwal)

            <div
                class="border rounded-2xl p-4 hover:bg-gray-50 transition">

                <div class="flex justify-between">

                    <div>

                        <h3 class="font-semibold">

                            {{ $jadwal->posyandu->nama }}

                        </h3>

                        <p class="text-gray-500 text-sm">

                            {{ $jadwal->jam }}

                        </p>

                    </div>

                    <span
                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                        {{ $jadwal->status }}

                    </span>

                </div>

            </div>

        @empty

            <div class="text-center py-10">

                <div class="text-5xl">

                    📅

                </div>

                <p class="mt-3 text-gray-500">

                    Tidak ada jadwal hari ini

                </p>

            </div>

        @endforelse

    </div>

</div>
