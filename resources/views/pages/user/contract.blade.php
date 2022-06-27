@extends('layouts.custom')

@section('content')
    <section id="admin_contract" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-contract-input-title active">業務提携契約書</div>
            <div class="workflow">
                <div class="workflow-state workflow-register active">
                    <div class="workflow-title">
                        01.会員登録
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-past"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-past"><span>確認</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-past"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-contract active">
                    <div class="workflow-title">
                        02.契約書締結
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-current"><span>入力</span></div>
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
            <div class="contract-part">
                <div class="contract-content">
                    下記の契約書をご確認ください。<br>
                    記載内容の修正は「質問・修正依頼」から内容をご記入いただけます。
                </div>
                <div class="contract-img">
                    <img src="{{ asset('img/contract-img.png') }}" alt="">
                </div>
            </div>
            <div class="admin-register-btn-group">
                <a href="#contract-quiz" class="admin-register-btn common-btn" id="contract-quiz">質問・修正依頼</button>
                <a href="#contract-modal" class="admin-register-btn primary-btn" id="contract-confirm">締結に進む</a>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
        <div id="contract-quiz" class="modal2">
            <div class="modal-content">
                <h1>質問・修正依頼をご記入ください。</h1>
                <form id="quiz-form">
                    <textarea name="quiz" id="" placeholder="質問・修正依頼をご記入ください。"></textarea>
                    <span class="invalid-feedback"></span>
                    <a href="#" class="admin-contract-btn primary-btn" id="contract-quiz-send">送信する</a>
                </form>
                <a href="#" class="modal-close2">&times;</a>
            </div>
        </div>
        <div id="contract-modal" class="modal1">
            <div class="modal-content">
                <h1>本当に締結しますか？</h1>
                <a href="{{ route('userContractConfirm') }}" class="admin-contract-btn primary-btn" id="contract-complete">締結する</a>
                <a href="#" class="modal-close1">&times;</a>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("click", function(event) {
                if (event.target.matches("#contract-confirm")) {
                    document.querySelector(".modal1").style.visibility = "visible";
                    document.querySelector(".modal1").style.opacity = "1";
                }
                // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()

                else if (event.target.matches("#contract-quiz")) {
                    document.querySelector(".modal2").style.visibility = "visible";
                    document.querySelector(".modal2").style.opacity = "1";
                }
                else if (event.target.matches(".modal-close1") || event.target.matches(".modal-close2")) {
                    event.preventDefault();
                    closeModal();
                }
            }, false
        )

        function closeModal() {
            document.querySelector(".modal1").style.visibility = "hidden";
            document.querySelector(".modal1").style.opacity = "0";
            document.querySelector(".modal2").style.visibility = "hidden";
            document.querySelector(".modal2").style.opacity = "0";
        }

        $(document).ready(function() {
            $("textarea[name=quiz]").focus(function() {
                $("textarea[name=quiz]").next().css("display", "none");
            });
            $("#contract-quiz-send").click(function(e) {
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
                        url: "{{ route('userContractQuiz') }}",
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
        });
    </script>
@stop