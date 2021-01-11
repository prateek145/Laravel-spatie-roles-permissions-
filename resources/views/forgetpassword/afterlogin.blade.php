@extends('layouts.admin')
@section('content')
<form action="changepassword" method="POST" >
@csrf
<input type="email" placeholder="Enter Email" name= "email" class="col-md-4 form-control" ><br><br>

<input type="submit" class="btn btn-success" style="margin-left: 3%;">
</form>
@endsection