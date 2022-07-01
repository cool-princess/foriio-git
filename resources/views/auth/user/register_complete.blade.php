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
                メールにてログインのご案内をいたしましたのでご確認ください。
            </div>
            <div class="admin-register-btn-group">
                <a href="{{ route('userContract') }}" class="admin-register-btn primary-btn" id="to-contract">契約書の締結に進む</a>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
@stop