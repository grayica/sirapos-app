<div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-8 text-white">

    <div class="flex justify-between items-center">

        <div>

            <h2 class="text-2xl font-bold">
                Insight Bulan Ini
            </h2>

            <p class="text-indigo-100 mt-2">

                Tingkat keberhasilan reminder mencapai

                <span class="font-bold">

                    {{ $successRate }}%

                </span>

            </p>

        </div>

        <div class="text-right">

            <div class="text-5xl font-black">

                {{ $successRate }}%

            </div>

            <p class="text-indigo-100">

                Success Rate

            </p>

        </div>

    </div>

    <div class="w-full bg-white/20 rounded-full h-4 mt-8">

        <div
            class="bg-white h-4 rounded-full"
            style="width: {{ $successRate }}%">

        </div>

    </div>

</div>
