<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">

    <h2 class="font-bold text-xl">

        Aktivitas Terbaru

    </h2>

    <div class="mt-6 space-y-5">

        @forelse($recentLogs as $log)

            <div class="flex gap-4">

                {{-- Icon --}}
                <div>

                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">

                        📋

                    </div>

                </div>

                {{-- Isi --}}
                <div class="flex-1">

                    <h3 class="font-semibold text-gray-800">

                        {{ $log->user->name ?? 'System' }}

                    </h3>

                    <p class="text-sm text-blue-600 font-medium">

                        {{ $log->module }}

                    </p>

                    <p class="text-sm text-gray-600 mt-1">

                        <strong>{{ $log->activity }}</strong>

                    </p>

                    @if($log->description)

                        <p class="text-xs text-gray-500 mt-1">

                            {{ $log->description }}

                        </p>

                    @endif

                    <p class="text-xs text-gray-400 mt-2">

                        {{ $log->created_at->diffForHumans() }}

                    </p>

                </div>

                {{-- IP --}}
                <div class="text-right">

                    <span
                        class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-600">

                        {{ $log->ip_address }}

                    </span>

                </div>

            </div>

        @empty

            <div class="text-center py-10">

                <div class="text-5xl">

                    📭

                </div>

                <p class="text-gray-500 mt-3">

                    Belum ada aktivitas.

                </p>

            </div>

        @endforelse

    </div>

</div>
