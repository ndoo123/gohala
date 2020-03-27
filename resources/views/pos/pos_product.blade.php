
<p>
    <div class="row">


        @foreach($data as $data)

        
                <div class="col-xs-2 col-sm-2">
                    @if($data->p_sn == '1')
                        <a href="#modalForm" data-toggle="modal" data-href="{{ url('sale/get_sn_id/'.$data->p_id) }}" class="block text-center bg-image ribbon ribbon-info ribbon-right" style="background-image: url('{{ asset('images_product/'.$data->p_image) }}');" title="{{ $data->p_name }}">
                            <div class="ribbon-box px-1"><small>฿{{$data->p_price}}</small></div>
                            <div class="block-content block-content-full"></div>
                            <div class="block-content block-content-full"></div>
                            <div class="block-content block-content-full"></div>
                            <div class="block-content block-content-sm bg-black-50">
                                <p class="text-white mb-0">
                                    <small>{{ mb_substr($data->p_name,0,10) }}</small>
                            </div>
                        </a>

                    @else

                        <a  class="block text-center bg-image ribbon ribbon-info ribbon-right" style="background-image: url('{{ asset('images_product/'.$data->p_image) }}');" id="pid{{ $data->ps_sn }}" get_product="{{ URL::to('sale/read-barcode/'.$data->ps_sn) }}" onclick="click_product({{ $data->ps_sn }})" data-toggle="tooltip" title="{{ $data->p_name }}">
                            <div class="ribbon-box px-1"><small>฿{{$data->p_price}}</small></div>
                            <div class="block-content block-content-full"></div>
                            <div class="block-content block-content-full"></div>
                            <div class="block-content block-content-full"></div>
                            <div class="block-content block-content-sm bg-black-50">
                                <p class="text-white mb-0">
                                    <small>{{ mb_substr($data->p_name,0,10) }}</small>
                                </p>
                            </div>
                        </a>

                    @endif

                </div>


        @endforeach
        
    </div>


</p>