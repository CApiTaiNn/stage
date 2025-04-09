document.addEventListener('DOMContentLoaded', function () {
    const filterForm = document.getElementById('filter-form');
    const filterButton = document.getElementById('filter-button');


    filterButton.addEventListener('click', function (event) {
        event.stopPropagation(); 
        filterForm.classList.toggle('hidden');
    });

    // Masquer le formulaire si on clique ailleurs
    document.addEventListener('click', function (event) {
        if (!filterForm.classList.contains('hidden')) {
            filterForm.classList.add('hidden');
        }
    });

    // Empêcher la fermeture si on clique à l'intérieur du formulaire
    filterForm.addEventListener('click', function (event) {
        event.stopPropagation();
    });
});