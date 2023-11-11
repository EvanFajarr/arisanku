@extends('frontend.member.layout', [ 'class1' => 'order_history-page', 'class2' => 's14'])
@section('member-content')
<style type="text/css">
    @media (min-width: 1200px){
        .s15-right {
            width: calc(100% - 326px);

        }

    }
    </style>

<style>
                .col-wrapper {
                    width: 100%;
                    margin: 0 auto;
                    display: flex;
                    flex-wrap: wrap !important;
                    align-items: stretch !important;
                    /*justify-content: center !important;
    text-align: center;*/
                }

                .col-content-container-3 {
                    width: 33.3%;
                    padding-bottom: 25px;
                }

                .col-container-inner {
                    padding: 1%;
                }

                .col-container {
                    /* margin: 0 auto;
    text-align: center;*/
                }

                /* .lightbox {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0s linear 0.3s;
    }

    .lightbox.show {
        opacity: 1;
        visibility: visible;
        transition: opacity 0.3s ease;
    } */
                .s16-grid {
                    margin-top: 0;
                }

                .s16-grid-item {
                    margin: 0 !important;
                }

                a.s16-grid-item {
                    text-decoration: none;
                }

                a.s16-grid-item {
                    color: #000;
                }

                .s16-grid-img {
                    height: auto !important;
                    margin-bottom: 0px !important;
                }

                .s16-grid-item h2,
                .s16-grid-item h4,
                .s16-grid-item h6 {
                    text-align: left;
                }

                .contDesc {
                    padding: 10px 20px;
                    background: #f0f0f0;
                }

                .truncate {
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .s14-grid-container {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    grid-gap: 5px;
                    /* Jarak antara item */
                }

                .s14-grid-item {
                    /* width: 100%;
         Ukuran awal item */
                    /* background-color: #ccc;
        padding: 10px;*/
                }

                .s16-grid-img {
                    position: relative;
                    width: 100%;
                    padding-top: 40%;
                    /* 1/2.5 = 0.4, atau 40% untuk rasio 2.5:1 */
                    background-size: cover;
                    background-position: center;
                }

                .s15-right h1 {
                    margin-bottom: 20px;
                }

                h2.small {
                    margin-bottom: 0px;
                    font-family: "Montserrat" !important;
                    font-weight: 900 !important;
                }

                .small {
                    text-transform: uppercase;
                    font-family: "Montserrat", sans-serif;
                    font-weight: bold;
                }

                .product-code {
                    text-transform: uppercase;
                    margin-bottom: 7px;
                    font-size: 0.75rem;
                    color: #989898;
                    letter-spacing: 0.0625rem;
                }

                h4.black {
                    /*margin-bottom:20px;*/
                }

                .lightbox.lightbox-custom .header {
                    padding: 0 !important;
                    border: none !important;
                }

                .lightbox.lightbox-custom .header h2 {
                    text-align: left !important;
                }

                .lightbox-confirmation .lightbox-wrapper {
                    max-height: 575px;
                }

                .lightbox.lightbox-custom .close-btn {
                    z-index: 9;
                    width: 38px;
                    height: 38px;
                    top: 10px;
                    right: 10px;
                }

                .s16-grid-item .product-code {
                }

                @media (max-width: 991px) {
                    .col-content-container-3 {
                        width: 48%;
                    }
                }

                @media (max-width: 625px) {
                    .col-content-container-4,
                    .col-content-container-3,
                    .col-content-container-2 {
                        width: 100%;
                    }
                }

                .asd1 {
                    list-style-type: disc;
                }
            </style>
            <style type="text/css">
                @media (min-width: 1200px) {
                    .s15-right {
                        width: calc(100% - 326px);
                    }
                }
            </style>
            <!-----------styling TABS------------------->
            <style type="text/css">
            /* Style the tab */
            .tab {
                overflow: hidden;
                border-bottom: 1px solid #ccc;
                background-color: #ffffff;
                width: 100%;
                margin: 0 auto;
                text-align: center;
                /*height: 62px;*/
                display: flex;
                justify-content: space-evenly;
            }


            /* Style the buttons inside the tab */
            .tab button {
              /*background-color: inherit;


              border: none;
              outline: none;
              cursor: pointer;
              padding: 14px 0px;
              transition: 0.3s;
              font-size: 17px;*/
              background:none;

  padding: 10px 0px;
  border: none;
  cursor: pointer;
  border-bottom: 2px solid transparent; /* Garis bawah yang transparan */
  transition:  width .3s, border-bottom 0.3s; /* Efek transisi pada border-bottom */

            }

            /* Change background color of buttons on hover */
            .tab button:hover, .tab button.active{
                border-bottom: 2px solid #8a1b33; /* Warna dan ketebalan border-bottom saat hover */

            }
            /*.tab button::after {
                content: '';
                display: block;
                width: 0;
                height: 2px;
                background: #8a1b33;
                transition: width .3s;

            }

            .tab button:hover::after, .tab button.active::after {

                width: 100%;
                transition: width .3s;
            }*/

            /* Create an active/current tablink class */
            .tab button.active {
               /* border-bottom: solid 2px #8a1b33;*/


            }

            /* Style the tab content */
            .tabcontent {
              display: none;
              padding: 15px 0px;
              /*border: 1px solid #ccc;*/
              border-top: none;
            }

            /* LABEL */
            .label-wrapper{
                position: absolute; z-index: 1; top: 0; width: 100%;
            }
            .label-container{
                background: #f0f0f0; border-radius: 0 0 7px 7px; width: 190px; padding: 7px 0px; text-align: center; margin: 0 auto;
            }
            @media (max-width: 480px){
                .tab{
                    flex-direction: column;
                }
                .tab button{
                    text-align:center
                }
                .tab button.active {
                    background: #ffe9e9;
                }
            }
            </style><div class="s15-right">
    <div class="s15-right-head">
        <h1 class="black italic">Promotions</h1>
        <div>
            <p style="font-size: 15px;">Discover the latest online exclusive promotions and deals just for you! Only for purchases made via noelgifts.com.</p>
        </div>
    </div>

    <div class="category-page" id="page-wrapper" style="margin:-1%">
        <div class="s16">
  <div id="Tab1" class="tab">
                                <button class="tablinks" onclick="openTab(event, 'Tab1')">Website</button>
                                <button class="tablinks" onclick="openTab(event, 'Tab2')">Festive & Seasonal</button>
                                <button class="tablinks" onclick="openTab(event, 'Tab3')">Banks</button>
                                <button class="tablinks" onclick="openTab(event, 'Tab4')">Partners</button>
                            </div>
            <div class="col-wrapper">

                @foreach ($promotions as $promotion)
                <a class="col-content-container-3 col-container-inner s14-grid-item s16-grid-item"
                    data-sub_title="{{ $promotion->sub_title }}" data-id="{{ $promotion->id }}"
                    id="promotion-{{ $promotion->id }}">
                    <div class="s16-grid-img" data-image="{{ asset('storage/member-promotion/'.$promotion->company) }}"
                        style="background-image: url({{ asset('storage/member-promotion/'.$promotion->image) }});">
                    </div>
                    <div class="contDesc">
                        @php
                        $desc = $promotion->description;
                        @endphp
                        <h6 class="product-code date">{{ $promotion->start_date_text ." - ". $promotion->end_date_text}}
                        </h6>
                        <h2 class="small bold title-foreach" style="margin-top: 10px;">{{ $promotion->title}}
                        </h2>
                        <div class="" id="description" style="display:flex; justify-content:space-between"
                            data-text="{{ $promotion->description }}">
                            <p class="subtitle-foreach truncate"
                                style="color: #717171; font-family: Montserrat, sans-serif;font-size:12px;">
                                {{ $promotion->sub_title }}
                            </p>
                            <div tabindex="0" role="button" aria-label="" aria-disabled=""
                                style=" height: 100%; color: #717171"><i class="fas fa-arrow-right"
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>


 {{-- <div class="form-group">
                    <div class="row">
                      <div class="col-12">
                        <label>Packages</label>
                        <table class="table" id="table-package">
                          <tr>
                            <td style="width: 35%">Name</td>
                            <td style="width: 10%">Qty</td>
                            <td style="width: 10%">Weight</td>
                            <td style="width: 10%">Length</td>
                            <td style="width: 10%">Width</td>
                            <td style="width: 10%">Height</td>
                            <td style="width: 15%">Fee</td>
                          </tr>
                            <tr>
                                <td style="padding: 10px 1px!important;">
                                  <input type="text" class="form-control rounded-round" name="package_name[]" id="package_name" value="Package">
                                  <p id="error-package_name" class="text-danger"></p>
                                </td>
                                <td style="padding: 10px 1px!important;">
                                  <input type="number" class="form-control rounded-round" name="package_qty[]" id="package_qty" value="0">
                                  <p id="error-package_qty" class="text-danger"></p>
                                </td>
                                <td style="padding: 10px 1px!important;">
                                  <input type="number" class="form-control rounded-round" name="package_weight[]" id="package_weight" value="0">
                                  <p id="error-package_weight" class="text-danger"></p>
                                </td>
                                <td style="padding: 10px 1px!important;">
                                  <input type="number" class="form-control rounded-round" name="package_length[]" id="package_length" value="0">
                                  <p id="error-package_length" class="text-danger"></p>
                                </td>
                                <td style="padding: 10px 1px!important;">
                                  <input type="number" class="form-control rounded-round" name="package_width[]" id="package_width" value="0">
                                  <p id="error-package_width" class="text-danger"></p>
                                </td>
                                <td style="padding: 10px 1px!important;">
                                  <input type="number" class="form-control rounded-round" name="package_height[]" id="package_height" value="0">
                                  <p id="error-package_height" class="text-danger"></p>
                                </td>
                                <td style="padding: 10px 1px!important;">
                                  <input type="text" class="form-control rounded-round" name="package_fee[]" id="package_fee" value="0">
                                  <p id="error-package_fee" class="text-danger"></p>
                                </td style="padding: 10px 1px!important;">
                                <td width="80px" style="width: 80px;"><button class="btn btn-info btn-shadow rounded-round" id="addPackage">Add</button></td>
                            </tr>
                        </table>
                      </div>
                    </div>
                  </div> --}}
{{-- usd --}}


<div class="lightbox lightbox-custom lightbox-confirmation" id="promotion">
    <div class="lightbox-wrapper">
        <a class="close-btn" href="#close-modal" rel="modal:close" class="close-modal ">
            <!--?xml version="1.0" encoding="utf-8"?-->
            <!-- Generator: Adobe Illustrator 21.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewBox="0 0 100 125" style="enable-background: new 0 0 100 125" xml:space="preserve">
                <g>
                    <polygon
                        points="66,31.2 50,47.2 34,31.2 31.2,34 47.2,50 31.2,66 34,68.8 50,52.8 66,68.8 68.8,66 52.8,50 68.8,34    ">
                    </polygon>
                    <path d="M50,8C26.8,8,8,26.8,8,50s18.8,42,42,42s42-18.8,42-42S73.2,8,50,8z M50,88c-21,0-38-17-38-38s17-38,38-38s38,17,38,38
            S71,88,50,88z"></path>
                </g>
            </svg>
        </a>
        <div class="header">
            <img id="image"
                src="https://noel.dv9.com/convert/webp?src=storage/photos/shares/4-part/new-corporatesvc.jpg">
            <div style="margin-top:15px">
                <h6 class="modal-date" style="margin-bottom:15px;font-size:90%;color: #717171">25 Jun 2023 - 25 Jul 2023
                </h6>
                <h2 class="small bold italic" style="margin-bottom:15px; font-size:180%" id="title">adfadf</h2>
                <h3 class="black italic" style="font-size:110%;" id="subtitle"></h3>
            </div>
        </div>
        <div class="s8 cartMsgPopupbody">
            <div id="description">
            </div>
        </div>
    </div>
</div>
@endsection

@push('topscript')
<style>
    .s8.cartMsgPopupbody {
        overflow: auto;
        max-height: 400px;
        /* Ubah angka ini sesuai dengan tinggi maksimum yang Anda inginkan */
    }

    @media (min-width: 1200px) {
        /*.s14-grid-item {
            width: calc(30%);
            margin: 0px 12px 69px 12px;
        }*/
    }
</style>
@endpush

@push('bottomscript')
<script>
    $('.s16-grid-item').click(function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let title = $('#benefit-'+id).find(".title-foreach").text();
        let subtitle = $(this).data('sub_title');
        let description = $('#benefit-'+id).find("#description").data('text');

        $('#benefit').find("#description").html(description).css({
            // "color": "#717171",
            "font-family": "'Montserrat', sans-serif",
        }).find("ul").css("list-style-type", "disc");

        $('#benefit').find("#title").text(title)
        $('#benefit').find("#subtitle").text(subtitle).css({
            "color": "#717171",
            "font-family": "'Montserrat', sans-serif",
        });
        $('#benefit').find("#image").attr('src', $('#benefit-' + id).find(".s16-grid-img").data('image')).css('max-width', '100px');
        $(".modal-date").text($("#benefit-"+id).find(".date").text())
        $('#benefit').modal('show');
    });

</script>
<script>
    $('.truncate').each(function() {
    var text = $(this).text();
    if (text.length > 63) {
      $(this).text(text.substr(0, 63) + '...'); // Mengganti teks dengan "..."
    }
  });
</script>
@endpush
