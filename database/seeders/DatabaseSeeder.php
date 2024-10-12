<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call(AuthSeeder::class);
        $this->call(AnnouncementSeeder::class);

        //Tablas
        $this->call(DocumentoIdentidadSeeder::class);
        $this->call(EmpresaSeeder::class);
        $this->call(UbicacionTrabajoSeeder::class);
        $this->call(TablaUbicacionSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(TpaisesSeeder::class);
        $this->call(TdepartamentosSeeder::class);
        $this->call(TprovinciasSeeder::class);
        $this->call(TdistritosSeeder::class);
        $this->call(TplanillasSeeder::class);
        $this->call(TprofesionesSeeder::class);
        $this->call(TbancosSeeder::class);
        $this->call(TafpSeeder::class);
        $this->call(ConceptosSeeder::class);
        $this->call(CondicionLaboralSeeder::class);
        $this->call(NivelEducativoSeeder::class);
        $this->call(TablasSeeder::class);
        $this->call(UbigeosSeeder::class);
        $this->call(RegimenPensionarioSeeder::class);
        $this->call(TipoComisionSeeder::class);
        $this->call(TcargosSeeder::class);
        $this->call(TnivelesSeeder::class);
        $this->call(TipoMonedaSeeder::class);
		$this->call(UnidadTrabajosSeeder::class);
		$this->call(TipoOperacionSeeder::class);
		$this->call(TdiasFeriadosSeeder::class);
		$this->call(AreaTrabajosSeeder::class);
		$this->call(FormulaSeeder::class);
		$this->call(SubtplanillasSeeder::class);
		$this->call(ClienteUserTableSeeder::class);
		$this->call(ClienteEmpresaTableSeeder::class);
		
        Model::reguard();
    }
}
