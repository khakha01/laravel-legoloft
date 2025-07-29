        <!-- START LỰA CHỌN -->
        <section class="product">
            <div class="container" data-aos="fade-up">
                <div class="title_home">
                    <h2>Những lựa chọn hàng đầu trong tuần này</h2>
                </div>
                <div class="row">
                    @foreach ($categoryChoose as $item)
                        <div class="col-md-4">
                            <div class="card_box">
                                <div class="card_box_img">
                                    <img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->name }}"
                                        loading="lazy" />
                                </div>
                                <div class="card_box_content">
                                    <h3>{{ $item->name }}</h3>
                                </div>
                                <div class="card_box_btn">
                                    <a href="{{ route('categoryProduct', $item->id) }}">Xem ngay</a>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- END LỰA CHỌN -->
