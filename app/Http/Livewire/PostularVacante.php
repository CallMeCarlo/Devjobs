<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{

    public $cv;
    public $vacante;

    use WithFileUploads;

    protected $rules = [
        "cv" => "required|mimes:pdf" 
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }

    public function postularme()
    {
        $datos = $this->validate();

        //Almacenar CV en el disco duro
        $cv = $this->cv->store("public/cv");
        $datos["cv"] = str_replace("public/cv/", "", $cv);

        if($this->vacante->candidatos()->where('user_id', auth()->user()->id)->count() > 0) {
            session()->flash('mensaje', 'Ya estabas postulado a esta vacante');
        } else {
        //Crear la postulacion
        $this->vacante->candidatos()->create([
            "user_id" => auth()->user()->id,
            "cv" => $datos["cv"]
        ]);

        //Crear la notificación y enviar el email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        //Mostrar al usuario un mensaje de que todo se envio correctamente
        session()->flash('mensaje', 'Se ha enviado tu información, mucho éxito!');
        //Redireccionar
        return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
