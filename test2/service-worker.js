// btnAdd.addEventListener('click', (e) => {
//   // hide our user interface that shows our A2HS button
//   btnAdd.style.display = 'none';
//   // Show the prompt
//   deferredPrompt.prompt();
//   // Wait for the user to respond to the prompt
//   deferredPrompt.userChoice
//     .then((choiceResult) => {
//       if (choiceResult.outcome === 'accepted') {
//         console.log('User accepted the A2HS prompt');
//       } else {
//         console.log('User dismissed the A2HS prompt');
//       }
//       deferredPrompt = null;
//     });
// });

var cacheName = self.caches;
self.addEventListener('install', function(event) {
	 // console.log('serviceWorker Registed?');
  // event.waitUntil(
  //   caches.open(cacheName).then(function(cache) {
  //     return cache.addAll(
  //       [
  //         '/css/fireworks.css',
  //         '/js/fireworks.js',
  //         '/js/requestanimframe.js',
  //         '/offline.html'
  //       ]
  //     );
  //   })
  // );
});

// document.querySelector('.cache-article').addEventListener('click', function(event) {
//   event.preventDefault();
//   var id = this.dataset.articleId;
//   caches.open('mysite-article-' + id).then(function(cache) {
//     fetch('/get-article-urls?id=' + id).then(function(response) {
//       // /get-article-urls returns a JSON-encoded array of
//       // resource URLs that a given article depends on
//       return response.json();
//     }).then(function(urls) {
//       cache.addAll(urls);
//     });
//   });
// });

self.addEventListener('fetch', function(event) {
  event.respondWith(
  	caches.match(event.requst)
    // caches.open('mysite-dynamic').then(function(cache) {
    //   return cache.match(event.request).then(function (response) {
    //     return response || fetch(event.request).then(function(response) {
    //       cache.put(event.request, response.clone());
    //       return response;
    //     });
    //   });
    // })
  );

});

// self.addEventListener('fetch', function(event) {
//   event.respondWith(caches.match(event.request));
// });


// self.addEventListener('fetch', function(event) {
//   event.respondWith(fetch(event.request));
// });
	
// self.addEventListener('fetch', function(event) {
//   event.respondWith(
//     caches.match(event.request).then(function(response) {
//       return response || fetch(event.request);
//     })
//   );
// });
