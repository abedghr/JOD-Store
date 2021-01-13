@foreach ($search_products as $product)
<div class="col-md-4 product-men">
    <div class="men-pro-item simpleCart_shelfItem">
        <div class="men-thumb-item">
            <img src="../img/Product_images/{{$product->main_image}}" alt="" class="pro-image-front">
            <img src="../img/Product_images/{{$product->main_image}}" alt="" class="pro-image-back">
                <div class="men-cart-pro">
                    <div class="inner-men-cart-pro">
                        <a href="'.route('product.show2',['id'=>$product->id]).'" class="link-product-add-cart">Quick View</a>
                    </div>
                </div>
                
                
        </div>
        <div class="item-info-product ">
            <h4><a href="single.html" class="js-name-detail">{{$product->prod_name}}</a></h4>
            <p><a href="">Store: {{$product->prov->name}}</a></p>
            <p>Gender: {{$product->gender}}</p>
            <div class="info-product-price">
                <span class="item_price">{{number_format($product->new_price,2)}} JOD</span>
                <del>{{number_format($product->old_price,2)}}JOD</del>
            </div>
            <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
                <input type="submit" name="submit" value="Add to cart" class="button js-addcart-detail" onclick="addca($product->id)" />
            </div>
        </div>
    </div>
</div>
@endforeach