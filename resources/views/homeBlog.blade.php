      <!-- START BÀI VIẾT -->
      <section>
          <div class="container">
              <div class="title_btn_blog">
                  <div class="title_home_blog">
                      <h2>Đọc tất cả về nó</h2>
                  </div>
                  <div class="btn_home_blog"><a href="{{ route('categoryArticleUser') }}">Xem tất cả bài viết</a>
                  </div>
              </div>
              <div class="row" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                  @foreach ($articles as $item)
                      <div class="col-md-3 col-sm-4 col-12">
                          <div class="blog_box">
                              <div class="blog_box_effect">
                                  <div class="blog_box_image">
                                      <img src="{{ asset('img/' . $item->image) }}"
                                          alt="{{ $item->title }}"loading="lazy" />
                                  </div>
                                  <div class="blog_box_content_out">
                                      <div class="blog_box_content">
                                          <h3>
                                              <a href="{{ route('articlesUser', $item->id) }}">{{ $item->title }}</a>
                                          </h3>
                                          <span> {!! $item->description_short !!}</span>
                                          <a href="{{ route('articlesUser', $item->id) }}">Đọc thêm <i
                                                  class="fa-solid fa-chevron-right"></i></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>
      </section>
      <!-- END BÀI VIẾT -->
