<nav class="navbar">
    <div class="container nav-inner">

        <a href="/" class="nav-brand">
            <img src="{{ asset('Kitabutuhpeta.png') }}" style="height:36px;">
            <span class="brand-name">KitabUtuhPeta</span>
        </a>

        <div class="nav-links">
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ url('/about') }}">Tentang</a>
            <a href="{{ url('/contact') }}">Hubungi Kami</a>
        </div>

        <div class="nav-actions">
            <button id="menuBtn" aria-label="Open menu">☰</button>
        </div>

    </div>

    <!-- MOBILE DRAWER -->
    <div id="mobileMenu">
        <div id="menuBackdrop"></div>
        <div id="mobileMenuPanel">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px">
                <div style="display:flex;align-items:center;gap:8px">
                    <img src="{{ asset('Kitabutuhpeta.png') }}" style="height:28px;">
                    <span style="color:var(--text-gray-800);font-weight:600">KitabUtuhPeta</span>
                </div>
                <button id="menuClose" aria-label="Close menu" style="border:0;background:none;cursor:pointer">✕</button>
            </div>

            <nav style="display:flex;flex-direction:column;gap:8px">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/about') }}">Tentang</a>
                <a href="{{ url('/contact') }}">Hubungi Kami</a>
            </nav>

            <div style="margin-top:16px;border-top:1px solid #eee;padding-top:12px">
                <a href="{{ url('/profile') }}">Profil</a>
            </div>
        </div>
    </div>

</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("menuBtn");
    const closeBtn = document.getElementById("menuClose");
    const mobileMenu = document.getElementById("mobileMenu");
    const backdrop = document.getElementById("menuBackdrop");

    function openMenu() {
        mobileMenu.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        mobileMenu.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (btn) btn.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (backdrop) backdrop.addEventListener('click', closeMenu);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenu();
    });

});
</script>