@extends('layouts.index')

@section('title')
Review Barang
@endsection

@section('content')
    <div class="col-sm-12">
        <form method="post" action="{{ url('barang/'.$model->id.'/store_review') }}" enctype="multipart/form-data">
        @csrf
        <div class="row clearfix">
            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ $model->attributes()['kode_barang'] }}:</label> {{ $model->kode_barang }}
                </div>
                
                <div class="form-group">
                    <label>{{ $model->attributes()['nama'] }}:</label> {{ $model->nama }}
                </div>

            </div>
            
            <div class="col-md-4">

                <div class="form-group">
                    <label>{{ $model->attributes()['deskripsi'] }}:</label>  {{ $model->deskripsi }}
                </div>
                
                <div class="form-group">
                    <label>{{ $model->attributes()['jumlah'] }}:</label>  {{ $model->jumlah }}
                </div> 
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label>{{ $model->attributes()['harga'] }}:  {{ $model->harga }}
                </div>
            </div>
        </div>

        <hr/>
        <p>Berikan Review Anda</p>
        <div class="row clearfix">
            <div class="col-md-6">
                
                <div class="form-group">
                    <label>Ulasan:</label> 
                    <input type="text" class="form-control {{($errors->first('ulasan') ? ' parsley-error' : '')}}" name="ulasan" value="{{ old('ulasan') }}">
                    @foreach ($errors->get('ulasan') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach
                </div>  
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Rating:</label> 
                    <select class="form-control {{($errors->first('rating') ? ' parsley-error' : '')}}" name="rating">
                        @for($i=1;$i<=5;$i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor 
                    </select>
                    @foreach ($errors->get('rating') as $msg)
                        <p class="text-danger">{{ $msg }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table table-bordered">
                    @foreach($list_review as $value)
                        <tr>
                            <td>Rating: {{ $value->rating }}</td>
                            <td>
                                {{ $value->ulasan }}
                                <p class="text-muted">{{ $value->customer->name }}</p>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>


        </form>
    </div>
@endsection
