// Handle box click
function openPage(page) {
    console.log("Opening: " + page);
    window.location.href = page; 
}

// Register service worker
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("service-worker.js")
        .then(() => console.log("Service Worker Registered"));
}
