<nav class="navbar">
    <div class="container nav-inner">

        <!-- LOGO -->
        <a href="/" class="nav-brand">
            <img src="{{ asset('Kitabutuhpeta.png') }}" style="height:50px;">
        </a>

        <!-- MENU -->
        <div class="nav-links" id="navLinks">
            <a href="{{ url('/contact') }}">Dashboard</a>
            <a href="{{ url('/about') }}">Tentang</a>
            <a href="{{ route('admin.logout') }}">Logout</a>
        </div>

        <!-- BUTTON ☰ -->
        <div class="nav-actions">
            <button id="menuBtn" aria-label="Menu">☰</button>
        </div>

    </div>
</nav>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("menuBtn");
    const nav = document.getElementById("navLinks");

    btn.addEventListener("click", function () {
        nav.classList.toggle("show");

        // optional: ganti icon ☰ jadi ✕
        btn.textContent = nav.classList.contains("show") ? "✕" : "☰";
    });

    // klik luar nutup menu
    document.addEventListener("click", function(e){
        if (!btn.contains(e.target) && !nav.contains(e.target)) {
            nav.classList.remove("show");
            btn.textContent = "☰";
        }
    });
});
</script>