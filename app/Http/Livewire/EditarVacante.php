<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{

    public $vacante_id;
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    public $imagenNueva;

    use WithFileUploads;

    protected $rules = [
        "titulo" => "required|string",
        "salario" => "required",
        "categoria" => "required",
        "empresa" => "required",
        "ultimo_dia" => "required",
        "descripcion" => "required",
        "imagenNueva" => "nullable|image|max:1024"
    ];


    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id; //ESTO NO VA JALAR
        $this->titulo = $vacante->titulo;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->empresa = $vacante->empresa;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format("Y-m-d");
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
    }

    public function editarVacante()
    {
        $datos = $this->validate();

        //Revisar si hay nueva imagen
        if($this->imagenNueva) {
            $imagen = $this->imagenNueva->store("public/vacantes");
            $datos["imagen"] = str_replace("public/vacantes/", "", $imagen);
        }

        //Encontrar la vacante a editar
        $vacante = Vacante::find($this->vacante_id);

        //Asignar los valores
        $vacante->titulo = $datos["titulo"];
        $vacante->salario_id = $datos["salario"];
        $vacante->categoria_id = $datos["categoria"];
        $vacante->empresa = $datos["empresa"];
        $vacante->ultimo_dia = $datos["ultimo_dia"];
        $vacante->descripcion = $datos["descripcion"];
        $vacante->imagen = $datos["imagen"] ?? $vacante->imagen;

        //Guardar cambios
        $vacante->save();

        //Crear un mensaje
        session()->flash('mensaje', 'Vacante actualizada correctamente');

        //Redireccionar
        return redirect()->route("vacantes.index");
    }

    public function render()
    {
        
        //Consultar la BD
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', [
            "salarios" => $salarios,
            "categorias" => $categorias
        ]);
    }
}
