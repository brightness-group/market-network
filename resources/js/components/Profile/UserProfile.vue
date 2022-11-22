<template>
  <section class="profile-deatil-section user-profile-front-snap">
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
                          <div class="rateit svg" data-rateit-starwidth="24" data-rateit-starheight="24"></div>
                          <span class="star-counter"> 0</span>
                      </div>
                      <h1 class="heading">{{ profile.name }}</h1>
                      <p class="desig-txt">{{ profile.profession }}</p>

                      <p class="location-txt"> <span><i class="icon-icon_location"></i></span> {{ profile.location }}
                      </p>
                      <p class="p-txt">{{ profile.bio }}</p>

                      <ul class="nav-list list-unstyled">
                          <li>
                              <a href="#">
                                  {{ profile.seens }} <b>seen</b> <span class="icon-img"><img :src="asset+'/assets/images/image.svg'"
                                          alt=""></span>
                              </a>

                          </li>
                          <li>
                              <a href="#">{{ profile.followees }} <b>FOLLOWING</b> <span class="icon-img"><img
                                          :src="asset+'/assets/images/user-add.svg'" alt=""></span></a>
                          </li>
                          <li>
                              <a href="#">{{ profile.followers }} <b>FOLLOWERS</b> <span class="icon-img"><img
                                          :src="asset+'/assets/images/user-checked.svg'" alt=""></span></a>

                          </li>
                          <li>
                              <a href="#"> {{ profile.likes }} <b>LOVE</b> <span class="icon-img"><img :src="asset+'/assets/images/heart.svg'"
                                          alt=""></span> </a>

                          </li>
                      </ul>

                      <div class="btn-navs">
                          <div class="md-btn-groups">
                              <div class="btn-group-row d-flex">  
                                  <a href="javascript:void(0)" class="btn btn-outline-dark  mb-0 mb-md-3 mr-1 mr-lg-3 mr-md-3 " @click="follow(userId, 'followee')" > {{ followText }} </a>
                                  <a href="javascript:void(0)" class="btn btn-dark mb-0 mb-md-3" @click="shortlist(userId)"> <span class="btn-icon"><img :src="asset+'/assets/images/shortlist.svg'" alt=""> </span> {{ shortlistText }} </a>
                              </div>
                          </div>
                          <div class="sm-icon-btn-groups">
                              <ul class="btn-list">
                                  <li>
                                      <a href="#" class="btn btn-sm btn-light"><img :src="asset+'/assets/images/icon_message.svg'" alt=""></a>
                                  </li>
                                  <li>
                                      <a href="#" class="btn btn-sm btn-light"><img :src="asset+'/assets/images/share.svg'" alt=""></a>
                                  </li>
                                  <li>

                                      <div class="dropdown">
                                          <button class="btn btn-sm btn-light  dropdown-toggle" type="button" id="dropbtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <img :src="asset+'/assets/images/dot-bar.svg'" alt="">
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropbtn">
                                              <a class="dropdown-item" href="#">Block Account</a>
                                              <a class="dropdown-item" href="#">Report Account</a>
                                          </div>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>

  </section>

  <section class="profile-d-tab-section">
      <div class="container">
          <ul id="tabs" class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                  <a id="tab-seen" href="#pane-seen" class="nav-link active" data-toggle="tab" role="tab">SEENS</a>
              </li>
              <li class="nav-item">
                  <a id="tab-moodboard" href="#pane-moodboard" class="nav-link" data-toggle="tab" role="tab">MOODBOARDS</a>
              </li>
              <li class="nav-item">
                  <a id="tab-packages" href="#pane-packages" class="nav-link" data-toggle="tab" role="tab">PACKAGES</a>
              </li>
              <li class="nav-item">
                  <a id="tab-reviews" href="#pane-reviews" class="nav-link" data-toggle="tab" role="tab">REVIEWS</a>
              </li>
          </ul>
      </div>
      <div class="bg-dark tab-innr-wrp">
          <div class="container">

              <div id="content" class="tab-content" role="tablist">
                  <div id="pane-seen" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-seen">
                      <div class="card-header mob-v" role="tab" id="heading-seen">
                          <h5 class="mb-0">
                              <!-- Note: `data-parent` removed from here -->
                              <a data-toggle="collapse" href="#collapse-seen" aria-expanded="true" aria-controls="collapse-seen">
                                  SEENS
                              </a>
                          </h5>
                      </div>

                      <!-- Note: New place of `data-parent` -->
                      <div v-if="profile.seen" id="collapse-seen" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-seen">
                          <div class="card-body">
                              <div class="row">
                                  <div v-for="(snap, index) in profile.seen" :key="index" class="col-lg-4 col-md-6 pl-3 pr-3 mb-4">
                                    <a class="seen-post-img" :href="`${asset}/snaps/${snap.slug}`">
                                      <template  v-if="snap.media">                         
                                            <div v-if="snap.media[0]" :style="`background-image: url(${snap.media[0].path})`" class="seen-post-bg-img"></div>
                                      </template>
                                    </a>
                                  </div>
                              </div>
                              <div class="col-md-12 text-center mt-5" v-if="profile.seen.length < profile.totalSnaps">
                                  <a href="javascript:void(0)" 
                                      @click="getSnapsById()" 
                                      class="btn loadmore-btn loadmore-snaps"> Load more +</a>
                              </div>

                          </div>
                      </div>
                  </div>

                  <div id="pane-moodboard" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-moodboard">
                      <div class="card-header mob-v" role="tab" id="heading-moodboard">
                          <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapse-moodboard" aria-expanded="false" aria-controls="collapse-moodboard">
                                  MOODBOARDS
                              </a>
                          </h5>
                      </div>
                      <div id="collapse-moodboard" class="collapse mob-v" data-parent="#content" role="tabpanel" aria-labelledby="heading-moodboard">
                          <div class="card-body">
                              <a class="card-box d-none" href="javascript:void(0);">
                                  <span class="icon-img"><img :src="asset+'/assets/images/moonboards-icon.svg'"
                                          alt=""></span>
                                  <b>Find projects to <br> create your first <br>Moodboard </b>
                              </a>
                              <div class="categorie-box-section bg-dark p-0" v-if="profile.moodboard">
                                  <div class="row">
                                      <div class="col-md-4" v-for="(moodsnap, index) in profile.moodboard" :key="index">
                                          <a class="img-card-box" :href="`${ asset }/search?category_id=${moodsnap.category.id}`">
                                              <div class="img-group">
                                                <div class="full-img">
                                                  <template  v-if="moodsnap.media">
                                                    <div class="post-bg-img" :style="`background-image: url(${moodsnap.media[0].path})`"></div>
                                                  </template> 
                                                </div>
                                              </div>
                                              <div class="img-caption">{{ moodsnap.category.display_name }} <i class="icon-icon_nav_right"></i> </div>
                                          </a>
                                      </div>

                                  </div>
                                  <div class="col-md-12 text-center mt-5" v-if="profile.moodboard.length < profile.totalMoodboards">
                                      <a href="javascript:void(0)"
                                        @click="getMoodboardsById()"
                                        class="btn loadmore-btn loadmore-moodboards"> Load more +</a>
                                  </div>
                              </div>


                          </div>
                      </div>
                  </div>

                  <div id="pane-packages" class="card tab-pane fade u-profile-packeges" role="tabpanel" aria-labelledby="tab-packages">
                      <div class="card-header mob-v" role="tab" id="heading-packages">
                          <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapse-packages" aria-expanded="false" aria-controls="collapse-packages">
                                  PACKAGES
                              </a>
                          </h5>
                      </div>
                      <div id="collapse-packages" class="collapse mob-v" role="tabpanel" data-parent="#content" aria-labelledby="heading-packages">
                          <div class="card-body">
                              <div class="row equal-h">
                                  <div class="col-lg-4 col-md-6" v-for="(userPackage, index) in profile.packages" :key="index">
                                      <div class="price-card-box">
                                          <div class="packge-info-wrp">
                                              <div :class="`pkg-nm ${userPackage.type}-border`"> {{ userPackage.type }}  <br> PACKAGE</div>
                                              <div class="pkg-rate"> <span>$</span>{{ userPackage.price }} <br>
                                                  <p class="txt-r">/{{ userPackage.per_price }}</p>
                                              </div>
                                          </div>

                                          <div class="prmot-txt">

                                          </div>
                                          <div class="pck-d-desc">
                                              <p>{{ userPackage.description }}</p>
                                          </div>
                                          <hr class="cstm-gry-hr">

                                          <div class="sm-heading">Whats included?</div>

                                          <ul class="list-ul">
                                              {{ userPackage.includes }}
                                          </ul>
                                          <hr class="cstm-gry-hr">

                                          <div class="btn-wrp-row">
                                              <a href="#" class="btn btn-gray icons-btn-grp w-100 mb-3"> <span class="btn-comment-icon"></span> Start a Conversation</a>
                                              <a href="#" class="btn btn-dark w-100">Add to Cart</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div id="pane-reviews" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-reviews">
                      <div class="card-header mob-v" role="tab" id="heading-reviews">
                          <h5 class="mb-0">
                              <a class="collapsed" data-toggle="collapse" href="#collapse-reviews" aria-expanded="false" aria-controls="collapse-reviews">
                                  REVIEWS
                              </a>
                          </h5>
                      </div>
                      <div id="collapse-reviews" class="collapse mob-v" role="tabpanel" data-parent="#content" aria-labelledby="heading-reviews">
                          <div class="card-body">
                              <a class="card-box" href="javascript:void(0);">
                                  <span class="icon-img"><img :src="asset+'/assets/images/review-icon.svg'" alt=""></span>
                                  <b>You don’t have
                                      <br> any reviews yet</b>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section class="categorie-box-section">
      <div class="container">
          <div class="col-md-12 text-center">
              <h2 class="heading">FIND {{ profile.name }}’S WORK IN THESE CATEGORIES</h2>
          </div>
          <div class="row">
              <div class="col-md-4"  v-for="(snap, index) in profile.categorySeen" :key="index">
                  <a class="img-card-box" :href="`${ asset }/search?category_id=${snap.category.id}`">
                      <div class="img-group">
                        <div class="full-img">
                          <template v-if="snap.media">
                            <div class="post-bg-img" :style="`background-image: url(${snap.media[0].path})`"></div>
                          </template>
                        </div>
                      </div>
                      <div class="img-caption">{{ snap.category.display_name }}  <i class="icon-icon_nav_right"></i> </div>
                  </a>
              </div>
          </div>
      </div>
  </section>
</template>

<script>
import * as methods from "../Common/helper";

export default {
  props: ['user_id', 'user_uuid'],

  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {
    this.getProfileById();
    this.getSnapsById();
    this.getSnapsByUserCategory();
    this.getPackagesById();
    this.getMoodboardsById();
  },

  data() {
    return {
      asset: "",
      userId: "",
      uuid: "",
      userDetails: [],
      followText: '',
      shortlistText: '',
      profile: {
        isShortlisted: false,
        isFollowed: false,
        followers: 0,
        followees: 0,
        likes: 0,
        seens: 0,
        profession: "",
        bio: "",
        profile_photo_full_path: "",
        seen: [],
        categorySeen: [],
        moodboard: [],
        packages: null,
        location: "",
        totalSnaps: 0,
        totalMoodboards: 0,
        snapUrl: "/api/user/snapshots?perPage=9&page=1",
        moodboardUrl: "/api/user/moodboards?perPage=9&page=1",
      },
    };
  },

  methods: {
    getUserDetails: function () {
      if (this.user_id) {
        this.userId = JSON.parse(this.user_id);
        this.uuid = JSON.parse(this.user_uuid);
        this.profile.snapUrl = "/api/user/snapshots?perPage=9&page=1&user_id="+this.userId;
        this.profile.moodboardUrl = "/api/user/moodboards?perPage=9&page=1&user_id="+this.userId;
      }
    },
    getProfileById: function () {
      this.profile.snapUrl = "/api/user/snapshots?perPage=9&page=1&user_id="+this.userId;
      this.profile.moodboardUrl = "/api/user/moodboards?perPage=9&page=1&user_id="+this.userId;
      axios.get("/api/profile/"+this.uuid).then(
        function (response) {
          var profileDetail = response.data.data;
          this.profile.isShortlisted = profileDetail.is_shortlisted;
          this.profile.isFollowed = profileDetail.is_followed;
          this.profile.followers = profileDetail.followers;
          this.profile.followees = profileDetail.followees;
          this.profile.likes = profileDetail.likes;
          this.profile.seens = profileDetail.seens;
          this.profile.name = profileDetail.name;
          this.profile.profession = (profileDetail.profession) ? profileDetail.profession.name : '';
          this.profile.profile_photo_full_path = profileDetail.profile_photo_full_path;
          this.profile.bio = profileDetail.bio;
          this.followText = (profileDetail.is_followed) ? 'Unfollow' : 'Follow';
          this.shortlistText = (profileDetail.is_shortlisted) ? 'Remove Shortlist' : 'Shortlist';
          this.profile.location =
            profileDetail.city.name +
            ", " +
            profileDetail.city.state.name +
            ", " +
            profileDetail.city.state.country.name;
        }.bind(this)
      );
    },

    getSnapsById: function () {
      axios.get(this.profile.snapUrl).then(
        function (response) {
          if (response.data.data.length !== 0) {
            for (let i = 0; i < response.data.data.length; i++) {
              this.profile.seen.push(response.data.data[i]);
            }
            var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            this.profile.snapUrl =
              "/api/user/snapshots?perPage=3&page=" +
              nextPage + "&user_id="+this.userId;
            this.profile.totalSnaps = response.data.pagination.total;
          } else {
            $(".loadmore-snaps").remove();
          }
        }.bind(this)
      );
    },

    getSnapsByUserCategory: function () {
      axios.get("/api/user/categories?user_id="+this.userId).then(
        function (response) {
          if (response.data.data) {
            if (response.data.data.length !== 0) {
              for (let i = 0; i < response.data.data.length; i++) {
                this.profile.categorySeen.push(response.data.data[i]);
              }
            }
          }
        }.bind(this)
      );
    },

    getPackagesById: function () {
      axios.get("/api/user/packages/"+this.userId).then(
        function (response) {
          this.profile.packages = response.data.data;
        }.bind(this)
      );
    },

    getMoodboardsById: function () {
      axios.get(this.profile.moodboardUrl).then(
        function (response) {
          if (response.data.data.length !== 0) {
            for (let i = 0; i < response.data.data.length; i++) {
              this.profile.moodboard.push(response.data.data[i]);
            }
            var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            this.profile.moodboardUrl =
              "/api/user/moodboards?perPage=3&page=" + nextPage + "&user_id="+this.userId;
            this.profile.totalMoodboards = response.data.pagination.total;
          } else {
            $(".loadmore-moodboards").remove();
          }
        }.bind(this)
      );
    },

    follow(id, type) {
      const data = {};
      data['id'] = id;
      data['type'] = type;
      data['is_follow'] = (this.profile.isFollowed) ? 0 : 1;
      axios.post('/api/follow', data)
          .then((response) => {
            if (this.profile.isFollowed) {
              this.profile.isFollowed = false;
              this.followText = 'Follow';
            } else {
              this.profile.isFollowed = true;
              this.followText = 'Unfollow';
            }
          })
          .catch(err => {                        
              if (err.response) {
                if (err.request.status == 401) {
                  window.location.href = this.asset+"/login";
                }
              }
          })
          .finally();
    },

    shortlist(id) {
      const data = {};
      data['id'] = id;
      data['is_delete'] = (this.profile.isShortlisted) ? 0 : 1;
      axios.post('/api/shortlist', data)
          .then((response) => {
            if (this.profile.isShortlisted) {
              this.profile.isShortlisted = false;
              this.shortlistText = 'Shortlist';
            } else {
              this.profile.isShortlisted = true;
              this.shortlistText = 'Remove Shortlist';
            }
          })
          .catch(err => {                        
              if (err.response) {
                if (err.request.status == 401) {
                  window.location.href = this.asset+"/login";
                }
              }
          })
          .finally();

    },

  },

  created: function () {
		this.getUserDetails();
  },
};
</script>
