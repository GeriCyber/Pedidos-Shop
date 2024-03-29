@extends('layouts.app')
@section('body-class', 'product-page')
@section('page-title', 'Agregar Categoria')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Agregar Categoria</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="{{ url('/admin/categories') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {{-- <div class="form-group label-floating"> --}}
                            <label class="control-label">Imagen</label>
                            <input type="file" name="image">
                        {{-- </div> --}}
                    </div>
                </div>

                <textarea class="form-control" name="description" placeholder="Descripcion..." rows="5">
                    {{old('description') }}
                </textarea>

                <button type="submit" class="btn btn-primary">Agregar Categoria</button>
                <a href="{{ url('/admin/categories') }}" class="btn btn-danger">Cancelar</a>
            </form>    

        </div>
    </div>
</div>

@include('includes.footer');
@endsection
