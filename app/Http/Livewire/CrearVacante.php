<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules = [
        "titulo" => "required|string",
        "salario" => "required",
        "categoria" => "required",
        "empresa" => "required",
        "ultimo_dia" => "required",
        "descripcion" => "required",
        "imagen" => "required|image|max:1024"
    ];

    public function crearVacante()
    {
        $datos = $this->validate();

        //Almacenar la imagen
        $imagen = $this->imagen->store("public/vacantes");
        $nombreImagen = str_replace("public/vacantes/", "", $imagen);

        //Crear la vacante
        Vacante::create([
            'titulo' => $datos["titulo"],
            'salario_id' => $datos["salario"],
            'categoria_id' => $datos["categoria"],
            'empresa' => $datos["empresa"],
            'ultimo_dia' => $datos["ultimo_dia"],
            'descripcion' => $datos["descripcion"],
            'imagen' => $nombreImagen,
            'user_id' => auth()->user()->id
        ]);

        //Crear un mensaje
        session()->flash('mensaje', 'Vacante creada correctamente');

        //Redireccionar
        return redirect()->route("vacantes.index");
    }

    public function render()
    {
    
        //Consultar la BD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]);
    }
}
