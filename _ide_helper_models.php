<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Domains\Auth\Models{
/**
 * Class PasswordHistory.
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordHistory whereUpdatedAt($value)
 */
	class PasswordHistory extends \Eloquent {}
}

namespace App\Domains\Auth\Models{
/**
 * Class Permission.
 *
 * @property int $id
 * @property string $type
 * @property string $guard_name
 * @property string $name
 * @property string|null $description
 * @property int|null $parent_id
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $children
 * @property-read int|null $children_count
 * @property-read Permission|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Auth\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Auth\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission isChild()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission isMaster()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission isParent()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission singular()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Domains\Auth\Models{
/**
 * Class User.
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $password_changed_at
 * @property bool $active
 * @property string|null $timezone
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property string|null $last_login_ip
 * @property bool $to_be_logged_out
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $avatar
 * @property-read string $permissions_label
 * @property-read string $roles_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Auth\Models\PasswordHistory> $passwordHistories
 * @property-read int|null $password_histories_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Auth\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Auth\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \DarkGhostHunter\Laraguard\Eloquent\TwoFactorAuthentication $twoFactorAuth
 * @method static \Illuminate\Database\Eloquent\Builder|User admins()
 * @method static \Illuminate\Database\Eloquent\Builder|User allAccess()
 * @method static \Illuminate\Database\Eloquent\Builder|User byType($type)
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyActive()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyDeactivated()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User search($term)
 * @method static \Illuminate\Database\Eloquent\Builder|User users()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordChangedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereToBeLoggedOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail, \DarkGhostHunter\Laraguard\Contracts\TwoFactorAuthenticatable, \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models{
/**
 * App\Models\Almacene
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $denominacion
 * @property string|null $id_ubigeo
 * @property string|null $direccion
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $telefono
 * @property string|null $encargado
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Seccione> $secciones
 * @property-read int|null $secciones_count
 * @property-read \App\Models\Ubigeo|null $ubigeos
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene query()
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereDenominacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereEncargado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereIdUbigeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Almacene whereUpdatedAt($value)
 */
	class Almacene extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Anaquele
 *
 * @property int $id
 * @property string|null $codigo
 * @property string|null $denominacion
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Seccione> $secciones
 * @property-read int|null $secciones_count
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele query()
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele whereDenominacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anaquele whereUpdatedAt($value)
 */
	class Anaquele extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Conductores
 *
 * @property int $id
 * @property string $licencia
 * @property string $fecha_licencia
 * @property string $estado
 * @property int $id_personas
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Persona $personas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehiculo> $vehiculos
 * @property-read int|null $vehiculos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereFechaLicencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereIdPersonas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereLicencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conductores whereUpdatedAt($value)
 */
	class Conductores extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Empresa
 *
 * @property int $id
 * @property string $ruc
 * @property string $nombre_comercial
 * @property string $razon_social
 * @property string $direccion
 * @property string $representante
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $email
 * @property string|null $telefono
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conductores> $conductores
 * @property-read int|null $conductores_count
 * @property-read string $ruc_nombre_comercial
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehiculo> $vehiculos
 * @property-read int|null $vehiculos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereNombreComercial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereRazonSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereRepresentante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereRuc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereUpdatedAt($value)
 */
	class Empresa extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmpresasConductoresVehiculo
 *
 * @property int $id
 * @property int $id_empresas
 * @property int $id_vehiculos
 * @property int $id_conductores
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereIdConductores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereIdEmpresas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereIdVehiculos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmpresasConductoresVehiculo whereUpdatedAt($value)
 */
	class EmpresasConductoresVehiculo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EntradaProducto
 *
 * @property int $id
 * @property string|null $fecha_ingreso
 * @property int|null $id_tipo_documento
 * @property string|null $unidad_origen
 * @property int|null $id_proveedor
 * @property int|null $numero_comprobante
 * @property string|null $fecha_comprobante
 * @property int|null $id_moneda
 * @property float|null $tipo_cambio_dolar
 * @property float|null $sub_total_compra
 * @property float|null $igv_compra
 * @property float|null $total_compra
 * @property string|null $cerrado
 * @property string|null $observacion
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereCerrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereFechaComprobante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereIdProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereIdTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereIgvCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereNumeroComprobante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereSubTotalCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereTipoCambioDolar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereTotalCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereUnidadOrigen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProducto whereUpdatedAt($value)
 */
	class EntradaProducto extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EntradaProductoDetalle
 *
 * @property int|null $id_entrada_productos
 * @property int|null $item
 * @property int|null $cantidad
 * @property int|null $numero_lote
 * @property string|null $fecha_vencimiento
 * @property string|null $aplica_precio
 * @property int|null $id_um
 * @property int|null $id_marca
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $id_producto
 * @property float|null $costo
 * @property string|null $fecha_fabricacion
 * @property int $id
 * @property int|null $id_estado_bien
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereAplicaPrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereFechaFabricacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereIdEntradaProductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereIdEstadoBien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereIdMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereIdUm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereNumeroLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EntradaProductoDetalle whereUpdatedAt($value)
 */
	class EntradaProductoDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IngresoVehiculoTronco
 *
 * @property int $id
 * @property string $fecha_ingreso
 * @property string $fecha_salida
 * @property int $id_empresa_transportista
 * @property int $id_empresa_proveedor
 * @property int $id_vehiculos
 * @property int $id_conductores
 * @property int $id_encargados
 * @property int $id_procedencias
 * @property string|null $guia_numero
 * @property string $estado_ingreso
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $subtotal
 * @property float|null $impuesto
 * @property float|null $total
 * @property int|null $id_moneda
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco query()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereEstadoIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereFechaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereFechaSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereGuiaNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdConductores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdEmpresaProveedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdEmpresaTransportista($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdEncargados($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdProcedencias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereIdVehiculos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereImpuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTronco whereUpdatedAt($value)
 */
	class IngresoVehiculoTronco extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IngresoVehiculoTroncoCubicaje
 *
 * @property int $id
 * @property int $id_ingreso_vehiculo_tronco_tipo_maderas
 * @property float $diametro_1
 * @property float $diametro_2
 * @property float $diametro_dm
 * @property float $longitud
 * @property float $volumen_m3
 * @property float $volumen_pies
 * @property float $volumen_total_m3
 * @property float $volumen_total_pies
 * @property float $precio_unitario
 * @property float $precio_total
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $codigo_tronco
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje query()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereCodigoTronco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereDiametro1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereDiametro2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereDiametroDm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereIdIngresoVehiculoTroncoTipoMaderas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereLongitud($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje wherePrecioTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje wherePrecioUnitario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereVolumenM3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereVolumenPies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereVolumenTotalM3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoCubicaje whereVolumenTotalPies($value)
 */
	class IngresoVehiculoTroncoCubicaje extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IngresoVehiculoTroncoImagene
 *
 * @property int $id
 * @property int $id_ingreso_vehiculo_troncos
 * @property int $id_tipo_maderas
 * @property string $ruta_imagen
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene query()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereIdIngresoVehiculoTroncos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereIdTipoMaderas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereRutaImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoImagene whereUpdatedAt($value)
 */
	class IngresoVehiculoTroncoImagene extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IngresoVehiculoTroncoTipoMadera
 *
 * @property int $id
 * @property int $id_ingreso_vehiculo_troncos
 * @property int $id_tipo_maderas
 * @property float $cantidad
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $subtotal
 * @property float|null $impuesto
 * @property float|null $total
 * @property int|null $id_moneda
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera query()
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereIdIngresoVehiculoTroncos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereIdTipoMaderas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereImpuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IngresoVehiculoTroncoTipoMadera whereUpdatedAt($value)
 */
	class IngresoVehiculoTroncoTipoMadera extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kardex
 *
 * @property int $id
 * @property int $id_producto
 * @property float|null $entradas_cantidad
 * @property float|null $costo_entradas_cantidad
 * @property float|null $total_entradas_cantidad
 * @property float|null $salidas_cantidad
 * @property float|null $costo_salidas_cantidad
 * @property float|null $total_salidas_cantidad
 * @property float|null $saldos_cantidad
 * @property float|null $costo_saldos_cantidad
 * @property float|null $total_saldos_cantidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereCostoEntradasCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereCostoSaldosCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereCostoSalidasCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereEntradasCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereSaldosCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereSalidasCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereTotalEntradasCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereTotalSaldosCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereTotalSalidasCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kardex whereUpdatedAt($value)
 */
	class Kardex extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lote
 *
 * @property int $id
 * @property int $id_producto
 * @property int|null $numero_lote
 * @property string|null $numero_serie
 * @property int|null $id_unidad_medida
 * @property int|null $cantidad
 * @property float|null $costo
 * @property int|null $id_moneda
 * @property string|null $fecha_fabricacion
 * @property string|null $fecha_vencimiento
 * @property int|null $id_anaquel
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $id_almacen
 * @property int $id_seccion
 * @property int|null $id_marca
 * @method static \Illuminate\Database\Eloquent\Builder|Lote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lote query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereFechaFabricacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdAlmacen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdAnaquel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdSeccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereIdUnidadMedida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereNumeroLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereNumeroSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lote whereUpdatedAt($value)
 */
	class Lote extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Movimiento
 *
 * @property int $id
 * @property int $id_producto
 * @property string|null $numero_lote
 * @property string $tipo_movimiento
 * @property float|null $entrada_salida_cantidad
 * @property float|null $costo_entrada_salida
 * @property int $id_users
 * @property int $id_personas
 * @property string|null $fecha_movimiento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereCostoEntradaSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereEntradaSalidaCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereFechaMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereIdPersonas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereIdUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereNumeroLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereTipoMovimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimiento whereUpdatedAt($value)
 */
	class Movimiento extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pago
 *
 * @property int $id
 * @property int $id_modulo
 * @property int $pk_registro
 * @property string|null $fecha
 * @property string|null $comprobante_serie
 * @property int|null $comprobante_numero
 * @property string|null $comprobante_tipo
 * @property string|null $comprobante_destinatario
 * @property string|null $comprobante_direccion
 * @property string|null $comprobante_ruc
 * @property float|null $subtotal
 * @property float|null $impuesto
 * @property float|null $total
 * @property string|null $letras
 * @property int|null $id_moneda
 * @property float|null $impuesto_factor
 * @property float|null $tipo_cambio
 * @property int|null $id_forma_pago
 * @property string|null $estado_pago
 * @property string|null $fecha_pago
 * @property string|null $fecha_recepcion
 * @property string|null $fecha_vencimiento
 * @property string|null $fecha_programado
 * @property string|null $observacion
 * @property string|null $anulado
 * @property string|null $afecta
 * @property int|null $id_caja_ingreso
 * @property string|null $estado
 * @property int $id_usuario_inserta
 * @property int|null $id_usuario_actualiza
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $cheque_serie
 * @property string|null $cheque_numero
 * @property int|null $id_empresa_cuenta_bancaria
 * @property string|null $nombre_archivo
 * @method static \Illuminate\Database\Eloquent\Builder|Pago newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pago newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pago query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereAfecta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereAnulado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereChequeNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereChequeSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereComprobanteDestinatario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereComprobanteDireccion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereComprobanteNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereComprobanteRuc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereComprobanteSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereComprobanteTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereEstadoPago($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereFechaPago($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereFechaProgramado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereFechaRecepcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdCajaIngreso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdEmpresaCuentaBancaria($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdFormaPago($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdModulo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdUsuarioActualiza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereIdUsuarioInserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereImpuesto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereImpuestoFactor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereLetras($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereNombreArchivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago wherePkRegistro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereTipoCambio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pago whereUpdatedAt($value)
 */
	class Pago extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Persona
 *
 * @property int $id
 * @property string $numero_documento
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $nombres
 * @property string $fecha_nacimiento
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $id_tipo_documento
 * @property int|null $id_sexo
 * @property string|null $grupo_sanguineo
 * @property string|null $id_ubigeo_nacimiento
 * @property string|null $lugar_nacimiento
 * @property int|null $id_nacionalidad
 * @property string|null $numero_ruc
 * @property string|null $desc_cliente_Sunat
 * @property string|null $direccion_sunat
 * @property string|null $foto
 * @property string|null $email
 * @property string|null $telefono
 * @property-read \App\Models\Conductores|null $conductores
 * @property-read string $nombre_completo
 * @property-read string $nombre_completo_sin_dni
 * @method static \Illuminate\Database\Eloquent\Builder|Persona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Persona newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Persona query()
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereApellidoMaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereApellidoPaterno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereDescClienteSunat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereDireccionSunat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereGrupoSanguineo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereIdNacionalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereIdSexo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereIdTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereIdUbigeoNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereLugarNacimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereNumeroDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereNumeroRuc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereTelefono($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Persona whereUpdatedAt($value)
 */
	class Persona extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $nombres
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereNombres($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Producto
 *
 * @property int $id
 * @property string|null $numero_serie
 * @property string|null $codigo
 * @property string|null $denominacion
 * @property int|null $id_unidad_medida
 * @property int|null $stock_actual
 * @property int|null $id_moneda
 * @property int|null $id_tipo_producto
 * @property string|null $fecha_vencimiento
 * @property int|null $id_estado_bien
 * @property int|null $stock_minimo
 * @property string|null $observacion
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float|null $costo_unitario
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCostoUnitario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereDenominacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdEstadoBien($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdTipoProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereIdUnidadMedida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereNumeroSerie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereStockActual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereStockMinimo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Producto whereUpdatedAt($value)
 */
	class Producto extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalidaProducto
 *
 * @property int $id
 * @property string|null $fecha_salida
 * @property int|null $id_tipo_documento
 * @property string|null $unidad_destino
 * @property int|null $numero_comprobante
 * @property string|null $fecha_comprobante
 * @property int|null $id_moneda
 * @property float|null $tipo_cambio_dolar
 * @property float|null $sub_total_compra
 * @property float|null $igv_compra
 * @property float|null $total_compra
 * @property string|null $cerrado
 * @property string|null $observacion
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereCerrado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereFechaComprobante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereFechaSalida($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereIdMoneda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereIdTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereIgvCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereNumeroComprobante($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereObservacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereSubTotalCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereTipoCambioDolar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereTotalCompra($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereUnidadDestino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProducto whereUpdatedAt($value)
 */
	class SalidaProducto extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalidaProductoDetalle
 *
 * @property int $id
 * @property int|null $id_salida_productos
 * @property int|null $item
 * @property int|null $cantidad
 * @property int|null $numero_lote
 * @property string|null $fecha_vencimiento
 * @property string|null $aplica_precio
 * @property int|null $id_um
 * @property int|null $id_marca
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $id_producto
 * @property float|null $costo
 * @property int|null $id_estado_productos
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereAplicaPrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereCosto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereFechaVencimiento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereIdEstadoProductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereIdMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereIdProducto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereIdSalidaProductos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereIdUm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereNumeroLote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalidaProductoDetalle whereUpdatedAt($value)
 */
	class SalidaProductoDetalle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Seccione
 *
 * @property int $id
 * @property string $codigo
 * @property string $denominacion
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Almacene> $almacenes
 * @property-read int|null $almacenes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anaquele> $anaqueles
 * @property-read int|null $anaqueles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione query()
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione whereDenominacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seccione whereUpdatedAt($value)
 */
	class Seccione extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TablaMaestra
 *
 * @property int $id
 * @property string|null $tipo
 * @property string|null $denominacion
 * @property string|null $codigo
 * @property string|null $tipo_nombre
 * @property string|null $sub_codigo
 * @property string|null $abreviatura
 * @property int $orden
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra query()
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereAbreviatura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereDenominacion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereOrden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereSubCodigo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereTipoNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablaMaestra whereUpdatedAt($value)
 */
	class TablaMaestra extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TablasMaestras
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TablasMaestras newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablasMaestras newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablasMaestras query()
 */
	class TablasMaestras extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ubigeo
 *
 * @property int $id
 * @property string|null $id_ubigeo
 * @property string|null $id_departamento
 * @property string|null $id_provincia
 * @property string|null $id_distrito
 * @property string|null $desc_ubigeo
 * @property string|null $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Almacene|null $almacenes
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereDescUbigeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereIdDepartamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereIdDistrito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereIdProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereIdUbigeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ubigeo whereUpdatedAt($value)
 */
	class Ubigeo extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Valorizacione
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Valorizacione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Valorizacione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Valorizacione query()
 */
	class Valorizacione extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Vehiculo
 *
 * @property int $id
 * @property string $placa
 * @property int $ejes
 * @property int|null $peso_tracto
 * @property int|null $peso_carreta
 * @property int|null $peso_seco
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $exonerado
 * @property string $control
 * @property string $bloqueado
 * @property int $id_usuario_inserta
 * @property int $id_usuario_actualiza
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Conductores> $conductores
 * @property-read int|null $conductores_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Empresa> $empresas
 * @property-read int|null $empresas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereBloqueado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereEjes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereExonerado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereIdUsuarioActualiza($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereIdUsuarioInserta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo wherePesoCarreta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo wherePesoSeco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo wherePesoTracto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo wherePlaca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehiculo whereUpdatedAt($value)
 */
	class Vehiculo extends \Eloquent {}
}

