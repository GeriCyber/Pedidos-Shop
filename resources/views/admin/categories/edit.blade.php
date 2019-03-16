@extends('layouts.app')
@section('body-class', 'product-page')
@section('page-title', 'Editar Categoria')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
    
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Editar Categoria</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" enctype="multipart/form-data" action="{{ url('/admin/categories/'.$category->id.'/edit') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {{-- <div class="form-group label-floating"> --}}
                            <label class="control-label">Imagen</label>
                            <input type="file" name="image">
                            @if($category->image)
                                <p class="help-block">
                                Subir solo si desea reemplazar <a target="_blank" href="{{ asset('/images/categories/'.$category->image) }}">la imagen actual</a>.
                            </p>
                            @endif
                        {{-- </div> --}}
                    </div>
                </div>

                <textarea class="form-control" name="description" placeholder="Descripcion..." rows="5">{{ old('description', $category->description) }}</textarea>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ url('/admin/categories') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>    

    </div>

</div>

@include('includes.footer');
@endsection
