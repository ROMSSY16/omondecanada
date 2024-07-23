<div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
    <div class="p-2 border-radius-lg w-40 bg-white">
        <input type="text" id="searchInput" class="form-control text-white text-lg bg-transparent border-0 p-1"
            placeholder="Rechercher...">
    </div>
    
    <div class="p-2 d-flex align-items-center w-30 justify-content-around flex-direction-row">
        <button class="btn bg-gradient-dark" onclick="filtrerCandidats('Consultation effectuée')">Consultation effectuée</button>
        <button class="btn bg-gradient-dark" onclick="afficherTousLesCandidats()">Tous les candidats</button>
    </div>
</div>