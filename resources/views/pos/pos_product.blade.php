@foreach($product as $prod)

    <div class="col-xl-2 col-md-4 pos-rl">
        <a id="pid{{ $prod->id }}" get_product="{{ URL::to('pos/read-barcode/'.$prod->sku.'/'.$shop) }}" onclick="click_product({{ $prod->id }})" title="{{ $prod->name }}">
            <div class="card product-box card-b">
                <div class="card-body p-1">
                    <div class="product-img">
                        <figure style="background-image:url({{ $prod->get_photo() }})"> 
    
                        </figure>
                        
                    </div>
                    
                    <div class="detail">
                        <div class="box-detail">
                        <h4 class="font-14">{{ mb_substr($prod->name,0,35,'UTF-8') }} </h4>
                        </div>
                        <h5 class="my-0 font-14 float-right">
                            <b>{{ number_format($prod->price,2,'.',',') }}</b></h5>
                        <span class="badge badge-soft-primary">sku {{ $prod->sku }}</span>
                    </div>
                </div>
            </div>
            <!-- end product-box -->
        </a>
    </div>

@endforeach