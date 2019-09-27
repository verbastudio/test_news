<?php
/**
 * Created by PhpStorm.
 * User: verba
 * Date: 25.09.19
 * Time: 20:44
 */

namespace NEWS;

use DB;

class ModelNews
{

    static public function getList($page = 1, $limit = 10)
    {
        $pagination = ($page > 1) ? (($page - 1) * $limit . ', ') : '';
        $sql = "SELECT id, post_name, post_body, date_added FROM news WHERE status=1 ";
        $posts = DB::query($sql . " ORDER BY date_added DESC LIMIT " . $pagination . $limit)->fetchAll();
        $posts['total'] = count(DB::query($sql)->fetchAll());
        return $posts;

    }

    public function getpost($id = null)
    {
        if ($id) {
            return DB::query("SELECT id, post_name, post_body, date_added, status FROM news WHERE id=" . $id)->fetch();
        }
    }


    static public function add($request)
    {
        $s = "INSERT INTO news SET post_name=:post_name, post_body=:post_body, status=:status, date_added=NOW()";
        $t = DB::prepare($s);
        $p = [
            ':post_name' => $request['post_name'],
            ':post_body' => $request['post_body'],
            ':status' => (int)$request['status'],
        ];
        $t->execute($p);
        $dfs = DB::lastInsertId();
        return $dfs;
    }

    static public function update($request)
    {
        $s = "UPDATE news SET post_name=:post_name, post_body=:post_body, status=:status, date_update=NOW() WHERE id=:id";
        $t = DB::prepare($s);
        $t->execute( [
            ':post_name' => $request['post_name'],
            ':post_body' => $request['post_body'],
            ':status' => $request['status'],
            ':id' => $request['id'],
        ]);
        return $t->rowCount();
    }

    static public function delete($id)
    {
        if ($id) {
            $s = "DELETE FROM news WHERE id=:id";
            $t = DB::prepare($s);
            $t->execute([':id' => $id]);
            return $t->rowCount();
        }
    }

}