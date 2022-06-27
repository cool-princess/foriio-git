@extends('layouts.custom')

@section('content')
    <section id="admin_report" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-register-input-title active">foriioが配信するプレスリリースの原稿を作成しましたのでご確認ください。</div>
            <div class="main-title admin-register-thanks-title"><img src="{{ asset('img/register-complete.png') }}" alt=""><span>受け付け完了</span></div>
            <div class="workflow">
                <div class="workflow-state workflow-benefits active">
                    <div class="workflow-title active-pass">
                        05.プレスリリース原稿
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-current"><span>確認</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
                    </div>
                </div>
            </div>
            <div class="admin-report-input-text">
                以下のURLよりプレスリリースの内容をご確認ください。
            </div>
            <div class="admin-report-confirm-text" style="display: none;">
                ご選択いただいたforiio Benefitsの掲載日とプレスリリース配信日の希望日をご確認ください。
            </div>
            <div class="admin-report-complete-text" style="display: none;">
                プレスリリースを確認していただきありがとうございます。<br>
                こちらで掲載の準備をさせていただきます。
            </div>
            <div class="admin-report-part">
                <form id="report-form">
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                        </div>
                        <div class="admin-register-item-right">
                            <a href="{{ $release_url }}" target="_blank" rel="noopener noreferrer">{{ $release_url }}</a>
                        </div>
                    </div>
                    <div class="admin-register-btn-group">
                        <button type="button" class="common-btn admin-report-btn" id="report-quiz">質問する</button>
                        <button type="button" class="primary-btn admin-report-btn" id="report-confirm">承認する</button>
                    </div>
                </form>
                <div class="admin-report-complete-text" style="display: none;">
                    事業者様のプレスリリースが完成しましたら、配信前にforiio側で確認させて頂きたく思いますので、<br>
                    以下のメールアドレス宛に添付でお送りください。<br>
                    ※配信希望日の1週間前までに以下のメールアドレス宛にお送りください。<br><br>
                    担当者：foriio Benefits 担当窓口<br>
                    mail：benefit@foriio.com
                </div>
                <a href="{{ route('userAllComplete') }}" class="primary-btn admin-all-complete-btn" id="to-end" style="display: none;">すべてを完了</a>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
        <div id="report-quiz" class="modal2">
            <div class="modal-content">
                <h1>質問入力フォーム</h1>
                <form id="quiz-form">
                    <textarea name="quiz" id="" placeholder="質問・修正依頼をご記入ください。"></textarea>
                    <span class="invalid-feedback"></span>
                    <a href="#" class="admin-report-btn primary-btn" id="report-quiz-send">送信する</a>
                </form>
                <a href="#" class="modal-close2">&times;</a>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            $( "input[name=desire_date]" ).datepicker({ dateFormat: 'yy/mm/dd' });
            $( "input[name=delivery_date]" ).datepicker({ dateFormat: 'yy/mm/dd' });
        });
        $(document).ready(function() {
            $("input[name=report_url]").val("https://docs.google.com/doc/12345678765432");
            $('#report-confirm').click(function(e){
                e.preventDefault();
                var report_url = $('input[name=report_url]').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('userReportPost') }}",
                    method: 'post',
                    dataType : 'json',
                    data: {report_url:report_url},
                    success: function(response){
                        $(".admin-register-input-title").removeClass("active");
                        $(".admin-register-confirm-title").removeClass("active");
                        $(".admin-register-thanks-title").addClass("active");
                        $("#report-form").css("display", "none");
                        $(".admin-report-input-text").css("display", "none");
                        $(".admin-report-confirm-text").css("display", "none");
                        $(".admin-report-complete-text").css("display", "block");
                        $(".admin-all-complete-btn").css("display", "flex");
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            });

            $("textarea[name=quiz]").focus(function() {
                $("textarea[name=quiz]").next().css("display", "none");
            });
            $("#report-quiz-send").click(function(e) {
                var status = true;
                if($("textarea[name=quiz]").val() == '') {
                    $("textarea[name=quiz]").next().text("質問は必須です。入力ください。");
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
                        url: "{{ route('userReportQuiz') }}",
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
                if (event.target.matches("#report-quiz")) {
                    document.querySelector(".modal2").style.visibility = "visible";
                    document.querySelector(".modal2").style.opacity = "1";
                }
                else if (event.target.py(".modal-close1") || event.target.matches(".modal-close2")) {
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