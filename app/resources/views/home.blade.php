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

                    <h5>Тестирование отправки сообщения</h5>
                    <form id="send-email" action="{{ route('send-email') }}" method="POST">
                        <p>
                            <select name="customer_id">
                                @foreach($customers as $customer)
                                <option value="{{$customer->customer_id}}">{{ $customer->name }}</option>
                                @endforeach
                            </select> Select customer
                        </p>
                        <p>
                            <input name="message" type="text" value="Test message <?=time() ?>">
                        </p>
                        <p>
                            <select name="timezone">
                                <option>Europe/Kiev</option>
                                <option>Europe/London</option>
                                <option>Europe/Amsterdam</option>
                                <option>Europe/Minsk</option>
                                <option>Asia/Tokyo</option>
                            </select> Select Timezone
                        </p>
                        <p>
                            <input name="request_date" type="text" value="{{ $dateTime }}"> Set DataTime
                        </p>
                        @csrf
                        <p>
                            <input type="submit" value="Отправить">
                        </p>
                    </form><br>

                    <hr>
                    <h5>Последние 10 отправленных сообщений <a href="{{ route('home') }}"><button>Обновить</button></a><br></h5>
                    <table border="2" cellpadding="4">
                        <tr>
                            <th>ID</th>
                            <th>message_id</th>
                            <th>customer_id</th>
                            <th>message</th>
                            <th>date_send</th>
                        </tr>
                        @foreach($messageSend as $message)
                        <tr>
                            <td>{{ $message['logs_send_message_id'] }}</td>
                            <td>{{ $message['message_id'] }}</td>
                            <td>{{ $message['customer_id'] }}</td>
                            <td>{{ $message['message'] }}</td>
                            <td>{{ $message['date_send'] }}</td>
                        </tr>
                        @endforeach
                    </table><br>

                    <hr>
                    <h5>Расписание отправки для 10 последних сообщений</h5>
                    <table border="2" cellpadding="4">
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
