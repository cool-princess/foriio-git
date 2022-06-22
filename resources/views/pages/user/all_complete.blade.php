@extends('layouts.custom')

@section('content')
    <section id="all_complete" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="all-left">
                <img src="{{asset('img/all-complete.png')}}" alt="">
                <div class="all-title">
                    完了
                </div>
                <div class="all-content">
                    全ての作業が完了いたしました。<br>
                    ご協力いただきありがとうございます。<br><br>
                    foriio Benefitsの掲載・プレスリリースの配信まで<br>
                    お待ちください。
                </div>
            </div>
            <div class="all-right">
                <div class="all-item">
                    <img src="{{asset('img/all-item01.png')}}" alt="">
                    <a href="">foriio Benefitsをみる</a>
                </div>
                <div class="all-item">
                    <img src="{{asset('img/all-item02.png')}}" alt="">
                    <a href="">クリエイターをみる</a>
                </div>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
@stop