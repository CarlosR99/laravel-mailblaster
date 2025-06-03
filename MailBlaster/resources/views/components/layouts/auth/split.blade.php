<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased">
        <div class="grid min-h-screen grid-cols-1 lg:grid-cols-2">
            <div class="hidden lg:flex lg:items-center lg:justify-center lg:bg-indigo-600 lg:p-10">
                <div class="max-w-md text-center text-white">

                    @php
                        [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                    @endphp

                    <div class="space-y-4">
                        <blockquote class="space-y-2">
                            <p class="text-xl font-medium">&ldquo;{{ trim($message) }}&rdquo;</p>
                            <footer class="text-sm">{{ trim($author) }}</footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-center p-6 md:p-10">
                <div class="w-full max-w-sm">
                    <div class="mb-6 flex justify-center lg:hidden">
                    </div>
                    
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>