<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50 antialiased">
        <div class="flex min-h-screen items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-md">
                <div class="mb-8 flex justify-center">
                </div>

                <div class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>