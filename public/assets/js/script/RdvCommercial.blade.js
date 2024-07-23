function toggleConsultationPayee(id, statut) {
    fetch(`/Commercial/RendezVous/ConsultationPayee/${id}/${statut}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
        .then(response => {
            // Check if the response status is OK (status code 200-299)
            if (!response.ok) {
                throw new Error(`Network response was not ok (${response.status})`);
            }
            return response.json(); // Parse the response as JSON
        })
        .then(data => {
            console.log(data); // Log the parsed JSON data
            // Your code to handle jsonData
            location.reload(); // Reload the page
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function toggleStatutRendezVous(id, statut) {
    fetch(`/Commercial/RendezVous/RendezVousEffectue/${id}/${statut}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
        .then(response => {
            // Check if the response status is OK (status code 200-299)
            if (!response.ok) {
                throw new Error(`Network response was not ok (${response.status})`);
            }
            return response.json(); // Parse the response as JSON
        })
        .then(data => {
            console.log(data); // Log the parsed JSON data
            // Your code to handle jsonData
            location.reload(); // Reload the page
        })
        .catch(error => {
            console.error('Error:', error);
        });
}