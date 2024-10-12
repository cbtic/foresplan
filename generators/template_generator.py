from jinja2 import Template
from genshi.template import TextTemplate
import re
import sys
import sqlalchemy as db
from sqlalchemy import *
import os
from dotenv import load_dotenv

load_dotenv()

#DB_HOST = os.getenv('DB_HOST')
DB_HOST='localhost'
DB_PORT = os.getenv('DB_PORT')
DB_DATABASE = os.getenv('DB_DATABASE')
DB_USERNAME = os.getenv('DB_USERNAME')
DB_PASSWORD = os.getenv('DB_PASSWORD')

# archivo = sys.argv[1]
tabla = sys.argv[1]

modelo = tabla[0:len(tabla)-1] if tabla[-1]=="s" else tabla

engine = db.create_engine('postgresql://'+DB_USERNAME+':'+DB_PASSWORD+'@'+DB_HOST+':'+DB_PORT+'/'+DB_DATABASE)

inspector = inspect(engine)
campos = inspector.get_columns(tabla)

result = map(lambda x: "" if x['name'] == "updated_at" or x['name'] == "created_at" or x['name'] == "id" else x, campos)
campos_filtrados=list(result)
campos_filtrados=[x for x in campos_filtrados if x]

# print(campos_filtrados)
campos_plantilla=[]

for campo in campos_filtrados:
    if isinstance(campo['type'], BIGINT):
        campo_plantilla={'new_type':'integer', 'form_type':'number'}
    if isinstance(campo['type'], INT):
        campo_plantilla={'new_type':'integer', 'form_type':'number'}
    elif isinstance(campo['type'], DATE):
        campo_plantilla={'new_type':'date', 'form_type':'text'}
    elif isinstance(campo['type'], VARCHAR):
        campo_plantilla={'new_type':'string:'+str(campo['type'].length), 'form_type':'text', 'max_lenght':str(campo['type'].length)}
    elif isinstance(campo['type'], DATETIME):
        campo_plantilla={'new_type':'datetime', 'form_type':'text'}
    elif isinstance(campo['type'], TIMESTAMP):
        campo_plantilla={'new_type':'datetime', 'form_type':'text'}
    elif isinstance(campo['type'], BOOLEAN):
        campo_plantilla={'new_type':'boolean', 'form_type':'text'}
    campos_plantilla.append(campo_plantilla)

campos_plantilla_final=[]
for idx, campo_plantilla in enumerate(campos_plantilla):
    campos_plantilla_final.append(campos_filtrados[idx] | campo_plantilla)

# print(campos_plantilla_final)

# Funcion para generar clases
def genera_class(archivo_plantilla,path="app/Http/Livewire/"):
    plantilla = open(archivo_plantilla).read()
    t = Template(plantilla)
    codigo = t.render(Model_name=modelo, campos=campos_plantilla_final)
    filename = modelo.title().replace("_","")+archivo_plantilla.split("class")[1]
    file1 = open((path+filename).replace(".tpl",""),"w+")
    file1.write(codigo)
    file1.close()

# Funcion para generar plantillas
def genera_blade(archivo_plantilla,path="resources/views/livewire/"):
    plantilla = open(archivo_plantilla,"r").read()
    tmpl = TextTemplate(plantilla)
    codigo = tmpl.generate(Model_name=modelo, campos=campos_plantilla_final).render(encoding=None)

    filename = modelo.title().replace("_","-")+archivo_plantilla.split("/")[2]
    pattern = re.compile(r'(?<!^)(?=[A-Z])')
    filename = pattern.sub('-', filename).lower()
    file1 = open((path+filename).replace("parent","").replace(".tpl","").replace("-.",".").replace("--","-"),"w+")
    file1.write(codigo)
    file1.close()

# Livewire Class files
genera_class("generators/templates/classFormRegistration.php.tpl")

genera_class("generators/templates/classTable.php.tpl")

# Blade templates
genera_blade("generators/templates/FormRegistration.blade.php.tpl")

genera_blade("generators/templates/Parent.blade.php.tpl","resources/views/frontend/manten/")

# Plantilla blade necesaria para evitar error de falta de archivo blade
file2 = open(("resources/views/livewire/"+modelo+"-table.blade.php"),"w+")
file2.write("<div>\n{{-- Nothing in the world is as soft and yielding as water. --}}\n</div>")
file2.close()

# Usando generador de Laravel para crear controlador y modelo
model_name = modelo.title().replace("_","")
#laravel_command = "php artisan make:controller Frontend/"+model_name+"Controller --model="+model_name+" --resource --force"
#laravel_command = "php artisan make:controller Frontend/"+model_name+"Controller --resource --force"
laravel_command = "php artisan make:controller Frontend/"+model_name+"Controller --force"
print(laravel_command)
os.system(laravel_command)

# Modificando el Modelo para incluir los "protected $fillable"

fillable = "protected $fillable = ['"
for campo in campos_plantilla_final:
    fillable += campo['name'] + "','"
fillable += "'];"
fillable = fillable.replace(",''","")

file3 = open("app/Models/"+model_name+".php", "r")
with file3 as sources:
    lines = sources.readlines()
file3 = open("app/Models/"+model_name+".php", "w")
with file3 as sources:
    for line in lines:
        sources.write(re.sub('{', '{\n    '+fillable+'\n', line))
file3.close()

# Modificando el Controlador para tener la vista index: return view('frontend.manten.nombre_de_la_tabla');
file4 = open("app/Http/Controllers/Frontend/"+model_name+"Controller.php", "r")
with file4 as sources:
    lines = sources.readlines()

file4 = open("app/Http/Controllers/Frontend/"+model_name+"Controller.php", "w")
with file4 as sources:
    for line in lines:
        if (line.find('index()') != -1):
            sources.write("    public function index()\n    {\n")
            sources.write("        return view('frontend.manten."+modelo.replace("_","-")+"');")
        else: 
            sources.write(line)
file4.close()

file4 = open("app/Http/Controllers/Frontend/"+model_name+"Controller.php", "r")
with file4 as sources:
    lines = sources.readlines()

file4 = open("app/Http/Controllers/Frontend/"+model_name+"Controller.php", "w")
with file4 as sources:
    for line in lines:
        sources.write(re.sub('\);    {',');',line))
file4.close()

# Para incluir en la ruta de routes/frontend/home.php
importar_modelo = "use App\Http\Controllers\Frontend\\"+modelo.title().replace("_","")+"Controller;"
ruta_nueva = "Route::get('manten/"+tabla.replace("_","-")+"', ["+modelo.title().replace("","")+"Controller::class, 'index'])->name('manten."+tabla.replace("_","-")+"');"

file5 = open("routes/frontend/home.php", "r")
with file5 as sources:
    lines = sources.readlines()

file5 = open("routes/frontend/home.php", "w")
with file5 as sources:
    for line in lines:
        if (line.find('# Fin importacion de Modelos') != -1):
            sources.write(importar_modelo)
            sources.write("\n")
            sources.write(line)
        elif (line.find('# Fin rutas de mantenimiento') != -1):
            sources.write(ruta_nueva)
            sources.write("\n")
            sources.write(line)
        else:
            sources.write(line)

file5.close()