@extends('front.layouts.main')

@section('content')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Semua Kategori</span>
                        </div>
                        <ul>
                            @foreach(\App\Utilities\Dropdown::listCategories() as $k => $v)
                                <li><a href="#">{{ $v }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" placeholder="Apa yang sedang Anda butuhkan?">
                                <button type="submit" class="site-btn">CARI</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <strong>(021) 50857540</strong><br>
                                <!-- <span>support 24/7 time</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

	<!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}"
                                src="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}"
                                src="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}"
                                src="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}" alt="">
                            <img data-imgbigurl="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}"
                                src="{{ asset('front/img/product/details/manajemen-keselamatan-konstruksi-bg.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>Manajemen Keselamatan Konstruksi Jilid 1</h3>
                        <!-- <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(4 ulasan)</span>
                        </div>
                        <div class="product__details__price">Rp 100.000</div> -->
                        <p>
                        	Buku ini disusun untuk memudahkan seluruh masyarakat jasa konstruksi memahami apa itu Standar K4, SMKK, Rancangan Konseptual SMKK, 5 (lima) Elemen SMKK, Biaya Penerapan SMKK, dan diharapkan pembaca mampu memahami dan melaksanakan aturan mengenai keselamatan konstruksi di dalam pelaksanaan setiap tahapan konstruksi. Buku ini disusun berdasarkan materi bimbingan teknis dan sosialisasi yang telah kami lakukan baik di lingkungan Kementerian PUPR, Kementerian/Lembaga lain, Pemda, dan Asosiasi.
                        </p>
                        <p>
                            <strong>Penulis</strong> : Ir. Brawijaya, SE, MEIE, MSCE, Ph.D, IPU, ASEAN.Eng <br>
                            <strong>Editor</strong>  : Tri Kurnia Rahayu Jumeri <br>
                            <strong>Bahasa</strong> : Indonesia<br>
                            <strong>Format</strong>  : Buku Cetak <br>
                            <strong>Jumlah halaman</strong> : - <br>
                            <strong>Penerbit</strong> : UPer Press<br>
                            <strong>ISBN</strong> :  -<br>
                            <strong>Status</strong> : Akan Terbit <br>
                        </p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">TAMBAHKAN KE KERANJANG</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Stok</b> <span>10</span></li>
                            <li><b>Dikirim dari</b> <span>Jakarta Selatan</span></li>
                            <li><b>Pengiriman</b> <span>Estimasi 2 hari</span></li>
                            <li><b>Berat</b> <span>0.5 kg</span></li>
                            <li><b>Bagikan di</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Informasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Ulasan <span>(0)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Deskripsi Produk</h6>
                                    <p>
                                    	Buku ini disusun untuk memudahkan seluruh masyarakat jasa konstruksi memahami apa itu Standar K4, SMKK, Rancangan Konseptual SMKK, 5 (lima) Elemen SMKK, Biaya Penerapan SMKK, dan diharapkan pembaca mampu memahami dan melaksanakan aturan mengenai keselamatan konstruksi di dalam pelaksanaan setiap tahapan konstruksi. Buku ini disusun berdasarkan materi bimbingan teknis dan sosialisasi yang telah kami lakukan baik di lingkungan Kementerian PUPR, Kementerian/Lembaga lain, Pemda, dan Asosiasi.
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Informasi Produk</h6>
                                    <p>
                                    	Buku ini disusun untuk memudahkan seluruh masyarakat jasa konstruksi memahami apa itu Standar K4, SMKK, Rancangan Konseptual SMKK, 5 (lima) Elemen SMKK, Biaya Penerapan SMKK, dan diharapkan pembaca mampu memahami dan melaksanakan aturan mengenai keselamatan konstruksi di dalam pelaksanaan setiap tahapan konstruksi. Buku ini disusun berdasarkan materi bimbingan teknis dan sosialisasi yang telah kami lakukan baik di lingkungan Kementerian PUPR, Kementerian/Lembaga lain, Pemda, dan Asosiasi.
                                    </p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Ulasan Pembeli</h6>
                                    <p>
                                    	Buku ini disusun untuk memudahkan seluruh masyarakat jasa konstruksi memahami apa itu Standar K4, SMKK, Rancangan Konseptual SMKK, 5 (lima) Elemen SMKK, Biaya Penerapan SMKK, dan diharapkan pembaca mampu memahami dan melaksanakan aturan mengenai keselamatan konstruksi di dalam pelaksanaan setiap tahapan konstruksi. Buku ini disusun berdasarkan materi bimbingan teknis dan sosialisasi yang telah kami lakukan baik di lingkungan Kementerian PUPR, Kementerian/Lembaga lain, Pemda, dan Asosiasi.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produk Terkait</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('front/img/product/details/protein-representation-bg.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Protein Representation – Sequence Embedding</a></h6>
                            <!-- <h5>Rp 100.000</h5> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('front/img/product/details/metode-komputasi-geofisika-bg.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Buku ajar metode komputasi geofisika menggunakan Python</a></h6>
                            <!-- <h5>Rp 100.000</h5> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('front/img/product/details/dasar-pemrograman-bahasa-c-bg.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Dasar pemrograman dalam bahasa pemrograman C++</a></h6>
                            <!-- <h5>Rp 100.000</h5> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('front/img/product/details/fisika-dasar-1-bg.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Buku Ajar : Fisika Dasar I</a></h6>
                            <!-- <h5>Rp 100.000</h5> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection