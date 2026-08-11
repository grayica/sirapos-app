<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title>Laporan Reminder SIRAPOS</title>

<style>

@page{
    margin:25px;
}

body{
    font-family:DejaVu Sans,sans-serif;
    font-size:11px;
    color:#222;
    line-height:1.5;
}

*{
    box-sizing:border-box;
}

.header{
    width:100%;
    border-bottom:4px double #000;
    padding-bottom:12px;
    margin-bottom:20px;
}

.logo{
    width:70px;
    text-align:center;
}

.logo img{
    width:60px;
}

.title{
    text-align:center;
}

.title h1{
    margin:0;
    font-size:18px;
}

.title h2{
    margin:3px 0;
    font-size:15px;
}

.title h3{
    margin:3px 0;
    font-size:13px;
    font-weight:normal;
}

.title p{
    margin:2px 0;
    font-size:11px;
}

.document-title{

    margin-top:12px;

    padding:8px;

    background:#f1f1f1;

    border:1px solid #777;

    font-size:15px;

    font-weight:bold;

    letter-spacing:1px;

}

.info{

    width:100%;

    border-collapse:collapse;

    margin-bottom:18px;

}

.info td{

    padding:5px;

    vertical-align:top;

}

.summary{

    width:100%;

    border-collapse:collapse;

    margin-bottom:20px;

}

.summary th{

    background:#d9d9d9;

    border:1px solid #666;

    padding:8px;

    font-size:12px;

}

.summary td{

    border:1px solid #888;

    padding:7px;

}

.summary .number{

    text-align:center;

    font-weight:bold;

    font-size:13px;

}

.data{

    width:100%;

    border-collapse:collapse;

}

.data th{

    background:#e5e5e5;

    border:1px solid #555;

    padding:8px;

    text-align:center;

}

.data td{

    border:1px solid #888;

    padding:7px;

}

.center{

    text-align:center;

}

.right{

    text-align:right;

}

.success{

    background:#dcfce7;

    border:1px solid #22c55e;

    padding:3px 8px;

    font-weight:bold;

}

.failed{

    background:#fee2e2;

    border:1px solid #ef4444;

    padding:3px 8px;

    font-weight:bold;

}

.pending{

    background:#fef3c7;

    border:1px solid #f59e0b;

    padding:3px 8px;

    font-weight:bold;

}

.footer{

    margin-top:45px;

}

.signature{

    width:35%;

    float:right;

    text-align:center;

}

.note{

    margin-top:80px;

    border-top:1px solid #999;

    padding-top:8px;

    font-size:9px;

    color:#666;

}

</style>

</head>

<body>

<table class="header" width="100%">

<tr>

<td width="15%" class="logo">

{{-- Ganti sesuai logo kamu --}}
{{-- <img src="{{ public_path('images/logo.png') }}"> --}}

</td>

<td width="70%" class="title">

<h1>PEMERINTAH KABUPATEN BONDOWOSO</h1>

<h2>SISTEM INFORMASI REMINDER POSYANDU</h2>

<h3>(SIRAPOS)</h3>

<p>Desa Cermee • Kecamatan Cermee • Kabupaten Bondowoso</p>

<div class="document-title">

LAPORAN RIWAYAT PENGIRIMAN REMINDER WHATSAPP

</div>

</td>

<td width="15%"></td>

</tr>

</table>

<table class="info">

<tr>

<td width="22%"><b>Tanggal Cetak</b></td>

<td width="28%">: {{ now()->translatedFormat('d F Y H:i') }}</td>

<td width="20%"><b>Operator</b></td>

<td>: Administrator</td>

</tr>

<tr>

<td><b>Periode</b></td>

<td>: Seluruh Data</td>

<td><b>Total Data</b></td>

<td>: {{ $logs->count() }}</td>

</tr>

</table>
<table class="summary">

    <thead>

        <tr>

            <th colspan="5">
                RINGKASAN PENGIRIMAN REMINDER
            </th>

        </tr>

    </thead>

    <tbody>

        <tr>

            <td width="22%">
                Total Reminder
            </td>

            <td class="number" width="12%">
                {{ $logs->count() }}
            </td>

            <td width="22%">
                Reminder Berhasil
            </td>

            <td class="number" width="12%">
                {{ $logs->where('status','Sent')->count() }}
            </td>

            <td rowspan="4" width="32%" class="center">

                <div style="font-size:12px;font-weight:bold;margin-bottom:10px">
                    SUCCESS RATE
                </div>

                <div style="font-size:34px;font-weight:bold;color:#16a34a">

                    {{ $logs->count()
                        ? round(($logs->where('status','Sent')->count()/$logs->count())*100)
                        : 0 }}%

                </div>

                <div style="margin-top:10px;font-size:10px;color:#666">
                    Persentase reminder berhasil dikirim
                </div>

            </td>

        </tr>

        <tr>

            <td>
                Reminder Gagal
            </td>

            <td class="number">

                {{ $logs->where('status','Failed')->count() }}

            </td>

            <td>
                Reminder Pending
            </td>

            <td class="number">

                {{ $logs->where('status','Pending')->count() }}

            </td>

        </tr>

        <tr>

            <td>
                Pengiriman Pertama
            </td>

            <td colspan="3">

                {{ optional($logs->last())->created_at?->translatedFormat('d F Y H:i') ?? '-' }}

            </td>

        </tr>

        <tr>

            <td>
                Pengiriman Terakhir
            </td>

            <td colspan="3">

                {{ optional($logs->first())->created_at?->translatedFormat('d F Y H:i') ?? '-' }}

            </td>

        </tr>

    </tbody>

</table>

<div style="margin-bottom:18px">

    <b>Keterangan</b>

    <div style="margin-top:8px">

        Laporan ini merupakan rekapitulasi aktivitas pengiriman reminder
        Posyandu melalui WhatsApp yang dihasilkan secara otomatis oleh
        Sistem Informasi Reminder Posyandu (SIRAPOS). Data yang ditampilkan
        mencakup seluruh riwayat pengiriman yang tersimpan di dalam sistem.

    </div>

</div>
<table class="data">

    <thead>

        <tr>

            <th width="5%">No</th>

            <th width="22%">Nama Peserta</th>

            <th width="16%">No. WhatsApp</th>

            <th width="20%">Posyandu</th>

            <th width="10%">Reminder</th>

            <th width="10%">Status</th>

            <th width="17%">Waktu Pengiriman</th>

        </tr>

    </thead>

    <tbody>

        @forelse($logs as $log)

        <tr>

            <td class="center">

                {{ $loop->iteration }}

            </td>

            <td>

                <b>{{ $log->peserta->nama_penerima }}</b>

            </td>

            <td class="center">

                {{ $log->peserta->nomor_whatsapp }}

            </td>

            <td>

                {{ $log->jadwal->posyandu->nama_posyandu }}

            </td>

            <td class="center">

                {{ strtoupper($log->reminder_type) }}

            </td>

            <td class="center">

                @if($log->status=='Sent')

                    <span class="success">
                        BERHASIL
                    </span>

                @elseif($log->status=='Failed')

                    <span class="failed">
                        GAGAL
                    </span>

                @else

                    <span class="pending">
                        PENDING
                    </span>

                @endif

            </td>

            <td class="center">

                {{ $log->created_at->translatedFormat('d M Y') }}

                <br>

                {{ $log->created_at->format('H:i') }} WIB

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="7" class="center" style="padding:25px">

                <b>Tidak ada data reminder yang tersedia.</b>

            </td>

        </tr>

        @endforelse

    </tbody>

</table>
<div class="footer">

    <table width="100%" style="margin-top:45px;">

        <tr>

            <td width="55%">

                <div style="font-size:10px;color:#555;line-height:1.7">

                    <b>Keterangan :</b>

                    <br>

                    • Laporan ini dihasilkan secara otomatis oleh
                    <b>SIRAPOS (Sistem Informasi Reminder Posyandu Berbasis WhatsApp)</b>.

                    <br>

                    • Data yang ditampilkan merupakan data yang tersimpan
                    pada database sistem saat laporan dibuat.

                    <br>

                    • Dokumen ini digunakan sebagai bahan monitoring dan
                    evaluasi pelaksanaan reminder Posyandu.

                </div>

            </td>

            <td width="45%" align="center">

                Bondowoso,

                {{ now()->translatedFormat('d F Y') }}

                <br><br>

                Administrator

                <br><br><br><br><br>

                <b>

                    {{ Auth::user()->name ?? 'Administrator' }}

                </b>

            </td>

        </tr>

    </table>

</div>
