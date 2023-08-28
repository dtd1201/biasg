<div class="cart-wrapper">
    <table class="table cart mb-5">
        <thead>
        <tr>
            <th class="cart-product-remove">&nbsp;</th>
            <th class="cart-product-thumbnail">&nbsp;</th>
            <th class="cart-product-name">@lang('Product')</th>
            <th class="cart-product-name">@lang('Size')</th>
            <th class="cart-product-price">@lang('Price') </th>
            <th class="cart-product-quantity">@lang('Quantity')</th>
            <th class="cart-product-subtotal">@lang('Total')</th>
        </tr>
        </thead>
        <tbody>
        @php $total = 0;@endphp
        @foreach ($data as $id => $details)
            @php
                $total += $details['price'] * $details['quantity'];
                $alias_detail = Str::slug($details['title']);
                $url_link = App\Helpers::generateRoute(App\Consts::TAXONOMY['product'], $alias_detail, $id, 'detail', 'san-pham');
            @endphp
            <tr class="cart_item" data-id="{{ $id }}">
            <td class="cart-product-remove">
                <a href="javascript:void(0)" class="remove remove-from-cart" title="@lang('Remove this item')">
                <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>
            <td class="cart-product-thumbnail">
                <a href="{{ $url_link }}">
                <img width="64" height="64" src="{{ $details['image_thumb'] ?? $details['image'] }}"
                    alt="{{ $details['title'] }}">
                </a>
            </td>
            <td class="cart-product-name">
                <a href="{{ $url_link }}">{{ $details['title'] }}</a>
            </td>
            <td class="cart-product-size">
                <span class="amount">
                {{ $details['size'] ?? '' }} g
                </span>
            </td>
            <td class="cart-product-price">
                <span class="amount">
                {{ isset($details['price']) && $details['price'] > 0 ? number_format($details['price']) : __('Contact') }}
                </span>
            </td>
            <td class="cart-product-quantity">
                <div class="quantity quantity-cart d-flex">
                    <input type="button" value="-" class="minus prev-cart">
                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" autocomplete="off"
                        class="qty update-cart" />
                    <input type="button" value="+" class="plus next-cart">
                </div>
            </td>
            <td class="cart-product-subtotal">
                <span class="amount">{{ number_format($details['price'] * $details['quantity']) }}</span>
            </td>
            </tr>
        @endforeach
        <tr class="cart_item">
            <td colspan="5">
            <div class="row justify-content-between my-4">
                <div class="col-lg-12">
                <a href="{{ url()->current() }}" class="button btn-update m-0">@lang('Update Cart')</a>
                </div>
            </div>
            </td>
            <td class="cart-product-subtotal">
            <span class="amount text-danger">
                <strong>
                {{ number_format($total) }}
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
</script>