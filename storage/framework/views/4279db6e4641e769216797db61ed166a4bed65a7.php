<div class="cart-wrapper">
    <table class="table cart mb-5">
        <thead>
        <tr>
            <th class="cart-product-remove">&nbsp;</th>
            <th class="cart-product-thumbnail">&nbsp;</th>
            <th class="cart-product-name"><?php echo app('translator')->get('Product'); ?></th>
            <th class="cart-product-name"><?php echo app('translator')->get('Size'); ?></th>
            <th class="cart-product-price"><?php echo app('translator')->get('Price'); ?> </th>
            <th class="cart-product-quantity"><?php echo app('translator')->get('Quantity'); ?></th>
            <th class="cart-product-subtotal"><?php echo app('translator')->get('Total'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0;?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $total += $details['price'] * $details['quantity'];
                $alias_detail = Str::slug($details['title']);
                $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $alias_detail, $id, 'detail', 'san-pham');
            ?>
            <tr class="cart_item" data-id="<?php echo e($id); ?>">
            <td class="cart-product-remove">
                <a href="javascript:void(0)" class="remove remove-from-cart" title="<?php echo app('translator')->get('Remove this item'); ?>">
                <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
            <td class="cart-product-thumbnail">
                <a href="<?php echo e($url_link); ?>">
                <img width="64" height="64" src="<?php echo e($details['image_thumb'] ?? $details['image']); ?>"
                    alt="<?php echo e($details['title']); ?>">
                </a>
            </td>
            <td class="cart-product-name">
                <a href="<?php echo e($url_link); ?>"><?php echo e($details['title']); ?></a>
            </td>
            <td class="cart-product-size">
                <span class="amount">
                <?php echo e($details['size'] ?? ''); ?> g
                </span>
            </td>
            <td class="cart-product-price">
                <span class="amount">
                <?php echo e(isset($details['price']) && $details['price'] > 0 ? number_format($details['price']) : __('Contact')); ?>

                </span>
            </td>
            <td class="cart-product-quantity">
                <div class="quantity quantity-cart d-flex">
                    <input type="button" value="-" class="minus prev-cart">
                    <input type="number" name="quantity" value="<?php echo e($details['quantity']); ?>" autocomplete="off"
                        class="qty update-cart" />
                    <input type="button" value="+" class="plus next-cart">
                </div>
            </td>
            <td class="cart-product-subtotal">
                <span class="amount"><?php echo e(number_format($details['price'] * $details['quantity'])); ?></span>
            </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr class="cart_item">
            <td colspan="5">
            <div class="row justify-content-between my-4">
                <div class="col-lg-12">
                <a href="<?php echo e(url()->current()); ?>" class="button btn-update m-0"><?php echo app('translator')->get('Update Cart'); ?></a>
                </div>
            </div>
            </td>
            <td class="cart-product-subtotal">
            <span class="amount text-danger">
                <strong>
                <?php echo e(number_format($total)); ?>

                </strong>
            </span>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script>
    // $(function() {
    //     $('.quantity-cart .prev-cart').click(function() {
    //         let input = $(this).parents('.quantity-cart').find("input[type='number']");
    //         let value = parseFloat(input.val()) - 1;
    //         if (value < 1) {
    //             input.val(1);
    //         } else {
    //             input.val(value);
    //         }
    //         input.trigger('change');
    //     })
    //     $('.quantity-cart .next-cart').click(function() {
    //         let input = $(this).parents('.quantity-cart').find("input[type='number']");
    //         let value = parseFloat(input.val()) + 1;
    //         input.val(value);
    //         input.trigger('change');
    //     })
    // });
</script><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/components/cart/cart-components.blade.php ENDPATH**/ ?>