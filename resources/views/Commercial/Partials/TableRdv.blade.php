<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3">
                <div
                    class="bg-gradient-dark shadow-primary border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                    <div class="p-2 border-radius-lg w-100 d-flex flex-direction-row justify-content-between ">
                        <h3 class="text-white">
                            Rendez-vous du jour
                        </h3>

                        <a href="{{ route('Commercial.RendezVous') }}" class="btn btn-primary">
                            Voir tout
                        </a>
                    </div>
                </div>

                <div class="card-body px-0 pb-2 ">
                    <div class="table-responsive p-0  " style="max-height: 750px; overflow-y: auto;">
                        <table class="table align-items-center justify-content-between mb-0 bg-white">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-left text-secondary text-xxs font-weight-bolder opacity-7">
                                        NOM
                                    </th>
                                    <th
                                        class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NUMERO
                                    </th>
                                    <th
                                        class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        PROFFESSION
                                    </th>

                                    <th
                                        class="text-uppercase  text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        DATE DE RDV
                                    </th>



                                   

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($rendezVous as $candidat)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <h6 class="p-2 text-md">{{ $candidat->nom }} {{ $candidat->prenom }}
                                                </h6>
                                            </div>
                                        </td>

                                        <td>
                                            <p class="text-md font-weight-bold mb-0">{{ $candidat->numero_telephone }}
                                            </p>
                                        </td>

                                        <td>
                                            <span class="text-md font-weight-bold">{{ $candidat->profession }}</span>
                                        </td>

                                       

                                        <td>
                                            @php
                                                $carbonDate = \Carbon\Carbon::parse($candidat->rendezVous->date_rdv);
                                                $formattedDate = ucwords($carbonDate->translatedFormat('l j F Y'));
                                            @endphp
                                            <span class="text-md font-weight-bold">{{ $formattedDate ?? 'Pas de rdv' }}</span>
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
