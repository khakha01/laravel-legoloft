 <!-- START PRODUCT HẾT HÀNG -->
 @if ($productSoldOut && count($productSoldOut) > 0)
     <section class="product">
         <div class="container" data-aos="fade-up">
             <div class="title_home">
                 <h2>Sản phẩm hết hàng</h2>
             </div>
             <div class="owl-carousel owl-theme">
                 @foreach ($productSoldOut as $item)
                     <div class="item">
                         <div class="product_box">
                             <div class="product_box_effect">
                                 <div class="product_box_tag_soldout">Hết hàng</div>
                                 <div class="product_box_image_black">
                                     <img src="{{ asset('img/' . $item->image) }}"
                                         alt="{{ $item->name }}"loading="lazy" />
                                 </div>
                                 <div class="product_box_content_out">
                                     <div class="product_box_content">
                                         <h3><a href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                         </h3>
                                     </div>
                                     <div class="">
                                         <span
                                             class="text-black">{{ number_format($item->price, 0, ',', '.') . 'đ' }}</span>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>
 @endif
 <!-- END PRODUCT HẾT HÀNG -->
