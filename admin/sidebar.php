<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$current = basename($_SERVER['PHP_SELF'] ?? '');
function nav_active(string $current, string $file): string {
    return $current === $file ? ' active' : '';
}
?>

<aside class="sidebar" id="adminSidebar">
    
    <button class="mobile-menu-toggle" onclick="toggleSidebar()">
        <i data-lucide="menu"></i> Menu Admin
    </button>
    
    <div class="sidebar-header">
        <span class="logo-icon"><i data-lucide="gamepad-2"></i></span>
        <h3>Admin Panel</h3>
        <p style="margin-top: 6px; font-size: 0.85rem; color: #9ca3af;">
            <?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'admin'); ?>
        </p>
    </div>

    <nav class="sidebar-nav">
        <a href="dashboard.php" class="nav-item<?php echo nav_active($current, 'dashboard.php'); ?>"><i data-lucide="bar-chart-2"></i> Dashboard</a>
        <a href="games.php" class="nav-item<?php echo nav_active($current, 'games.php'); ?>"><i data-lucide="gamepad-2"></i> Kelola Game</a>
        <a href="products.php" class="nav-item<?php echo nav_active($current, 'products.php'); ?>"><i data-lucide="file-spreadsheet"></i> Kelola Produk</a>
        <a href="discounts.php" class="nav-item<?php echo nav_active($current, 'discounts.php'); ?>"><i data-lucide="ticket"></i> Voucher/Promo</a>
        <a href="banners.php" class="nav-item<?php echo nav_active($current, 'banners.php'); ?>"><i data-lucide="image"></i> Banner/Slider</a>
        <a href="payment-methods.php" class="nav-item<?php echo nav_active($current, 'payment-methods.php'); ?>"><i data-lucide="credit-card"></i> Metode Pembayaran</a>
        <a href="providers.php" class="nav-item<?php echo nav_active($current, 'providers.php'); ?>"><i data-lucide="plug"></i> API Provider</a>
        <a href="posts.php" class="nav-item<?php echo nav_active($current, 'posts.php'); ?>"><i data-lucide="file-edit"></i> Post/Blog</a>
        <a href="testimonials.php" class="nav-item<?php echo nav_active($current, 'testimonials.php'); ?>"><i data-lucide="message-circle"></i> Testimoni</a>
        <a href="contacts.php" class="nav-item<?php echo nav_active($current, 'contacts.php'); ?>"><i data-lucide="inbox"></i> Pesan Masuk</a>
        <a href="reports.php" class="nav-item<?php echo nav_active($current, 'reports.php'); ?>"><i data-lucide="trending-up"></i> Laporan</a>
        <a href="users.php" class="nav-item<?php echo nav_active($current, 'users.php'); ?>"><i data-lucide="users"></i> Users</a>
        <a href="deposits.php" class="nav-item<?php echo nav_active($current, 'deposits.php'); ?>"><i data-lucide="wallet"></i> Kelola Saldo</a>
        <a href="logs.php" class="nav-item<?php echo nav_active($current, 'logs.php'); ?>"><i data-lucide="file-text"></i> Log Sistem</a>
        <a href="settings.php" class="nav-item<?php echo nav_active($current, 'settings.php'); ?>"><i data-lucide="settings"></i> Pengaturan</a>
        <a href="logout.php" class="nav-item"><i data-lucide="log-out"></i> Logout</a>
    </nav>
</aside>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const sidebar = document.getElementById('adminSidebar');
    if (sidebar) {

        const savedPos = sessionStorage.getItem('adminSidebarScroll');
        if (savedPos) {
            sidebar.scrollTop = parseInt(savedPos);
        }


        const navItems = sidebar.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {

                if (this.classList.contains('active')) {
                    const mainContent = document.querySelector('.main-content');
                    if (mainContent) {
                        e.preventDefault();
                        mainContent.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                    return;
                }
                sessionStorage.setItem('adminSidebarScroll', sidebar.scrollTop);
            });
        });
    }


    function initBouncyScroll(el) {
        if (!el || el.dataset.bounceInit === "true") return;
        
        const style = window.getComputedStyle(el);
        const isScrollable = (style.overflowY === 'auto' || style.overflowY === 'scroll') && (el.scrollHeight > el.clientHeight);
        
        if (!isScrollable) return;
        el.dataset.bounceInit = "true";
        
        let delta = 0;
        let bounceTimer = null;
        el.style.willChange = 'transform';

        el.addEventListener('wheel', (e) => {
            const atTop = el.scrollTop <= 10;
            const atBottom = el.scrollHeight - el.scrollTop <= el.clientHeight + 15;

            if ((atTop && e.deltaY < 0) || (atBottom && e.deltaY > 0)) {

                e.preventDefault();
                e.stopPropagation();
                
                delta -= e.deltaY * 0.4;
                delta = Math.max(-120, Math.min(120, delta));

                el.style.transition = 'none';
                el.style.transform = `translate3d(0, ${delta}px, 0)`;

                clearTimeout(bounceTimer);
                bounceTimer = setTimeout(() => {
                    el.style.transition = 'transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    el.style.transform = '';
                    delta = 0;
                }, 40);
            }
        }, { passive: false });


        let startY = 0;
        el.addEventListener('touchstart', (e) => {
            if (e.touches.length > 0) startY = e.touches[0].pageY;
        }, { passive: true });

        el.addEventListener('touchmove', (e) => {
            if (e.touches.length === 0) return;
            const currentY = e.touches[0].pageY;
            const diff = currentY - startY;
            const atTop = el.scrollTop <= 10;
            const atBottom = el.scrollHeight - el.scrollTop <= el.clientHeight + 15;

            if ((atTop && diff > 0) || (atBottom && diff < 0)) {
                delta = Math.sign(diff) * Math.pow(Math.abs(diff), 0.7) * 2;
                el.style.transition = 'none';
                el.style.transform = `translate3d(0, ${delta}px, 0)`;
            }
        }, { passive: true });

        el.addEventListener('touchend', () => {
            el.style.transition = 'transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            el.style.transform = '';
            delta = 0;
        });
    }

    function applyAdminBounces() {

        const contentSelectors = ['.main-content', 'main'];
        contentSelectors.forEach(sel => {
            document.querySelectorAll(sel).forEach(el => initBouncyScroll(el));
        });
    }

    applyAdminBounces();
    [200, 600, 1200, 2000].forEach(delay => setTimeout(applyAdminBounces, delay));


    window.toggleSidebar = function() {
        if (sidebar) {
            const isOpen = sidebar.classList.toggle('open');
            

            if (isOpen) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        } else {
            console.error('Sidebar element not found');
        }
    };
});
</script>