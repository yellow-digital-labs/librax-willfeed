@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', 'Home')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
<!-- Custom css -->
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
@if($product_detail)
<script src="{{asset('assets/js/product-detail.js')}}"></script>
@else
<script src="{{asset('assets/js/product-detail-add.js')}}"></script>
@endif
@endsection

@section('content')
@error('msg')
  <div class="alert alert-danger" role="alert">
    <div class="alert-body">
      <div class="fw-bold">{{ __($message) }}</div>
    </div>
  </div>
@enderror
<h1 class="h3 text-black mb-4">Aggiungi prodotto</h4>
<form id="productForm" onsubmit="return false" method="POST">
    @csrf
    <div class="row align-items-start g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between border-bottom">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 text-black">Scegli prodotto</h5>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="product_id">Prodotto</label>
                        @if($product_detail)
                            <input type="hidden" id="product_id" name="product_id" value="{{$product_detail?$product_detail->product_id:''}}" />
                            <input type="text" id="product_id_val" class="form-control" value="{{$product_detail?$product_detail->product_name:''}}" readonly />
                        @else
                            <select name="product_id" id="product_id" class="form-select select2" data-minimum-results-for-search="Infinity">
                                <option value="">Seleziona prodotti </option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}" {{$product_detail?($product_detail->product_id==$product->id?'selected':''):''}}>{{$product->name}}</option>
                            @endforeach
                            </select>
                        @endif
                        </div>
                        <div class="col-12">
                            <label for="product-details-container" class="fw-semibold">Descrizione</label>
                            <div id="product-details-container">
                                {!! $_product?$_product->description:'' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between border-bottom">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 text-black">
                            Prezzo
                            @if($product_detail)
                                @if(date('Y-m-d', strtotime($product_detail->updated_at)) == date('Y-m-d'))
                                    <div class="badge rounded bg-label-success">VALIDO</div>
                                @else
                                    <div class="badge rounded bg-label-danger">SCADUTO</div>
                                @endif
                            @endif
                        </h5>
                        @if($product_detail)
                        <span><strong>PREZZO PER IL: {{App\Helpers\Helpers::calculateEstimateShippingDate($product_detail->delivery_time, $product_detail->delivery_days, $product_detail->days_off)}}</strong></span>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="amount_before_tax">Prezzo a vista</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" name="amount_before_tax" id="amount_before_tax" class="form-control js-price-input" placeholder="0,00" value="{{$product_detail?$product_detail->amount_before_tax:''}}" lang="es-ES" step=".01" />
                                <span class="input-group-text">/litri</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="amount_30gg">Prezzo 30gg</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" name="amount_30gg" id="amount_30gg" class="form-control js-price-input" placeholder="0,00" value="{{$product_detail?$product_detail->amount_30gg:''}}" step=".01" />
                                <span class="input-group-text">/litri</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="amount_60gg">Prezzo 60gg</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" name="amount_60gg" id="amount_60gg" class="form-control js-price-input" placeholder="0,00" value="{{$product_detail?$product_detail->amount_60gg:''}}" step=".01" />
                                <span class="input-group-text">/litri</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="amount_90gg">Prezzo 90gg</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input type="number" name="amount_90gg" id="amount_90gg" class="form-control js-price-input" placeholder="0,00" value="{{$product_detail?$product_detail->amount_90gg:''}}" step=".01" />
                                <span class="input-group-text">/litri</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <p class="small mb-0">IVA: 22%</p>
                            <p class="small">Prezzo incluso iva: €<span id="amount">{{$product_detail?number_format($product_detail->amount, 2, ',', '.'):'0,00'}}</span></p>
                        </div>

                        <!-- <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" value="yes" id="add_vat_to_price" />
                            <label class="form-check-label" for="add_vat_to_price">
                                Aggiungi IVA al prezzo
                            </label>
                        </div> -->
                        <hr/>

                        <div class="col-12">
                            <label class="form-label" for="delivery_time">Prezzi validi fino alle ore</label>
                            <div class="input-group">
                                <input type="time" name="delivery_time" id="delivery_time" class="form-control" placeholder="" value="{{$product_detail?$product_detail->delivery_time:''}}" />
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="days_off">Giorni di chiusura</label>
                            <select name="days_off[]" id="days_off" class="form-select select2" data-minimum-results-for-search="Infinity" multiple>
                                <option value="">Seleziona giorni non operativi </option>
                            @foreach ($days as $day)
                                <option value="{{$day}}" {{$product_detail?(in_array($day, explode(",",$product_detail->days_off))?'selected':''):''}}>{{$day}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <label class="form-check-label" for="status">Disponibilità</label>
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="active" {{$product_detail?($product_detail->status=='active'?'checked':''):'checked'}}>
                        </div>

                        {{-- @if($product_detail) --}}
                        <button type="submit" class="btn btn-dark btn-next btn-submit waves-effect waves-light">Save</button>
                        {{-- @endif --}}
                        
                    </div>
                </div>
            </div>


            {{-- @if($product_detail) --}}
            {{-- <div class="card">
                <div class="card-header d-flex justify-content-between border-bottom">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 text-black">Inventory</h5>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <h5 class="fw-normal">Restock</h5>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="qty">Add to stock</label>
                            <div class="row g-3 mb-4">
                                <div class="col">
                                    <div class="input-group">
                                        @php
                                            $qty = "100000";
                                            if($product_detail){
                                                $qty = "";
                                            }
                                        @endphp
                                        <input type="number" id="qty" name="qty" class="form-control" placeholder="Quantity" value="{{$qty}}"/>
                                        <span class="input-group-text">litri</span>
                                    </div>
                                </div>
                                @if($product_detail)
                                <div class="col-auto">
                                    <button type="button" class="btn btn-dark btn-next btn-submit waves-effect waves-light" id="inventory-submit"><i class="ti ti-check me-2"></i> Confirm</button>
                                </div>
                                @endif
                            </div>
                            <p><span class="fw-semibold me-2">Product in stock now:</span> <span id="current_stock">{{$product_detail?number_format($product_detail->current_stock, 0, ',', '.'):'NA'}}</span> litri</p>
                            <p><span class="fw-semibold me-2">Product in transit:</span> <span id="stock_in_transit">{{$product_detail?number_format($product_detail->stock_in_transit, 0, ',', '.'):'NA'}}</span> litri</p>
                            <p><span class="fw-semibold me-2">Last time restocked:</span> <span id="stock_updated_at">{{$product_detail&&$product_detail->stock_updated_at?date('dS F, Y', strtotime($product_detail->stock_updated_at)):'NA'}}</span></p>
                            <p><span class="fw-semibold me-2">Total stock over lifetime:</span> <span id="stock_lifetime">{{$product_detail?number_format($product_detail->stock_lifetime, 0, ',', '.'):'NA'}}</span> litri</p>
                        </div>

                        @if(!$product_detail)
                            <button type="submit" class="btn btn-dark btn-next btn-submit waves-effect waves-light mt-2 me-2">Save</button>
                        @endif
                    </div>
                </div>
            </div> --}}
            {{-- @endif --}}
        </div>

    </div>
</form>



@endsection