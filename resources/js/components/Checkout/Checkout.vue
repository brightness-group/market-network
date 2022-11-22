<template>
  <section class="checkout-page-section">
    <div class="container">
      <div class="row cstm-row">
        <div class="col-lg-7 pr-lg-1 pr-3">
          <div class="title-bar">
            <h2 class="heading">CONTACT DETAILS</h2>
          </div>
          <form action="#" class="form-layout-view-style contact-detail-form">
            <div
              id="error_div"
              class="col-md-12 error-text"
              style="display:none; color: red; margin-bottom: 20px"
            ></div>
            
            <div class="contact-detail-form-row">
              <div class="left-block">
                <div class="user-img">
                  <div
                    :style="`background-image: url('${userData.profile_photo_full_path}');`"
                    class="bg-user-img"
                  ></div>
                </div>
              </div>
              <div class="right-block">
                <div class="form-group">
                  <label for="titletxt" class="small-label">FULL NAME </label>
                  <input
                    id="titletxt"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder="FULL NAME" 
                    v-model="form.full_name"

                  />
                  <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="form-group">
                  <label for="compnyname" class="small-label">COMPANY (OPTIONAL) </label>
                  <input
                    id="compnyname"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder="" 
                    v-model="form.company_name" 
                  />
                  <small class="validation-info correct-icon d-none"></small>
                </div>
                <div class="form-group">
                  <label for="addresstext" class="small-label">ADDRESS</label>
                  <input
                    id="addresstext"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder=""
                    v-model="form.address" 
                  />
                  <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
                <div class="form-group">
                  <label for="addressnumber" class="small-label">ADDRESS NUMBER</label>
                  <input
                    id="addressnumber"
                    class="form-control"
                    type="text"
                    name=""
                    placeholder=""
                    v-model="form.address_number" 
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
                        v-model="form.country_id"
                      >
                        <option 
                          v-for="(country, countryIndex) in countriesData"
                          :key="countryIndex"
                          :value="country.id"
                          :selected="country.id === form.country_id"
                        >{{ country.name }}</option>
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
                        v-model="form.state_id" 
                      >
                      <option 
                          v-for="(state, stateIndex) in statesData"
                          :key="stateIndex"
                          :value="state.id"
                          :selected="state.id === form.state_id"
                        >{{ state.name }}</option>
                      </select>
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="phonenumber" class="small-label">PHONE </label>
                  <input
                    id="phonenumber"
                    class="form-control"
                    type="tel"
                    name=""
                    placeholder=""
                    v-model="form.phone" 
                  />
                  <small class="validation-info correct-icon d-none"></small>
                  <span class="mendetory-dot"><i class="icon-icon_form_required"></i></span>
                  <small class="error-text d-none">validation Error text</small>
                </div>
              </div>
            </div>
          </form>

          <div class="title-bar">
            <h2 class="heading">EXPRESS CHECKOUT</h2>
          </div>
          <form action="#" class="expresscheckout-form">
            <div class="payment-button-row">
              <a href="#" class="btn btn-dark"
                ><span class="payment-icon pay-apple-icon"></span
              ></a>
              <a href="#" class="btn btn-dark"
                ><span class="payment-icon paypal-icon"></span
              ></a>
              <a href="#" class="btn btn-dark"
                ><span class="payment-icon tabby-icon"></span
              ></a>
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
                      <p class="text-bold"><template v-if="item.package.user">
                        {{ item.package.user.name }}
                      </template></p>
                    </div>
                  </div>
                  <div class="b-three">
                    <div class="form-group">
                      <div class="label-amount-group">
                        <p class="text-bold">{{ item.quantity }} x {{ item.package.type }} Package</p>
                        <p class="amount-text">{{ currencySymbol }}{{ item.quantity * item.package.price }}</p>
                      </div>
                    </div>
                    <div v-if="item.package.upsell" class="form-group">
                      <div class="label-amount-group">
                        <p class="text-bold">{{ item.package.upsell.title }}</p>
                        <p class="amount-text" v-if="item.package.upsell.price">{{ currencySymbol }}{{ item.package.upsell.price }}</p>
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
                    <h5 class="sub-total-amount" v-if="cartData.extras_total">{{ currencySymbol }}{{ cartData.extras_total }}</h5>
                    <h5 class="sub-total-amount" v-else>$0</h5>
                  </div>
                  <div class="sub-total-row">
                    <h5 class="sub-total-text">Promotions <span v-if="cartData.coupon_code" class="promo-tag"> {{ cartData.coupon_code }} <a href="javascript:void(0);" @click="deleteDiscount(cartData.coupon_code)" class="close-icon"></a> </span> </h5>
                    <h5 class="sub-total-amount" v-if="cartData.promo_discount_amount">{{ currencySymbol }}{{ cartData.promo_discount_amount }}  </h5>
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
            <a :href="`${asset}/cart`" class="btn light-btn-gray">Back</a>
            <a href="javascript:void(0);" class="btn btn-dark" @click="saveContactDetails()">Continue to Payment</a>
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
      loading: false,
      saveDisabled: false,
      cartData: [],
      userData: [],
      cartItemsData: [],
      countriesData: [],
      statesData: [],
      currencySymbol: '',
      form: {
        full_name: '',
        company_name: '',
        address: '',
        address_number: '',
        country_id: '',
        state_id: '',
        phone: '',
      }
    };
  },

  methods: {
    getSiteSettings: function() {
        axios.get('/api/site-settings')
        .then((response) => {                 
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
            this.form.full_name = this.userData.name;
            console.log(resData.cart_owner.addresses);
            if (resData.cart_owner.addresses) {
              this.form.company_name = resData.cart_owner.addresses.company_name;
              this.form.address = resData.cart_owner.addresses.address;
              this.form.address_number = resData.cart_owner.addresses.address_number;
              this.form.country_id = resData.cart_owner.addresses.country_id;
              this.form.state_id = resData.cart_owner.addresses.state_id;
              this.form.phone = resData.cart_owner.addresses.phone;
            }
          }
          this.$nextTick(function () {
            $(".selectpicker").selectpicker("refresh");
          });
        }.bind(this)
      );
    },

    saveContactDetails() {
      this.loading = true;
      this.saveDisabled = true;
      axios
        .post("/api/save_contact_details",  this.form)
        .then((response) => {
          this.loading = false;
          this.saveDisabled = false;
          $("#error_div").hide();
          console.log(response.data);
            window.location.href = this.asset + "/cart-checkout";
        })
        .catch((err) => {
          $("#error_div").show();
          if (err.response) {
            var errors = err.response.data.data.errors;
            var errorObj = [];

            for (const [key, value] of Object.entries(errors)) {
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
          this.saveDisabled = false;
        })
        .finally(() => (this.loading = false));
    },

    deleteDiscount(promocode) {
      let formData = new FormData();
      formData.append("promocode", promocode);

      axios
        .post("/api/delete_discount",  this.form)
        .then((response) => {
          this.loading = false;
          this.saveDisabled = false;
          $("#error_div").hide();
          
          var resData = response.data.data;
          this.cartData = resData;
          if (resData) {
            this.userData = resData.cart_owner;
          }
        })
        .catch((err) => {
          $("#error_div").show();
          if (err.response) {
            var errors = err.response.data.data.errors;
            var errorObj = [];

            for (const [key, value] of Object.entries(errors)) {
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
          this.saveDisabled = false;
        })
        .finally(() => (this.loading = false));
    }
  },
};
</script>
