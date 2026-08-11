<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    @if (Auth::user()->isSuperAdmin())
        <x-ui.stat-card title="Total Posyandu" :value="$totalPosyandu" subtitle="Data Posyandu" icon="🏥" color="blue" />

        <x-ui.stat-card title="Total Peserta" :value="$totalPeserta" subtitle="Peserta Terdaftar" icon="👶"
            color="green" />

        <x-ui.stat-card title="Total Worker" :value="$totalWorker" subtitle="Akun Worker" icon="👷" color="yellow" />

        <x-ui.stat-card title="Reminder" :value="$totalReminder" subtitle="WhatsApp Terkirim" icon="💬" color="purple" />
    @else
        <x-ui.stat-card title="Posyandu Saya" :value="Auth::user()->posyandu->nama_posyandu ?? '-'" subtitle="Posyandu" icon="🏥" color="blue" />

        <x-ui.stat-card title="Peserta" :value="$totalPeserta" subtitle="Peserta Terdaftar" icon="👶" color="green" />

        <x-ui.stat-card title="Jadwal" :value="$totalJadwal" subtitle="Jadwal Posyandu" icon="📅" color="yellow" />

        <x-ui.stat-card title="Reminder" :value="$totalReminder" subtitle="WhatsApp Terkirim" icon="💬" color="purple" />
    @endif

</div>
