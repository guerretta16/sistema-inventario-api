<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Utils\ValidarInformacion;
use App\Utils\MessageError;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    //traer todos los productos
    public function index()
    {
        return Producto::all();
    }

    //ingresar un nuevo producto
    public function store(Request $request)
    {

        $responseValidate = ValidarInformacion::validarInformacionProducto($request);
        if (count($responseValidate) > 0) {
            return $responseValidate;
        }

        $producto = new Producto;
        $producto->idCategoria = $request->input('idCategoria');
        $producto->codigo_prod = $request->input('codigo_prod');
        $producto->nombre_prod = $request->input('nombre_prod');
        $producto->descripcion_prod = $request->input('descripcion_prod');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->created_at = Carbon::now();

        try {
            if ($request->hasFile('image')) {
                $allowedfileExtension = ['jpg', 'png'];
                $imagenes = $request->file('image');
                $path = "public/images/products";
                $urls = array();
                $fileNames = array();
                $index = 0;
                foreach ($imagenes as $imagen) {
                    $extension = $imagen->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $nombreImage = $request->input('nombre_prod') . "-" . time() . "-" . $index . "." . $extension;
                        $withoutBlank = str_replace(' ', '-', $nombreImage);
                        $nombreLower = strtolower($withoutBlank);
                        $url = $imagen->storeAs($path, $nombreLower);
                        $storagePath = Storage::url($url);
                        $urls[] = $storagePath;
                        $fileNames[] = $nombreLower;
                        $index++;
                    }
                }
                $producto->image = json_encode($urls);
                $producto->filename = json_encode($fileNames);
            }
            $responseBool = $producto->save();
            return MessageError::returnResponse($responseBool);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    //ingresar un nuevo producto
    public function update(Request $request, Producto $producto)
    {

        $responseValidate = ValidarInformacion::validarInformacionProductoUp($request);
        if (count($responseValidate) > 0) {
            return $responseValidate;
        }

        $producto->idCategoria = $request->input('idCategoria');
        $producto->nombre_prod = $request->input('nombre_prod');
        $producto->descripcion_prod = $request->input('descripcion_prod');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->input('stock');
        $producto->updated_at = Carbon::now();

        try {

            if ($request->hasFile('image')) {
                //datos de la imagen nueva
                $allowedfileExtension = ['jpg', 'png'];
                $imagenes = $request->file('image');
                $path = "public/images/products";
                $urls = array();
                $fileNames = array();
                $index = 0;

                //Elimina las imagenes actuales
                $fileNamesOrigin = json_decode($producto->filename);
                foreach ($fileNamesOrigin as $file) {
                    if (Storage::exists($path . "/" . $file)) {
                        Storage::delete($path . "/" . $file);
                    }
                }

                foreach ($imagenes as $imagen) {
                    $extension = $imagen->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    if ($check) {
                        $nombreImage = $request->input('nombre_prod') . "-" . time() . "-" . $index . "." . $extension;
                        $withoutBlank = str_replace(' ', '-', $nombreImage);
                        $nombreLower = strtolower($withoutBlank);
                        $url = $imagen->storeAs($path, $nombreLower);
                        $storagePath = Storage::url($url);
                        $urls[] = $storagePath;
                        $fileNames[] = $nombreLower;
                    }
                    $index++;
                }
                $producto->image = json_encode($urls);
                $producto->filename = json_encode($fileNames);
            }
            $responseBool = $producto->save();
            return MessageError::returnResponse($responseBool);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    //Eliminar un producto
    public function delete($id)
    {
        try {
            $producto = Producto::find($id);
            $fileNamesOrigin = json_decode($producto->filename);
            $path = "public/images/products";
            foreach ($fileNamesOrigin as $file) {
                if (Storage::exists($path . "/" . $file)) {
                    Storage::delete($path . "/" . $file);
                }
            }
            $responseBool = $producto->delete();
            return MessageError::returnResponse($responseBool);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
        }
    }

    public function showProducto($id){
        $producto = Producto::find($id);
        $producto->categoria = Producto::find($id)->categoria->nombre_cat;
        return $producto;
    }
}
