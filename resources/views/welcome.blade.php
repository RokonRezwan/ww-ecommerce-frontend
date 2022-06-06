@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center row">
        <div class="col-md-8">

            @if ($success = session('orderSuccess'))
                <div class="alert alert-success">
                    <strong>{{ $success['status'] }}</strong>
                </div>
            @endif

            @foreach ($products as $product)
                <div class="row p-2 bg-white border rounded py-2">
                 <div class="col-md-3 mt-1">
                     @if ($product['image'])
                        <img class="img-fluid img-responsive rounded product-image" src="{{ config('app.backend_url') }}/product-images/{{ $product['image'] }}" style="height: 100px; width: 200px;" >                                                
                    @else
                        <small>No Image</small>
                    @endif
                 </div>
                
                 <div class="col-md-6 mt-1">
                     <h5>{{ $product['name'] }}</h5>
                     <div class="d-flex flex-row">
                         <div class="ratings mr-2">
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                         </div>
                     </div>
                     <div class="mt-1 mb-1 spec-1">
                         <span class="dot"></span>
                         <span>{{ $product['category']['name'] }}</span>
                     </div>
                     <p class="text-justify text-truncate para mb-0">{{ $product['description'] }}<br><br></p>
                 </div>
                
                 <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                     <div style="font-size: 15px">
                        @foreach ($product['prices'] as $price)
                            @if ($price['start_date'] <= \Carbon\Carbon::now() && $price['end_date'] >= \Carbon\Carbon::now())
                                <div class="mr-1">{{ $price['price_types']['name'] }} : ৳ {{ $price['amount'] }}</div>
                                @break
                            @elseif ($price['price_type_id'] == 1)
                                <div class="mr-1">{{ $price['price_types']['name'] }} : ৳{{ $price['amount'] }}</div>
                            @endif
                        @endforeach
                     </div>
                     <div class="d-flex flex-column mt-4">
                         <a href="{{ route('details', $product['id']) }}" class="btn btn-primary btn-sm" style="color: white" >Details</a>
                         <a href="{{ route('add.to.cart', $product['id']) }}" class="btn btn-outline-primary btn-sm mt-2" type="button">Add to Cart</a>
                     </div>
                 </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
