<div id="steps">
    <div class="step_body  shadow-lg ">
        @if($step == 1)
            <!-- signup -->
            @include('livewire.register.steps.step1')
        @endif

        @if($step == 2)
            <!-- category selection -->
            @include('livewire.register.steps.step2')
        @endif

        @if($step == 3)
            <!-- bio -->
            @include('livewire.register.steps.step3')
        @endif

        @if($step == 4)
            <!-- details -->
            @include('livewire.register.steps.step4')
        @endif

    </div>
</div>