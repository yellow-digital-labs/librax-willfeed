<div class="uk-grid dash-charts__grid uk-slider-items">
    @foreach($products as $product)
        @php
            $price_diff = $product->today_price-$product->old_price;
            $image_url = "decrease-graph.svg";
            if($product->old_price==0){
                $price_diff_per = "0.00";
            } else {
                $price_diff_per = number_format($price_diff*100/$product->old_price, 2);
            }
            if($price_diff>0){
                $image_url = "chart-sample.png";
            }
            $price_diff = number_format($price_diff, 2);
            $price_diff_per = number_format($price_diff_per, 2);
        @endphp
        <div class="uk-width-1-4 dash-charts__col">
            <div class="dash-charts__item">
                <div class="dash-charts__upper">
                    <div class="dash-charts__icon">
                        <img src="{{asset('assets/front/images/liquid-drop.png')}}" width="33" height="33">
                    </div>
                    <div class="dash-charts__text">
                        <h2 class="dash-charts__title">{{$product->name}}</h2>
                        <div class="dash-charts__about">{{$product->name}}</div>
                    </div>
                    <div class="dash-charts__object">
                        <img src="{{asset('assets/front/images/'.$image_url)}}" width="101" height="47" alt="chart sample image">
                    </div>
                </div>
                <div class="dash-charts__down">
                    <div class="dash-charts__price">
                        <div class="dash-charts__price-text">
                            €{{number_format($product->today_price, 2)}}
                        </div>
                        <div class="dash-charts__price-type">
                            Prezzo di mercato
                        </div>
                    </div>
                    <div class="dash-charts__perc">
                        <div class="dash-charts__perc-count {{$price_diff>0?"uk-text-success":"uk-text-danger"}}">
                            <span class="dash-charts__perc-arrow"></span>
                            {{$price_diff>0?"+".$price_diff:$price_diff}} ({{$price_diff>0?"+".$price_diff_per:$price_diff_per}}%)
                        </div>
                        {{-- <div class="dash-charts__perc-text">
                            Prezzo di mercato
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>