<template>
  <section class="cart-page-section">
    <div class="container">
      <div class="row cstm-row" v-if="cartItemsData.length > 0">
        <div class="col-lg-8 pr-lg-1">
          <form action="#" class="form-layout-view-style cart-form">
            <div class="title-bar">
              <h2 class="heading">SELECTIONS</h2>
            </div>
            <div class="product-detail-wrap" v-if="cartItemsData.length > 0">
              <!-- Product Row 1 -->
              <div
                v-for="(item, index) in cartItemsData"
                :key="index"
                class="product-info-row"
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
                    <label for="titletxt" class="small-label">VENDOR </label>
                    <p class="text-bold">
                      <template v-if="item.package.user">
                        {{ item.package.user.name }}
                      </template>
                    </p>
                  </div>
                </div>
                <div class="b-three">
                  <div class="form-group">
                    <label for="package" class="small-label">PACKAGE </label>
                    <div class="label-select-group">
                      <p class="text-bold">{{ item.package.type }} Package</p>
                      {{ currencySymbol }}{{ item.package.price }}
                    </div>

                    <small class="validation-info correct-icon d-none"></small>
                  </div>
                  <div class="form-group">
                    <div class="label-select-group">
                      <p class="text-bold">Quantity</p>
                      <select
                        class="custom-select selectpicker quantity-select"
                        :id="`upgrade_${item.id}`"
                        @change="updateCart($event, 'quantity', item.id)"
                      >
                        <option value="1" :selected="item.quantity == 1">1</option>
                        <option value="2" :selected="item.quantity == 2">2</option>
                        <option value="3" :selected="item.quantity == 3">3</option>
                        <option value="4" :selected="item.quantity == 4">4</option>
                      </select>
                    </div>
                    <small class="validation-info correct-icon d-none"></small>
                  </div>
                </div>
                <div v-if="item.package.upsell" class="b-four">
                  <div class="form-group">
                    <label for="titletxt" class="small-label">DELIVERY </label>
                    <div
                      class="label-checkbox-group"
                      v-tooltip="{
                        global: true,
                        theme: {
                          placement: 'top',
                          width: 'fit-content',
                        },
                      }"
                    >
                      <p class="text-bold">
                        {{ item.package.upsell.title }}
                        <a
                          href="#"
                          class="tooltip-icon"
                          v-tooltip.bottom-start="item.package.upsell.description"
                        ></a>
                      </p>
                      <div class="custom-control custom-checkbox">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          :id="`upsell_${item.id}`"
                          :value="`${item.is_upsell}`"
                          v-model="item.is_upsell"
                          @change="updateCart($event, 'upsell', item.id)"
                        />
                        <label
                          v-if="item.package.upsell.price"
                          class="custom-control-label"
                          :for="`upsell_${item.id}`"
                          >{{ currencySymbol }}{{ item.package.upsell.price }}</label
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div v-else class="b-four">
                  <div class="date-time-arrange-b">
                    <div class="cstm-row">
                      <div class="form-group">
                        <label for="datetext" class="small-label">Date </label>
                        <div class="input-icon-group">
                          <input
                            type="text"
                            name="date_custom"
                            class="input-datetime datepicker datepicker-style"
                            placeholder="Select Date"
                            :id="`delivery_date_${item.id}`"
                            v-model="item.delivery_date"
                            @change="updateCart($event, 'delivery', item.id)"
                          />
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="datetext" class="small-label">Time </label>
                        <div class="input-icon-group dropdown time-dropdown">
                          <input
                            v-if="item.delivery_from_time && item.delivery_to_time"
                            type="text"
                            name=""
                            :id="`time_${item.id}`"
                            class="input-datetime"
                            placeholder="Select Time"
                            :value="`${item.delivery_from_time} - ${item.delivery_to_time}`"
                            autofocus
                            disabled
                          />
                          <input
                            v-else
                            type="text"
                            name=""
                            :id="`time_${item.id}`"
                            class="input-datetime"
                            placeholder="Select Time"
                            value="Select Time"
                            autofocus
                            disabled
                          />
                          <a
                            class="btn dropdown-toggle"
                            href="#"
                            role="button"
                            id="dropdownMenuLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >
                            <i class="icon-icon_arrow_down"></i>
                          </a>
                          <div
                            class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="dropdownMenuLink"
                          >
                            <div class="time-main-wrap">
                              <div class="time-row">
                                <p class="p-text"><b> From:</b></p>
                                <input
                                  type="text"
                                  class="input-time fromdate timeEntry"
                                  size="20"
                                  placeholder="00:00"
                                  :id="`from_time_${item.id}`" 
                                  v-model="item.delivery_from_time"
                                  @blur="calculateTime($event, item.id)"
                                />
                              </div>
                              <div class="time-row">
                                <p class="p-text"><b>To:</b></p>
                                <input
                                  type="text"
                                  class="input-time todate timeEntry"
                                  size="20" 
                                  :id="`to_time_${item.id}`"                                   
                                  v-model="item.delivery_to_time"
                                  @blur="calculateTime($event, item.id)"
                                />
                              </div>
                              <hr class="cstm-hr" />
                              <div class="time-row">
                                <p class="p-text"><b>Total:</b></p>
                                <p class="p-text">
                                  <span :class="`totalhours_${item.id}`"></span>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="label-checkbox-group">
                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input"
                            :id="`arrange_delivery_later_${item.id}`"
                            :value="`${item.arrange_delivery_later}`"
                            v-model="item.arrange_delivery_later"
                            @change="updateCart($event, 'deliver_later', item.id)"
                          />
                          <label
                            class="custom-control-label"
                            :for="`arrange_delivery_later_${item.id}`"
                            >Arrange Date & Time later</label
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="cart-btn-row">
              <a :href="`${asset}`" class="text-link">
                <button type="button" class="btn btn-dark">Continue Shopping</button>
              </a>
              <button v-if="cartItemsData.length > 0" type="button" class="btn btn-gray" @click="clearCart()">
                Clear Cart
              </button>
            </div>
          </form>
        </div>
        <div class="col-lg-4" v-if="cartItemsData.length > 0">
          <div class="cart-right-side">
            <form action="#" class="form-layout-view-style">
              <div class="title">
                <h2 class="heading">CART TOTAL</h2>
              </div>
              <div
                v-show="promoerror"
                id="promo_error_div"
                class="col-md-12 error-text"
                style="color: red; margin-bottom: 20px"
              ></div>
              <div class="form-group">
                <div class="input-button-group">
                  <input
                    id="promocode"
                    class="form-control"
                    type="text"
                    name="promocode"
                    v-model="promocode"
                    placeholder="Gift Card or Discount Code"
                  />
                  <button
                    class="btn btn-outline-dark"
                    type="button"
                    @click="updateCart($event, 'apply')"
                  >
                    Apply
                  </button>
                  <small class="error-text d-none">validation Error text</small>
                </div>
              </div>
              <div class="sub-total-group">
                <h5 class="sub-total-text">Subtotal</h5>
                <h5 class="sub-total-amount" v-if="cartData">
                  <template v-if="cartData.promo_discount_amount">
                    {{ currencySymbol }}{{ parseFloat(cartData.grand_total) + parseFloat(cartData.promo_discount_amount) }}
                  </template>
                  <template v-else>
                    {{ currencySymbol }}{{ cartData.grand_total }}
                  </template>
                </h5>
                <h5 class="sub-total-amount" v-else>$0</h5>
              </div>
              <div class="checkout-button-wrap">
                <a :href="`${asset}/checkout`" class="btn btn-dark"
                  >Proceed to Checkout</a
                >
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row cstm-row" v-else>
        <div class="col-lg-8 pr-lg-1">
          <div class="product-info-row">
            No Package added in your cart, please continue shopping
            <br />
            <br />
            <br />
          </div>

          <div class="cart-btn-row">
            <a :href="`${asset}`" class="text-link">
              <button type="button" class="btn btn-dark">Continue Shopping</button>
            </a>
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
    console.log("vue");
    this.getCartDetails();
    this.getSiteSettings();
  },

  data() {
    return {
      asset: "",
      promoerror: false,
      cartData: [],
      cartItemsData: [],
      userData: [],
      checkedUpsells: [],
      promocode: "",
      currencySymbol: "",
      form: {},
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
            this.promocode = resData.coupon_code;
          }
          this.$nextTick(function () {
            $(".selectpicker").selectpicker("refresh");
          });
        }.bind(this)
      );
    },
    calculateTime: function (event, itemId) {
      console.log("event : " + event);
      console.log("itemId : " + itemId);
      var time1 = $("#from_time_" + itemId).val();
      var time2 = $("#to_time_" + itemId).val();

      var time1 = time1.split(":");
      var time2 = time2.split(":");
      var hours1 = parseInt(time1[0], 10),
        hours2 = parseInt(time2[0], 10),
        mins1 = parseInt(time1[1], 10),
        mins2 = parseInt(time2[1], 10);
      var hours = hours2 - hours1,
        mins = 0;
      if (hours < 0) hours = 24 + hours;
      if (mins2 >= mins1) {
        mins = mins2 - mins1;
      } else {
        mins = mins2 + 60 - mins1;
        hours--;
      }
      if (mins < 9) {
        mins = "0" + mins;
      }
      if (hours < 9) {
        hours = "0" + hours;
      }
      console.log(hours + ":" + mins);
      var totalTime = hours + ":" + mins;
      if (totalTime != "NaN:NaN") {
        $(".totalhours_" + itemId).html(hours + ":" + mins + " hrs");
        this.updateCart("", "delivery", itemId);
      }
    },
    clearCart: function () {
      const data = {};
      axios
        .post("/api/clear_cart", data)
        .then((response) => {
          this.cartData = [];
          this.cartItemsData = [];
          console.log(response);
        })
        .catch((err) => {
          if (err.response) {
            if (err.request.status == 401) {
              window.location.href = this.asset + "/login";
            }
          }
        })
        .finally();
    },
    updateCart: function (event, type, id, price) {
      const data = {};

      data["type"] = type;
      if (type == "upsell") {
        data["value"] = event.target.checked;
        data["price"] = price;
        data["id"] = id;
      }
      if (type == "quantity") {
        data["value"] = event.target.value;
        data["price"] = price;
        data["id"] = id;
      }
      if (type == "apply") {
        data["promocode"] = this.promocode;
      }
      if (type == "deliver_later") {
        data["value"] = event.target.checked;
        data["id"] = id;
      }
      if (type == "delivery") {
        var from_time = $("#from_time_" + id).val();
        var to_time = $("#to_time_" + id).val();
        var delivery_date = $("#delivery_date_" + id).val();
        data["from_time"] = from_time;
        data["to_time"] = to_time;
        data["delivery_date"] = delivery_date;
        data["id"] = id;
      }
      axios
        .post("/api/update_cart", data)
        .then((response) => {
          var resData = response.data.data;
          this.cartData = resData;             
          this.promoerror = false;
          if (resData) {
            this.userData = resData.cart_owner;
            this.cartItemsData = resData.cart_items;
            this.promocode = resData.coupon_code;
          }
        })
        .catch((err) => {
          if (err.response) {
            if (err.request.status == 401) {
              window.location.href = this.asset + "/login";
            }
            var errorObj = [];
            if (err.response.data.status == 422) {             
              this.promoerror = true;
              errorObj.push(err.response.data.message);
            }
            if (err.response.data.data.errors) {
              var errors = err.response.data.data.errors;
              for (const [key, value] of Object.entries(errors)) {
                errorObj.push(`${value}`);
                errorObj.push("<br />");
              }
            } else if (err.request) {
              console.log(err.request);
            } else {
              console.log(err.response);
            }
            $("#promo_error_div").html(errorObj);

          }
        })
        .finally();
    },
    
  },
};
</script>
