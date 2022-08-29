@extends('layouts.app')

@section('content')
    <b-container>
        <b-row class="mt-5">
            <b-col :md="4">
                <b-img-lazy class="image-responsive" src="{{$product->public_image}}" alt="" fluid></b-img-lazy>
            </b-col>
            <b-col :md="8">
                <h1>
                    {{$product->name}}
                </h1>
                <h4>
                   PHP {{number_format($product->price, 2)}}
                </h4>

                <p>Description: {{$product->description}}</p>
                <app-add-to-cart :user-id="{{auth()->id()}}"  :product-id="{{$product->id}}"></app-add-to-cart>
            </b-col>
        </b-row>
    </b-container>
@endsection
