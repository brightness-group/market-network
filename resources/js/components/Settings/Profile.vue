<template>
  <div class="tab-innr-wrp bg-dark">
    <div class="container">
      <div id="content" class="tab-content" role="tablist">
        <div
          id="pane-submition"
          class="card tab-pane fade show active profile-setting-tab"
          role="tabpanel"
          aria-labelledby="tab-submition"
        >
          <div class="card-header mob-v" role="tab" id="heading-submition">
            <h5 class="mb-0">
              <a
                data-toggle="collapse"
                href="#collapse-submition"
                aria-expanded="true"
                aria-controls="collapse-submition"
              >
                submition
              </a>
            </h5>
          </div>

          <div
            id="collapse-submition"
            class="collapse show"
            data-parent="#content"
            role="tabpanel"
            aria-labelledby="heading-submition"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-lg-4 pr-3 pr-lg-0">
                  <div class="form-group">
                    <div class="upload-u-img">
                      <div class="img-big-wrp">
                        <!-- Cropper container -->
                        <div v-if="this.imageSrc" class="img-container">
                          <vue-cropper
                            class=""
                            ref="cropper"
                            :guides="true"
                            :src="imageSrc"
                            :autoCropArea="0.8"
                            :minContainerHeight="290"
                            :minCropBoxWidth="55"
                            :minCropBoxHeight="55"
                            :crop="cropImage"
                            :cropstart="cropImageStart"
                            :aspectRatio="1 / 1"
                            :viewMode="3"
                            :maximize="true"
                            :initialAspectRatio="1 / 1"
                          ></vue-cropper>
                        </div>
                        <div class="btn-wrp">
                          <label class="btn btn-dark btn-upload" for="inputImage"
                            >Change Image</label
                          >
                          <input
                            type="file"
                            name="image"
                            accept="image/*"
                            @change="setImage"
                            class="file-input"
                          />
                        </div>
                      </div>
                      <!-- Cropped image previewer -->
                      <div class="prev-img-small docs-preview">
                        <div class="img-preview preview-lg imgprev">
                          <img class="bg-light" :src="croppedImageSrc" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div
                      id="error_div"
                      class="col-md-12 error-text"
                      style="display: none; color: red; margin-bottom: 20px"
                    ></div>
                  </div>

                  <form action="" class="form-layout-view-style">
                    <div class="form-group">
                      <label for="titletxt" class="small-label">FULL NAME </label>
                      <input
                        v-model="form.name"
                        class="form-control"
                        type="text"
                        placeholder="FULL NAME"
                      />
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                      <small class="error-text d-none">validation Error text</small>
                    </div>
                    <div class="form-group">
                      <label for="" class="small-label">PROFESSION </label>
                      <select
                        v-model="form.profession_id"
                        class="form-control custom-select selectpicker"
                        title="Choose your profession"
                      >
                        <option
                          v-for="(profession, index) in professionsDetails"
                          :key="index"
                          :value="profession.id"
                          :selected="profession.id == form.profession_id"
                        >
                          {{ profession.name }}
                        </option>
                      </select>
                      <small class="validation-info correct-icon d-none"></small>
                      <span class="mendetory-dot"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                      <small class="error-text d-none">validation Error text</small>
                    </div>
                    <div class="form-group">
                      <label for="emailaddress" class="small-label">EMAIL ADDRESS </label>
                      <input
                        v-model="form.email"
                        class="form-control"
                        type="email"
                        placeholder="EMAIL ADDRESS"
                      />
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                      <small class="error-text d-none">validation Error text</small>
                    </div>
                    <div class="form-group">
                      <label for="abtself" class="small-label">BIO </label>
                      <textarea
                        v-model="form.bio"
                        placeholder="BIO"
                        class="form-control cstm-text-area"
                      ></textarea>
                      <small class="validation-info correct-icon"></small>
                      <span class="mendetory-dot d-none"
                        ><i class="icon-icon_form_required"></i
                      ></span>
                      <small class="error-text d-none">validation Error text</small>
                    </div>
                    <div class="form-group">
                      <label for="abtself" class="small-label">LOCATION </label>
                      <select
                        v-model="form.city_id"
                        class="form-control custom-select selectpicker location-select"
                        id=""
                        title="Location"
                      >
                        <option
                          class="location-icon"
                          v-for="(city, locationIndex) in citiesDetails"
                          :key="locationIndex"
                          :value="city.id"
                          :selected="city.id === form.city_id"
                        >
                          {{ city.name }}, {{ city.state.name }},
                          {{ city.state.country.name }}
                        </option>
                      </select>
                      <small class="validation-info correct-icon d-none"></small>
                      <small class="validation-info incorrect-icon d-none"
                        ><img :src="`${asset}/assets/images/icon_close_2.svg`" alt=""
                      /></small>
                    </div>
                    <div class="form-group">
                      <label for="clbrtion" class="small-label">LINKED ACCOUNTS </label>
                      <ul class="social-media-links-textbox list-unstyled">
                        <li>
                          <div class="icon-b"><i class="fab fa-facebook-f"></i></div>
                          <div class="custom-control-text">
                            <input
                              v-model="form.facebook"
                              class="custom-form-control"
                              type="text"
                            />
                            <small class="validation-info correct-icon d-none"></small>
                            <small class="validation-info incorrect-icon d-none"></small>
                            <small class="error-text d-none">validation Error text</small>
                          </div>
                        </li>

                        <li>
                          <div class="icon-b"><i class="fab fa-twitter"></i></div>

                          <div class="custom-control-text">
                            <input
                              v-model="form.twitter"
                              class="custom-form-control"
                              type="text"
                            />
                            <small class="validation-info correct-icon d-none"></small>
                            <small class="validation-info incorrect-icon d-none"></small>
                            <small class="error-text d-none">validation Error text</small>
                          </div>
                        </li>

                        <li>
                          <div class="icon-b"><i class="fab fa-instagram"></i></div>
                          <div class="custom-control-text">
                            <input
                              v-model="form.instagram"
                              class="custom-form-control"
                              type="text"
                            />
                            <small class="validation-info correct-icon d-none"></small>
                            <small class="validation-info incorrect-icon d-none"></small>
                            <small class="error-text d-none">validation Error text</small>
                          </div>
                        </li>

                        <li>
                          <div class="icon-b"><i class="fab fa-youtube"></i></div>
                          <div class="custom-control-text">
                            <input
                              v-model="form.youtube"
                              class="custom-form-control"
                              type="text"
                            />
                            <small class="validation-info correct-icon d-none"></small>
                            <small class="validation-info incorrect-icon d-none"></small>
                            <small class="error-text d-none">validation Error text</small>
                          </div>
                        </li>

                        <li>
                          <div class="icon-b"><i class="fab fa-behance"></i></div>
                          <div class="custom-control-text">
                            <input
                              v-model="form.behance"
                              class="custom-form-control"
                              type="text"
                            />
                            <small class="validation-info correct-icon d-none"></small>
                            <small class="validation-info incorrect-icon d-none"></small>
                            <small class="error-text d-none">validation Error text</small>
                          </div>
                        </li>
                      </ul>
                    </div>

                    <div class="row">
                      <div class="col-md-12 btn-sm-grp">
                        <a
                          href="#"
                          class="btn btn-outline-dark mb-3 mb-md-0"
                          @click="saveProfile()"
                          :disabled="saveDisabled"
                          ><span v-if="!loading">View Profile</span
                          ><span v-else
                            ><i class="fas fa-spinner"></i> View Profile</span
                          ></a
                        >

                        <a href="#invitePeopleModal" data-toggle="modal" class="btn btn-dark" :disabled="true"
                          >Invite People</a
                        >
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Invite People  Modal -->
    <div class="modal fade invite-people-modal" id="invitePeopleModal" tabindex="-1" role="dialog" aria-labelledby="invitePeopleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                  <div class="title-bar">
                      <h2 class="heading">INVITE SOME COOL PEOPLE</h2>
                      <p class="sub-title">Invite people to help Seen grow.</p>
                  </div>
                  <p class="p-text">
                    Invite as many people as you want, simply separate their email addresses with commas.
                  </p>
                  <form action="" class="form-layout-view-style">
                    <div
                      v-show="invite_error"
                      id="invite_error_div"
                      class="col-md-12 error-text"
                      style="color: red; margin-bottom: 20px"
                    ></div>
                    <div v-show="invite_success" id="success_div" style="margin-bottom: 20px"></div>
                    <div class="from-group">
                      <textarea name="invite_emails" class="cstm-textarea" placeholder="Enter email addresses" id="invite_emails" v-model="invite_user_form.invite_emails" ></textarea>
                    </div>
                    <div class="from-group">
                      <div class="btn-wrap">
                        <a href="javascript:void(0);" @click="invitePeople()" :disabled="saveDisabled" class="btn light-btn-gray">
                          <span v-if="!loading">Invite</span>
                          <span v-else><i class="fas fa-spinner"></i> Invite</span>
                        </a>
                        <a href="#" class="btn btn-dark"  data-dismiss="modal" aria-label="Close">Cancel</a>
                    </div>
                    </div>
                  </form>                  
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import * as methods from "../Common/helper";
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";

export default {
  props: [],

  components: {
    VueCropper,
  },

  mounted() {
    console.log("Component mounted.");
  },

  beforeMount() {
    this.asset = methods.asset();
    this.getProfile();
  },

  data() {
    return {
      asset: "",
      loading: false,
      upload: false,
      saveDisabled: false,
      invite_error: false,
      invite_success: false,
      imageSrc: "",
      croppedImageSrc: "",
      profileDetails: [],
      citiesDetails: [],
      professionsDetails: [],
      form: {
        name: "",
        profession_id: "",
        email: "",
        bio: "",
        city_id: "",
        facebook: "",
        twitter: "",
        instagram: "",
        youtube: "",
        behance: "",
      },
      invite_user_form : {
        invite_emails:'',
      }
    };
  },

  methods: {
    setImage: function (e) {
      const file = e.target.files[0];
      if (!file.type.includes("image/")) {
        alert("Please select an image file");
        return;
      }
      if (typeof FileReader === "function") {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.imageSrc = event.target.result;

          // Rebuild cropperjs with the updated source
          this.$refs.cropper.replace(event.target.result);
        };
        reader.readAsDataURL(file);
      } else {
        alert("Sorry, FileReader API not supported");
      }
    },
    cropImageStart() {
      this.upload = true;
    },
    cropImage() {
      // Get image data for post processing, e.g. upload or setting image src
      this.croppedImageSrc = this.$refs.cropper.getCroppedCanvas().toDataURL();
    },
    uploadImage() {
      // check if image is updated or not. If image is cropped, upload it to server
      if (this.upload == true) {
        this.$refs.cropper.getCroppedCanvas().toBlob(function (blob) {
          let formData = new FormData();
          // Add name for our image
          formData.append("name", "image-name-" + new Date().getTime());
          // Append image file
          formData.append("avatar", blob);
          axios
            .post("/api/settings/upload", formData)
            .then((response) => {
              console.log(response.data);
            })
            .catch(function (error) {
              console.log(error);
            });
        });
      }
    },

    getProfile: function () {
      axios.get("/api/profile-details").then((response) => {
        this.profileDetails = response.data.data.profile;
        this.citiesDetails = response.data.data.cities;
        this.professionsDetails = response.data.data.professions;

        this.form.name = this.profileDetails.name;
        this.form.profession_id = this.profileDetails.profession_id;
        this.form.email = this.profileDetails.email;
        this.form.bio = this.profileDetails.bio;
        this.form.city_id = this.profileDetails.city_id;

        this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });

        if (this.profileDetails.facebook !== null) {
          this.form.facebook = this.profileDetails.facebook;
        }
        if (this.profileDetails.twitter !== null) {
          this.form.twitter = this.profileDetails.twitter;
        }
        if (this.profileDetails.instagram !== null) {
          this.form.instagram = this.profileDetails.instagram;
        }
        if (this.profileDetails.youtube !== null) {
          this.form.youtube = this.profileDetails.youtube;
        }
        if (this.profileDetails.behance !== null) {
          this.form.behance = this.profileDetails.behance;
        }
        this.imageSrc = this.profileDetails.profile_photo_full_path;
        this.croppedImageSrc = this.profileDetails.profile_photo_full_path;

        if (this.imageSrc == "") {
          this.imageSrc = this.asset + "/assets/images/image-upload-size.png";
          this.croppedImageSrc = this.asset + "/assets/images/image-upload-size.png";
        }
      });
    },

    saveProfile() {
      // Upload profile image
      this.uploadImage();

      this.loading = true;
      this.saveDisabled = true;
      axios
        .post("/api/settings/profile", this.form)
        .then((response) => {
          this.loading = false;
          this.saveDisabled = false;
          $("#error_div").hide();
          console.log(response.data);
          if (response.data.status == 200) {
            window.location.href = this.asset + "/profile";
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
    },

    invitePeople() {
      var successObj = [];
      this.loading = true;
      this.saveDisabled = true;
      axios
        .post("/api/invite-user", this.invite_user_form)
        .then((response) => {
          this.loading = false;
          this.saveDisabled = false;
          this.invite_error = false;
          this.invite_success = true;
          console.log(response.data);
          if (response.data.status == 200) {
            successObj.push(response.data.message);
            $("#success_div").html(successObj);
            this.invite_user_form.invite_emails = '';
          }
        })
        .catch((err) => {          
          this.invite_error = true;
          this.invite_success = false;
          if (err.response) {
            var errors = err.response.data.data.errors;
            var errorObj = [];

            for (const [key, value] of Object.entries(errors)) {
              errorObj.push(`${value}`);
              errorObj.push("<br />");
            }
            $("#invite_error_div").html(errorObj);
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

  created: function () {},
};
</script>
