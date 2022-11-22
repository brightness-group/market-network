<template>
    <div class="bg-dark tab-innr-wrp">
      <div class="container">
        <div id="content" class="tab-content" role="tablist">
          <div
            id="pane-calender"
            class="card tab-pane fade show active calender-events-section"
            role="tabpanel"
            aria-labelledby="tab-calender"
          >
            <div class="card-header mob-v" role="tab" id="heading-calender">
              <h5 class="mb-0">
                <a
                  class="collapsed"
                  data-toggle="collapse"
                  href="#collapse-calender"
                  aria-expanded="false"
                  aria-controls="collapse-calender"
                >
                  calender
                </a>
              </h5>
            </div>
            <div
              id="collapse-calender"
              class="collapse mob-v"
              data-parent="#content"
              role="tabpanel"
              aria-labelledby="heading-calender"
            >
              <div class="card-body">
                <div class="row cstm-row">
                  <div class="col-md-4">
                    <div class="left-inner-wrap">
                      <form action="#" class="form-layout-view-style">
                        <div class="monthly-calender-block">
                          <vue-cal
                            :selected-date="selectedDate"
                            class="vuecal--rounded-theme vuecal--date-picker"
                            xsmall
                            :time="false"
                            hide-view-selector
                            events-count-on-year-view
                            active-view="month"
                            :disable-views="['week', 'day']"
                            @cell-click="selectedDate = $event"
                            :events="events"
                          >
                          </vue-cal>
                        </div>
                        <div class="seclect-categories-block">
                          <div class="heading">Categories</div>

                          <div class="form-group">
                            <div class="custom-control custom-checkbox deadline-icon">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="`deadline`"
                                :value="`${deadline}`"
                                v-model="deadline"
                                @change="getCalendarDetails('deadline')"
                              />
                              <label class="custom-control-label" for="deadline"
                                >Deadlines
                                <span class="counter"
                                  >({{ deadlinesCount }})</span
                                ></label
                              >
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="custom-control custom-checkbox meeting-icon">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="`meeting`"
                                :value="`${meeting}`"
                                v-model="meeting"
                                @change="getCalendarDetails('meeting')"
                              />
                              <label class="custom-control-label" for="meeting"
                                >Meetings
                                <span class="counter"
                                  >({{ meetingsCount }})</span
                                ></label
                              >
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="custom-control custom-checkbox events-icon">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="`event`"
                                :value="`${event}`"
                                v-model="event"
                                @change="getCalendarDetails('event')"
                              />
                              <label class="custom-control-label" for="event"
                                >Events
                                <span class="counter">({{ eventsCount }})</span></label
                              >
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="right-inner-wrap">
                      <div class="hamburger-sidebar" id="sidebar-toggle">
                        <span class="line"></span>
                        <span class="line"></span>
                      </div>
                      <div class="weekly-calender-block">
                        <div class="search-group">
                          <input type="text" class="search-input" v-model="search" />
                          <button
                            type="button"
                            class="search-btn"
                            @click="getCalendarDetails('', 'search')"
                          ></button>
                        </div>
                        <vue-cal
                          :selected-date="selectedDate"
                          active-view="day"
                          hide-weekends
                          events-on-month-view="short"
                          :events="events"
                          :disable-views="['years', 'year', 'month', 'week']"
                          style="height: 650px"
                        >
                        </vue-cal>
                      </div>
                      <div class="add-event-sidebar" id="sidebar">
                        <div class="row">
                          <div
                            v-show="error"
                            id="error_div"
                            class="col-md-12 error-text"
                            style="color: red; margin-bottom: 20px"
                          ></div>
                        </div>
                        <form action="#" class="form-layout-view-style">
                          <div class="form-group">
                            <label for="eventtitile" class="small-label">Title</label>
                            <input
                              id="eventtitile"
                              class="form-control"
                              type="text"
                              name=""
                              placeholder="Event Title"
                              v-model="form.title"
                            />
                            <small class="validation-info correct-icon d-none"></small>
                            <small class="error-text d-none"
                              >validation Error text</small
                            >
                          </div>
                          <div class="form-group">
                            <label for="" class="small-label">CATEGORY </label>
                            <select
                              class="form-control custom-select"
                              id="category_id"
                              title="Select a Category"
                              v-model="form.category_id"
                            >
                              <option
                                v-for="category in calendarCategoriesData"
                                v-bind:value="category.id"
                                v-bind:key="category.id"
                              >
                                {{ category.name }}
                              </option>
                            </select>
                          </div>

                          <div class="form-group">
                            <div class="custom-control custom-checkbox">
                              <input
                                type="checkbox"
                                class="custom-control-input"
                                :id="`all_day`"
                                v-model="form.all_day"
                              />
                              <label class="custom-control-label" for="all_day"
                                >All Day
                              </label>
                            </div>
                          </div>
                          {{ form.start_date_time }}
                          <div class="form-group datepicker-style">
                            <label for="" class="small-label">STARTS </label>
                            <input
                              type="text"
                              id="start_date_time"
                              name="start_date_time"
                              class="input-datetime datetimepicker form-control"
                              placeholder="Select Start Date & Time"
                              :disabled="disableTime"
                            />
                          </div>

                          <div class="form-group datepicker-style">
                            <label for="" class="small-label">ENDS </label>
                            <input
                              type="text"
                              id="end_date_time"
                              class="input-datetime datetimepicker form-control"
                              placeholder="Select End Date & Time"
                              :disabled="disableTime"
                            />
                          </div>

                          <div class="form-group">
                            <label for="attendanecetext" class="small-label"
                              >ATTENDENCE
                            </label>
                            <Multiselect
                              mode="tags"
                              v-model="form.selected_attendees"
                              :options="
                                async function (query) {
                                  return await fetchAttendees(query);
                                }
                              "
                              :class="form - control"
                              :createTag="true"
                              :searchable="true"
                              label="name"
                              trackBy="name"
                              valueProp="id"
                              :required="true"
                            >
                            </Multiselect>

                            <span class="mendetory-dot d-none"
                              ><i class="icon-icon_form_required"></i
                            ></span>
                            <small class="error-text d-none"
                              >validation Error text</small
                            >
                          </div>
                          <div class="btn-wrap">
                            <a
                              href="javascript:void(0);"
                              @click="saveCalendar()"
                              class="btn btn-outline-dark w-100"
                              >Create</a
                            >
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
      </div>
    </div>
</template>
<script>
import * as methods from "../Common/helper";
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    VueCal,
    Multiselect,
  },

  beforeMount() {
    this.asset = methods.asset();
    this.getCalendarCategories();
    this.getCalendarDetails("", "");
  },

  mounted() {
    this.selectedDate = new Date();
    console.log(this.selectedDate);
  },

  data() {
    return {
      asset: "",
      error: false,
      disableTime: false,
      deadline: true,
      meeting: true,
      event: true,
      selectedDate: "",
      calendarData: [],
      categoryArray: [],
      events: [],
      deadlinesCount: 0,
      meetingsCount: 0,
      eventsCount: 0,
      calendarCategoriesData: [],
      search: "",
      form: {
        title: "",
        category_id: "",
        all_day: false,
        start_date_time: "",
        end_date_time: "",
        selected_attendees: [],
      },
    };
  },

  methods: {
    fetchAttendees: async (query) => {
      let where = "";

      if (query) {
        where =
          "&where=" +
          encodeURIComponent(
            JSON.stringify({
              name: {
                $regex: `${query}|${query.toUpperCase()}|${
                  query[0].toUpperCase() + query.slice(1)
                }`,
              },
            })
          );
      }

      let url = document.querySelector('meta[name="api-base-url"]').content;

      const response = await fetch(url + "/api/attendees" + where, {
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
      });

      const detail = await response.json();
      return detail.data.map((item) => {
        return { id: item.id, name: item.name };
      });
    },

    getCalendarCategories: function () {
      axios.get("/api/get_calendar_categories").then(
        function (response) {
          var resData = response.data.data;
          this.calendarCategoriesData = resData;
          this.$nextTick(function () {
            $(".custom-select").selectpicker("refresh");
          });
        }.bind(this)
      );
    },

    getCalendarDetails: function (category, isSearch) {
      if (category || this.categoryArray.length > 0) {
        this.categoryArray = [];
        if (this.deadline) {
          this.categoryArray.push("deadline");
        }
        if (this.meeting) {
          this.categoryArray.push("meeting");
        }
        if (this.event) {
          this.categoryArray.push("event");
        }
      }
      var queryString = isSearch || this.search != "" ? this.search : "";
      axios
        .get("/api/calendar?category=" + this.categoryArray + "&search=" + queryString)
        .then(
          function (response) {
            var resData = response.data.data.calendar;
            this.deadlinesCount = response.data.data.deadlines_count;
            this.meetingsCount = response.data.data.meetings_count;
            this.eventsCount = response.data.data.events_count;

            var eventData = [];
            for (let i = 0; i < resData.length; i++) {
              var array = new Array();
              array["start"] = resData[i].start_date_time;
              array["end"] = resData[i].end_date_time;
              array["title"] = "";

              if (resData[i].category.name == "Event") {
                array["content"] =
                  '<div class="event-block events-categories"><div class="img-wrp">';
              }
              if (resData[i].category.name == "Deadline") {
                array["content"] =
                  '<div class="event-block deadline-categories"><div class="img-wrp">';
              }
              if (resData[i].category.name == "Meeting") {
                array["content"] =
                  '<div class="event-block meetings-categories"><div class="img-wrp">';
              }

              var attendees = resData[i].attendees;
              for (let j = 0; j < attendees.length; j++) {
                array["content"] +=
                  '<img src="' +
                  attendees[j].profile_photo_full_path +
                  '" alt="' +
                  attendees[j].name +
                  '">';
              }
              array["content"] +=
                '<div class="event-detail">' + resData[i].title + "</div>";

              array["content"] += "</div>";
              array["class"] = "black-event";
              array["deletable"] = true;
              array["resizable"] = true;
              array["draggable"] = true;
              eventData.push(array);
            }
            this.events = eventData;
          }.bind(this)
        );
    },

    saveCalendar: function () {
      const data = {};
      var start_date_time = $("#start_date_time").val();
      var end_date_time = $("#end_date_time").val();
      data["title"] = this.form.title;
      data["category_id"] = this.form.category_id;
      data["all_day"] = this.form.all_day;
      data["start_date_time"] = start_date_time;
      data["end_date_time"] = end_date_time;
      data["attendees"] = this.form.selected_attendees;

      axios
        .post("/api/calendar", data)
        .then((response) => {
          this.error = false;
          this.getCalendarDetails();
          $("#sidebar-toggle").click();

          // clear form after save
          this.form.title = "";
          this.form.category_id = "";
          this.form.all_day = false;
          this.form.start_date_time = "";
          this.form.end_date_time = "";
          this.form.selected_attendees = [];
          $("#start_date_time").val('');
          $("#end_date_time").val('');
        })
        .catch((err) => {
          this.error = true;
          // display error with key and value
          if (err.response) {
            var errors = err.response.data.data.errors;
            var errorObj = [];

            for (const [key, value] of Object.entries(errors)) {
              // add error in object with `${key}: ${value}` format
              errorObj.push(`${value}`);
              errorObj.push("<br />");
            }
            $("#error_div").html(errorObj);
          } else if (err.request) {
            console.log(err.request);
          } else {
            console.log(err.response);
          }
        })
        .finally();
    },
  },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
