<template>
  <div class="tab-innr-wrp bg-dark">
    <div class="container">
      <div id="content" class="tab-content" role="tablist">
        <div
          id="pane-package-setting"
          class="card tab-pane package-setting-tab active"
          role="tabpanel"
          aria-labelledby="tab-package-setting"
        >
          <div class="card-header mob-v" role="tab" id="heading-package-setting">
            <h5 class="mb-0">
              <a
                class="collapsed"
                data-toggle="collapse"
                href="#collapse-package-setting"
                aria-expanded="false"
                aria-controls="collapse-package-setting"
              >
                package-setting
              </a>
            </h5>
          </div>
          <div
            id="collapse-package-setting"
            class="collapse mob-v"
            data-parent="#content"
            role="tabpanel"
            aria-labelledby="heading-package-setting"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="card menu-card-box">
                    <div
                      class="nav flex-column nav-pills"
                      id="v-pills-tab"
                      role="tablist"
                      aria-orientation="vertical"
                    >
                      <a
                        class="nav-link active bronze-txt"
                        id="v-pills-bronze-pkg-tab"
                        data-toggle="pill"
                        href="#v-pills-bronze-pkg"
                        role="tab"
                        aria-controls="v-pills-bronze-pkg"
                        aria-selected="true"
                        >BRONZE PACKAGE</a
                      >
                      <a
                        class="nav-link silver-txt"
                        id="v-pills-silver-pkg-tab"
                        data-toggle="pill"
                        href="#v-pills-silver-pkg"
                        role="tab"
                        aria-controls="v-pills-silver-pkg"
                        aria-selected="false"
                        >SILVER PACKAGE</a
                      >
                      <a
                        class="nav-link gold-txt"
                        id="v-pills-gold-pkg-tab"
                        data-toggle="pill"
                        href="#v-pills-gold-pkg"
                        role="tab"
                        aria-controls="v-pills-gold-pkg"
                        aria-selected="false"
                        >GOLD PACKAGE</a
                      >
                    </div>
                    <hr class="cstm-hr" />
                    <div
                      class="info-txt"
                      v-tooltip="{
                        global: true,
                        theme: {
                          placement: 'top',
                          width: 'fit-content',
                        },
                      }"
                    >
                      <p class="p-txt">
                        <span class="attention-icon"
                          ><img
                            :src="`${asset}/assets/images/icon_attention_qus.svg`"
                            alt=""
                        /></span>
                        What are
                        <a href="#" v-tooltip.bottom-start="tooltipContent">Packages?</a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="row">
                      <div
                        id="error_div"
                        class="col-md-12 error-text"
                        style="display: none; color: red; margin-bottom: 20px"
                      ></div>
                    </div>
                    <div
                      class="tab-pane fade show active"
                      id="v-pills-bronze-pkg"
                      role="tabpanel"
                      aria-labelledby="v-pills-bronze-pkg-tab"
                    >
                      <package-form
                        :form="form.bronze"
                        @saveform="saveform"
                        @savedraft="savedraft"
                        :loading="loading"
                        :loadingDraft="loadingDraft"
                        :saveDisabled="saveDisabled"
                      ></package-form>
                    </div>

                    <div
                      class="tab-pane fade"
                      id="v-pills-silver-pkg"
                      role="tabpanel"
                      aria-labelledby="v-pills-silver-pkg-tab"
                    >
                      <package-form
                        :form="form.silver"
                        @saveform="saveform"
                        @savedraft="savedraft"
                        :loading="loading"
                        :loadingDraft="loadingDraft"
                        :saveDisabled="saveDisabled"
                      ></package-form>
                    </div>

                    <div
                      class="tab-pane fade"
                      id="v-pills-gold-pkg"
                      role="tabpanel"
                      aria-labelledby="v-pills-gold-pkg-tab"
                    >
                      <package-form
                        :form="form.gold"
                        @saveform="saveform"
                        @savedraft="savedraft"
                        :loading="loading"
                        :loadingDraft="loadingDraft"
                        :saveDisabled="saveDisabled"
                      ></package-form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PackageForm from "./PackageForm.vue";
import * as methods from "../Common/helper";

export default {
  components: {
    PackageForm,
  },

  mounted() {
    console.log("Component mounted.");
  },

  beforeMount() {
    this.asset = methods.asset();
  },

  data() {
    return {
      asset: "",
      loading: false,
      loadingDraft: false,
      saveDisabled: false,
      tooltipContent: "Packages Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
      form: {
        bronze: {
          type: "bronze",
          price: 0,
          offer: null,
          per_price: null,
          description: "",
          includes: "",
        },
        silver: {
          type: "silver",
          price: 0,
          offer: null,
          per_price: null,
          description: "",
          includes: "",
        },
        gold: {
          type: "gold",
          price: 0,
          offer: null,
          per_price: null,
          description: "",
          includes: "",
        },
        draft: false,
      },
    };
  },

  methods: {
    saveform: function () {
      this.form.draft = false;
      console.log(this.form);
      this.addPackage();
    },

    savedraft: function () {
      this.form.draft = true;
      this.addPackage();
    },

    getPackages() {
      // get all package and set data to form
      axios.get("/api/settings/packages").then(
        function (response) {
          var packages = response.data.data;
          if (packages) {
            if (packages.bronze) {
              this.form.bronze.price = packages.bronze.price;
              this.form.bronze.description = packages.bronze.description;
              this.form.bronze.includes = packages.bronze.includes;
              this.form.bronze.offer = packages.bronze.offer;
              this.form.bronze.per_price = packages.bronze.per_price;
            }

            if (packages.gold) {
              this.form.gold.price = packages.gold.price;
              this.form.gold.description = packages.gold.description;
              this.form.gold.includes = packages.gold.includes;
              this.form.gold.offer = packages.gold.offer;
              this.form.gold.per_price = packages.gold.per_price;
            }

            if (packages.silver) {
              this.form.silver.price = packages.silver.price;
              this.form.silver.description = packages.silver.description;
              this.form.silver.includes = packages.silver.includes;
              this.form.silver.offer = packages.silver.offer;
              this.form.silver.per_price = packages.silver.per_price;
            }
          }
        }.bind(this)
      );
    },

    addPackage() {
      this.loading = this.form.draft == false ? true : false;
      this.loadingDraft = this.form.draft == false ? false : true;
      this.saveDisabled = true;
      axios
        .post("/api/settings/package", this.form)
        .then((response) => {
          this.loading = false;
          this.loadingDraft = false;
          this.saveDisabled = false;
          $("#error_div").hide();
          console.log(response.data);          
          if (response.data.status == 200 || response.data.status == 201) {
            window.location.href = this.asset + "/profile#pane-packages";
          }
        })
        .catch((err) => {
          $("#error_div").show();
          // display error with key and value
          if (err.response) {
            var errors = err.response.data.data.errors;
            var errorObj = [];

            for (const [key, value] of Object.entries(errors)) {
              // add error in object with `${key}: ${value}` format
              errorObj.push(`${value}`);
              errorObj.push("<br />");
            }
            $("#error_div").html(errorObj);
          } else if (err.request) {
            console.log(err.request);
          } else {
            console.log(err.response);
          }
          this.loading = false;
          this.loadingDraft = false;
          this.saveDisabled = false;
        })
        .finally(() => (this.loading = false));
    },
  },

  created: function () {
    this.getPackages();
  },
};
</script>
