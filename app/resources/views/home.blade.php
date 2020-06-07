@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>Dashboard.</b> You are logged in!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>Testing</h5>
                    <form id="send-email" action="{{ route('create-mail-queue') }}" method="POST">
                        @csrf
                        <p>
                            <input type="submit" value="Run command: php artisan create:mail-queue">
                        </p>
                    </form><br>

                    <h5>Beanstalkd statistic<br></h5>
                    <table border="2" cellpadding="4">
                        <tr>
                            <th>Job</th>
                            <th>Count</th>
                        </tr>
                        <tr>
                            <td>Current jobs urgent</td>
                            <td>{{ $pheanstalkStatus['current-jobs-urgent'] }}</td>
                        </tr>
                        <tr>
                            <td>current-jobs-ready</td>
                            <td>{{ $pheanstalkStatus['current-jobs-ready'] }}</td>
                        </tr>
                        <tr>
                            <td>current-jobs-reserved</td>
                            <td>{{ $pheanstalkStatus['current-jobs-reserved'] }}</td>
                        </tr>
                        <tr>
                            <td>current-jobs-delayed</td>
                            <td>{{ $pheanstalkStatus['current-jobs-delayed'] }}</td>
                        </tr>
                        <tr>
                            <td>current-jobs-buried</td>
                            <td>{{ $pheanstalkStatus['current-jobs-buried'] }}</td>
                        </tr>
                    </table><br>
                    <a href="{{ route('home') }}"><button>Stop autoreload</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // function getQueryVariable(variable) {
    //     var query = window.location.search.substring(1);
    //     var vars = query.split("&");
    //     for (var i = 0; i < vars.length; i++) {
    //         var pair = vars[i].split("=");
    //         if (pair[0] == variable) {
    //             return pair[1];
    //         }
    //     }
    //     //console.log('Query Variable ' + variable + ' not found');
    // }
    //
    // var param1var = getQueryVariable("autoReload");
    //
    // if (param1var) {
    //     setTimeout(function(){
    //         location = '/home?autoReload=1'
    //     },1000)
    // }
</script>
@endsection
