@extends('layouts.custom')

@section('content')
    <section id="admin_register" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-register-complete-title"><img src="{{ asset('img/register-complete.png') }}" alt=""><span style="color: #5863f8">登録完了</span></div>
            <div class="admin-register-complete-content">
                foriic BENEFITへのご登録ありがとうございます。<br>
                メールにてログインのご案内をいたしましたのでご確認ください。<br><br>
                また、契約書の準備が完了しましたら、メールにてご連絡いたします。<br>
                今しばらくお待ちください。
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location.href="{{ route('userContract') }}";
            }, 1000);
        });
    </script>
@stop