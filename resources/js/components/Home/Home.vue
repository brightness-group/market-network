<template>
  <div class="home-page">
    <section class="post-layout-section home-page-section">
      <div class="container">
        <div class="categories-list-slide-box">
          <div class="categories-list-slide-box-inner">
            <ul class="categories-list categories-list-slider">
              <template v-for="(cat, index) in mainCategories" :key="index">          
              <li :data-category="`${cat.display_name}`" 
              :class="`categories-list-item ${cat.display_name}-slick`">
                <a class="list-item-btn"  :href="`${ cat.link }`">{{ cat.display_name }}</a>
              </li>
              </template>
            </ul>
          </div>
          <div v-if="snapDetails" class="post-layout-wrap five-box-normal-layout minus-top">
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
          <div v-if="snapDetails" class="post-layout-wrap five-box-reverse-layout">
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
      </div>
    </section>
    <section class="categorie-box-section bg-dark">
      <div class="container">
        <div class="heading-btn-group">
          <h2 class="heading text-white">DISCOVER MORE CATEGORIES</h2>
          <a :href="`${asset}/categories`" class="btn btn-outline-light d-md-block d-none"
            >Explore all</a
          >
        </div>
        <div class="row" v-if="categories">
          <div
            class="col-md-4"
            v-for="(category, catIndex) in categories.slice(0, 3)"
            :key="catIndex"
          >
            <a class="img-card-box" :href="`${asset}/search?category_id=${category.id}`">
              <div class="img-group">
                <div class="full-img">
                  <div
                    v-if="category.banner"
                    class="post-bg-img"
                    :style="`background-image: url(${encodeURI(
                      category.banner
                    )})`"
                  ></div>
                </div>
              </div>
              <div class="img-caption">
                {{ category.display_name }} <i class="icon-icon_nav_right"></i>
              </div>
            </a>
          </div>
        </div>
        <a href="#" class="btn btn-outline-light d-md-none d-block">Explore all</a>
      </div>
    </section>
    <section class="post-layout-section">
      <div class="container">
        <div class="post-layout-wrap five-box-normal-layout minus-top">
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
    <section class="post-layout-section" style="padding-top: 0">
      <div class="container">
        <div class="text-center">
          <button class="btn btn-outline-dark load-more-btn" @click="getSnaps()">
            Load more +
          </button>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import NewsletterForm from "../Common/NewsletterForm.vue";
import * as methods from "../Common/helper";

export default {
  components: {
    NewsletterForm,
  },

  beforeMount() {
    this.asset = methods.asset();
    this.getCategories();
  },

  mounted() {
    console.log("Component mounted.");
  },

  data() {
    return {
      asset: "",
      loading: false,
      saveDisabled: false,
      recommended: false,
      snapDetails: [],
      seenSection: [],
      categories: [],
      mainCategories: [],
      snapUrl: "/api/snapshots?perPage=5&page=5",
      recommendedSnapUrl: "/api/snapshots?perPage=5&page=5&query=recommended",
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

    getSnapDetails: function () {
      this.recommended = false;
      axios.get("/api/snapshots?perPage=20&page=1").then(
        function (response) {
          if (response.data.data.length > 0) {
            this.snapDetails = response.data.data;
          }
        }.bind(this)
      );
    },

    getRecommendedSnaps: function () {
      this.recommended = true;
      this.seenSection = [];
      axios.get("/api/snapshots?perPage=20&page=1&query=recommended").then(
        function (response) {
          if (response.data.data.length > 0) {
            this.snapDetails = response.data.data;
          }
        }.bind(this)
      );
    },

    getUserCategories: function () {
      axios.get("/api/all_categories").then(
        function (response) {
          this.categories = response.data.data;
        }.bind(this)
      );
    },

    getCategories: function () {
      axios.get("/api/categories").then(
        function (response) {
          // this.mainCategories = response.data.data;

          var staticData = [];
          staticData['name'] = "All";
          staticData['display_name'] = "All";
          staticData['id'] = '';
          staticData['link'] = this.asset;
          this.mainCategories.push(staticData);

          var staticDataRecommended = [];
          staticDataRecommended['name'] = "Recommended";
          staticDataRecommended['display_name'] = "Recommended";
          staticDataRecommended['id'] = '';
          staticDataRecommended['link'] = this.asset+"?query=recommended";
          this.mainCategories.push(staticDataRecommended);

          var catData = response.data.data;

          for (let i=0; i < catData.length; i++) {
            var detail = [];
            detail['name'] = catData[i]['name'];
            detail['display_name'] = catData[i]['display_name'];
            detail['id'] = catData[i]['id'];
            detail['link'] = this.asset+"/search?category_id="+catData[i]['id'];
            this.mainCategories.push(detail);
          }

          this.$nextTick(function(){ $('.categories-list-slider').slick('refresh'); });
          
          this.$nextTick(function(){
            var querystring = this.getParameterByName("query");
            if (querystring == 'recommended') {
                $( ".Recommended-slick" ).addClass( "slick-current slick-selected" );
                $( ".All-slick" ).removeClass( "slick-current" );
            }
          });
        }.bind(this)
      );
    },

    getSiteSettings: function () {
      axios.get("/api/site-settings").then((response) => {
        this.currencySymbol = response.data.data[0].currency_symbol;
      });
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
      let apiUrl = this.snapUrl;
      if (this.recommended === true) {
        apiUrl = this.recommendedSnapUrl;
      }
      axios.get(apiUrl).then(
        function (response) {
          if (response.data.data.length !== 0) {
            var responseData = [];
            for (let i = 0; i < response.data.data.length; i++) {
              responseData.push(response.data.data[i]);
            }
            this.seenSection.push(responseData);
            var nextPage = parseInt(response.data.pagination.current_page) + parseInt(1);
            this.snapUrl = "/api/snapshots?perPage=5&page=" + nextPage;
            this.recommendedSnapUrl = "/api/snapshots?query=recommended&perPage=5&page=" + nextPage;
            this.totalSnaps = response.data.pagination.total;
          } else {
            $(".load-more-btn").remove();
          }
        }.bind(this)
      );
    },

    getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
  },

  created: function () {
    this.getSiteSettings();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);    
    var isRecommended = urlParams.has('query');
    if (isRecommended) {
      this.recommended = true;
      this.getRecommendedSnaps();
    } else {
      this.recommended = false;
      this.getSnapDetails();
    }

    this.getUserCategories();
  },

  computed: {
    snapshotChunks() {
      return _.chunk(Object.values(this.snapDetails), 5);
    },
  },
};
</script>
