@extends('admin.layouts.app')

@section('title')
  {{ $module_name }}
@endsection
@php
    if (Request::get('lang') == $languageDefault->lang_locale || Request::get('lang') == '') {
        $lang = $languageDefault->lang_locale;
    } else {
        $lang = Request::get('lang');
    }
@endphp
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $module_name }}
      <a class="btn btn-sm btn-warning pull-right" href="{{ route(Request::segment(2) . '.create') }}"><i
          class="fa fa-plus"></i> @lang('Add')</a>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @if (session('errorMessage'))
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('errorMessage') }}
      </div>
    @endif
    @if (session('successMessage'))
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('successMessage') }}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach

      </div>
    @endif

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">@lang('Create form')</h3>
        @isset($languages)
          @foreach ($languages as $item)
              @if ($item->is_default == 1 && $item->lang_locale != Request::get('lang'))
                  @if (Request::get('lang') != '')
                      <a class="text-primary pull-right" href="{{ route(Request::segment(2) . '.create') }}"
                          style="padding-left: 15px">
                          <i class="fa fa-language"></i> {{ __($item->lang_name) }}
                      </a>
                  @endif
              @else
                  @if (Request::get('lang') != $item->lang_locale)
                      <a class="text-primary pull-right"
                          href="{{ route(Request::segment(2) . '.create') }}?lang={{ $item->lang_locale }}"
                          style="padding-left: 15px">
                          <i class="fa fa-language"></i> {{ __($item->lang_name) }}
                      </a>
                  @endif
              @endif
          @endforeach
        @endisset
      <span class="pull-right">@lang('Translations'): </span>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" action="{{ route(Request::segment(2) . '.store') }}" method="POST">
        @csrf
        @if (Request::get('lang') != '' && Request::get('lang') != $languageDefault->lang_locale)
            <input type="hidden" name="lang" value="{{ Request::get('lang') }}">
        @endif
        <div class="box-body">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="#tab_1" data-toggle="tab">
                  <h5>Thông tin chính <span class="text-danger">*</span></h5>
                </a>
              </li>

              <button type="submit" class="btn btn-primary btn-sm pull-right">
                <i class="fa fa-floppy-o"></i>
                @lang('Save')
              </button>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Service category') <small class="text-red">*</small></label>
                      <select name="taxonomy_id" id="taxonomy_id" class="form-control select2" style="width: 100%">
                        <option value="">@lang('Please select')</option>
                        @foreach ($parents as $item)
                          @if ($item->parent_id == 0 || $item->parent_id == null)
                            <option value="{{ $item->id }}" {{ old('taxonomy_id') == $item->id ? 'selected' : '' }}>
                              {{ $item->title }}</option>

                            @foreach ($parents as $sub)
                              @if ($item->id == $sub->parent_id)
                                <option value="{{ $sub->id }}"
                                  {{ old('taxonomy_id') == $sub->id ? 'selected' : '' }}>- - {{ $sub->title }}
                                </option>

                                @foreach ($parents as $sub_child)
                                  @if ($sub->id == $sub_child->parent_id)
                                    <option value="{{ $sub_child->id }}"
                                      {{ old('taxonomy_id') == $sub_child->id ? 'selected' : '' }}>- - - -
                                      {{ $sub_child->title }}</option>
                                  @endif
                                @endforeach
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>@lang('Title') <small class="text-red">*</small></label>
                      <input type="text" class="form-control" name="title" placeholder="@lang('Title')"
                        value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                      <label>@lang('File catalog')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="catalog" data-preview="catalog-holder" class="btn btn-primary lfm" data-type="file">
                            <i class="fa fa-file-pdf-o"></i> @lang('choose')
                          </a>
                        </span>
                        <input id="catalog" class="form-control" type="text" name="json_params[catalog]"
                          value="{{ $detail->json_params->catalog ?? '' }}" placeholder="@lang('Link file')...">
                      </div>
                    </div>
                    <div class="form-group">
                      <label>@lang('Image')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image" data-preview="image-holder" class="btn btn-primary lfm"
                            data-type="cms-image">
                            <i class="fa fa-picture-o"></i> @lang('choose')
                          </a>
                        </span>
                        <input id="image" class="form-control" type="text" name="image"
                          placeholder="@lang('image_link')...">
                      </div>
                      <div id="image-holder" style="margin-top:15px;max-height:100px;">
                        @if (old('image') != '')
                          <img style="height: 5rem;" src="{{ old('image') }}">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>@lang('Is featured')</label>
                      <div class="form-control">
                        <label>
                          <input type="radio" name="is_featured" value="1">
                          <small>@lang('true')</small>
                        </label>
                        <label>
                          <input type="radio" name="is_featured" value="0" class="ml-15" checked="">
                          <small>@lang('false')</small>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>@lang('Order')</label>
                      <input type="number" class="form-control" name="iorder" placeholder="@lang('Order')"
                        value="{{ old('iorder') }}">
                    </div>
                    <div class="form-group">
                      <label>@lang('Status')</label>
                      <div class="form-control">
                        <label>
                          <input type="radio" name="status" value="active" checked="">
                          <small>@lang('active')</small>
                        </label>
                        <label>
                          <input type="radio" name="status" value="deactive" class="ml-15">
                          <small>@lang('deactive')</small>
                        </label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>@lang('Image thumb')</label>
                      <div class="input-group">
                        <span class="input-group-btn">
                          <a data-input="image_thumb" data-preview="image_thumb-holder" class="btn btn-primary lfm"
                            data-type="cms-image">
                            <i class="fa fa-picture-o"></i> @lang('choose')
                          </a>
                        </span>
                        <input id="image_thumb" class="form-control" type="text" name="image_thumb"
                          placeholder="@lang('image_link')...">
                      </div>
                      <div id="image_thumb-holder" style="margin-top:15px;max-height:100px;">
                        @if (old('image_thumb') != '')
                          <img style="height: 5rem;" src="{{ old('image_thumb') }}">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr style="border-top: dashed 2px #a94442; margin: 10px 0px;">
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                        <label>@lang('Description')</label>
                        <textarea name="json_params[description][{{ $lang != '' ? $lang : $languageDefault->lang_code }}]" class="form-control" rows="5">{{ old('json_params[description][' . $lang != '' ? $lang : $languageDefault->lang_code . ']') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>@lang('Brief')</label>
                        <textarea name="json_params[brief][{{ $lang != '' ? $lang : $languageDefault->lang_code }}]" class="form-control" rows="5">{{ old('json_params[brief][' . $lang != '' ? $lang : $languageDefault->lang_code . ']') }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-group">
                            <label>@lang('Content')</label>
                            <textarea name="json_params[content][{{ $lang != '' ? $lang : $languageDefault->lang_code }}]" class="form-control" id="content_vi">{{ old('json_params[content][' . $lang != '' ? $lang : $languageDefault->lang_code . ']') }}</textarea>
                        </div>
                    </div>
                </div>
                  <div class="col-md-12">
                    <hr style="border-top: dashed 2px #a94442; margin: 10px 0px;">
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('seo_title')</label>
                      <input name="json_params[seo_title]" class="form-control"
                        value="{{ old('json_params[seo_title]') }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('seo_keyword')</label>
                      <input name="json_params[seo_keyword]" class="form-control"
                        value="{{ old('json_params[seo_keyword]') }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>@lang('seo_description')</label>
                      <input name="json_params[seo_description]" class="form-control"
                        value="{{ old('json_params[seo_description]') }}">
                    </div>
                  </div>
                </div>

              </div>

            </div><!-- /.tab-content -->
          </div><!-- nav-tabs-custom -->

        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <a class="btn btn-success btn-sm" href="{{ route(Request::segment(2) . '.index') }}">
            <i class="fa fa-bars"></i> @lang('List')
          </a>
          <button type="submit" class="btn btn-primary pull-right btn-sm"><i class="fa fa-floppy-o"></i>
            @lang('Save')</button>
        </div>
      </form>
    </div>
  </section>

@endsection

@section('script')
  <script>
    CKEDITOR.replace('content_vi', ck_options);
  </script>
@endsection
