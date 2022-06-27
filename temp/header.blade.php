<div class="navbar">
    <h1>
        <a href=""><img src="{{ asset('img/logo.svg') }}" alt=""></a>
    </h1>
</div>
<div class="menubar">
    <div class="menubar-group">
        <a href="" class="menubar-name">
            会社概要
        </a>
        <a href="" class="menubar-name">
            お問い合わせ
        </a>
        <a href="" class="menubar-name">
            アクセス
        </a>
        <a href="" class="menubar-name">
            個人情報保護方針
        </a>
    </div>
    <div class="menu-btn" onclick="menuClick(this)">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<div class="menu" onclick="menuClose()">
    <div><a href="#" class="menubar-name">会社概要</a></div>
    <div><a href="#" class="menubar-name">お問い合わせ</a></div>
    <div><a href="#" class="menubar-name">アクセス</a></div>
    <div><a href="#" class="menubar-name">個人情報保護方針</a></div>
</div>
