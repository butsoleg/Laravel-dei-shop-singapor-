<div class="item">
    <a href="{{url($data['url'], $data['item']->id) }}" class="text-center">
        <div class="product-poster">
        <div class="inner">
            @if($data['url'] == 'category')
            <img class="img-fluid" src="{{ $data['item']->image_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+Shop+600px.png' }}" alt="">
            @else
            <img class="img-fluid" src="{{ $data['item']->logo_url?:'https://dei-store.s3-ap-southeast-1.amazonaws.com/Placeholder+Shop+600px.png' }}" alt="">
            @endif
        </div>
        </div>
        <span class="title">{{ $data['item']->short_name??$data['item']->name }}</span>
    </a>
</div>
