@extends('layouts.app')
@section('content')
    <style>
        .folder-card {
            background-color: #f8f9fa;
            border: 1px solid #e91e63;
            transition: transform 0.2s;
        }
        .folder-card:hover {
            transform: scale(1.05);
        }
        .folder-icon {
            font-size: 80px;
            color: #e91e63;
            cursor: pointer;
        }
        .card-title {
            font-weight: bold;
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
        }
        .full-name {
            display: none; 
            width: 100%;
            background-color: #f8f9fa;
            padding: 5px;
            border: 1px solid #e91e63;
            position: absolute;
            z-index: 1;
            left: 0;
            top: 100%;
            text-align: left;
            font-weight: bold;
            border-radius: 10px;
        }
        .card-title-container {
            position: relative; 
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
                            <button id="all" class="btn btn-primary filter-btn">Tous</button> 
                            @foreach ($typeProcedures as $type)
                                <button id="{{ $type->label }}" class="btn btn-primary filter-btn">{{ $type->label }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-4">
                        @foreach ($dossier_clients as $item)
                            <div class="col mb-2">
                                <div class="card folder-card text-center" data-type="{{ $item->typeProcedure->label }}">
                                    <div class="card-body">
                                        <a href="{{ route('client.dossier_detail', $item->id) }}">
                                            <i class="material-icons folder-icon">folder_shared</i>
                                        </a>
                                        <div class="card-title-container">
                                            <h6 class="card-title mt-1" onclick="toggleFullName(this)">{{ $item->candidat->nom }} {{ $item->candidat->prenom }}</h6>
                                            <div class="full-name">
                                                <span>{{ $item->candidat->nom }} {{ $item->candidat->prenom }}</span><br>
                                                <small class="text-muted">{{ $item->typeProcedure->label }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFullName(titleElement) {
            const fullNameElement = titleElement.nextElementSibling;
            if (fullNameElement.style.display === 'none' || fullNameElement.style.display === '') {
                fullNameElement.style.display = 'block';
            } else {
                fullNameElement.style.display = 'none';
            }
        }

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

        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                let filter = this.id;
                let folderCards = document.querySelectorAll('.folder-card');

                folderCards.forEach(card => {
                    if (filter === 'all' || card.getAttribute('data-type') === filter) {
                        card.parentElement.style.display = '';
                    } else {
                        card.parentElement.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
