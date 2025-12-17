<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Sede;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class SedeService extends BaseService
{
    /**
     * SedeService constructor.
     *
     * @param  Sede  $sede
     */
    public function __construct(Sede $sede)
    {
        $this->model = $sede;
    }

    /**
     * Crear sede.
     *
     * @param  array  $data
     * @return Sede
     *
     * @throws \Throwable
     */
    public function store(array $data = []): Sede
    {
        return DB::transaction(function () use ($data) {
            $userId = auth()->id();

            $attributes = [
                'denominacion'         => $data['denominacion'],
                'estado'               => $data['estado'] ?? 1,
                'es_principal'         => !empty($data['es_principal']),
                'id_usuario_inserta'   => $userId,
                'id_usuario_actualiza' => $userId,
            ];

            /** @var Sede $sede */
            $sede = $this->model::create($attributes);

            if (! $sede) {
                throw new GeneralException(__('No se pudo crear la sede.'));
            }

            return $sede;
        });
    }

    /**
     * Actualizar sede.
     *
     * @param  Sede  $sede
     * @param  array  $data
     * @return Sede
     *
     * @throws \Throwable
     */
    public function update(Sede $sede, array $data = []): Sede
    {
        return DB::transaction(function () use ($sede, $data) {
            $userId = auth()->id();

            $attributes = [
                'denominacion'         => $data['denominacion'],
                'estado'               => $data['estado'] ?? $sede->estado,
                'es_principal'         => !empty($data['es_principal']),
                'id_usuario_actualiza' => $userId,
            ];

            if (! $sede->update($attributes)) {
                throw new GeneralException(__('No se pudo actualizar la sede.'));
            }

            return $sede;
        });
    }

    /**
     * Soft delete.
     *
     * @param  Sede  $sede
     * @return bool
     *
     * @throws GeneralException
     */
    public function destroy(Sede $sede): bool
    {
        if (! $sede->delete()) {
            throw new GeneralException(__('No se pudo eliminar la sede.'));
        }

        return true;
    }
}
