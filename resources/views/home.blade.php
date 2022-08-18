@extends('layouts.app')

@section('content')
    <b-container :fluid="true" class="mt-4">
        <b-row>
            <b-col >
                <h3>
                    <b-icon icon="pie-chart-fill"></b-icon>
                    Dashboard</h3>
            </b-col>
            <b-col :md="3">
                <b-calendar :block="true" :hide-header="true"></b-calendar>
            </b-col>
        </b-row>
    </b-container>
@endsection
