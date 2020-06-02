@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Dashboard.</b> You are logged in!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>
                    <button>
                        <a href="{{ route('send-email') }}" onclick="event.preventDefault(); document.getElementById('send-email').submit();">
                            Отправить email
                        </a>
                        <form id="send-email" action="{{ route('send-email') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </button>

                    <br>
                    <hr>
                    <p></p>
                    <table border="2" cellpadding="4">
                        <thead>Последние 10 отправленных сообщений</thead>
                        <tr>
                            <th>ID</th>
                            <th>message_id</th>
                            <th>customer_id</th>
                            <th>message</th>
                            <th>date_send</th>
                        </tr>
                        @foreach($messageSend as $message)
                        <tr>
                            <td>{{ $message['message_id'] }}</td>
                            <td>{{ $message['customer_id'] }}</td>
                            <td>{{ $message['message'] }}</td>
                            <td>{{ $message['date_send'] }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <br>
                    <hr>
                    <p></p>
                    <table border="2" cellpadding="4">
                        <thead>Расписание отправки сообщений (limit=10, сортировка по дате)</thead>
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Request date</th>
                            <th>Timezone</th>
                            <th>Dispatch date</th>
                        </tr>
                        @foreach($messagesInSchedule as $message)
                        <tr>
                            <td>{{ $message['message_schedule_id'] }}</td>
                            <td>{{ $message['message'] }}</td>
                            <td>{{ $message['request_date'] }}</td>
                            <td>{{ $message['timezone'] }}</td>
                            <td>{{ $message['dispatch_date'] }}</td>
                        </tr>
                        @endforeach
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
