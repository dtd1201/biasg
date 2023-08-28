
@if ($block)
    @php
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
    @endphp
    <section id="process">
        <div class="container container-1160" id="{{ $block->id }}">
            <h3 class="technology-title">{{ $title }}</h3>
            <div class="row">
                <div class="col-lg-6 col-12 technology-process_img">
                <img class="img-fluid w-100 h-100" src="{{ $image }}" alt="{{ $title }}">
                </div>
                <div class="col-lg-6 col-12">
                <img class="img-fluid w-100" src="{{ $background }}" alt="{{ $background }}">
                </div>
            </div>
            @isset($block_childs)
            <div class="row">
                @foreach($block_childs as $item)
                    @if($item->parent_id == $block->id)
                        @php
                            $title = $item->json_params->title->{$locale} ?? $item->title;
                            $description = $item->json_params->description->{$locale} ?? $item->description;
                            $formattedNumber = str_pad($i++, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <div class="col-lg-3 col-12">
                            <div class="process d-flex">
                                <div class="number">{{ $formattedNumber}}</div>
                                <div class="process-detail">
                                <div class="title">{{ $title }}</div>
                                <div class="desc mt-5 mb-0">
                                    {{ $description }}
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @endisset
        </div>
    </section>
@endif