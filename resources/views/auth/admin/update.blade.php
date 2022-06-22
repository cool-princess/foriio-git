@extends('layouts.custom')

@section('content')
    <section id="member_register" class="top">
        <div class="container">
            <div class="header">
                @include('includes.header')
            </div>
            <div class="wrap">
                <div class="wrapper active">
                    <div class="navbar-main">
                        @include('includes.navbar')
                    </div>
                    <div class="mainbar">
                        <div class="main-body">
                            <div class="main-title">会員 個別登録</div>
                            <form method="POST" action="{{ route('userUpdatePost', ['user_id' => $data[0]->user_id]) }}">
                                @csrf
                                <div class="admin-register-part">
                                    <div class="admin-register-wrap">
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>
                                                    休止<span>必須</span>
                                                </div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                @if($data[0]->break == 1)
                                                    <input type="radio" id="break-on" name="break" value="1" checked><label for="break-on">ON</label>
                                                    <input type="radio" id="break-off" name="break" value="0"><label for="break-off">OFF</label>
                                                @else
                                                    <input type="radio" id="break-on" name="break" value="1"><label for="break-on">ON</label>
                                                    <input type="radio" id="break-off" name="break" value="0" checked><label for="break-off">OFF</label>
                                                @endif
                                                <p>※休止の場合はOFFを選択</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-register-wrap">
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>
                                                    No
                                                </div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input id="user_no" type="text" name="user_no" value="{{ $data[0]->id }}" readonly="readonly" required>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>ID</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input id="rand_id" type="text" name="user_id" value="{{ $data[0]->user_id }}" readonly="readonly" required>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>PW</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input id="registerPassword" type="password" name="password" value="{{ $data[0]->pwd_store }}" id="password">
                                                <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-register-wrap">
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>会員企業/団体名</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="company_name" value="{{ $data[0]->company_name }}" placeholder="愛知旅行株式会社" id="company_name"><br>
                                                <p>※ 一部旧字体はご利用いただけない場合がございます。<br>
                                                    該当の文字を別の文字に置き換えてご入力ください。 例）﨑→崎、髙→高、栁→柳、など</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>会員企業/団体名<br>
                                                    フリガナ</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="furi_company_name" value="{{ $data[0]->furi_company_name }}" placeholder="アイチリョコウカブシキガイシャ" id="furi_company_name"><br>
                                                <p>※ 全角カタカナ</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>部署名</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="department_name" value="{{ $data[0]->department_name }}" placeholder="広報部" id="department_name">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>役職</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="job_title" value="{{ $data[0]->job_title }}" placeholder="係長" id="job_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-register-wrap admin-main-register">
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>氏名<span>必須</span></div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="name" placeholder="愛知　太郎" value="{{ $data[0]->name }}" required id="name"><br>
                                                <p>※ 一部旧字体はご利用いただけない場合がございます。 <br>
                                                該当の文字を別の文字に置き換えてご入力ください。 例）﨑→崎、髙→高、栁→柳、など</p>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>氏名フリガナ</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="furi_name" value="{{ $data[0]->furi_name }}" placeholder="アイチ　タロウ" id="furi_name"><br>
                                                <p>※ 全角カタカナ</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>メールアドレス<span>必須</span></div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <div class="admin-register-item-right-email">
                                                    <input type="text" name="email" value="{{ $data[0]->email }}" placeholder="xxx@xxx.xxx" required id="email">
                                                </div>
                                                <p>※ 半角英数</p>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>メールアドレス<br>再入力</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <div class="admin-register-item-right-email">
                                                    <input type="text" name="email_confirm" value="{{ $data[0]->email }}" placeholder="xxx@xxx.xxx" required id="email_confirm">
                                                </div>
                                                @if ($errors->has('email_confirm'))
                                                    <span class="invalid-feedback">{{ $errors->first('email_confirm') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>電話番号</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="tel" name="phone" value="{{ $data[0]->phone }}" placeholder="999-999-9999" id="phone"><br>
                                                <p>※ 半角</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>郵便番号</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <div class="admin-register-item-right-postal">
                                                    <input type="number" name="zipcode" id="zipcode" value="{{ $data[0]->zipcode }}" placeholder="0000000"><input type="hidden" name="zipcopy" id="zipcopy" placeholder="0000000"><button type="button" id="search_address" class="admin-postal-search-btn btn-common">住所検索</button>
                                                </div>
                                                <p>※ 半角数字</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所1</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <select name="address1" id="address1">
                                                    <option value="">県を選択</option>
                                                    <option value="北海道">北海道</option>
                                                    <option value="青森県">青森県</option>
                                                    <option value="岩手県">岩手県</option>
                                                    <option value="宮城県">宮城県</option>
                                                    <option value="秋田県">秋田県</option>
                                                    <option value="山形県">山形県</option>
                                                    <option value="福島県">福島県</option>
                                                    <option value="茨城県">茨城県</option>
                                                    <option value="栃木県">栃木県</option>
                                                    <option value="群馬県">群馬県</option>
                                                    <option value="埼玉県">埼玉県</option>
                                                    <option value="千葉県">千葉県</option>
                                                    <option value="東京都">東京都</option>
                                                    <option value="神奈川県">神奈川県</option>
                                                    <option value="新潟県">新潟県</option>
                                                    <option value="富山県">富山県</option>
                                                    <option value="石川県">石川県</option>
                                                    <option value="福井県">福井県</option>
                                                    <option value="山梨県">山梨県</option>
                                                    <option value="長野県">長野県</option>
                                                    <option value="岐阜県">岐阜県</option>
                                                    <option value="静岡県">静岡県</option>
                                                    <option value="愛知県">愛知県</option>
                                                    <option value="三重県">三重県</option>
                                                    <option value="滋賀県">滋賀県</option>
                                                    <option value="京都府">京都府</option>
                                                    <option value="大阪府">大阪府</option>
                                                    <option value="兵庫県">兵庫県</option>
                                                    <option value="奈良県">奈良県</option>
                                                    <option value="和歌山県">和歌山県</option>
                                                    <option value="鳥取県">鳥取県</option>
                                                    <option value="島根県">島根県</option>
                                                    <option value="岡山県">岡山県</option>
                                                    <option value="広島県">広島県</option>
                                                    <option value="山口県">山口県</option>
                                                    <option value="徳島県">徳島県</option>
                                                    <option value="香川県">香川県</option>
                                                    <option value="愛媛県">愛媛県</option>
                                                    <option value="高知県">高知県</option>
                                                    <option value="福岡県">福岡県</option>
                                                    <option value="佐賀県">佐賀県</option>
                                                    <option value="長崎県">長崎県</option>
                                                    <option value="熊本県">熊本県</option>
                                                    <option value="大分県">大分県</option>
                                                    <option value="宮崎県">宮崎県</option>
                                                    <option value="鹿児島県">鹿児島県</option>
                                                    <option value="沖縄県">沖縄県</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所2<br>
                                                    市町村</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="address2" id="address2" value="{{ $data[0]->address2 }}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所3</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="address3" id="address3" value="{{ $data[0]->address3 }}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所4<br>
                                                    建物名や階数</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="address4" id="address4" value="{{ $data[0]->address4 }}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>業種</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <select name="sectors" id="sectors" class="admin-register-item-right-select">
                                                    <option value="">業種を選択</option>
                                                    <option value="自治体">自治体</option>
                                                    <option value="観光協会">観光協会</option>
                                                    <option value="各種団体">各種団体</option>
                                                    <option value="運輸業">運輸業</option>
                                                    <option value="宿泊業">宿泊業</option>
                                                    <option value="旅行業">旅行業</option>
                                                    <option value="観光施設">観光施設</option>
                                                    <option value="飲食業">飲食業</option>
                                                    <option value="土産品製造業">土産品製造業</option>
                                                    <option value="土産品販売業">土産品販売業</option>
                                                    <option value="広告業">広告業</option>
                                                    <option value="メディア・制作">メディア・制作</option>
                                                    <option value="その他">その他</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="admin-register-btn-group">
                                    <button type="submit" class="admin-register-btn btn-primary">修正</button>
                                    <a href="{{ route('userDelete', ['user_id' => $data[0]->user_id]) }}" class="admin-delete-btn btn-danger">登録を削除</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                @include('includes.footer')
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            document.getElementById("address1").value = "{{ $data[0]->address1 }}";
            document.getElementById("sectors").value = "{{ $data[0]->sectors }}";
            $('#userManage').addClass('active');
            $('#adminHome').removeClass('active');
            $('#adminManage').removeClass('active');
            $('#visitorData').removeClass('active');
            $('#statisticsFile').removeClass('active');
            $('#mailSend').removeClass('active');
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#registerPassword');
            if(togglePassword) {
                togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye-slash');
                });
            }
            $('#postcode').jpostal({
                postcode : [
                '#zipcopy',
                ],
                address : {
                '#address1' : '%3',
                '#address2' : '%4%5',
                '#address3' : '%6',
                }
            });

            if(window.localStorage.getItem('password'))
                $('#password').val(window.localStorage.getItem('password'));
            if(window.localStorage.getItem('company_name'))
                $('#company_name').val(window.localStorage.getItem('company_name'));
            if(window.localStorage.getItem('furi_company_name'))
                $('#furi_company_name').val(window.localStorage.getItem('furi_company_name'));
            if(window.localStorage.getItem('department_name'))
                $('#department_name').val(window.localStorage.getItem('department_name'));
            if(window.localStorage.getItem('job_title'))
                $('#job_title').val(window.localStorage.getItem('job_title'));
            if(window.localStorage.getItem('name'))
                $('#name').val(window.localStorage.getItem('name'));
            if(window.localStorage.getItem('furi_name'))
                $('#furi_name').val(window.localStorage.getItem('furi_name'));
            if(window.localStorage.getItem('email'))
                $('#email').val(window.localStorage.getItem('email'));
            if(window.localStorage.getItem('email_confirm'))
                $('#email_confirm').val(window.localStorage.getItem('email_confirm'));
            if(window.localStorage.getItem('phone'))
                $('#phone').val(window.localStorage.getItem('phone'));
            if(window.localStorage.getItem('zipcode'))
                $('#zipcode').val(window.localStorage.getItem('zipcode'));
            if(window.localStorage.getItem('address1'))
                $('#address1').val(window.localStorage.getItem('address1'));
            if(window.localStorage.getItem('address2'))
                $('#address2').val(window.localStorage.getItem('address2'));
            if(window.localStorage.getItem('address3'))
                $('#address3').val(window.localStorage.getItem('address3'));
            if(window.localStorage.getItem('address4'))
                $('#address4').val(window.localStorage.getItem('address4'));
            if(window.localStorage.getItem('sectors'))
                $('#sectors').val(window.localStorage.getItem('sectors'));
        });

        $('#search_address').on("click", function() {
            $('#zipcopy').val($('#zipcode').val());
            $('#zipcopy').trigger("change");
        });

        $("#password").change(function() {
            window.localStorage.setItem('password', $("#password").val());
        });
        $("#company_name").change(function() {
            window.localStorage.setItem('company_name', $("#company_name").val());
        });
        $("#furi_company_name").change(function() {
            window.localStorage.setItem('furi_company_name', $("#furi_company_name").val());
        });
        $("#department_name").change(function() {
            window.localStorage.setItem('department_name', $("#department_name").val());
        });
        $("#job_title").change(function() {
            window.localStorage.setItem('job_title', $("#job_title").val());
        });
        $("#name").change(function() {
            window.localStorage.setItem('name', $("#name").val());
        });
        $("#furi_name").change(function() {
            window.localStorage.setItem('furi_name', $("#furi_name").val());
        });
        $("#email").change(function() {
            window.localStorage.setItem('email', $("#email").val());
        });
        $("#email_confirm").change(function() {
            window.localStorage.setItem('email_confirm', $("#email_confirm").val());
        });
        $("#phone").change(function() {
            window.localStorage.setItem('phone', $("#phone").val());
        });
        $("#zipcode").change(function() {
            window.localStorage.setItem('zipcode', $("#zipcode").val());
        });
        $("#address1").change(function() {
            window.localStorage.setItem('address1', $("#address1").val());
        });
        $("#address2").change(function() {
            window.localStorage.setItem('address2', $("#address2").val());
        });
        $("#address3").change(function() {
            window.localStorage.setItem('address3', $("#address3").val());
        });
        $("#address4").change(function() {
            window.localStorage.setItem('address4', $("#address4").val());
        });
        $("#sectors").change(function() {
            window.localStorage.setItem('sectors', $("#sectors").val());
        });
    </script>
@stop