<template>
  <section class="explore-page-section">
    <div class="container">
      <ul id="tabs" class="nav nav-tabs" role="tablist">
        <li class="nav-item" v-for="(cat, index) in categoriesData" :key="index">
          <a
            :id="`tab-${cat.slug}`"
            :href="`#pane-${cat.slug}`"
            :class="{
              'nav-link': true,
              'active': index == 0 ? true : false
            }"
            data-toggle="tab"
            role="tab"
            >{{ cat.display_name_upper_case }}</a
          >
        </li>
      </ul>
    </div>
    <div class="categorie-box-section bg-dark">
      <div class="tab-innr-wrp">
        <div class="container">
          <div id="content" class="tab-content" role="tablist">
            <div v-for="(cat, index) in categoriesData" :key="index"
              :id="`pane-${cat.slug}`"
              :class="{
                'card': true,
                'tab-pane': true,
                'fade': true,
                'show': index == 0 ? true : false,
                'active': index == 0 ? true : false
              }" 
              role="tabpanel"
              :aria-labelledby="`tab-${cat.slug}`"
            >
              <div class="card-header mob-v" role="tab" :id="`heading-${cat.slug}`">
                <h5 class="mb-0">
                  <a
                    data-toggle="collapse"
                    :href="`#collapse-${cat.slug}`"
                    aria-expanded="true"
                    :aria-controls="`collapse-${cat.slug}`"
                  >
                    {{ cat.display_name }}
                  </a>
                </h5>
              </div>
              <div
                :id="`collapse-${cat.slug}`"
                class="collapse show"
                data-parent="#content"
                role="tabpanel"
                :aria-labelledby="`heading-${cat.slug}`"
              >
                <div class="card-body">
                  <div class="row">
                    <div
                      v-for="(category, index) in cat.child"
                      :key="index"
                      class="col-md-4"
                    >
                      <a
                        class="img-card-box"
                        :href="`${asset}/search?category_id=${category.id}`"
                      >
                        <div class="img-group">
                          <div class="full-img">
                            <div
                              class="post-bg-img"
                              :style="`background-image: url(${encodeURI(
                                category.banner
                              )})`"
                            ></div>
                          </div>
                        </div>
                        <div class="img-caption">
                          {{ category.display_name }} <i class="icon-icon_nav_right"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="subscribe-section explore-subscribe">
    <newsletter-form
      :form="form.newsletter"
      @saveNewsletter="saveNewsletter"
      :loading="loading"
      :saveDisabled="saveDisabled"
    ></newsletter-form>
  </section>
</template>
<script>
import NewsletterForm from "../Common/NewsletterForm.vue";

import * as methods from "../Common/helper";

export default {
  components: {
    NewsletterForm,
  },

  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {
    console.log("Component mounted.");
    this.getCategories();
  },

  data() {
    return {
      asset: "",
      categoriesData: [],
      loading: false,
      saveDisabled: false,
      form: {
        newsletter: {
          email: null,
        },
      },
    };
  },

  methods: {
    getCategories() {
      axios.get("/api/categories").then(
        function (response) {
          this.categoriesData = response.data.data;
        }.bind(this)
      );
    },

    saveNewsletter() {
      this.loading = true;
      this.saveDisabled = true;
      $(".error-text").hide();
      var errorObj = [];
      var successObj = [];

      axios
        .post("/api/save_newsletter", this.form.newsletter)
        .then(function (response) {
          $(".error-text").html(errorObj);
          successObj.push(response.data.message);
          $("#success_div").html(successObj);
          this.loading = false;
          this.saveDisabled = false;
        })
        .catch((err) => {
          $(".error-text").show();
          $("#success_div").html(successObj);
          if (err.response) {
            var errors = err.response.data.data.errors;

            for (const [key, value] of Object.entries(errors)) {
              errorObj.push(`${value}`);
              errorObj.push("<br />");
            }
            $(".error-text").html(errorObj);
          } else if (err.request) {
            console.log(err.request);
          } else {
            console.log(err.response);
          }
          this.loading = false;
          this.saveDisabled = false;
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
