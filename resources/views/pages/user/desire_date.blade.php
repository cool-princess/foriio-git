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
                <div class="workflow-state workflow-register active-pass pc">
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
                <div class="workflow-state workflow-contract active-pass pc">
                    <div class="workflow-title active-pass">
                        02.契約書締結
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle active-pass"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-benefits active-pass pc">
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
                        <div class="workflow-circle circle01 active-current"><span>入力</span></div>
                        <div class="workflow-border border01"></div>
                        <div class="workflow-circle circle02"><span>確認</span></div>
                        <div class="workflow-border border02"></div>
                        <div class="workflow-circle circle03"><span>完了</span></div>
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
                            <div>プレスリリース配信日 <span class="extra">自動で入力されます</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="datetime" name="delivery_date" placeholder="yyyy/mm/dd" value="{{old('delivery_date')}}" class="form-item readonly" readonly="radyonly">
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
                        <button type="button" class="common-btn admin-benefit-btn" id="desire-back" style="display: none;">編集する</button>
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
        });
        $(document).ready(function() {
            $( "input[name=desire_date]" ).datepicker({
                beforeShowDay: $.datepicker.noWeekends
            });
            $("input[name=desire_date]").datepicker( $.datepicker.regional[ "ja" ] );
            $("input[name=desire_date]").change(function () {
                var filterDate = new Date($(this).val());
                var day = filterDate.getDay();
                console.log(filterDate);
                if(day == 5) 
                    filterDate.setDate(filterDate.getDate() + 3);
                else
                    filterDate.setDate(filterDate.getDate() + 1);
                month = filterDate.getMonth() + 1;
                date = filterDate.getDate();
                if (date < 10)
                {
                    date = '0' + date;
                }
                if (month < 10)
                {
                    month = '0' + (filterDate.getMonth()+1);
                }

                var weekdays = ["日曜", "月曜", "火曜", "水曜", "木曜", "金曜", "土曜"];
                var desire_date = new Date($(this).val());
                var desire_weekday = weekdays[desire_date.getDay()];
                if(day == 5) 
                    var delivery_weekday = weekdays[1];
                else
                    var delivery_weekday = weekdays[desire_date.getDay() + 1];
                
                $("input[name=desire_date]").val($("input[name=desire_date]").val() + "(" + desire_weekday + ")");
                $("input[name=delivery_date]").val(filterDate.getFullYear() + '/' + month + '/' + date + "(" + delivery_weekday + ")");
            });
            $("input[name=desire_date]").focus(function() {
                $("input[name=desire_date]").next().css("display", "none");
                $("input[name=delivery_date]").next().css("display", "none");
            });
            $("input[name=delivery_date]").change(function () {
                $("input[name=delivery_date]").next().css("display", "none");
            });
            $("input[name=delivery_date]").focus(function() {
                $("input[name=delivery_date]").next().css("display", "none");
            });
            $("input[name=delivery_date]").click(function(e) {
                e.stopPropagation();
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
                    $("#desire-back").css("display", "flex");
                    $(".admin-register-input-title").removeClass("active");
                    $(".admin-register-confirm-title").addClass("active");
                    $(".admin-register-thanks-title").removeClass("active");
                    $(".form-item").attr("readonly", true);
                    $(".circle01").removeClass("active-current");
                    $(".circle01").addClass("active-past");
                    $(".border01").addClass("active-past");
                    $(".circle02").addClass("active-current");
                    $(".admin-register-item").addClass("active");
                }
            });
            $("#desire-back").click(function() {
                $("#desire-thanks").css("display", "none");
                $(".admin-desire-confirm-text").css("display", "none");
                $(".admin-desire-input-text").css("display", "block");
                $("#desire-confirm").css("display", "flex");
                $("#desire-back").css("display", "none");
                $(".admin-register-input-title").addClass("active");
                $(".admin-register-confirm-title").removeClass("active");
                $(".admin-register-thanks-title").removeClass("active");
                $(".form-item").attr("readonly", false);
                $(".circle01").addClass("active-current");
                $(".circle01").removeClass("active-past");
                $(".border01").removeClass("active-past");
                $(".circle02").removeClass("active-current");
                $(".admin-register-item").removeClass("active");
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
                        $(".circle02").removeClass("active-current");
                        $(".circle02").addClass("active-past");
                        $(".circle03").addClass("active-current");
                        $(".border02").addClass("active-past");
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
            });
        });
    </script>
@stop