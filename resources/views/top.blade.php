@extends('layout')
@section('content')
<main>
    <a class="btn btn-primary" href="{{route('create.creature')}}" role="button">生体新規登録</a>
    <button type="button" class="btn btn-success">Success</button>

    <div class="container">
        @foreach($types as $type)
        <div class="container-lg">
            {{$type['name']}}
        </div>
        @foreach($creatures as $creature)
        <div class="d-flex">

            <img src='storage/images.png' class="img-fluid" width="max20%">


            <div class=" container-md"> {{$creature['name']}}
            </div>
            <div class="container-md"> {{$creature['sex_id']}}</div>

            <a href="{{ route ('delete.creature',['creature' => $creature['id'] ]) }}">
                <button class='btn btn-danger'>削除</button>
            </a>

            <a href="{{ route ('edit.creature',['creature' => $creature['id'] ]) }}">
                <button class='btn btn-secondary'>編集</button>
            </a>
        </div>
        @endforeach
        @endforeach
    </div>




    <ul class="list-group list-group-flush">
        <img src=' storage/images.png' class="img-fluid" max-width>

    </ul>
    <ul class="list-group list-group-flush">
        @foreach($creatures as $creature)
        <li class="list-group-item"> {{$creature['name']}}</li>
        <li class=" list-group-item"> {{$creature['sex_id']}}</li>
        <div class='d-flex justify-content-around mt-3'>

            <a href="{{ route ('delete.creature',['creature' => $creature['id'] ]) }}">
                <button class='btn btn-danger'>削除</button>
            </a>

            <a href="{{ route ('edit.creature',['creature' => $creature['id'] ]) }}">
                <button class='btn btn-secondary'>編集</button>
            </a>
        </div>
        @endforeach
    </ul>



</main>
@endsection