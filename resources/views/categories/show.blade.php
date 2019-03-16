@extends('layouts.app')
@section('body-class', 'profile-page')
@section('page-title', $category->name)

@section('styles')
   <style>
        .team .row .col-md-4 {
            margin-bottom: 3em;
        }   
        .team .row .col-md-4 .card {
            padding: 10px;
        }
    </style> 
@endsection

@section('content')
<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="profile">
                    <div class="avatar">
                        <img src="{{$category->featured_image_url}}" alt="{{$category->name}}" class="img-circle img-responsive img-raised">
                    </div>
                    <div class="name">
                        <h3 class="title">{{$category->name}}</h3>
                    </div>
                    @if (session('notification'))
                        <div class="alert alert-success">
                            {{ session('notification') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="description text-center">
                <p>{{$category->description}}</p>
            </div>

            <div class="team text-center">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="team-player card">
                            <img src="{{ $product->featured_image_url }}" alt="{{ $product->name }}" class="img-raised img-circle">
                            <h4 class="title">
                                <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}</a>
                            </h4>
                            <p class="description">{{$product->description}}</p>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="row">
                    {{ $products->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

@include('includes.footer');
@endsection