<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ator extends Model
{
    protected $table = "atores";
    protected $fillable = ['nome', 'nacionalidade_id', 'dt_nascimento', 'inicio_atividades'];

    public function nacionalidade() {
        return $this->belongsTo("App\Nacionalidade");
    }
}
