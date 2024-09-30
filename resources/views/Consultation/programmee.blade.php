@extends('layouts.app')
@section('content')
<style>
    

    .type-document{
        width:100%; 
        margin-bottom:20px;
    }

    .documents {
        padding:20px;    
    }

    

    .document {
    float: left;
    width: calc(33% - 20px);
    max-width: 240px;
    margin: 0px 10px 20px;
    background-color: #fff;
    border-radius: 3px;
    border: 1px solid #dce2e9;
    }

    .document .document-body {
    height: 130px;
    text-align: center;
    border-radius: 3px 3px 0 0;
    background-color: #fdfdfe;
    }

    .document .document-body i {
    font-size: 85px;
    line-height: 120px;
    }

    .document .document-body img {
    width: 100%;
    height: 100%;
    }

    .document .document-footer {
    border-top: 1px solid #ebf1f5;
    height: 46px;;
    padding: 5px 12px;
    border-radius: 0 0 2px 2px;
    }

    .document .document-footer .document-name {
    display: block;
    margin-bottom: 0;
    font-size: 15px;
    font-weight: 600;
    width: 100%;
    line-height: normal;
    overflow-x: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    }

    .document .document-footer .document-description {
    display: block;
    margin-top: -1px;
    font-size: 11px;
    font-weight: 600;
    color: #8998a6;
    width: 100%;
    line-height: normal;
    overflow-x: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    }

    .document.info .document-footer >*, .document.success .document-footer >*,
    .document.danger .document-footer >*, .document.warning .document-footer >*,
    .document.dark .document-footer >* {
    color: #fff;
    }

    .document.dark .document-footer {
    background-color: #314557;
    }

    .folders {
    width: 100%;
    }

    .folders li {
    font-size: 14px;
    padding: 3px 4px 3px 12px;
    }

    .folders li a {
    text-decoration: none;
    color: #4a4d56;
    }

    .folders li a i {
    color: #5e6168;
    font-size: 16px;
    margin-right: 5px;
    }

    @media screen and (max-width: 600px) {
    .document  {
        width: 100%;
        margin: 5px 0;
        max-width: none;
    }
    }


   
</style>
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3">

                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3 d-flex align-items-center justify-content-between p-4">
                    <div class="p-2 border-radius-lg w-40 bg-white">
                        <input type="text " id="searchInput"
                            class="form-control text-dark  text-lg bg-transparent border-0 p-1"
                            placeholder="Recherche...">

                    </div>

                    <div class="d-flex align-items-center justify-content-around col-4">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                            
                    </div>
                    <div class="col-sm-8">
                        <div class="tab-pane active documents documents-panel">
                            @foreach ($consultations as $consultation)
                                <div class="document dark">
                                    <a href="{{ route('consultation.listcandidats',$consultation->id) }}" class="btn btn-primary m-1 w-100">
                                        <i class="material-icons">arrow_forward </i> Faire la consultation
                                    </a>
                                    <div class="document-body">
                                        <i class="fa fa-file-video-o text-dark"></i>
                                    </div>
                                    <div class="document-footer rounded-md">
                                        <span class="document-name text-white"> {{ ucwords(Carbon\Carbon::parse($consultation->date_heure)->translatedFormat('j F Y H:i')) }} </span>
                                        <span class="document-description"> {{ $consultation->candidats->count() }} / {{ $consultation->nombre_candidats }} </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                </div>

            </div>
        </div>
    </div>
</div>
        
       
@endsection