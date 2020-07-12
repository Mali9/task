@if (Session::has('success'))

<div class="alert alert-success" role="alert" style="text-align: center">
  <h4 style="justify-content: center"> success </h4>
</div>

@endif
@if (Session::has('error'))
<div class="alert alert-danger" role="alert" style="text-align: center">
  <h4 style="justify-content: center">Failed</h4>
</div>

@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif