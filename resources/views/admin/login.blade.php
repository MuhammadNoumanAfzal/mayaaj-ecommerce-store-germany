<!DOCTYPE html>
<html lang="en" class="h-full overflow-hidden bg-saltora-bg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Sign In — MEHAAJ Atelier</title>
    <link rel="icon" type="image/png" href="/logo.png">
    
    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome & SweetAlert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full w-full overflow-hidden flex items-center justify-center p-4 font-sans antialiased text-stone-800 bg-[#F8F5EF] relative select-none">
    
    <!-- Clean, Warm Ambient Background with Mineral Glow Accents -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <!-- Soft multi-stop warm radial glow -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_#F4E8E5_0%,_#F8F5EF_55%,_#EFE9DF_100%)]"></div>
        
        <!-- Subtle mineral glow accents (Saltora Terracotta & Amber) -->
        <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[650px] h-[350px] bg-[#964B42]/8 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 right-10 w-[400px] h-[400px] bg-amber-500/8 rounded-full blur-3xl"></div>
    </div>

    <!-- Login Container -->
    <div class="w-full max-w-[430px] relative z-10 flex flex-col items-center">
        
        <!-- Top Language Selector Pill (Default: English) -->
        <div class="mb-3 flex items-center justify-end w-full px-1">
            <div class="flex items-center rounded-full bg-white/80 backdrop-blur-md p-1 border border-stone-200 shadow-2xs" aria-label="Language selector">
                <button type="button" onclick="setLoginLanguage('en')" data-login-lang="en" class="cursor-pointer rounded-full px-3 py-1 text-[0.65rem] font-black uppercase tracking-wider transition bg-stone-900 text-white shadow-2xs">EN</button>
                <button type="button" onclick="setLoginLanguage('de')" data-login-lang="de" class="cursor-pointer rounded-full px-3 py-1 text-[0.65rem] font-bold uppercase tracking-wider transition text-stone-600 hover:text-stone-900">DE</button>
            </div>
        </div>

        <!-- Brand Logo Header -->
        <div class="mb-5 text-center">
            <a href="/" class="inline-flex items-center gap-3 group cursor-pointer" title="Return to MEHAAJ Public Site">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-saltora-terracotta to-amber-600 p-0.5 shadow-md shadow-saltora-terracotta/20 group-hover:scale-105 transition-transform duration-300">
                    <div class="w-full h-full bg-white rounded-[10px] flex items-center justify-center p-1.5">
                        <img src="/logo.png" alt="MEHAAJ Logo" class="w-full h-full object-contain">
                    </div>
                </div>
                <div class="text-left">
                    <span class="block font-serif text-2xl font-bold tracking-wider text-stone-900 leading-none">MEHAAJ</span>
                    <span class="block text-[10px] tracking-[0.22em] text-saltora-terracotta uppercase font-bold mt-1" data-i18n-en="Store Admin Panel" data-i18n-de="Store Admin Panel">Store Admin Panel</span>
                </div>
            </a>
        </div>

        <!-- Clean Luxury White Card -->
        <div class="w-full bg-white/95 backdrop-blur-md border border-stone-200/90 rounded-2xl p-6 sm:p-7 shadow-xl shadow-stone-900/5 relative overflow-hidden">
            
            <div class="mb-5 text-center">
                <h1 class="text-xl font-serif font-bold text-stone-900 tracking-tight" data-i18n-en="Sign in to your account" data-i18n-de="Bei Ihrem Konto anmelden">Sign in to your account</h1>
                <p class="text-xs text-stone-500 mt-1" data-i18n-en="Enter your admin email and password to continue." data-i18n-de="Geben Sie Ihre Admin-E-Mail und Ihr Passwort ein.">Enter your admin email and password to continue.</p>
            </div>

            <!-- Form -->
            <form id="adminLoginForm" action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-stone-700 mb-1.5 uppercase tracking-wider" data-i18n-en="Email Address" data-i18n-de="E-Mail-Adresse">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <input type="email" id="email" name="email" value="admin@mehaaj.de" required autocomplete="username" autofocus placeholder="admin@mehaaj.de" 
                            class="w-full bg-stone-50/80 border border-stone-300 rounded-xl pl-9 pr-3.5 py-2.5 text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 transition-all">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-semibold text-stone-700 uppercase tracking-wider" data-i18n-en="Password" data-i18n-de="Passwort">Password</label>
                        <button type="button" onclick="togglePasswordVisibility()" class="text-[11px] text-saltora-terracotta hover:underline font-medium focus:outline-none flex items-center gap-1 cursor-pointer">
                            <i id="eyeIcon" class="fa-solid fa-eye text-[10px]"></i>
                            <span id="eyeText" data-i18n-en="Show" data-i18n-de="Anzeigen">Show</span>
                        </button>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input type="password" id="password" name="password" value="password123" required autocomplete="current-password" placeholder="••••••••" 
                            class="w-full bg-stone-50/80 border border-stone-300 rounded-xl pl-9 pr-3.5 py-2.5 text-xs sm:text-sm text-stone-900 placeholder-stone-400 focus:outline-none focus:bg-white focus:border-saltora-terracotta focus:ring-2 focus:ring-saltora-terracotta/20 transition-all tracking-wider">
                    </div>
                </div>

                <!-- Multi-Role Credentials Selector -->
                <div class="rounded-xl border border-saltora-terracotta/20 bg-saltora-blush-light/60 p-2.5 text-xs shadow-2xs space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-saltora-terracotta text-[0.68rem] uppercase tracking-wider flex items-center gap-1.5">
                            <i class="fa-solid fa-users-gear text-[11px]"></i>
                            <span data-i18n-en="Role Presets" data-i18n-de="Rollen-Vorauswahl">Role Presets</span>
                        </span>
                        <span class="text-[0.6rem] text-stone-500 font-mono">pw: password123</span>
                    </div>

                    <div class="grid grid-cols-2 gap-1.5">
                        <button type="button" onclick="autoFillRole('admin@mehaaj.de', 'Super Admin')" class="text-left px-2 py-1.5 rounded-lg bg-white border border-purple-200/80 hover:border-purple-400 hover:bg-purple-50/50 transition cursor-pointer flex flex-col shadow-2xs">
                            <span class="font-bold text-[0.66rem] text-purple-900 flex items-center justify-between">
                                <span>Super Admin</span>
                                <i class="fa-solid fa-crown text-[8px] text-amber-500"></i>
                            </span>
                            <span class="text-[0.56rem] text-stone-500 truncate">admin@mehaaj.de</span>
                        </button>

                        <button type="button" onclick="autoFillRole('manager@mehaaj.de', 'Store Admin')" class="text-left px-2 py-1.5 rounded-lg bg-white border border-rose-200/80 hover:border-rose-400 hover:bg-rose-50/50 transition cursor-pointer flex flex-col shadow-2xs">
                            <span class="font-bold text-[0.66rem] text-rose-900 flex items-center justify-between">
                                <span>Store Admin</span>
                                <i class="fa-solid fa-store text-[8px] text-rose-500"></i>
                            </span>
                            <span class="text-[0.56rem] text-stone-500 truncate">manager@mehaaj.de</span>
                        </button>

                        <button type="button" onclick="autoFillRole('moderator@mehaaj.de', 'Moderator')" class="text-left px-2 py-1.5 rounded-lg bg-white border border-blue-200/80 hover:border-blue-400 hover:bg-blue-50/50 transition cursor-pointer flex flex-col shadow-2xs">
                            <span class="font-bold text-[0.66rem] text-blue-900 flex items-center justify-between">
                                <span>Moderator</span>
                                <i class="fa-solid fa-shield-halved text-[8px] text-blue-500"></i>
                            </span>
                            <span class="text-[0.56rem] text-stone-500 truncate">moderator@mehaaj.de</span>
                        </button>

                        <button type="button" onclick="autoFillRole('inventory@mehaaj.de', 'Inventory Staff')" class="text-left px-2 py-1.5 rounded-lg bg-white border border-amber-200/80 hover:border-amber-400 hover:bg-amber-50/50 transition cursor-pointer flex flex-col shadow-2xs">
                            <span class="font-bold text-[0.66rem] text-amber-900 flex items-center justify-between">
                                <span>Inventory</span>
                                <i class="fa-solid fa-boxes-stacked text-[8px] text-amber-600"></i>
                            </span>
                            <span class="text-[0.56rem] text-stone-500 truncate">inventory@mehaaj.de</span>
                        </button>
                    </div>
                </div>

                <!-- Remember & Public Site Link -->
                <div class="flex items-center justify-between text-xs text-stone-500 pt-0.5">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-saltora-terracotta focus:ring-saltora-terracotta/30 accent-saltora-terracotta cursor-pointer">
                        <span class="text-xs text-stone-600" data-i18n-en="Remember me" data-i18n-de="Angemeldet bleiben">Remember me</span>
                    </label>
                    <a href="/" class="text-saltora-terracotta hover:underline font-medium flex items-center gap-1">
                        <i class="fa-solid fa-arrow-left text-[10px]"></i>
                        <span data-i18n-en="Back to website" data-i18n-de="Zurück zur Website">Back to website</span>
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="loginBtn" class="w-full py-3 px-4 bg-stone-900 hover:bg-black active:scale-[0.99] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all flex items-center justify-center gap-2 cursor-pointer mt-1">
                    <i class="fa-solid fa-right-to-bracket text-xs text-amber-300"></i>
                    <span id="btnText" data-i18n-en="Sign In" data-i18n-de="Anmelden">Sign In</span>
                </button>
            </form>
        </div>

        <!-- Subtle Security Note -->
        <div class="mt-3.5 text-center text-[11px] text-stone-400 flex items-center justify-center gap-1.5">
            <i class="fa-solid fa-shield-halved text-stone-400 text-[10px]"></i>
            <span data-i18n-en="Secure admin access • MEHAAJ Atelier" data-i18n-de="Sicherer Admin-Zugang • MEHAAJ Atelier">Secure admin access • MEHAAJ Atelier</span>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        const LuxuryToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#1c1917',
            iconColor: '#964B42'
        });

        // Language state management (English as default)
        let currentLang = localStorage.getItem('mehaaj_admin_lang') || 'en';

        function setLoginLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('mehaaj_admin_lang', lang);
            document.cookie = `mehaaj_admin_lang=${lang};path=/;max-age=31536000`;
            document.cookie = `locale=${lang};path=/;max-age=31536000`;
            document.documentElement.lang = lang;

            // Update UI toggle buttons
            document.querySelectorAll('[data-login-lang]').forEach(btn => {
                const optLang = btn.getAttribute('data-login-lang');
                if (optLang === lang) {
                    btn.className = 'cursor-pointer rounded-full px-3 py-1 text-[0.65rem] font-black uppercase tracking-wider transition bg-stone-900 text-white shadow-2xs';
                } else {
                    btn.className = 'cursor-pointer rounded-full px-3 py-1 text-[0.65rem] font-bold uppercase tracking-wider transition text-stone-600 hover:text-stone-900';
                }
            });

            // Translate DOM elements
            document.querySelectorAll('[data-i18n-' + lang + ']').forEach(el => {
                const text = el.getAttribute('data-i18n-' + lang);
                if (text) {
                    el.textContent = text;
                }
            });

            // Update eye text
            const passwordInput = document.getElementById('password');
            const eyeText = document.getElementById('eyeText');
            if (eyeText) {
                if (passwordInput.type === 'password') {
                    eyeText.textContent = lang === 'de' ? 'Anzeigen' : 'Show';
                } else {
                    eyeText.textContent = lang === 'de' ? 'Ausblenden' : 'Hide';
                }
            }

            // Sync with backend asynchronously
            try {
                fetch(`/admin/lang/${lang}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).catch(() => {});
            } catch(e){}
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeText = document.getElementById('eyeText');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeText.textContent = currentLang === 'de' ? 'Ausblenden' : 'Hide';
            } else {
                passwordInput.type === 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeText.textContent = currentLang === 'de' ? 'Anzeigen' : 'Show';
            }
        }

        function autoFillRole(email, roleTitle) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = 'password123';

            LuxuryToast.fire({
                icon: 'success',
                title: `${roleTitle}: ${email}`
            });
        }

        function autoFillCredentials() {
            autoFillRole('admin@mehaaj.de', 'Super Admin');
        }

        // Form Submit with SweetAlert2 & Animated Feedback
        document.getElementById('adminLoginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('loginBtn');
            const originalHtml = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = `<i class="fa-solid fa-circle-notch fa-spin text-amber-300"></i> <span>${currentLang === 'de' ? 'Anmeldung läuft...' : 'Signing in...'}</span>`;

            const formData = new FormData(this);

            try {
                const response = await fetch('{{ route("admin.login.submit") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: currentLang === 'de' ? 'Willkommen zurück' : 'Welcome back',
                        text: data.message || (currentLang === 'de' ? 'Erfolgreich angemeldet. Weiterleitung...' : 'Signed in successfully. Redirecting...'),
                        timer: 1300,
                        showConfirmButton: false,
                        background: '#ffffff',
                        color: '#1c1917',
                        iconColor: '#964B42'
                    }).then(() => {
                        window.location.href = data.redirect || '/admin/dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: currentLang === 'de' ? 'Anmeldung fehlgeschlagen' : 'Sign in failed',
                        text: data.message || (currentLang === 'de' ? 'Falsche E-Mail oder Passwort. Bitte erneut versuchen.' : 'Incorrect email or password. Please try again.'),
                        background: '#ffffff',
                        color: '#1c1917',
                        confirmButtonColor: '#964B42'
                    });
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            } catch (error) {
                // If JSON fetch isn't supported or network issue, fallback to native submit
                this.submit();
            }
        });

        // Initialize language
        document.addEventListener('DOMContentLoaded', () => {
            setLoginLanguage(currentLang);
        });
    </script>
</body>
</html>
