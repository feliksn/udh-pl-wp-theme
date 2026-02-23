<footer class="footer helper-bg-image-cover-center">
    <div class="container">
        <?php if(is_home()) {?> 
            <!-- footer nubmers -->
            <div class="d-flex flex-wrap justify-content-around text-center py-4 border-bottom border-secondary" style="--bs-border-opacity:.25">
                <div>
                    <div class="footer-numbers-num">36</div>
                    <div class="footer-numbers-text">marki piwa w ofercie</div>
                    <a class="link" href="#">zobacz pełną ofertę</a>
                </div>
                <div>
                    <div class="footer-numbers-num">26</div>
                    <div class="footer-numbers-text">lat na polskim rynku</div>
                    <a class="link" href="#">dowiedz się więcej</a>
                </div>
                <div>
                    <div class="footer-numbers-num">136</div>
                    <div class="footer-numbers-text">pozycji w katalogu</div>
                    <a class="link" href="#">dowiedz się więcej</a>
                </div>
                <div>
                    <div class="footer-numbers-num">51339</div>
                    <div class="footer-numbers-text">punktów dystrybucji</div>
                </div>
            </div>
        <?php } ?>
        <!-- footer logos -->
        <div class="d-flex flex-wrap justify-content-center py-4">
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
            <a class="footer-brand-link" href="#"><span class="footer-brand-logo">MARKA</span></a>
        </div>
        <!-- footer newsletter + social icons -->
        <div class="d-flex align-items-center py-4">
            <form class="footer-newsletter-form row align-items-center">
                <div class="col-auto">
                    <label class="footer-newsletter-label" for="footer-newsletter-field">Dołącz do newslettera!</label>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text"
                            class="form-control footer-newsletter-field rounded-start-4"
                            id="footer-newsletter-field"
                            name="footer-newsletter-field"
                            placeholder="Wpisz swój email">
                        <button class="btn btn-outline-light footer-newsletter-submit rounded-end-4" type="submit">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div class="footer-social ms-auto">
                <?php global $social_links; ?>
                <?php foreach( $social_links as $link_key => $link_val ) { ?>
                    <?php if( $link_key != 'mail') {?>
                        <a class="footer-social-link" href="//<?php echo $link_val; ?>">
                            <i class="footer-social-icon bi bi-<?php echo $link_key; ?>"></i>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div><!-- .container -->

    <!-- footer copyrights -->
    <div class="footer-copyrights">
        <div class="container d-flex justify-content-between py-3">
            <div>&#169; 2026 United Distribution Holding Sp. z o.o. SKA. Wszelkie prawa zastrzeżone.</div>
            <div>Projekt i wykonanie: <a class="footer-copyrights-link" href="http://ars.vision">Ars-Vision</a></div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>