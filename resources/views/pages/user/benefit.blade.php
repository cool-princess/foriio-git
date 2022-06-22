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
                <div class="workflow-state workflow-register active">
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
                <div class="workflow-state workflow-contract active">
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
                        <div class="workflow-circle active-pass"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle active-pass"><span>完了</span></div>
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
            <div class="benefit-text">
                foriio Benefitsページの作成にあたって支給いただきたい情報がございますので下記へご記入ください。<br>
                また、下記URLが掲載されるページとなりますので、ご確認いただければ幸いです。<br>
                foriioBENEFIT：<a href="https://www.foriio.com/benefits">https://www.foriio.com/benefits</a>
            </div>
            <div class="admin-benefit-part">
                <form id="benefit-form">
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
                            <div>会社名<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <input type="text" name="company" placeholder="" value="{{old('company')}}" class="form-item">
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>特典の対象となる品物・サービス名（40文字ほど）<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea name="item" placeholder="（サービス例）肩こり解消トレーニング　　（商品名）枕" value="{{old('item')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>特典内容（80文字ほど）<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea rows="6" name="benefits" placeholder="（サービス例.1）レッスン料金から10％OFF(税別)&#10;（サービス例.2）レッスン料金から1,000円OFF(税別)&#10;（商品例.1）購入価格から20％OFF(税別)&#10;（商品例.2）購入価格から2,000円OFF(税別)" value="{{old('benefits')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>特典を受ける場合の条件の有無　※なしの場合は「なし」とご記入ください。<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea rows="4" name="condition" placeholder="（例.1）本特典のご利用にはご購入時、クーポンコード記入欄に「foriio」と記入&#10;（例.2）事前に会員登録が必要となります&#10;※条件は全てご記入ください。" value="{{old('condition')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>特典利用方法<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea name="method" placeholder="以下「利用する」をクリックして、お申し込みページのクーポンコード入力欄に「クーポンコード」を記入してお申し込みください。" value="{{old('method')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>特典を受け入れる回数の上限<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea name="maximum" placeholder="（例.1）初回限定　　（例.2）上限なし　　（例.3）１人１回限り" value="{{old('maximum')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>サービス内容が分かる画像　横680px×縦420px　ファイル形式：png<span>必須</span></div>
                            <div class="extra-text">※特典の内容が分かる画像をご支給ください（適切な画像がない場合はロゴデータをお送りください）</div>
                        </div>
                        <div class="admin-register-item-right file-upload">
                            <!-- <input type="file" name="image" id="imgUpload" style="display: none;"> -->
                            <label class="" for="chooseFile">画像をアップロードする</label>
                            <input type="file" name="imageUpload" id="chooseFile" style="display: none;" accept="image/*" data-type="image">
                            <span class="invalid-feedback"></span>
                            <input type="text" name="fileName" id="fileName" readonly="readonly">
                        </div>
                        <div class="file-upload-thumb"></div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>遷移先のURL（お申込みページ）<span>必須</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea name="transitionlink" placeholder="お申込みページがある場合はこちらにURLをご記載ください。" value="{{old('transitionlink')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-register-item">
                        <div class="admin-register-item-left">
                            <div>遷移先のURL（サービスサイトURL）<span class="extra">任意</span></div>
                        </div>
                        <div class="admin-register-item-right">
                            <textarea name="servicelink" placeholder="お申込みページがある場合はこちらにURLをご記載ください。" value="{{old('servicelink')}}" class="form-item"></textarea>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="admin-benefit-confirm-text" style="display: none;">
                        ご入力いただいた内容にお間違いがなければ送信ください
                    </div>
                    <div class="admin-benefit-success-text" style="display: none;">
                        foriio Benefitsの掲載日、プレスリリースの配信日、についてご希望日時を教えていただきますので<abr>
                        下のボタンよりお進みください。
                    </div>
                    <div class="admin-register-btn-group">
                        <button type="button" class="common-btn admin-benefit-btn" id="benefit-quiz">質問する</button>
                        <button type="button" class="common-btn admin-benefit-btn" id="benefit-back" style="display: none;">戻る</button>
                        <button type="button" class="primary-btn admin-benefit-btn" id="benefit-confirm">確認画面へ進む</button>
                        <button type="submit" class="primary-btn admin-benefit-btn" id="benefit-thanks" style="display: none;">送信する</button>
                    </div>
                </form>
                <a href="{{ route('userDesired') }}" class="primary-btn admin-to-desired-btn" id="to-desired" style="display: none;">希望日選択へ進む</a>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
        <div id="benefit-quiz" class="modal2">
            <div class="modal-content">
                <h1>質問・修正依頼をご記入ください。</h1>
                <form id="quiz-form">
                    <textarea name="quiz" id="" placeholder="質問・修正依頼をご記入ください。"></textarea>
                    <span class="invalid-feedback"></span>
                    <a href="#" class="admin-benefit-btn primary-btn" id="benefit-quiz-send">送信する</a>
                </form>
                <a href="#" class="modal-close2">&times;</a>
            </div>
        </div>
    </section>
    <script>
        $('#chooseFile').change(function() {
            var i = $(this).prev('label').clone();
            const file = this.files[0];
            const  fileType = file['type'];
            const validImageTypes = ['image/png'];
            if (!validImageTypes.includes(fileType)) {
                $("input[name=imageUpload]").next().text("ファイル形式はpngである必要があります。");
                $("input[name=imageUpload]").next().css("display", "block");
                return false;
            }

            var fileReader = new FileReader();
            if (file.type.match('image')) {
                fileReader.onload = function() {
                var img = document.createElement('img');
                img.src = fileReader.result;
                document.getElementsByClassName('file-upload-thumb')[0].appendChild(img);
                };
                fileReader.readAsDataURL(file);
            } 
            console.log($('#chooseFile')[0].files[0].name);
            var pngFile = $('#chooseFile')[0].files[0].name;
            $('#fileName').val(pngFile);
        });

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
            $("input[name=email]").focus(function() {
                $("input[name=email]").next().css("display", "none");
            });
            $("textarea[name=item]").focus(function() {
                $("textarea[name=item]").next().css("display", "none");
            });
            $("textarea[name=benefits]").focus(function() {
                $("textarea[name=benefits]").next().css("display", "none");
            });
            $("textarea[name=condition]").focus(function() {
                $("textarea[name=condition]").next().css("display", "none");
            });
            $("textarea[name=method]").focus(function() {
                $("textarea[name=method]").next().css("display", "none");
            });
            $("textarea[name=maximum]").focus(function() {
                $("textarea[name=maximum]").next().css("display", "none");
            });
            $("#chooseFile").click(function() {
                $("input[name=imageUpload]").next().css("display", "none");
            });
            $("textarea[name=transitionlink]").focus(function() {
                $("textarea[name=transitionlink]").next().css("display", "none");
            });
            $("textarea[name=servicelink]").focus(function() {
                $("textarea[name=servicelink]").next().css("display", "none");
            });
            $("#benefit-confirm").click(function() {
                var status = true;
                if($("input[name=email]").val() == '') {
                    $("input[name=email]").next().text("このフィールドは必須です");
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
                if($("input[name=company]").val() == '') {
                    $("input[name=company]").next().text("このフィールドは必須です");
                    $("input[name=company]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=item]").val() == '') {
                    $("textarea[name=item]").next().text("このフィールドは必須です");
                    $("textarea[name=item]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=benefits]").val() == '') {
                    $("textarea[name=benefits]").next().text("このフィールドは必須です");
                    $("textarea[name=benefits]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=condition]").val() == '') {
                    $("textarea[name=condition]").next().text("このフィールドは必須です");
                    $("textarea[name=condition]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=method]").val() == '') {
                    $("textarea[name=method]").next().text("このフィールドは必須です");
                    $("textarea[name=method]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=maximum]").val() == '') {
                    $("textarea[name=maximum]").next().text("このフィールドは必須です");
                    $("textarea[name=maximum]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=transitionlink]").val() == '') {
                    $("textarea[name=transitionlink]").next().text("このフィールドは必須です");
                    $("textarea[name=transitionlink]").next().css("display", "block");
                    status = false;
                }
                if($("textarea[name=servicelink]").val() == '') {
                    $("textarea[name=servicelink]").next().text("このフィールドは必須です");
                    $("textarea[name=servicelink]").next().css("display", "block");
                    status = false;
                }
                if($("input[name=imageUpload]").val() == '') {
                    $("input[name=imageUpload]").next().text("このフィールドは必須です");
                    $("input[name=imageUpload]").next().css("display", "block");
                    status = false;
                }
                if(status) {
                    $("#benefit-back").css("display", "flex");
                    $("#benefit-thanks").css("display", "flex");
                    $(".admin-benefit-confirm-text").css("display", "block");
                    $("#benefit-confirm").css("display", "none");
                    $("#benefit-quiz").css("display", "none");
                    $(".admin-register-input-title").removeClass("active");
                    $(".admin-register-confirm-title").addClass("active");
                    $(".admin-register-thanks-title").removeClass("active");
                    $(".form-item").attr("readonly", true);
                }
            });
            $("#benefit-back").click(function() {
                $("#benefit-back").css("display", "none");
                $("#benefit-thanks").css("display", "none");
                $(".admin-benefit-confirm-text").css("display", "none");
                $("#benefit-confirm").css("display", "flex");
                $("#benefit-quiz").css("display", "flex");
                $(".admin-register-input-title").addClass("active");
                $(".admin-register-confirm-title").removeClass("active");
                $(".admin-register-thanks-title").removeClass("active");
                $(".form-item").attr("readonly", false);
            });
            $('#benefit-thanks').click(function(e){
                e.preventDefault();
                var company = $('input[name=company]').val();
                var email = $('input[name=email]').val();
                var item = $('textarea[name=item]').val();
                var benefit = $('textarea[name=benefit]').val();
                var condition = $('textarea[name=condition]').val();
                var method = $('textarea[name=method]').val();
                var maximum = $('textarea[name=maximum]').val();
                var imageUpload = $('input[name=imageUpload]').val();
                var transitionlink = $('textarea[name=transitionlink]').val();
                var servicelink = $('textarea[name=servicelink]').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('userRegisterPost') }}",
                    method: 'post',
                    dataType : 'json',
                    data: {company:company, email:email, item:item, benefit:benefit, condition:condition, method:method, maximum:maximum, imageUpload:imageUpload, transitionlink:transitionlink, servicelink:servicelink},
                    success: function(response){
                        $(".admin-register-input-title").removeClass("active");
                        $(".admin-register-confirm-title").removeClass("active");
                        $(".admin-register-thanks-title").addClass("active");
                        $("#benefit-form").css("display", "none");
                        $(".admin-benefit-confirm-text").css("display", "none");
                        $(".admin-benefit-success-text").css("display", "block");
                        $("#to-desired").css("display", "flex");
                    },
                    error: function (error) {
                        console.log(error);
                    },
                });
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
                            window.location.href = 'http://localhost:8000/desire_date';
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