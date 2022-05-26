@extends('layouts.app')

@section('title','Show Product')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12  w-75">

            <div class="row justify-content-center g-0">
                <div class="col-12 text-end">
                    <a href="{{ route('welcome') }}" class="btn btn-primary">Back</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Show Product Details</h3></div>

                <div class="card-body">
                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Name :</strong>
                        </div>
                        <div class="col-10">
                            {{ $product['name'] }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Category Name :</strong>
                        </div>
                        <div class="col-10">
                            {{ $product['category']['name'] }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Prices :</strong>
                        </div>
                        <div class="col-10">
                            @foreach ($product['prices'] as $price)
                            <div>{{ $price['price_types']['name'] }} : <strong>৳ {{ $price['amount'] }}</strong></div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-2">
                            <strong>Description :</strong>
                        </div>
                        <div class="col-10">
                            {{ $product['description'] }}
                        </div>
                    </div>

                    <div class="row p-1">
                        <div class="col-3">
                            <strong>Image :</strong>
                        </div>
                        <div class="col-9">                            
                            @if ($product['image'])
                                <img src="{{ config('app.backend_url') }}/product-images/{{ $product['image'] }}"
                                height="300" width="500">                                                
                            @else
                                <small>No Image</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>  <!-- /.card -->
        </div>
    </div>
@endsection
