@extends('layouts.app')
@section('content')

<div class="card-body"> 
	<div class="container">
		<div class="row">
			<div class="col-6">
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
			</div>
			<div class="col-6 "> 
				<form action="/edit/{{$data1->idvalue}}" method="post">
					<div class="form-group">
						<label for="pwd">Nama:</label>
						<input type="text" class="form-control" id="pwd" name="name" value="{{$data1->name}}">
					</div>
					<div class="form-group">
						<label for="pwd">Nilai bobot Kriteria:</label>
						<select name="persentase">
							<option disabled selected>Penilaian Bobot</option>
							<option value="5" @if($data1->persen == 5) selected="selected" @endif>Sangat Penting</option>
							<option value="4" @if($data1->persen == 4) selected="selected" @endif>Penting</option>
							<option value="3" @if($data1->persen == 3) selected="selected" @endif>Cukup</option>
							<option value="2" @if($data1->persen == 2) selected="selected" @endif>Tidak Penting</option>
							<option value="1" @if($data1->persen == 1) selected="selected" @endif>Sangat Tidak Penting</option>
						</select>
					</div>
					<button type="submit" class="btn btn-default submit-button" value="edit">Edit Data</button>
					<input type="hidden" name="_method" value="put">
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection