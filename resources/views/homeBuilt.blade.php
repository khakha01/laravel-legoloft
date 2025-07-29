 <!-- START BUILT -->
 <section class="home_built" data-aos="fade-up">
     <div class="container">
         <div class="title_home_built">
             <h2>Được xây dựng bởi bạn</h2>
         </div>
         <div class="row">
             @foreach ($commentBuildImageById as $item)
                 <div class="col-md-3 col-sm-4 col-12 py-3">
                     <div class="built_box">
                         <div class="built_box_effect">
                             <div class="built_box_image">
                                 <img src="{{ asset('img/' . $item->images) }}" alt="{{ $item->images }}"
                                     loading="lazy" />

                             </div>
                             <div class="built_buyNow"> <a
                                     href="{{ route('detail', $item->comment->product->slug) }}">Mua
                                     ngay</a></div>

                         </div>
                     </div>
                 </div>
             @endforeach
         </div>

         <div class="row">
             <div class="col-md-12">
                 <div class="div_btn_built">
                     <a href="{{ route('inspiration') }}" class="built_home_text_btn">Khám phá <i
                             class="fa-solid fa-chevron-right"></i></a>
                 </div>
             </div>
         </div>

     </div>
 </section>
 <!-- END BUILT -->
