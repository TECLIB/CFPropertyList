---
---
self.addEventListener('install', function(e) { 
  
  {% assign name = site.github.project_title | replace: "flyve-mdm-", "" %} 
    
  var CACHE_NAME = '{{ site.data.config.cache_version }}'

  caches.keys().then(function(cacheNames) {
    return Promise.all(
      cacheNames.map(function(cacheName) {
        if(cacheName != CACHE_NAME) {
          return caches.delete(cacheName)
        }
      })
    )
  })
  
  e.waitUntil(
    caches.open(CACHE_NAME).then(function(cache) {
      return cache.addAll([
        '{{ site.baseurl }}/',
        '{{ site.baseurl }}/?homescreen=1',
        '{{ "/index.html" | absolute_url }}',
        '{{ "/index.html" | absolute_url }}?homescreen=1',
        '{{ "/css/flyve-mdm.min.css" | absolute_url }}',
        '{{ "/css/main.css" | absolute_url }}',
        '{{ "/css/syntax.css" | absolute_url }}',
        '{{ "/images/typo.png" | absolute_url }}',
        '{{ "/images/logo.png" | absolute_url }}',
        '{{ "/js/app.js" | absolute_url }}',
        '{{ "/js/jquery.min.js" | absolute_url }}',
        '{{ "/js/bootstrap.min.js" | absolute_url }}',
        '{{ "/manifest.json" | absolute_url }}',
        '{{ "/fonts/glyphs/winjs-symbols.ttf" | absolute_url }}',
        '{{ "/fonts/selawk.ttf" | absolute_url }}',
        '{{ "/fonts/selawkl.ttf" | absolute_url }}',
        '{{ "/fonts/selawksl.ttf" | absolute_url }}'
      ])
    })
  )
})

self.addEventListener('fetch', function(event) {
  console.log(event.request.url)
  event.respondWith(
    caches.match(event.request).then(function(response) {
      return response || fetch(event.request)
    })
  )
})
