<template>
  <div class="bg-dark tab-innr-wrp">
    <div class="container">
      <div
        id="pane-purchases"
        class="card tab-pane fade show active purchases-tab-section"
        role="tabpanel"
        aria-labelledby="tab-purchases"
      >
        <div class="card-header mob-v" role="tab" id="heading-purchases">
          <h5 class="mb-0">
            <a
              class="collapsed"
              data-toggle="collapse"
              href="#collapse-purchases"
              aria-expanded="false"
              aria-controls="collapse-purchases"
            >
              Purchases
            </a>
          </h5>
        </div>
        <div
          id="collapse-purchases"
          class="collapse mob-v"
          role="tabpanel"
          data-parent="#content"
          aria-labelledby="heading-purchases"
        >
          <div class="card-body">
            <!-- Purchases Active Orders / Oredr History Section-->
            <div v-show="show_orders_history" class="purchases-oredr-history-wrap">
              <div class="row">
                <div class="col-lg-4 col-md-12">
                  <div class="card menu-card-box">
                    <div
                      class="nav flex-column nav-pills"
                      id="v-pills-tab"
                      role="tablist"
                      aria-orientation="vertical"
                    >
                      <a
                        class="nav-link active"
                        id="v-pills-activeorders-tab"
                        data-toggle="pill"
                        href="#v-pills-activeorders"
                        role="tab"
                        aria-controls="v-pills-activeorders"
                        aria-selected="true"
                        >ACTIVE ORDERS
                      </a>
                      <a
                        class="nav-link"
                        id="v-pills-orderhistory-tab"
                        data-toggle="pill"
                        href="#v-pills-orderhistory"
                        role="tab"
                        aria-controls="v-pills-orderhistory"
                        aria-selected="false"
                        >ORDER HISTORY
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-md-12">
                  <div class="tab-content" id="v-pills-tabContentThree">
                    <div
                      class="tab-pane fade show active pills-activeorders-tab"
                      id="v-pills-activeorders"
                      role="tabpanel"
                      aria-labelledby="v-pills-activeorders-tab"
                    >
                      <div class="order-active-orders-row">
                        <div class="top-info-block">
                          <div class="top-info-inner">
                            <div class="img-wrap">
                              <img :src="`${asset}/assets/images/block-box-img-6.png`" alt="" />
                            </div>
                            <div class="detail-wrap">
                              <div class="heading-text">
                                Make the most of your urban jungle
                              </div>
                              <div class="bottom-info-row">
                                <div class="info-col">
                                  <div class="top-d">
                                    <b>Provided by:</b>
                                  </div>
                                  <div class="img-group-wrap">
                                    <img
                                      :src="`${asset}/assets/images/Profile-Picture-2.png`"
                                      alt=""
                                    />
                                    <img
                                      :src="`${asset}/assets/images/Profile-Picture-3.png`"
                                      alt=""
                                    />
                                    <img
                                      :src="`${asset}/assets/images/Profile-Picture-4.png`"
                                      alt=""
                                    />
                                    <img
                                      :src="`${asset}/assets/images/Profile-Picture-5.png`"
                                      alt=""
                                    />
                                    <img
                                      :src="`${asset}/assets/images/Profile-Picture-7.png`"
                                      alt=""
                                    />
                                    <img
                                      :src="`${asset}/assets/images/Profile-Picture-1.png`"
                                      alt=""
                                    />
                                  </div>
                                </div>
                                <div class="info-col">
                                  <div class="top-d">
                                    <b
                                      >Order No:
                                      <br />
                                    </b>
                                    7235251
                                  </div>
                                  <div class="bottom-d">
                                    <b
                                      >Booking Date:

                                      <br />
                                    </b>
                                    07.06.2021
                                  </div>
                                </div>
                                <div class="info-col">
                                  <div class="top-d">
                                    <b
                                      >Order Date:
                                      <br />
                                    </b>
                                    14.05.2021
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="bottom-info-block">
                          <div class="bottom-info-inner">
                            <div class="order-details-row">
                              <div class="order-status-wrap">
                                <div class="order-status-text status-inprogress">
                                  <b>Order Status:</b> In Progress
                                  <span class="status-icon"></span>
                                </div>
                              </div>

                              <div class="btn-wrap">
                                <a href="#" class="btn btn-outline-light"
                                  >View Order Details</a
                                >
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade pills-orderhistory-tab"
                      id="v-pills-orderhistory"
                      role="tabpanel"
                      aria-labelledby="v-pills-orderhistory-tab"
                    >
                      <div class="order-history-row" v-for="(co,index) in completedOrdersHistory" :key="index">
                        <div class="left-info-block">
                          <div class="left-info-inner">
                            <div class="img-wrap">
                              <img :src="`${co.snapshot.snapshot_image_path}`" alt="" />
                            </div>
                            <div class="detail-wrap">
                              <div class="dropdown">
                                <button
                                  class="more-btn-link dropdown-toggle"
                                  type="button"
                                  id="dropbtn"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                ></button>
                                <div class="dropdown-menu" aria-labelledby="dropbtn">
                                  <a class="dropdown-item" href="#">View Order</a>
                                  <a class="dropdown-item" href="#">Order Again</a>
                                  <a
                                    class="dropdown-item"
                                    href="#shareThisSeenModal"
                                    data-toggle="modal"
                                    >Share Seen</a
                                  >
                                </div>
                              </div>
                              <div class="heading-text">
                                {{ co.snapshot.title }}
                              </div>
                              <div class="order-status-d">
                                <b> Order {{ co.order.status }} :</b> {{ co.order.status_changed_at }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="right-info-block">
                          <div class="right-info-inner">
                            <div class="review-row" v-for="(user, userIndex) in co.snapusers" :key="userIndex">
                              <div class="rating-img-wrap">
                                <div class="u-img">
                                  <img
                                    :src="`${user.profile_photo_full_path}`"
                                    alt=""
                                  />
                                </div>
                                <div class="star-rating">
                                  <div
                                    class="rateit svg"
                                    data-rateit-starwidth="12"
                                    data-rateit-starheight="12"
                                  ></div>
                                </div>
                              </div>

                              <div class="status-btn-wrap">
                                <a href="#" class="reviews-status-btnlink d-none"
                                  >Edit Review</a
                                >
                                <a href="#" class="reviews-status-btnlink d-none"
                                  >Pending</a
                                >
                                <a href="javascript:void(0);" @click="addReview()" class="reviews-status-btnlink">Add Review</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
<!-- 
                      <div class="order-history-row">
                        <div class="left-info-block">
                          <div class="left-info-inner">
                            <div class="img-wrap">
                              <img :src="`${asset}/assets/images/block-box-img-6.png`" alt="" />
                            </div>
                            <div class="detail-wrap">
                              <div class="dropdown">
                                <button
                                  class="more-btn-link dropdown-toggle"
                                  type="button"
                                  id="dropbtn"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                ></button>
                                <div class="dropdown-menu" aria-labelledby="dropbtn">
                                  <a class="dropdown-item" href="#">View Order</a>
                                  <a class="dropdown-item" href="#">Order Again</a>
                                  <a
                                    class="dropdown-item"
                                    href="#shareThisSeenModal"
                                    data-toggle="modal"
                                    >Share Seen</a
                                  >
                                </div>
                              </div>
                              <div class="heading-text">
                                Sed fringilla mauris sit amet
                              </div>
                              <div class="order-status-d">
                                <b> Order Completed :</b> 05.06.2021
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="right-info-block">
                          <div class="right-info-inner">
                            <div class="review-row">
                              <div class="rating-img-wrap">
                                <div class="u-img">
                                  <img
                                    :src="`${asset}/assets/images/Profile-Picture-big.png`"
                                    alt=""
                                  />
                                </div>
                                <div class="star-rating">
                                  <div
                                    class="rateit svg"
                                    data-rateit-starwidth="12"
                                    data-rateit-starheight="12"
                                  ></div>
                                </div>
                              </div>

                              <div class="status-btn-wrap">
                                <a href="#" class="reviews-status-btnlink d-none"
                                  >Edit Review</a
                                >
                                <a href="#" class="reviews-status-btnlink d-none"
                                  >Add Review
                                </a>
                                <a
                                  href="#seenreviewModal"
                                  data-toggle="modal"
                                  class="reviews-status-btnlink"
                                  >See Review</a
                                >
                              </div>
                            </div>

                            <div class="review-row">
                              <div class="rating-img-wrap">
                                <div class="u-img">
                                  <img
                                    :src="`${asset}/assets/images/Profile-Picture-big.png`"
                                    alt=""
                                  />
                                </div>
                                <div class="star-rating">
                                  <div
                                    class="rateit svg"
                                    data-rateit-starwidth="12"
                                    data-rateit-starheight="12"
                                  ></div>
                                </div>
                              </div>

                              <div class="status-btn-wrap">
                                <a
                                  href="#seenreviewModal"
                                  data-toggle="modal"
                                  class="reviews-status-btnlink"
                                  >See Review</a
                                >
                              </div>
                            </div>

                            <div class="review-row">
                              <div class="rating-img-wrap">
                                <div class="u-img">
                                  <img
                                    :src="`${asset}/assets/images/Profile-Picture-big.png`"
                                    alt=""
                                  />
                                </div>
                                <div class="star-rating">
                                  <div
                                    class="rateit svg"
                                    data-rateit-starwidth="12"
                                    data-rateit-starheight="12"
                                  ></div>
                                </div>
                              </div>

                              <div class="status-btn-wrap">
                                <a href="#" class="reviews-status-btnlink">Edit Review</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="order-history-row">
                        <div class="left-info-block">
                          <div class="left-info-inner">
                            <div class="img-wrap">
                              <img :src="`${asset}/assets/images/block-box-img-6.png`" alt="" />
                            </div>
                            <div class="detail-wrap">
                              <div class="dropdown">
                                <button
                                  class="more-btn-link dropdown-toggle"
                                  type="button"
                                  id="dropbtn"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                ></button>
                                <div class="dropdown-menu" aria-labelledby="dropbtn">
                                  <a class="dropdown-item" href="#">View Order</a>
                                  <a class="dropdown-item" href="#">Order Again</a>
                                  <a
                                    class="dropdown-item"
                                    href="#shareThisSeenModal"
                                    data-toggle="modal"
                                    >Share Seen</a
                                  >
                                </div>
                              </div>
                              <div class="heading-text">
                                Sed fringilla mauris sit amet
                              </div>
                              <div class="order-status-d">
                                <b> Order Completed :</b> 05.06.2021
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="right-info-block">
                          <div class="right-info-inner">
                            <div class="review-row">
                              <div class="rating-img-wrap">
                                <div class="u-img">
                                  <img
                                    :src="`${asset}/assets/images/Profile-Picture-big.png`"
                                    alt=""
                                  />
                                </div>
                                <div class="star-rating">
                                  <div
                                    class="rateit svg"
                                    data-rateit-starwidth="12"
                                    data-rateit-starheight="12"
                                  ></div>
                                </div>
                              </div>

                              <div class="status-btn-wrap">
                                <a href="#" class="reviews-status-btnlink d-none"
                                  >Edit Review</a
                                >
                                <a href="#" class="reviews-status-btnlink d-none"
                                  >Pending</a
                                >
                                <a href="#" class="reviews-status-btnlink">Add Review</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->

                      <div class="col-md-12 text-center mt-5">
                        <a href="javascript:void(0);" @click="getCompletedOrders()" class="btn btn-outline-dark load-more-btn">
                          Load more +</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Purchases Active Orders / Oredr History Section End-->

            <!-- Add Review You Box -->
            <div v-show="add_review" class="add-review-wrap">
              <div class="row cstm-row">
                <div class="col-lg-8 col-md-12">
                  <div class="left-inner-wrap">
                    <form action="#" class="form-layout-view-style review-form">
                      <div class="title-bar">
                        <h2 class="heading">REVIEW</h2>
                      </div>
                      <div class="form-group">
                        <div class="label-group">
                          <label for="" class="large-bold-label"
                            >Would you recommend Raven?</label
                          >
                          <small class="validation-info correct-icon d-none"></small>
                          <span class="mendetory-dot"
                            ><i class="icon-icon_form_required"></i
                          ></span>
                        </div>
                        <div class="custom-radio-wrap">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input
                              type="radio"
                              id="customRadio1"
                              name="customRadio1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label" for="customRadio1"
                              >Yes</label
                            >
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input
                              type="radio"
                              id="customRadio2"
                              name="customRadio1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label" for="customRadio2"
                              >No</label
                            >
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="label-group">
                          <label for="" class="large-bold-label">Quality Rating</label>
                          <small class="validation-info correct-icon d-none"></small>
                          <span class="mendetory-dot"
                            ><i class="icon-icon_form_required"></i
                          ></span>
                        </div>
                        <div class="rating-group">
                          <div class="bar-rating">
                            <select
                              id="quality-rating"
                              class="bar-ratingstyle"
                              name="rating"
                              autocomplete="off"
                            >
                              <option value=""></option>
                              <option value="poor">poor</option>
                              <option value="poor2">poor</option>
                              <option value="Good1">Good</option>
                              <option value="Good2">Good</option>
                              <option value="Good3">Good</option>
                            </select>
                          </div>
                          <div class="rating-label">
                            <div class="label-text">Poor</div>
                            <div class="label-text">Great</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="label-group">
                          <label for="" class="large-bold-label"
                            >Communication Rating</label
                          >
                          <small class="validation-info correct-icon d-none"></small>
                          <span class="mendetory-dot"
                            ><i class="icon-icon_form_required"></i
                          ></span>
                        </div>
                        <div class="rating-group">
                          <div class="bar-rating">
                            <select
                              id="id4"
                              class="bar-ratingstyle"
                              name="rating"
                              autocomplete="off"
                            >
                              <option value=""></option>
                              <option value="poor">poor</option>
                              <option value="poor2">poor</option>
                              <option value="Good1">Good</option>
                              <option value="Good2">Good</option>
                              <option value="Good3">Good</option>
                            </select>
                          </div>
                          <div class="rating-label">
                            <div class="label-text">Poor</div>
                            <div class="label-text">Great</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="label-group">
                          <label for="" class="large-bold-label"
                            >Availability Rating</label
                          >
                          <small class="validation-info correct-icon d-none"></small>
                          <span class="mendetory-dot"
                            ><i class="icon-icon_form_required"></i
                          ></span>
                        </div>
                        <div class="rating-group">
                          <div class="bar-rating">
                            <select
                              id="id5"
                              class="bar-ratingstyle"
                              name="rating"
                              autocomplete="off"
                            >
                              <option value=""></option>
                              <option value="poor">poor</option>
                              <option value="poor2">poor</option>
                              <option value="Good1">Good</option>
                              <option value="Good2">Good</option>
                              <option value="Good3">Good</option>
                            </select>
                          </div>
                          <div class="rating-label">
                            <div class="label-text">Poor</div>
                            <div class="label-text">Great</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="label-group required">
                          <label for="" class="large-bold-label">Review</label>
                        </div>
                        <textarea
                          name=""
                          id="reviewtextarea"
                          placeholder="Keep it brief… max. 200 characters"
                          class="form-control cstm-text-area"
                        ></textarea>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12">
                  <div class="right-inner-wrap">
                    <form action="#" class="form-layout-view-style review-summary-form">
                      <div class="title-bar">
                        <h2 class="heading">SUMMARY</h2>
                      </div>
                      <div class="summary-info-card">
                        <div class="top-info">
                          <div class="u-img-wrap">
                            <img :src="`${asset}/assets/images/Profile-Picture-big.png`" alt="" />
                          </div>
                          <div class="right-u-info">
                            <div class="star-rating">
                              <div
                                class="rateit svg"
                                data-rateit-starwidth="15"
                                data-rateit-starheight="15"
                              ></div>
                              <span class="star-counter"> 0</span>
                            </div>
                            <div class="desc-text">You would recommend Raven</div>
                            <div class="cat-text"><b>Raven West</b> Caterer</div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="label-group">
                            <label for="" class="large-bold-label">
                              <span class="icon-img"><i class="icon-quality"></i></span>
                              Quality Rating</label
                            >
                          </div>
                          <div class="rating-group">
                            <div class="bar-rating">
                              <select
                                id="id1"
                                class="bar-rating-readonly"
                                name="rating"
                                autocomplete="off"
                                data-current-rating="5"
                              >
                                <option value=""></option>
                                <option value="poor">poor</option>
                                <option value="poor2">poor</option>
                                <option value="Good1" selected="selected">Good</option>
                                <option value="Good2">Good</option>
                                <option value="Good3">Good</option>
                              </select>
                            </div>
                            <div class="rating-label">
                              <div class="label-text">Poor</div>
                              <div class="label-text">Great</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="label-group">
                            <label for="" class="large-bold-label">
                              <span class="icon-img"
                                ><i class="icon-communication"></i
                              ></span>
                              Communication Rating</label
                            >
                          </div>
                          <div class="rating-group">
                            <div class="bar-rating">
                              <select
                                id="id2"
                                class="bar-rating-readonly"
                                name="rating"
                                autocomplete="off"
                              >
                                <option value=""></option>
                                <option value="poor">poor</option>
                                <option value="poor2">poor</option>
                                <option value="Good1">Good</option>
                                <option value="Good2" selected="selected">Good</option>
                                <option value="Good3">Good</option>
                              </select>
                            </div>
                            <div class="rating-label">
                              <div class="label-text">Poor</div>
                              <div class="label-text">Great</div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="label-group">
                            <label for="" class="large-bold-label">
                              <span class="icon-img"><i class="icon-avaiblity"></i></span>
                              Availability Rating</label
                            >
                          </div>
                          <div class="rating-group">
                            <div class="bar-rating">
                              <select
                                id="id3"
                                class="bar-rating-readonly"
                                name="rating"
                                autocomplete="off"
                              >
                                <option value=""></option>
                                <option value="poor">poor</option>
                                <option value="poor2">poor</option>
                                <option value="Good1">Good</option>
                                <option value="Good2">Good</option>
                                <option value="Good3" selected="selected">Good</option>
                              </select>
                            </div>
                            <div class="rating-label">
                              <div class="label-text">Poor</div>
                              <div class="label-text">Great</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3 mt-3">
                        <button type="button" class="btn btn-dark w-100">
                          Submit Review
                        </button>
                      </div>
                      <div class="form-group mt-2">
                        <button type="button" @click="cancelReview()" class="btn light-btn-gray w-100">
                          Cancel Review
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Add Review  Box -->
            <!-- ThankYou Add Review Box -->
            <div class="thankyou-add-review-wrap d-none">
              <div class="row cstm-row">
                <div class="col-lg-6 col-md-12">
                  <div class="inner-cardbox">
                    <div class="title-bar">
                      <h2 class="heading">
                        Thank you for your <br />
                        REVIEW.
                      </h2>
                    </div>
                    <div class="thankyou-msg-wrap">
                      <p class="p-text">
                        Your Seen Pro review has been sent to the Seen team. Provided
                        you’re review is appropriate and verified, your Review will be
                        visible within 24 hours.
                      </p>
                      <div class="btn-group-wrap">
                        <a href="javascript:void(0);" class="btn btn-dark mr-0"
                          >Discover More</a
                        >
                        <a href="javascript:void(0);" class="btn btn-outline-dark"
                          >View Profile</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="img-block">
                    <img :src="`${asset}/assets/images/thankyou-add-review.png`" alt="" />
                  </div>
                </div>
              </div>
            </div>
            <!-- ThankYou Add Review Box End-->
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

  mounted() {
    this.getCompletedOrders();
  },

  data() {
    return {
      asset: "",
      error: false,
      add_review: false,
      show_orders_history: true,
      completedOrdersHistory: [],
      activeOrdersHistory: [],
      orderHistoryUrl: "/api/orders/completed?perPage=2&page=1",
      form: {
        add_review: {
          review_to_id: '',
          order_id: '',
          recommend: 0,
          quality: '',
          communication: '',
          availability: '',
          review: ''
        }
      }
    };
  },

  methods: {
    getCompletedOrders: function () {
      this.recommended = false;
      axios.get(this.orderHistoryUrl).then(
        function (response) {
          console.log(response.data.data);
            var resData = [];
            resData = response.data.data;

            for (let i = 0; i < resData.length; i++) {
              console.log(resData[i]);
              this.completedOrdersHistory.push(resData[i]);
            }
            var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            this.orderHistoryUrl = "/api/orders/completed?perPage=2&page=" + nextPage;
        }.bind(this)
      );
    },

    addReview: function () {
      this.show_orders_history = false;
      this.add_review = true;
    },

    cancelReview: function () {
      this.show_orders_history = true;
      this.add_review = false;
    }
  },
};
</script>
