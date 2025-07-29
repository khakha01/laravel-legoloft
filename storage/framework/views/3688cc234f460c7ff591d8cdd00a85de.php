      <!-- START BÀI VIẾT -->
      <section>
          <div class="container">
              <div class="title_btn_blog">
                  <div class="title_home_blog">
                      <h2>Đọc tất cả về nó</h2>
                  </div>
                  <div class="btn_home_blog"><a href="<?php echo e(route('categoryArticleUser')); ?>">Xem tất cả bài viết</a>
                  </div>
              </div>
              <div class="row" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
                  <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-md-3 col-sm-4 col-12">
                          <div class="blog_box">
                              <div class="blog_box_effect">
                                  <div class="blog_box_image">
                                      <img src="<?php echo e(asset('img/' . $item->image)); ?>"
                                          alt="<?php echo e($item->title); ?>"loading="lazy" />
                                  </div>
                                  <div class="blog_box_content_out">
                                      <div class="blog_box_content">
                                          <h3>
                                              <a href="<?php echo e(route('articlesUser', $item->id)); ?>"><?php echo e($item->title); ?></a>
                                          </h3>
                                          <span> <?php echo $item->description_short; ?></span>
                                          <a href="<?php echo e(route('articlesUser', $item->id)); ?>">Đọc thêm <i
                                                  class="fa-solid fa-chevron-right"></i></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
          </div>
      </section>
      <!-- END BÀI VIẾT -->
<?php /**PATH D:\laragon\www\LARAVEL\laravel-legoloft\resources\views/homeBlog.blade.php ENDPATH**/ ?>