<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = new Produto();
        $produtos = Produto::orderBy('id','desc')->get(); //gera consulta para ordernar por id em ordem decrescente
        return $produtos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produtos = new Produto();
        $produtos->descricao = $request->descricao;
        $produtos->valor = $request->valor;
        $produtos->quantidade = $request->quantidade;
        $produtos->observacoes  = $request->observacao;
        $produtos->tipo = $request->tipo;
        $produtos->save();
        return $produtos;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produtos = Produto::find($id);
        $produtos->descricao = $request->descricao;
        $produtos->valor = $request->valor;
        $produtos->quantidade = $request->quantidade;
        $produtos->observacoes  = $request->observacao;
        $produtos->tipo = $request->tipo;
        $produtos->save();
        return $produtos;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $produtos = Produto::find($id);
        $produtos->delete();
    }
}
