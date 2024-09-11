@extends('layouts.app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    .card-box {
        padding: 20px;
        border-radius: 3px;
        margin-bottom: 30px;
        background-color: #fff;
    }

    .file-man-box {
        padding: 20px;
        border: 1px solid #e3eaef;
        border-radius: 5px;
        position: relative;
        margin-bottom: 20px
    }

    .file-man-box .file-close {
        color: #f1556c;
        position: absolute;
        line-height: 24px;
        font-size: 24px;
        right: 10px;
        top: 10px;
        visibility: hidden
    }

    .file-man-box .file-img-box {
        line-height: 120px;
        text-align: center
    }

    .file-man-box .file-img-box img {
        height: 64px
    }

    .file-man-box .file-download {
        font-size: 32px;
        color: #98a6ad;
        position: absolute;
        right: 10px
    }

    .file-man-box .file-download:hover {
        color: #313a46
    }

    .file-man-box .file-man-title {
        padding-right: 25px
    }

    .file-man-box:hover {
        -webkit-box-shadow: 0 0 24px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02);
        box-shadow: 0 0 24px 0 rgba(0, 0, 0, .06), 0 1px 0 0 rgba(0, 0, 0, .02)
    }

    .file-man-box:hover .file-close {
        visibility: visible
    }
    .text-overflow {
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
        width: 100%;
        overflow: hidden;
    }
    h5 {
        font-size: 15px;
    }
</style>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3">
                    <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                        <div class="p-2 border-radius-lg w-40 bg-white">
                            <input type="text" id="searchInput" class="form-control text-dark text-lg bg-transparent border-0 p-1" placeholder="Recherche...">
                        </div>
                        <div class="d-flex align-items-center justify-content-around w-50">
                            <button class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#addDocumentModal"> <i class="material-icons">add</i> Ajouter un document </button>
                            <button class="btn bg-primary text-white circle" data-bs-toggle="modal" data-bs-target="#viewDocumentsModal{{$candidat->id}}"> <i class="material-icons">remove_red_eye</i> Voir son dossier</button>
                        </div>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card-body">
                                <h5 class="header-title m-b-30">Candidat</h5>
                                <h6 class="m-b-2 text-info">{{$candidat->nom}} {{$candidat->prenom}}</h6>
                            </div>
                            <div class="card-footer">
                                <h5 class="header-title m-b-30">Type de Visa</h5>
                                <h6 class="m-b-30 text-info">{{$candidat->typeProcedure->label}}</h6>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="row">
                                @if (count($documents) == 0)
                                    <h4 class="header-title m-b-30 text-danger">Aucun document !</h4>
                                @else
                                    <div class="col-12">
                                        <div class="card-box">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                    <h4 class="header-title m-b-30">Les documents</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    @foreach ($documents as $document)
                                                        <div class="col-lg-3 col-xl-3">
                                                            <div class="file-man-box">
                                                                <a class="file-close" onclick="confirmDelete({{ $document->id }})"><i class="fa fa-times-circle"></i></a>
                                                                
                                                                <div class="file-img-box">
                                                                    <img src="https://coderthemes.com/highdmin/layouts/assets/images/file_icons/pdf.svg" alt="icon">
                                                                </div>
                                                                <a href="{{ asset($document->url) }}" class="file-download" download><i class="fa fa-download"></i></a>

                                                                <div class="file-man-title">
                                                                    <h5 class="mb-0 text-overflow">{{ $document->nom }}</h5>
                                                                    <p class="mb-0"><small>{{ number_format(filesize(public_path($document->url)) / 1024, 2) }} KB</small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form id="delete-document" action="{{route('client.document.delete', $document->id)}}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- modal add document --}}
        <div class="modal z-index-1 fade" id="addDocumentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('client.add_document', $candidat->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-2">
                                        <label for="nom" class="form-label">Titre du document</label>
                                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" placeholder="Ex: Fiche de consultation"required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer le titre du document .
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="file" class="form-label">Telecharger le fichier</label>
                                    <input class="form-control" type="file" name="document_url">
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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

        function confirmDelete(documentId) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez-vous vraiment supprimer ce document?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.getElementById('delete-document');
                    form.submit();
                }
            });
        }

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
