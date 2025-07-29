 <!-- START CATEGORY -->
 <div class="container">
     <div class="image_category" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
         <h3 class="text-center pt-3">Mua sắm theo chủ đề</h3>
         <ul class="image_category_ul">
             @foreach ($categoryAll as $item)
                 <li class="">
                     <a href="{{ route('categoryProduct', $item->id) }}" class="text-decoration-none">
                         <img src="{{ asset('img/' . $item->image) }}" alt="{{ $item->name }}" loading="lazy" />
                         <div class="image_category_span">
                             <span>{{ $item->name }}</span>
                         </div>
                     </a>
                 </li>
             @endforeach
         </ul>
     </div>
 </div>
 <!-- END CATEGORY -->
