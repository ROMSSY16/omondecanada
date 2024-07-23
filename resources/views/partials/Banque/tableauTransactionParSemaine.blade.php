<div class="row">
    <div class="col-md-12 mt-6">
        <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="mb-0">TRANSACTIONS</h6>
                    </div>
                   
                </div>
            </div>
            

            <div class="card-body pt-4 p-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Type de paiement / Raison depense</th>
                            <th>Candidat / Agent</th>
                            <th>Date</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ((new \App\Http\Controllers\Controller)->getAllTransactions() as $transaction)
                        <tr>
                                <td>
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-{{ get_class($transaction) === 'App\Models\Depense' ? 'danger' : 'success' }} mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                                        <i
                                            class="material-icons text-lg">{{ get_class($transaction) === 'App\Models\Depense' ? 'expand_more' : 'expand_less' }}</i>
                                    </button>
                                </td>
                                
                                <td>{{ get_class($transaction) === 'App\Models\Depense' ? $transaction->raison : \App\Models\TypePaiement::where('id', $transaction->id_type_paiement)->value('label') }}
                                </td>
                                <td>{{ $transaction->date }}</td>
                                <td>{{ $transaction->utilisateur->name }} {{ $transaction->utilisateur->last_name }}
                                </td>
                                <td
                                    class="{{ get_class($transaction) === 'App\Models\Depense' ? 'text-danger' : 'text-success' }} text-gradient text-sm font-weight-bold">
                                    {{ number_format(abs($transaction->montant), 0, ',', ' ') }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
