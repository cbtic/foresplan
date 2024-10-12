<?php

namespace App\Http\Livewire;

use App\Models\{{ Model_name.title().replace("_","") }} as {{ Model_name }}s;
use Livewire\Component;

class {{ Model_name.title().replace("_","") }}FormRegistration extends Component
{
    public ${{ Model_name.lower() }}_registration_id;
    {% for campo in campos %}
    public ${{ campo.name }};{% endfor %}
    public $updateMode = false;

    protected $listeners = ['edit','update','delete','cancel'];

    public function edit($id)
    {
        $this->updateMode = true;
        $tabla = {{ Model_name.title().replace("_","") }}s::where('id',$id)->first();
        $this->{{ Model_name.lower() }}_registration_id = $id;
   
        {% for campo in campos %}$this->{{ campo.name }} = $tabla->{{ campo.name }};
        {% endfor %}

    }
    
public function store()
    {
        $validatedData = $this->validate([
            {% for campo in campos %}'{{ campo.name }}' => '{{ "nullable" if campo.nullable else "required" }}{{ "|max:"+campo.new_type.split(":")[1] if (campo.new_type.split(":")).count("string")>0 else "" }}',
            {% endfor %}
        ]);

        {{ Model_name }}s::create($validatedData);

        session()->flash('message', 'Se guardaron los datos correctamente.');

        $this->emitTo('{{ Model_name.lower() }}-table', '$refresh');

        $this->resetInputFields();

    }

    public function cancel(){
        $this->updateMode = false;
        $this->resetInputFields();
    }

    private function resetInputFields(){
        
        {% for campo in campos %}$this->{{ campo.name }} = '';
        {% endfor %}
    }

    public function update()
    {
        $validatedData = $this->validate([
            {% for campo in campos %}'{{ campo.name }}' => '{{ "nullable" if campo.nullable else "required" }}{{ "|max:"+campo.new_type.split(":")[1] if (campo.new_type.split(":")).count("string")>0 else "" }}',
            {% endfor %}
        ]);

        if ($this->{{ Model_name.lower() }}_registration_id) {
            $tabla = {{ Model_name }}s::find($this->{{ Model_name.lower() }}_registration_id);
            $tabla->update($validatedData);
            $this->updateMode = false;
            // error_log(json_encode($validatedData));
            session()->flash('message', 'Actualizacion exitosa.');
            $this->resetInputFields();

            $this->emitTo('{{ Model_name.lower() }}-table', '$refresh');
        }
    }

    public function delete($id)
    {
        if($id){
            {{ Model_name.title() }}s::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
            
            $this->emitTo('{{ Model_name.lower() }}-table', '$refresh');
        }
    }

    public function render()
    {
        return view('livewire.{{ Model_name.replace("_","-") }}-form-registration');
    }
}

