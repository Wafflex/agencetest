<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * Instancia del modelo
     *
     * @var object
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Obtener todos los datos de una tabla
     *
     * 
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Crear nuevos datos en una tabla
     *
     * @var array
     */

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Actualizar un dato en una tabla
     *
     * @var array
     * @var integer
     */
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    /**
     * Eliminar un dato de una tabla
     *
     * @var integer
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Obtener un dato especifico basado en su primary key
     *
     * @var string
     */
    public function show($pk)
    {
        return $this->model-findOrFail($pk);
    }

    /**
     * Obtener la instancia del modelo
     *
     * 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Setear un modelo
     *
     * @var object
     */

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * Cargar relaciones del modelo
     *
     * @var array
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}