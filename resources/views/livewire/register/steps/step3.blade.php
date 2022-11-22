<section class="login-signup-step categury-selection create-profile-box">
    <div class="container">
        <div class="row">

            <div class="card cstm-card ml-auto">
                <div class="card-header">
                    <h2 class="title-big">WELCOME TO SEEN.</h2>
                    <h3 class="title-sub-title">Almost there, just few more details</h3>

                </div>
                <div class="card-body">
                    <div class="form-layout">
                        <div class="inner-wrp">
                            <div class="row cstm-row">
                                <div class="col-md-5 cstm-col">
                                    <div class="form-group">
                                        <div class="upload-u-img">
                                        
                                            <div class="img-big-wrp">  
                                                <input wire:model="form.avatar" id="avatar" class="form-control-file" type="file" name="avatar"  accept="image/*">

                                                <img @if($form['avatar'] != '') src="{{ $form['avatar']->temporaryUrl() }}" @else src="assets/images/image-upload-size.png" @endif alt="User Image" class="imgprev" id="image"/>
                                                @error('form.avatar') <span class="error">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="prev-img-small">
                                                <img @if($form['avatar'] != '') src="{{ $form['avatar']->temporaryUrl() }}" @else src="assets/images/image-upload-size.png" @endif alt="User Image" class="imgprev img-sm" id="image"/>
                                                <small class="gray-text sm-text w-100 text-center">Adjust</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 pl-3 pl-md-0 cstm-col">
                                    <div class="form-group">
                                        <textarea wire:model="form.bio" name="bio" id="bio" placeholder="Bio" class="form-control cstm-text-area"></textarea>
                                        @error('form.bio') <span class="error-text">{{ $message }}</span> @enderror
                                        @if ($form['bio'])
                                            <small class="validation-info correct-icon "></small>
                                        @endif
                                        <small class="validation-info incorrect-icon d-none"></small>


                                    </div>
                                    <div class="form-group" id="for-bootstrap-select">
                                        <div wire:ignore>
                                        @if(!empty($cities))
                                            <select wire:model="form.city_id" class="form-control custom-select selectpicker" id="city_id" name="city_id" title="Location">
                                            <option class="location-icon" value="">Location</option>
                                            @foreach( $cities as $key => $city )                                        
                                                <option class="location-icon" value="{{ $city['id']}}">{{ $city['name'] }}, {{ $city['state']['name'] }}, {{ $city['state']['country']['name'] }}</option>
                                            @endforeach   
                                            </select>
                                        @endif
                                        </div>
                                        @error('form.city_id') <small class="error-text  text-danger">{{ $message }}</small> @enderror
                                       
                                        @if ($form['city_id'])
                                            <small class="validation-info correct-icon"></small>
                                        @endif
                                        <small class="validation-info incorrect-icon d-none"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 mb-0">
                            <button wire:click="next" class="btn btn-gray w-100">{{ __('Get Hired & Collaborate?') }}</button>
                        </div>
                        
                        @if ($form['city_id'] && $form['bio'])
                        <div class="form-group mt-2 mb-0 text-center">
                            <small  wire:click="next" class="gray-text w-100 m-0 sm-text" href="javascript:void(0);">I’ve Finished</small>
                        </div>
                        @else
                        <div class="form-group mt-2 mb-0 text-center">
                            <a wire:click="skip" class="link-btn gray-btn w-100">{{ __('I’ll do this later') }}</a>
                        </div>
                        @endif
                </div>
                </div>

            </div>

        </div>
    </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $(function() {
        $('select').selectpicker();
    });

    $('.selectpicker').selectpicker('refresh');
});    
</script>