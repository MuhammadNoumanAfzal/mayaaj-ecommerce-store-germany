<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="MEHAAJ - Premium German e-commerce store.">

        <title>@yield('title', 'MEHAAJ - Premium E-Commerce')</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600|inter:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-navbar />

        <main>
            @yield('content')
        </main>

        <x-footer />
        <x-cart-drawer />

        <!-- SweetAlert2 Library & Luxury Theme Mixins -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Global SweetAlert2 Luxury Theme Mixins
            const LuxurySwal = Swal.mixin({
                background: '#faf7f2',
                color: '#1c1210',
                confirmButtonColor: '#78000b',
                cancelButtonColor: '#685c54',
                customClass: {
                    popup: 'border border-[#d8b45a]/40 shadow-2xl rounded-md font-sans',
                    title: 'font-display text-2xl text-[#1c1210]',
                    confirmButton: 'px-5 py-2.5 rounded text-xs font-bold uppercase tracking-wider shadow-md hover:bg-[#5a0309] cursor-pointer',
                    cancelButton: 'px-5 py-2.5 rounded text-xs font-bold uppercase tracking-wider cursor-pointer'
                }
            });

            const LuxuryToast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#1c1210',
                color: '#fffaf0',
                customClass: {
                    popup: 'border border-[#d8b45a]/50 rounded shadow-xl text-xs font-sans'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            // Global Action Handlers (Bilingual DE / EN)
            function openAccountModal() {
                const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
                LuxurySwal.fire({
                    title: isEn ? 'MEHAAJ VIP Portal 👑' : 'MEHAAJ VIP Portal 👑',
                    html: `
                        <div class="text-left space-y-3 mt-2 text-xs">
                            <p class="text-neutral-600">${isEn ? 'Log in to your exclusive customer account:' : 'Melden Sie sich mit Ihrem exklusiven Kundenkonto an:'}</p>
                            <input id="swal-input-email" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'Email Address' : 'E-Mail-Adresse'}" type="email">
                            <input id="swal-input-pass" class="w-full h-10 px-3 border border-[#e6decb] bg-white rounded outline-none focus:border-[#78000b]" placeholder="${isEn ? 'Password' : 'Passwort'}" type="password">
                        </div>
                    `,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: isEn ? 'Log In' : 'Anmelden',
                    cancelButtonText: isEn ? 'Close' : 'Schließen',
                    preConfirm: () => {
                        const email = document.getElementById('swal-input-email').value;
                        if (!email) {
                            Swal.showValidationMessage(isEn ? 'Please enter your email address' : 'Bitte geben Sie Ihre E-Mail ein');
                        }
                        return { email: email };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        LuxuryToast.fire({
                            icon: 'success',
                            title: isEn ? 'Successfully logged in as ' + result.value.email : 'Erfolgreich angemeldet als ' + result.value.email
                        });
                    }
                });
            }

            function openWishlistModal() {
                const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
                LuxurySwal.fire({
                    icon: 'info',
                    title: isEn ? 'Your Wishlist ❤️' : 'Ihre Wunschliste ❤️',
                    text: isEn 
                        ? 'You have 2 exclusive items saved in your wishlist (Maison Leather Tote & Executive Belt).' 
                        : 'Sie haben 2 exklusive Artikel in Ihrer Wunschliste gespeichert (Maison Leather Tote & Executive Belt).',
                    confirmButtonText: isEn ? 'View Wishlist' : 'Wunschliste Anzeigen',
                    showCancelButton: true,
                    cancelButtonText: isEn ? 'Continue Shopping' : 'Weiter shoppen'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/shop';
                    }
                });
            }

            function handleSearchSubmit(e, inputId) {
                if (e) e.preventDefault();
                const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
                const query = document.getElementById(inputId) ? document.getElementById(inputId).value : '';
                if (!query.trim()) {
                    LuxuryToast.fire({
                        icon: 'warning',
                        title: isEn ? 'Please enter a search query.' : 'Bitte geben Sie einen Suchbegriff ein.'
                    });
                    return;
                }
                LuxurySwal.fire({
                    icon: 'search',
                    title: isEn ? 'Search results for "' + query + '"' : 'Suchergebnisse für "' + query + '"',
                    text: isEn ? 'Searching our luxury collections for ' + query + '...' : 'Wir durchsuchen unsere Luxus-Kollektionen nach ' + query + '...',
                    timer: 1800,
                    showConfirmButton: false,
                    timerProgressBar: true
                }).then(() => {
                    window.location.href = '/shop';
                });
            }

            function quickAddToCart(title, price) {
                const isEn = (window.getCurrentLang ? window.getCurrentLang() : 'de') === 'en';
                LuxuryToast.fire({
                    icon: 'success',
                    title: isEn 
                        ? title + ' (' + price + ') added to cart! 🛍️' 
                        : title + ' (' + price + ') in den Warenkorb gelegt! 🛍️'
                });
                if (typeof openCartDrawer === 'function') {
                    openCartDrawer();
                }
            }
        </script>
    </body>
</html>

