<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Candidat;

class SearchBar extends Component
{
    public $query = '';

    public function render()
    {
        $candidats = Candidat::where('nom', 'like', '%' . $this->query . '%')
                             ->orWhere('prenom', 'like', '%' . $this->query . '%')
                             ->paginate(10);

        return view('livewire.search-bar', ['candidats' => $candidats]);
    }
}
