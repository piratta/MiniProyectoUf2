<?php
namespace App\Http\Controllers;
use App\File;
use Spatie\Dropbox\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Spatie\FlysystemDropbox\DropboxAdapter;

$client = new Client( env('DROPBOX_OATH') );
$adapter = new DropboxAdapter($client);
$filesystem = new Filesystem($adapter);

class FileController extends Controller
{
    public function __construct()
    {
        // Necesitamos obtener una instancia de la clase Client la cual tiene algunos métodos
        // que serán necesarios.
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();   
    }
    public function index()
    {
        // Obtenemos todos los registros de la tabla files
        // y retornamos la vista files con los datos.
        $files = File::orderBy('created_at', 'desc')->get();
        
        return view('files', compact('files'));
    }
    public function store(Request $request)
    {
        // Guardamos el archivo indicando el driver y el método putFileAs el cual recibe
        // el directorio donde será almacenado, el archivo y el nombre.
        // ¡No olvides validar todos estos datos antes de guardar el archivo!
        Storage::disk('dropbox')->putFileAs(
            '/', 
            $request->file('file'), 
            $request->file('file')->getClientOriginalName()
        );
        // Creamos el enlace publico en dropbox utilizando la propiedad dropbox
        // definida en el constructor de la clase y almacenamos la respuesta.
        $response = $this->dropbox->createSharedLinkWithSettings(
            $request->file('file')->getClientOriginalName(), 
            ["requested_visibility" => "public"]
        );
        // Creamos un nuevo registro en la tabla files con los datos de la respuesta.
        File::create([
            'name' => $response['name'],
            'extension' => $request->file('file')->getClientOriginalExtension(),
            'size' => $response['size'],
            'public_url' => $response['url']
        ]);
        
        // Retornamos un redirección hacía atras
        return back();
    }
    public function download(File $file)
    {
        // Retornamos una descarga especificando el driver dropbox
        // e indicándole al método download el nombre del archivo.
        return Storage::disk('dropbox')->download($file->name);
    }
    public function destroy(File $file)
    {
        // Eliminamos el archivo en dropbox llamando a la clase
        // instanciada en la propiedad dropbox.
        $this->dropbox->delete($file->name);
        // Eliminamos el registro de nuestra tabla.
        $file->delete();
        return back();
    }
}