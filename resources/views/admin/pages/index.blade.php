@extends('admin.layouts.base')

@section('title', 'Title Page')

@section('sidebar')
    @include('admin.layouts.slidebar')
@endsection

@section('content')
<div id="chart">
  <div class="card">
    <div class="card-body">

      <canvas id="myChart"></canvas>
    </div>
  </div>
</div>
@endsection