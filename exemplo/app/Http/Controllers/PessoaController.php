<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PessoaController extends Controller
{
  //listando
  public function lista()
  {
    return DB::select('SELECT * FROM pessoa');
  }

  //cadastrando
  public function novo(Request $request)
  {
    $data = sizeof($_POST) > 0 ? $_POST : json_decode($request->getContent(), true);
    $res = DB::insert('INSERT INTO pessoa(nome, email) VALUES(?,?)', [$data['nome'],$data['email']]);
    return ["status" => ($res) ? 'ok': 'erro'];
  }

  //editando
  public function editar($id, Request $request)
  {
    $data = sizeof($_POST) > 0 ? $_POST : json_decode($request->getContent(),true);
    $res = DB::update('UPDATE pessoa SET nome=?, email=? WHERE id=?', [$data['nome'],$data['email'], $id]);
    return ["status" => ($res) ? 'ok':'erro'];
  }

  //excluindo
  public function excluir($id)
  {
    $res = DB::delete('DELETE FROM pessoa WHERE id=?', [$id]);
    return ["status" => ($res) ? 'ok':'erro'];
  }
}
