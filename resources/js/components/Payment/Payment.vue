<template>
  <section v-if="paymentStatus === 'success'" class="checkout-complete-section">
    <div class="container">
      <div class="row cstm-row">
        <div class="col-lg-5 pr-lg-1 pr-3">
          <div class="title-bar">
            <h2 class="heading">THANK YOU</h2>
          </div>
          <div class="thankyou-msg-wrap">
            <h2 class="big-heading">Thank you for your purchase.</h2>
            <p class="p-text">
              A copy of your order has been sent to your registered account email address.
              You can check your order status via your personal message board with the
              vendor.
            </p>
            <a :href="`${asset}`" class="btn btn-dark">Discover More</a>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="messaage-vendors-block">
            <div class="title-bar">
              <h2 class="heading">MESSAGE YOUR VENDORS</h2>
            </div>
            <div class="vendors-list">
              <div class="row">
                <div v-for="(user, userIndex) in userData"
                        :key="userIndex" class="col-lg-4 col-md-4">
                  <div class="vendor-img">
                    <div
                      class="vendor-img-bg" 
                      v-if="user.profile_photo_full_path"
                      :src="`${user.profile_photo_full_path}`"
                      :style="`background-image: url('${user.profile_photo_full_path}');`"
                    ></div>
                  </div>
                  <div class="vendor-msg-button">
                    <a href="javascript:void(0);" class="btn light-btn-gray"
                      >Message {{ user.name }}</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section v-if="paymentStatus === 'cancel'" class="checkout-complete-section">
    <div class="container">
      <div class="row cstm-row">
        <div class="col-lg-12">
          <div class="title-bar">
            <h2 class="heading">Payment has been cancelled!</h2>
          </div>
          <div class="thankyou-msg-wrap">
            <p class="p-text">Your payment has been cancelled! Please try again!</p>
            <a :href="`${asset}/checkout`" class="btn btn-dark">Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section v-if="paymentStatus === 'declined'" class="checkout-complete-section">
    <div class="container">
      <div class="row cstm-row">
        <div class="col-lg-12">
          <div class="title-bar">
            <h2 class="heading">Payment has been declined!</h2>
          </div>
          <div class="thankyou-msg-wrap">
            <p class="p-text">Your payment has been declined! Please try again!</p>
            <a :href="`${asset}/checkout`" class="btn btn-dark">Checkout</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import * as methods from "../Common/helper";

export default {
  props: ["payment_status", "order"],

  components: {},

  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {
    this.getCartDetails();
  },

  data() {
    return {
      asset: "",
      paymentStatus: "",
      userData: []
    };
  },

  methods: {
    getCartDetails: function () {
      this.paymentStatus = JSON.parse(this.payment_status);
      if (this.paymentStatus === 'success') 
      {
        var orderDetail = JSON.parse(this.order);
        console.log(orderDetail.id);
        axios.get("/api/get_vendors/"+orderDetail.id).then(
          function(response) {
            var resData = response.data.data;
            console.log(resData);
            this.userData = resData;
            console.log(this.userData);
          }.bind(this)
        );
        
      }
    },
  },
};
</script>
