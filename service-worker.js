self.addEventListener("install", event => {
    console.log("Service Worker Installed");
});

self.addEventListener("fetch", event => {
    // Default PWA fetch event
});
