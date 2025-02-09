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
    <div class="booking-wrapper" style="background-image: url(<?=$bundleBaseUrl?>/img/pages/booking-tours/tour.jpg)">
        <div class="container g-0 booking-inner shadow-sm">
            <nav class="booking-nav"><a class="btn btn-white" href="index"> <i class="ti ti-plane-inflight fs-2"></i>پرواز داخلی</a><a class="btn btn-white" href="external"> <i class="ti ti-plane-departure fs-2"></i>پرواز خارجی</a><a class="btn btn-white" href="train"> <i class="ti ti-train fs-2"></i>قطار</a><a class="btn btn-white active" href="tour"> <i class="ti ti-luggage fs-2"></i>تور</a></nav>
            <div class="container g-3">
                <form class="row g-3 booking-form" action="">
                    <!-- top row ------------------------------- -//-->
                    <div class="col-12">
                        <div class="py-4"></div>
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
                            <input class="form-control" id="bookingTo" type="text" name="" placeholder="تاریخ برگشت" data-jdp="">
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
    <!-- Popular routes-->
    <div class="popularRoutes container py-4 mb-5">
        <div class="nt-flex-between-center mb-4">
            <div class="nt-flex-start-center gap-2 fw-bold fs-5"><i class="ti ti-award fs-3"></i>برترین تور ها</div><a class="btn btn-light btn-sm" href="">
                مشاهده همه<i class="ti ti-chevron-left"></i></a>
        </div>
        <div class="swiper pb-5 swiper-initialized swiper-horizontal swiper-rtl swiper-backface-hidden" data-swiper-options="{ &quot;slidesPerView&quot;:1, &quot;spaceBetween&quot;:10, &quot;breakpoints&quot;:{ &quot;760&quot;:{&quot;slidesPerView&quot;:2},&quot;992&quot;:{&quot;slidesPerView&quot;:3},&quot;1180&quot;:{&quot;slidesPerView&quot;:4} }, &quot;pagination&quot;: {&quot;el&quot;:&quot;.swiper-pagination&quot;,&quot;dynamicBullets&quot;:true} }">
            <div class="swiper-wrapper" id="swiper-wrapper-46a80efe76c3b196" aria-live="polite">
                <!-- slide-->
                <div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1">
                            <div class="popularRoutes-image rounded" style="background-image: url('<?=$bundleBaseUrl?>/img/pages/booking-tours/slider/ardabil.jpg')"></div>
                            <div class="p-4 pb-0">
                                <div class="text-truncate fw-bold mb-2">تور ریلی سرعین، اردبیل و مشکین شهر</div>
                                <div class="nt-flex-start-center flex-nowrap">
                                    <div class="text-nowrap">مرداد ماه</div><i class="ti ti-point-filled small text-muted"></i>
                                    <div class="text-muted text-truncate">تور 4 روزه - هتل آپارتمان 3 ستاره - قطار کوپه ای</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۶،۶۰۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide swiper-slide-next" role="group" aria-label="2 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1">
                            <div class="popularRoutes-image rounded" style="background-image: url('<?=$bundleBaseUrl?>/img/pages/booking-tours/slider/russia.jpg')"></div>
                            <div class="p-4 pb-0">
                                <div class="text-truncate fw-bold mb-2">تور 7 روزه روسیه ویژه شب‌های سفید (هتل 4 ستاره)</div>
                                <div class="nt-flex-start-center flex-nowrap">
                                    <div class="text-nowrap">مرداد ماه</div><i class="ti ti-point-filled small text-muted"></i>
                                    <div class="text-muted text-truncate">تور 7 روزه روسیه ویژه شب‌های سفید (هتل 4 ستاره)</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۵۱،۹۹۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="3 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1">
                            <div class="popularRoutes-image rounded" style="background-image: url('<?=$bundleBaseUrl?>/img/pages/booking-tours/slider/Vietnam.jpg')"></div>
                            <div class="p-4 pb-0">
                                <div class="text-truncate fw-bold mb-2">تور 10 روزه ویتنام (هتل‌های 4 و 5 ستاره)</div>
                                <div class="nt-flex-start-center flex-nowrap">
                                    <div class="text-nowrap">شهریور ماه</div><i class="ti ti-point-filled small text-muted"></i>
                                    <div class="text-muted text-truncate">تور 10 روزه ویتنام (هتل‌های 4 و 5 ستاره)</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۷۹،۹۰۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="4 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1">
                            <div class="popularRoutes-image rounded" style="background-image: url('<?=$bundleBaseUrl?>/img/pages/booking-tours/slider/Sri Lanka.jpg')"></div>
                            <div class="p-4 pb-0">
                                <div class="text-truncate fw-bold mb-2">تور سریلانکا 8 روزه</div>
                                <div class="nt-flex-start-center flex-nowrap">
                                    <div class="text-nowrap">شهریور ماه</div><i class="ti ti-point-filled small text-muted"></i>
                                    <div class="text-muted text-truncate">تور سریلانکا 8 روزه</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۲۱،۹۹۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
                <!-- slide-->
                <div class="swiper-slide" role="group" aria-label="5 / 5" style="width: 317.25px; margin-left: 10px;"><a class="link" href="">
                        <div class="flex-grow-1">
                            <div class="popularRoutes-image rounded" style="background-image: url('<?=$bundleBaseUrl?>/img/pages/booking-tours/slider/Brazil.jpg')"></div>
                            <div class="p-4 pb-0">
                                <div class="text-truncate fw-bold mb-2">تور لوکس برزیل</div>
                                <div class="nt-flex-start-center flex-nowrap">
                                    <div class="text-nowrap">شهریور ماه</div><i class="ti ti-point-filled small text-muted"></i>
                                    <div class="text-muted text-truncate">تور لوکس برزیل</div>
                                </div>
                            </div>
                        </div>
                        <div class="popularRoutes-price py-3 px-4">
                            <div class="text-muted small">شروع قیمت از</div>
                            <div class="fs-6">
                                ۷۹،۹۰۰،۰۰۰
                                تومان
                            </div>
                        </div></a></div>
            </div>
            <!---->
            <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-horizontal swiper-pagination-bullets-dynamic" style="width: 80px;"><span class="swiper-pagination-bullet swiper-pagination-bullet-active swiper-pagination-bullet-active-main" aria-current="true" style="right: 8px;"></span><span class="swiper-pagination-bullet swiper-pagination-bullet-active-next" style="right: 8px;"></span></div>
            <div class="swiper-button-next swiper-button-next-0" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-46a80efe76c3b196" aria-disabled="false"></div>
            <div class="swiper-button-prev swiper-button-prev-0 swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-46a80efe76c3b196" aria-disabled="true"></div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
    </div>
    <!-- paraghraphs-->
    <div class="container py-4 mb-5">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="p-4">
                    <div class="fw-bold mb-3">جهان در دستان شماست!</div>
                    <div class="text-muted mb-3">با پرنت به دور دنیا سفر کنید.</div>
                    <p class="lh-lg">پرنت با ارائه متنوع‌ترین تورهای داخلی و خارجی، رؤیای سفر شما را به واقعیت تبدیل می‌کند. از کوچه‌پس‌کوچه‌های تاریخ‌ساز ایران تا سواحل بکر و شهرهای مدرن جهان، ما مقاصد متنوعی را برای شما فراهم کرده‌ایم. با پرنت، شما می‌توانید از بین تورهای گروهی، تورهای اختصاصی و تورهای لحظه آخری، بهترین گزینه را انتخاب کنید.</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-4">
                    <div class="fw-bold mb-3">سفر بدون دغدغه با پرنت!</div>
                    <div class="text-muted mb-3">ما همه چیز را برای شما آماده کرده‌ایم.</div>
                    <p class="lh-lg">ما با همکاری بهترین هتل‌ها، خطوط هوایی و راهنمایان تور، سفری خاطره‌انگیز را برایتان تدارک می‌بینیم. از رزرو بلیط هواپیما و هتل گرفته تا ترانسفر فرودگاهی و برنامه‌های گشت و گذار، همه چیز را برای شما انجام می‌دهیم تا شما فقط از سفر خود لذت ببرید. با گارانتی بهترین قیمت، اطمینان خاطر داشته باشید که با کمترین هزینه، بهترین سفر را تجربه خواهید کرد.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- fullcover-->
    <div class="container py-4 mb-5">
        <div class="row g-0 bg-light-subtle border border-2 rounded">
            <div class="col-12 col-md-4 order-md-last"><img class="lozad rounded" src="img/pages/index/airplane.png" alt="cover" data-loaded="true"></div>
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
    <!-- about-->
    <div class="container py-4 mb-5">
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="fs-5 fw-bold mb-3">خدمات ویژه تور</div>
                <p class="lead lh-lg">در پرنت، ما به دنبال ارائه بهترین تجربه سفر برای شما هستیم. به همین دلیل، طیف گسترده‌ای از خدمات ویژه را برای رفاه حال مسافران خود در نظر گرفته‌ایم. از رزرو هتل‌های لوکس و اقامتگاه‌های بوم‌گردی گرفته تا ترانسفر فرودگاهی اختصاصی، راهنمای تور حرفه‌ای و برنامه‌های تفریحی متنوع، همه و همه برای آن است که سفری خاطره‌انگیز را برای شما رقم بزنیم. علاوه بر این، با خرید هر تور، شما به عضویت در باشگاه مشتریان پرنت درآمده و از تخفیفات ویژه و پیشنهادهای جذاب بهره‌مند خواهید شد.</p>
                <div class="text-center"><a class="nt-flex-start-center link link-secondary" href="">اطلاعات بیشتر<i class="ti ti-chevron-left fs-5"></i></a></div>
            </div>
        </div>
    </div>
    <!-- spacer-->
    <div class="py-5"></div>
</main>