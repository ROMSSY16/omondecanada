<div class="row col-lg-12 p-2">
    <div class="col-lg-12 col-md-10">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Historique des paiements</h4>
                        <p class="text-sm mb-0">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">10 derniers paiements</span>
                        </p>
                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-secondary"></i>
                            </a>
                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                <li><a class="dropdown-item border-radius-md" href="javascript:;">Voir liste
                                        complète</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $utilisateurConnecte = Auth::user();
                $entries = \App\Models\Entree::whereHas('candidat.utilisateur', function ($query) use ($utilisateurConnecte) {
                    $query->where('id_succursale', $utilisateurConnecte->id_succursale);
                })
                    ->orderBy('date', 'desc')
                    ->take(10)
                    ->get();
            @endphp

            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entries as $entry)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-md">{{ $entry->candidat->nom }}
                                                    {{ $entry->candidat->prenom }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-md font-weight-bold mb-0">
                                            {{ number_format($entry->montant, 0, ',', ' ') }} FCFA </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-md font-weight-bold">{{ $entry->typePaiement->label }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="me-2 text-md font-weight-bold">{{ date('Y-m-d', strtotime($entry->date)) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>