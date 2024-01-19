@extends('layout')
@section('content')
<main>
    <a class="btn btn-primary" href="{{route('create.creature')}}" role="button">生体新規登録</a>
    <button type="button" class="btn btn-success">Success</button>

    <div class="card" style="width: 18rem;">
        @foreach($types as $type)
        <div class="card-header">

            {{$type['name']}}
        </div>
        <ul class="list-group list-group-flush">

            <img src="storage/images/images.png">

        </ul>
        <ul class="list-group list-group-flush">
            @foreach($creatures as $creature)
            <li class="list-group-item"> {{$creature['name']}}</li>
            <li class=" list-group-item"> {{$creature['sex']}}</li>
            @endforeach
        </ul>
        @endforeach
    </div>
</main>
@endsection