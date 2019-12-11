<div class="shop-filter">
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <span class="btn btn-link">
                    Category
                </span>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                 data-parent="#accordion">
                <div class="card-body">
                    <div id="accordionInner">
                        <div class="panel list-group">
                            <!-- panel class must be in -->
                            @if($launch_categories)
                                @foreach($launch_categories as $launch_category)
                                    @if(in_array($launch_category->id, $category_ids))
                                        <a href="#categories{{$launch_category->id}}"
                                           data-parent="#accordionInner" data-id="{{$launch_category->id}}"
                                           @if($launch_category->category) data-toggle="collapse"
                                           class="list-group-item collapsed" @endif>
                                            {{$launch_category->name}}
                                        </a>
                                        @if($launch_category->category)
                                            <div class="collapse accordionInner-sub"
                                                 id="categories{{$launch_category->id}}">
                                                <ul class="list-group-item-text">
                                                    @foreach($launch_category->category as $launch_cat)
                                                        @if(in_array($launch_cat->id, $category_ids))
                                                            <li>
                                                                <a @if($launch_cat->category) href="#category{{$launch_cat->id}}"
                                                                   data-parent="#categories{{$launch_category->id}}"
                                                                   data-toggle="collapse"
                                                                   class="list-group-item collapsed"
                                                                   @else href="#" data-id="{{$launch_cat->id}}"
                                                                   class="list-group-item--last" @endif>
                                                                    {{$launch_cat->name}}
                                                                </a>
                                                            </li>
                                                            @if($launch_cat->category)
                                                                <div class="collapse accordionInner-sub"
                                                                     id="category{{$launch_cat->id}}">
                                                                    <ul class="list-group-item-text">
                                                                        @foreach($launch_cat->category as $category)
                                                                            @if(in_array($category->id, $category_ids))
                                                                                <li>
                                                                                    <a @if($category->category) href="#cat{{$category->id}}"
                                                                                       data-parent="#category{{$launch_cat->id}}"
                                                                                       data-toggle="collapse"
                                                                                       class="list-group-item collapsed"
                                                                                       @else href="#"
                                                                                       data-id="{{$category->id}}"
                                                                                       class="list-group-item--last" @endif>
                                                                                        {{$category->name}}
                                                                                    </a>
                                                                                </li>
                                                                                @if($category->category)
                                                                                    <div class="collapse accordionInner-sub"
                                                                                         id="cat{{$category->id}}">
                                                                                        <ul class="list-group-item-text">
                                                                                            @foreach($category->category as $cat)
                                                                                                @if(in_array($cat->id, $category_ids))
                                                                                                <li>
                                                                                                    <a href="#">{{$cat->name}}</a>
                                                                                                </li>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endIf
                                @endforeach
                            @endIf
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" id="headingThree">
                <span class="btn btn-link">
                    Brand
                </span>
            </div>
            <div aria-labelledby="headingThree"
                 data-parent="#accordion">
                <div class="card-body">
                    <span class="label">Brand</span>
                    <form class="form">
                        <div class="form-group">
                            <input type="text" class="form-control search-brand-text" placeholder="Search By Brand">
                        </div>
                    </form>
                    <div class="mt-2 brands customScroll">
                        @if($launch_brands)
                            @foreach($launch_brands as $launch_brand)
                                @if(in_array($launch_brand->id, $brand_ids))
                                    <div class="custom-control custom-checkbox search_brand">
                                        <input type="checkbox" class="custom-control-input"
                                               id="b{{$launch_brand->id}}">
                                        <label class="custom-control-label"
                                               for="b{{$launch_brand->id}}">{{$launch_brand->name}}</label>
                                    </div>
                                @endIf
                            @endforeach
                        @endIf
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <span class="btn btn-link">
                    Price
                </span>
            </div>
            <div aria-labelledby="headingTwo"
                 data-parent="#accordion">
                <div class="card-body">
                    <div class="form-group price">
                        <input type="text" class="form-control" placeholder="Minimum Price"
                               id="price_min" name="price_min" value="{{$headers->price_min}}">
                        <i>S$</i>
                    </div>
                    <div class="form-group price">
                        <input type="text" class="form-control" placeholder="Maximum Price"
                               id="price_max" name="price_max" value="{{$headers->price_max}}">
                        <i>S$</i>
                    </div>
                </div>
            </div>
        </div>
        <span class="btn btn-link clear_filters"> Clear Filters</span>

    </div>
</div>