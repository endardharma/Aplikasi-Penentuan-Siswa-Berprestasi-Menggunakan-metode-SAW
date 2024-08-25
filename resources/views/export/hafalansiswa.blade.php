<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="9" style="background-color: yellow; text-align:center; font-size: 30px; height: 50px; font-weight:50;"><b>Data Hafalan Siswa</b></th>
        </tr>
        <tr>
            <th style="width: 200px; text-align:center; height: 40px;"><b>ID</b></th>
            <th style="width: 200px; text-align:center"><b>Nama Siswa</b></th>
            <th style="width: 200px; text-align:center"><b>Keterangan Hafalan</b></th>
            <th style="width: 200px; text-align:center"><b>Nilai</b></th>
            <th style="width: 200px; text-align:center"><b>Jurusan</b></th>
            <th style="width: 200px; text-align:center"><b>Tahun Ajar</b></th>
        </tr>
        <tr>
            <th style="text-align: center; background-color:#3c8dbc; color:white">1</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">2</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">3</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">4</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">5</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">6</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">7</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td style="text-align:left;"> {{ $d['id'] }} </td>
            <td style="text-align:left;"> {{ $d['nama_siswa'] }} </td>
            <td style="text-align:left;">{{ $d['ket_hafalan'] }} </td>
            <td style="text-align:left;">{{ $d['nilai'] }} </td>
            <td style="text-align:left;">{{ $d['jurusan'] }} </td>
            <td style="text-align:left;"> {{ $d['tahun_ajar'] }} </td>
        </tr>
        @endforeach
    </tbody>
</table>