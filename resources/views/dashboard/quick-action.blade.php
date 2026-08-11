<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

    <h2 class="font-bold text-xl">

        Quick Action

    </h2>

    <div class="grid grid-cols-2 gap-4 mt-6">

        <a href="{{ route('posyandu.create') }}"
            class="rounded-2xl p-5 bg-blue-50 hover:bg-blue-100 transition">

            <div class="text-3xl">

                🏥

            </div>

            <h3 class="font-bold mt-3">

                Posyandu

            </h3>

            <p class="text-sm text-gray-500">

                Tambah Data

            </p>

        </a>

        <a href="{{ route('peserta.create') }}"
            class="rounded-2xl p-5 bg-green-50 hover:bg-green-100 transition">

            <div class="text-3xl">

                👶

            </div>

            <h3 class="font-bold mt-3">

                Peserta

            </h3>

            <p class="text-sm text-gray-500">

                Tambah Data

            </p>

        </a>

        <a href="{{ route('jadwal.create') }}"
            class="rounded-2xl p-5 bg-yellow-50 hover:bg-yellow-100 transition">

            <div class="text-3xl">

                📅

            </div>

            <h3 class="font-bold mt-3">

                Jadwal

            </h3>

            <p class="text-sm text-gray-500">

                Buat Jadwal

            </p>

        </a>

        <a href="{{ route('message-log.index') }}"
            class="rounded-2xl p-5 bg-purple-50 hover:bg-purple-100 transition">

            <div class="text-3xl">

                💬

            </div>

            <h3 class="font-bold mt-3">

                Log

            </h3>

            <p class="text-sm text-gray-500">

                Lihat Reminder

            </p>

        </a>

    </div>

</div>
