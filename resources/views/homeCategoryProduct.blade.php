@foreach ($categories as $category)
    @if ($category->status == 1)
        @foreach ($category->categories_children as $item)
            @if ($item->status_section == 1)
                <section class="section_product_theme"data-aos="fade-right" data-aos-offset="300"
                    data-aos-easing="ease-in-sine">
                    <div class="container ">
                        <div class="title_home">
                            <h2>{{ $item->name }}</h2>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @if (isset($productByCategory[$item->id]))
                                @foreach ($productByCategory[$item->id] as $product)
                                    @php
                                        $priceDiscount = 0;
                                        $userGroupId = Auth::check() ? Auth::user()->user_group_id : 1;
                                        $productDiscountPrice = $product->productDiscount
                                            ->where('user_group_id', $userGroupId)
                                            ->first();

                                        $price = $product->price ? $product->price : null;

                                        if ($productDiscountPrice) {
                                            $priceDiscount = $productDiscountPrice
                                                ? $productDiscountPrice->price
                                                : null;
                                        }

                                        $percent = ceil((($product->price - $priceDiscount) / $product->price) * 100);
                                        $productImageCollect = $product->productImage->pluck('images'); // pluck lấy một tập hợp các giá trị của trường cụ thể
                                        $isFavourite = false;
                                        if (Auth::check()) {
                                            $isFavourite = $product->favourite
                                                ->where('user_id', Auth::id())
                                                ->contains('product_id', $product->id); //contains kiểm tra xem một tập hợp (collection) có chứa một giá trị cụ thể hay không.
                                        } else {
                                            $favourite = json_decode(Cookie::get('favourite', '[]'), true);
                                            // Lấy danh sách tất cả các product_id từ mảng $favourite
                                            $productIds = array_column($favourite, 'product_id'); //Lấy tất cả các product_id từ các mảng con trong $favourite và tạo ra một mảng chỉ chứa các product_id.

                                            // Kiểm tra xem $item->id có nằm trong danh sách product_id không
                                            $isFavourite =
                                                is_array($productIds) && in_array((string) $product->id, $productIds); //Kiểm tra xem product_id của $item->id có nằm trong danh sách sản phẩm yêu thích hay không. Chúng ta ép kiểu item->id thành chuỗi để so sánh chính xác với product_id trong mảng (vì product_id trong cookie là chuỗi).
                                        }
                                    @endphp

                                    <div class="item">
                                        <div class="product_box">
                                            <div class="product_box_effect">
                                                @if (isset($productDiscountPrice))
                                                    <div class="product_box_tag_sale">
                                                        {{ $percent }}%</div>
                                                @endif
                                                <div class="product_box_icon">
                                                    <button onclick="addFavourite('{{ $product->id }}')"
                                                        class="outline-0 border-0"
                                                        style="background-color: transparent">
                                                        <i class="fa-solid fa-heart {{ $isFavourite ? 'red' : '' }}"
                                                            data-product-id="favourite-{{ $product->id }}"></i>
                                                    </button> <button class="outline-0 border-0 "
                                                        style="background-color: transparent"
                                                        onclick="showModalProduct(event,'{{ $product->id }}','{{ $product->image }}','{{ $product->name }}','{{ $product->price }}','{{ $priceDiscount }}','{{ json_encode($productImageCollect) }}')">
                                                        <i class="fa-regular fa-eye"></i>

                                                    </button>
                                                    {{-- truyền vào id sản phẩm và số lượng cần thêm,user_id server láy từ sesion --}}
                                                    <button type="button"
                                                        onclick="addToCart('{{ $product->id }}', 1)"
                                                        class="outline-0 border-0 "
                                                        style="background-color: transparent">
                                                        <i class="fa-solid fa-bag-shopping"></i>
                                                    </button>
                                                </div>
                                                <div class="product_box_image">
                                                    <img src="{{ asset('img/' . $product->image) }}"
                                                        alt="{{ $product->name }}" loading="lazy" />
                                                </div>
                                                <div class="product_box_content_out">
                                                    <div class="product_box_content">
                                                        <h3><a
                                                                href="{{ route('detail', $product->slug) }}">{{ $product->name }}</a>
                                                        </h3>

                                                    </div>
                                                    @if ($productDiscountPrice)
                                                        <div class="product_box_price">
                                                            <span>{{ number_format($product->price, 0, ',') . 'đ' }}</span>{{ number_format($productDiscountPrice->price, 0, ',') . 'đ' }}
                                                        </div>
                                                    @else
                                                        <div class="product_box_price">
                                                            <span></span>{{ number_format($product->price, 0, ',') . 'đ' }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif
@endforeach
