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

                    <h5>Beanstalkd statistic <a href="{{ route('home') }}"><button>Update</button></a></h5>
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

                    <h5>Log: last 10 emails sent<br></h5>
                    <table border="2" cellpadding="4">
                        @foreach($sendEmails as $sendEmail)
                        <tr>
                            <td>{{ $sendEmail }}</td>
                        </tr>
                        @endforeach
                    </table><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
