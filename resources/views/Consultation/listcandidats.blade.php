@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card my-4">

            <div class="card-header p-0 position-relative mt-n4 mx-3">

                <div
                    class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                    <div class="p-2 border-radius-lg w-40 bg-white">
                        <input type="text " id="searchInput"
                            class="form-control text-dark text-lg bg-transparent border-0 p-1"
                            placeholder="Recherche...">
                    </div>
                </div>
            </div>


            <div class="table-responsive p-0" style="max-height: 700px; min-height: 700px; overflow-y: auto;">
                <table class="table align-items-center justify-content-center mb-0" id="candidatsTable">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                N°
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                NOM
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                PRENOMS
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                PROFESSION
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                VOIR FICHE DE CONSULTATION
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                CONSULTATION EFFECTUÉE
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($info_consultation->candidats as $candidat)
                            <tr data-candidat-id="{{ $candidat->id }}">
                                <td class="text-md text-bold ps-4" style="width: 5%;">
                                    N° {{ $loop->iteration }}
                                </td>
                                <td class="text-md  ps-4" style="width: 15%;">
                                    {{ $candidat->nom }}
                                </td>
                                <td class="text-md  ps-4" style="width: 15%;">
                                    {{ $candidat->prenom }}
                                </td>
                                <td class="text-md  ps-4" style="width: 15%;">
                                    {{ $candidat->profession }}
                                </td>
                                <td style="width: 20%;">
                                    <button class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#viewDocumentsModal{{$candidat->id}}"> <i class="material-icons">remove_red_eye</i> Voir son dossier</button>
                                </td>

                                <td class="text-center" style="width: 20%;">
                                    <div class="d-flex align-items-center justify-content-around">
                                        @role('consultante')
                                            <a href="{{ route('consultation.candidat', ['id' => $info_consultation->id, 'id_candidat' => $candidat->id]) }}" class="btn btn-primary">
                                                <i class="material-icons">visibility</i> Faire la consultation
                                            </a>
                                        @endrole
                                    </div>
                                </td>
                            </tr>

                            <div class="modal z-index-1 fade" id="viewDocumentsModal{{ $candidat->id }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Dossier de : {{$candidat->nom}} {{$candidat->prenom}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="pdfViewer">
                                                <!-- This will be dynamically updated -->
                                                <iframe id="pdfFrame" width="100%" height="500px"></iframe>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button id="prevDoc" class="btn btn-secondary">Previous</button>
                                                <button id="nextDoc" class="btn btn-secondary">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
       
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let folderCards = document.querySelectorAll('.folder-card');

            folderCards.forEach(card => {
                let title = card.querySelector('.card-title').textContent.toLowerCase();
                if (title.includes(filter)) {
                    card.parentElement.style.display = '';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let documents = @json($documents);
            let currentIndex = 0;

            function showDocument(index) {
                if (index >= 0 && index < documents.length) {
                    document.getElementById('pdfFrame').src = `{{ asset('') }}${documents[index].url}`;
                }
            }

            document.getElementById('prevDoc').addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    showDocument(currentIndex);
                }
            });

            document.getElementById('nextDoc').addEventListener('click', function() {
                if (currentIndex < documents.length - 1) {
                    currentIndex++;
                    showDocument(currentIndex);
                }
            });
            showDocument(currentIndex);
        });
    </script>
@endsection