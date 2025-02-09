<?php

/* @var $this yii\web\View */

use app\modules\structurer\componnets\ReportTemplateAbstract;
use app\modules\structurer\models\Report;
use rabint\widgets\chart\OrgChartWidget;


$opts = \rabint\option\models\Option::get('general');

$this->title = $opts[0]['subject'];

//$this->title = config('app_name');
$bundleBaseUrl = $this->getAssetManager()->getBundle('app\themes\bilit\ThemeAsset')->baseUrl;

$this->context->layout = "@themeLayouts/home";
?>
<main class="main">
    <!-- booking ------------------------------- -//-->
    <div class="booking-wrapper" style="background-image: url(<?=$bundleBaseUrl?>/img/pages/index/booking/0.jpg)">
        <div class="container g-0 booking-inner shadow-sm">
            <nav class="booking-nav"><a class="btn active" href="index"> <i class="ti ti-plane-inflight fs-2"></i>پرواز داخلی</a><a class="btn" href="external"> <i class="ti ti-plane-departure fs-2"></i>پرواز خارجی</a><a class="btn" href="booking-hotels.html"> <i class="ti ti-building-skyscraper fs-2"></i>هتل</a><a class="btn" href="train"> <i class="ti ti-train fs-2"></i>قطار</a><a class="btn" href="booking-buses.html"> <i class="ti ti-bus fs-2"></i>اتوبوس</a><a class="btn" href="tour"> <i class="ti ti-luggage fs-2"></i>تور</a><a class="btn" href="booking-villas.html"> <i class="ti ti-home-2 fs-2"></i>ویلا و اقامتگاه</a></nav>
            <div class="container g-3">
                <form class="row g-3 booking-form" action="">
                    <!-- top row ------------------------------- -//-->
                    <div class="col-12">
                        <div class="nt-flex gap-3 mb-2">
                            <div class="d-inline-block">
                                <select class="rounded-pill form-select" id="bookingType" aria-label="Default select example">
                                    <option value="1" selected="selected">یک طرفه</option>
                                    <option value="2">دو طرفه</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- bottom row ------------------------------ -//-->
                    <div class="col-12 col-md-6 col-lg-5">
                        <!-- from & to-->
                        <div class="booking-fromTo">
                            <select class="tom-select-header form-select tomselected ts-hidden-accessible" placeholder="مبدا (شهر)" autocomplete="off" id="tomselect-1" tabindex="-1">
                                <option value="">مبدا (شهر)</option>
                                <option value="tehran">تهران</option>
                                <option value="ahvaz">اهواز</option>
                                <option value="shiraz">شیراز</option>
                                <option value="mashhad">مشهد</option>
                                <option value="bandar">بندر عباس</option>
                                <option value="esfehan">اصفهان</option>
                                <option value="tabriz">تبریز</option>
                                <option value="kish">کیش</option>
                            </select><div class="ts-wrapper tom-select-header form-select single plugin-dropdown_header rtl"><div class="ts-control"><input type="text" autocomplete="off" size="1" tabindex="0" role="combobox" aria-haspopup="listbox" aria-expanded="false" aria-controls="tomselect-1-ts-dropdown" id="tomselect-1-ts-control" placeholder="مبدا (شهر)"></div><div class="ts-dropdown single plugin-dropdown_header" style="display: none;"><div class="dropdown-header"><div class="dropdown-header-title"><span class="dropdown-header-label">پرتردد</span><a class="dropdown-header-close">×</a></div></div><div role="listbox" tabindex="-1" class="ts-dropdown-content" id="tomselect-1-ts-dropdown"></div></div></div>
                            <select class="tom-select-header form-select tomselected ts-hidden-accessible" placeholder="مقصد (شهر)" autocomplete="off" id="tomselect-2" tabindex="-1">
                                <option value="">مبدا (شهر)</option>
                                <option value="tehran">تهران</option>
                                <option value="ahvaz">اهواز</option>
                                <option value="shiraz">شیراز</option>
                                <option value="mashhad">مشهد</option>
                                <option value="bandar">بندر عباس</option>
                                <option value="esfehan">اصفهان</option>
                                <option value="tabriz">تبریز</option>
                                <option value="kish">کیش</option>
                            </select><div class="ts-wrapper tom-select-header form-select single plugin-dropdown_header rtl"><div class="ts-control"><input type="text" autocomplete="off" size="1" tabindex="0" role="combobox" aria-haspopup="listbox" aria-expanded="false" aria-controls="tomselect-2-ts-dropdown" id="tomselect-2-ts-control" placeholder="مقصد (شهر)"></div><div class="ts-dropdown single plugin-dropdown_header" style="display: none;"><div class="dropdown-header"><div class="dropdown-header-title"><span class="dropdown-header-label">پرتردد</span><a class="dropdown-header-close">×</a></div></div><div role="listbox" tabindex="-1" class="ts-dropdown-content" id="tomselect-2-ts-dropdown"></div></div></div>
                        </div>
                    </div>
                    <!-- departure & return-->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="booking-departureReturn">
                            <input class="form-control" id="bookingFrom" type="text" name="" placeholder="تاریخ رفت" data-jdp="">
                            <input class="form-control" id="bookingTo" type="text" name="" placeholder="تاریخ برگشت" data-jdp="" disabled="disabled">
                        </div>
                    </div>
                    <!-- travelers-->
                    <div class="col-6 col-md-6 col-lg-2">
                        <div class="w-100 btn-group booking-travelers">
                            <button class="btn btn-white dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"> <span id="total-travelers">1</span>مسافر</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" data-bs-auto-close="outside">
                                <div class="dropdown-item">
                                    <div class="nt-flex-start-center">
                                        <div class="nt-flex-start-center gap-1 flex-grow-1">بزرگسال
                                            <div class="text-muted">(۱۲ سال به بالا)</div>
                                        </div>
                                        <div class="nt-flex-start-center gap-3">
                                            <button class="btn btn-primary btn-sm" id="adults-plus" type="button"><i class="ti ti-plus"></i></button><span id="adults-count">1</span>
                                            <button class="btn btn-primary btn-sm" id="adults-minus" type="button"><i class="ti ti-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="nt-flex-start-center">
                                        <div class="nt-flex-start-center gap-1 flex-grow-1">کودک
                                            <div class="text-muted">(۲ تا ۱۲ سال)</div>
                                        </div>
                                        <div class="nt-flex-start-center gap-3">
                                            <button class="btn btn-primary btn-sm" id="children-plus" type="button"><i class="ti ti-plus"></i></button><span id="children-count">0</span>
                                            <button class="btn btn-primary btn-sm" id="children-minus" type="button" disabled=""><i class="ti ti-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="nt-flex-start-center">
                                        <div class="nt-flex-start-center gap-1 flex-grow-1">نوزاد
                                            <div class="text-muted">(۱۰ روز تا ۲ سال)</div>
                                        </div>
                                        <div class="nt-flex-start-center gap-3">
                                            <button class="btn btn-primary btn-sm" id="infants-plus" type="button"><i class="ti ti-plus"></i></button><span id="infants-count">0</span>
                                            <button class="btn btn-primary btn-sm" id="infants-minus" type="button" disabled=""><i class="ti ti-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <!-- search (submit)-->
                    <div class="col-6 col-md-6 col-lg-2">
                        <button class="btn btn-primary booking-submit" type="submit">
                            جستجو<i class="ti ti-search fs-5"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- top offers slider -------------------------- -//-->
    <div class="container topOffersSlider py-5">
        <div class="nt-flex-between-center mb-4">
            <div class="nt-flex-start-center gap-2"><i class="ti ti-award text-secondary fs-3"></i>
                <div class="fw-bold fs-5">پیشنهاد ها</div>
            </div>
        </div>
        <div class="swiper pb-5 swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden" data-swiper-options="{ &quot;loop&quot;:true, &quot;slidesPerView&quot;:1, &quot;spaceBetween&quot;:10, &quot;breakpoints&quot;:{ &quot;760&quot;:{&quot;slidesPerView&quot;:2},&quot;992&quot;:{&quot;slidesPerView&quot;:3} }, &quot;pagination&quot;: {&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;dynamicBullets&quot;:true} }">
            <div class="swiper-wrapper" id="swiper-wrapper-254ecd1610a8b101a1" aria-live="polite">
                <!-- slide-->
                <div class="swiper-slide swiper-slide-active" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Persepolis.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="1 / 9" data-swiper-slide-index="0"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">تخت جمشید؛ میراث جهانی بشری</div>
                                    <div class="small">سفری تاریخی برای آشنایی از نزدیک این بنای تاریخی</div>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide swiper-slide-next" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Shiraz.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="2 / 9" data-swiper-slide-index="1"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">شیراز؛ شهر عشق و دلدادگی</div>
                                    <p class="lh-lg small mb-0">به شهری سفر کنید که عطر بهارنارنج آن شما را به وجد می‌آورد </p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Kashan.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="3 / 9" data-swiper-slide-index="2"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">کاشان؛ نگین کویر ایران</div>
                                    <p class="lh-lg small mb-0">سفر به شهری که عطر گلاب آن شما را به وجد می‌آورد</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Isfahan.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="4 / 9" data-swiper-slide-index="3"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">اصفهان؛ موزه زنده ایران</div>
                                    <p class="lh-lg small mb-0">سفر به شهری که تاریخ و فرهنگ ایران را در خود جای داده است</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Kerman.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="5 / 9" data-swiper-slide-index="4"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">کرمان؛ شهری با هزار و یک راز</div>
                                    <p class="lh-lg small mb-0">سفر به شهری که تاریخ و فرهنگ ایران را در خود جای داده است</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/masuleh.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="6 / 9" data-swiper-slide-index="5"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">ماسوله؛ نگین گیلان</div>
                                    <p class="lh-lg small mb-0">سفری به روستایی با معماری پلکانی و طبیعتی بکر و دست‌نخورده.</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/mazandaran.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="7 / 9" data-swiper-slide-index="6"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">مازندران؛ سرزمین آبشارها و رودخانه‌ها</div>
                                    <p class="lh-lg small mb-0">در دل طبیعت گشت و گذار کنید و از زیبایی‌های آن لذت ببرید</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Tabriz.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="8 / 9" data-swiper-slide-index="7"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">تبریز؛ شهری با تاریخ کهن</div>
                                    <p class="lh-lg small mb-0">سفری به شهری با معماری بی‌نظیر و فرهنگی غنی.</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" style="--bg: url('<?=$bundleBaseUrl?>/img/pages/index/slider/Mashhad.jpg'); width: 426.333px; margin-left: 10px;" role="group" aria-label="9 / 9" data-swiper-slide-index="8"><a class="link topOffersSlider-slide p-3" href="">
                        <div class="topOffersSlider-slide-content">
                            <div class="nt-flex-between-center flex-nowrap">
                                <div class="nt-flex-column">
                                    <div class="fs-5">مقصدی برای هر فصل از سال</div>
                                    <p class="lh-lg small mb-0">به مشهد سفر کنید و زیبایی‌های آن لذت ببرید</p>
                                </div>
                                <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                            </div>
                        </div></a></div>
            </div>
            <!-- pagination-->
            <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic" style="width: 80px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" aria-current="true" style="right: 32px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" style="right: 32px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next-next" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span></div>
            <!-- next & prev-->
            <div class="swiper-button-next swiper-button-next-0" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-254ecd1610a8b101a1"></div>
            <div class="swiper-button-prev swiper-button-prev-0" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-254ecd1610a8b101a1"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </div>
    <!-- popular routes ---------------------------- -//-->
    <div class="popularRoutes container py-5 mb-4">
        <div class="nt-flex-start-center gap-2 fw-bold fs-5 mb-4"><i class="ti ti-plane-arrival text-primary fs-3"></i>مسیر های پرمخاطب</div>
        <div class="swiper pb-5 swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden" data-swiper-options="{ &quot;slidesPerView&quot;:1, &quot;spaceBetween&quot;:10, &quot;breakpoints&quot;:{ &quot;760&quot;:{&quot;slidesPerView&quot;:2},&quot;992&quot;:{&quot;slidesPerView&quot;:3},&quot;1180&quot;:{&quot;slidesPerView&quot;:4} }, &quot;pagination&quot;: {&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;dynamicBullets&quot;:true} }">
            <div class="swiper-wrapper" id="swiper-wrapper-19ecb601a91a5f06" aria-live="polite">
                <!-- slide-->
                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1 p-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="text-muted">مبدا</div>
                                </div>
                                <div class="col">
                                    <div class="nt-PathVisualizer reversed-icon">
                                        <div class="nt-PathVisualizer-line"></div><i class="ti ti-plane fs-5 text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">مقصد</div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="fs-5">جزیره کیش </div>
                                </div>
                                <div class="col"></div>
                                <div class="col-auto">
                                    <div class="fs-5">تهران</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۱،۵۷۴،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1 p-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="text-muted">مبدا</div>
                                </div>
                                <div class="col">
                                    <div class="nt-PathVisualizer reversed-icon">
                                        <div class="nt-PathVisualizer-line"></div><i class="ti ti-plane fs-5 text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">مقصد</div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="fs-5">مشهد</div>
                                </div>
                                <div class="col"></div>
                                <div class="col-auto">
                                    <div class="fs-5">تهران</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۱،۶۳۷،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="3 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1 p-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="text-muted">مبدا</div>
                                </div>
                                <div class="col">
                                    <div class="nt-PathVisualizer reversed-icon">
                                        <div class="nt-PathVisualizer-line"></div><i class="ti ti-plane fs-5 text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">مقصد</div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="fs-5">اهواز</div>
                                </div>
                                <div class="col"></div>
                                <div class="col-auto">
                                    <div class="fs-5">تهران</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۲،۳۵۱،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="4 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1 p-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="text-muted">مبدا</div>
                                </div>
                                <div class="col">
                                    <div class="nt-PathVisualizer reversed-icon">
                                        <div class="nt-PathVisualizer-line"></div><i class="ti ti-plane fs-5 text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">مقصد</div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="fs-5">شیراز</div>
                                </div>
                                <div class="col"></div>
                                <div class="col-auto">
                                    <div class="fs-5">تهران</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۲،۶۷۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="5 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1 p-4">
                            <div class="row align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="text-muted">مبدا</div>
                                </div>
                                <div class="col">
                                    <div class="nt-PathVisualizer reversed-icon">
                                        <div class="nt-PathVisualizer-line"></div><i class="ti ti-plane fs-5 text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">مقصد</div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="fs-5">جزیره کیش </div>
                                </div>
                                <div class="col"></div>
                                <div class="col-auto">
                                    <div class="fs-5">تهران</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۱،۵۷۴،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
            </div>
            <!-- pagination-->
            <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic" style="width: 80px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" aria-current="true" style="right: 8px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" style="right: 8px;"></span></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </div>
    <!-- full cover ------------------------------ -//-->
    <div class="container py-5 mb-5">
        <div class="row g-0 bg-light-subtle border border-2 rounded">
            <!-- image-->
            <div class="col-12 col-md-4 order-md-last"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/airplane.png" alt="cover"></div>
            <!-- text-->
            <div class="col-12 col-md-4 offset-md-1">
                <div class="h-100 nt-flex-column-center-start gap-4 p-4">
                    <div class="fs-2 fw-bold">
                        خرید تلفنی
                        پرنت
                    </div>
                    <div class="fs-3 lead">سفر، تنها محدود به آرزوهای توست!</div>
                </div>
            </div>
            <!-- button-->
            <div class="col-12 col-md-3">
                <div class="h-100 nt-flex-column-center-center gap-4 py-4">
                    <div class="nt-flex-start-center fs-3 fw-bold">۰۲۱-۱۲۳۴<i class="ti ti-phone-filled fs-2"></i></div><a class="btn btn-lg btn-secondary" href="">
                        اطلاعات بیشتر</a>
                </div>
            </div>
        </div>
    </div>
    <!-- download app ----------------------------- -//-->
    <div class="container py-5 mb-5">
        <div class="row g-0">
            <div class="col-12 col-md-4">
                <div class="h-100 nt-flex-column-center-center p-5"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/app2.png" alt="cover"></div>
            </div>
            <div class="col-12 col-md-6 offset-md-1">
                <div class="h-100 nt-flex-column-center-start gap-4 p-4">
                    <div class="nt-flex-column">
                        <div class="fs-2 fw-bold">
                            برنامه
                            پرنت
                            رو دانلود کن
                        </div>
                        <div class="fs-3 text-primary">سفرت رو راحت‌تر کن</div>
                    </div>
                    <div class="lead">با اپلیکیشن پرنت، بلیط، هتل و هرچیزی که برای سفر نیاز داری رو با چند تا لمس رزرو کن. از تخفیف‌های ویژه لذت ببر و سفرت رو هوشمندانه برنامه‌ریزی کن. همین حالا دانلود کن!</div>
                    <div class="row align-items-center pb-4">
                        <div class="col-12 col-md-7">
                            <div class="row row-cols-md-2 g-3">
                                <div class="col-12 col-md"><a class="w-100 btn btn-dark" href=""><i class="ti ti-brand-android fs-5"></i>دانلود
                                        نسخه اندروید</a></div>
                                <div class="col-12 col-md"><a class="btn btn-dark" href=""><i class="ti ti-brand-apple fs-5"></i>دانلود
                                        اپل&nbsp;‍</a></div>
                                <div class="col-12 col-md"><a class="btn btn-dark" href=""><i class="ti ti-download fs-5"></i>دانلود
                                        مستقیم</a></div>
                                <div class="col-12 col-md"><a class="btn btn-dark" href=""><i class="ti ti-world fs-5"></i>وب اپلیکیشن</a></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="nt-flex-column-center-center gap-1"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/qr.png" alt="" width="150">
                                <div class="text-muted small">اسکن کنید و دانلود کنید!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row pt-0 bg-light bg-gradient rounded p-5 g-4">
                    <div class="col-12 col-md-4">
                        <div class="nt-flex justify-content-md-center gap-4"><i class="ti ti-users fs-1 text-secondary"></i>
                            <div class="nt-flex-column gap-1">
                                <div class="text-muted">بیش از</div>
                                <div class="fs-4 fw-bold">۱،۱۰۰،۰۰۰</div>
                                <div class="lead">کاربر فعال</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nt-flex justify-content-md-center gap-4"><i class="ti ti-star fs-1 text-secondary"></i>
                            <div class="nt-flex-column gap-1">
                                <div class="text-muted">بیش از</div>
                                <div class="fs-4 fw-bold">۹۴٪</div>
                                <div class="lead">رضایت کاربران</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nt-flex justify-content-md-center gap-4"><i class="ti ti-briefcase-2 fs-1 text-secondary"></i>
                            <div class="nt-flex-column gap-1">
                                <div class="text-muted">بیش از</div>
                                <div class="fs-4 fw-bold">۷،۰۰۰،۰۰۰</div>
                                <div class="lead">سفارش موفق محصولات گردشگری</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- common questions --------------------------- -//-->
    <div class="commonQuestions py-5 mb-5">
        <div class="container py-5 mb-4">
            <div class="row g-0">
                <div class="col-12">
                    <div class="w-100 nt-flex-between-center mb-4">
                        <div class="nt-flex-start-center fs-5 fw-bold"><i class="ti ti-help-octagon text-primary fs-3"></i>پرسش های متداول</div>
                        <div class="fs-5 text-light">FAQ's</div>
                    </div>
                </div>
                <div class="col-12 border rounded">
                    <div class="accordion accordion-flush" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">چگونه می‌توانم بلیط هواپیما را به صورت آنلاین رزرو کنم؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseOne">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">به آسانی می‌توانید با مراجعه به وب سایت ما و انتخاب مبدا، مقصد، تاریخ سفر و تعداد مسافران، بلیط خود را رزرو کنید. سپس می‌توانید از بین پروازهای مختلف ایرلاین‌ها و کلاس‌های پروازی مختلف، گزینه مورد نظر خود را انتخاب کرده و مراحل پرداخت را طی کنید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">تفاوت بلیط سیستمی و چارتر چیست؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseTwo">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">بلیط‌های سیستمی توسط ایرلاین‌ها ارائه می‌شوند و قیمت ثابتی دارند. در مقابل، بلیط‌های چارتر توسط آژانس‌های هواپیمایی به صورت عمده از ایرلاین‌ها خریداری شده و با قیمتی پایین‌تر به مسافران عرضه می‌شوند. بلیط‌های چارتر معمولا قابل استرداد یا تغییر تاریخ نیستند.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">حداکثر بار مجاز در پروازهای داخلی و خارجی چقدر است؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseThree">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">حداکثر بار مجاز در پروازها به عوامل مختلفی مانند کلاس پروازی، ایرلاین و مسیر پرواز بستگی دارد. به طور کلی، در پروازهای داخلی حداکثر 20 تا 25 کیلوگرم بار مجاز است و در پروازهای خارجی این مقدار بین 30 تا 40 کیلوگرم متغیر است. اطلاعات دقیق مربوط به حداکثر بار مجاز را می‌توانید در بخش "اطلاعات پرواز" در وب سایت ما مشاهده کنید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">شرایط تغییر تاریخ یا کنسلی بلیط چگونه است؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseFour">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">شرایط تغییر تاریخ یا کنسلی بلیط به نوع بلیط (سیستمی یا چارتر) و قوانین ایرلاین مربوطه بستگی دارد. به طور کلی، برای بلیط‌های سیستمی امکان تغییر تاریخ یا کنسلی با پرداخت جریمه وجود دارد، اما بلیط‌های چارتر معمولا قابل استرداد یا تغییر تاریخ نیستند.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">چگونه می‌توانم از وضعیت پرواز خود مطلع شوم؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseFive">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">شما می‌توانید با وارد کردن کد رزرو و نام خانوادگی خود در بخش "اطلاعات پرواز" در وب سایت ما، از وضعیت پرواز خود، اعم از ساعت پرواز، تاخیر یا لغو احتمالی، مطلع شوید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">برای پرواز چه مدارکی لازم است؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseSix">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">برای پروازهای داخلی، ارائه کارت ملی یا شناسنامه کافی است. اما برای پروازهای خارجی، علاوه بر گذرنامه، ممکن است به ویزا نیز نیاز داشته باشید. توصیه می‌کنیم قبل از سفر، از قوانین و مقررات مربوط به مدارک مورد نیاز برای اتباع ایرانی در کشور مقصد مطلع شوید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">در صورت تاخیر یا لغو پرواز، چه اقداماتی می‌توان انجام داد؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseSeven">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">در صورت تاخیر یا لغو پرواز، ایرلاین موظف است طبق قوانین به مسافران غرامت بپردازد. شما می‌توانید با مراجعه به کانتر ایرلاین در فرودگاه و یا تماس با بخش خدمات مشتریان ایرلاین، نسبت به دریافت غرامت اقدام کنید.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- key highlights ---------------------------- -//-->
    <div class="container py-5 mb-5">
        <div class="row g-4">
            <div class="col-12 col-md-4">
                <div class="keyHighlights p-4">
                    <div class="keyHighlights-icon mb-5"><i class="ti ti-ticket fs-2"></i></div>
                    <div class="fs-4 mb-0 text-secondary">هرجا که بخوای، با هر بودجه‌ای</div>
                    <p class="lead lh-lg">رزرو آنلاین انواع بلیط هواپیما، قطار و اتوبوس با بهترین قیمت‌ها</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="keyHighlights p-4">
                    <div class="keyHighlights-icon mb-5"><i class="ti ti-world fs-2"></i></div>
                    <div class="fs-4 mb-0 text-secondary">رویای سفر به دور دنیا رو با ما تجربه کن</div>
                    <p class="lead lh-lg">تورهای متنوع و جذاب به دور دنیا با بهترین خدمات و کیفیت</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="keyHighlights p-4">
                    <div class="keyHighlights-icon mb-5"><i class="ti ti-sunglasses fs-2"></i></div>
                    <div class="fs-4 mb-0 text-secondary">سفرت رو راحت‌تر کن</div>
                    <p class="lead lh-lg">لوازم ضروری سفر، از ملزومات بهداشتی تا خوراکی‌های مورد علاقه‌ات، یکجا</p>
                </div>
            </div>
        </div>
    </div>
    <!-- image caption ---------------------------- -//-->
    <div class="imageCaption py-5 mb-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-4"><img src="<?=$bundleBaseUrl?>/img/pages/index/luggage.png" alt="" width="200"></div>
                <div class="col-12 col-md-6">
                    <div class="h-100 nt-flex-column-center-start">
                        <div class="text-dark fs-3 fw-bold mb-4">چمدونت برای سفر آمادست؟</div>
                        <p class="text-dark lead lh-lg">چمدونت آماده‌ست، بلیتت چی؟ با رزرو آنلاین، از بهترین قیمت‌ها و صندلی‌ها بهره‌مند شو. علاوه بر این، می‌تونی با خیال راحت، جزئیات سفرت رو مدیریت کنی.</p>
                        <button class="btn btn-lg btn-dark" type="button">
                            سفارش آنلاین</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- image cols ------------------------------ -//-->
    <div class="container imageCols py-5 mb-5">
        <div class="row g-4">
            <div class="col-12">
                <div class="text-center m-4">
                    <div class="fs-4 fw-bold mb-3">سفر بدون دغدغه با راهنمای ما</div>
                    <p class="lead lh-lg">با استفاده از راهنمای ما، سفرتان را به راحتی برنامه‌ریزی کنید. اطلاعات مورد نیاز خود را به سرعت و آسان پیدا کنی</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="imageCols-item m-4"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/cols/1.jpg" alt="">
                    <div class="imageCols-content p-5"><a class="btn btn-lg btn-dark" href="">
                            راهنمای غذای سفر<i class="ti ti-arrow-left fs-5"></i></a></div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="imageCols-item m-4"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/cols/2.jpg" alt="">
                    <div class="imageCols-content p-5"><a class="btn btn-lg btn-dark" href="">
                            راهنمای آموزشی سفر<i class="ti ti-arrow-left fs-5"></i></a></div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="imageCols-item m-4"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/cols/3.jpg" alt="">
                    <div class="imageCols-content p-5"><a class="btn btn-lg btn-dark" href="">
                            راهنمای بهداشتی سفر<i class="ti ti-arrow-left fs-5"></i></a></div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="imageCols-item m-4"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/cols/4.jpg" alt="">
                    <div class="imageCols-content p-5"><a class="btn btn-lg btn-dark" href="">
                            راهنمای مسیریابی<i class="ti ti-arrow-left fs-5"></i></a></div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -------------------------------- -//-->
    <div class="bg-light py-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 py-5">
                    <div class="h-100 bg-body border rounded p-5">
                        <div class="fs-5 fw-bold mb-3">تجربه‌ای فراتر از پرواز</div>
                        <p class="lead lh-lg">ما در پرنت، با بیش از دو دهه تجربه در صنعت حمل و نقل هوایی، متعهد به ارائه سفری آسوده و به یاد ماندنی برای مسافران عزیز هستیم. با ناوگانی مدرن و خدماتی فراتر از انتظار، تلاش می‌کنیم تا هر پرواز، آغاز یک ماجراجویی جدید باشد. از رزرو آنلاین آسان تا پذیرایی گرم در طول پرواز، پرنت همواره در کنار شماست تا لحظات شیرین سفر را برایتان رقم بزند.</p><a class="nt-flex-start-center link link-secondary" href="">اطلاعات بیشتر<i class="ti ti-chevron-left fs-5"></i></a>
                    </div>
                </div>
                <div class="col-12 col-md-6 py-5">
                    <div class="h-100 bg-body border rounded p-5">
                        <div class="fs-5 fw-bold mb-3">تمرکز بر تعهد به مشتری و ایمنی</div>
                        <p class="lead lh-lg">ما در پرنت، باور داریم که هر مسافری شایسته بهترین خدمات است. به همین دلیل، تیم حرفه‌ای ما همواره در تلاش است تا با ارائه خدمات شخصی‌سازی شده، پاسخگوی نیازهای خاص هر مسافر باشد. از لحظه رزرو بلیط تا پایان سفر، ما در کنار شما هستیم تا اطمینان حاصل کنیم که تجربه پروازی لذت‌بخشی داشته باشید. ایمنی، اولویت اصلی ماست. با استفاده از ناوگان هوایی مدرن و رعایت دقیق استانداردهای ایمنی جهانی، پرنت محیطی امن و آرام را برای تمامی مسافران فراهم می‌کند.</p><a class="nt-flex-start-center link link-secondary" href="">اطلاعات بیشتر<i class="ti ti-chevron-left fs-5"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured brands --------------------------- -//-->
    <div class="featuredBrands container py-5 mb-5">
        <div class="row g-4">
            <div class="col-12">
                <div class="nt-flex-start-center"><i class="ti ti-north-star text-primary fs-5"></i>
                    <div class="fs-5 fw-bold">شرکت های برتر</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/index/logos/flypersia.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">شرکت هواپیمایی</div>
                            <div class="fs-5 fw-bold">فلای پرشیا</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/index/logos/taban.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">شرکت هواپیمایی</div>
                            <div class="fs-5 fw-bold">تابان</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/index/logos/saha.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">شرکت هواپیمایی</div>
                            <div class="fs-5 fw-bold">ساها</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/index/logos/ata.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">شرکت هواپیمایی</div>
                            <div class="fs-5 fw-bold">آتا</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
        </div>
    </div>
    <!-- image caption 2 --------------------------- -//-->
    <div class="imageCaption2 py-5" style="--image: url('<?=$bundleBaseUrl?>/img/pages/index/paperwork.jpg')">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="imageCaption2-image"></div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="h-100 nt-flex-column-center-start p-4">
                        <div class="btn btn-primary rounded-pill pe-none mb-3">پیشنهاد سازمانی</div>
                        <div class="text-light nt-flex-start-center mb-4"><i class="ti ti-send fs-2"></i>
                            <div class="fs-3 fw-bold">
                                سفرهای سازمانی هوشمند با
                                پرنت
                            </div>
                        </div>
                        <p class="text-light lh-lg">
                            به دنبال راهی برای مدیریت سفرهای سازمانی خود با هزینه کمتر و بهره‌مندی از خدمات ویژه هستید؟ با ما همراه شوید. ما به شرکت‌ها امکان می‌دهیم تا با
                            &nbsp;<a class="link-primary" href="">
                                شرایط ویژه</a>&nbsp;
                            و
                            &nbsp;<a class="link-primary" href="">
                                پشتیبانی اختصاصی</a>&nbsp;
                            ، بلیط‌های مورد نیاز خود را رزرو کنند. از تخفیفات ویژه تا مدیریت سفرهای گروهی، همه چیز را برای شما تسهیل کرده‌ایم.
                        </p>
                        <ul class="text-light">
                            <li>تخفیفات ویژه بر روی تمامی بلیط‌ها</li>
                            <li>پشتیبانی اختصاصی برای هرگونه سوال و مشکل</li>
                            <li>امکان رزرو گروهی و مدیریت آسان سفرها</li>
                            <li>دسترسی به گزارش‌های جامع از سفرهای انجام شده</li>
                        </ul>
                        <div class="nt-flex-start-center gap-4">
                            <p class="text-light fw-bold lh-lg mb-0">برای دریافت آخرین اطلاعات با ما تماس بگیرید</p>
                            <button class="btn btn-lg btn-dark" type="button">
                                تماس با ما</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
