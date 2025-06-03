<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-slate-50 antialiased">
        <div class="flex min-h-screen items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-sm">
                <div class="mb-6 flex justify-center">
                </div>
                
                {{ $slot }}
            </div>
        </div>
        @fluxScripts
    </body>
</html>