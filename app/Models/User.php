<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use App\Models\Candidat;
use App\Models\RendezVous;
use App\Models\Succursale;
use App\Models\PosteOccupe;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'last_name',
        'name',
        'email',
        'password',
        'id_poste_occupe',
        'id_role_utilisateur',
        'id_succursale',
        'lien_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function fullName() : string
    {
        return strtoupper($this->name) . ' ' . ucfirst(strtolower($this->last_name));
    }

    public function posteOccupe()
    {
        return $this->belongsTo(PosteOccupe::class, 'id_poste_occupe');
    }

    public function candidat()
    {

        return $this->hasOne(Candidat::class);
    }

    public function succursale()
    {
        return $this->belongsTo(Succursale::class, 'id_succursale');
    }

    public function poste()
    {
        return $this->id_poste_occupe;
    
        }

    public function isUserSimple()
    {
        return $this->id_poste_occupe === 1;
    }

    /**
     * Vérifie si l'utilisateur est un consultant.
     *
     * @return bool
     */
    public function isConsultant()
    {
        return $this->id_poste_occupe === 0;
    }

    /**
     * Vérifie si l'utilisateur est un administrateur.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->id_poste_occupe === 3;
    }

    public function isResp()
    { {
            return $this->id_poste_occupe === 2;
        }
    }

    public function poste_occupe()
    {
        return $this->belongsTo(PosteOccupe::class, 'id_poste_occupe');
    }

    /**
     * Récupère le rôle de l'utilisateur (0, 1, 2).
     *
     * @return int
     */
    public function getRole()
    {
        return $this->id_role_utilisateur;
    }

    public function getUsersByRole($roleId)
    {
        // Utilisez Eloquent pour récupérer les utilisateurs ayant le rôle spécifié
        $utilisateurs = User::where('id_role_utilisateur', $roleId)->get();

        return $utilisateurs;
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class, 'commercial_id');
    }
    public function candidats()
    {
        return $this->hasMany(Candidat::class, 'id_utilisateur');
    }
	
	  public function roles():BelongsToMany 
    {
		    return $this->belongsToMany(Role::class,'users_roles', 'user_id', 'role_id', 'id');
	  }
	  

}
