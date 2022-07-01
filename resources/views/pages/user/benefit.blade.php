@extends('layouts.custom')

@section('content')
    <section id="admin_benefit" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-register-input-title active">foriio Benefitsフォーム</div>
            <div class="main-title admin-register-confirm-title">foriio Benefitsに掲載する特典内容の確認</div>
            <div class="main-title admin-register-thanks-title"><img src="{{ asset('img/register-thanks.png') }}" alt=""><span>foriio Benefitsに掲載する特典内容が送信されました。</span></div>
            <div class="workflow">
                <div class="workflow-state workflow-register active-pass pc">
                    <div class="workflow-title">
                        01.会員登録
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-pass"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>確認</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-contract active-pass pc">
                    <div class="workflow-title">
                        02.契約書締結
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-pass"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-benefits active">
                    <div class="workflow-title">
                        03.特典内容
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle circle01 active-current"><span>入力</span></div>
                        <div class="workflow-border border01"></div>
                        <div class="workflow-circle circle02"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-date-info pc">
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
            <div class="benefit-text">
                foriio Benefitsページの作成にあたって支給いただきたい情報がございますので下記へご記入ください。<br>
                ご記入後には、必ず右下の赤い送信ボタンを押してください。<br>
                また、下記URLが掲載されるページとなりますので、ご確認いただければ幸いです。<br>
                foriioBENEFIT：<a href="https://www.foriio.com/benefits">https://www.foriio.com/benefits</a>
            </div>
            <div class="admin-benefit-part">
                <script charset="utf-8" type="text/javascript" src="http:////js.hsforms.net/forms/v2.js"></script>
                <script>
                    hbspt.forms.create({
                        region: "na1",
                        portalId: "21032329",
                        formId: "4f05e172-1d8e-4c6e-a493-ce777e8b432e"
                    });
                </script>
                <a href="" class="benefit-alt-btn">送信</a>
                <div class="benefit-submit-confirm-text">
                    記入内容を確認し、送信ボタンを押してください
                </div>
            </div>
            <div class="admin-benefit-btn-group">
                <div class="admin-benefit-btn-part benefit-quiz">
                    <div class="admin-benefit-btn-text">
                        質問がある方は下のボタンからお送りください。
                    </div>
                    <button type="button" class="common-btn admin-benefit-btn" id="benefit-quiz">質問する</button>
                </div>
                <div class="admin-benefit-btn-part benefit-thanks">
                    <div class="admin-benefit-btn-text">
                        フォーム下の送信ボタンを必ず押してから次へお進みください。
                    </div>
                    <a href="" class="primary-btn admin-benefit-btn" id="benefit-thanks">フォーム送信後、次へ進む</a>
                </div>
                <div class="admin-benefit-btn-part to-desired" style="display: none;">
                    <div class="admin-benefit-btn-text">
                        foriio Benefitsの掲載日、プレスリリースの配信日、についてご希望日時を教えていただきますので<br>
                        下のボタンよりお進みください。
                    </div>
                    <a href="{{route('userDesired')}}" class="primary-btn admin-benefit-btn" id="to-desired">希望日選択へ進む</a>
                </div>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
        <div id="benefit-quiz" class="modal2">
            <div class="modal-content">
                <h1>質問入力フォーム</h1>
                <form id="quiz-form">
                    <textarea name="quiz" id="" placeholder="質問をご記入ください。"></textarea>
                    <span class="invalid-feedback"></span>
                    <a href="#" class="admin-benefit-btn primary-btn" id="benefit-quiz-send">送信する</a>
                </form>
                <a href="#" class="modal-close2">&times;</a>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('.hs-form-iframe').contents().find('.hs-form').submit(function() { 
                alert("ok");
                return true; //return false prevents submit
            });
            $(".benefit-alt-btn").click(function (e) {
                e.preventDefault();
                var iframe = $('.hs-form-iframe').contents();
                iframe.find('.hs-form').submit();
                $(".benefit-alt-btn").css("display", "none");
                $(".benefit-submit-confirm-text").css("display", "none");
                $(".benefit-text").css("display", "none");

            });
            $("#benefit-thanks").click(function (e) {
                e.preventDefault();
                var iframe = $('.hs-form-iframe').contents();
                if(iframe.find('.hs-button').length)
                    toastr.error("フォーム下の送信ボタンを必ず押してから次へお進みください。");
                else {
                    var benefit = true;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('userBenefitPost') }}",
                        method: 'post',
                        dataType : 'json',
                        data: {benefit:benefit},
                        success: function(response){
                            console.log(response);
                            $(".admin-register-input-title").removeClass("active");
                            $(".admin-register-confirm-title").removeClass("active");
                            $(".admin-register-thanks-title").addClass("active");
                            $("#benefit-form").css("display", "none");
                            $(".benefit-thanks").css("display", "none");
                            $(".benefit-quiz").css("display", "none");
                            $(".admin-benefit-confirm-text").css("display", "none");
                            $(".to-desired").css("display", "flex");
                            $(".circle01").removeClass("active-current");
                            $(".circle01").addClass("active-past");
                            $(".border01").addClass("active-past");
                            $(".circle02").addClass("active-current");
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
                }
            });

            $("textarea[name=quiz]").focus(function() {
                $("textarea[name=quiz]").next().css("display", "none");
            });
            $("#benefit-quiz-send").click(function(e) {
                var status = true;
                if($("textarea[name=quiz]").val() == '') {
                    $("textarea[name=quiz]").next().text("質問・修正依頼内容は必須です。入力ください。");
                    $("textarea[name=quiz]").next().css("display", "block");
                    status = false;
                }
                if(status) {
                    e.preventDefault();
                    var quiz = $('textarea[name=quiz]').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('userBenefitQuiz') }}",
                        method: 'post',
                        dataType : 'json',
                        data: {quiz:quiz},
                        success: function(response){
                            document.querySelector(".modal2").style.visibility = "hidden";
                            document.querySelector(".modal2").style.opacity = "0";
                            toastr.success("質問が送信されました。");
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
                }
            });

            document.addEventListener("click", function(event) {
                if (event.target.matches("#benefit-quiz")) {
                    document.querySelector(".modal2").style.visibility = "visible";
                    document.querySelector(".modal2").style.opacity = "1";
                }
                else if (event.target.matches(".modal-close1") || event.target.matches(".modal-close2")) {
                    event.preventDefault();
                    closeModal();
                }
            }, false
            );

            function closeModal() {
                document.querySelector(".modal2").style.visibility = "hidden";
                document.querySelector(".modal2").style.opacity = "0";
            }
        });
    </script>
@stop