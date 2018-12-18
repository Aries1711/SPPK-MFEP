@extends('layouts.app')

@section('content')
<head>
    <title>Contoh Program SPPK Menggunakan Metode SAW</title>

    <style>
    .container {
        padding: 50px;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="ui grid">
            <div class="five wide column" style="margin-right: 100px;">
                Penentuan bobot kriteria :
                <table class="ui celled table">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Penilaian</th>
                            <th>Bobot</th>
                            <th colspan="2">Aksi</th>
                        </tr>
                    </thead>
                    @foreach($value as $data)
                    <tbody>
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>@if($data->persen == 5)
                                Sangat Penting @elseif($data->persen == 4)
                                Penting @elseif($data->persen == 3)
                                Cukup @elseif($data->persen == 2)
                                Tidak Penting @else
                                Sangat Tidak Penting
                                @endif
                            </td>
                            <td> {{$data->persen/$total1*100}}%</td>
                            <td><a href="/editview/{{$data->idvalue}}">Edit</a></td>
                            <td><form action="/hapus/{{$data->idvalue}}" method="delete">
                                <button type="submit" name="submit">Hapus</button>
                                <input type="hidden" name="_method" value="delete">
                                {{csrf_field () }}
                            </form></td>
                        </tr>
                    </tbody>

                    @endforeach
                </table>
                <button class="ui red button"><a href="#tambah" style="color: white;" data-toggle="modal">Tambah Kriteria</a></button>
                {{-- <hr>
                <h2>Hasil Panen</h2>
                <input type="num" name="">
                <hr> --}}
            </div>
            <div class="five wide column" >
                <div class="field">    
                    <h2>Hasil Panen</h2>
                    <input type="num" name="" id="panen">
                    <hr>
                </div>
            </div>
        </div>
        <!-- Modal content-->
        <form method="post" action="/tambah">
            <div id="tambah" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Kriteria</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="idvalue" value="">
                                <label for="pwd">Nama Kriteria:</label>
                                <input type="text" class="form-control" id="pwd" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Nilai bobot:</label>
                                <select name="persentase">
                                    <option disabled selected>Penilaian Bobot</option>
                                    <option value="5">Sangat Penting</option>
                                    <option value="4">Penting</option>
                                    <option value="3">Cukup</option>
                                    <option value="2">Tidak Penting</option>
                                    <option value="1">Sangat Tidak Penting</option>
                                </select>
                            </div>
                            {{ csrf_field() }}
                            <input class="btn btn-default submit-button" type="submit" name="submit" value="Tambah">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="ui grid">
            <div class="four wide column">
                <form class="ui form">
                    <div class="field">
                        <label>Nama Pasar</label>
                        <input type="text" name="first-name" placeholder="Nama Pasar" class="nama_pegawai">
                    </div>
                    @foreach($value as $v)
                    <div class="field">
                        <strong>{{$v->name}} : </strong>
                        <select class="{{str_replace(' ', '', $v->name)}}">
                            <option disabled selected>{{$v->name}}</option>
                            <option value="5">Sangat Tinggi</option>
                            <option value="4">Tinggi</option>
                            <option value="3">Sedang</option>
                            <option value="2">Rendah</option>
                            <option value="1">Sangat Rendah</option>
                        </select>
                    </div>
                    @endforeach
                    <button onclick="tambahPegawai(event)" class="ui red button">Tambah Pasar</button>
                </form>
            </div>
        </div>
        <br>
        <br>
        <center>
            <button onclick="random(event)" class="ui green button">Random</button>
            <button onclick="lihatHasil(event)" class="ui blue button">Lihat Hasil</button>
        </center>
        <br>
        <br>
        <div id="tabel-alternative"></div>
    </div>

    <script>




        $(function(){

        });

        function tambahPegawai(e){
            e.preventDefault();
            var template = '<div class="four wide column">'+$('.four:first').html()+'</div>';
            $('.four:last').after(template);
            $('.four:last').find('button').after('<button onclick="hapusPegawai(event,this)" class="ui orange button">Hapus</button>');
            random(event);
        }

        function hapusPegawai(e, el){
            e.preventDefault();
            $(el).parents('.four').remove();
        }

// var max_pencapaian = 0;
// var max_kedisiplinan = 0;
// var max_sikap = 0;
// var max_lama_bekerja = 0;
// var max_kesegaran_ikan = 0;
var max_total = 0;

function lihatHasil(e){
    e.preventDefault();
    var alternatives = [];
    var alternative = {};
    @foreach($value as $v)
    var {{str_replace(' ', '', $v->name)}} = []
    @endforeach
    var nama_pegawais = []
    var panen=document.getElementById("panen").value;
    var totals = []
    var stock=[]
    
    @foreach($value as $v)
    $('.{{str_replace(' ', '', $v->name)}}').each(function(){
        {{str_replace(' ', '', $v->name)}}.push(Number($(this).val()));
    });
    @endforeach
    $('.nama_pegawai').each(function(){
        nama_pegawais.push($(this).val());
    });
    @foreach($value as $v)
    {{'max'.str_replace(' ', '', $v->name)}} = getMaxOfArray({{str_replace(' ', '', $v->name)}});
    @endforeach
    for(var i = 0; i < {{str_replace(' ', '', $value->first()->name)}}.length; i++){
        alternative = {};
        @foreach($value as $v)
        alternative.{{str_replace(' ', '', $v->name)}} = {{str_replace(' ', '', $v->name)}}[i];
        @endforeach
        alternative.nama_pegawai = nama_pegawais[i];
        @foreach($value as $v)
        alternative.{{'normalisasi_'.str_replace(' ', '', $v->name)}} = bulatkan(alternative.{{str_replace(' ', '', $v->name)}}*0.2);
        @endforeach

// TP - 4 = 0,2
// HP - 4 = 0,2
// JP - 3 = 0,15
// J - 5 = 0,25
// KR - 4 = 0,2

//WE = FW x E
@foreach($value as $v)
alternative.{{'hasil_'.str_replace(' ', '', $v->name)}} = bulatkan(alternative.{{'normalisasi_'.str_replace(' ', '', $v->name)}} * {{$v->persen/$total1}});
@endforeach
// ∑WE
alternative.total = bulatkan(
    @foreach($value as $v)
    alternative.{{'hasil_'.str_replace(' ', '', $v->name)}}
    @if (!$loop->last)
    +
    @endif
    @endforeach
    );


totals.push(alternative.total);
alternatives.push(alternative);


}

var sumtotal = _.sum(totals);
for(var i of alternatives){
    i.total2 = bulatkan(i.total / sumtotal * panen);   
}


// Max ∑WE

generate_tabel(alternatives);
generate_tabel2(alternatives);
generate_tabel3(alternatives);
var sorted = _.sortBy(alternatives, ['total']).reverse();
generate_tabel4(sorted);
generate_tabel5(alternatives);
}

function generate_tabel(data){
    var tabel = '<h3>Tabel Alternative</h3>'
    +'<table class="ui celled table"><thead>'
    +'<tr>'
    +'<th>Alternative</th>'
    @foreach($value as $v)
    +'<th>{{$v->name}}</th>'
    @endforeach
    +'</tr></thead><tbody>';
    for(var d of data){
        tabel += '<tr>'
        +'<td>'+d.nama_pegawai+'</td>'
        @foreach($value as $v)
        +'<td>'+{{'d.'.str_replace(' ', '', $v->name)}}+'</td>'
        @endforeach
        +'</tr>';
    }
    tabel += '<tr>'
    +'<td><strong>Max</strong></td>'
    @foreach($value as $v)
    +'<td>'+ {{'max'.str_replace(' ', '', $v->name)}}+'</td>'
    @endforeach
    +'</tr>'
    tabel += '</tbody></table>';
    $('#tabel-alternative').html(tabel);
}

function generate_tabel2(data){
    var tabel = '<h3>Tabel Normalisasi</h3>'
    +'<table class="ui celled table"><thead>'
    +'<tr>'
    +'<th>Alternative</th>'
    @foreach($value as $v)
    +'<th>{{$v->name}}</th>'
    @endforeach
    +'</tr></thead><tbody>';
    for(var d of data){
        tabel += '<tr>'
        +'<td>'+d.nama_pegawai+'</td>'
        @foreach($value as $v)
        +'<td>'+{{'d.normalisasi_'.str_replace(' ', '', $v->name)}}+'</td>'
        @endforeach
        +'</tr>';
    }
    tabel += '</tbody></table>';
    $('#tabel-alternative').append(tabel);
}

function generate_tabel3(data){
    var tabel = '<h3>Tabel Hasil Perkalian Dengan Nilai Bobot Kriteria</h3>'
    +'<table class="ui celled table"><thead>'
    +'<tr>'
    +'<th>Alternative</th>'
    @foreach($value as $v)
    +'<th>{{$v->name}}</th>'
    @endforeach
    +'<th>Total</td>'
    +'</tr></thead><tbody>';
    for(var d of data){
        tabel += '<tr>'
        +'<td>'+d.nama_pegawai+'</td>'
        @foreach($value as $v)
        +'<td>'+{{'d.hasil_'.str_replace(' ', '', $v->name)}}+'</td>'
        @endforeach
        +'<td>'+d.total+'</td>'
        +'</tr>';
    }
    tabel += '</tbody></table>';
    $('#tabel-alternative').append(tabel);
}

function generate_tabel4(data){
    var tabel = '<h3>Tabel Hasil Setelah Diurutkan</h3>'
    +'<table class="ui celled table"><thead>'
    +'<tr>'
    +'<th>Alternative</th>'
    @foreach($value as $v)
    +'<th>{{$v->name}}</th>'
    @endforeach
    +'<th>Total</th>'
    +'</tr></thead><tbody>';
    var a = 0;
    for(var d of data){
        if(a == 0){
            tabel += '<tr style="color: white; background-color: green;">'
            +'<td><strong>'+d.nama_pegawai+'</strong></td>'
            @foreach($value as $v)
            +'<td>'+{{'d.hasil_'.str_replace(' ', '', $v->name)}}+'</td>'
            @endforeach
            +'<td><strong>'+d.total+'</strong></td>'
            +'</tr>';
        }else{
            tabel += '<tr>'
            +'<td>'+d.nama_pegawai+'</td>'
            @foreach($value as $v)
            +'<td>'+{{'d.hasil_'.str_replace(' ', '', $v->name)}}+'</td>'
            @endforeach
            +'<td>'+d.total+'</td>'
            +'</tr>';
        }
        a++;
    }
    tabel += '</tbody></table>';
    $('#tabel-alternative').append(tabel);
}

function generate_tabel5(data){
    var tabel = '<h3>Rekomendasi Jumlah Distribusi</h3>'
    +'<table class="ui celled table"><thead>'
    +'<tr>'
    +'<th>Alternative</th>'
    +'<th>Rekomendasi Jumlah Distribusi</th>'
    +'</tr></thead><tbody>';
    var a = 0;
    for(var d of data){
        if(a == 0){
            tabel += '<tr style="color: white; background-color: green;">'
            +'<td>'+d.nama_pegawai+'</td>'
            +'<td>'+d.total2+'</td>'
            +'</tr>';
        }else{
            tabel += '<tr>'
            +'<td>'+d.nama_pegawai+'</td>'
            +'<td>'+d.total2+'</td>'
            +'</tr>';
        }
        a++;
    }
    tabel += '</tbody></table>';
    $('#tabel-alternative').append(tabel);
}

function random(e){
    e.preventDefault();
    var nilai = [5,4,3,2,1];

    @foreach($value as $v)
    $('.{{str_replace(' ', '', $v->name)}}').each(function(){
        $(this).val(array_random(nilai));
    });
    @endforeach
    $('.nama_pegawai').each(function(){
        $(this).val(random_string());
    });
}

function array_random(arrays){
    return arrays[Math.floor(Math.random()*arrays.length)];
}

function random_string() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function getMaxOfArray(numArray) {
    return Math.max.apply(null, numArray);
}

function bulatkan(num){
    return Math.round(num * 100) / 100;
}

</script>
</body>
@endsection
