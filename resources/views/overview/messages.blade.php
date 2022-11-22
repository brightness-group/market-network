@extends('layouts.master')

@section('content')
    <section class="all-utilitys-section">
        <div class="tab-accordion-style">

            @include('overview.tab')

            <div class="bg-dark tab-innr-wrp">
                <div class="container">
                    <div id="content" class="tab-content" role="tablist">
                    <div
                      id="pane-messages"
                      class="card tab-pane fade"
                      role="tabpanel"
                      aria-labelledby="tab-messages"
                    >
                      <div class="card-header mob-v" role="tab" id="heading-messages">
                        <h5 class="mb-0">
                          <a
                            data-toggle="collapse"
                            href="#collapse-messages"
                            aria-expanded="true"
                            aria-controls="collapse-messages"
                          >
                            Messages
                          </a>
                        </h5>
                      </div>
                    </div>
                </div>
            </div>            
        </div>

    </section>
@endsection

@section('script')

@endsection
