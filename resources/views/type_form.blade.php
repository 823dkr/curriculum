   @extends('layout')
   @section('content')
   <main>
       <form action="{{ route('create.type')}}" method="post">
           @csrf
           <label for='name'>カテゴリ名</label>
           <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example">
           <div class='row justify-content-center'>
               <button type='submit' class='btn btn-primary'>登録</button>
           </div>
       </form>
   </main>
   @endsection