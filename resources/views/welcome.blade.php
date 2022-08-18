@extends('layouts.app')
@section('content')
    <app-sec-navbar :categories="[{label: 'Computer', link: '/computer', icon:'cast'}, {label: 'Components', link: '/components', icon: 'box'}]"></app-sec-navbar>
    <app-carousel></app-carousel>
    <h1 class="text-center mt-4 text-success">HOT THIS WEEK</h1>
    <b-container>
        <app-products></app-products>
    </b-container>
@endsection
