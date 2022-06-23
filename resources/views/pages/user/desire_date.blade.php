@extends('layouts.custom')

@section('content')
    <section id="admin_desire_date" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-register-input-title active">foriio Benefits掲載日・プレスリリース配信日</div>
            <div class="main-title admin-register-confirm-title">公開日の確認</div>
            <div class="main-title admin-register-thanks-title"><img src="{{ asset('img/register-complete.png') }}" alt=""><span>受け付け完了</span></div>
            <div class="workflow">
                <div class="workflow-state workflow-register active">
                    <div class="workflow-title active-pass"">
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
                <div class="workflow-state workflow-contract active">
                    <div class="workflow-title active-pass">
                        02.契約書締結
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-pass"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-benefits active">
                    <div class="workflow-title active-pass">
                        03.特典内容
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-pass"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-date-info active">
                    <div class="workflow-title active-current">
                        04.掲載日・プレスリリース日
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-current"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>確認</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
                    </div>
                </div>
            </div>
            <div class="admin-desire-input-text">
                foriio Benefitsの掲載希望日をご選択ください。<br>
                プレスリリース配信日は、foriio Benefits掲載日の翌日になります。
            </div>
            <div class="admin-desire-confirm-text" style="display: none;">
                ご選択いただいたforiio Benefitsの掲載日とプレスリリース配信日の希望日をご確認ください。
            </div>
            <div class="admin-desire-complete-text" style="display: none;">
                foriio Benefitsの掲載日とプレスリリース配信日の希望日を送信しました。
            </div>
            <div class="admin-desire-part">
                <form id="desire-form">
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>foriio Benefits掲載希望日<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="datetime" name="desire_date" placeholder="yyyy/mm/dd" value="{{old('desire_date')}}" class="form-item">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>プレスリリース配信日<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="datetime" name="delivery_date" placeholder="yyyy/mm/dd" value="{{old('delivery_date')}}" class="form-item">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-desire-input-text">
                        プレスリリース配信日は、foriio Benefits掲載日の翌日になります。<br>
                        ※土日祝日、夏季休暇、年末年始休暇の掲載・配信は承っておりません。<br>
                        ※foriio Benefits掲載日を金曜日に選択した場合、プレスリリース配信日は翌週月曜日となります。<br>
                        ※お申し込みから掲載・配信まで最低2週間~3週間かかりますので、その日数を考慮した希望日をご指定ください。
                    </div>
                    <div class="admin-desire-confirm-text" style="display: none;">
                        ご確認いただいた内容でお間違いがなければ送信してください。
                    </div>
                    <div class="admin-register-btn-group">
                        <button type="button" class="primary-btn admin-benefit-btn" id="desire-confirm">確認画面へ進む</button>
                        <button type="submit" class="primary-btn admin-benefit-btn" id="desire-thanks" style="display: none;">送信する</button>
                    </div>
                </form>
                <div class="admin-desire-complete-text" style="display: none;">
                    foriio Benefits掲載準備を進めさせていただきます。<br>
                    また、プレスリリースは追って原稿をお送りさせていただきますのでしばらくお待ちください。
                </div>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
    <script>
        $(function() {
            $( "input[name=desire_date]" ).datepicker({ dateFormat: 'yy/mm/dd' });
            $("input[name=desire_date]").datepicker( $.datepicker.regional[ "ja" ] );
            $( "input[name=delivery_date]" ).datepicker({ dateFormat: 'yy/mm/dd' });
            $("input[name=delivery_date]").datepicker( $.datepicker.regional[ "ja" ] );
        });
        $(document).ready(function() {
            $("input[name=desire_date]").focus(function() {
                $("input[name=desire_date]").next().css("display", "none");
            });
            $("input[name=delivery_date]").focus(function() {
                $("input[name=delivery_date]").next().css("display", "none");
            });
            $("#desire-confirm").click(function() {
                var status = true;
                if($("input[name=desire_date]").val() == '') {
                    $("input[name=desire_date]").next().text("このフィールドは必須です");
                    $("input[name=desire_date]").next().css("display", "block");
                    status = false;
                }
                if($("input[name=delivery_date]").val() == '') {
                    $("input[name=delivery_date]").next().text("このフィールドは必須です");
                    $("input[name=delivery_date]").next().css("display", "block");
                    status = false;
                }
                if(status) {
                    $("#desire-thanks").css("display", "flex");
                    $(".admin-desire-confirm-text").css("display", "block");
                    $(".admin-desire-input-text").css("display", "none");
                    $("#desire-confirm").css("display", "none");
                    $(".admin-register-input-title").removeClass("active");
                    $(".admin-register-confirm-title").addClass("active");
                    $(".admin-register-thanks-title").removeClass("active");
                    $(".form-item").attr("readonly", true);
                }
            });
            $('#desire-thanks').click(function(e){
                e.preventDefault();
                var desire_date = $('input[name=desire_date]').val();
                var delivery_date = $('input[name=delivery_date]').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('userDatePost') }}",
                    method: 'post',
                    dataType : 'json',
                    data: {desire_date:desire_date, delivery_date:delivery_date},
                    success: function(response){
                        $(".admin-register-input-title").removeClass("active");
                        $(".admin-register-confirm-title").removeClass("active");
                        $(".admin-register-thanks-title").addClass("active");
                        $("#desire-form").css("display", "none");
                        $(".admin-desire-confirm-text").css("display", "none");
                        $(".admin-desire-complete-text").css("display", "block");
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            });
        });
    </script>
@stop