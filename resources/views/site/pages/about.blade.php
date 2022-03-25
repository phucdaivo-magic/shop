@extends('layouts.site')

@section('content')
<div class="pane-header">
  <h1>{{ $about->name }}</h1>
</div>
<div class="container mt-4">

  <div>
    {!! $about->content !!}
  </div>
</div>
@endsection