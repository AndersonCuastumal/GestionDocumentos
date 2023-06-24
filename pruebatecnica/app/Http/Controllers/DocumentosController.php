<?php

namespace App\Http\Controllers;

use App\Models\Doc_documento;
use App\Models\Pro_proceso;
use App\Models\Tip_tipo_doc;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{   
    // ----APIs
    
    // Retornamos todos los datos contenidos en la BD "doc_documentos"
    public function index(){
        return Doc_documento::All();
    }

    // Retornamos todos los datos contenidos en la BD "pro_procesos"
    public function listaProcesos(){

        return Pro_proceso::with('doc_documento')->get();
    }

    // Retornamos todos los datos contenidos en la BD "tip_tipo_docs"
    public function listaTipoDocs(){

        return Tip_tipo_doc::with('doc_documento')->get();
    }


    // Guardamos nuevos datos
    public function store(Request $request){
        echo 'entro en store';

        $inputs=$request->input();
        //echo "El resultado es: " . $inputs . "\n";
        //Validate DOC_CODIGO
        $idProceso=$request->doc_id_proceso;
        $idTipo=$request->doc_id_tipo;

        //Extrayendo tip_prefijo usando relacion ORM
        $tipoDoc = Tip_tipo_doc::with('doc_documento')->findOrFail($idTipo);
        $tipPrefijo = $tipoDoc->tip_prefijo;

        // Obtener el prefijo del proceso
        $proceso = Pro_proceso::with('doc_documento')->findOrFail($idProceso);
        $proPrefijo = $proceso->pro_prefijo;

        echo "El resultado es: " . $proPrefijo . "\n";
        echo "El resultado es: " . $tipPrefijo . "\n";
        
        $codCodigo=self::validandoCodigo($tipPrefijo,$proPrefijo);
        $inputs['doc_codigo'] = $codCodigo;
        $respuesta=Doc_documento::create($inputs);
        return $respuesta;
        

    }

    // Actualizamos documento
    //en este caso se realizara la actualizacion de doc_codigo
    public function update(Request $request,$doc_id){
        $existeDoc=Doc_documento::find($doc_id);
        if(isset($existeDoc)){
            $existeDoc->doc_nombre=$request->doc_nombre;
            //$existeDoc->doc_codigo=$request->doc_codigo;
            $existeDoc->doc_contenido=$request->doc_contenido;
            $existeDoc->doc_id_proceso=$request->doc_id_proceso;
            $existeDoc->doc_id_tipo=$request->doc_id_tipo;

            //Recalculando doc_codigo
            $idTipo=$existeDoc->doc_id_tipo;
            $idProceso=$existeDoc->doc_id_proceso;

            //Extrayendo tip_prefijo usando relacion ORM
            $tipoDoc = Tip_tipo_doc::with('doc_documento')->findOrFail($idTipo);
            $tipPrefijo = $tipoDoc->tip_prefijo;

            // Obtener el prefijo del proceso
            $proceso = Pro_proceso::with('doc_documento')->findOrFail($idProceso);
            $proPrefijo = $proceso->pro_prefijo;

            echo "El resultado es: " . $proPrefijo . "\n";
            echo "El resultado es: " . $tipPrefijo . "\n";
            
            $codCodigo=self::validandoCodigo($tipPrefijo,$proPrefijo);
            $existeDoc['doc_codigo'] = $codCodigo;
            
            if($existeDoc->save()){
                return response()->json([
                    'data'=>$existeDoc,
                    'mensaje'=>"Documento actualizado con exito"
                ]);
            }

        }else{
            return  response()->json([
                'error'=>true,
                'mensaje'=>"Documento no actualizado con doc_id=".$doc_id,
            ]);
        }

        //return isset($existe);//isset(): me permite saber si la variable tiene algun valor
    }


    // Consulta un documento en especifico

    public function show($doc_id){
        $existeDoc=Doc_documento::find($doc_id);
        if(isset($existeDoc)){

                return response()->json([
                    'data'=>$existeDoc,
                    'mensaje'=>"Documento encontrado con exito"
                ]);
            

        }else{
            return  response()->json([
                'error'=>true,
                'mensaje'=>"Documento no encontrado con doc_id=".$doc_id,
            ]);
        }
    }

    // Eliminar un documento en especifico

    public function destroy($doc_id){
        $existeDoc=Doc_documento::find($doc_id);
        if(isset($existeDoc)){
                $del=Doc_documento::destroy($doc_id);//Respuesta booleana de accion eliminar
                
                if($del){
                    return response()->json([
                        'data'=>$existeDoc, // retornamos los datos del documento eliminado
                        'mensaje'=>"Documento eliminado con exito"
                    ]);
                }else{
                    return response()->json([
                        'data'=>$existeDoc,
                        'mensaje'=>"Documento no existe"
                    ]);
                }
                
            

        }else{
            return  response()->json([
                'error'=>true,
                'mensaje'=>"Documento no encontrado con doc_id=".$doc_id,
            ]);
        }
    }


    public static function validandoCodigo($idTipo,$idProceso) {
        $docCodigo = $idTipo . "-" . $idProceso;
        echo "El resultado es: " . $docCodigo . "\n";
        $existeDoc = Doc_documento::whereRaw("doc_codigo LIKE '$docCodigo%'")
            ->orderByRaw("CAST(SUBSTRING(doc_codigo, LENGTH(doc_codigo) - LENGTH('$docCodigo') + 1) AS UNSIGNED) DESC")
            ->get();
            
            if ($existeDoc->count() > 0) {

                $maxNumber = 0;
                $maxDocCode = '';
                echo "existeDoc no esta vacio \n";
                foreach ($existeDoc as $doc) {
                    echo $doc;
                    $docCode = $doc->doc_codigo;
                    echo "El resultado es: " . $docCode . "\n";
                    $number = intval(preg_replace('/[^0-9]+/', '', $docCode));
                    echo "El resultado es: " . $number . "\n";
                    if ($number > $maxNumber) {
                        $maxNumber = $number;
                        $maxDocCode = $docCode;
                        echo "El resultado es: " . $maxDocCode . "\n";
                        echo "-------Final iteracion------- \n";
                    }
                }
            
                return self::modificandoCodigo($maxNumber,$docCodigo);
            } else {
                return $docCodigo."-1";
            }

            
    }

    public static function modificandoCodigo($maxNumber,$docCodigo){
      
        $newDocCodigo=$docCodigo."-".($maxNumber+1);
        return $newDocCodigo;
    }

}



