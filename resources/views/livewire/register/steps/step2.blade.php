<section class="login-signup-step categury-selection">
    <div class="container">
        <div class="row">

            <div class="card cstm-card ml-auto">
                <div class="card-header">
                    <h2 class="title-big">WELCOME TO SEEN.</h2>
                    <h3 class="title-sub-title">We’ll find the best snapshots that match your tastes</h3>

                </div>
                <div class="card-body">
                    <div class="form-layout">
                        
                        @if($categories->count() != 0)
                        <ul class="categury-selection-list list-unstyled">
                            @foreach( $categories as $key => $category )
                            @php
                                $activeClass = '';
                                if(in_array(($category->id), array_keys($form['category_id'])) && $form['category_id'][$category->id] == true)
                                    $activeClass = 'active';
                                else
                                    $activeClass = '';
                            @endphp
                            <li class="card-box {{ $activeClass }}" id="item-{{ $category->id }}" >
                                <a class="card-img" href="javascript:void(0);">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                    wire:model="form.category_id.{{ $category->id }}" id="category-{{ $category->id }}" name="form.category_id">
                                    </div>
                                    <img class="" src="{{ $category->banner }}" alt="{{ $category->name }}">
                                    <div class="card-caption">
                                        <p class="card-text">#{{ $category->name }}</p>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                                        
                        @error('form.category_id') <span class="error-text text-danger">{{ $message }}</span> @enderror 
                        <div class="form-group mt-3 mb-0">
                        {{ $categorySelected }}
                            <button wire:click="next" @if(empty($form['category_id'])) disabled @endif  class="btn btn-gray w-100">{{ __('Create Profile') }}</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<script>
</script>