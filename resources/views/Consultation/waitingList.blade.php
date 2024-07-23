<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href={{ asset('assets/img/logos/logo-icon.png') }}>
    <title>Omonde Canada Crm | LISTE D'ATTENTE</title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('partials.navbar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('partials.header', ['page' => 'BIENVENUE CHEZ OMONDE CANADA'])
        <div class="col-12 d-flex align-items-top justify-content-center">
            <div class="col-8 d-flex align-items-center m-1">
                <video id="videoPlayer" width="1000" height="500" controls>
                    <source src="{{ asset('storage/videos/video1.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        
            <script>
                const videoPlayer = document.getElementById('videoPlayer');
                const videos = [
                    "{{ asset('storage/videos/video1.mp4') }}",
                    "{{ asset('storage/videos/video2.mp4') }}",
                    "{{ asset('storage/videos/video3.mp4') }}",
                    "{{ asset('storage/videos/video4.mp4') }}",
                    "{{ asset('storage/videos/video5.mp4') }}"
                ];
                let currentVideoIndex = 0;
        
                videoPlayer.addEventListener('ended', function() {
                    currentVideoIndex++;
                    if (currentVideoIndex < videos.length) {
                        videoPlayer.src = videos[currentVideoIndex];
                        videoPlayer.play();
                    }
                });
            </script>
            
            <div class="col-3">
                <div class="card my-4 bg-dark">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="material-icons-round text-primary me-2">person</i>
                                <span class="text-uppercase text-dark text-xl font-weight-bolder opacity-7"
                                    id="candidatName"></span>
                            </div>


                            <span class="text- text-center text-dark text-xl font-weight-bolder opacity-7"
                                id="candidatId"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="text-xl text-white font-weight-bold mb-0 mt-2" id="candidatNom"></h3>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-end p-4">
                        <button id="nextButton" class="btn btn-primary btn-sm">Next</button>
                    </div>

                </div>
            </div>

            <script>
                let currentIndex = 0;
                const candidats = @json($data_candidat);

                const candidatNameElement = document.getElementById('candidatName');
                const candidatNomElement = document.getElementById('candidatNom');
                const candidatIdElement = document.getElementById('candidatId');
                const nextButton = document.getElementById('nextButton');

                function showCandidat(index) {
                    const candidat = candidats[index];
                    if (candidat) {
                        candidatNameElement.textContent = candidat.pays;
                        candidatNomElement.textContent = candidat.nom + " " + candidat.prenom;
                        candidatIdElement.textContent = "N° " + (currentIndex + 1);
                    } else {
                        candidatContainer.innerHTML = 'No more candidats.';
                    }
                }

                nextButton.addEventListener('click', function() {
                    currentIndex = (currentIndex + 1) % candidats.length;
                    showCandidat(currentIndex);
                });

                // Show the initial candidat
                showCandidat(currentIndex);
            </script>






        </div>
        </tr>

        </tbody>
        </table>

    </main>
</body>

</html>
