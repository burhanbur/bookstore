        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('front/img/logo_up2.png') }}" alt=""></a>
                        </div>
                        <ul>
                            <li><strong><i class="fa fa-map-marker"></i></strong> &nbsp; Jl. Teuku Nyak Arief, Simprug, Kebayoran Lama, Jakarta 12220.</li>
                            <li><strong><i class="fa fa-phone-square"></i></strong> &nbsp; (021) 50857540</li>
                            <li><strong><i class="fa fa-envelope"></i></strong> &nbsp; perpustakaan@universitaspertamina.ac.id</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Layanan Kami</h6>
                        <ul>
                            <li><a href="#">Bantuan</a></li>
                            <li><a href="{{ asset('surat_pernyataan_keaslian.docx') }}">Kebijakan</a></li>
                            <li><a href="{{ asset('pedoman_penerbitan_buku_perpus_univ_pertamina_4.pdf') }}">Penerbitan</a></li>
                        </ul> 
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>Kategori</h6>
                        <ul>
                            @foreach(\App\Utilities\Dropdown::listCategories() as $k => $v)
                                <li><a href="#">{{ $v }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Bergabunglah dengan Newsletter Kami Sekarang</h6>
                        <p>Dapatkan pembaruan email tentang toko terbaru kami dan penawaran khusus.</p>
                        <form action="#">
                            <input type="text" placeholder="Masukkan alamat email Anda">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="https://www.facebook.com/universitaspertamina" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/UnivPertamina" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.instagram.com/universitaspertamina/" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCwoZlTkQX9qfyabTfv6F0gg" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                              Copyright &copy;<script>document.write(new Date().getFullYear());</script> UPer Press. All rights reserved.
                            </p>
                        </div>
                        <!-- <div class="footer__copyright__payment"><img src="{{ asset('front/img/payment-item.png') }}" alt=""></div> -->
                    </div>
                </div>
            </div>
        </div>