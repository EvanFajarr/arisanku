@if (Session::has('success'))
<div class="pt-3">
  <div class="alert alert-primary" role="alert">
    {{Session::get('success')}}
</div>
@endif

@if ($errors->any())
<div  class="alert alert-danger" role="alert">
    <ul>
        @foreach ($errors->all() as $item)
            <li>{{$item}}</li>
        @endforeach
    </ul>
  </div>
@endif

{{-- evan --}}

