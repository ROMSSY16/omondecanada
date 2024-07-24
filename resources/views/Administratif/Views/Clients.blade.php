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
                                class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                                placeholder="Rechercher un candidat...">
                        </div>

                    </div>


                    @include('Administratif.Partials.TableCandidats')

                </div>

                <div id="loading" class="loading-overlay">
                    <div class="loading-spinner"></div>
                </div>
                
            </div>
        </div>
    </div>
@endsection    

