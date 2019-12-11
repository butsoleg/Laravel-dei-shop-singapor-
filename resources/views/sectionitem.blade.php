@if (!empty($section->banner_url))
<section class="section-padding-2 block-border">
      <div class="container">
         <div class="full-width">
            @if(in_array($section->object_type, ['category','merchant','brand']) && $section->object_id)
            <a href="{{url($section->object_type.'/'.$section->object_id)}}">
            @elseif($section->object_type == 'url' && $section->object_url)
            <a href="{{$section->object_url}}">
            @else
            <a>
            @endif
               <img src="{{ $section->banner_url }}"  class="banner-border d-none d-lg-block">
               <img src="{{ $section->mobile_banner? $section->mobile_banner:$section->banner_url }}"  class="banner-border d-lg-none">
            </a>
         </div>
      </div>
      </section>
      @endif
      @if(in_array($section->type, ['categories','merchant','brands']))
      <section class="product-items-slider section-padding-2 featured_stores block-border">
      @elseif($section->type==='product')
      <section class="product-items-slider bestDeal section-padding-2 block-border">
      @else
      <section class="product-items-slider section-padding-2 block-border">
      @endif
         <div class="container">
            <div class="section-header">
               @if (empty($section->banner_url))
               <h5 class="heading-design-h5">{{$section->name}}
                    @if(in_array($section->type, ['categories','merchant','brands']))
                     <span class="float-right nav-pos">
                        <span class="prev"><i class='fas fa-chevron-left'></i></span>
                        <span class="next"><i class='fas fa-chevron-right'></i></span>
                     </span>
                     @endif
                     @if(in_array($section->object_type, ['category','merchant','brand']) && $section->object_id)
                    <a class="float-right text-secondary" href="{{url($section->object_type.'/'.$section->object_id)}}">View All</a>
                    @elseif($section->object_type == 'url' && $section->object_url)
                    <a class="float-right text-secondary" href="{{$section->object_url}}">View All</a>
                    @endif
                </h5>
                @endif
            </div>
        @if (in_array($section->type, ['categories','merchant','brands']))
         <div class="owl-carousel owl-carousel-featured featuredSlider" data-name="{{Str::slug($section->name)}}">
         @elseif($section->type==='product')
         <div class="owl-carousel owl-carousel-featured productsSlider" data-name="{{Str::slug($section->name)}}">
         @else
         <div class="owl-carousel owl-carousel-featured" data-name="{{Str::slug($section->name)}}">
         @endif
            @if(isset($section->merchants))
            @foreach($section->merchants as $merchant)
            @include('sectionrowitem', $data=['url'=>'merchant', 'item'=>$merchant])
            @endforeach
            @endif
            @if(isset($section->categories))
            @foreach($section->categories as $category)
            @include('sectionrowitem', $data=['url'=>'category', 'item'=>$category])
            @endforeach
            @endif
            @if(isset($section->brands))
            @foreach($section->brands as $brand)
            @include('sectionrowitem', $data=['url'=>'brand', 'item'=>$brand])
            @endforeach
            @endif
            @if(isset($section->products))
            @foreach($section->products as $product)
            @include('productitem', $data=['value' => $product, 'source' => 'home'])
            @endforeach
            @endif
            </div>
        </div>
    </section>
