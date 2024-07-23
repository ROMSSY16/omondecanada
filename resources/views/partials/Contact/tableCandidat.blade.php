<div class="card-body px-0 pb-2">
    <div class="table-responsive p-0" style="max-height: 750px; overflow-y: auto;">
        <table class="table align-items-center justify-content-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        NOM
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        NUMERO</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        PROFFESSION</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                        DATE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data_candidat as $candidat)
                    <tr>
                        <td>
                            <div class="d-flex px-2">
                                <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}</h6>
                            </div>
                        </td>
                        <td>
                            <p class="text-md font-weight-bold mb-0">{{ $candidat->numero_telephone }}</p>
                        </td>
                        <td>
                            <span class="text-md font-weight-bold">{{ $candidat->profession }}</span>
                        </td>
                        <td class="align-middle text-center">

                            <span class="text-md font-weight-bold">
                                {{ date('Y-m-d', strtotime($candidat->date_enregistrement)) }}
                            </span>

                        </td>
                        <td class="align-middle">
                            <button class="btn btn-link text-secondary mb-0" data-bs-toggle="modal"
                                data-bs-target="#modifierContactModal{{ $candidat->id }}">
                                <span class="material-icons text-xl">create</span> Modifier
                            </button>
                        </td>
                        @include('partials.Contact.modifierContact', ['candidat' => $candidat])
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
