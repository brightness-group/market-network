<template>
	<section class="following-section tab-accordion-style pb-0">
            <div class="container">
                <div class="tab-wrp">
                    <ul id="tabs" class="nav nav-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a id="tab-following" href="#pane-following" class="nav-link active" data-toggle="tab" role="tab">FOLLOWING</a>
                        </li>
                        <li class="nav-item">
                            <a id="tab-followers" href="#pane-followers" class="nav-link" data-toggle="tab" role="tab">FOLLOWERS</a>
                        </li>
                        <li class="nav-item">
                            <a id="tab-shortlist" href="#pane-shortlist" class="nav-link" data-toggle="tab" role="tab"> SHORTLIST</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="tab-innr-wrp bg-dark">
                <div class="container">
                    <div id="content" class="tab-content" role="tablist">
                        <div id="pane-following" class="card tab-pane fade show active profile-setting-tab" role="tabpanel" aria-labelledby="tab-following">
                            <div class="card-header mob-v" role="tab" id="heading-following">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" href="#collapse-following" aria-expanded="true" aria-controls="collapse-following">
                                        FOLLOWING
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse-following" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-following">
                                <div class="card-body">
                                    <div class="row">
                                        <div v-for="(followee, index) in followeesData" :key="index" class="col-lg-4 col-md-6">
                                            <div class="card-box" :id="`followee${followee.id}`">
                                                <div class="top-detail-wrap">
                                                    <div class="left-info-wrap">
                                                        <a href="#" class="user-img-wrap">
                                                            <div :style="`background-image: url('${asset}/assets/images/Profile-Picture-3.png');`" class="user-img"></div>
                                                        </a>
                                                    </div>
                                                    <div class="right-info-wrap">
                                                        <div class="user-detail-wrap">
                                                            <div class="star-rating">
                                                                <div class="rateit svg" data-rateit-starwidth="14" data-rateit-starheight="14"></div>
                                                            </div>
                                                            <div class="user-nm ">{{ followee.name }}</div>
                                                            <div class="user-profile-nm">{{ followee.profession.name }}</div>
                                                            <div class="btn-group-row" :id="`followee_${followee.id}`">
                                                                <a href="javascript:void(0)" class="btn btn-dark" 
																@mouseover="hover = index" @mouseleave="hover = false">
                                                                    <span v-if="hover === index" class="unfollower-text-wrp" @click="unfollow(followee.id, 'followee', 0)"><i class="btn-icon incorrect-icon"></i> Unfollow</span>
                                                                    <span v-else class="following-text-wrp"> <i class="btn-icon correct-icon"></i> Following</span>
                                                                </a>
                                                                <a href="#" class="btn btn-gray ">
                                                                    <span class="text-wrp"><i class="btn-icon message-icon"></i>    Message</span>
                                                                </a>
                                                            </div>
                                                            <div class="btn-group-row" :id="`follow_followee_${followee.id}`" style="display:none;">
                                                                <a href="javascript:void(0)" class="btn btn-dark" >
                                                                    <span class="follower-text-wrp" @click="follow(followee.id, 'followee', 1)"><i class="btn-icon correct-icon"></i> Follow</span>
                                                                </a>
                                                                <a href="#" class="btn btn-gray ">
                                                                    <span class="text-wrp"><i class="btn-icon message-icon"></i>    Message</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="snap-image-wrap three-img" v-if="followee.snapshots" >
                                                    <div v-for="(snapshot, snapshotIndex) in followee.snapshots.slice(0, 3)" :key="snapshotIndex" class="snap-bg-img" :style="`background-image: url('${snapshot.media[0].path}');`"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="followeesData.length < totalFollowees">
                                        <div class="col-md-12 text-center mt-3" id="load_more_followees">
                                            <a href="javascript:void(0)"  @click="getFollowees()" class="btn loadmore-btn"> Load more +</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pane-followers" class="card tab-pane fade followers-tab" role="tabpanel" aria-labelledby="tab-followers">
                            <div class="card-header mob-v" role="tab" id="heading-followers">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapse-followers" aria-expanded="false" aria-controls="collapse-followers">
                                        FOLLOWERS
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse-followers" class="collapse mob-v" data-parent="#content" role="tabpanel" aria-labelledby="heading-followers">
                                <div class="card-body">
                                    <div class="row">
										<div v-for="(follower, index) in followersData" :key="index" class="col-lg-4 col-md-6">
                                            <div class="card-box" :id="`follower_${follower.id}`">
                                                <div class="top-detail-wrap">
                                                    <div class="left-info-wrap">
                                                        <a href="#" class="user-img-wrap">
                                                            <div :style="`background-image: url('${asset}/assets/images/Profile-Picture-3.png');`" class="user-img"></div>
                                                        </a>
                                                    </div>
                                                    <div class="right-info-wrap">
                                                        <div class="user-detail-wrap">
                                                            <div class="star-rating">
                                                                <div class="rateit svg" data-rateit-starwidth="14" data-rateit-starheight="14"></div>
                                                            </div>
                                                            <div class="user-nm ">{{ follower.name }}</div>
                                                            <div class="user-profile-nm">{{ follower.profession.name }}</div>
                                                            <div class="btn-group-row" :id="`follower_${follower.id}`" >
                                                                <a href="javascript:void(0)" class="btn btn-dark" 
																@mouseover="hover = index" @mouseleave="hover = false" :id="`a_${follower.id}`" >
                                                                    <span v-if="hover === index" class="unfollower-text-wrp "  @click="unfollow(follower.id, 'follower', 0)"> <i class="btn-icon incorrect-icon"></i> Unfollow</span>
                                                                    <span v-else class="following-text-wrp"> <i class="btn-icon correct-icon"></i> Following</span>
                                                                </a>
                                                                <a href="#" class="btn btn-gray ">
                                                                    <span class="text-wrp"><i class="btn-icon message-icon"></i>    Message</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="snap-image-wrap three-img" v-if="follower.snapshots" >
                                                    <div v-for="(snapshot, snapshotIndex) in follower.snapshots.slice(0, 3)" :key="snapshotIndex" class="snap-bg-img" :style="`background-image: url('${snapshot.media[0].path}');`"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="(followersData.length < totalFollowers)">
                                        <div class="col-md-12 text-center mt-3" id="load_more_followers">
                                            <a href="javascript:void(0)"  @click="getFollowers()" class="btn loadmore-btn"> Load more +</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="pane-shortlist" class="card tab-pane fade shortlist-tab" role="tabpanel" aria-labelledby="tab-shortlist">
                            <div class="card-header mob-v" role="tab" id="heading-shortlist">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapse-shortlist" aria-expanded="false" aria-controls="collapse-shortlist">
                                        SHORTLIST
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse-shortlist" class="collapse mob-v" role="tabpanel" data-parent="#content" aria-labelledby="heading-shortlist">
                                <div class="card-body">
                                    <div class="row">
                                        <div v-for="(shortlist, index) in shortlistsData" :key="index" class="col-lg-4 col-md-6">
                                            <div class="card-box" :id="`shortlist_${shortlist.id}`">
                                                <div class="top-detail-wrap">
                                                    <div class="left-info-wrap">
                                                        <a href="#" class="user-img-wrap">
                                                            <div :style="`background-image: url('${asset}/assets/images/Profile-Picture-3.png');`" class="user-img"></div>
                                                        </a>
                                                    </div>
                                                    <div class="right-info-wrap">
                                                        <div class="user-detail-wrap">
                                                            <div class="star-rating">
                                                                <div class="rateit svg" data-rateit-starwidth="14" data-rateit-starheight="14"></div>
                                                            </div>
                                                            <div class="user-nm ">{{ shortlist.name }}</div>
                                                            <div class="user-profile-nm">{{ shortlist.profession.name }}</div>
                                                            <div class="btn-group-row">
                                                                <a href="javascript:void(0);" class="btn btn-dark" :id="`a_shortlist_${shortlist.id}`" >
                                                                    <span class="unfollower-text-wrp" @click="removeShortlist(shortlist.id, 1)"> <i class="btn-icon incorrect-icon"></i> Remove</span></a>
                                                                <a href="#" class="btn btn-gray ">
                                                                    <span class="text-wrp"><i class="btn-icon message-icon"></i>    Message</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="snap-image-wrap three-img" v-if="shortlist.snapshots" >
                                                    <div v-for="(snapshot, snapshotIndex) in shortlist.snapshots.slice(0, 3)" :key="snapshotIndex" class="snap-bg-img" :style="`background-image: url('${snapshot.media[0].path}');`"></div>
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

    </section>

</template>
<script>
    import * as methods from '../Common/helper';

    export default {
	
            components: {
            },

			beforeMount() {
				this.asset = methods.asset();
			},

	        mounted() {
				this.getFollowDetails()
	        },
	
	        data() {
	            return {
					asset: '',
                    hover: false,
					followersData: [],
					followeesData: [],
					shortlistsData: [],
					userDetails: [],
                    loading: false,
                    saveDisabled: false,
                    totalFollowees: 0,
                    totalFollowers: 0,
                    followeeUrl: "/api/followee?perPage=3&page=2",
                    followerUrl: "/api/follower?perPage=3&page=2",
                    form: {
                        newsletter : {
                            email: null
                        }
                    }
	            }
	        },
	
	        methods: {
				getFollowDetails: function () {
                    axios.get('/api/user_follow')
	                    .then(function (response) {                 
	                        var resData = response.data.data;
                            var followersRes = resData.followers;
                            var followeesRes = resData.followees;
                            var shortlistsRes = resData.shortlists;
                            this.userDetails = resData.user.data;
                            for (let i = 0; i < followersRes.data.length; i++) {
                                this.followersData.push(followersRes.data[i]);
                            }

                            for (let i = 0; i < followeesRes.data.length; i++) {
                                this.followeesData.push(followeesRes.data[i]);
                            }

                            for (let i = 0; i < shortlistsRes.data.length; i++) {
                                this.shortlistsData.push(shortlistsRes.data[i]);
                            }
                            this.totalFollowees = resData.followees.total;
                            this.totalFollowers = resData.followers.total;
                            
	                    }.bind(this));
				},

                unfollow(id, type, isFollow) {
                    const data = {};
	                data['id'] = id;
	                data['type'] = type;
	                data['is_follow'] = isFollow;
	                axios.post('/api/follow', data)
                        .then((response) => {
                            if (type === 'followee') {
                                $("#"+type+"_"+id).hide();
                                $("#follow_"+type+"_"+id).show(); 
                            } 
                            if (type === 'follower') {
                                $("#a_"+id).addClass("btn btn-dark disabled");
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

                follow(id, type, isFollow) {
                    const data = {};
	                data['id'] = id;
	                data['type'] = type;
	                data['is_follow'] = isFollow;
	                axios.post('/api/follow', data)
                        .then((response) => {
                            $("#follow_"+type+"_"+id).hide();         
                            $("#"+type+"_"+id).show();
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

                removeShortlist(id, isDelete) {
                    const data = {};
	                data['id'] = id;
	                data['is_delete'] = isDelete;
	                axios.post('/api/shortlist', data)
	                    .then(function (response) {
                            $("#a_shortlist_"+id).addClass("btn btn-dark disabled");
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

                getFollowees: function () {
                    axios.get(this.followeeUrl).then(
                        function (response) {
                            if (response.data.data.length !== 0) {
                                for (let i = 0; i < response.data.data.length; i++) {
                                this.followeesData.push(response.data.data[i]);
                                }
                                var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
                                this.followeeUrl =
                                "/api/followee?perPage=" +
                                response.data.pagination.per_page +
                                "&page=" +
                                nextPage;
                                this.totalFollowees = response.data.pagination.total;
                            } else {
                                $("#load_more_followees").remove();
                            }
                        }.bind(this)
                    );
                },
                
                getFollowers: function () {
                    axios.get(this.followerUrl).then(
                        function (response) {
                            if (response.data.data.length !== 0) {
                                for (let i = 0; i < response.data.data.length; i++) {
                                this.followersData.push(response.data.data[i]);
                                }
                                var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
                                this.followerUrl =
                                "/api/follower?perPage=" +
                                response.data.pagination.per_page +
                                "&page=" +
                                nextPage;
                                this.totalFollowers = response.data.pagination.total;
                            } else {
                                $("#load_more_followers").remove();
                            }
                        }.bind(this)
                    );
                },
	        },
	    }
</script>
