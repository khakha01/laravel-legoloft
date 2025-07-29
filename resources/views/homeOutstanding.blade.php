 <!-- START PRODUCT NỔI BẬT -->
 <section class="product">
     <div class="container" data-aos="fade-up">
         <div class="title_home">
             <h2>Sản phẩm nổi bật</h2>
         </div>
         <div class="owl-carousel owl-theme">
             @foreach ($productOutStanding as $item)
                 @php
                     $priceDiscount = 0;
                     $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                     $productDiscountPrice = $item->productDiscount->where('user_group_id', $userGroupId)->first();

                     $price = $item->price ? $item->price : null;

                     if ($productDiscountPrice) {
                         $priceDiscount = $productDiscountPrice ? $productDiscountPrice->price : null;
                     }

                     $percent = ceil((($item->price - $priceDiscount) / $item->price) * 100);
                     $productImageCollect = $item->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                     $isFavourite = false; // Mặc định là false
                     if (Auth::check()) {
                         $isFavourite = $item->favourite
                             ->where('user_id', Auth::id())
                             ->contains('product_id', $item->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                     } else {
                         $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                         // Lấy danh sách tất cả các product_id từ mảng $favourite
                         $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                         // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                         $isFavourite = is_array($productIds) && in_array((string) $item->id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                     }
                 @endphp

                 <div class="item">
                     <div class="product_box">
                         <div class="product_box_effect">
                             <div class="product_box_tag">Nổi bật </div>
                             @if (isset($productDiscountPrice))
                                 <div class="product_box_tag_sale_outstanding">{{ $percent }}%</div>
                             @endif
                             <div class="product_box_icon">
                                 <button onclick="addFavourite('{{ $item->id }}')" class="outline-0 border-0"
                                     style="background-color: transparent">
                                     <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                         data-product-id="favourite-{{ $item->id }}"></i>
                                 </button>
                                 <button type="button" class="outline-0 border-0 "
                                     style="background-color: transparent"
                                     onclick="showModalProduct(event,'{{ $item->id }}','{{ $item->image }}','{{ $item->name }}','{{ $item->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                                     <i class="fa-regular fa-eye"></i>
                                 </button>
                                 {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                 <button type="button" onclick="addToCart('{{ $item->id }}', 1)"
                                     class="outline-0 border-0 " style="background-color: transparent">
                                     <i class="fa-solid fa-bag-shopping"></i>
                                 </button>
                             </div>
                             <div class="product_box_image">
                                 <img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->slug }}"
                                     loading="lazy" />
                             </div>
                             <div class="product_box_content_out">
                                 <div class="product_box_content">
                                     <h3><a href="{{ route('detail', $item->slug) }}">{{ $item->name }}</a>
                                     </h3>
                                 </div>
                                 @if ($productDiscountPrice)
                                     <div class="product_box_price">
                                         <span>{{ number_format($item->price, 0, ',') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',') . 'đ' }}
                                     </div>
                                 @else
                                     <div class="product_box_price">
                                         <span></span>{{ number_format($item->price, 0, ',') . 'đ' }}
                                     </div>
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
 <!-- END PRODUCT NỔI BẬT -->
