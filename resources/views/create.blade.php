@section('title','Create')
@extends('layout.master')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success">
        <li><strong>{{session('success')}}</strong></li>
    </div>
@endif
<form method="POST" action="{{route('verification')}}" class="container border p-5 my-5">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <h5>Error :</h5>
            <ul>
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>   
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="abc@mail.com">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password">
    </div>
    <div class="mb-3">
      <label for="C_password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="password_confirmation" id="C_password">
    </div>
    <button type="submit" class="btn btn-warning">Create</button>
    <a class="text-success bg-light" href="/login">j'ai deja un compte</a>    
</form>
@endsection