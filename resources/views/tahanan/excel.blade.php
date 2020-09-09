<?php
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=tahanan.xls');
?>

<head>
    <style>
        td.border {
            border-top: solid 1px black;
            border-bottom: solid 1px black;
        }
        td.border-top {
            border-top: solid 1px black;
        }
    </style>
</head>
<body>
<table style="font-size: 11px">
    <tr>
        <td class="border">No</td>
        <td class="border">Nama Petugas</td>
        <td class="border">Nama WBP</td>
        <td class="border">Tempat / Tgl Lahir</td>
        <td class="border">Jenis Kelamin</td>
        <td class="border">Agama</td>
        <td class="border">Kewarganegaraan</td>
        <td class="border">Tindak Pidana</td>
        <td class="border">Hukuman</td>
        <td class="border">Residivis</td>
        <td class="border">Kelas</td>
        <td class="border">Dibuat</td>
        <td class="border">Diupdate</td>
    </tr>
@foreach($data as $i)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $i->petugas->name }}</td>
            <td>{{ $i->nama_lengkap }}</td>
            <td>{{ $i->ttl }}</td>
            <td>{{ $i->jenis_kelamin }}</td>
            <td>{{ $i->agama }}</td>
            <td>{{ $i->kewarganegaraan }}</td>
            <td>{{ $i->tindak_pidana }}</td>
            <td>{{ $i->hukuman }}</td>
            <td>
                @if($i->residivis != "tidak")
                    {{ $i->residivis }} - sebanyak {{ $i->berapa_residivis }}
                @else
                    {{ $i->residivis }}
                @endif
            </td>
            <td>{{ $i->score }}</td>
            <td>{{ $i->created_at }}</td>
            <td>{{ $i->updated_at }}</td>
        </tr>
@endforeach
</table>
</body>
