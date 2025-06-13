<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body class="bg-gray-100 min-h-screen flex flex-col items-center py-10 px-4">
    <div class="w-4/5 mx-auto">
        {{ $slot }}
    </div>
  </body>
</html>