@push("css")

<link href="{{asset('uni/assets/css/boxicons.min.css')}}" rel="stylesheet">
<link href="{{asset('uni/assets/css/shop.css')}}" rel="stylesheet">

@endpush


@php use App\Http\Controllers\Backend\Content\WidgetManagerController; @endphp
<div class="frontend-main-wrapper frontend-main-wrapper-school">
    <style type="text/css">
        .custom-list li {
            margin-bottom: 10px;
        }
        .subpage-about-vision-mission {
            background: #e3e3e3;
        }
        .subpage-about-wrapper {
            text-align: justify;
        }

        table,
        th,
        td {
            border: solid 1px #d2d2d2;

        }
        .table td, .table th{
            vertical-align: top;
        }
        table th {
            font-weight: 600;
            background: #696969;
            color: #fff;
        }
        .table > :not(:first-child) {
            border-top: 2px solid #000;
        }
        .qty-cart-table {
            width: 150px;
        }
        .subtotal-cart-table {
            text-align: right;
            width: 200px;
        }
        .remove-cart-table {
            width: 75px;
        }
        .phone-input .iti {
            width: 100%;
        }

        .swal2-icon.swal2-warning{
          font-size : 1rem;
        }
    </style>


    <div class="subpage-uni-main-header-wrapper">
        <div class="container">
            <div class="subpage-school-main-header-container text-center px-3 py-4">

                <ul id="progressbar">
                    <li class="active" id="delivery"><strong>Cart</strong></li>
                    <li id="billing"><strong>Billing</strong></li>
                    <li id="payment"><strong>Payment</strong></li>
                    <li id="confirm"><strong>Finish</strong></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="subpage-about-wrapper">
        <form class="" action="{{route('shop.cart.checkout')}}" method="post">
            @csrf
            <div class="subpage-about-vision-mission py-5">
                <div class="row g-5 w-75 m-auto">
                    <div class="col-lg-8">
                        <div>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                            <h4 class="font-weight-bold mb-0">My Cart</h4>
                            <hr style="border-top: 1px solid #bababa;" />
                            <div class="d-flex justify-content-end mb-3">
                                <!-- <button class="btn btn-primary rounded-round">Continue shopping</button> -->
                            </div>

                            <div style="overflow: auto; max-height: 600px;">
                                <table class="table table-striped table-hover cart-table">
                                    <thead>
                                        <tr>
                                            <th class="item-detail-cart-table">Item Detail</th>
                                            <th class="qty-cart-table text-center">Qty</th>
                                            <th class="subtotal-cart-table text-center">Sub Total</th>
                                            <th class="remove-cart-table"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($cart)) @foreach ($cart->cart_items as $item)
                                        <input type="hidden" name="product_id[]" value="{{$item->product->id}}" />
                                        <tr>
                                            <td><b>{{$item->product->name}}</b>
                                              @if($item->package)
                                                <p><i>{{$item->package->name}} </i></p>
                                              @endif
                                            </td>
                                            <td>
                                              @if ($item->package)
                                                <input
                                                    type="number"
                                                    class="form-control qty"
                                                    id="qty"
                                                    data-id="{{$item->cart_inc_id}}"
                                                    name="quantity[]"
                                                    data-price="{{$item->package->qty*$item->final_price}}"
						  data-shipping_fee="{{$item->shipping_fee}}"
                                                    data-packaging_fee="{{$item->package->packaging_fee}}"
                                                    data-weight="{{$item->package->weight}}"
                                                    data-height="{{$item->package->height}}"
                                                    data-length="{{$item->package->length}}"
                                                    data-width="{{$item->package->width}}"
                                                    value="{{$item->quantity}}"
                                                    max="{{ App\Helpers\Shop::stock($item->product->id)}}"
                                                    min="1"
                                                />
                                                @else
                                                <input
                                                    type="number"
                                                    class="form-control qty"
                                                    id="qty"
                                                    data-id="{{$item->cart_inc_id}}"
                                                    name="quantity[]"
                                                    data-price="{{$item->final_price}}"
                                                    data-packaging_fee="{{$item->packaging_fee}}"
						  data-shipping_fee="{{$item->shipping_fee}}"
                                                    data-weight="{{$item->product->weight}}"
                                                    data-height="{{$item->product->height}}"
                                                    data-length="{{$item->product->length}}"
                                                    data-width="{{$item->product->width}}"
                                                    value="{{$item->quantity}}"
                                                    max="{{ App\Helpers\Shop::stock($item->product->id)}}"
                                                    min="1"
                                                />
                                                @endif
                                                <p><i>Stock : {{ App\Helpers\Shop::stock($item->product->id)}} </i></p>
                                            </td>
                                            <td style="text-align: right;">{{ PaymentHelp::userCurrency() }} {{ PaymentHelp::userCurrencySymbol() }} <span id="price-{{$item->cart_inc_id}}">{{number_format($item->final_price)}}</span></td>
                                            @if ($item->package)
                                            <input type="hidden" class="final_price" name="final_price[]" value="{{$item->package->qty*$item->final_price}}" id="final_price-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="packaging_fee" name="packaging_fee[]" value="{{$item->packaging_fee}}" id="packaging_fee-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="weight" name="weight[]" value="{{$item->package->weight}}" id="weight-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="width" name="width[]" value="{{$item->package->width}}" id="width-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="length" name="length[]" value="{{$item->package->length}}" id="length-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="height" name="height[]" value="{{$item->package->height}}" id="height-{{$item->cart_inc_id}}" />
                                            @else
                                            <input type="hidden" class="final_price" name="final_price[]" value="{{$item->final_price}}" id="final_price-{{$item->cart_inc_id}}" />
					 <input type="hidden" class="shipping_fee" name="shipping_fee[]" value="{{$item->shipping_fee}}" id="shipping_fee-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="packaging_fee" name="packaging_fee[]" value="{{$item->packaging_fee}}" id="packaging_fee-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="weight" name="weight[]" value="{{$item->product->weight}}" id="weight-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="width" name="width[]" value="{{$item->product->width}}" id="width-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="length" name="length[]" value="{{$item->product->length}}" id="length-{{$item->cart_inc_id}}" />
                                            <input type="hidden" class="height" name="height[]" value="{{$item->product->height}}" id="height-{{$item->cart_inc_id}}" />
                                            @endif
                                            <td class="remove-cart-table text-center">
                                                <a type="button" class="" name="button" onclick="remove({{$item->cart_inc_id}})" style="color:#caa266">
                                                    <span class="closed-button"><i class='bx bx-trash'></i></span>
    </a>
                                            </td>
                                        </tr>

                                        @endforeach @else

                                        <tr>
                                            <td colspan="4">Empty</td>
                                        </tr>

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <!-- <button class="btn btn-primary rounded-round">Continue shopping</button> -->
                            </div>
                        </div>
                        <div class="px-3 py-5">
                            <h4 class="font-weight-bold mb-0">Shipping address</h4>
                            <hr style="border-top: 1px solid #bababa;" />


                            <div class="row text-left">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Full Name<span class="required">*</span> :</label>
                                        <input type="text" name="name" class="form-control form-control-lg" id="name" value="{{Auth::user()->name ?? ''}}" />
                                        <p><small id="error-name" class="text-danger"></small></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">City<span class="required">*</span> :</label>
                                        <input type="text" name="city" class="form-control form-control-lg" id="city" value="{{Auth::user()->city ?? ''}}" />
                                        <p><small id="error-city" class="text-danger"></small></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">State<span class="required">*</span> :</label>
                                        <input type="text" name="state" class="form-control form-control-lg" id="state" value="{{Auth::user()->state ?? ''}}" />
                                        <p><small id="error-state" class="text-danger"></small></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Address<span class="required">*</span> :</label>
                                        <textarea rows="5" type="" name="address" class="form-control form-control-lg" id="address">{{Auth::user()->address ?? ''}}</textarea>
                                        <p><small id="error-address" class="text-danger"></small></p>
                                    </div>
                                </div>
                                <div class="col-md-4 phone-input">
                                    <div class="form-group">
                                        <label for="name">Phone<span class="required">*</span> :</label>
                                        <input type="text" name="contact_no" class="form-control form-control-lg" id="contact_no" value="{{Auth::user()->contact_no ?? ''}}" />
                                        <p><small id="error-contact_no" class="text-danger"></small></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Zip Code<span class="required">*</span> :</label>
                                        <input type="" name="postal_code" id="postal_code" class="form-control form-control-lg" value="{{Auth::user()->postal_code ?? ''}}" />
                                        <p><small id="error-postal_code" class="text-danger"></small></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Country<span class="required">*</span> :</label>
                                        <select class="form-control form-control-lg" name="country_id" id="country_id">
                                            @if(isset($countries)) @foreach ($countries as $country)
                                            <option value="{{$country->country_id}}"
                                            @if (Auth::user() != null)
                                                @if(Auth::user()->country_id != null)
                                                    {{Auth::user()->country_id == $country->country_id ? 'selected' : ''}}
                                                    @else
                                                    {{$country->country_id == 'US' ? 'selected' : ''}}
                                                @endif
                                            @endif>{{$country->name}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="p-3" style="background-color: dimgrey;"><h4 style="color: #fff; padding: 0; margin: 0;">Total</h4></div>

                        @if(isset($cart))
                        <div class="p-3 mb-3 bg-light rounded">
                            <div class="row py-2">
                                <div class="col-6">
                                    Item(s) :
                                </div>
                                <div class="col-6 text-right">
                                    <strong style="font-weight: bold;"><span id="total_qty">{{$cart->cart_items()->pluck("quantity")->sum() ?? 0}}</span></strong>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-6">
                                  Subtotal :
                                </div>
                                <div class="col-6 text-right">{{ PaymentHelp::userCurrency() }} {{ PaymentHelp::userCurrencySymbol() }} <span id="total_sub_price">{{number_format($cart->cart_items()->pluck("final_price")->sum(), 2) ?? 0}}</span></div>
                            </div>
                            <div class="row py-2">
                                <div class="col-6">
                                    Packaging :
                                </div>
                                <div class="col-6 text-right">{{ PaymentHelp::userCurrency() }} {{ PaymentHelp::userCurrencySymbol() }} <span id="total_packaging_fee">{{number_format($cart->cart_items()->pluck("packaging_fee")->sum(), 2) ?? 0}}</span></div>

                            </div>
 			<div class="row py-2">
                                <div class="col-6">
                                    Shipping :
                                </div>
                                <div class="col-6 text-right">{{ PaymentHelp::userCurrency() }} {{ PaymentHelp::userCurrencySymbol() }} <span id="total_shipping_fee">{{number_format($cart->cart_items()->pluck("shipping_fee")->sum(), 2) ?? 0}}</span></div>

                            </div>


                            <!-- <div class="row py-2">
                                <div class="col-6">
                                    Shipping rate :
                                </div>
                                <div class="col-6 text-right">
                                    <strong style="font-weight: bold;"><span id="shipping_rate">{{ PaymentHelp::userCurrency() }} {{ PaymentHelp::userCurrencySymbol() }} <span id="total_shipping">{{number_format($cart->cart_items()->pluck("final_price")->sum()) ?? 0}}</span>.00</span></strong>
                                </div>
                            </div> -->


                            <hr />
                            <div class="text-right mb-3">
                                <h3>Total : {{ PaymentHelp::userCurrency() }} {{ PaymentHelp::userCurrencySymbol() }} <span id="total_price">{{number_format($cart->cart_items()->pluck("final_price")->sum()+$cart->cart_items()->pluck("packaging_fee")->sum(), 2) ?? 0}}</span></h3>
                            </div>
                            <button type="submit" name="button" class="w-100 btn btn-lg btn-primary rounded-round">
                                Proceed to checkout
                            </button>

                            @else
                            <div class="row py-2">
                                <div class="col-6">
                                    Item(s) :
                                </div>
                                <div class="col-6 text-right">
                                    <strong style="font-weight: bold;">
                                        <span id="total_qty"><span id="total_qty">0</span></span>
                                    </strong>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-6">
                                    SubTotal :
                                </div>
                                <div class="col-6 text-right">USD $<span id="total_sub_price">0</span>.00</div>
                            </div>

                            <hr />
                            <div class="text-right mb-3">
                                <h3>Total : USD $<span id="total_price">0</span>.00</h3>
                            </div>
                            <button type="sbutton" name="button" class="w-100 btn btn-lg btn-primary rounded-round">
                                Checkout
                            </button>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push("js")

<script>
    const phoneInputField = document.querySelector("#contact_no");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["us"],
        separateDialCode: true,
        utilsScript: "{{url('https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js')}}",
    });

    @if ($message = Session::get('error-cart'))
      $(document).ready(function() {
        swalBox('error', '{{ $message }}');
      });
    @endif

    $(".qty").on("change", function () {
        let qty = $(this).val();
        let total_price = 0;
        let total_packaging_fee = 0;
        let total_qty = 0;
        let price = 0;
        let packaging_fee = 0;
        let width = 0;
        let weight = 0;
        let length = 0;
        let height = 0;
        let cart_count = $("#cart-count").text();

        price = $(this).attr("data-price");
        packaging_fees = $(this).attr("data-packaging_fee");
        widths = $(this).attr("data-width");
        weights = $(this).attr("data-weight");
        lengths = $(this).attr("data-length");
        heights = $(this).attr("data-height");

        let id = $(this).attr("data-id");

        final_price = parseFloat(price) * qty;
        packaging_fee = parseFloat(packaging_fees) * qty;
        width = parseFloat(widths) * qty;
        weight = parseFloat(weights) * qty;
        length = parseFloat(lengths) * qty;
        height = parseFloat(heights) * qty;

        $("#price-" + id).text(addCommas(final_price));
        $("#final_price-" + id).val(final_price);
        $("#packaging_fee-" + id).val(packaging_fee);

        $("#width-" + id).val(width);
        $("#weight-" + id).val(weight);
        $("#length-" + id).val(length);
        $("#height-" + id).val(height);

        $(".qty").each(function () {
            total_qty += parseFloat($(this).val());
        });

        $(".final_price").each(function () {
            total_price += parseFloat($(this).val());
        });

        $(".packaging_fee").each(function () {
            total_packaging_fee += parseFloat($(this).val());
        });

        $("#total_price").text(addCommas((total_price+total_packaging_fee).toFixed(2)));
        $("#total_sub_price").text(addCommas(total_price));
        $("#total_packaging_fee").text(addCommas((total_packaging_fee).toFixed(2)));
        $("#total_qty").text(total_qty);
        $("#cart-count").text(total_qty);
    });

    function remove(cart_inc_id) {

        var data = {
            cart_inc_id: cart_inc_id,
        };
        Swal.fire({
            title: "Remove Product",
            text: "Are You sure want to remove this product ?",
            icon: "warning",
            showCancelButton: true,
        }).then((confirm) => {
            if (confirm.value) {
                    $.ajax({
                        url: "{{ route('shop.cart.remove') }}",
                        method: "POST",
                        data: { _token: "{{ csrf_token() }}", data },
                        complete: function (res) {
                            console.log(res);
                            if (res.responseJSON !== undefined) {
                                if (res.responseJSON.status === true) {
                                    Swal.fire({
                                        title: "Success",
                                        text: res.responseJSON.messages,
                                        icon: "success",
                                    })
                                    location.reload();

                                } else {
                                    if (res.responseJSON.messages !== undefined) {
                                        $.each(res.responseJSON.messages, (k, v) => {
                                            if (k === "server") {
                                                Swal.fire({
                                                    title: "Error",
                                                    text: v[0],
                                                    icon: "error",
                                                });
                                            }
                                        });
                                    }
                                }
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "Failed remove this product [2]",
                                    icon: "error",
                                });
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            if (xhr.status == 403) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Failed remove this product [3]",
                                    icon: "error",
                                });
                            }
                        },
                    });
            }
        });
    }

    function addCommas(nStr) {
        nStr += "";
        x = nStr.split(".");
        x1 = x[0];
        x2 = x.length > 1 ? "." + x[1] : "";
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, "$1" + "," + "$2");
        }
        // console.log(x1);
        // console.log(nStr);
        return x1 + x2;
    }
</script>

@endpush
