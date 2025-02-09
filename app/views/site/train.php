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
    <div class="booking-wrapper" style="background-image: url(<?=$bundleBaseUrl?>/img/pages/booking-trains/train.jpg)">
        <div class="container g-0 booking-inner shadow-sm">
            <nav class="booking-nav"><a class="btn btn-white" href="index"> <i class="ti ti-plane-inflight fs-2"></i>پرواز داخلی</a><a class="btn btn-white" href="external"> <i class="ti ti-plane-departure fs-2"></i>پرواز خارجی</a><a class="btn btn-white active" href="train"> <i class="ti ti-train fs-2"></i>قطار</a><a class="btn btn-white" href="tour"> <i class="ti ti-luggage fs-2"></i>تور</a></nav>
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
                            <div class="d-inline-block">
                                <select class="rounded-pill form-select" aria-label="Default select example">
                                    <option value="1" selected="selected">دربست می‌خواهم</option>
                                    <option value="2">دربست نمی‌خواهم</option>
                                </select>
                            </div>
                            <div class="d-inline-block">
                                <select class="rounded-pill form-select" aria-label="Default select example">
                                    <option value="1" selected="selected">مسافرین عادی</option>
                                    <option value="2">ویژه برادران</option>
                                    <option value="3">ویژه خواهران</option>
                                </select>
                            </div>
                            <div class="d-inline-block">
                                <select class="rounded-pill form-select" aria-label="Default select example">
                                    <option value="1" selected="selected">حمل خودرو می‌خواهم</option>
                                    <option value="2">حمل خودرو نمی‌خواهم</option>
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
    <div class="container topOffersSlider py-4">
        <div class="nt-flex-start-center gap-2 fw-bold fs-5 mb-4"><i class="ti ti-award fs-3"></i>پیشنهاد ها</div>
        <div class="swiper pb-5 swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden" data-swiper-options="{ &quot;loop&quot;:true, &quot;slidesPerView&quot;:1, &quot;spaceBetween&quot;:10, &quot;breakpoints&quot;:{ &quot;760&quot;:{&quot;slidesPerView&quot;:2},&quot;992&quot;:{&quot;slidesPerView&quot;:3} }, &quot;pagination&quot;: {&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;dynamicBullets&quot;:true} }">
            <div class="swiper-wrapper" id="swiper-wrapper-f32e8f5727e2f7b9" aria-live="polite">
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
            <!---->
            <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic" style="width: 80px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" aria-current="true" style="right: 32px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" style="right: 32px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next-next" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span><span class="swiper-pagination-bullet" style="right: 32px;"></span></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </div>
    <!-- Popular routes-->
    <div class="popularRoutes container py-4 mb-4">
        <div class="nt-flex-start-center gap-2 fw-bold fs-5 mb-4"><i class="ti ti-train fs-3"></i>مسیر های پرمخاطب</div>
        <div class="swiper pb-5 swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden" data-swiper-options="{ &quot;slidesPerView&quot;:1, &quot;spaceBetween&quot;:10, &quot;breakpoints&quot;:{ &quot;760&quot;:{&quot;slidesPerView&quot;:2},&quot;992&quot;:{&quot;slidesPerView&quot;:3},&quot;1180&quot;:{&quot;slidesPerView&quot;:4} }, &quot;pagination&quot;: {&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;dynamicBullets&quot;:true} }">
            <div class="swiper-wrapper" id="swiper-wrapper-96ed9f5762419c61" aria-live="polite">
                <!-- slide-->
                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 4" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
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
                            <div class="text-dark">
                                ۱،۵۷۴،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 4" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
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
                            <div class="text-dark">
                                ۱،۶۳۷،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="3 / 4" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
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
                            <div class="text-dark">
                                ۲،۳۵۱،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="4 / 4" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
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
                            <div class="text-dark">
                                ۲،۶۷۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
            </div>
            <!---->
            <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic swiper-pagination-lock" style="width: 40px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" aria-current="true" style="right: 0px;"></span></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </div>
    <!-- fullcover-->
    <div class="container py-4 mb-5">
        <div class="row g-0 bg-light-subtle border border-2 rounded">
            <div class="col-12 col-md-4 order-md-last"><img class="lozad rounded" src="<?=$bundleBaseUrl?>/img/pages/index/train.png" alt="cover"></div>
            <div class="col-12 col-md-4 offset-md-1">
                <div class="h-100 nt-flex-column-center-start gap-4 p-4">
                    <div class="fs-2 fw-bold">
                        خرید تلفنی
                        پرنت
                    </div>
                    <div class="fs-3 lead">سفر، تنها محدود به آرزوهای توست!</div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="h-100 nt-flex-column-center-center gap-4 py-4">
                    <div class="nt-flex-start-center fs-3 fw-bold">۰۲۱-۱۲۳۴<i class="ti ti-phone-filled fs-2"></i></div><a class="btn btn-lg btn-secondary" href="">
                        اطلاعات بیشتر</a>
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
                                    <div class="fs-5">چگونه می‌توان بلیط قطار را خریداری کرد؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseOne">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">برای خرید بلیط، کافیست مسیر، تاریخ سفر و تعداد مسافران را انتخاب کرده و سپس به سبد خرید اضافه نمایید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">آیا می‌توان بلیط خریداری شده را کنسل کرد؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseTwo">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">بله، امکان کنسل کردن بلیط وجود دارد. برای کسب اطلاعات بیشتر در مورد شرایط و هزینه کنسلی، به بخش قوانین و مقررات مراجعه نمایید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">چگونه می‌توانم از تخفیفات و پیشنهادات ویژه مطلع شوم؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseThree">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">برای اطلاع از تخفیفات و پیشنهادات ویژه، به صفحه اصلی سایت مراجعه کرده یا در خبرنامه ما مشترک شوید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">آیا امکان تغییر تاریخ و ساعت قطار وجود دارد؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseFour">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">بله، با پرداخت هزینه جریمه، امکان تغییر تاریخ و ساعت قطار وجود دارد.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">چه مدارکی برای سوار شدن به قطار لازم است؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseFive">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">برای سوار شدن به قطار، همراه داشتن اصل کارت ملی و بلیط چاپ شده یا الکترونیکی الزامی است.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">چگونه می‌توانم با پشتیبانی سایت تماس بگیرم؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseSix">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">برای تماس با پشتیبانی، می‌توانید از طریق شماره تلفن، ایمیل یا چت آنلاین با ما در ارتباط باشید.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                                    <div class="commonQuestions-icon bg-secondary bg-opacity-10 me-3"><i class="ti ti-question-mark fs-4 text-secondary"></i></div>
                                    <div class="fs-5">آیا امکان رزرو کوپه دربست وجود دارد؟</div>
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse" id="panelsStayOpen-collapseSeven">
                                <div class="accordion-body">
                                    <p class="lead lh-lg">بله، امکان رزرو کوپه دربست برای گروه‌های مسافرتی وجود دارد.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -------------------------------- -//-->
    <div class="container py-4 mb-5">
        <div class="row">
            <div class="col-12 col-md-6 py-5">
                <div class="fs-5 fw-bold mb-3">تجربه‌ای فراتر از پرواز</div>
                <p class="lead lh-lg">ما در پرنت، با بیش از دو دهه تجربه در صنعت حمل و نقل هوایی، متعهد به ارائه سفری آسوده و به یاد ماندنی برای مسافران عزیز هستیم. با ناوگانی مدرن و خدماتی فراتر از انتظار، تلاش می‌کنیم تا هر پرواز، آغاز یک ماجراجویی جدید باشد. از رزرو آنلاین آسان تا پذیرایی گرم در طول پرواز، پرنت همواره در کنار شماست تا لحظات شیرین سفر را برایتان رقم بزند.</p><a class="nt-flex-start-center link link-secondary" href="">اطلاعات بیشتر<i class="ti ti-chevron-left fs-5"></i></a>
            </div>
            <div class="col-12 col-md-6 py-5">
                <div class="fs-5 fw-bold mb-3">تمرکز بر تعهد به مشتری و ایمنی</div>
                <p class="lead lh-lg">ما در پرنت، باور داریم که هر مسافری شایسته بهترین خدمات است. به همین دلیل، تیم حرفه‌ای ما همواره در تلاش است تا با ارائه خدمات شخصی‌سازی شده، پاسخگوی نیازهای خاص هر مسافر باشد. از لحظه رزرو بلیط تا پایان سفر، ما در کنار شما هستیم تا اطمینان حاصل کنیم که تجربه پروازی لذت‌بخشی داشته باشید. ایمنی، اولویت اصلی ماست. با استفاده از ناوگان هوایی مدرن و رعایت دقیق استانداردهای ایمنی جهانی، پرنت محیطی امن و آرام را برای تمامی مسافران فراهم می‌کند.</p><a class="nt-flex-start-center link link-secondary" href="">اطلاعات بیشتر<i class="ti ti-chevron-left fs-5"></i></a>
            </div>
            <div class="col-12">
                <p class="lead lh-lg">
                    آیا آماده‌اید تا سفر رویایی خود را آغاز کنید؟ با رزرو آنلاین بلیط از طریق سایت ما، تنها با چند کلیک ساده به مقصد دلخواه خود برسید. ما به شما اطمینان می‌دهیم که بهترین قیمت‌ها و متنوع‌ترین خدمات را در اختیار شما قرار می‌دهیم. برای مشاهده‌ی لیست کامل مقاصد و رزرو بلیط، همین حالا بر روی دکمه‌ی
                    &nbsp;<a class="link" href="">
                        خرید از
                        پرنت</a>&nbsp;
                    کلیک کنید
                    و لذت ببرید .
                </p>
            </div>
        </div>
    </div>
    <!-- featured brands --------------------------- -//-->
    <div class="featuredBrands container py-4 mb-5">
        <div class="row g-4">
            <div class="col-12">
                <div class="fs-5 fw-bold">شرکت های برتر</div>
            </div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/booking-trains/logos/noor.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">قطار</div>
                            <div class="fs-5 fw-bold">نور</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/booking-trains/logos/raja.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">قطار</div>
                            <div class="fs-5 fw-bold">رجا</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/booking-trains/logos/fadak.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">قطار</div>
                            <div class="fs-5 fw-bold">فدک</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
            <div class="col-12 col-md-6 col-lg-3"><a class="link" href="">
                    <div class="featuredBrands-image"><img class="lozad" src="<?=$bundleBaseUrl?>/img/pages/booking-trains/logos/ghadir.png" alt="logo" width="50"></div>
                    <div class="featuredBrands-content">
                        <div class="nt-flex-column">
                            <div class="small">قطار</div>
                            <div class="fs-5 fw-bold">قدیر</div>
                        </div>
                        <div class="btn btn-dark"><i class="ti ti-arrow-up-left fs-3"></i></div>
                    </div></a></div>
        </div>
    </div>
    <!-- spacer-->
    <div class="py-5"></div>
</main>