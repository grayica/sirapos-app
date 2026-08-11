<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="mb-4">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Posyandu</label>
        <select name="posyandu_id"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

            <option value="">-- Pilih Posyandu --</option>

            @foreach ($posyandus as $posyandu)
                <option value="{{ $posyandu->id }}"
                    {{ old('posyandu_id', $peserta->posyandu_id ?? '') == $posyandu->id ? 'selected' : '' }}>
                    {{ $posyandu->nama_posyandu }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Nama Penerima</label>
        <input type="text" placeholder="Masukkan nama penerima" name="nama_penerima"
            value="{{ old('nama_penerima', $peserta->nama_penerima ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">
    </div>

    <div class="mb-4">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Hubungan Penerima</label>
        <select name="hubungan_penerima"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">
            @foreach (['Ibu', 'Ayah', 'Wali', 'Diri Sendiri'] as $h)
                <option value="{{ $h }}"
                    {{ old('hubungan_penerima', $peserta->hubungan_penerima ?? '') == $h ? 'selected' : '' }}>
                    {{ $h }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4 md:col-span-2">
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Nama Peserta
            <span class="text-red-500">*</span>
        </label>

        <input type="text" name="nama_peserta" placeholder="Masukkan nama peserta"
            value="{{ old('nama_peserta', $peserta->nama_peserta ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">
    </div>

    <div class="mb-4">

        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Jenis Data
        </label>


        <div class="rounded-xl bg-slate-100 px-4 py-3">

            @if ($jenisData == 'hamil')
                🤰 Ibu Hamil
            @else
                👨 Peserta Umum
            @endif

        </div>

        <input type="hidden" id="jenis_peserta" name="jenis_peserta"
            value="{{ old('jenis_peserta', $peserta->jenis_peserta ?? '') }}">

    </div>


</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div id="tanggal_lahir_group" class="mb-4 {{ $jenisData == 'umum' ? '' : 'hidden' }}">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Tanggal Lahir</label>
        <input id="tanggal_lahir" type="date" name="tanggal_lahir"
            value="{{ old('tanggal_lahir', isset($peserta) && $peserta->tanggal_lahir ? $peserta->tanggal_lahir->format('Y-m-d') : '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

        <p class="mt-1 text-xs text-slate-500">
            Digunakan untuk menghitung usia peserta secara otomatis.
        </p>

        <div id="umurInfo"
            class="hidden mt-3 rounded-lg bg-emerald-50 border border-blue-200 text-emerald-700 px-4 py-2 text-sm">
        </div>

        <div id="jenisPesertaInfo" class="hidden mt-3 rounded-lg border border-indigo-200 bg-indigo-50 px-4 py-2">

            <span class="text-sm text-indigo-700">
                Jenis Peserta :
                <strong id="jenisPesertaText"></strong>
            </span>

        </div>

    </div>

    <div id="tanggal_kehamilan_group" class="mb-4 {{ $jenisData == 'hamil' ? '' : 'hidden' }}">

        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Usia Kehamilan Saat Ini (Minggu)
        </label>

        <input type="number" name="usia_kehamilan" min="1" max="45"
            value="{{ old('usia_kehamilan', $usiaKehamilan ?? '') }}"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5">

        <p class="mt-1 text-xs text-slate-500">
            Masukkan usia kehamilan saat ini sesuai hasil pemeriksaan bidan atau Buku KIA. Sistem akan menghitung
            perkiraan awal kehamilan dan HPL secara otomatis.
        </p>

        <div id="previewKehamilan" class="hidden mt-4 rounded-xl border border-pink-200 bg-pink-50 p-4">

            <div class="text-sm text-pink-700">
                <p>
                    📅 <strong>Perkiraan Mulai Kehamilan</strong>
                </p>

                <p id="tanggalMulaiPreview" class="mt-1"></p>

                <hr class="my-3">

                <p>
                    👶 <strong>Perkiraan Persalinan (HPL)</strong>
                </p>

                <p id="tanggalLahirPreview" class="mt-1"></p>
            </div>

        </div>

    </div>
    <div class="mb-4">
        <label class="mb-2 block text-sm font-semibold text-slate-700">
            Nomor WhatsApp
            <span class="text-red-500">*</span>
        </label>

        <input type="text" name="nomor_whatsapp" value="{{ old('nomor_whatsapp', $peserta->nomor_whatsapp ?? '') }}"
            placeholder="Contoh: 081234567890" inputmode="numeric" pattern="08[0-9]{8,13}" maxlength="15" required
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">

        <p class="mt-1 text-xs text-slate-500">
            Gunakan nomor WhatsApp aktif...
        </p>

        @error('nomor_whatsapp')
            <p class="text-red-500 text-sm mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="mb-6">
        <label class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
        <select name="status"
            class="w-full rounded-xl border border-slate-300 px-4 py-2.5 focus:border-emerald-500 focus:ring-emerald-500">
            @foreach (['Aktif', 'Nonaktif'] as $st)
                <option value="{{ $st }}"
                    {{ old('status', $peserta->status ?? '') == $st ? 'selected' : '' }}>
                    {{ $st }}</option>
            @endforeach
        </select>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const tanggalInput = document.getElementById('tanggal_lahir');
        const umurInfo = document.getElementById('umurInfo');
        const jenisPesertaInfo = document.getElementById('jenisPesertaInfo');
        const jenisPesertaText = document.getElementById('jenisPesertaText');

        const whatsapp = document.querySelector('input[name="nomor_whatsapp"]');
        const usiaInput = document.querySelector(
            'input[name="usia_kehamilan"]'
        );

        const preview = document.getElementById("previewKehamilan");
        const mulai = document.getElementById("tanggalMulaiPreview");
        const hpl = document.getElementById("tanggalLahirPreview");

        const form = document.querySelector('form');

        function hitungUmur() {

            if (!tanggalInput || !umurInfo) return;

            if (!tanggalInput.value) {
                umurInfo.classList.add('hidden');
                jenisPesertaInfo.classList.add('hidden');
                return;
            }

            const lahir = new Date(tanggalInput.value);
            const sekarang = new Date();

            let tahun = sekarang.getFullYear() - lahir.getFullYear();
            let bulan = sekarang.getMonth() - lahir.getMonth();

            if (bulan < 0) {
                tahun--;
                bulan += 12;
            }

            umurInfo.classList.remove('hidden');
            umurInfo.innerHTML =
                `Usia : <strong>${tahun} Tahun ${bulan} Bulan</strong>`;

            tentukanJenisPeserta(tahun, bulan);
        }

        if (tanggalInput) {
            tanggalInput.addEventListener('change', hitungUmur);
            hitungUmur();
        }

        if (whatsapp) {
            whatsapp.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        if (form) {
            form.addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');

                if (btn) {
                    btn.disabled = true;
                    btn.innerHTML = 'Menyimpan...';
                }
            });
        }

        function tentukanJenisPeserta(tahun, bulan) {
            let jenis = "";

            const hiddenJenis = document.getElementById('jenis_peserta');

            if (tahun < 1) {
                jenis = "👶 Bayi";
                hiddenJenis.value = "Bayi";
            } else if (tahun < 5) {
                jenis = "🧒 Balita";
                hiddenJenis.value = "Balita";
            } else if (tahun < 10) {
                jenis = "🧑 Anak";
                hiddenJenis.value = "Anak";
            } else if (tahun < 19) {
                jenis = "🟣 Remaja";
                hiddenJenis.value = "Remaja";
            } else if (tahun < 60) {
                jenis = "👨 Usia Produktif";
                hiddenJenis.value = "Usia Produktif";
            } else {
                jenis = "👴 Lansia";
                hiddenJenis.value = "Lansia";
            }

            jenisPesertaInfo.classList.remove("hidden");
            jenisPesertaText.innerHTML = jenis;
            document.getElementById('jenis_peserta').value =
                jenis.replace(/[^\p{L}\p{N}\s]/gu, '').trim();
        }

        function updatePreviewKehamilan() {

            if (!usiaInput) return;

            if (!usiaInput.value) {

                preview.classList.add("hidden");
                return;

            }

            const minggu = parseInt(usiaInput.value);

            if (isNaN(minggu)) return;

            const today = new Date();

            // Perkiraan mulai kehamilan
            const mulaiKehamilan = new Date(today);
            mulaiKehamilan.setDate(today.getDate() - (minggu * 7));

            // HPL = 40 minggu dari awal kehamilan
            const hplDate = new Date(mulaiKehamilan);
            hplDate.setDate(mulaiKehamilan.getDate() + (40 * 7));

            const option = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };

            mulai.innerHTML =
                mulaiKehamilan.toLocaleDateString('id-ID', option);

            hpl.innerHTML =
                hplDate.toLocaleDateString('id-ID', option);

            preview.classList.remove("hidden");

            if (usiaInput) {

                usiaInput.addEventListener(
                    "input",
                    updatePreviewKehamilan
                );

                updatePreviewKehamilan();

            }

        }

        @if ($jenisData == 'hamil')

            document.getElementById('jenis_peserta').value = "Ibu Hamil";
        @endif



    });
</script>
