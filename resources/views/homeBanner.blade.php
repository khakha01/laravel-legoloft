 <!-- START BANNER -->
 <div class="">
     <div class="banner_home">
         <div class="swiper swiper-slide-home">
             <div class="swiper-wrapper">
                 @foreach ($sub_banners_5 as $item)
                     <div class="swiper-slide">
                         <div class="banner_home_image">
                             <img src="{{ asset($item->image_desktop) }}" alt="{{ $item->title }}" loading="lazy" />
                         </div>
                         @if (!empty($item->title))
                             <div class="banner_home_text">
                                 <h2 class="banner_home_text_h2">{{ $item->title }}</h2>
                                 <span class="banner_home_text_span">{{ $item->description }}</span>
                                 <a href="{{ $item->href }}" class="banner_home_text_btn">
                                     {{ $item->button }}
                                     <i class="fa-solid fa-chevron-right"></i>
                                 </a>
                             </div>
                         @endif
                     </div>
                 @endforeach
             </div>
             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>
             <div class="swiper-pagination"></div>
         </div>
     </div>
     <div class="banner_home_mobile">
         @foreach ($sub_banners_5 as $item)
             <div class="banner_home_mobile_image">
                 <img src="{{ asset($item->image_mobile) }}" alt="{{ $item->title }}" loading="lazy" />
             </div>
             <div class="banner_home_mobile_text">
                 <h2 class="banner_home_mobile_text_h2">{{ $item->title }}</h2>
                 <span class="banner_home_mobile_text_span">{{ $item->description }}</span>
                 <a href="{{ $item->href }}" class="banner_home_mobile_text_btn">{{ $item->button }} <i
                         class="fa-solid fa-chevron-right"></i>
                 </a>
             </div>
         @endforeach
     </div>
 </div>
 <!-- END BANNER -->

 <script>
     document.addEventListener('DOMContentLoaded', function() {
         var swiper = new Swiper(".swiper-slide-home", {
             spaceBetween: 30,
             centeredSlides: true,
             autoplay: {
                 delay: 2500,
                 disableOnInteraction: false,
             },
             pagination: {
                 el: ".swiper-pagination",
                 clickable: true,
             },
             navigation: {
                 nextEl: ".swiper-button-next",
                 prevEl: ".swiper-button-prev",
             },
             loop: true // Add this if you want infinite loop
         });
     });
 </script>
