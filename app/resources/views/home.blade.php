@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!


                    <?php var_dump($arr); ?>

                    <br>
                    <button>
                        <a href="{{ route('send-email') }}" onclick="event.preventDefault(); document.getElementById('send-email').submit();">
                            Сгенерировать отправку 10 emails
                        </a>
                        <form id="send-email" action="{{ route('send-email') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </button>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
