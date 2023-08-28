
<?php if($block): ?>
    <?php
        $title = $block->json_params->title->{$locale} ?? $block->title;
        $brief = $block->json_params->brief->{$locale} ?? $block->brief;
        $background = $block->image_background != '' ? $block->image_background : '';
        $image = $block->image != '' ? $block->image : '';
        $url_link = $block->url_link != '' ? $block->url_link : '';
        $icon = $block->icon ?? '';
        $url_link_title = $block->json_params->url_link_title->{$locale} ?? $block->url_link_title;
        $params_block['parent_id'] = $block->id;
        $params_block['block_code'] = 'introduce';
        $params_block['status'] = App\Consts::STATUS['active'];
        $params_block['order_by'] = [
            'iorder' => 'ASC',
            'id' => 'DESC'
        ];
        // $block_childs = $blocks->filter(function ($item, $key) use ($block) {
        //     return $item->parent_id == $block->id;
        // });
        $block_childs = App\Http\Services\PageBuilderService::getBlockContent($params_block)
        ->get();
        $i = 1;
    ?>
    <section id="process">
        <div class="container container-1160" id="<?php echo e($block->id); ?>">
            <h3 class="technology-title"><?php echo e($title); ?></h3>
            <div class="row">
                <div class="col-lg-6 col-12 technology-process_img">
                <img class="img-fluid w-100 h-100" src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>">
                </div>
                <div class="col-lg-6 col-12">
                <img class="img-fluid w-100" src="<?php echo e($background); ?>" alt="<?php echo e($background); ?>">
                </div>
            </div>
            <?php if(isset($block_childs)): ?>
            <div class="row">
                <?php $__currentLoopData = $block_childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->parent_id == $block->id): ?>
                        <?php
                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $description = $item->json_params->description->{$locale} ?? $item->description;
                            $formattedNumber = str_pad($i++, 2, '0', STR_PAD_LEFT);
                        ?>
                        <div class="col-lg-3 col-12">
                            <div class="process d-flex">
                                <div class="number"><?php echo e($formattedNumber); ?></div>
                                <div class="process-detail">
                                <div class="title"><?php echo e($title); ?></div>
                                <div class="desc mt-5 mb-0">
                                    <?php echo e($description); ?>

                                </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/blocks/introduce/styles/process.blade.php ENDPATH**/ ?>