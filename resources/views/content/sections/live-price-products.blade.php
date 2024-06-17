<div class="uk-grid dash-charts__grid uk-slider-items">
    @foreach($products as $product)
        @php
            $price_diff = $product->amount_before_tax-$product->amount_before_tax_old;
            $image_url = "chart-sample.png";
            if($product->amount_before_tax_old==0){
                $price_diff_per = "0.00";
            } else {
                $price_diff_per = number_format($price_diff*100/$product->amount_before_tax_old, 2);
            }
            if($price_diff>0){
                $image_url = "decrease-graph.svg";
            }
            $price_diff = rtrim(rtrim(number_format($price_diff, 5), '0'), '.');
            $price_diff_per = number_format($price_diff_per, 2);
        @endphp
        <div class="uk-width-1-4 dash-charts__col">
            <!-- <a href="/buyer-home?search={{$product->product_name}}&price_min=&price_max="> -->
            <a href="{{route("register")}}">
                <div class="dash-charts__item">
                    <div class="dash-charts__upper">
                        <div class="dash-charts__icon">
                            <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                        </div>
                        <div class="dash-charts__text">
                            <h2 class="dash-charts__title">{{$product->product_name}}</h2>
                        </div>
                        <div class="dash-charts__object">
                            <img src="{{asset('assets/front/images/'.$image_url)}}" width="101" height="47" alt="proce chart for {{ $product->product_name }}">
                        </div>
                    </div>
                    <div class="dash-charts__down">
                        <div class="dash-charts__price">
                            <div class="dash-charts__price-text" style="color: #000;">
                                {{formatAmountForItaly($product->amount_before_tax)}}
                            </div>
                            <div class="dash-charts__price-type">
                                {{ $product->seller_name }}
                            </div>
                        </div>
                        <div class="dash-charts__perc">
                            <div class="dash-charts__perc-count {{$price_diff>0?"uk-text-danger":"uk-text-success"}}">
                                {{$price_diff>0?"+".formatAmountForItaly($price_diff):formatAmountForItaly($price_diff)}} ({{$price_diff>0?"+".formatAmountForItaly($price_diff_per, false, "%", 2, false):formatAmountForItaly($price_diff_per, false, "%", 2, false)}})
                            </div>
                            {{-- <div class="dash-charts__perc-text">
                                Prezzo di mercato
                            </div> --}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>