@extends('layouts.custom')

@section('content')
    <section id="admin_contract" class="top">
        <div class="header">
            @include('includes.header')
        </div>
        <div class="container">
            <div class="main-title admin-contract-thanks-title"><img src="{{ asset('img/register-complete.png') }}" alt=""><span>締結完了</span></div>
            <div class="workflow">
                <div class="workflow-state workflow-register active-pass pc">
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
                        <div class="workflow-circle active-past"><span>入力</span></div>
                        <div class="workflow-border border01 active-past"></div>
                        <div class="workflow-circle active-current"><span>完了</span></div>
                    </div>
                </div>
                <div class="workflow-state workflow-benefits pc">
                    <div class="workflow-title">
                        03.特典内容
                    </div>
                    <div class="workflow-chart">
                        <div class="workflow-circle"><span>入力</span></div>
                        <div class="workflow-border"></div>
                        <div class="workflow-circle"><span>完了</span></div>
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
            <div class="contract-part">
                <div class="contract-content">
                    業務提携契約を締結いたしました。<br>
                    ご確認いただきありがとうございます。
                </div>
            </div>
            <div class="contract-next-text">
                下のボタンよりBenefitsの特典内容をご入力ください。
            </div>
            <div class="admin-register-btn-group">
                <a href="{{ route('userBenefit') }}" class="admin-register-next primary-btn">Benefitsの特典内容の準備に進む</a>
            </div>
        </div>
        <div class="footer">
            @include('includes.footer')
        </div>
    </section>
@stop