<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#F8F5EF] text-stone-800 {{ (request()->cookie('mehaaj_admin_theme') === 'dark') ? 'dark' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MEHAAJ Admin Control Center')</title>
    <link rel="icon" type="image/png" href="/logo.png">

    <!-- Fonts: Cormorant Garamond, Playfair Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Playfair+Display:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Icons, Chart.js, SweetAlert2 & Quill Rich Text Editor -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @media print {
            aside, header, footer, .no-print, button:not(.print-keep), a.btn-exec-primary, a.btn-exec-secondary, .swal2-container {
                display: none !important;
            }
            body, html {
                background: #ffffff !important;
                color: #000000 !important;
                font-size: 11pt !important;
            }
            .lg\:ml-64 {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            main {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
            }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Modal Scroll Clean & Background Blur Utilities */
        .modal-scroll-clean {
            overflow-y: auto !important;
            overflow-x: hidden !important;
            scrollbar-width: none !important; /* Firefox */
            -ms-overflow-style: none !important; /* IE/Edge */
        }
        .modal-scroll-clean::-webkit-scrollbar {
            display: none !important; /* Chrome/Safari/Brave */
            width: 0 !important;
            height: 0 !important;
        }

        .modal-backdrop-luxury {
            background-color: rgba(15, 12, 11, 0.72) !important;
            backdrop-filter: blur(14px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(14px) saturate(180%) !important;
        }
    </style>
    @yield('admin-styles')

    <!-- Early Language & Dark Theme Hydration Script (Zero-Flash) -->
    <script>
        (function() {
            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                return null;
            }
            const savedLang = localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'en';
            window.__mehaaj_lang = savedLang;
            document.documentElement.lang = savedLang;

            // Early Dark/Light Theme Hydration (Immediate class toggle to prevent white flash)
            const savedTheme = localStorage.getItem('mehaaj_admin_theme') || getCookie('mehaaj_admin_theme') || 'light';
            window.__mehaaj_theme = savedTheme;
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- SweetAlert2 Pink-Salt Theme Configuration -->
    <script>
        window.LuxurySwal = Swal.mixin({
            background: '#ffffff',
            color: '#1c1917',
            confirmButtonColor: '#964B42',
            cancelButtonColor: '#64748b',
            customClass: {
                popup: 'rounded-2xl shadow-2xl border border-stone-200 font-sans',
                title: 'font-bold text-lg text-stone-900',
                confirmButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-[#964B42]/20 cursor-pointer',
                cancelButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider cursor-pointer'
            }
        });

        window.LuxuryToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3200,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#1c1917',
            iconColor: '#964B42',
            customClass: {
                popup: 'border border-stone-200 rounded-xl shadow-xl text-xs font-sans font-bold'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });
    </script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                LuxuryToast.fire({
                    icon: 'success',
                    title: @json(session('success'))
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const isEn = (window.__mehaaj_lang || 'en') === 'en';
                LuxurySwal.fire({
                    icon: 'error',
                    title: isEn ? 'Error' : 'Fehler',
                    text: @json(session('error'))
                });
            });
        </script>
    @endif

    @if(session('info'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                LuxuryToast.fire({
                    icon: 'info',
                    title: @json(session('info'))
                });
            });
        </script>
    @endif

    <style>
        body {
            background-color: #F8F5EF !important;
            color: #292524 !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* Hide Default Native Scrollbars */
        .admin-executive-sidebar,
        .admin-executive-sidebar * {
            scrollbar-width: none !important;
            -ms-overflow-style: none !important;
        }
        .admin-executive-sidebar::-webkit-scrollbar,
        .admin-executive-sidebar *::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Form Labels & Readability */
        label, form label {
            color: #292524 !important;
            font-weight: 700 !important;
        }

        /* Header & Sidebar Styles matching Pink-Salt */
        header.admin-executive-header {
            background-color: #ffffff !important;
            color: #1C1917 !important;
            border-bottom: 1px solid #E5DED5 !important;
        }

        aside.admin-executive-sidebar {
            background-color: #ffffff !important;
            color: #292524 !important;
            border-right: 1px solid #E5DED5 !important;
        }

        .admin-nav-item {
            color: #66605B !important;
            transition: all 0.2s ease-in-out;
            font-weight: 600;
            border-radius: 0.75rem;
        }

        .admin-nav-item svg {
            color: #8C827A;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-nav-item:hover {
            background-color: #FBF6F4 !important;
            color: #964B42 !important;
        }

        .admin-nav-item:hover svg {
            color: #964B42 !important;
            transform: scale(1.08);
        }

        .admin-nav-item-active {
            background-color: #F4E8E5 !important;
            color: #964B42 !important;
            font-weight: 700 !important;
            border-radius: 0.75rem;
        }

        .admin-nav-item-active svg {
            color: #964B42 !important;
        }

        .admin-nav-subitem {
            color: #66605B !important;
            font-weight: 500;
        }

        .admin-nav-subitem svg {
            color: #A39B93;
            transition: all 0.2s ease;
        }

        .admin-nav-subitem:hover {
            background-color: #FBF6F4 !important;
            color: #964B42 !important;
        }

        .admin-nav-subitem:hover svg {
            color: #964B42 !important;
            transform: translateX(2px);
        }

        .admin-nav-subitem-active {
            background-color: #F4E8E5 !important;
            color: #964B42 !important;
            font-weight: 700 !important;
        }

        /* Pink-Salt Buttons & Inputs */
        .btn-exec-primary {
            background-color: #964B42 !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            border: none !important;
            box-shadow: 0 4px 14px rgba(150, 75, 66, 0.25) !important;
            transition: all 0.2s ease;
        }

        .btn-exec-primary:hover {
            background-color: #803D35 !important;
            color: #ffffff !important;
            box-shadow: 0 6px 18px rgba(150, 75, 66, 0.35) !important;
            transform: translateY(-1px);
        }

        .btn-exec-secondary {
            background-color: #ffffff !important;
            color: #292524 !important;
            border: 1px solid #E5DED5 !important;
            font-weight: 700 !important;
            transition: all 0.2s ease;
        }

        .btn-exec-secondary:hover {
            background-color: #FBF6F4 !important;
            color: #964B42 !important;
            border-color: #964B42 !important;
        }

        .btn-exec-danger {
            background-color: #FFF1F2 !important;
            color: #BE123C !important;
            border: 1px solid #FECDD3 !important;
            font-weight: 700 !important;
            transition: all 0.2s ease;
        }

        .btn-exec-danger:hover {
            background-color: #FFE4E6 !important;
            color: #9F1239 !important;
        }

        .exec-input, form input[type="text"], form input[type="number"], form input[type="email"], form input[type="password"], form select, form textarea {
            background-color: #FBF6F4 !important;
            color: #292524 !important;
            border: 1px solid #E5DED5 !important;
            font-weight: 500 !important;
        }

        .exec-input:focus, form input:focus, form select:focus, form textarea:focus {
            background-color: #ffffff !important;
            border-color: #964B42 !important;
            box-shadow: 0 0 0 3px rgba(150, 75, 66, 0.15) !important;
        }

        /* Pink-Salt Card Style */
        .exec-card {
            background-color: #ffffff !important;
            border: 1px solid #E5DED5 !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 4px 20px -2px rgba(28, 25, 23, 0.05) !important;
            color: #292524 !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .exec-card:hover {
            box-shadow: 0 10px 25px -3px rgba(28, 25, 23, 0.08) !important;
            border-color: #D4C9BD !important;
        }

        /* Table Styling */
        .exec-table-head, table thead tr {
            background-color: #F8F5EF !important;
            color: #292524 !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.05em !important;
            font-size: 0.725rem !important;
            border-bottom: 2px solid #E5DED5 !important;
        }

        .exec-table-head th, table thead th {
            color: #292524 !important;
            font-weight: 800 !important;
            padding-top: 0.85rem !important;
            padding-bottom: 0.85rem !important;
        }

        .exec-table-row, table tbody tr {
            transition: background-color 0.15s ease-in-out !important;
            border-bottom: 1px solid #E5DED5 !important;
            color: #292524 !important;
        }

        .exec-table-row:hover, table tbody tr:hover {
            background-color: #FBF6F4 !important;
        }

        /* Badges */
        .badge-active {
            background-color: #ECFDF5 !important;
            color: #047857 !important;
            border: 1px solid #A7F3D0 !important;
            font-weight: 700 !important;
        }

        .badge-pending {
            background-color: #FFFBEB !important;
            color: #B45309 !important;
            border: 1px solid #FDE68A !important;
            font-weight: 700 !important;
        }

        .badge-draft {
            background-color: #F5F5F4 !important;
            color: #78716C !important;
            border: 1px solid #E7E5E4 !important;
            font-weight: 700 !important;
        }

        /* Luxury Accordion Tabs & Quill Editor Spacing & Styling */
        .tab-card {
            display: flex !important;
            flex-direction: column !important;
            gap: 1.25rem !important; /* Generous 20px clean gap between all elements */
        }

        .tab-card .tab-header-row {
            padding-bottom: 0.875rem !important;
            border-bottom: 1px solid #f5f5f4 !important;
        }

        .tab-card .tab-content-block,
        .tab-card .tab-features-block {
            display: flex !important;
            flex-direction: column !important;
            gap: 0.5rem !important; /* Clean space between label and input */
        }

        /* Seamless Luxury Quill Snow Styling for Admin (No harsh edges, perfect spacing) */
        .ql-toolbar.ql-snow {
            border: 1px solid #e7e5e4 !important;
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
            border-bottom: 1px solid #f5f5f4 !important;
            background-color: #fafaf9 !important;
            padding: 8px 12px !important;
        }

        .ql-container.ql-snow {
            border: 1px solid #e7e5e4 !important;
            border-top: none !important;
            border-bottom-left-radius: 0.75rem !important;
            border-bottom-right-radius: 0.75rem !important;
            background-color: #ffffff !important;
            font-family: inherit !important;
        }

        .ql-editor {
            min-height: 90px !important;
            font-size: 0.8125rem !important;
            line-height: 1.6 !important;
            color: #292524 !important;
            padding: 12px 14px !important;
        }

        .ql-editor.ql-blank::before {
            color: #a8a29e !important;
            font-style: normal !important;
            font-size: 0.8125rem !important;
            left: 14px !important;
        }

        /* ==========================================================
           MEHAAJ LUXURY OBSIDIAN DARK THEME ENGINE
           ========================================================== */
        html.dark {
            color-scheme: dark;
            background-color: #0E0D12 !important;
        }

        html.dark body {
            background-color: #0E0D12 !important;
            color: #F3F4F6 !important;
        }

        /* Layout & Main Ambient Background */
        html.dark .bg-\[\#F8F5EF\],
        html.dark [class*="bg-[#F8F5EF]"],
        html.dark .min-h-\[calc\(100vh-4rem\)\] {
            background-color: #0E0D12 !important;
        }

        /* Header & Sidebar */
        html.dark header.admin-executive-header {
            background-color: #16151B !important;
            color: #F3F4F6 !important;
            border-bottom: 1px solid #2B2834 !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.45) !important;
        }

        html.dark aside.admin-executive-sidebar {
            background-color: #16151B !important;
            color: #E5E7EB !important;
            border-right: 1px solid #2B2834 !important;
        }

        html.dark aside.admin-executive-sidebar .border-t,
        html.dark aside.admin-executive-sidebar .border-stone-200 {
            border-color: #2B2834 !important;
        }

        html.dark aside.admin-executive-sidebar .bg-stone-50 {
            background-color: #1D1C24 !important;
            border-color: #2B2834 !important;
        }

        /* Sidebar Navigation Links */
        html.dark .admin-nav-item {
            color: #C5BFB8 !important;
        }

        html.dark .admin-nav-item svg {
            color: #9CA3AF !important;
        }

        html.dark .admin-nav-item:hover {
            background-color: #24222C !important;
            color: #E88376 !important;
        }

        html.dark .admin-nav-item:hover svg {
            color: #E88376 !important;
        }

        html.dark .admin-nav-item-active {
            background-color: #351C1B !important;
            color: #F87171 !important;
        }

        html.dark .admin-nav-item-active svg {
            color: #F87171 !important;
        }

        html.dark .admin-nav-subitem {
            color: #9CA3AF !important;
        }

        html.dark .admin-nav-subitem svg {
            color: #6B7280 !important;
        }

        html.dark .admin-nav-subitem:hover {
            background-color: #24222C !important;
            color: #E88376 !important;
        }

        html.dark .admin-nav-subitem:hover svg {
            color: #E88376 !important;
        }

        html.dark .admin-nav-subitem-active {
            background-color: #351C1B !important;
            color: #F87171 !important;
        }

        /* Cards, Panels & Containers */
        html.dark .bg-white,
        html.dark .exec-card {
            background-color: #191820 !important;
            border-color: #2C2936 !important;
            color: #F3F4F6 !important;
        }

        html.dark .bg-stone-50,
        html.dark .bg-stone-50\/60,
        html.dark .bg-stone-50\/90,
        html.dark .bg-stone-100,
        html.dark .bg-\[\#faf7f2\],
        html.dark .bg-\[\#FBF6F4\] {
            background-color: #1E1C25 !important;
            border-color: #2E2B38 !important;
            color: #E5E7EB !important;
        }

        /* Text Legibility & Contrast in Dark Mode */
        html.dark .text-stone-900,
        html.dark .text-stone-800 {
            color: #F9FAFB !important;
        }

        html.dark .text-stone-700,
        html.dark .text-stone-600 {
            color: #D1D5DB !important;
        }

        html.dark .text-stone-500 {
            color: #9CA3AF !important;
        }

        html.dark .text-stone-400 {
            color: #8C8697 !important;
        }

        html.dark .text-stone-300 {
            color: #555060 !important;
        }

        html.dark h1,
        html.dark h2,
        html.dark h3,
        html.dark h4,
        html.dark h5,
        html.dark h6 {
            color: #F9FAFB !important;
        }

        html.dark label,
        html.dark form label {
            color: #E5E7EB !important;
        }

        /* Borders */
        html.dark .border-stone-100,
        html.dark .border-stone-200,
        html.dark .border-stone-200\/50,
        html.dark .border-stone-200\/60,
        html.dark .border-stone-200\/80,
        html.dark .border-stone-200\/90,
        html.dark .border-stone-300,
        html.dark .border-\[\#E5DED5\],
        html.dark .border-\[\#e6decb\] {
            border-color: #2C2936 !important;
        }

        html.dark .divide-stone-100 > :not([hidden]) ~ :not([hidden]),
        html.dark .divide-stone-200 > :not([hidden]) ~ :not([hidden]) {
            border-color: #2C2936 !important;
        }

        /* Form Inputs & Controls */
        html.dark input[type="text"],
        html.dark input[type="number"],
        html.dark input[type="email"],
        html.dark input[type="password"],
        html.dark input[type="search"],
        html.dark select,
        html.dark textarea,
        html.dark .exec-input,
        html.dark #admin-search-input {
            background-color: #141318 !important;
            color: #F9FAFB !important;
            border: 1px solid #353140 !important;
        }

        html.dark select option {
            background-color: #191820 !important;
            color: #F9FAFB !important;
        }

        html.dark input::placeholder,
        html.dark textarea::placeholder {
            color: #6B7280 !important;
        }

        html.dark input:focus,
        html.dark select:focus,
        html.dark textarea:focus,
        html.dark #admin-search-input:focus {
            background-color: #1A1922 !important;
            border-color: #E07A6F !important;
            box-shadow: 0 0 0 3px rgba(224, 122, 111, 0.25) !important;
        }

        /* Buttons & Actions Visibility */
        html.dark .btn-exec-primary {
            background-color: #A3483E !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 14px rgba(163, 72, 62, 0.45) !important;
        }

        html.dark .btn-exec-primary:hover {
            background-color: #B55246 !important;
            color: #FFFFFF !important;
            transform: translateY(-1px);
        }

        html.dark .btn-exec-secondary {
            background-color: #22202A !important;
            color: #F3F4F6 !important;
            border: 1px solid #3E3A4B !important;
        }

        html.dark .btn-exec-secondary:hover {
            background-color: #2C2937 !important;
            color: #E88376 !important;
            border-color: #E88376 !important;
        }

        html.dark .btn-exec-danger {
            background-color: #3B1219 !important;
            color: #FDA4AF !important;
            border: 1px solid #881337 !important;
        }

        html.dark .btn-exec-danger:hover {
            background-color: #4C1D24 !important;
            color: #FECDD3 !important;
        }

        /* Generic stone-100 buttons in dark mode */
        html.dark a.bg-stone-100,
        html.dark button.bg-stone-100 {
            background-color: #24222D !important;
            color: #E5E7EB !important;
            border-color: #383445 !important;
        }

        html.dark a.bg-stone-100:hover,
        html.dark button.bg-stone-100:hover {
            background-color: #2E2B3A !important;
            color: #FFFFFF !important;
        }

        /* Tables & Lists */
        html.dark table thead tr,
        html.dark .exec-table-head {
            background-color: #141318 !important;
            border-bottom: 2px solid #2C2936 !important;
            color: #D1D5DB !important;
        }

        html.dark table thead th,
        html.dark .exec-table-head th {
            color: #D1D5DB !important;
        }

        html.dark table tbody tr,
        html.dark .exec-table-row {
            border-bottom: 1px solid #25232D !important;
            color: #E5E7EB !important;
        }

        html.dark table tbody tr:hover,
        html.dark .exec-table-row:hover {
            background-color: #201E28 !important;
        }

        html.dark table tbody td {
            color: #E5E7EB !important;
        }

        /* Badges & Pills */
        html.dark .bg-emerald-50 {
            background-color: #052F1E !important;
            border-color: #065F46 !important;
            color: #6EE7B7 !important;
        }

        html.dark .bg-emerald-100 {
            background-color: #064E3B !important;
            color: #A7F3D0 !important;
        }

        html.dark .bg-rose-50 {
            background-color: #330C15 !important;
            border-color: #881337 !important;
            color: #FDA4AF !important;
        }

        html.dark .bg-rose-100 {
            background-color: #4C1D24 !important;
            color: #FECDD3 !important;
        }

        html.dark .bg-amber-50 {
            background-color: #2E1704 !important;
            border-color: #78350F !important;
            color: #FCD34D !important;
        }

        html.dark .bg-amber-100 {
            background-color: #451A03 !important;
            color: #FDE68A !important;
        }

        html.dark .bg-sky-50,
        html.dark .bg-blue-50 {
            background-color: #071E36 !important;
            border-color: #1E3A8A !important;
            color: #93C5FD !important;
        }

        html.dark .bg-purple-50 {
            background-color: #220D38 !important;
            border-color: #581C87 !important;
            color: #D8B4FE !important;
        }

        html.dark .bg-saltora-blush {
            background-color: #351C1B !important;
            border-color: #7F1D1D !important;
            color: #F87171 !important;
        }

        /* Language Toggle Pill in Dark Mode */
        html.dark div[aria-label="Language selector"] {
            background-color: #22202A !important;
            border-color: #363242 !important;
        }

        html.dark div[aria-label="Language selector"] button:not(.bg-saltora-terracotta) {
            color: #C5BFB8 !important;
        }

        /* Modals & SweetAlert in Dark Mode */
        html.dark #review-detail-dialog,
        html.dark [id*="modal"] .bg-white {
            background-color: #191820 !important;
            border-color: #2C2936 !important;
            color: #F3F4F6 !important;
        }

        html.dark .swal2-popup {
            background-color: #191820 !important;
            color: #F3F4F6 !important;
            border: 1px solid #2C2936 !important;
        }

        html.dark .swal2-title {
            color: #F9FAFB !important;
        }

        html.dark .swal2-html-container {
            color: #D1D5DB !important;
        }

        /* Quill Editor in Dark Mode */
        html.dark .ql-toolbar.ql-snow {
            background-color: #141318 !important;
            border-color: #2C2936 !important;
        }

        html.dark .ql-container.ql-snow {
            background-color: #191820 !important;
            border-color: #2C2936 !important;
            color: #F3F4F6 !important;
        }

        html.dark .ql-editor {
            color: #F3F4F6 !important;
        }

        html.dark .ql-snow .ql-stroke {
            stroke: #9CA3AF !important;
        }

        html.dark .ql-snow .ql-fill {
            fill: #9CA3AF !important;
        }

        html.dark .ql-snow .ql-picker {
            color: #D1D5DB !important;
        }

        html.dark .ql-snow .ql-picker-options {
            background-color: #16151B !important;
            border-color: #2C2936 !important;
            color: #F3F4F6 !important;
        }

        /* Preserve high-contrast CTA buttons inside gradient banners */
        html.dark [class*="bg-gradient-to-r"] a.bg-white,
        html.dark [class*="bg-gradient-to-r"] button.bg-white {
            background-color: #FFFFFF !important;
            color: #964B42 !important;
        }

        /* Pagination Controls in Dark Mode */
        html.dark nav[role="navigation"] a,
        html.dark nav[role="navigation"] span {
            background-color: #22202A !important;
            border-color: #363242 !important;
            color: #D1D5DB !important;
        }
        html.dark nav[role="navigation"] a:hover {
            background-color: #2C2937 !important;
            color: #FFFFFF !important;
        }
        html.dark nav[role="navigation"] span[aria-current="page"] span {
            background-color: #A3483E !important;
            border-color: #A3483E !important;
            color: #FFFFFF !important;
        }

        /* Sidebar dropdown arrows in Dark Mode */
        html.dark svg[id$="-menu-arrow"] {
            color: #9CA3AF !important;
        }
        html.dark .admin-nav-item-active svg[id$="-menu-arrow"] {
            color: #F87171 !important;
        }

        /* Header search bar in Dark Mode */
        html.dark #admin-search-input {
            background-color: #1F1D26 !important;
            border-color: #332F3D !important;
            color: #F9FAFB !important;
        }
        html.dark #admin-search-input:focus {
            background-color: #25232F !important;
            border-color: #E07A6F !important;
        }

        /* Footer in Dark Mode */
        html.dark footer {
            border-color: #2B2834 !important;
            color: #8C8697 !important;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col bg-[#F8F5EF] text-stone-800">
    @php
        $currentAdmin = auth()->user();
        $currentRole = $currentAdmin?->role ?? session('admin_role', 'admin');
        $canManageCatalog = in_array($currentRole, ['super_admin', 'admin', 'inventory_manager']);
        $canManageOrders = in_array($currentRole, ['super_admin', 'admin']);
        $canModerate = in_array($currentRole, ['super_admin', 'admin', 'moderator']);
        $isSuperAdmin = ($currentRole === 'super_admin');
        
        $roleName = match($currentRole) {
            'super_admin'       => 'Super Admin',
            'admin'             => 'Store Admin',
            'moderator'         => 'Review Moderator',
            'inventory_manager' => 'Inventory Staff',
            default             => ucfirst(str_replace('_', ' ', $currentRole ?? 'Staff'))
        };
        $roleBadgeStyle = match($currentRole) {
            'super_admin'       => 'bg-purple-100 text-purple-800 border-purple-200',
            'admin'             => 'bg-rose-100 text-rose-800 border-rose-200',
            'moderator'         => 'bg-blue-100 text-blue-800 border-blue-200',
            'inventory_manager' => 'bg-amber-100 text-amber-800 border-amber-200',
            default             => 'bg-stone-100 text-stone-700 border-stone-200'
        };
        $adminDisplayName = $currentAdmin?->name ?? session('admin_name', 'MEHAAJ Admin');
        $adminDisplayEmail = $currentAdmin?->email ?? session('admin_email', 'admin@mehaaj.de');
        $nameParts = explode(' ', trim($adminDisplayName));
        $adminInitials = strtoupper(
            (isset($nameParts[0][0]) ? $nameParts[0][0] : 'M') .
            (isset($nameParts[1][0]) ? $nameParts[1][0] : (isset($nameParts[0][1]) ? $nameParts[0][1] : 'H'))
        );
    @endphp

    <!-- Top Executive Header Bar (Clean White & Warm Stone) -->
    <header class="admin-executive-header fixed top-0 inset-x-0 z-50 h-16 bg-white border-b border-[#E5DED5] shadow-2xs flex items-center justify-between px-4 sm:px-6">
        
        <!-- Header Left: Mobile Hamburger & Brand Logo -->
        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleMobileSidebar()" class="lg:hidden p-2 rounded-xl text-stone-600 cursor-pointer transition hover:bg-stone-100 focus:outline-none" aria-label="Toggle Navigation">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>

            <!-- Brand Logo with Pink-Salt Terracotta & Amber Gradient -->
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-gradient-to-br from-[#964B42] to-[#d4a373] p-0.5 shadow-md shadow-[#964B42]/20">
                    <div class="w-full h-full bg-white rounded-[9px] flex items-center justify-center font-bold text-xs text-[#964B42]">
                        <img src="/logo.png" alt="MEHAAJ Logo" class="w-5 h-5 object-contain" onerror="this.remove();">
                    </div>
                </div>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="font-serif text-base sm:text-lg font-bold tracking-wider text-stone-900 block leading-none">
                        MEHAAJ <span class="text-saltora-terracotta font-black">ATELIER</span>
                    </a>
                    <span class="text-[0.62rem] font-bold tracking-widest uppercase text-saltora-terracotta leading-tight hidden sm:block">ECOMMERCE ADMIN</span>
                </div>
            </div>
        </div>

        <!-- Header Center: Global Search Input -->
        <div class="hidden md:flex items-center flex-1 max-w-lg mx-6">
            <div class="relative w-full">
                <input
                    id="admin-search-input"
                    type="text"
                    placeholder="Search products, orders, customers..."
                    data-i18n-placeholder-de="Suche nach Produkten, Bestellungen, Kunden..."
                    data-i18n-placeholder-en="Search products, orders, customers..."
                    class="w-full h-10 rounded-full bg-stone-50 border border-stone-200 px-4 pl-10 text-xs text-stone-800 outline-none transition-all placeholder:text-stone-400 focus:bg-white focus:ring-2 focus:ring-saltora-terracotta/20 focus:border-saltora-terracotta"
                >
                <svg class="h-4 w-4 absolute left-3.5 top-3 text-stone-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
        </div>

        <!-- Header Right Actions: View Website, Language, Add Product & Avatar -->
        <div class="flex items-center gap-2 sm:gap-3 text-xs">
            
            @if($canManageCatalog)
            <!-- Add Product Button (Pink-Salt Styled) -->
            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-1.5 rounded-full bg-saltora-terracotta hover:bg-saltora-terracotta-dark text-white px-4 py-2 text-xs font-bold transition shadow-xs shadow-saltora-terracotta/20">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span data-i18n-de="+ Produkt" data-i18n-en="+ Add Product">+ Add Product</span>
            </a>
            @endif

            <!-- View Live Website Button -->
            <a href="/" target="_blank" class="hidden sm:flex items-center gap-1.5 rounded-full bg-stone-100 hover:bg-stone-200 text-stone-700 px-3.5 py-2 text-xs font-semibold transition border border-stone-200">
                <svg class="h-3.5 w-3.5 text-stone-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                <span data-i18n-de="Live Store" data-i18n-en="View Live Store">View Live Store</span>
            </a>

            <!-- Dark / Light Theme Toggle Button -->
            <button
                id="admin-theme-toggle-btn"
                type="button"
                onclick="toggleAdminTheme()"
                class="flex items-center justify-center h-8 w-8 rounded-full border border-stone-200 bg-stone-100 text-stone-700 hover:text-saltora-terracotta hover:border-saltora-terracotta/40 transition cursor-pointer shadow-2xs"
                title="Toggle Dark / Light Theme"
                data-i18n-title-en="Toggle Dark / Light Theme"
                data-i18n-title-de="Dunkel-/Hellmodus umschalten"
                aria-label="Toggle Dark / Light Theme"
            >
                <!-- Sun Icon (Active in Dark Mode to switch to Light) -->
                <svg id="theme-toggle-sun" class="h-4 w-4 hidden text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="12" y1="1" x2="12" y2="3"/>
                    <line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/>
                    <line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                <!-- Moon Icon (Active in Light Mode to switch to Dark) -->
                <svg id="theme-toggle-moon" class="h-4 w-4 block text-stone-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>
            </button>

            <!-- Language Toggle Pill (Default: EN) -->
            <div class="flex items-center rounded-full bg-stone-100 p-1 border border-stone-200" aria-label="Language selector">
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-bold uppercase transition" type="button" data-language-option="en">EN</button>
                <button class="cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-bold uppercase transition" type="button" data-language-option="de">DE</button>
            </div>

            <!-- Admin Avatar Circle -->
            <div class="h-9 w-9 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold text-xs shadow-xs" title="{{ $adminDisplayName }} ({{ $roleName }})">
                {{ $adminInitials }}
            </div>

        </div>
    </header>

    <!-- Mobile Overlay Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 z-30 bg-stone-900/60 backdrop-blur-xs hidden lg:hidden transition-opacity duration-300"></div>

    <!-- Sidebar & Main Body Wrapper -->
    <div class="flex flex-1 pt-16">

        <!-- Left Executive Sidebar (Clean White & Pink-Salt Terracotta Theme) -->
        <aside id="admin-sidebar" class="admin-executive-sidebar fixed top-16 bottom-0 left-0 z-40 w-64 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 bg-white border-r border-[#E5DED5]">
            <div class="p-3.5 space-y-3 overflow-y-auto no-scrollbar flex-1">
                
                <!-- Admin Navigation List -->
                <nav class="space-y-1 text-xs font-semibold">
                    
                    <!-- Dashboard Overview (All Roles) -->
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.dashboard') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="9" rx="1.5"/>
                                <rect x="14" y="3" width="7" height="5" rx="1.5"/>
                                <rect x="14" y="12" width="7" height="9" rx="1.5"/>
                                <rect x="3" y="16" width="7" height="5" rx="1.5"/>
                            </svg>
                            <span data-i18n-de="Dashboard Übersicht" data-i18n-en="Dashboard Overview">Dashboard Overview</span>
                        </div>
                    </a>

                    @if($canManageCatalog)
                    <!-- Collapsible Categories Dropdown (Haute Couture Layer Stack) -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('categories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.categories*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.categories*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 2 7 12 12 22 7 12 2"/>
                                    <polyline points="2 17 12 22 22 17"/>
                                    <polyline points="2 12 12 17 22 12"/>
                                </svg>
                                <span data-i18n-de="Kategorien" data-i18n-en="Categories">Categories</span>
                            </div>
                            <svg id="categories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.categories*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="categories-menu" class="{{ request()->routeIs('admin.categories*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.categories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.categories') && !request()->routeIs('admin.categories.create') && !request()->routeIs('admin.categories.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                                <span data-i18n-de="Kategorien Übersicht" data-i18n-en="View Categories">View Categories</span>
                            </a>
                            <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.categories.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kategorie Hinzufügen" data-i18n-en="Add Category">Add Category</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Subcategories Dropdown (Taxonomy Branches) -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('subcategories-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.subcategories*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.subcategories*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="6" y1="3" x2="6" y2="15"/>
                                    <circle cx="18" cy="6" r="3"/>
                                    <circle cx="6" cy="18" r="3"/>
                                    <path d="M18 9a9 9 0 0 1-9 9"/>
                                </svg>
                                <span data-i18n-de="Unterkategorien" data-i18n-en="Subcategories">Subcategories</span>
                            </div>
                            <svg id="subcategories-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.subcategories*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="subcategories-menu" class="{{ request()->routeIs('admin.subcategories*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.subcategories') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.subcategories') && !request()->routeIs('admin.subcategories.create') && !request()->routeIs('admin.subcategories.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                                <span data-i18n-de="Unterkategorien Übersicht" data-i18n-en="View Subcategories">View Subcategories</span>
                            </a>
                            <a href="{{ route('admin.subcategories.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.subcategories.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Unterkategorie Hinzufügen" data-i18n-en="Add Subcategory">Add Subcategory</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Products Catalog Dropdown (Luxury Garment Tag) -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('products-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.products*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.products*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                    <line x1="7" y1="7" x2="7.01" y2="7"/>
                                </svg>
                                <span data-i18n-de="Produkte Katalog" data-i18n-en="Product Catalog">Product Catalog</span>
                            </div>
                            <svg id="products-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.products*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="products-menu" class="{{ request()->routeIs('admin.products*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.products') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.products') && !request()->routeIs('admin.products.create') && !request()->routeIs('admin.products.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                                <span data-i18n-de="Produkte Übersicht" data-i18n-en="View Products">View Products</span>
                            </a>
                            <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.products.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Produkt Hinzufügen" data-i18n-en="Add Product">Add Product</span>
                            </a>
                        </div>
                    </div>

                    <!-- Inventory & Stock Management (Warehouse Package 3D) -->
                    <a href="{{ route('admin.inventory') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.inventory*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.inventory*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m7.5 4.27 9 5.15"/>
                                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                                <path d="m3.3 7 8.7 5 8.7-5"/>
                                <path d="M12 22V12"/>
                            </svg>
                            <span data-i18n-de="Lagerbestand & Inventar" data-i18n-en="Inventory & Stock">Inventory & Stock</span>
                        </div>
                        @php
                            $adminLowStockAlertCount = \App\Models\Product::where('stock', '<=', 5)->count();
                        @endphp
                        @if($adminLowStockAlertCount > 0)
                            <span class="rounded-full bg-amber-50 text-amber-700 border border-amber-200/80 px-2 py-0.5 text-[0.62rem] font-bold">{{ $adminLowStockAlertCount }} Low</span>
                        @endif
                    </a>
                    @endif

                    @if($canManageOrders)
                    <!-- Collapsible Orders Dropdown (Verified Order Processing) -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('orders-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.orders*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.orders*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>
                                    <path d="m9 14 2 2 4-4"/>
                                </svg>
                                <span data-i18n-de="Bestellungen & Vorkasse" data-i18n-en="Bulk Orders">Bulk Orders</span>
                            </div>
                            <svg id="orders-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.orders*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="orders-menu" class="{{ request()->routeIs('admin.orders*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.orders') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.orders') && !request('payment_method') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
                                <span data-i18n-de="Bestellungen Übersicht" data-i18n-en="View Orders">View Orders</span>
                            </a>
                            <a href="{{ route('admin.orders', ['payment_method' => 'vorkasse']) }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request('payment_method') === 'vorkasse' ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span data-i18n-de="Vorkasse & Rechnungen" data-i18n-en="Prepayments & Invoices">Prepayments & Invoices</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible VIP Customers Dropdown (Royal Crown Elite) -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('customers-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.customers*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.customers*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 18h18v2H3z"/>
                                    <path d="m4 15 2-9 4.5 4L12 4l1.5 6L18 6l2 9H4z"/>
                                </svg>
                                <span data-i18n-de="VIP Kundenstamm" data-i18n-en="VIP Customers">VIP Customers</span>
                            </div>
                            <svg id="customers-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.customers*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="customers-menu" class="{{ request()->routeIs('admin.customers*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.customers') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.customers') && !request()->routeIs('admin.customers.create') && !request()->routeIs('admin.customers.edit') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                <span data-i18n-de="Kunden Übersicht" data-i18n-en="View Customers">View Customers</span>
                            </a>
                            <a href="{{ route('admin.customers.create') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.customers.create') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                                <span data-i18n-de="Kunde Hinzufügen" data-i18n-en="Add Customer">Add Customer</span>
                            </a>
                        </div>
                    </div>

                    <!-- Collapsible Financial Intelligence Dropdown (Accounting Balance Scales) -->
                    <div class="space-y-1">
                        <button type="button" onclick="toggleSidebarMenu('finance-menu')" class="w-full flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 cursor-pointer rounded-xl {{ request()->routeIs('admin.finance*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                            <div class="flex items-center gap-3">
                                <svg class="h-4 w-4 {{ request()->routeIs('admin.finance*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/>
                                    <path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/>
                                    <path d="M7 21h10"/>
                                    <path d="M12 3v18"/>
                                    <path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/>
                                </svg>
                                <span data-i18n-de="Finanzen & GuV" data-i18n-en="Finance & GuV">Finance & GuV</span>
                            </div>
                            <svg id="finance-menu-arrow" class="h-3.5 w-3.5 transition-transform duration-200 {{ request()->routeIs('admin.finance*') ? 'rotate-180 text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                        </button>

                        <div id="finance-menu" class="{{ request()->routeIs('admin.finance*') ? 'block' : 'hidden' }} ml-4 pl-3.5 border-l-2 border-stone-200 my-1 space-y-1">
                            <a href="{{ route('admin.finance.profit-loss') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.finance.profit-loss') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                                <span data-i18n-de="Gewinn & Verlust (GuV)" data-i18n-en="Profit & Loss (P&L)">Profit & Loss (P&L)</span>
                            </a>
                            <a href="{{ route('admin.finance.balance-sheet') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.finance.balance-sheet') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v18M3 9l9-6 9 6M3 9l9 6 9-6M3 9v6l9 6 9-6V9"/></svg>
                                <span data-i18n-de="Bilanz (Balance Sheet)" data-i18n-en="Balance Sheet">Balance Sheet</span>
                            </a>
                            <a href="{{ route('admin.finance.expenses') }}" class="flex items-center gap-2.5 px-3 py-2 text-xs transition-all rounded-lg {{ request()->routeIs('admin.finance.expenses') ? 'admin-nav-subitem-active' : 'admin-nav-subitem hover:bg-stone-50' }}">
                                <svg class="h-3.5 w-3.5 opacity-80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                                <span data-i18n-de="Betriebsausgaben" data-i18n-en="Operating Expenses">Operating Expenses</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    @if($canModerate)
                    <!-- Customer Contact Inquiries / Messages (Concierge Message Bubble) -->
                    <a href="{{ route('admin.messages') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.messages*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.messages*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                <circle cx="8" cy="10" r="1" fill="currentColor"/>
                                <circle cx="12" cy="10" r="1" fill="currentColor"/>
                                <circle cx="16" cy="10" r="1" fill="currentColor"/>
                            </svg>
                            <span data-i18n-de="Kundenanfragen" data-i18n-en="Customer Messages">Customer Messages</span>
                        </div>
                        @php
                            $unreadMsgCount = \App\Models\ContactMessage::where('status', 'unread')->count();
                        @endphp
                        @if($unreadMsgCount > 0)
                            <span class="rounded-full bg-saltora-blush border border-saltora-terracotta/30 px-2 py-0.5 text-[0.6rem] font-bold text-saltora-terracotta">{{ $unreadMsgCount }} New</span>
                        @endif
                    </a>

                    <!-- Customer Reviews & Testimonials Moderation (Verified Medal Award) -->
                    <a href="{{ route('admin.reviews') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.reviews*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.reviews*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="6"/>
                                <path d="m15.5 13.5 1.5 7.5-5-2.5-5 2.5 1.5-7.5"/>
                            </svg>
                            <span data-i18n-de="Kundenbewertungen" data-i18n-en="Customer Reviews">Customer Reviews</span>
                        </div>
                        @php
                            $pendingReviewsBadgeCount = \App\Models\Review::where('status', 'pending')->count();
                        @endphp
                        @if($pendingReviewsBadgeCount > 0)
                            <span class="rounded-full bg-amber-50 border border-amber-300 text-amber-800 px-2 py-0.5 text-[0.6rem] font-bold animate-pulse">{{ $pendingReviewsBadgeCount }} Pending</span>
                        @endif
                    </a>
                    @endif

                    @if($isSuperAdmin)
                    <!-- Staff & Role Management (Security Governance Shield) -->
                    <a href="{{ route('admin.staff') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.staff*') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.staff*') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <circle cx="12" cy="10" r="2.5"/>
                                <path d="M12 12.5v3.5"/>
                            </svg>
                            <span data-i18n-de="Mitarbeiter & Rollen" data-i18n-en="Staff & Roles">Staff & Roles</span>
                        </div>
                        <span class="rounded bg-purple-50 text-purple-700 border border-purple-200 px-1.5 py-0.5 text-[0.6rem] font-bold">RBAC</span>
                    </a>

                    <!-- Store Settings (Executive Control Sliders) -->
                    <a href="{{ route('admin.settings') }}" class="flex items-center justify-between px-3.5 py-2.5 transition-all duration-200 rounded-xl {{ request()->routeIs('admin.settings') ? 'admin-nav-item-active' : 'admin-nav-item' }}">
                        <div class="flex items-center gap-3">
                            <svg class="h-4 w-4 {{ request()->routeIs('admin.settings') ? 'text-saltora-terracotta' : 'text-stone-400' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="4" y1="21" x2="4" y2="14"/>
                                <line x1="4" y1="10" x2="4" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12" y2="3"/>
                                <line x1="20" y1="21" x2="20" y2="16"/>
                                <line x1="20" y1="12" x2="20" y2="3"/>
                                <line x1="1" y1="14" x2="7" y2="14"/>
                                <line x1="9" y1="8" x2="15" y2="8"/>
                                <line x1="17" y1="16" x2="23" y2="16"/>
                            </svg>
                            <span data-i18n-de="Store Einstellungen" data-i18n-en="Store Settings">Store Settings</span>
                        </div>
                    </a>
                    @endif

                </nav>
            </div>

            <!-- Sidebar Bottom User Profile Card with SweetAlert Sign Out -->
            <div class="p-3 border-t border-stone-200">
                <div class="flex items-center justify-between p-2 rounded-xl bg-stone-50 border border-stone-200/80">
                    <div class="flex items-center gap-2 overflow-hidden min-w-0">
                        <div class="h-8 w-8 shrink-0 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold text-xs shadow-2xs">
                            {{ $adminInitials }}
                        </div>
                        <div class="min-w-0 flex-1 truncate">
                            <p class="font-bold text-xs text-stone-800 truncate leading-tight">{{ $adminDisplayName }}</p>
                            <div class="mt-0.5">
                                <span class="inline-block px-1.5 py-0.5 rounded text-[0.58rem] font-bold uppercase tracking-wider border {{ $roleBadgeStyle }}">{{ $roleName }}</span>
                            </div>
                            <p class="text-[0.6rem] text-stone-400 font-medium truncate mt-0.5">{{ $adminDisplayEmail }}</p>
                        </div>
                    </div>

                    <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="shrink-0 ml-1">
                        @csrf
                        <button type="button" onclick="confirmSignOut()" class="transition cursor-pointer p-1.5 rounded-lg text-stone-400 hover:text-saltora-terracotta hover:bg-saltora-blush-light" title="Sign Out">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Dynamic Content Area (#F8F5EF Pink-Salt Ambient Background) -->
        <div class="flex-1 min-w-0 max-w-full lg:ml-64 min-h-[calc(100vh-4rem)] p-4 sm:p-6 lg:p-8 pb-16 flex flex-col justify-between transition-all duration-300 bg-[#F8F5EF]">
            
            <main class="space-y-6 flex-1 min-w-0 max-w-full pb-20">
                @yield('admin-content')
            </main>

            <!-- Admin Footer -->
            <footer class="mt-8 border-t border-stone-200/80 pt-4 flex flex-col sm:flex-row items-center justify-between text-[0.7rem] text-stone-500 font-medium gap-2 text-center sm:text-left">
                <p>© {{ date('Y') }} MEHAAJ Luxury Atelier — Executive Control Center</p>
                <p>Designed for MEHAAJ E-Commerce Store</p>
            </footer>

        </div>

    </div>

    <!-- Internationalization (EN / DE) Global Persistent Translation Engine -->
    <script>
        function toggleSidebarMenu(menuId) {
            const menu = document.getElementById(menuId);
            const arrow = document.getElementById(menuId + '-arrow');
            if (menu) {
                menu.classList.toggle('hidden');
                if (arrow) {
                    arrow.classList.toggle('rotate-180');
                }
            }
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
            }
            if (backdrop) {
                backdrop.classList.toggle('hidden');
            }
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        function setCookie(name, value, days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = `${name}=${value};expires=${date.toUTCString()};path=/`;
        }

        function applyLanguage(lang) {
            if (!lang) lang = 'en';
            
            // Persist globally across tabs and page reloads via localStorage & Cookie
            try {
                localStorage.setItem('mehaaj_admin_lang', lang);
            } catch(e){}
            setCookie('mehaaj_admin_lang', lang, 365);
            setCookie('locale', lang, 365);
            window.__mehaaj_lang = lang;
            document.documentElement.lang = lang;

            // Update Language toggle button active states in Header
            document.querySelectorAll('[data-language-option]').forEach(btn => {
                const optLang = btn.getAttribute('data-language-option');
                if (optLang === lang) {
                    btn.className = 'cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-black uppercase transition bg-saltora-terracotta text-white shadow-2xs';
                } else {
                    btn.className = 'cursor-pointer rounded-full px-2.5 py-1 text-[0.62rem] font-bold uppercase transition text-stone-600 hover:text-stone-900';
                }
            });

            // Translate all elements with data-i18n-de and data-i18n-en safely
            document.querySelectorAll('[data-i18n-' + lang + ']').forEach(el => {
                const text = el.getAttribute('data-i18n-' + lang);
                if (text === null) return;

                const childWithI18n = el.querySelector('[data-i18n-' + lang + ']');
                if (childWithI18n) return;

                let textNode = null;
                for (let child of el.childNodes) {
                    if (child.nodeType === Node.TEXT_NODE && child.textContent.trim().length > 0) {
                        textNode = child;
                        break;
                    }
                }

                if (textNode && el.children.length > 0) {
                    textNode.textContent = text;
                } else if (el.children.length === 0) {
                    el.innerText = text;
                } else {
                    const spanTarget = el.querySelector('span');
                    if (spanTarget) {
                        spanTarget.innerText = text;
                    } else {
                        el.innerText = text;
                    }
                }
            });

            // Translate placeholders
            document.querySelectorAll('[data-i18n-placeholder-' + lang + ']').forEach(el => {
                const ph = el.getAttribute('data-i18n-placeholder-' + lang);
                if (ph !== null) {
                    el.placeholder = ph;
                }
            });

            // Translate tooltips and titles
            document.querySelectorAll('[data-i18n-title-' + lang + ']').forEach(el => {
                const title = el.getAttribute('data-i18n-title-' + lang);
                if (title !== null) {
                    el.title = title;
                }
            });

            // Notify backend asynchronously to synchronize Laravel session locale
            try {
                fetch(`/admin/lang/${lang}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).catch(() => {});
            } catch(e) {}
        }

        // ==========================================
        // Luxury Obsidian Dark Theme Engine
        // ==========================================
        function setAdminTheme(theme) {
            if (theme !== 'dark' && theme !== 'light') theme = 'light';
            
            try {
                localStorage.setItem('mehaaj_admin_theme', theme);
            } catch(e) {}
            setCookie('mehaaj_admin_theme', theme, 365);
            window.__mehaaj_theme = theme;

            const sunIcon = document.getElementById('theme-toggle-sun');
            const moonIcon = document.getElementById('theme-toggle-moon');
            const themeBtn = document.getElementById('admin-theme-toggle-btn');

            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                if (document.body) document.body.classList.add('dark');
                if (sunIcon) sunIcon.classList.remove('hidden');
                if (moonIcon) moonIcon.classList.add('hidden');
                if (themeBtn) {
                    themeBtn.setAttribute('title', (window.__mehaaj_lang === 'de') ? 'Hellmodus aktivieren' : 'Switch to Light Mode');
                }
                
                // Reconfigure LuxurySwal for Obsidian Dark Mode
                if (window.LuxurySwal) {
                    window.LuxurySwal = Swal.mixin({
                        background: '#191820',
                        color: '#F3F4F6',
                        confirmButtonColor: '#A3483E',
                        cancelButtonColor: '#4B5563',
                        customClass: {
                            popup: 'rounded-2xl shadow-2xl border border-[#2C2936] font-sans',
                            title: 'font-bold text-lg text-white',
                            confirmButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-[#964B42]/30 cursor-pointer',
                            cancelButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider cursor-pointer bg-stone-800 text-stone-200'
                        }
                    });
                }
            } else {
                document.documentElement.classList.remove('dark');
                if (document.body) document.body.classList.remove('dark');
                if (sunIcon) sunIcon.classList.add('hidden');
                if (moonIcon) moonIcon.classList.remove('hidden');
                if (themeBtn) {
                    themeBtn.setAttribute('title', (window.__mehaaj_lang === 'de') ? 'Dunkelmodus aktivieren' : 'Switch to Dark Mode');
                }

                // Reconfigure LuxurySwal for Ivory Light Mode
                if (window.LuxurySwal) {
                    window.LuxurySwal = Swal.mixin({
                        background: '#ffffff',
                        color: '#1c1917',
                        confirmButtonColor: '#964B42',
                        cancelButtonColor: '#64748b',
                        customClass: {
                            popup: 'rounded-2xl shadow-2xl border border-stone-200 font-sans',
                            title: 'font-bold text-lg text-stone-900',
                            confirmButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider text-white shadow-md shadow-[#964B42]/20 cursor-pointer',
                            cancelButton: 'px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider cursor-pointer'
                        }
                    });
                }
            }
        }

        function toggleAdminTheme() {
            const current = (window.__mehaaj_theme || localStorage.getItem('mehaaj_admin_theme') || 'light');
            const nextTheme = current === 'dark' ? 'light' : 'dark';
            setAdminTheme(nextTheme);
        }

        // Cross-tab real-time persistence sync
        window.addEventListener('storage', function(e) {
            if (e.key === 'mehaaj_admin_lang' && e.newValue) {
                applyLanguage(e.newValue);
            }
            if (e.key === 'mehaaj_admin_theme' && e.newValue) {
                setAdminTheme(e.newValue);
            }
        });

        // Apply immediately and setup click listeners
        const initialLang = localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'en';
        const initialTheme = localStorage.getItem('mehaaj_admin_theme') || getCookie('mehaaj_admin_theme') || 'light';

        document.addEventListener('DOMContentLoaded', function() {
            applyLanguage(initialLang);
            setAdminTheme(initialTheme);

            document.querySelectorAll('[data-language-option]').forEach(btn => {
                btn.addEventListener('click', function() {
                    const lang = this.getAttribute('data-language-option');
                    applyLanguage(lang);
                });
            });
        });

        window.addEventListener('load', function() {
            applyLanguage(localStorage.getItem('mehaaj_admin_lang') || getCookie('mehaaj_admin_lang') || 'en');
            setAdminTheme(localStorage.getItem('mehaaj_admin_theme') || getCookie('mehaaj_admin_theme') || 'light');
        });

        // Pink-Salt SweetAlert Logout Modal (Adapts to Dark / Light)
        function confirmSignOut() {
            const isEn = (window.__mehaaj_lang || 'en') === 'en';
            const isDark = document.documentElement.classList.contains('dark');
            Swal.fire({
                title: isEn ? 'Sign Out?' : 'Abmelden?',
                text: isEn ? 'Are you sure you want to end your admin session?' : 'Möchten Sie Ihre Admin-Sitzung wirklich beenden?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#964B42',
                cancelButtonColor: '#64748b',
                confirmButtonText: isEn ? '<i class="fa-solid fa-right-from-bracket mr-1.5"></i> Yes, Sign Out' : '<i class="fa-solid fa-right-from-bracket mr-1.5"></i> Ja, Abmelden',
                cancelButtonText: isEn ? 'Cancel' : 'Abbrechen',
                reverseButtons: true,
                background: isDark ? '#191820' : '#ffffff',
                color: isDark ? '#F3F4F6' : '#1c1917',
                customClass: {
                    popup: isDark ? 'rounded-2xl shadow-2xl border border-[#2C2936]' : 'rounded-2xl shadow-2xl border border-stone-200',
                    confirmButton: 'rounded-xl px-4 py-2.5 font-semibold text-xs shadow-md shadow-[#964B42]/20',
                    cancelButton: 'rounded-xl px-4 py-2.5 font-semibold text-xs'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: isEn ? 'Signing Out...' : 'Abmeldung läuft...',
                        text: isEn ? 'Ending admin session securely.' : 'Admin-Sitzung wird sicher beendet.',
                        icon: 'success',
                        timer: 800,
                        showConfirmButton: false,
                        background: isDark ? '#191820' : '#ffffff',
                        color: isDark ? '#F3F4F6' : '#1c1917',
                        iconColor: '#964B42',
                        timerProgressBar: true
                    }).then(() => {
                        document.getElementById('admin-logout-form').submit();
                    });
                }
            });
        }
    </script>
</body>
</html>
