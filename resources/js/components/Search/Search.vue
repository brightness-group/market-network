<template>
  <section class="post-layout-section explore-search-section">
    <div class="container">
      <div class="heading-title">
        <h1 class="title" v-if="!queryString">
          <template v-if="tagString != ''">
            {{ "#" + tagString }}
          </template>
          <template v-else>
            {{ categoryDetails.display_name ?? "" }}
          </template>
        </h1>
      </div>

      <div class="categories-list-slide-box" v-if="snapDetails.length">
        <div class="categories-list-slide-box-inner">
          <ul class="categories-list categories-list-slider explore-search-list-slider">
            <li
              class="categories-list-item"
              v-for="(tag, tagsIndex) in tagsArray"
              :key="tagsIndex"
            >
              <a class="list-item-btn" :href="`${asset}/search?tag=${tag.name}`"
                >#{{ tag.name }}</a
              >
            </li>
          </ul>
        </div>

        <div v-if="snapshots" class="post-layout-wrap five-box-normal-layout minus-top">
          <div v-for="(chunk, divIndex) in snapshotChunks.slice(0, 1)" :key="divIndex">
            <div class="row-cstm">
              <template v-for="(snapshot, index) in chunk" :key="index">
                <article
                  :class="{
                    'post-item ': true,
                    'col-7-cstm': index == 0 ? true : false,
                    'col-6-cstm': index == 2 || index == 3 ? true : false,
                    'col-5-cstm': index == 1 || index == 4 ? true : false,
                    'negative-top-5': index == 4 ? true : false,
                  }"
                >
                  <div class="card">
                    <div class="post-content" v-if="snapshot.media">
                      <div
                        class="post-bg-img"
                        v-if="snapshot.media[0]"
                        :style="`background-image: url(${snapshot.media[0].path})`"
                      ></div>
                      <div class="card-footer">
                        <div class="left-b">
                          <div
                            :class="{
                              'row-ul': true,
                              'one-img-row':
                                snapshot.media_files_count == 1 ? true : false,
                              'two-img-row':
                                snapshot.media_files_count == 2 ? true : false,
                              'three-img-row':
                                snapshot.media_files_count == 3 ? true : false,
                              'four-img-row':
                                snapshot.media_files_count >= 4 ? true : false,
                            }"
                          >
                            <template
                              v-for="(mediafile, mediaIndex) in snapshot.media.slice(
                                0,
                                4
                              )"
                              :key="mediaIndex"
                            >
                              <div class="column-li">
                                <div
                                  class="bg-img-block"
                                  :style="`background-image: url(${mediafile.path})`"
                                ></div>
                              </div>
                            </template>
                          </div>
                          <div class="detail-wrp">
                            <p class="heading-txt">{{ snapshot.title }}</p>
                            <p v-if="snapshot.user.collaborate" class="sub-txt">
                              Collaboration
                            </p>
                            <p v-else class="sub-txt">{{ snapshot.user.name }}</p>
                          </div>
                        </div>
                        <div class="right-b">
                          <ul class="nav-list">
                            <li>
                              <button type="button" class="like-deslike-icon">
                                <div
                                  :id="snapshot.id"
                                  :class="{
                                    'post-like': snapshot.is_liked ? true : false,
                                    'post-unlike': !snapshot.is_liked ? true : false,
                                  }"
                                  v-on:click="like(snapshot.id)"
                                ></div>
                              </button>
                            </li>
                            <li>
                              <div class="dropdown option-dropdown">
                                <button
                                  type="button"
                                  id="dropbtn"
                                  class="list-bar-icon dropdown-toggle"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                ></button>
                                <div
                                  class="dropdown-menu dropdown-menu-right"
                                  aria-labelledby="dropbtn"
                                >
                                  <button
                                    type="button"
                                    class="dropdown-item"
                                    v-on:click="saveMoodboard(snapshot.id)"
                                  >
                                    <span class="moonboard-icon"></span> Save to
                                    Moodboards
                                  </button>
                                  <button type="button" class="dropdown-item">
                                    <span class="hide-snap-icon"></span> Hide Seen
                                  </button>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <a :href="`${asset}/snaps/${snapshot.slug}`" class="hover-box-d">
                        <div class="detail-main-wrp">
                          <div class="name-txt">OWN THIS SEEN</div>
                          <div class="price-badge">
                            <small>From</small>
                            <p class="price-txt">
                              {{ currencySymbol }}{{ snapshot.package_start_from }}
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </article>
              </template>
            </div>
          </div>
        </div>
        <div v-if="snapshots" class="post-layout-wrap five-box-reverse-layout">
          <div v-for="(chunk, divIndex) in snapshotChunks.slice(1, 2)" :key="divIndex">
            <div class="row-cstm">
              <template v-for="(snapshot, index) in chunk" :key="index">
                <article
                  :class="{
                    'post-item ': true,
                    'col-5-cstm': index == 0 || index == 2 ? true : false,
                    'col-7-cstm': index == 1 ? true : false,
                    'negative-top-5': index == 2 ? true : false,
                    'col-6-cstm': index == 3 || index == 4 ? true : false,
                  }"
                >
                  <div class="card">
                    <div class="post-content" v-if="snapshot.media">
                      <div
                        class="post-bg-img"
                        v-if="snapshot.media[0]"
                        :style="`background-image: url(${snapshot.media[0].path})`"
                      ></div>
                      <div class="card-footer">
                        <div class="left-b">
                          <div
                            :class="{
                              'row-ul': true,
                              'one-img-row':
                                snapshot.media_files_count == 1 ? true : false,
                              'two-img-row':
                                snapshot.media_files_count == 2 ? true : false,
                              'three-img-row':
                                snapshot.media_files_count == 3 ? true : false,
                              'four-img-row':
                                snapshot.media_files_count >= 4 ? true : false,
                            }"
                          >
                            <template
                              v-for="(mediafile, mediaIndex) in snapshot.media.slice(
                                0,
                                4
                              )"
                              :key="mediaIndex"
                            >
                              <div class="column-li">
                                <div
                                  class="bg-img-block"
                                  :style="`background-image: url(${mediafile.path})`"
                                ></div>
                              </div>
                            </template>
                          </div>
                          <div class="detail-wrp">
                            <p class="heading-txt">
                              {{ snapshot.title }}
                            </p>
                            <p v-if="snapshot.user.collaborate" class="sub-txt">
                              Collaboration
                            </p>
                            <p v-else class="sub-txt">{{ snapshot.user.name }}</p>
                          </div>
                        </div>
                        <div class="right-b">
                          <ul class="nav-list">
                            <li>
                              <button type="button" class="like-deslike-icon">
                                <div
                                  :id="snapshot.id"
                                  :class="{
                                    'post-like': snapshot.is_liked ? true : false,
                                    'post-unlike': !snapshot.is_liked ? true : false,
                                  }"
                                  v-on:click="like(snapshot.id)"
                                ></div>
                              </button>
                            </li>
                            <li>
                              <div class="dropdown option-dropdown">
                                <button
                                  type="button"
                                  id="dropbtn"
                                  class="list-bar-icon dropdown-toggle"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                ></button>
                                <div
                                  class="dropdown-menu dropdown-menu-right"
                                  aria-labelledby="dropbtn"
                                >
                                  <button
                                    type="button"
                                    class="dropdown-item"
                                    v-on:click="saveMoodboard(snapshot.id)"
                                  >
                                    <span class="moonboard-icon"></span> Save to
                                    Moodboards
                                  </button>
                                  <button type="button" class="dropdown-item">
                                    <span class="hide-snap-icon"></span> Hide Seen
                                  </button>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <a :href="`${asset}/snaps/${snapshot.slug}`" class="hover-box-d">
                        <div class="detail-main-wrp">
                          <div class="name-txt">OWN THIS SEEN</div>
                          <div class="price-badge">
                            <small>From</small>
                            <p class="price-txt">
                              {{ currencySymbol }}{{ snapshot.package_start_from }}
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </article>
              </template>
            </div>
          </div>
        </div>
        <div v-if="snapshots" class="post-layout-wrap five-box-normal-layout">
          <div v-for="(chunk, divIndex) in snapshotChunks.slice(2, 3)" :key="divIndex">
            <div class="row-cstm">
              <template v-for="(snapshot, index) in chunk" :key="index">
                <article
                  :class="{
                    'post-item ': true,
                    'col-7-cstm': index == 0 ? true : false,
                    'col-6-cstm': index == 2 || index == 3 ? true : false,
                    'col-5-cstm': index == 1 || index == 4 ? true : false,
                    'negative-top-5': index == 4 ? true : false,
                  }"
                >
                  <div class="card">
                    <div class="post-content" v-if="snapshot.media">
                      <div
                        class="post-bg-img"
                        v-if="snapshot.media[0]"
                        :style="`background-image: url(${snapshot.media[0].path})`"
                      ></div>
                      <div class="card-footer">
                        <div class="left-b">
                          <div
                            :class="{
                              'row-ul': true,
                              'one-img-row':
                                snapshot.media_files_count == 1 ? true : false,
                              'two-img-row':
                                snapshot.media_files_count == 2 ? true : false,
                              'three-img-row':
                                snapshot.media_files_count == 3 ? true : false,
                              'four-img-row':
                                snapshot.media_files_count >= 4 ? true : false,
                            }"
                          >
                            <template
                              v-for="(mediafile, mediaIndex) in snapshot.media.slice(
                                0,
                                4
                              )"
                              :key="mediaIndex"
                            >
                              <div class="column-li">
                                <div
                                  class="bg-img-block"
                                  :style="`background-image: url(${mediafile.path})`"
                                ></div>
                              </div>
                            </template>
                          </div>
                          <div class="detail-wrp">
                            <p class="heading-txt">{{ snapshot.title }}</p>
                            <p v-if="snapshot.user.collaborate" class="sub-txt">
                              Collaboration
                            </p>
                            <p v-else class="sub-txt">{{ snapshot.user.name }}</p>
                          </div>
                        </div>
                        <div class="right-b">
                          <ul class="nav-list">
                            <li>
                              <button type="button" class="like-deslike-icon">
                                <div
                                  :id="snapshot.id"
                                  :class="{
                                    'post-like': snapshot.is_liked ? true : false,
                                    'post-unlike': !snapshot.is_liked ? true : false,
                                  }"
                                  v-on:click="like(snapshot.id)"
                                ></div>
                              </button>
                            </li>
                            <li>
                              <div class="dropdown option-dropdown">
                                <button
                                  type="button"
                                  id="dropbtn"
                                  class="list-bar-icon dropdown-toggle"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                ></button>
                                <div
                                  class="dropdown-menu dropdown-menu-right"
                                  aria-labelledby="dropbtn"
                                >
                                  <button
                                    type="button"
                                    class="dropdown-item"
                                    v-on:click="saveMoodboard(snapshot.id)"
                                  >
                                    <span class="moonboard-icon"></span> Save to
                                    Moodboards
                                  </button>
                                  <button type="button" class="dropdown-item">
                                    <span class="hide-snap-icon"></span> Hide Seen
                                  </button>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <a :href="`${asset}/snaps/${snapshot.slug}`" class="hover-box-d">
                        <div class="detail-main-wrp">
                          <div class="name-txt">OWN THIS SEEN</div>
                          <div class="price-badge">
                            <small>From</small>
                            <p class="price-txt">
                              {{ currencySymbol }}{{ snapshot.package_start_from }}
                            </p>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </article>
              </template>
            </div>
          </div>
        </div>
      </div>
      <div v-else>No records found</div>
    </div>
  </section>

  <section class="subscribe-section">
    <newsletter-form
      :form="form.newsletter"
      @saveNewsletter="saveNewsletter"
      :loading="loading"
      :saveDisabled="saveDisabled"
    ></newsletter-form>
  </section>

  <section class="post-layout-section">
    <div class="container">
      <div class="post-layout-wrap five-box-reverse-layout">
        <div v-for="(chunk, divIndex) in snapshotChunks.slice(3, 4)" :key="divIndex">
          <div class="row-cstm">
            <template v-for="(snapshot, index) in chunk" :key="index">
              <article
                :class="{
                  'post-item ': true,
                  'col-5-cstm': index == 0 || index == 2 ? true : false,
                  'col-7-cstm': index == 1 ? true : false,
                  'negative-top-5': index == 2 ? true : false,
                  'col-6-cstm': index == 3 || index == 4 ? true : false,
                }"
              >
                <div class="card">
                  <div class="post-content" v-if="snapshot.media">
                    <div
                      class="post-bg-img"
                      v-if="snapshot.media[0]"
                      :style="`background-image: url(${snapshot.media[0].path})`"
                    ></div>
                    <div class="card-footer">
                      <div class="left-b">
                        <div
                          :class="{
                            'row-ul': true,
                            'one-img-row': snapshot.media_files_count == 1 ? true : false,
                            'two-img-row': snapshot.media_files_count == 2 ? true : false,
                            'three-img-row':
                              snapshot.media_files_count == 3 ? true : false,
                            'four-img-row':
                              snapshot.media_files_count >= 4 ? true : false,
                          }"
                        >
                          <template
                            v-for="(mediafile, mediaIndex) in snapshot.media.slice(0, 4)"
                            :key="mediaIndex"
                          >
                            <div class="column-li">
                              <div
                                class="bg-img-block"
                                :style="`background-image: url(${mediafile.path})`"
                              ></div>
                            </div>
                          </template>
                        </div>
                        <div class="detail-wrp">
                          <p class="heading-txt">{{ snapshot.title }}</p>
                          <p v-if="snapshot.user.collaborate" class="sub-txt">
                            Collaboration
                          </p>
                          <p v-else class="sub-txt">{{ snapshot.user.name }}</p>
                        </div>
                      </div>
                      <div class="right-b">
                        <ul class="nav-list">
                          <li>
                            <button type="button" class="like-deslike-icon">
                              <div
                                :id="snapshot.id"
                                :class="{
                                  'post-like': snapshot.is_liked ? true : false,
                                  'post-unlike': !snapshot.is_liked ? true : false,
                                }"
                                v-on:click="like(snapshot.id)"
                              ></div>
                            </button>
                          </li>
                          <li>
                            <div class="dropdown option-dropdown">
                              <button
                                type="button"
                                id="dropbtn"
                                class="list-bar-icon dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              ></button>
                              <div
                                class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="dropbtn"
                              >
                                <button
                                  type="button"
                                  class="dropdown-item"
                                  v-on:click="saveMoodboard(snapshot.id)"
                                >
                                  <span class="moonboard-icon"></span> Save to Moodboards
                                </button>
                                <button type="button" class="dropdown-item">
                                  <span class="hide-snap-icon"></span> Hide Seen
                                </button>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <a :href="`${asset}/snaps/${snapshot.slug}`" class="hover-box-d">
                      <div class="detail-main-wrp">
                        <div class="name-txt">OWN THIS SEEN</div>
                        <div class="price-badge">
                          <small>From</small>
                          <p class="price-txt">
                            {{ currencySymbol }}{{ snapshot.package_start_from }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </article>
            </template>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="post-layout-section" style="padding-top: 0">
    <div class="container">
      <template v-for="(section, sectionIndex) in seenSection" :key="sectionIndex">
        <div
          :class="{
            'post-layout-wrap': true,
            'five-box-normal-layout': sectionIndex % 2 == 1 ? true : false,
            'five-box-reverse-layout': sectionIndex % 2 == 0 ? true : false,
          }"
        >
          <div class="row-cstm">
            <template v-for="(snapshot, index) in section" :key="index">
              <article
                v-if="sectionIndex % 2 === 0"
                :class="{
                  'post-item ': true,
                  'col-7-cstm': index == 0 ? true : false,
                  'col-6-cstm': index == 2 || index == 3 ? true : false,
                  'col-5-cstm': index == 1 || index == 4 ? true : false,
                  'negative-top-5': index == 4 ? true : false,
                }"
              >
                <div class="card">
                  <div class="post-content" v-if="snapshot.media">
                    <div
                      class="post-bg-img"
                      v-if="snapshot.media[0]"
                      :style="`background-image: url(${snapshot.media[0].path})`"
                    ></div>
                    <div class="card-footer">
                      <div class="left-b">
                        <div
                          :class="{
                            'row-ul': true,
                            'one-img-row': snapshot.media_files_count == 1 ? true : false,
                            'two-img-row': snapshot.media_files_count == 2 ? true : false,
                            'three-img-row':
                              snapshot.media_files_count == 3 ? true : false,
                            'four-img-row':
                              snapshot.media_files_count >= 4 ? true : false,
                          }"
                        >
                          <template
                            v-for="(mediafile, mediaIndex) in snapshot.media.slice(0, 4)"
                            :key="mediaIndex"
                          >
                            <div class="column-li">
                              <div
                                class="bg-img-block"
                                :style="`background-image: url(${mediafile.path})`"
                              ></div>
                            </div>
                          </template>
                        </div>
                        <div class="detail-wrp">
                          <p class="heading-txt">{{ snapshot.title }}</p>
                          <p v-if="snapshot.user.collaborate" class="sub-txt">
                            Collaboration
                          </p>
                          <p v-else class="sub-txt">{{ snapshot.user.name }}</p>
                        </div>
                      </div>
                      <div class="right-b">
                        <ul class="nav-list">
                          <li>
                            <button type="button" class="like-deslike-icon">
                              <div
                                :id="snapshot.id"
                                :class="{
                                  'post-like': snapshot.is_liked ? true : false,
                                  'post-unlike': !snapshot.is_liked ? true : false,
                                }"
                                v-on:click="like(snapshot.id)"
                              ></div>
                            </button>
                          </li>
                          <li>
                            <div class="dropdown option-dropdown">
                              <button
                                type="button"
                                id="dropbtn"
                                class="list-bar-icon dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              ></button>
                              <div
                                class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="dropbtn"
                              >
                                <button
                                  type="button"
                                  class="dropdown-item"
                                  v-on:click="saveMoodboard(snapshot.id)"
                                >
                                  <span class="moonboard-icon"></span> Save to Moodboards
                                </button>
                                <button type="button" class="dropdown-item">
                                  <span class="hide-snap-icon"></span> Hide Seen
                                </button>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <a :href="`${asset}/snaps/${snapshot.slug}`" class="hover-box-d">
                      <div class="detail-main-wrp">
                        <div class="name-txt">OWN THIS SEEN</div>
                        <div class="price-badge">
                          <small>From</small>
                          <p class="price-txt">
                            {{ currencySymbol }}{{ snapshot.package_start_from }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </article>
              <article
                v-else
                :class="{
                  'post-item ': true,
                  'col-5-cstm': index == 0 || index == 2 ? true : false,
                  'col-7-cstm': index == 1 ? true : false,
                  'negative-top-5': index == 2 ? true : false,
                  'col-6-cstm': index == 3 || index == 4 ? true : false,
                }"
              >
                <div class="card">
                  <div class="post-content" v-if="snapshot.media">
                    <div
                      class="post-bg-img"
                      v-if="snapshot.media[0]"
                      :style="`background-image: url(${snapshot.media[0].path})`"
                    ></div>
                    <div class="card-footer">
                      <div class="left-b">
                        <div
                          :class="{
                            'row-ul': true,
                            'one-img-row': snapshot.media_files_count == 1 ? true : false,
                            'two-img-row': snapshot.media_files_count == 2 ? true : false,
                            'three-img-row':
                              snapshot.media_files_count == 3 ? true : false,
                            'four-img-row':
                              snapshot.media_files_count >= 4 ? true : false,
                          }"
                        >
                          <template
                            v-for="(mediafile, mediaIndex) in snapshot.media.slice(0, 4)"
                            :key="mediaIndex"
                          >
                            <div class="column-li">
                              <div
                                class="bg-img-block"
                                :style="`background-image: url(${mediafile.path})`"
                              ></div>
                            </div>
                          </template>
                        </div>
                        <div class="detail-wrp">
                          <p class="heading-txt">{{ snapshot.title }}</p>
                          <p v-if="snapshot.user.collaborate" class="sub-txt">
                            Collaboration
                          </p>
                          <p v-else class="sub-txt">{{ snapshot.user.name }}</p>
                        </div>
                      </div>
                      <div class="right-b">
                        <ul class="nav-list">
                          <li>
                            <button type="button" class="like-deslike-icon">
                              <div
                                :id="snapshot.id"
                                :class="{
                                  'post-like': snapshot.is_liked ? true : false,
                                  'post-unlike': !snapshot.is_liked ? true : false,
                                }"
                                v-on:click="like(snapshot.id)"
                              ></div>
                            </button>
                          </li>
                          <li>
                            <div class="dropdown option-dropdown">
                              <button
                                type="button"
                                id="dropbtn"
                                class="list-bar-icon dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              ></button>
                              <div
                                class="dropdown-menu dropdown-menu-right"
                                aria-labelledby="dropbtn"
                              >
                                <button
                                  type="button"
                                  class="dropdown-item"
                                  v-on:click="saveMoodboard(snapshot.id)"
                                >
                                  <span class="moonboard-icon"></span> Save to Moodboards
                                </button>
                                <button type="button" class="dropdown-item">
                                  <span class="hide-snap-icon"></span> Hide Seen
                                </button>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <a :href="`${asset}/snaps/${snapshot.slug}`" class="hover-box-d">
                      <div class="detail-main-wrp">
                        <div class="name-txt">OWN THIS SEEN</div>
                        <div class="price-badge">
                          <small>From</small>
                          <p class="price-txt">
                            {{ currencySymbol }}{{ snapshot.package_start_from }}
                          </p>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </article>
            </template>
          </div>
        </div>
      </template>
    </div>
  </section>

  <section v-if="snapDetails.length" class="post-layout-section" style="padding-top: 0">
    <div class="container">
      <div class="text-center">
        <button class="btn btn-outline-dark load-more-btn" @click="getSnaps()">
          Load more +
        </button>
      </div>
    </div>
  </section>
</template>
<script>
import NewsletterForm from "../Common/NewsletterForm.vue";
import * as methods from "../Common/helper";

export default {
  props: ["snapshots", "category", "query", "tags", "tag"],

  components: {
    NewsletterForm,
  },

  beforeMount() {
    this.asset = methods.asset();
  },

  mounted() {
    console.log("Component mounted.");
    this.getSiteSettings();
  },

  data() {
    return {
      asset: "",
      loading: false,
      saveDisabled: false,
      snapDetails: [],
      tagsArray: [],
      categoryDetails: [],
      categoryId: "",
      queryString: "",
      tagString: "",
      seenSection: [],
      categories: [],
      searchUrl: "",
      totalSnaps: 0,
      currencySymbol: "",
      form: {
        newsletter: {
          email: null,
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
    saveNewsletter() {
      this.loading = true;
      this.saveDisabled = true;
      $(".error-text").hide();
      var errorObj = [];
      var successObj = [];

      axios
        .post("/api/save_newsletter", this.form.newsletter)
        .then(function (response) {
          $(".error-text").html(errorObj);
          successObj.push(response.data.message);
          $("#success_div").html(successObj);
          this.loading = false;
          this.saveDisabled = false;
        })
        .catch((err) => {
          $(".error-text").show();
          $("#success_div").html(successObj);
          if (err.response) {
            var errors = err.response.data.data.errors;

            for (const [key, value] of Object.entries(errors)) {
              errorObj.push(`${value}`);
              errorObj.push("<br />");
            }
            $(".error-text").html(errorObj);
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

    getDetails: function () {
      if (this.snapshots) {
        this.snapDetails = JSON.parse(this.snapshots);
      }
      if (this.category.length) {
        this.categoryDetails = JSON.parse(this.category);
        this.categoryId = this.categoryDetails.id;
      }
      if (this.query) {
        this.queryString = JSON.parse(this.query);
      }
      if (this.tags) {
        this.tagsArray = JSON.parse(this.tags);
      }
      if (this.tag) {
        this.tagString = JSON.parse(this.tag);
      }
      var url = "/api/search?perPage=5&page=5";
      var categoryUrl = "";
      var tagUrl = "";
      var queryUrl = "";
      if (this.categoryId != undefined) {
        categoryUrl = "&category_id=" + this.categoryId;
      }
      if (this.tagString !== null) {
        tagUrl = "&tag=" + this.tagString;
      }
      if (this.queryString !== null) {
        queryUrl = "&query=" + this.queryString;
      }

      this.searchUrl = url + categoryUrl + tagUrl + queryUrl;
    },

    getUserCategories: function () {
      axios.get("/api/all_categories").then(
        function (response) {
          this.categories = response.data.data;
        }.bind(this)
      );
    },

    like(snapshotId) {
      let el = document.getElementById(snapshotId);
      let className = "";
      const data = {};
      data["snapshot_id"] = snapshotId;
      data["class"] = el.className;
      if (el.className === "post-like") {
        className = "post-unlike";
      } else {
        className = "post-like";
      }
      axios
        .post("/api/like_snapshot", data)
        .then(function (response) {
          $("#" + snapshotId).removeClass(el.className);
          $("#" + snapshotId).addClass(className);
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

    saveMoodboard(snapshotId) {
      const data = {};
      data["snapshot_id"] = snapshotId;
      axios
        .post("/api/save_moodboard", data)
        .then(function (response) {
          console.log(response.data);
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

    getSnaps: function () {
      axios.get(this.searchUrl).then(
        function (response) {
          if (response.data.data.length !== 0) {
            var responseData = [];
            for (let i = 0; i < response.data.data.length; i++) {
              responseData.push(response.data.data[i]);
            }
            this.seenSection.push(responseData);
            var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            var url = "/api/search?perPage=5&page=" + nextPage;
            var categoryUrl = "";
            var tagUrl = "";
            var queryUrl = "";
            if (this.categoryId != undefined) {
              categoryUrl = "&category_id=" + this.categoryId;
            }
            if (this.tagString !== null) {
              tagUrl = "&tag=" + this.tagString;
            }
            if (this.queryString !== null) {
              queryUrl = "&query=" + this.queryString;
            }
            this.searchUrl = url + categoryUrl + tagUrl + queryUrl;
            this.totalSnaps = response.data.pagination.total;
            console.log(this.seenSection);
          } else {
            $(".load-more-btn").remove();
          }
        }.bind(this)
      );
    },
  },

  created: function () {
    this.getDetails();
    this.getUserCategories();
  },

  computed: {
    snapshotChunks() {
      return _.chunk(Object.values(this.snapDetails), 5);
    },
  },
};
</script>
