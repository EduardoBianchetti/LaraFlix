<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nacionalidade;
use App\Http\Requests\NacionalidadeRequest;

class NacionalidadesController extends Controller
{

    public function index(Request $filtro) {
        $filtragem = $filtro->get('desc_filtro');
        if ($filtragem == null)
            $nacionalidades = Nacionalidade::orderBy('descricao')->paginate(5);
        else
            $nacionalidades = Nacionalidade::where('descricao', 'like', '%'.$filtragem.'%')
                                ->orderBy("descricao")
                                ->paginate(10)
                                ->setpath('nacionalidades?desc_filtro='.$filtragem);
                                
        return view('nacionalidades.index', ['nacionalidades' => $nacionalidades]);
    }

    public function create() {
        return view('nacionalidades.create');
    }

    public function store(NacionalidadeRequest $request) {
        $novo_nacionalidade = $request->all();
        Nacionalidade::create($novo_nacionalidade);
        return redirect()->route('nacionalidades');
    }

    public function destroy(Request $request) {
        try {
            Nacionalidade::find(\Crypt::decrypt($request->get('id')))->delete();
            $ret = array('status'=>200, 'msg'=>"null");
        } catch (\Illuminate\Database\QueryException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        catch (\PDOException $e) {
            $ret = array('status'=>500, 'msg'=>$e->getMessage());
        }
        return $ret;
    }

    public function edit(Request $request) {
        $nacionalidade = Nacionalidade::find(\Crypt::decrypt($request->get('id')));
        return view('nacionalidades.edit', compact('nacionalidade'));
    }

    public function update(NacionalidadeRequest $request, $id) {
        Nacionalidade::find($id)->update($request->all());
        return redirect()->route('nacionalidades');
    }
}
