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
                            <form method="POST" action="{{ route('userRegisterPost') }}">
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
                                                <input type="radio" id="break-on" name="break" value="1" checked><label for="break-on">ON</label>
                                                <input type="radio" id="break-off" name="break" value="0"><label for="break-off">OFF</label>
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
                                                {{ $user_no }}
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>ID</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                            <input id="rand_id" type="text" name="user_id" value="GD<?php echo str_pad(rand(0, 89999), 5, '0', STR_PAD_LEFT); ?>" readonly="readonly" value="{{old('user_id')}}">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>PW</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="password" id="registerPassword" name="password" value="<?php echo substr(md5(mt_rand()), 0, 8); ?>" autocomplete="new-password" readonly="readonly" value="{{old('password')}}">
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
                                                <input type="text" name="company_name" placeholder="愛知旅行株式会社" value="{{old('company_name')}}"><br>
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
                                                <input type="text" name="furi_company_name" placeholder="アイチリョコウカブシキガイシャ" value="{{old('furi_company_name')}}"><br>
                                                <p>※ 全角カタカナ</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>部署名</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="department_name" placeholder="広報部" value="{{old('department_name')}}">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>役職</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="job_title" placeholder="係長" value="{{old('job_title')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="admin-register-wrap admin-main-register">
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>氏名<span>必須</span></div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="name" placeholder="愛知　太郎" value="{{old('name')}}"><br>
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
                                                <input type="text" name="furi_name" placeholder="アイチ　タロウ" value="{{old('furi_name')}}"><br>
                                                <p>※ 全角カタカナ</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>メールアドレス<span>必須</span></div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <div class="admin-register-item-right-email">
                                                    <input type="text" name="email" placeholder="xxx@xxx.xxx" value="{{old('email')}}">
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
                                                    <input type="text" name="email_confirm" placeholder="xxx@xxx.xxx" value="{{old('email_confirm')}}">
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
                                                <input type="tel" name="phone" placeholder="999-999-9999" value="{{old('phone')}}"><br>
                                                <p>※ 半角</p>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>郵便番号</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <div class="admin-register-item-right-postal">
                                                    <input type="number" name="zipcode" id="zipcode" placeholder="0000000" value="{{old('zipcode')}}"><input type="hidden" name="zipcopy" id="zipcopy" placeholder="0000000"><button type="button" id="search_address" class="admin-postal-search-btn btn-common">住所検索</button>
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
                                                    <option value="北海道" {{ old("address1") == '北海道' ? 'selected' : '' }}>北海道</option>
                                                    <option value="青森県" {{ old("address1") == '青森県' ? 'selected' : '' }}>青森県</option>
                                                    <option value="岩手県" {{ old("address1") == '岩手県' ? 'selected' : '' }}>岩手県</option>
                                                    <option value="宮城県" {{ old("address1") == '宮城県' ? 'selected' : '' }}>宮城県</option>
                                                    <option value="秋田県" {{ old("address1") == '秋田県' ? 'selected' : '' }}>秋田県</option>
                                                    <option value="山形県" {{ old("address1") == '山形県' ? 'selected' : '' }}>山形県</option>
                                                    <option value="福島県" {{ old("address1") == '福島県' ? 'selected' : '' }}>福島県</option>
                                                    <option value="茨城県" {{ old("address1") == '茨城県' ? 'selected' : '' }}>茨城県</option>
                                                    <option value="栃木県" {{ old("address1") == '栃木県' ? 'selected' : '' }}>栃木県</option>
                                                    <option value="群馬県" {{ old("address1") == '群馬県' ? 'selected' : '' }}>群馬県</option>
                                                    <option value="埼玉県" {{ old("address1") == '埼玉県' ? 'selected' : '' }}>埼玉県</option>
                                                    <option value="千葉県" {{ old("address1") == '千葉県' ? 'selected' : '' }}>千葉県</option>
                                                    <option value="東京都" {{ old("address1") == '東京都' ? 'selected' : '' }}>東京都</option>
                                                    <option value="神奈川県" {{ old("address1") == '神奈川県' ? 'selected' : '' }}>神奈川県</option>
                                                    <option value="新潟県" {{ old("address1") == '新潟県' ? 'selected' : '' }}>新潟県</option>
                                                    <option value="富山県" {{ old("address1") == '富山県' ? 'selected' : '' }}>富山県</option>
                                                    <option value="石川県" {{ old("address1") == '石川県' ? 'selected' : '' }}>石川県</option>
                                                    <option value="福井県" {{ old("address1") == '福井県' ? 'selected' : '' }}>福井県</option>
                                                    <option value="山梨県" {{ old("address1") == '山梨県' ? 'selected' : '' }}>山梨県</option>
                                                    <option value="長野県" {{ old("address1") == '長野県' ? 'selected' : '' }}>長野県</option>
                                                    <option value="岐阜県" {{ old("address1") == '岐阜県' ? 'selected' : '' }}>岐阜県</option>
                                                    <option value="静岡県" {{ old("address1") == '静岡県' ? 'selected' : '' }}>静岡県</option>
                                                    <option value="愛知県" {{ old("address1") == '愛知県' ? 'selected' : '' }}>愛知県</option>
                                                    <option value="三重県" {{ old("address1") == '三重県' ? 'selected' : '' }}>三重県</option>
                                                    <option value="滋賀県" {{ old("address1") == '滋賀県' ? 'selected' : '' }}>滋賀県</option>
                                                    <option value="京都府" {{ old("address1") == '京都府' ? 'selected' : '' }}>京都府</option>
                                                    <option value="大阪府" {{ old("address1") == '大阪府' ? 'selected' : '' }}>大阪府</option>
                                                    <option value="兵庫県" {{ old("address1") == '兵庫県' ? 'selected' : '' }}>兵庫県</option>
                                                    <option value="奈良県" {{ old("address1") == '奈良県' ? 'selected' : '' }}>奈良県</option>
                                                    <option value="和歌山県" {{ old("address1") == '和歌山県' ? 'selected' : '' }}>和歌山県</option>
                                                    <option value="鳥取県" {{ old("address1") == '鳥取県' ? 'selected' : '' }}>鳥取県</option>
                                                    <option value="島根県" {{ old("address1") == '島根県' ? 'selected' : '' }}>島根県</option>
                                                    <option value="岡山県" {{ old("address1") == '岡山県' ? 'selected' : '' }}>岡山県</option>
                                                    <option value="広島県" {{ old("address1") == '広島県' ? 'selected' : '' }}>広島県</option>
                                                    <option value="山口県" {{ old("address1") == '山口県' ? 'selected' : '' }}>山口県</option>
                                                    <option value="徳島県" {{ old("address1") == '徳島県' ? 'selected' : '' }}>徳島県</option>
                                                    <option value="香川県" {{ old("address1") == '香川県' ? 'selected' : '' }}>香川県</option>
                                                    <option value="愛媛県" {{ old("address1") == '愛媛県' ? 'selected' : '' }}>愛媛県</option>
                                                    <option value="高知県" {{ old("address1") == '高知県' ? 'selected' : '' }}>高知県</option>
                                                    <option value="福岡県" {{ old("address1") == '福岡県' ? 'selected' : '' }}>福岡県</option>
                                                    <option value="佐賀県" {{ old("address1") == '佐賀県' ? 'selected' : '' }}>佐賀県</option>
                                                    <option value="長崎県" {{ old("address1") == '長崎県' ? 'selected' : '' }}>長崎県</option>
                                                    <option value="熊本県" {{ old("address1") == '熊本県' ? 'selected' : '' }}>熊本県</option>
                                                    <option value="大分県" {{ old("address1") == '大分県' ? 'selected' : '' }}>大分県</option>
                                                    <option value="宮崎県" {{ old("address1") == '宮崎県' ? 'selected' : '' }}>宮崎県</option>
                                                    <option value="鹿児島県" {{ old("address1") == '鹿児島県' ? 'selected' : '' }}>鹿児島県</option>
                                                    <option value="沖縄県" {{ old("address1") == '沖縄県' ? 'selected' : '' }}>沖縄県</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所2<br>
                                                    市町村</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="address2" id="address2" placeholder="" value="{{old('address2')}}">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所3</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="address3" id="address3" placeholder="" value="{{old('address3')}}">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>住所4<br>
                                                    建物名や階数</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <input type="text" name="address4" id="address4" placeholder="" value="{{old('address4')}}">
                                            </div>
                                        </div>
                                        <div class="admin-register-item">
                                            <div class="admin-register-item-left">
                                                <div>業種</div>
                                            </div>
                                            <div class="admin-register-item-right">
                                                <select name="sectors" id="" class="admin-register-item-right-select">
                                                    <option value="">業種を選択</option>
                                                    <option value="自治体" {{ old("sectors") == '自治体' ? 'selected' : '' }}>自治体</option>
                                                    <option value="観光協会" {{ old("sectors") == '観光協会' ? 'selected' : '' }}>観光協会</option>
                                                    <option value="各種団体" {{ old("sectors") == '各種団体' ? 'selected' : '' }}>各種団体</option>
                                                    <option value="運輸業" {{ old("sectors") == '運輸業' ? 'selected' : '' }}>運輸業</option>
                                                    <option value="宿泊業" {{ old("sectors") == '宿泊業' ? 'selected' : '' }}>宿泊業</option>
                                                    <option value="旅行業" {{ old("sectors") == '旅行業' ? 'selected' : '' }}>旅行業</option>
                                                    <option value="観光施設" {{ old("sectors") == '観光施設' ? 'selected' : '' }}>観光施設</option>
                                                    <option value="飲食業" {{ old("sectors") == '飲食業' ? 'selected' : '' }}>飲食業</option>
                                                    <option value="土産品製造業" {{ old("sectors") == '土産品製造業' ? 'selected' : '' }}>土産品製造業</option>
                                                    <option value="土産品販売業" {{ old("sectors") == '土産品販売業' ? 'selected' : '' }}>土産品販売業</option>
                                                    <option value="広告業" {{ old("sectors") == '広告業' ? 'selected' : '' }}>広告業</option>
                                                    <option value="メディア・制作" {{ old("sectors") == 'メディア・制作' ? 'selected' : '' }}>メディア・制作</option>
                                                    <option value="その他" {{ old("sectors") == 'その他' ? 'selected' : '' }}>その他</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="admin-register-btn-group">
                                    <button type="submit" class="admin-register-btn btn-primary">新規登録</button>
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
        });

        $('#search_address').on("click", function() {
            $('#zipcopy').val($('#zipcode').val());
            $('#zipcopy').trigger("change");
        });
    </script>
@stop