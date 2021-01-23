@extends('layouts.admin')
@section('content')

<button onclick="fetch();">click me</button>


<script>
    function fetch(){
        var signature = "";
        var clientApiKey = "globalgatewaytest";
        var secretKey = "Glo@61334398";
        var timestamp = Date.now();
        var toBeHashed = clientApiKey + secretKey + timestamp;
        var bytes = GetBytes(toBeHashed);

        console.log(typeof(bytes));


    }
</script>
    
@endsection