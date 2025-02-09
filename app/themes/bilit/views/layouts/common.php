<?php

use app\widgets\Alert;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap4\Html;

/* @var $this \yii\web\View */
/* @var $content string */
$bundleBaseUrl = $this->getAssetManager()->getBundle('app\themes\bilit\ThemeAsset')->baseUrl;

$this->beginContent('@themeLayouts/base.php');
?>

    <header class="header dynamic scrolled">
        <div class="container py-3">
            <div class="row align-items-center">
                <!-- logo & menu (mobile)-->
                <div class="col-auto">
                    <div class="nt-flex-start-center">
                        <!-- menu (mobile)-->
                        <div class="d-md-none">
                            <button class="btn btn-link link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu"><i class="ti ti-menu-2 fs-1"></i></button>
                        </div>
                        <!-- logo--><a class="header-logo link" href="./index.html"><img src="<?=$bundleBaseUrl?>/img/logo.png" alt="" width="40">
                            <h1 class="fs-2 fw-bold">پرنت</h1></a>
                    </div>
                </div>
                <!-- nav-->
                <div class="col">
                    <!-- nav (desktop)-->
                    <nav class="header-nav d-none d-md-flex">
                        <!-- nav link-->
                        <div class="dropdown">
                            <button class="btn btn-link link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">بلیط</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href=""><i class="ti ti-plane-inflight fs-4"></i>پرواز داخلی</a></li>
                                <li><a class="dropdown-item" href=""><i class="ti ti-plane-departure fs-4"></i>پرواز خارجی</a></li>
                                <li><a class="dropdown-item" href=""><i class="ti ti-train fs-4"></i>قطار</a></li>
                                <li><a class="dropdown-item" href=""><i class="ti ti-bus fs-4"></i>اتوبوس</a></li>
                            </ul>
                        </div>
                        <!-- nav link-->
                        <div class="dropdown">
                            <button class="btn btn-link link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">اقامت</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href=""><i class="ti ti-building-skyscraper fs-4"></i>هتل</a></li>
                                <li><a class="dropdown-item" href=""><i class="ti ti-home-2 fs-4"></i>ویلا و اقامتگاه</a></li>
                            </ul>
                        </div>
                        <!-- nav link--><a class="btn btn-link link" href="">تور</a>
                        <!-- nav link--><a class="btn btn-link link" href="">ویزا</a>
                    </nav>
                </div>
                <!-- theme switcher-->
                <div class="col-auto d-none d-md-flex">
                    <button class="btnSwitch btn btn-lg btn-light" type="button"> <i class="ti ti-sun fs-5"></i></button>
                </div>
                <!-- user-->
                <div class="col-auto"><a class="btn btn-light header-user" type="button" data-bs-toggle="modal" data-bs-target="#signModal"> <i class="ti ti-user fs-3 text-muted"></i>
                        <div class="fs-6">ورود یا ثبت نام</div></a></div>
            </div>
        </div>
    </header>
    <?= $content ?>
    <footer class="footer">
        <!-- top-->
        <div class="container border-bottom mb-5">
            <div class="row py-5">
                <div class="col-12 col-md-4">
                    <div class="fs-5 fw-bold mb-3">بهترین پیشنهادها، مستقیم در ایمیل شما</div>
                    <p class="lh-lg">با ثبت‌نام در خبرنامه، از جدیدترین پیشنهادهای پروازی، تخفیفات ویژه و رویدادهای جذاب مطلع شوید.</p>
                </div>
                <div class="col-12 col-md-4 offset-md-4">
                    <form action="">
                        <div class="input-group">
                            <div class="form-floating">
                                <input class="form-control" id="floatingInputGroup1" type="email" placeholder="ایمیل شما">
                                <label for="floatingInputGroup1">ایمیل شما</label>
                            </div>
                            <button class="btn btn-white border px-4" type="submit">
                                ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- content-->
        <div class="footer-content">
            <div class="container">
                <div class="row g-4">
                    <!-- logo & badges-->
                    <div class="col-12 col-md-6">
                        <div class="nt-flex-column-start-center align-items-md-start gap-2">
                            <div class="nt-flex-start-center gap-2 mb-3"><img src="<?=$bundleBaseUrl?>/img/logo.png" alt="" width="40">
                                <h1 class="fs-2 fw-bold mb-0">پرنت</h1>
                            </div>
                            <div class="nt-flex gap-1">تلفن‌ :‌
                                <div dir="ltr">۰۲۱-۱۲۳۴۰۰۰۰</div>
                            </div>
                            <p>
                                آدرس :
                                میدان انقلاب، خیابان ولیعصر، ساختمان شماره ۱۰
                            </p>
                            <div class="mb-4"></div>
                            <nav class="nt-flex"><a class="link footer-badge" href=""> <img class="lozad" src="<?=$bundleBaseUrl?>/img/layouts/footer/badges/enamad.jpg" alt="" data-loaded="true"></a><a class="link footer-badge" href=""> <img class="lozad" src="<?=$bundleBaseUrl?>/img/layouts/footer/badges/kasbokar.jpg" alt="" data-loaded="true"></a><a class="link footer-badge" href=""> <img class="lozad" src="<?=$bundleBaseUrl?>/img/layouts/footer/badges/rezi.jpg" alt="" data-loaded="true"></a></nav>
                        </div>
                    </div>
                    <!-- nav (mobile)-->
                    <div class="col-12 col-md-6 d-md-none">
                        <div class="accordion accordion-flush" id="footerAccordionNav">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#footerAccordionNav1" aria-expanded="false" aria-controls="footerAccordionNav1">پرنت</button>
                                </h2>
                                <div class="accordion-collapse collapse" id="footerAccordionNav1" data-bs-parent="#footerAccordionNav">
                                    <div class="accordion-body">
                                        <div class="d-grid gap-3"><a class="link" href="">
                                                درباره ما</a><a class="link" href="">
                                                تماس با ما</a><a class="link" href="">
                                                چرا پرنت</a><a class="link" href=""> پرنت پلاس</a><a class="link" href="">
                                                بیمه مسافرتی</a><a class="link" href="">
                                                محله پرنت</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#footerAccordionNav2" aria-expanded="false" aria-controls="footerAccordionNav2">خدمات مشتریان</button>
                                </h2>
                                <div class="accordion-collapse collapse" id="footerAccordionNav2" data-bs-parent="#footerAccordionNav">
                                    <div class="accordion-body">
                                        <div class="d-grid gap-3"><a class="link" href="">
                                                مرکز پشتیبانی آنلاین</a><a class="link" href="">
                                                راهنمای خرید </a><a class="link" href="">
                                                راهنمای استرداد</a><a class="link" href="">
                                                قوانین و مقررات</a><a class="link" href="">
                                                پرسش و پاسخ</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#footerAccordionNav3" aria-expanded="false" aria-controls="footerAccordionNav3">اطلاعات تکمیلی</button>
                                </h2>
                                <div class="accordion-collapse collapse" id="footerAccordionNav3" data-bs-parent="#footerAccordionNav">
                                    <div class="accordion-body">
                                        <div class="d-grid gap-3"><a class="link" href="">
                                                فروش سازمانی</a><a class="link" href="">
                                                همکاری با آژانس ها</a><a class="link" href="">
                                                فرصت های شغلی</a><a class="link" href="">
                                                سنجش رضایتمندی</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- nav (desktop)-->
                    <div class="col-12 col-md-6 d-none d-md-block">
                        <div class="row g-3">
                            <div class="col-6 col-md-4">
                                <h5 class="fs-5 fw-bold mb-4">پرنت</h5>
                                <div class="d-grid gap-3"><a class="link" href="">
                                        درباره ما</a><a class="link" href="">
                                        تماس با ما</a><a class="link" href="">
                                        چرا پرنت</a><a class="link" href=""> پرنت پلاس</a><a class="link" href="">
                                        بیمه مسافرتی</a><a class="link" href="">
                                        محله پرنت</a></div>
                            </div>
                            <div class="col-6 col-md-4">
                                <h5 class="fs-5 fw-bold mb-4">خدمات مشتریان</h5>
                                <div class="d-grid gap-3"><a class="link" href="">
                                        مرکز پشتیبانی آنلاین</a><a class="link" href="">
                                        راهنمای خرید </a><a class="link" href="">
                                        راهنمای استرداد</a><a class="link" href="">
                                        قوانین و مقررات</a><a class="link" href="">
                                        پرسش و پاسخ</a></div>
                            </div>
                            <div class="col-6 col-md-4">
                                <h5 class="fs-5 fw-bold mb-4">اطلاعات تکمیلی</h5>
                                <div class="d-grid gap-3"><a class="link" href="">
                                        فروش سازمانی</a><a class="link" href="">
                                        همکاری با آژانس ها</a><a class="link" href="">
                                        فرصت های شغلی</a><a class="link" href="">
                                        سنجش رضایتمندی</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright-->
        <div class="footer-copyright">
            <div class="container">
                <div class="row py-5">
                    <div class="col-12 col-md">
                        <p class="text-muted lh-lg small">
                            هرگونه استفاده از این موارد بدون مجوز کتبی و صریح از شرکت
                            پرنت
                            ، نقض حقوق مالکیت معنوی محسوب شده و پیگرد قانونی خواهد داشت.
                        </p>
                    </div>
                    <div class="col-12 col-md-auto">
                        <nav class="nt-flex-center-center gap-4 justify-content-md-start"><a class="link" href=""> <i class="ti ti-brand-telegram fs-2"></i></a><a class="link" href=""> <i class="ti ti-brand-x fs-2"></i></a><a class="link" href=""> <i class="ti ti-brand-youtube fs-2"></i></a><a class="link" href=""> <i class="ti ti-brand-instagram fs-2"></i></a><a class="link" href=""> <i class="ti ti-brand-linkedin fs-2"></i></a></nav>
                    </div>
                </div>
            </div>
        </div>
        <svg id="visual" viewBox="0 0 900 600" width="900" height="600" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" preserveAspectRatio="none">
            <path class="path-first" d="M0 328L75 357.8C150 387.7 300 447.3 450 438.3C600 429.3 750 351.7 825 312.8L900 274L900 601L825 601C750 601 600 601 450 601C300 601 150 601 75 601L0 601Z" fill="#f7f8f9"></path>
            <path class="path-second" d="M0 510L75 507.3C150 504.7 300 499.3 450 496.8C600 494.3 750 494.7 825 494.8L900 495L900 601L825 601C750 601 600 601 450 601C300 601 150 601 75 601L0 601Z" fill="#e0e3e8"></path>
        </svg>
    </footer>
<?php $this->endContent() ?>