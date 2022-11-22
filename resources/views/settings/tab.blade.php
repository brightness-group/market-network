<div class="container">
    <div class="tab-wrp">
        <ul id="tabs" class="nav nav-tabs border-bottom-0" role="tablist">

            <li class="nav-item">
                <a id="tab-submition" href="{{ route('profile.settings') }}" class="nav-link @if(Route::currentRouteName() == 'profile.settings') active @endif" role="tab">PROFILE</a>
            </li>

            <li class="nav-item">
                <a id="tab-package-setting" href="{{ route('package.settings') }}" class="nav-link @if(Route::currentRouteName() == 'package.settings') active @endif" role="tab">PACKAGES SETTINGS</a>
            </li>

            <li class="nav-item">
                <a id="tab-account-setting" href="{{ route('account.settings') }}" class="nav-link @if(Route::currentRouteName() == 'account.settings') active @endif" role="tab"> ACCOUNT SETTINGS</a>
            </li>

        </ul>
    </div>
</div>
