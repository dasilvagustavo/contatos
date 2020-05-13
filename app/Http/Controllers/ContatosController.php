<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contatos;

class ContatosController extends Controller
{
    public function insert(Request $request){
        if(!empty($request->input('nome')) || !empty($request->input('sobrenome')) || !empty($request->input('contato'))){
            $contato = new Contatos();
//      Formatar dados do formulario para inserir na tabela
//        Concatena nome do contato
            $nome = $request->input('nome')." ".$request->input('sobrenome');
//        Substitui a virgular que vem com o array por ponto e virgula para separar os contatos no banco
            $contatos = str_replace(',', ';', $request->input('contato'));
            $contato->nome = $nome;
            $contato->contatos = $contatos;
            $contato->save();
            if ($contato){
                return response()->json(['message' => "inserido com sucesso..."]);
            }else{
                return response()->json(['message' => "Falha ao inserir contato..."]);
            }
        }else{
            return response()->json(['message' => "Falha ao inserir contato, informacoes incompletas/incorretas..."]);
        }

    }
    public function findAll(){
        $contatos = Contatos::all();
        if(count($contatos) != 0){
            return response()->json(['contatos'=> $contatos, 'message' => "Contatos Listados com sucesso..."]);
        }else{
            return response()->json(['message' => "Nenhum dado encontrado..."]);
        }
    }
    public function findBy($id){
        $contato = Contatos::find($id);
        if($contato){
            return response()->json(['contato'=> $contato, 'message' => "Contato Listado com sucesso..."]);
        }else{
            return response()->json(['message' => "Nenhum dado encontrado..."]);
        }
    }
}
