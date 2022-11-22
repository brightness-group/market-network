<template>
  <div class="bg-dark tab-innr-wrp">
    <div class="container">
      <div id="pane-sales" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-sales">
        <div class="card-header mob-v" role="tab" id="heading-sales">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapse-sales" aria-expanded="false" aria-controls="collapse-sales">
                Sales
        </a>
            </h5>
        </div>
        <div id="collapse-sales" class="collapse mob-v" role="tabpanel" data-parent="#content" aria-labelledby="heading-sales">
            <div class="card-body">
                <p class="text-white">Sales</p>

            </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import * as methods from "../Common/helper";

export default {
  components: {},

  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {},

  data() {
    return {
      asset: "",
      error: false,
    };
  },

  methods: {},
};
</script>
