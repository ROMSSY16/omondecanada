<div class="card my-2">
    <div class="bg-gradient-dark border-radius-lg pt-4 pb-2 d-flex align-items-center justify-content-between p-4">
        <div class="p-2 border-radius-lg w-40 bg-white">
            <input type="text" id="searchInput" class="form-control text-dark text-lg bg-transparent border-0 p-1"
                placeholder="Rechercher...">
        </div>

    </div>

    <div class="card-body px-0">
        <div class="table-responsive p-0" style="overflow-y: auto;">
            <table class="table align-items-center justify-content-center mb-0 dataTable">
                <thead>
                    <tr>
                        <th class=" col-md-1 text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            TYPE
                        </th>
                        <th class=" col-md-2 text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">TYPE
                            Type de paiement / Raison depense    
                        </th>
                        <th class=" col-md-2 text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                            Candidat / Agent    
                        </th>
                        <th class=" col-md-2 text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">
                            Date
                        </th>
                        <th class=" col-md-2 text-uppercase text-secondary text-xxs text-center font-weight-bolder opacity-7">DATE
                            MONTANT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donneesCandidat as $transaction)
                            <tr>
                                <td class="text-center">
                                    <button class="btn btn-icon-only btn-rounded btn-outline-{{ get_class($transaction) === 'App\Models\Depense' ? 'danger' : 'success' }} m-0 mb-0 p-0 btn-sm">
                                        <i class="material-icons text-lg">{{ get_class($transaction) === 'App\Models\Depense' ? 'expand_more' : 'expand_less' }}</i>
                                    </button>
                                </td>
                                
                                <td class="align-middle text-center text-xl">{{ get_class($transaction) === 'App\Models\Depense' ? $transaction->raison : \App\Models\TypePaiement::where('id', $transaction->id_type_paiement)->value('label') }}</td>
                                <td class="align-middle text-center">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="p-2 text-md">
                                            {{ $transaction->utilisateur->name }} {{ $transaction->utilisateur->last_name }}
                                        </h5>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="me-2 text-md font-weight-bold">{{ date('Y-m-d', strtotime($transaction->date)) }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <p class="text-md  font-weight-bold mb-0 text-{{ get_class($transaction) === 'App\Models\Depense' ? 'danger' : 'success' }}">
                                        {{ number_format($transaction->montant, 0, ',', ' ') }} {{ $transaction->utilisateur->succursale->id == 4 ? '$' : 'FCFA' }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
