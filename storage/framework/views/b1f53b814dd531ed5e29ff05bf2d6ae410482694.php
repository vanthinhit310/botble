<section id="category_section" class="category_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if(isset($feature_news)): ?>
                    <div class="category_section mobile">
                        <div class="article_title header_purple">
                            <h2><a href="javascript:;"
                                   target="_self"><?php echo e($feature_news['top_views']->categories[0]->name ?? 'Updating'); ?></a>
                            </h2>
                        </div>
                        <!----article_title------>
                        <?php if(!empty($feature_news['top_views'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="top_article_img">
                                            <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news['top_views']->slug ?? ''); ?>" target="_self"><img class="img-responsive"
                                                                                       src="<?php echo e(asset($feature_news['top_views']->image_link ?? '')); ?>"
                                                                                       alt="feature-top">
                                            </a>
                                        </div>
                                        <!----top_article_img------>
                                    </div>
                                    <div class="col-md-6">
                                        <span
                                            class="tag purple"><?php echo e($feature_news['top_views']->categories[0]->name ?? 'Updating'); ?></span>

                                        <div class="category_article_title">
                                            <h2><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news['top_views']->slug ?? ''); ?>"
                                                   target="_self"><?php echo e(str_limit($feature_news['top_views']->name,30) ?? 'Updating'); ?></a>
                                            </h2>
                                        </div>
                                        <!----category_article_title------>
                                        <div class="category_article_date"><a
                                                href="#"><?php echo e(($feature_news['top_views']->created_at->toDateString()) ?? 'Updating'); ?></a>,
                                            by: <a
                                                href="#"><?php echo e(($feature_news['top_views']->author->first_name.' '.$feature_news['top_views']->author->last_name) ?? 'Updating'); ?></a>
                                        </div>
                                        <!----category_article_date------>
                                        <div class="category_article_content">
                                            <?php echo e(str_limit($feature_news['top_views']->description,90) ?? 'Updating'); ?>

                                        </div>
                                        <!----category_article_content------>
                                        <div class="media_social">
                                            <span><a href="#"><i
                                                        class="fa fa-eye"></i><?php echo e($feature_news['top_views']->views ?? 0); ?> </a> views</span>
                                            <span><i class="fal fa-comments"></i><a href="#">4</a> Comments</span>
                                        </div>
                                        <!----media_social------>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($feature_news['featured_post'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <?php $__currentLoopData = $feature_news['featured_post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"><img class="media-object post-image"
                                                                     src="<?php echo e(asset($post->image_link) ?? ''); ?>"
                                                                     alt="Generic placeholder image"></a>
                                                </div>
                                                <div class="media-body">
                                                    <span
                                                        class="tag purple"><?php echo e($post->categories[0]->name ?? 'Updating'); ?></span>

                                                    <h3 class="media-heading"><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"
                                                                                 target="_self"><?php echo e((str_limit($post->name,20)) ?? 'Updating'); ?></a>
                                                    </h3>
                                                    <span class="media-date"><a
                                                            href="#"><?php echo e(($post->created_at->toDateString()) ?? 'Updating'); ?></a>,  by: <a
                                                            href="#"><?php echo e(($post->author->first_name.' '.$post->author->last_name) ?? 'Updating'); ?></a></span>

                                                    <div class="media_social">
                                                    <span><a href="#"><i
                                                                class="fa fa-eye"></i><?php echo e($post->views ?? 0); ?></a> Views</span>
                                                        <span><a href="#"><i class="fal fa-comments"></i></i>4</a> Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <p class="divider"><a href="javascript:;">More News&nbsp;&raquo;</a></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <!--Laravel-->
                <?php if(isset($feature_news_js)): ?>
                    <div class="category_section mobile">
                        <div class="article_title header_purple">
                            <h2><a href="javascript:;"
                                   target="_self"><?php echo e($feature_news_js['top_views']->categories[0]->name ?? 'Updating'); ?></a>
                            </h2>
                        </div>
                        <!----article_title------>
                        <?php if(!empty($feature_news_js['top_views'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="top_article_img">
                                            <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news_js['top_views']->slug ?? ''); ?>" target="_self"><img class="img-responsive"
                                                                                       src="<?php echo e(asset($feature_news_js['top_views']->image_link ?? '')); ?>"
                                                                                       alt="feature-top">
                                            </a>
                                        </div>
                                        <!----top_article_img------>
                                    </div>
                                    <div class="col-md-6">
                                        <span
                                            class="tag purple"><?php echo e($feature_news_js['top_views']->categories[0]->name ?? 'Updating'); ?></span>

                                        <div class="category_article_title">
                                            <h2><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news_js['top_views']->slug ?? ''); ?>"
                                                   target="_self"><?php echo e(str_limit($feature_news_js['top_views']->name,30) ?? 'Updating'); ?></a>
                                            </h2>
                                        </div>
                                        <!----category_article_title------>
                                        <div class="category_article_date"><a
                                                href="#"><?php echo e(($feature_news_js['top_views']->created_at->toDateString()) ?? 'Updating'); ?></a>,
                                            by: <a
                                                href="#"><?php echo e(($feature_news_js['top_views']->author->first_name.' '.$feature_news_js['top_views']->author->last_name) ?? 'Updating'); ?></a>
                                        </div>
                                        <!----category_article_date------>
                                        <div class="category_article_content">
                                            <?php echo e(str_limit($feature_news['top_views']->description,90) ?? 'Updating'); ?>

                                        </div>
                                        <!----category_article_content------>
                                        <div class="media_social">
                                            <span><a href="#"><i
                                                        class="fa fa-eye"></i><?php echo e($feature_news_js['top_views']->views ?? 0); ?> </a> views</span>
                                            <span><i class="fal fa-comments"></i><a href="#">4</a> Comments</span>
                                        </div>
                                        <!----media_social------>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($feature_news_js['featured_post'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <?php $__currentLoopData = $feature_news_js['featured_post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"><img class="media-object post-image"
                                                                     src="<?php echo e(asset($post->image_link) ?? ''); ?>"
                                                                     alt="Generic placeholder image"></a>
                                                </div>
                                                <div class="media-body">
                                                    <span
                                                        class="tag purple"><?php echo e($post->categories[0]->name ?? 'Updating'); ?></span>

                                                    <h3 class="media-heading"><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"
                                                                                 target="_self"><?php echo e((str_limit($post->name,20)) ?? 'Updating'); ?></a>
                                                    </h3>
                                                    <span class="media-date"><a
                                                            href="#"><?php echo e(($post->created_at->toDateString()) ?? 'Updating'); ?></a>,  by: <a
                                                            href="#"><?php echo e(($post->author->first_name.' '.$post->author->last_name) ?? 'Updating'); ?></a></span>

                                                    <div class="media_social">
                                                    <span><a href="#"><i
                                                                class="fa fa-eye"></i><?php echo e($post->views ?? 0); ?></a> Views</span>
                                                        <span><a href="#"><i class="fal fa-comments"></i></i>4</a> Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <p class="divider"><a href="javascript:;">More News&nbsp;&raquo;</a></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <!--js-->
                <?php if(isset($feature_news_css)): ?>
                    <div class="category_section mobile">
                        <div class="article_title header_purple">
                            <h2><a href="javascript:;"
                                   target="_self"><?php echo e($feature_news_css['top_views']->categories[0]->name ?? 'Updating'); ?></a>
                            </h2>
                        </div>
                        <!----article_title------>
                        <?php if(!empty($feature_news_css['top_views'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="top_article_img">
                                            <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news_css['top_views']->slug ?? ''); ?>" target="_self"><img class="img-responsive"
                                                                                       src="<?php echo e(asset($feature_news_css['top_views']->image_link ?? '')); ?>"
                                                                                       alt="feature-top">
                                            </a>
                                        </div>
                                        <!----top_article_img------>
                                    </div>
                                    <div class="col-md-6">
                                        <span
                                            class="tag purple"><?php echo e($feature_news_css['top_views']->categories[0]->name ?? 'Updating'); ?></span>

                                        <div class="category_article_title">
                                            <h2><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news_css['top_views']->slug ?? ''); ?>"
                                                   target="_self"><?php echo e(str_limit($feature_news_css['top_views']->name,30) ?? 'Updating'); ?></a>
                                            </h2>
                                        </div>
                                        <!----category_article_title------>
                                        <div class="category_article_date"><a
                                                href="#"><?php echo e(($feature_news_css['top_views']->created_at->toDateString()) ?? 'Updating'); ?></a>,
                                            by: <a
                                                href="#"><?php echo e(($feature_news_css['top_views']->author->first_name.' '.$feature_news_css['top_views']->author->last_name) ?? 'Updating'); ?></a>
                                        </div>
                                        <!----category_article_date------>
                                        <div class="category_article_content">
                                            <?php echo e(str_limit($feature_news_css['top_views']->description,90) ?? 'Updating'); ?>

                                        </div>
                                        <!----category_article_content------>
                                        <div class="media_social">
                                            <span><a href="#"><i
                                                        class="fa fa-eye"></i><?php echo e($feature_news_css['top_views']->views ?? 0); ?> </a> views</span>
                                            <span><i class="fal fa-comments"></i><a href="#">4</a> Comments</span>
                                        </div>
                                        <!----media_social------>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($feature_news_css['featured_post'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <?php $__currentLoopData = $feature_news_css['featured_post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"><img class="media-object post-image"
                                                                     src="<?php echo e(asset($post->image_link) ?? ''); ?>"
                                                                     alt="Generic placeholder image"></a>
                                                </div>
                                                <div class="media-body">
                                                    <span
                                                        class="tag purple"><?php echo e($post->categories[0]->name ?? 'Updating'); ?></span>

                                                    <h3 class="media-heading"><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"
                                                                                 target="_self"><?php echo e((str_limit($post->name,20)) ?? 'Updating'); ?></a>
                                                    </h3>
                                                    <span class="media-date"><a
                                                            href="#"><?php echo e(($post->created_at->toDateString()) ?? 'Updating'); ?></a>,  by: <a
                                                            href="#"><?php echo e(($post->author->first_name.' '.$post->author->last_name) ?? 'Updating'); ?></a></span>

                                                    <div class="media_social">
                                                    <span><a href="#"><i
                                                                class="fa fa-eye"></i><?php echo e($post->views ?? 0); ?></a> Views</span>
                                                        <span><a href="#"><i class="fal fa-comments"></i></i>4</a> Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <p class="divider"><a href="javascript:;">More News&nbsp;&raquo;</a></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <!--css-->
                <?php if(isset($feature_news_ruby)): ?>
                    <div class="category_section mobile">
                        <div class="article_title header_purple">
                            <h2><a href="javascript:;"
                                   target="_self"><?php echo e($feature_news_ruby['top_views']->categories[0]->name ?? 'Updating'); ?></a>
                            </h2>
                        </div>
                        <!----article_title------>
                        <?php if(!empty($feature_news_ruby['top_views'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="top_article_img">
                                            <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news_ruby['top_views']->slug ?? ''); ?>" target="_self"><img class="img-responsive"
                                                                                       src="<?php echo e(asset($feature_news_ruby['top_views']->image_link ?? '')); ?>"
                                                                                       alt="feature-top">
                                            </a>
                                        </div>
                                        <!----top_article_img------>
                                    </div>
                                    <div class="col-md-6">
                                        <span
                                            class="tag purple"><?php echo e($feature_news_ruby['top_views']->categories[0]->name ?? 'Updating'); ?></span>

                                        <div class="category_article_title">
                                            <h2><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($feature_news_ruby['top_views']->slug ?? ''); ?>"
                                                   target="_self"><?php echo e(str_limit($feature_news_ruby['top_views']->name,30) ?? 'Updating'); ?></a>
                                            </h2>
                                        </div>
                                        <!----category_article_title------>
                                        <div class="category_article_date"><a
                                                href="#"><?php echo e(($feature_news_ruby['top_views']->created_at->toDateString()) ?? 'Updating'); ?></a>,
                                            by: <a
                                                href="#"><?php echo e(($feature_news_ruby['top_views']->author->first_name.' '.$feature_news_ruby['top_views']->author->last_name) ?? 'Updating'); ?></a>
                                        </div>
                                        <!----category_article_date------>
                                        <div class="category_article_content">
                                            <?php echo e(str_limit($feature_news_ruby['top_views']->description,90) ?? 'Updating'); ?>

                                        </div>
                                        <!----category_article_content------>
                                        <div class="media_social">
                                            <span><a href="#"><i
                                                        class="fa fa-eye"></i><?php echo e($feature_news_ruby['top_views']->views ?? 0); ?> </a> views</span>
                                            <span><i class="fal fa-comments"></i><a href="#">4</a> Comments</span>
                                        </div>
                                        <!----media_social------>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($feature_news_ruby['featured_post'])): ?>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <?php $__currentLoopData = $feature_news_ruby['featured_post']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"><img class="media-object post-image"
                                                                     src="<?php echo e(asset($post->image_link) ?? ''); ?>"
                                                                     alt="Generic placeholder image"></a>
                                                </div>
                                                <div class="media-body">
                                                    <span
                                                        class="tag purple"><?php echo e($post->categories[0]->name ?? 'Updating'); ?></span>

                                                    <h3 class="media-heading"><a href="<?php echo e(route('public.blog.details')); ?>/<?php echo e($post->slug ?? ''); ?>"
                                                                                 target="_self"><?php echo e((str_limit($post->name,20)) ?? 'Updating'); ?></a>
                                                    </h3>
                                                    <span class="media-date"><a
                                                            href="#"><?php echo e(($post->created_at->toDateString()) ?? 'Updating'); ?></a>,  by: <a
                                                            href="#"><?php echo e(($post->author->first_name.' '.$post->author->last_name) ?? 'Updating'); ?></a></span>

                                                    <div class="media_social">
                                                    <span><a href="#"><i
                                                                class="fa fa-eye"></i><?php echo e($post->views ?? 0); ?></a> Views</span>
                                                        <span><a href="#"><i class="fal fa-comments"></i></i>4</a> Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <p class="divider"><a href="javascript:;">More News&nbsp;&raquo;</a></p>
                        <?php endif; ?>
                    </div>
            <?php endif; ?>
            <!--ror-->
                <?php if ($__env->exists('main::views.home.video')) echo $__env->make('main::views.home.video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- Left Section -->
        <?php if ($__env->exists('main::views.general.right_sidebar')) echo $__env->make('main::views.general.right_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\botble\platform\plugins\blog\src\Providers/../../../../themes/general//views/home/category_new.blade.php ENDPATH**/ ?>