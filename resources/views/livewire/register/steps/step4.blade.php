<section class="login-signup-step categury-selection create-profile-box decide-path-box">
    <div class="container">
        <div class="row">

            <div class="card cstm-card ml-auto">
                <div class="card-header">
                    <h2 class="title-big">WELCOME TO SEEN.</h2>
                    <h3 class="title-sub-title">Decide your path</h3>
                </div>
                <div class="card-body">
                    <div class="form-layout">
                        <div class="inner-wrp">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="heding-text">Get Hired</h4>
                                    <p class="p-text">Enable brands, publications, and people that want to pay you for your work to email you.</p>

                                    @php
                                        $activeClass = '';
                                        if($form['hire'] == 1)
                                            $activeClass = 'active-yes';
                                        else
                                            $activeClass = '';
                                    @endphp
                                    <div class="custom-control custom-checkbox check-card-box {{ $activeClass }}" id="item-1">
                                        <input wire:model="form.hire" id="form-hire" name="form.hire"  class="custm-input" type="checkbox" value="1">
                                        <p class="text-b text-no">NO <span class="icon-yes-no"><img src="{{ asset('assets/images/icon_close.svg') }}" alt=""></span></p>
                                        <p class="text-b text-yes" style="display: none;">yes <span class="icon-yes-no"><img src="{{ asset('assets/images/icon_form_check.svg') }}" alt=""></span></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="heding-text">Collaborate</h4>
                                    <p class="p-text">Enable fellow creators that want to collaborate to email you.</p>
                                    @php
                                        $activeClass = '';
                                        if($form['collaborate'] == 1)
                                            $activeClass = 'active-yes';
                                        else
                                            $activeClass = '';
                                    @endphp
                                    <div class="custom-control custom-checkbox check-card-box {{ $activeClass }}" id="item-2">
                                        <input wire:model="form.collaborate" id="form-collaborate" name="form.collaborate"  class="custm-input" type="checkbox" value="1">
                                        <p class="text-b text-no">NO <span class="icon-yes-no"><img src="{{ asset('assets/images/icon_close.svg') }}" alt=""></span></p>
                                        <p class="text-b text-yes" style="display: none;">yes <span class="icon-yes-no"><img src="{{ asset('assets/images/icon_form_check.svg') }}" alt=""></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 mb-0">
                            <button wire:click="submit" @if (!($form['collaborate'] || $form['hire'])) disabled @endif class="btn btn-dark w-100">{{ __('Create Feed') }}</button>
                        </div>
                </div>
                </div>

            </div>

        </div>
    </div>
    </div>
</section>

<script>
</script>
