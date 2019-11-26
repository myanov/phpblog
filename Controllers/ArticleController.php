<?php

namespace Controllers;

use core\DBDriver;
use core\Validator;
use Models\ArticleModel;
use core\DB;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $this->title = 'All Articles';
        $marticle = new ArticleModel(new DBDriver(DB::connect()), new Validator());
        $articles = $marticle->getAll();
        $this->content = $this->build('v_index_auth', ['news' => $articles]);
    }

    public function showAction()
    {
        $id = $this->request->getValue('get', 'id');
        $marticle = new ArticleModel(new DBDriver(DB::connect()), new Validator());
        $article = $marticle->getOne($id);
        $this->title = $article['title'];
        $this->content = $this->build('v_post', ['result' => $article]);
    }

    public function addAction()
    {
        $this->title = 'Adding article';
        $marticle = new ArticleModel(new DBDriver(DB::connect()), new Validator());
        $title = $this->request->getValue('post', 'title') ?? '';
        $content = $this->request->getValue('post', 'content') ?? '';
        if($this->request->isPost()) {
            $title = trim($title);
            $content = trim($content);

            if ($title == '' || $content == '') {
                $msg = 'Заполните все поля';
            } else {
                $id = $marticle->add([
                    'title' => $title,
                    'content' => $content
                ]);
                $this->redirect(sprintf('article/show/%s', $id));
            }
        } else {
            $msg = '';
        }
        $this->content = $this->build('v_add',
            [
                'title' => $title,
                'content' => $content,
                'msg' => $msg
            ]);
    }

    public function editAction()
    {
        $this->title = 'Editing article';
        $marticle = new ArticleModel(new DBDriver(DB::connect()), new Validator());
        $id = $this->request->getValue('get', 'id');
        $msg = '';
        if($this->request->isPost()) {
            $title = trim($this->request->getValue('post', 'title'));
            $content = trim($this->request->getValue('post', 'content'));

            if($title == '' || $content == ''){
                $msg = 'Заполните все поля';
            }

            if (!$msg) {
                $marticle->update(
                    [
                        'title' => $title,
                        'content' => $content
                    ],
                    "id=$id"
                );
                $this->redirect(sprintf('article'));
            }
        } else {
            $result = $marticle->getOne($id);
        }
        $this->content = $this->build('v_edit',
            [
                'result' => $result
            ]);
    }

    public function deleteAction()
    {
        $marticle = new ArticleModel(new DBDriver(DB::connect()), new Validator());
        $id = $this->request->getValue('get', 'id');
        $marticle->delete("id=$id");
        $this->redirect();
    }
}