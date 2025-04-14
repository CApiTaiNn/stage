document.addEventListener('DOMContentLoaded', function () {
    const alert = document.getElementById('alert');
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        }, 5000);
    }
});
