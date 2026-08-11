<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

    <div class="flex items-center justify-between">

        <div>

            <h2 class="font-bold text-xl">
                Status Sistem
            </h2>

            <p class="text-gray-500 text-sm">
                Monitoring layanan
            </p>

        </div>

        <div class="text-3xl">
            ⚙️
        </div>

    </div>

    <div class="mt-6 space-y-4">

        <div class="flex justify-between items-center">

            <span>Database</span>

            <span class="text-green-600 font-semibold">
                🟢 Online
            </span>

        </div>

        <div class="flex justify-between items-center">

            <span>WhatsApp API</span>

            <span class="text-green-600 font-semibold">
                🟢 Aktif
            </span>

        </div>

        <div class="flex justify-between items-center">

            <span>Reminder Hari Ini</span>

            <span class="font-bold">
                {{ $reminderHariIni }}
            </span>

        </div>

        <div class="flex justify-between items-center">

            <span>Success Rate</span>

            <span class="font-bold text-blue-600">

                {{ $successRate }}%

            </span>

        </div>

    </div>

</div>
