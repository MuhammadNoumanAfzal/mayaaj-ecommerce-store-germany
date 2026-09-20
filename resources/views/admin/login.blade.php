<!DOCTYPE html>
<html lang="de" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEHAAJ Admin Portal Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html.light body {
            background-color: #f7f4ee;
            color: #1c1210;
        }
        html.light .login-card {
            background-color: #ffffff;
            border-color: #e6decb;
            color: #1c1210;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        }
        html.light .login-input {
            background-color: #faf7f2;
            border-color: #e6decb;
            color: #1c1210;
        }
        html.light .login-input:focus {
            border-color: #78000b;
            background-color: #ffffff;
        }

        html.dark body {
            background-color: #140b0a;
            color: #fbf9f5;
        }
        html.dark .login-card {
            background-color: #1c1210;
            border-color: rgba(216, 180, 90, 0.35);
            color: #fbf9f5;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
        }
        html.dark .login-input {
            background-color: #140a08;
            border-color: rgba(216, 180, 90, 0.25);
            color: #ffffff;
        }
        html.dark .login-input:focus {
            border-color: #d8b45a;
            background-color: #18100f;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden font-sans transition-colors duration-300">

    <!-- Ambient Glowing Background Orbs -->
    <div class="pointer-events-none absolute -top-40 -left-40 h-80 w-80 rounded-full bg-[#78000b]/20 blur-[120px] animate-pulse"></div>
    <div class="pointer-events-none absolute -bottom-40 -right-40 h-80 w-80 rounded-full bg-[#d8b45a]/15 blur-[120px] animate-pulse"></div>

    <div class="w-full max-w-sm relative z-10">
        
        <!-- Controls Bar: Theme Switcher & Language Selector -->
        <div class="mb-4 flex items-center justify-between text-xs px-1">
            <!-- Theme Toggle -->
            <div class="flex items-center rounded-full border border-[#d8b45a]/35 bg-[#d8b45a]/10 p-0.5">
                <button type="button" onclick="setAdminTheme('light')" data-admin-theme-option="light" class="cursor-pointer rounded-full px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider transition flex items-center gap-1">
                    <span>☀️</span>
                    <span data-i18n-de="Hell" data-i18n-en="Light">Hell</span>
                </button>
                <button type="button" onclick="setAdminTheme('dark')" data-admin-theme-option="dark" class="cursor-pointer rounded-full px-3 py-1 text-[0.6rem] font-bold uppercase tracking-wider transition flex items-center gap-1">
                    <span>🌙</span>
                    <span data-i18n-de="Dunkel" data-i18n-en="Dark">Dunkel</span>
                </button>
            </div>

            <!-- Language Toggle -->
            <div class="flex items-center rounded-full border border-[#d8b45a]/35 bg-[#d8b45a]/10 p-0.5">
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.6rem] font-bold uppercase tracking-[0.12em] transition" type="button" data-language-option="de">DE</button>
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.6rem] font-bold uppercase tracking-[0.12em] transition" type="button" data-language-option="en">EN</button>
            </div>
        </div>

        <!-- Sleek, Compact Luxury Login Card -->
        <div class="login-card rounded-xl border p-6 sm:p-7 transition-colors duration-300">
            
            <!-- Header & Branding -->
            <div class="text-center space-y-2 mb-6">
                <a href="/" class="inline-block">
                    <img src="/logo.png" alt="MEHAAJ" class="h-10 w-auto mx-auto object-contain">
                </a>
                <div class="inline-flex items-center gap-1.5 rounded-full border border-[#d8b45a]/30 bg-[#d8b45a]/10 px-3 py-0.5 text-[0.58rem] font-bold uppercase tracking-[0.18em] text-[#78000b] dark:text-[#d8b45a]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#78000b] dark:bg-[#d8b45a] animate-ping"></span>
                    <span>VIP ADMIN PORTAL</span>
                </div>
                <h1 class="font-display text-xl font-medium pt-1 text-[#1c1210] dark:text-white" data-i18n-de="Admin Anmeldung" data-i18n-en="Admin Portal Sign In">Admin Anmeldung</h1>
            </div>

            <!-- Inline Error Messages (Also reinforced by SweetAlert2) -->
            @if($errors->any())
                <div class="mb-4 rounded-lg border border-[#78000b]/40 bg-[#78000b]/10 p-3 text-xs text-[#78000b] dark:text-[#ff6b76] space-y-1">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-1.5"><span>⚠️</span> {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#78000b] dark:text-[#d8b45a] mb-1" data-i18n-de="E-Mail-Adresse" data-i18n-en="Email Address">E-Mail-Adresse</label>
                    <div class="relative">
                        <input
                            type="email"
                            name="email"
                            id="admin-email"
                            value="{{ old('email', 'admin@mehaaj.de') }}"
                            required
                            placeholder="admin@mehaaj.de"
                            class="login-input w-full h-10 rounded-lg border px-3 text-xs outline-none transition-colors"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-[0.68rem] font-bold uppercase tracking-wider text-[#78000b] dark:text-[#d8b45a] mb-1" data-i18n-de="Passwort" data-i18n-en="Password">Passwort</label>
                    <div class="relative">
                        <input
                            type="password"
                            name="password"
                            id="admin-password"
                            value="password123"
                            required
                            placeholder="••••••••"
                            class="login-input w-full h-10 rounded-lg border px-3 text-xs outline-none transition-colors"
                        >
                    </div>
                </div>

                <!-- Auto-fill Demo Box -->
                <div class="rounded-lg border border-[#d8b45a]/40 bg-[#d8b45a]/10 p-2.5 text-xs flex items-center justify-between">
                    <div>
                        <p class="font-bold text-[#78000b] dark:text-[#ffd45a] text-[0.7rem]" data-i18n-de="Demo Zugangsdaten" data-i18n-en="Demo Credentials">Demo Zugangsdaten</p>
                        <p class="text-[0.62rem] opacity-80">admin@mehaaj.de / password123</p>
                    </div>
                    <button type="button" onclick="autoFillAdmin()" class="rounded-md bg-[#78000b] text-white px-2.5 py-1 text-[0.6rem] font-bold uppercase tracking-wider hover:bg-[#5a0309] transition cursor-pointer shadow-sm" data-i18n-de="Einfügen" data-i18n-en="Auto-fill">
                        Einfügen
                    </button>
                </div>

                <button
                    type="submit"
                    class="w-full h-11 rounded-lg bg-[#78000b] text-xs font-bold uppercase tracking-[0.18em] text-white shadow-md transition-all duration-300 hover:bg-[#5a0309] hover:shadow-[0_6px_20px_rgba(120,0,11,0.4)] active:scale-95 cursor-pointer mt-1"
                >
                    <span data-i18n-de="ANMELDEN & DASHBOARD ÖFFNEN ➔" data-i18n-en="LOG IN & OPEN DASHBOARD ➔">ANMELDEN & DASHBOARD ÖFFNEN ➔</span>
                </button>
            </form>

            <div class="mt-5 text-center border-t border-[#d8b45a]/20 pt-3">
                <a href="/" class="text-[0.72rem] opacity-75 hover:text-[#78000b] dark:hover:text-[#d8b45a] transition font-medium" data-i18n-de="← Zurück zum E-Commerce Shop" data-i18n-en="← Return to E-Commerce Store">← Zurück zum E-Commerce Shop</a>
            </div>

        </div>

    </div>

    <!-- SweetAlert2 CDN Integration -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const LuxurySwal = Swal.mixin({
            background: '#faf7f2',
            color: '#1c1210',
            confirmButtonColor: '#78000b',
            cancelButtonColor: '#685c54',
            customClass: {
                popup: 'border border-[#d8b45a]/50 shadow-2xl rounded-lg font-sans',
                title: 'font-display text-xl text-[#1c1210]',
                confirmButton: 'px-5 py-2.5 rounded-md text-xs font-bold uppercase tracking-wider cursor-pointer'
            }
        });

        const LuxuryToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#78000b',
            color: '#ffffff',
            customClass: {
                popup: 'rounded-lg shadow-xl text-xs font-sans'
            }
        });

        window.setAdminTheme = (mode) => {
            const selectedTheme = mode === 'light' ? 'light' : 'dark';
            const html = document.documentElement;
            if (selectedTheme === 'light') {
                html.classList.remove('dark');
                html.classList.add('light');
            } else {
                html.classList.remove('light');
                html.classList.add('dark');
            }
            localStorage.setItem('mehaaj-admin-theme', selectedTheme);

            document.querySelectorAll('[data-admin-theme-option]').forEach(btn => {
                const isActive = btn.dataset.adminThemeOption === selectedTheme;
                btn.classList.toggle('bg-[#78000b]', isActive);
                btn.classList.toggle('text-white', isActive);
                btn.classList.toggle('opacity-60', !isActive);
            });
        };

        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('mehaaj-admin-theme') || 'light';
            window.setAdminTheme(savedTheme);

            @if($errors->any())
                LuxurySwal.fire({
                    icon: 'error',
                    title: 'Anmeldefehler',
                    text: "{{ $errors->first() }}"
                });
            @endif

            @if(session('info'))
                LuxuryToast.fire({
                    icon: 'info',
                    title: "{{ session('info') }}"
                });
            @endif

            @if(session('success'))
                LuxuryToast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif
        });

        function autoFillAdmin() {
            document.getElementById('admin-email').value = 'admin@mehaaj.de';
            document.getElementById('admin-password').value = 'password123';
            
            LuxuryToast.fire({
                icon: 'success',
                title: 'Demo-Zugangsdaten eingefügt!'
            });
        }
    </script>
</body>
</html>
