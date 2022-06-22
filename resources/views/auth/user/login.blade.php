@extends('layouts.custom')

@section('content')
    <div class="header">
        @include('includes.header')
    </div>
    <section id="admin_login">
        <div class="login-l-part">
            <div class="login-title">
                <img src="{{ asset('img/login-title.svg') }}" alt="">
            </div>
            <div class="login-content">
                『foriio Benefits』は、クリエイターのポートフォリオプラットフォーム「foriio」の会員様限定の福利厚生サービスで、クリエイターライフをサポートする衣・食・住を中心としたtoC向けの様々なサービスを掲載しています。<br><br>
                掲載費用は一切ございません。また、ランニングコストやforiio Benefits経由で商品購入・サービス申し込み等された際にも費用は発生致しません。
            </div>
            @if ($error = $errors->first('email'))
                <div class="invalid-feedback">
                    {{ $error }}
                </div>
            @endif
            @php if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass']))
            {
                $login_email = $_COOKIE['login_email'];
                $login_pass  = $_COOKIE['login_pass'];
            }
            else{
                $login_email ='';
                $login_pass = '';
            }
            @endphp
            <div class="login-form">
                <form method="POST" action="{{ route('userLoginPost') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-main">
                        <div class="login-item">
                            <div class="login-item-label">
                                メールアドレス
                            </div>
                            <div class="login-item-input">
                                <input type="text" name="email" required autocomplete="email" value="{{$login_email}}">
                            </div>
                        </div>
                        <div class="login-item">
                            <div class="login-item-label">
                                パスワード
                            </div>
                            <div class="login-item-input">
                                <input id="loginPassword" type="password" name="password" required autocomplete="current-password" value="{{$login_pass}}">
                                <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="login-btn-group">
                        <button type="submit" class="login-btn primary-btn">
                            ログイン
                        </button>
                        <a href="{{route('userRegister')}}" class="login-new-register">新規登録はこちら</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="login-r-part">
            <div class="login-r-part-btn-group">
                <a href="">利用規約</a>
                <a href="">プライバシーポリシー</a>
            </div>
        </div>
        <!-- <div id="forgot-modal" class="modal">
            <div class="modal-content">
                <h1>ログインID・パスワードを忘れた方</h1>
                <p>
                    登録されている担当者様より、<br>
                    以下の事項を記入の上、メールにてお問合せください。<br>
                    後日、返信メールで連絡いたします。<br><br>
                    ・メールタイトル<br>
                    　ジブリパークチケット購入者統計データ提供サイト　ID・PW問合せ<br><br>
                    ・メール本文<br>
                    　登録会社名：<br>
                    　担当者名：<br>
                    　連絡先電話番号：<br>
                    　連絡先メールアドレス：<br>
                    ・連絡先<br>
                    愛知県観光コンベンション局観光振興課<br>
                    企画グループ<br>
                    <a href="mailto:kanko@pref.aichi.lg.jp">kanko@pref.aichi.lg.jp</a>
                </p>
                <a href="#" class="modal-close">&times;</a>
            </div>
        </div> -->
    </section>
    <script>
        document.addEventListener("click", function(event) {
                if (event.target.matches(".login-info-forgot")) {
                    document.querySelector(".modal").style.visibility = "visible";
                    document.querySelector(".modal").style.opacity = "1";
                }
                // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
                else if (event.target.matches(".modal-close") || !event.target.closest(".modal-content")) {
                    closeModal();
                }
            },
                false
        )

        function closeModal() {
            document.querySelector(".modal").style.visibility = "hidden";
            document.querySelector(".modal").style.opacity = "0";
        }
        $(document).ready(function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#loginPassword');
            if(togglePassword) {
                togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>
@stop