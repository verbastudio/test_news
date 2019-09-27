<?php
/**
 * Created by PhpStorm.
 * User: verba
 * Date: 25.09.19
 * Time: 22:58
 */

namespace NEWS;

use NEWS\ModelNews;

class ControllerNews
{
    function __construct()
    {
        $this->onpage = 10;
        $this->cur_page = (isset($_GET['page']) ? filter_var($_GET['page'], FILTER_VALIDATE_INT) : 1);
    }

    public function index()
    {
        $list = ModelNews::getList($this->cur_page, $this->onpage);
        return $list;
    }

    public function show_news($id)
    {
        $news_id = $id;
        $vars = ModelNews::getpost($news_id);
        return $vars;
    }

    public function AddPost($data)
    {
        $insert = ModelNews::add($data);
        return $insert;
    }

    public function EditPost($data)
    {
        $insert = ModelNews::update($data);
        return $insert;
    }

    public function RemovePost($id)
    {
        $remove = ModelNews::delete($id);
        return $remove;
    }

    public function paginator($total)
    {
        $count_pages = (int)ceil($total / $this->onpage);
        $pagination['cur'] = $this->cur_page;
        if ($total > 2) {
            if($this->cur_page >= 2) {$pagination['prev'] = $this->cur_page - 1;}
            if($this->cur_page < ($count_pages-1)) {$pagination['next'] =  $this->cur_page + 1;}
        }
        if ($count_pages > 3) {
            if ($this->cur_page >= 2) {
                $pagination['first'] = 1;
            }
            if ($this->cur_page <= $count_pages) {
                $pagination['last'] = (int)$count_pages;
            }
        }
        return $pagination;
    }

}