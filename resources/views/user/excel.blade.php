<?php
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=user.xls');
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
        <td class="border">Nama</td>
        <td class="border">Username</td>
        <td class="border">Email</td>
        <td class="border">Status</td>
        <td class="border">Konfirmasi</td>
        <td class="border">NIP</td>
        <td class="border">Jabatan</td>
        <td class="border">UPT</td>
        <td class="border">No Telp</td>
        <td class="border" align="center">Skor</td>
    </tr>
    @foreach($data as $i)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $i->name }}</td>
            <td>{{ $i->username }}</td>
            <td>{{ $i->email }}</td>
            <td>
                @if($i->is_admin)
                    Admin
                @else
                    Sipir
                @endif
            </td>
            <td>
                @if(!$i->is_admin)
                    @if($i->is_confirm)
                        Telah dikonfirmasi
                    @else
                        Belum dikonfirmasi
                    @endif
                @endif
            </td>
            <td>{{ $i->username }}</td>
            <td>
                @if(!$i->is_admin)
                    {{ $i->warden['jabatan'] }}
                @endif
            </td>
            <td>
                @if(!$i->is_admin)
                    {{ $i->warden['upt'] }}
                @endif
            </td>
            <td>
                @if(!$i->is_admin)
                    {{ $i->warden['phone'] }}
                @endif
            </td>
            <td>
                @if(!$i->is_admin)
                    {{ $i->warden['score'] }}
                    @if($i->warden['score'] != "")
                        @if($i->warden['score'] < 45 )
                            Rendah
                        @elseif($i->warden['score'] <= 135 )
                            Sedang
                        @else
                            Tinggi
                        @endif
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
</table>
</body>
