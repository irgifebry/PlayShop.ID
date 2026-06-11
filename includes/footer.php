<?php

?>
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="logo">
                    <span class="logo-icon"></span>
                    <span class="logo-text">PLAYSHOP<span class="highlight">.ID</span></span>
                </div>
                <p>Platform Top Up Game terpercaya di Indonesia. Proses otomatis, harga kompetitif, dan layanan pelanggan 24/7 untuk pengalaman gaming terbaik Anda.</p>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Perusahaan</h4>
                <ul class="footer-links">
                    <li><a href="about.php">Tentang Kami</a></li>
                    <li><a href="career.php">Karier</a></li>
                    <li><a href="partnership.php">Partnership</a></li>
                    <li><a href="blog.php">Blog & Berita</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Dukungan</h4>
                <ul class="footer-links">
                    <li><a href="faq.php">Pusat Bantuan / FAQ</a></li>
                    <li><a href="contact.php">Hubungi Kami</a></li>
                    <li><a href="check-order.php">Cek Status Pesanan</a></li>
                    <li><a href="promo.php">Promo & Voucher</a></li>
                    <li><a href="testimonials.php">Testimoni</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Akun Anda</h4>
                <ul class="footer-links">
                    <li><a href="profile.php">Profil Saya</a></li>
                    <li><a href="history.php">Riwayat Transaksi</a></li>
                    <li><a href="login.php">Masuk / Daftar</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4 class="footer-heading">Legal</h4>
                <ul class="footer-links">
                    <li><a href="privacy.php">Kebijakan Privasi</a></li>
                    <li><a href="privacy.php#terms">Syarat & Ketentuan</a></li>
                    <li><a href="privacy.php#refund">Kebijakan Refund</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> PLAYSHOP<a href="admin/login.php" style="text-decoration: none; color: inherit; cursor: default;">.</a>ID - Hak Cipta Dilindungi. Dibuat untuk gamers Indonesia.</p>
        </div>
    </div>
</footer>
</div>


<a href="#" class="back-to-top" id="backToTop">
    <span>↑</span>
</a>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>
<script>
(function() {

    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    const navbar = document.querySelector('.navbar');
    const backToTop = document.getElementById('backToTop');
    const navLinks = document.querySelectorAll('.nav-menu a');
    const isHomePage = window.location.pathname.endsWith('index.php') || window.location.pathname.endsWith('/') || window.location.pathname === '';
    let isManualScrolling = false;
    let scrollTimeout = null;
    
    if(navToggle && navMenu) {
        
        navToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
            
            

            if(navMenu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
                navMenu.style.maxHeight = '500px';
                navMenu.style.opacity = '1';
                navMenu.style.visibility = 'visible';
                navMenu.style.display = 'flex';
                navMenu.style.flexDirection = 'column';
                navMenu.style.background = 'rgba(17, 24, 39, 0.95)';
                navMenu.style.backdropFilter = 'blur(10px)';
                navMenu.style.position = 'absolute';
                navMenu.style.top = 'calc(100% + 15px)';
                navMenu.style.left = '5%';
                navMenu.style.width = '90%';
                navMenu.style.borderRadius = '20px';
                navMenu.style.zIndex = '2147483647';
            } else {
                document.body.style.overflow = '';
                navMenu.style.maxHeight = '0';
                navMenu.style.opacity = '0';
                navMenu.style.visibility = 'hidden';

                setTimeout(() => {
                    if(!navMenu.classList.contains('active')) navMenu.style.display = 'none';
                }, 300);
            }
        });


        navMenu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {

                if (typeof navIndicator !== 'undefined' && navIndicator) {
                    sessionStorage.setItem('navIndicatorLeft', navIndicator.style.left);
                    sessionStorage.setItem('navIndicatorWidth', navIndicator.style.width);
                }

                navMenu.classList.remove('active');
                navToggle.classList.remove('active');
                document.body.style.overflow = '';

                navMenu.style.maxHeight = '';
                navMenu.style.opacity = '';
                navMenu.style.visibility = '';
            });
        });


        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (link && link.href && !link.href.includes('#')) {
                if (typeof navIndicator !== 'undefined' && navIndicator) {
                    sessionStorage.setItem('navIndicatorLeft', navIndicator.style.left);
                    sessionStorage.setItem('navIndicatorWidth', navIndicator.style.width);
                }
            }
        }, { passive: true });


        document.addEventListener('click', function(e) {
            if(!navMenu.contains(e.target) && !navToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                navToggle.classList.remove('active');
                document.body.style.overflow = '';

                navMenu.style.maxHeight = '';
                navMenu.style.opacity = '';
                navMenu.style.visibility = '';
            }
        });
    } else {
    }


    const navIndicator = document.getElementById('navIndicator');

    

    function initNavbarIndicator() {
        if (!navIndicator || !navMenu) return;

        let activeLink = navMenu.querySelector('a.active');
        const prevLeft = sessionStorage.getItem('navIndicatorLeft');
        const prevWidth = sessionStorage.getItem('navIndicatorWidth');
        const isGamesAnchor = window.location.hash === '#games';
        

        navIndicator.classList.remove('animated');
        navIndicator.style.opacity = '0';


        if (isGamesAnchor && isHomePage) {
            const gamesLink = document.getElementById('gamesLink');
            if (gamesLink) {

                isManualScrolling = true;
                if (scrollTimeout) clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => { isManualScrolling = false; }, 1500);

                navLinks.forEach(l => l.classList.remove('active'));
                gamesLink.classList.add('active');
                activeLink = gamesLink; 
            }
        }

        if (activeLink) {
            if (prevLeft && prevWidth) {

                navIndicator.style.left = prevLeft;
                navIndicator.style.width = prevWidth;
                navIndicator.style.opacity = '1';
                


                setTimeout(() => {
                    if (navIndicator) {
                        navIndicator.classList.add('animated');
                        updateIndicator(true);
                    }
                }, 30);
            } else {

                const linkRect = activeLink.getBoundingClientRect();
                const menuRect = navMenu.getBoundingClientRect();
                navIndicator.style.width = `${linkRect.width}px`;
                navIndicator.style.left = `${linkRect.left - menuRect.left}px`;
                navIndicator.style.opacity = '1';
                

                setTimeout(() => {
                    if (navIndicator) navIndicator.classList.add('animated');
                }, 100);
            }
        }


        setTimeout(() => {
            sessionStorage.removeItem('navIndicatorLeft');
            sessionStorage.removeItem('navIndicatorWidth');
        }, 500);
    }

    function updateIndicator(useTransition = true) {
        if (!navIndicator || !navMenu) return;
        const activeLink = navMenu.querySelector('a.active');
        
        if (activeLink) {
            const linkRect = activeLink.getBoundingClientRect();
            const menuRect = navMenu.getBoundingClientRect();
            
            if (useTransition) navIndicator.classList.add('animated');
            else navIndicator.classList.remove('animated');
            
            navIndicator.style.width = `${linkRect.width}px`;
            navIndicator.style.left = `${linkRect.left - menuRect.left}px`;
            navIndicator.style.opacity = '1';
        } else {
            navIndicator.style.opacity = '0';
        }
    }


    let syncActive = false;
    let expansionPending = false;

    function syncWhileExpanding() {
        if (!syncActive) return;
        

        updateIndicator(false); 
        
        requestAnimationFrame(syncWhileExpanding);
    }


    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initNavbarIndicator();
            checkScroll(); 
        });
    } else {
        initNavbarIndicator();
        checkScroll();
    }

    window.addEventListener('load', () => {
        checkScroll();
        updateIndicator(true);
    });
    window.addEventListener('resize', () => updateIndicator(false));



    if (navLinks) {
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {

                if (typeof navIndicator !== 'undefined' && navIndicator) {
                    const style = window.getComputedStyle(navIndicator);
                    sessionStorage.setItem('navIndicatorLeft', style.left);
                    sessionStorage.setItem('navIndicatorWidth', style.width);
                }


                if (navbar && navbar.classList.contains('scrolled')) {
                    sessionStorage.setItem('navWasScrolled', 'true');
                } else {
                    sessionStorage.removeItem('navWasScrolled');
                }


                const href = this.getAttribute('href');
                

                if (this.id === 'logoutLink') {
                    e.preventDefault();
                    const targetUrl = this.href;


                    navLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                    updateIndicator(true);


                    setTimeout(() => {
                        if (navIndicator) {
                            const style = window.getComputedStyle(navIndicator);
                            sessionStorage.setItem('navIndicatorLeft', style.left);
                            sessionStorage.setItem('navIndicatorWidth', style.width);
                        }
                        

                        window.location.href = targetUrl;
                    }, 300); 
                    return;
                }

                if (href.includes('#')) {
                    const targetId = href.split('#')[1];
                    const targetEl = document.getElementById(targetId);
                    
                    if (targetEl && isHomePage) {
                        e.preventDefault();
                        isManualScrolling = true;
                        if (scrollTimeout) clearTimeout(scrollTimeout);

                        const offset = 120; 
                        const targetPos = targetEl.getBoundingClientRect().top + window.scrollY - offset;
                        
                        window.scrollTo({ top: targetPos, behavior: 'smooth' });
                        

                        navLinks.forEach(l => l.classList.remove('active'));
                        this.classList.add('active');
                        updateIndicator(true);


                        scrollTimeout = setTimeout(() => { isManualScrolling = false; }, 1000);


                        if (typeof navMenu !== 'undefined' && navMenu.classList.contains('active')) {
                            navMenu.classList.remove('active');
                            navToggle.classList.remove('active');
                        }
                        return;
                    }
                }


                if (this.classList.contains('active')) {
                    e.preventDefault();
                    

                    if (window.scrollY > 10) {
                        isManualScrolling = true;
                        if (scrollTimeout) clearTimeout(scrollTimeout);


                        sessionStorage.removeItem('navWasScrolled');
                        if (navbar) navbar.classList.remove('scrolled');

                        window.scrollTo({ top: 0, behavior: 'smooth' });

                        scrollTimeout = setTimeout(() => { isManualScrolling = false; }, 1000);
                    }


                    if (typeof navMenu !== 'undefined' && navMenu.classList.contains('active')) {
                        navMenu.classList.remove('active');
                        navToggle.classList.remove('active');
                    }
                    return; 
                }


                if (isHomePage && (href === 'index.php' || href === 'index.php#')) {
                    e.preventDefault();
                    isManualScrolling = true;
                    if (scrollTimeout) clearTimeout(scrollTimeout);


                    sessionStorage.removeItem('navWasScrolled');
                    if (navbar) navbar.classList.remove('scrolled');

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    

                    navLinks.forEach(l => l.classList.remove('active'));
                    const homeLink = document.getElementById('homeLink');
                    if (homeLink) homeLink.classList.add('active');
                    updateIndicator(true);

                    scrollTimeout = setTimeout(() => { isManualScrolling = false; }, 1000);


                    if (typeof navMenu !== 'undefined' && navMenu.classList.contains('active')) {
                        navMenu.classList.remove('active');
                        navToggle.classList.remove('active');
                    }
                }
            });
        });
    }


    if (isHomePage) {
        window.addEventListener('scroll', function() {
            if (isManualScrolling) return; 

            const gamesSection = document.getElementById('games');
            const homeLink = document.getElementById('homeLink');
            const gamesLink = document.getElementById('gamesLink');
            
            if (gamesSection && homeLink && gamesLink) {
                const scrollPos = window.scrollY;
                const gamesPos = gamesSection.offsetTop - 150;

                if (scrollPos >= gamesPos) {
                    if (!gamesLink.classList.contains('active')) {
                        navLinks.forEach(l => l.classList.remove('active'));
                        gamesLink.classList.add('active');
                        updateIndicator(true);
                    }
                } else {
                    if (!homeLink.classList.contains('active')) {
                        navLinks.forEach(l => l.classList.remove('active'));
                        homeLink.classList.add('active');
                        updateIndicator(true);
                    }
                }
            }
        });
    }
    
    function checkScroll() {
        if(navbar) {
            const wasScrolled = sessionStorage.getItem('navWasScrolled') === 'true';
            

            if(window.scrollY > 50 || (wasScrolled && !expansionPending && window.scrollY < 50)) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        
        if(backToTop) {
            if(window.scrollY > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        }
    }

    window.addEventListener('scroll', checkScroll);
    


    checkScroll();
    

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initNavbarIndicator);
    } else {
        initNavbarIndicator();
    }
    

    if(navbar) {
        void navbar.offsetHeight; 
        navbar.style.opacity = '1';
    }


    setTimeout(() => {
        if(navbar) {
            navbar.classList.remove('no-transition');
            void navbar.offsetHeight; 


            if (sessionStorage.getItem('navWasScrolled') === 'true' && window.scrollY < 50) {
                expansionPending = true; 
                syncActive = true;
                syncWhileExpanding();


                navbar.classList.remove('scrolled');
                sessionStorage.removeItem('navWasScrolled');


                const endHandler = function(e) {

                    if (e.propertyName === 'width' || e.propertyName === 'max-width' || e.propertyName === 'top') {
                        syncActive = false;
                        expansionPending = false;
                        

                        setTimeout(() => {
                            updateIndicator(true);
                        }, 50);
                        
                        navbar.removeEventListener('transitionend', endHandler);
                    }
                };
                navbar.addEventListener('transitionend', endHandler);


                setTimeout(() => { 
                    syncActive = false; 
                    expansionPending = false; 
                    updateIndicator(true);
                }, 700);
            }

            const logoIcon = navbar.querySelector('.logo-icon');
            if(logoIcon) logoIcon.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
        }
    }, 100);


    if(backToTop) {
        backToTop.addEventListener('click', function(e) {
            e.preventDefault();
            isManualScrolling = true;
            if (scrollTimeout) clearTimeout(scrollTimeout);


            sessionStorage.removeItem('navWasScrolled');
            if (navbar) navbar.classList.remove('scrolled');

            window.scrollTo({ top: 0, behavior: 'smooth' });
            

            if (isHomePage) {
                navLinks.forEach(l => l.classList.remove('active'));
                const homeLink = document.getElementById('homeLink');
                if (homeLink) homeLink.classList.add('active');
                updateIndicator(true);
            }


            scrollTimeout = setTimeout(() => { isManualScrolling = false; }, 1000);
        });
    }


    const productRadios = document.querySelectorAll('input[name="product_id"]');
    
    function updateSummary() {
        const checked = document.querySelector('input[name="product_id"]:checked');
        if(!checked) return;
        
        const price = parseInt(checked.dataset.price) || 0;
        const name = checked.dataset.name || '-';
        const adminFee = 1000;
        const total = price + adminFee;
        
        const elProduct = document.getElementById('summary-product');
        const elPrice = document.getElementById('summary-price');
        const elTotal = document.getElementById('summary-total');
        
        if(elProduct) elProduct.textContent = name;
        if(elPrice) elPrice.textContent = 'Rp ' + price.toLocaleString('id-ID');
        if(elTotal) elTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
    
    productRadios.forEach(function(radio) {
        radio.addEventListener('change', updateSummary);
    });


    const legalPages = ['privacy.php', 'partnership.php', 'about.php', 'career.php', 'blog.php', 'contact.php', 'faq.php', 'testimonials.php'];
    
    function isLegalPage(url) {
        return legalPages.some(page => url.includes(page));
    }


    document.addEventListener('click', function(e) {
        const link = e.target.closest('a');
        if (link && link.href) {
            const url = link.href;

            if (isLegalPage(url) && !url.includes('#')) {
                

                const saveNavState = () => {
                    if (typeof navIndicator !== 'undefined' && navIndicator) {
                        const style = window.getComputedStyle(navIndicator);
                        sessionStorage.setItem('navIndicatorLeft', style.left);
                        sessionStorage.setItem('navIndicatorWidth', style.width);
                    }
                    const navbar = document.querySelector('.navbar');
                    if (navbar && navbar.classList.contains('scrolled')) {
                        sessionStorage.setItem('navWasScrolled', 'true');
                    } else {
                        sessionStorage.removeItem('navWasScrolled');
                    }
                    sessionStorage.setItem('triggerLegalScroll', 'true');
                };


                if (isLegalPage(window.location.href) && window.scrollY > 50) {
                    e.preventDefault();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    saveNavState();
                    

                    setTimeout(() => {
                        window.location.href = url;
                    }, 600); 
                    return;
                }


                saveNavState();
            }
        }
    });


    if (sessionStorage.getItem('triggerLegalScroll') === 'true') {

        if (isLegalPage(window.location.pathname) && !window.location.hash) {
            const legalContent = document.querySelector('.legal-content');
            
            if (legalContent) {

                if ('scrollRestoration' in history) {
                    history.scrollRestoration = 'manual';
                }
                

                window.scrollTo(0, 0);


                setTimeout(() => {
                    const offset = 100; 
                    const targetPos = legalContent.getBoundingClientRect().top + window.scrollY - offset;

                    window.scrollTo({
                        top: targetPos,
                        behavior: 'smooth'
                    });
                    

                    sessionStorage.removeItem('triggerLegalScroll');
                }, 2000); 
            }
        } else {

            sessionStorage.removeItem('triggerLegalScroll');
        }
    }


    function initBouncyScroll(el, useWindow = false) {
        if (!el && !useWindow) return;
        let delta = 0;
        let bounceTimer = null;
        const target = useWindow ? window : el;
        const scrollEl = useWindow ? (document.scrollingElement || document.documentElement) : el;
        const moveEl = useWindow ? (document.getElementById('pageWrapper') || document.body) : el;

        target.addEventListener('wheel', (e) => {
            const atTop = scrollEl.scrollTop <= 0;
            const atBottom = scrollEl.scrollTop + scrollEl.clientHeight >= scrollEl.scrollHeight - 1;

            if ((atTop && e.deltaY < 0) || (atBottom && e.deltaY > 0)) {

                e.preventDefault();
                delta -= e.deltaY * 0.2;
                delta = Math.max(-60, Math.min(60, delta));

                moveEl.style.transition = 'none';
                moveEl.style.transform = `translateY(${delta}px)`;

                clearTimeout(bounceTimer);
                bounceTimer = setTimeout(() => {
                    moveEl.style.transition = 'transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    moveEl.style.transform = '';
                    delta = 0;
                }, 40);
            }
        }, { passive: false });


        let startY = 0;
        target.addEventListener('touchstart', (e) => {
            startY = e.touches[0].pageY;
        }, { passive: true });

        target.addEventListener('touchmove', (e) => {
            const currentY = e.touches[0].pageY;
            const diff = currentY - startY;
            const atTop = scrollEl.scrollTop <= 0;
            const atBottom = scrollEl.scrollTop + scrollEl.clientHeight >= scrollEl.scrollHeight - 1;

            if ((atTop && diff > 0) || (atBottom && diff < 0)) {

                delta = Math.sign(diff) * Math.pow(Math.abs(diff), 0.6); 
                moveEl.style.transition = 'none';
                moveEl.style.transform = `translateY(${delta}px)`;
            }
        }, { passive: true });

        target.addEventListener('touchend', () => {
            moveEl.style.transition = 'transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            moveEl.style.transform = '';
            delta = 0;
        });
    }



    if (window.self === window.top) {
        initBouncyScroll(null, true);
    }
})();
</script>
