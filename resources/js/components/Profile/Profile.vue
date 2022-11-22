<template>
  <section class="profile-deatil-section">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          <div class="usr-img">
            <img :src="profile.profile_photo_full_path" alt="" class="img-fluid" />
          </div>
        </div>
        <div class="col-md-7">
          <div class="u-deatil">
            <div class="star-rating">
              <div
                class="rateit svg"
                data-rateit-starwidth="24"
                data-rateit-starheight="24"
              ></div>
              <span class="star-counter"> 0</span>
            </div>
            <h1 class="heading">{{ profile.name }}</h1>

            <p class="location-txt">
              <span><i class="icon-icon_location"></i></span> {{ profile.location }}
            </p>
            <p class="p-txt">{{ profile.bio }}</p>

            <ul class="nav-list list-unstyled">
              <li>
                <a href="#pane-seen">
                  {{ profile.seens }} <b>seen</b>
                  <span class="icon-img">
                    <img :src="asset + '/assets/images/image.svg'" alt="" />
                  </span>
                </a>
              </li>
              <li>
                <a :href="`${asset}/follow`"
                  >{{ profile.followees }} <b>FOLLOWING</b>
                  <span class="icon-img"
                    ><img :src="asset + '/assets/images/user-add.svg'" alt="" /></span
                ></a>
              </li>
              <li>
                <a :href="`${asset}/follow#pane-followers`"
                  >{{ profile.followers }} <b>FOLLOWERS</b>
                  <span class="icon-img"
                    ><img :src="asset + '/assets/images/user-checked.svg'" alt="" /></span
                ></a>
              </li>
              <li>
                <a href="javascript:void(0);">
                  {{ profile.likes }} <b>LOVE</b>
                  <span class="icon-img"
                    ><img :src="asset + '/assets/images/heart.svg'" alt=""
                  /></span>
                </a>
              </li>
            </ul>

            <a :href="`${asset}/settings/profile`" class="btn btn-dark cstm-btn"
              ><span class="icon-svg"
                ><img :src="asset + '/assets/images/icon_edit.svg'" alt=""
              /></span>
              Edit your profile</a
            >
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="profile-d-tab-section">
    <div class="container">
      <ul id="tabs" class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a
            id="tab-seen"
            href="#pane-seen"
            class="nav-link active"
            data-toggle="tab"
            role="tab"
            >SEENS</a
          >
        </li>
        <li class="nav-item">
          <a
            id="tab-moodboard"
            href="#pane-moodboard"
            class="nav-link"
            data-toggle="tab"
            role="tab"
            >MOODBOARDS</a
          >
        </li>
        <li class="nav-item">
          <a
            id="tab-packages"
            href="#pane-packages"
            class="nav-link"
            data-toggle="tab"
            role="tab"
            >PACKAGES</a
          >
        </li>
        <li class="nav-item">
          <a
            id="tab-reviews"
            href="#pane-reviews"
            class="nav-link"
            data-toggle="tab"
            role="tab"
            >REVIEWS</a
          >
        </li>
      </ul>
    </div>
    <div class="bg-dark tab-innr-wrp">
      <div class="container">
        <div id="content" class="tab-content" role="tablist">
          <div
            id="pane-seen"
            class="card tab-pane fade show active"
            role="tabpanel"
            aria-labelledby="tab-seen"
          >
            <div class="card-header mob-v" role="tab" id="heading-seen">
              <h5 class="mb-0">
                <!-- Note: `data-parent` removed from here -->
                <a
                  data-toggle="collapse"
                  href="#collapse-seen"
                  aria-expanded="true"
                  aria-controls="collapse-seen"
                >
                  SEENS
                </a>
              </h5>
            </div>

            <!-- Note: New place of `data-parent` -->
            <div
              id="collapse-seen"
              class="collapse show"
              data-parent="#content"
              role="tabpanel"
              aria-labelledby="heading-seen"
            >
              <div v-if="profile.seen">
                <div class="card-body">
                  <div class="row">
                    <div
                      v-for="(snap, index) in profile.seen"
                      :key="index"
                      class="col-lg-4 col-md-6 pl-3 pr-3 mb-4"
                    >
                      <a class="seen-post-img" :href="`${asset}/snaps/edit/${snap.id}`">
                        <template v-if="snap.media">
                          <div
                            v-if="snap.media[0]"
                            :style="`background-image: url(${encodeURI(snap.media[0].path)})`"
                            class="seen-post-bg-img"
                          ></div>
                        </template>
                        <div v-else>
                          <img
                            :src="`${asset}/assets/images/seen-p-1.png`"
                            class="img-fluid"
                            alt=""
                          />
                        </div>
                      </a>
                    </div>
                  </div>
                  <div
                    class="col-md-12 text-center mt-5"
                    id="load_more"
                    v-if="profile.seen.length < profile.totalSnaps"
                  >
                    <a
                      href="javascript:void(0)"
                      @click="getSnaps()"
                      class="btn loadmore-btn loadmore-snaps"
                    >
                      Load more +</a
                    >
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="card-body">
                  <a class="card-box" href="/snaps/create">
                    <span class="icon-img"
                      ><img :src="`${asset}/assets/images/image.svg`" alt=""
                    /></span>
                    <b
                      >Upload your <br />
                      first SEEN</b
                    >
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div
            id="pane-moodboard"
            class="card tab-pane fade"
            role="tabpanel"
            aria-labelledby="tab-moodboard"
          >
            <div class="card-header mob-v" role="tab" id="heading-moodboard">
              <h5 class="mb-0">
                <a
                  class="collapsed"
                  data-toggle="collapse"
                  href="#collapse-moodboard"
                  aria-expanded="false"
                  aria-controls="collapse-moodboard"
                >
                  MOODBOARDS
                </a>
              </h5>
            </div>
            <div
              id="collapse-moodboard"
              class="collapse mob-v"
              data-parent="#content"
              role="tabpanel"
              aria-labelledby="heading-moodboard"
            >
              <div v-if="profile.moodboard" class="categorie-box-section bg-dark p-0">
                <div class="card-body">
                  <div class="row">
                    <div
                      v-for="(moodsnap, index) in profile.moodboard"
                      :key="index"
                      class="col-md-4"
                    >
                      <a
                        class="img-card-box"
                        :href="`${asset}/search?category_id=${moodsnap.category.id}`"
                      >
                        <div class="img-group">
                          <div class="full-img">
                            <template v-if="moodsnap.media">
                              <div
                                class="post-bg-img"
                                :style="`background-image: url(${encodeURI(moodsnap.media[0].path)})`"
                              ></div>
                            </template>
                          </div>
                        </div>
                        <div class="img-caption">
                          {{ moodsnap.category.display_name }}
                          <i class="icon-icon_nav_right"></i>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div
                    class="col-md-12 text-center mt-5"
                    v-if="profile.moodboard.length < profile.totalMoodboards"
                  >
                    <a
                      href="javascript:void(0)"
                      @click="getMoodboards()"
                      class="btn loadmore-btn loadmore-moodboards"
                    >
                      Load more +</a
                    >
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="card-body">
                  <a class="card-box" :href="`${asset}`">
                    <span class="icon-img"
                      ><img :src="`${asset}/assets/images/moonboards-icon.svg`" alt=""
                    /></span>
                    <b
                      >Find projects to <br />
                      create your first <br />Moodboard
                    </b>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div
            id="pane-packages"
            class="card tab-pane u-profile-packeges fade"
            role="tabpanel"
            aria-labelledby="tab-packages"
          >
            <div class="card-header mob-v" role="tab" id="heading-packages">
              <h5 class="mb-0">
                <a
                  class="collapsed"
                  data-toggle="collapse"
                  href="#collapse-packages"
                  aria-expanded="false"
                  aria-controls="collapse-packages"
                >
                  PACKAGES
                </a>
              </h5>
            </div>
            <div
              id="collapse-packages"
              class="collapse mob-v"
              role="tabpanel"
              data-parent="#content"
              aria-labelledby="heading-packages"
            >
              <div v-if="profile.packages">
                <div class="card-body">
                  <div class="row equal-h">
                    <div
                      class="col-lg-4 col-md-6"
                      v-for="(userPackage, index) in profile.packages"
                      :key="index"
                    >
                      <div class="price-card-box">
                        <div class="packge-info-wrp">
                          <div :class="`pkg-nm ${userPackage.type}-border`">
                            {{ userPackage.type }} <br />
                            PACKAGE
                          </div>
                          <div class="pkg-rate">
                            <span>$</span>{{ userPackage.price }} <br />
                            <p class="txt-r">/{{ userPackage.per_price }}</p>
                          </div>
                        </div>

                        <div class="prmot-txt"></div>
                        <div class="pck-d-desc">
                          <p>{{ userPackage.description }}</p>
                        </div>
                        <hr class="cstm-gry-hr" />

                        <div class="sm-heading">Whats included?</div>

                        <ul class="list-ul">
                          {{
                            userPackage.includes
                          }}
                        </ul>
                        <hr class="cstm-gry-hr" />

                        <div class="btn-wrp-row">
                          <a
                            :href="`${asset}/settings/package#v-pills-${userPackage.type}-pkg`"
                            class="btn btn-dark w-100"
                            >Edit Package</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="card-body">
                  <a class="card-box" href="package-settings.html">
                    <span class="icon-img"
                      ><img :src="`${asset}/assets/images/packege-icon.svg`" alt=""
                    /></span>
                    <b
                      >Set up your <br />
                      packages</b
                    >
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div
            id="pane-reviews"
            class="card tab-pane fade"
            role="tabpanel"
            aria-labelledby="tab-reviews"
          >
            <div class="card-header mob-v" role="tab" id="heading-reviews">
              <h5 class="mb-0">
                <a
                  class="collapsed"
                  data-toggle="collapse"
                  href="#collapse-reviews"
                  aria-expanded="false"
                  aria-controls="collapse-reviews"
                >
                  REVIEWS
                </a>
              </h5>
            </div>
            <div
              id="collapse-reviews"
              class="collapse mob-v"
              role="tabpanel"
              data-parent="#content"
              aria-labelledby="heading-reviews"
            >
              <div class="card-body">
                <a class="card-box" href="javascript:void(0);">
                  <span class="icon-img"
                    ><img :src="`${asset}/assets/images/review-icon.svg`" alt=""
                  /></span>
                  <b
                    >You don’t have <br />
                    any reviews yet</b
                  >
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import * as methods from "../Common/helper";

export default {
  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {
    console.log("Component mounted.");
    this.getProfile();
  },

  data() {
    return {
      asset: "",
      snapPerPage: 3,
      moodboardPerPage: 3,
      profile: {
        userId: null,
        name: "",
        bio: "",
        profile_photo_full_path: "",
        followers: 0,
        followees: 0,
        likes: 0,
        seens: 0,
        seen: [],
        moodboard: [],
        packages: null,
        location: "",
        totalSnaps: 0,
        totalMoodboards: 0,
        snapUrl: "",
        moodboardUrl: ""
      },
    };
  },

  methods: {
    getProfile: function () {
      axios.get("/api/profile").then(
        function (response) {
          var profileDetail = response.data.data;
          this.profile.userId = profileDetail.id;
          this.profile.followers = profileDetail.followers;
          this.profile.followees = profileDetail.followees;
          this.profile.likes = profileDetail.likes;
          this.profile.seens = profileDetail.seens;
          this.profile.name = profileDetail.name;
          this.profile.profile_photo_full_path = profileDetail.profile_photo_full_path;
          this.profile.bio = profileDetail.bio;
          this.profile.location =
            profileDetail.city.name +
            ", " +
            profileDetail.city.state.name +
            ", " +
            profileDetail.city.state.country.name;

          this.profile.snapUrl =
            "/api/user/snapshots?perPage=9&page=1&user_id=" + this.profile.userId;
          this.profile.moodboardUrl =
            "/api/user/moodboards?perPage=9&page=1&user_id=" + this.profile.userId;

          this.getSnaps();
          this.getPackages();
          this.getMoodboards();
        }.bind(this)
      );
    },

    getSnaps: function () {
      axios.get(this.profile.snapUrl).then(
        function (response) {
          if (response.data.data.length !== 0) {
            for (let i = 0; i < response.data.data.length; i++) {
              this.profile.seen.push(response.data.data[i]);
            }
            if (parseInt(response.data.pagination.per_page) == this.snapPerPage) {
              var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            } else {
              var page = parseInt(response.data.pagination.per_page) / this.snapPerPage;
              var nextPage = parseInt(page) + parseInt(1);
            }
            this.profile.snapUrl =
              "/api/user/snapshots?perPage="+this.snapPerPage+"&page=" +
              nextPage +
              "&user_id=" +
              this.profile.userId;
            this.profile.totalSnaps = response.data.pagination.total;
          } else {
            $(".loadmore-snaps").remove();
          }
        }.bind(this)
      );
    },

    getPackages: function () {
      axios.get("/api/settings/packages").then(
        function (response) {
          this.profile.packages = response.data.data;
        }.bind(this)
      );
    },

    getMoodboards: function () {
      axios.get(this.profile.moodboardUrl).then(
        function (response) {
          if (response.data.data.length !== 0) {
            for (let i = 0; i < response.data.data.length; i++) {
              this.profile.moodboard.push(response.data.data[i]);
            }
            if (parseInt(response.data.pagination.per_page) == this.moodboardPerPage) {
              var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            } else {
              var page = parseInt(response.data.pagination.per_page) / this.moodboardPerPage;
              var nextPage = parseInt(page) + parseInt(1);
            }

            this.profile.moodboardUrl =
              "/api/user/moodboards?perPage="+this.moodboardPerPage+"&page=" +
              nextPage +
              "&user_id=" +
              this.profile.userId;
            this.profile.totalMoodboards = response.data.pagination.total;
          } else {
            $(".loadmore-moodboards").remove();
          }
        }.bind(this)
      );
    },
  },

  created: function () {},
};
</script>
