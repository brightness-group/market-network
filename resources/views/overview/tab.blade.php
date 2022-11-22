<div class="container">
    <div class="tab-wrp">
        <ul id="tabs" class="nav nav-tabs border-bottom-0" role="tablist">

            <li class="nav-item">
                <a
                  id="tab-messages"
                  href="#"
                  class="nav-link"
                  data-toggle="tab"
                  role="tab"
                  >Messages</a
                >
              </li>
              <li class="nav-item">
                <a
                  id="tab-calender"
                  href="{{ route('calendar') }}"
                  class="nav-link @if(Route::currentRouteName() == 'calendar') active @endif"
                  role="tab"
                  >Calender</a
                >
              </li>
              <li class="nav-item">
                <a
                  id="tab-purchases"
                  href="{{ route('purchases') }}"
                  class="nav-link @if(Route::currentRouteName() == 'purchases') active @endif"
                  role="tab"
                  >Purchases</a
                >
              </li>
              <li class="nav-item">
                <a
                  id="tab-sales"
                  href="{{ route('sales') }}"
                  class="nav-link @if(Route::currentRouteName() == 'sales') active @endif"
                  role="tab"
                  >Sales</a
                >
              </li>

        </ul>
    </div>
</div>
