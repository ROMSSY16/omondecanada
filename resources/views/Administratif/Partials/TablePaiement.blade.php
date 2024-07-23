
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3">
        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
            <div class="p-2 border-radius-lg w-40 bg-white">
              <input type="text " id="searchInput"
                class="form-control text-dark text-lg bg-transparent border-0 p-1"
                placeholder="Recherche...">
            </div>
            <button class="btn bg-primary text-white circle" data-bs-toggle="modal"
              data-bs-target="#ajouterEntreeModal">
              <i class="material-icons">add</i> Ajouter un paiement
            </button>
            @if ($hasPoste)
              <button class="btn bg-primary text-white circle" data-bs-toggle="modal"
                data-bs-target="#ajouterDepenseModal">
                <i class="material-icons">add</i> Ajouter une depense
              </button>
            @endif
          </div>
             @include('partials.Banque.addDepenses')
        @include('Administratif.Partials.AddEntree')
        </div>

        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0" style="min-height: 700px; max-height: 700px; overflow-y: auto;">
                <table class="table align-items-center justify-content-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase col-1 text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                Type
                            </th>
                            <th class="text-uppercase col-2 text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                Type de paiement / Raison depense
                            </th>

                            <th
                                class="text-uppercase col-3 text-secondary text-center text-xxs font-weight-bolder text-left opacity-7 ps-2">
                                Candidat / Agent
                            </th>

                            <th
                                class="text-uppercase col-2 text-secondary text-center text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                Date
                            </th>

                            <th
                                class="text-uppercase col-3 text-secondary text-center text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                Montant
                            </th>
                            <th
                            class="text-uppercase col-3 text-secondary text-center text-xxs font-weight-bolder text-center opacity-7 ps-2">
                            Imprimer
                        </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="text-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-{{ get_class($transaction) === 'App\Models\Depense' ? 'danger' : 'success' }} m-0 mb-0 p-0 btn-sm">
                                            <i class="material-icons text-lg">{{ get_class($transaction) === 'App\Models\Depense' ? 'expand_more' : 'expand_less' }}</i>
                                        </button>
                                    </td>
                                    <td class="align-middle text-center text-xl">
                                        {{ get_class($transaction) === 'App\Models\Depense' ? $transaction->raison : \App\Models\TypePaiement::where('id', $transaction->id_type_paiement)->value('label') }}
                                    </td>
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
                                            {{ number_format($transaction->montant, 0, ',', ' ') }} {{$devise }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('transactions.print', $transaction->id) }}" class="btn btn-icon btn-outline-primary">
                                            <i class="material-icons">print</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </tbody>

                </table>

            </div>
        </div>




    </div>
</div>

