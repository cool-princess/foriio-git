@extends('layouts.custom')

@section('content')
    <section id="admin_register" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-register-input-title active">foriio Benefits会員登録</div>
            <div class="main-title admin-register-confirm-title">登録内容の確認</div>
            <div class="main-title admin-register-thanks-title"><img src="{{ asset('img/register-thanks.png') }}" alt=""><span>仮登録完了</span></div>
            <div class="workflow">
                <div class="workflow-state workflow-register active">
                    <div class="workflow-title">
                        01.会員登録
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-past"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-current"><span>確認</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-contract">
                    <div class="workflow-title">
                        02.契約書締結
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-benefits">
                    <div class="workflow-title">
                        03.特典内容
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-date-info">
                    <div class="workflow-title">
                        04.掲載日・プレスリリース日
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>確認</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
                    </div>
                </div>
            </div>
            <div class="admin-register-part">
                <form id="register-form">
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>会社名<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="text" name="company" placeholder="" value="{{old('company')}}" class="form-item">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>担当者名<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="text" name="person" placeholder="" value="{{old('person')}}" class="form-item">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>メールアドレス<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="text" name="email" placeholder="" value="{{old('email')}}" class="form-item">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>パスワード<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="text" name="password" value="{{old('password')}}" class="form-item">
                            <!-- <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i> -->
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <p class="admin-register-text">こちらからforiio Benefitsの会員登録をお願いいたします。<br>
                        ご入力いただけましたら確認画面へおすすみください。
                    </p>
                    <div class="admin-register-btn-group">
                        <button type="button" class="admin-register-btn common-btn" id="register-back">編集する</button>
                        <button type="button" class="admin-register-btn primary-btn" id="register-confirm">確認画面へ進む</button>
                        <button type="submit" class="admin-register-btn primary-btn" id="register-thanks">登録する</button>
                    </div>
                </form>
                <div class="admin-register-success-text">
                    foriio Benefitsへのご登録ありがとうございます。<br>
                    メールにてログインのご案内をいたしましたのでご確認ください。
                </div>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
    <script>
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!regex.test(email)) {
                return false;
            }else{
                return true;
            }
        }
        $(document).ready(function() {
            $("input[name=company]").focus(function() {
                $("input[name=company]").next().css("display", "none");
            });
            $("input[name=person]").focus(function() {
                $("input[name=person]").next().css("display", "none");
            });
            $("input[name=email]").focus(function() {
                $("input[name=email]").next().css("display", "none");
            });
            $("input[name=password]").focus(function() {
                $("input[name=password]").next().css("display", "none");
            });
            $("#register-confirm").click(function() {
                var status = true;
                if($("input[name=company]").val() == '') {
                    $("input[name=company]").next().text("会社名は必須です");
                    $("input[name=company]").next().css("display", "block");
                    status = false;
                }
                if($("input[name=person]").val() == '') {
                    $("input[name=person]").next().text("担当者名は必須です");
                    $("input[name=person]").next().css("display", "block");
                    status = false;
                }
                if($("input[name=email]").val() == '') {
                    $("input[name=email]").next().text("メールアドレスは必須です");
                    $("input[name=email]").next().css("display", "block");
                    status = false;
                }
                else {
                    if(!IsEmail($("input[name=email]").val())) {
                        $("input[name=email]").next().text("メールは有効な形式である必要があります");
                        $("input[name=email]").next().css("display", "block");
                        status = false;
                    }
                }
                if($("input[name=password]").val() == '') {
                    $("input[name=password]").next().text("パスワードは必須です");
                    $("input[name=password]").next().css("display", "block");
                    status = false;
                }
                if($("input[name=password]").val().length < 8) {
                    $("input[name=password]").next().text("パスワードは8文字以上である必要があります");
                    $("input[name=password]").next().css("display", "block");
                    status = false;
                }
                if(status) {
                    $("#register-back").css("display", "flex");
                    $("#register-thanks").css("display", "flex");
                    $("#register-confirm").css("display", "none");
                    $(".admin-register-input-title").removeClass("active");
                    $(".admin-register-confirm-title").addClass("active");
                    $(".admin-register-thanks-title").removeClass("active");
                    $(".form-item").attr("readonly", true);
                }
            });
            $("#register-back").click(function() {
                $("#register-back").css("display", "none");
                $("#register-thanks").css("display", "none");
                $("#register-confirm").css("display", "flex");
                $(".admin-register-input-title").addClass("active");
                $(".admin-register-confirm-title").removeClass("active");
                $(".admin-register-thanks-title").removeClass("active");
                $(".form-item").attr("readonly", false);
            });
            $('#register-thanks').click(function(e){
                e.preventDefault();
                var company = $('input[name=company]').val();
                var person = $('input[name=person]').val();
                var email = $('input[name=email]').val();
                var password = $('input[name=password]').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('userRegisterPost') }}",
                    method: 'post',
                    dataType : 'json',
                    data: {company:company, person:person, email:email, password:password},
                    success: function(response){
                        console.log(response);
                        if (response.success == '仮登録に成功しました。') {
                            $(".admin-register-input-title").removeClass("active");
                            $(".admin-register-confirm-title").removeClass("active");
                            $(".admin-register-thanks-title").addClass("active");
                            $("#register-form").css("display", "none");
                            $(".admin-register-success-text").css("display", "block");
                        }
                        else if(response.success == 'すでに登録されているメールです。') {
                            $("input[name=email]").next().text("すでに登録されているメールです。");
                            $("input[name=email]").next().css("display", "block");
                            $("#register-back").css("display", "none");
                            $("#register-thanks").css("display", "none");
                            $("#register-confirm").css("display", "flex");
                            $(".admin-register-input-title").addClass("active");
                            $(".admin-register-confirm-title").removeClass("active");
                            $(".admin-register-thanks-title").removeClass("active");
                            $(".form-item").attr("readonly", false);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            });
        });
    </script>
@stop