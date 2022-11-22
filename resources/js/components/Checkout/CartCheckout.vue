<template>
  <section class="checkout-page-section">
    <div class="container">
      <div class="row cstm-row">
        <div class="col-lg-7 pr-lg-1 pr-3">
          <div class="title-bar">
            <h2 class="heading">PAYMENT</h2>
          </div>
          <form action="#" class="form-layout-view-style payment-detail-form">
            <div class="payment-option-row">
              <div class="top-block">
                <div class="payment-type">
                  <a href="javascript:void(0);" class="btn btn-dark"
                    >Credit or Debit Card</a
                  >
                </div>
                <div class="payment-card-type-list">
                  <ul class="type-list">
                    <li>
                      <img :src="`${asset}/assets/images/icon-payment-visa.svg`" alt="" />
                    </li>

                    <li>
                      <img
                        :src="`${asset}/assets/images/icon-simple-mastercard.svg`"
                        alt=""
                      />
                    </li>
                    <li>
                      <img :src="`${asset}/assets/images/icon-metro-amex.svg`" alt="" />
                    </li>
                  </ul>
                </div>
              </div>

              <div class="payment-detail-form-row">
                <div
                  v-show="card_form_error"
                  id="card_form_error"
                  class="col-md-12 error-text"
                  style="display: none; color: red; margin-bottom: 20px"
                ></div>
                <div class="form-group">
                  <label for="name_on_card" class="small-label">NAME ON CARD </label>
                  <input
                    id="name_on_card"
                    class="form-control"
                    type="text"
                    name="name_on_card"
                    placeholder=""
                    v-model="form.card.name_on_card"
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"
                    ><i class="icon-icon_form_required"></i
                  ></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="form-group">
                  <label for="cardnumber" class="small-label">CARD NUMBER </label>
                  <input
                    id="card_number"
                    class="form-control"
                    type="text"
                    name="card_number"
                    placeholder=""
                    v-model="form.card.card_number"
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"
                    ><i class="icon-icon_form_required"></i
                  ></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="expiration_date" class="small-label"
                        >EXPIRATION DATE (MM/YY)
                      </label>
                      <input
                        id="expiration_date"
                        class="form-control datepicker-style month-year-datepicker"
                        type="text"
                        name="expiration_date"
                        placeholder=""
                      />
                      <small class="validation-info correct-icon d-none"></small>
                      <span class="mendetory-dot"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                      <small class="error-text d-none">validation Error text</small>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="security_code" class="small-label"
                        >SECRUITY CODE
                      </label>
                      <input
                        id="security_code"
                        class="form-control"
                        type="text"
                        name="security_code"
                        placeholder=""
                        v-model="form.card.security_code"
                      />
                      <small class="validation-info correct-icon d-none"></small>
                      <span class="mendetory-dot"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                      <small class="error-text d-none">validation Error text</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="payment-option-row">
              <div class="top-block">
                <div class="payment-type">
                  <a href="javascript:void(0);" class="btn light-btn-gray"
                    ><span class="payment-icon pay-apple-icon"></span
                  ></a>
                </div>
              </div>
            </div>
            <div class="payment-option-row">
              <div class="top-block">
                <div class="payment-type">
                  <a href="javascript:void(0);" class="btn light-btn-gray"
                    ><span class="payment-icon paypal-icon"></span
                  ></a>
                </div>
              </div>
            </div>
            <div class="payment-option-row">
              <div class="top-block">
                <div class="payment-type">
                  <a href="javascript:void(0);" class="btn light-btn-gray"
                    ><span class="payment-icon tabby-icon"></span
                  ></a>
                </div>
              </div>
            </div>
          </form>

          <div class="title-bar">
            <h2 class="heading">BILLING ADDRESS</h2>
          </div>
          <form action="#" class="form-layout-view-style billing-address-form">
            <div class="address-option-row">
              <div class="top-block">
                <div class="address-type">
                  <a
                    href="#collapsesameAddress"
                    role="button"
                    data-toggle="collapse"
                    class="btn btn-dark"
                    >Same as Contact Address</a
                  >
                </div>
              </div>
              <div class="address-detail-form-row collapse" id="collapsesameAddress">
                <div class="form-group">
                  <label for="address" class="small-label">ADDRESS</label>
                  <input
                    id="address"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder=""
                    v-model="form.contact.address"
                    disabled
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"
                    ><i class="icon-icon_form_required"></i
                  ></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="form-group">
                  <label for="address_number" class="small-label">ADDRESS NUMBER</label>
                  <input
                    id="address_number"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder=""
                    v-model="form.contact.address_number"
                    disabled
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"
                    ><i class="icon-icon_form_required"></i
                  ></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="country" class="small-label">COUNTRY / REGION </label>
                      <select
                        class="form-control custom-select selectpicker"
                        title="COUNTRY / REGION"
                        v-model="form.contact.country_id"
                        disabled
                      >
                        <option
                          v-for="(country, countryIndex) in countriesData"
                          :key="countryIndex"
                          :value="country.id"
                          :selected="country.id === form.contact.country_id"
                        >
                          {{ country.name }}
                        </option>
                      </select>
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="emirate" class="small-label">EMIRATE </label>
                      <select
                        class="form-control custom-select selectpicker"
                        title="EMIRATE"
                        v-model="form.contact.state_id" 
                        disabled
                      >
                        <option
                          v-for="(state, stateIndex) in statesData"
                          :key="stateIndex"
                          :value="state.id"
                          :selected="state.id === form.contact.state_id"
                        >
                          {{ state.name }}
                        </option>
                      </select>
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="address-option-row">
              <div class="top-block">
                <div class="address-type">
                  <a
                    href="#collapseDiffrentAddress"
                    role="button"
                    data-toggle="collapse"
                    class="btn light-btn-gray"
                    >Use a Different Address</a
                  >
                </div>
              </div>
              <div class="address-detail-form-row collapse" id="collapseDiffrentAddress">
                <div
                  v-show="billing_form_error"
                  id="billing_form_error"
                  class="col-md-12 error-text"
                  style="display: none; color: red; margin-bottom: 20px"
                ></div>
                <div class="form-group">
                  <label for="addresstext" class="small-label">ADDRESS</label>
                  <input
                    id="addresstext"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder=""
                    v-model="form.billing.address"
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"
                    ><i class="icon-icon_form_required"></i
                  ></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="form-group">
                  <label for="addressnumber" class="small-label">ADDRESS NUMBER</label>
                  <input
                    id="addressnumber"
                    class="form-control"
                    type="text"
                    name=""
                    v-model="form.billing.address_number"
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"
                    ><i class="icon-icon_form_required"></i
                  ></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="country" class="small-label">COUNTRY / REGION </label>
                      <select
                        class="form-control custom-select selectpicker"
                        title="COUNTRY / REGION"
                        v-model="form.billing.country_id"
                      >
                        <option
                          v-for="(country, countryIndex) in countriesData"
                          :key="countryIndex"
                          :value="country.id"
                          :selected="country.id === form.billing.country_id"
                        >
                          {{ country.name }}
                        </option>
                      </select>
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="emirate" class="small-label">EMIRATE </label>
                      <select
                        class="form-control custom-select selectpicker"
                        title="EMIRATE"
                        v-model="form.billing.state_id"
                      >
                        <option
                          v-for="(state, stateIndex) in statesData"
                          :key="stateIndex"
                          :value="state.id"
                          :selected="state.id === form.billing.state_id"
                        >
                          {{ state.name }}
                        </option>
                      </select>
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-5">
          <div class="product-summary">
            <div class="title-bar">
              <h2 class="heading">SUMMARY</h2>
            </div>
            <form action="#" class="form-layout-view-style">
              <div class="product-summary-wrap">
                <!-- Product Row 1 -->
                <div
                  v-for="(item, index) in cartItemsData"
                  :key="index"
                  class="product-summary-row"
                >
                  <div class="b-one">
                    <a href="index.html" class="product-img">
                      <div
                        :style="`background-image: url('${item.package.user.profile_photo_full_path}');`"
                        class="user-img"
                      ></div>
                    </a>
                  </div>
                  <div class="b-two">
                    <div class="form-group">
                      <p class="text-bold">
                        <template v-if="item.package.user">
                          {{ item.package.user.name }}
                        </template>
                      </p>
                    </div>
                  </div>
                  <div class="b-three">
                    <div class="form-group">
                      <div class="label-amount-group">
                        <p class="text-bold">
                          {{ item.quantity }} x {{ item.package.type }} Package
                        </p>
                        <p class="amount-text">
                          {{ currencySymbol }}{{ item.quantity * item.package.price }}
                        </p>
                      </div>
                    </div>
                    <div v-if="item.package.upsell" class="form-group">
                      <div class="label-amount-group">
                        <p class="text-bold">{{ item.package.upsell.title }}</p>
                        <p class="amount-text" v-if="item.package.upsell.price">
                          {{ currencySymbol }}{{ item.package.upsell.price }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="sub-total-group">
                  <div class="sub-total-row">
                    <h5 class="sub-total-text">Package Subtotal</h5>
                    <h5 class="sub-total-amount" v-if="cartData">
                      {{ currencySymbol }}{{ cartData.packages_total }}
                    </h5>
                    <h5 class="sub-total-amount" v-else>$0</h5>
                  </div>
                  <div class="sub-total-row">
                    <h5 class="sub-total-text">Extras Subtotal</h5>
                    <h5 class="sub-total-amount" v-if="cartData.extras_total">
                      {{ currencySymbol }}{{ cartData.extras_total }}
                    </h5>
                    <h5 class="sub-total-amount" v-else>$0</h5>
                  </div>
                  <div class="sub-total-row">
                    <h5 class="sub-total-text">
                      Promotions
                      <span v-if="cartData.coupon_code" class="promo-tag">
                        {{ cartData.coupon_code }}
                        <a
                          href="javascript:void(0);"
                          @click="deleteDiscount(cartData.coupon_code)"
                          class="close-icon"
                        ></a>
                      </span>
                    </h5>
                    <h5 class="sub-total-amount" v-if="cartData.promo_discount_amount">
                      {{ currencySymbol }}{{ cartData.promo_discount_amount }}
                    </h5>
                    <h5 class="sub-total-amount" v-else>-$0</h5>
                  </div>
                </div>
                <div class="grand-total-group">
                  <div class="grand-total-row">
                    <h5 class="grand-total-text">Total</h5>
                    <h5 class="grand-total-amount" v-if="cartData">
                      {{ currencySymbol }}{{ cartData.grand_total }}
                    </h5>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-7 pr-lg-1 pr-3">
          <div class="cart-btn-row">
            <a :href="`${asset}/checkout`" class="btn light-btn-gray">Back</a>
            <a
              href="javascript:void(0);"
              @click="saveCheckoutDetails()"
              class="btn btn-dark"
              >Pay Now</a
            >
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import * as methods from "../Common/helper";

export default {
  components: {},

  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {
    this.getCartDetails();
    this.getSiteSettings();
  },

  data() {
    return {
      asset: "",
      card_form_error: false,
      contact_form_error: false,
      billing_form_error: false,
      loading: false,
      saveDisabled: false,
      cartData: [],
      userData: [],
      cartItemsData: [],
      countriesData: [],
      statesData: [],
      currencySymbol: "",
      form: {
        contact: {
          address: "",
          address_number: "",
          country_id: "",
          state_id: "",
        },
        billing: {
          full_name: "",
          address: "",
          address_number: "",
          country_id: "",
          state_id: "",
        },
        card: {
          name_on_card: "",
          cart_number: "",
          expiration_date: "",
          security_code: "",
        },
      },
    };
  },

  methods: {
    getSiteSettings: function () {
      axios.get("/api/site-settings").then((response) => {
        this.currencySymbol = response.data.data[0].currency_symbol;
      });
    },
    getCartDetails: function () {
      axios.get("/api/get_cart").then(
        function (response) {
          var resData = response.data.data;
          this.cartData = resData;
          if (resData) {
            this.userData = resData.cart_owner;
            this.cartItemsData = resData.cart_items;
            this.countriesData = resData.countries;
            this.statesData = resData.states;
            this.form.billing.full_name = this.userData.name;
            console.log(resData.cart_owner.addresses);
            if (resData.cart_owner.addresses) {
              this.form.contact.address = resData.cart_owner.addresses.address;
              this.form.contact.address_number =
                resData.cart_owner.addresses.address_number;
              this.form.contact.country_id = resData.cart_owner.addresses.country_id;
              this.form.contact.state_id = resData.cart_owner.addresses.state_id;
            }
          }
          this.$nextTick(function () {
            $(".selectpicker").selectpicker("refresh");
          });
        }.bind(this)
      );
    },

    saveCheckoutDetails() {
      this.loading = true;
      this.saveDisabled = true;
      var expiration_date = $("#expiration_date").val();

      let formData = new FormData();
      formData.append("name_on_card", this.form.card.name_on_card);
      formData.append("card_number", this.form.card.card_number);
      formData.append("expiration_date", expiration_date);
      formData.append("security_code", this.form.card.security_code);

      axios
        .post("/api/save_card_details", formData)
        .then((response) => {
          this.loading = false;
          this.saveDisabled = false;
          this.card_form_error = false;
          console.log(response.data);
        })
        .catch((err) => {
          this.card_form_error = true;
          if (err.response) {
            var errors = err.response.data.data.errors;
            var errorObj = [];

            for (const [key, value] of Object.entries(errors)) {
              errorObj.push(`${value}`);
              errorObj.push("<br />");
            }
            $("#card_form_error").html(errorObj);
          } else if (err.request) {
            console.log(err.request);
          } else {
            console.log(err.response);
          }
          this.loading = false;
          this.saveDisabled = false;
        })
        .finally(() => (this.loading = false));

      if (
        this.form.billing.address != "" &&
        this.form.billing.address_number != "" &&
        this.form.billing.country_id != "" &&
        this.form.billing.state_id != ""
      ) {
        axios
          .post("/api/save_billing_address", this.form.billing)
          .then((response) => {
            this.loading = false;
            this.saveDisabled = false;
            this.billing_form_error = false;
            console.log(response.data);
          })
          .catch((err) => {
            this.billing_form_error = true;
            if (err.response) {
              var errors = err.response.data.data.errors;
              var errorObj = [];

              for (const [key, value] of Object.entries(errors)) {
                errorObj.push(`${value}`);
                errorObj.push("<br />");
              }
              $("#billing_form_error").html(errorObj);
            } else if (err.request) {
              console.log(err.request);
            } else {
              console.log(err.response);
            }
            this.loading = false;
            this.saveDisabled = false;
          })
          .finally(() => (this.loading = false));
      }

      if (this.card_form_error === false && this.billing_form_error === false) {
        window.location.href = this.asset + "/payment";
      }
    },

    deleteDiscount(promocode) {
      let formData = new FormData();
      formData.append("promocode", promocode);

      axios
        .post("/api/delete_discount", this.form)
        .then((response) => {
          var resData = response.data.data;
          this.cartData = resData;
          if (resData) {
            this.userData = resData.cart_owner;
          }
        })
        .catch((err) => {
          console.log(err);
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
