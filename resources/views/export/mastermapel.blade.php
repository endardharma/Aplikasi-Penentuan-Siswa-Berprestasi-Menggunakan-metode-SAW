<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="5" style="background-color: yellow; text-align:center; font-size: 30px; height: 50px; font-weight:50;"><b>Data Master Mata Pelajaran</b></th>
        </tr>
        <tr>
            <th style="width: 200px; text-align:center; height: 40px;"><b>ID</b></th>
            <th style="width: 200px; text-align:center"><b>Jurusan</b></th>
            <th style="width: 200px; text-align:center"><b>Nama</b></th>
            <th style="width: 200px; text-align:center"><b>Kelompok</b></th>
            <th style="width: 200px; text-align:center"><b>Tipe Nilai</b></th>
        </tr>
        <tr>
            <th style="text-align: center; background-color:#3c8dbc; color:white">1</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">2</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">3</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">4</th>
            <th style="text-align: center; background-color:#3c8dbc; color:white">5</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td style="text-align:left;"> {{ $d['id'] }} </td>
            <td style="text-align:left;"> {{ $d['jurusan'] }} </td>
            <td style="text-align:left;"> {{ $d['name'] }} </td>
            <td style="text-align:left;">{{ $d['kelompok'] }} </td>
            <td style="text-align:left;">{{ $d['type'] }} </td>
        </tr>
        @endforeach
    </tbody>
</table>