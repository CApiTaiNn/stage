document.addEventListener('DOMContentLoaded', function () {
    const accountSimple = document.getElementById('account-simple');
    const compteContainer = document.getElementById('compte-container');

    // Afficher ou masquer compteContainer au clic sur accountSimple
    accountSimple.addEventListener('click', function (event) {
        event.stopPropagation(); // Empêche la propagation du clic vers le document
        compteContainer.classList.toggle('hidden');
        accountSimple.classList.toggle('hidden');
    });

    // Masquer compteContainer si on clique en dehors
    document.addEventListener('click', function (event) {
        if (!compteContainer.classList.contains('hidden') && 
            !compteContainer.contains(event.target) && 
            !accountSimple.contains(event.target)) {
            compteContainer.classList.add('hidden');
            accountSimple.classList.remove('hidden');
        }
    });
});