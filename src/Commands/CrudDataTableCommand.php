<?php

namespace Nox\DevilsCrud\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudDataTableCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:datatable
                            {name : The name of the table.}
                            {--fields= : The fields for the model.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new datatable.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'datatable';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('crudgenerator.custom_template')
        ? config('crudgenerator.path') . '/datatable.stub'
        : __DIR__ . '/../stubs/datatable.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $name = $this->argument('name');
        // $fields = $this->option('fillable');

        $ret = $this->replaceModel($stub, $name)
            ->sendFileToPath($stub, $name);

        return $ret;
    }


    protected function replaceModel(&$stub, $name)
    {
        $stub = str_replace('{{ModelName}}', $name, $stub);

        return $this;
    }

    protected function sendFileToPath(&$stub, $name)
    {
        // copy file to config folder
        $path = app_path().'/DataTables/'.$name.'DataTable.php';

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }

        \File::put($path, $stub);

    }




}
