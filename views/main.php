<header class="app-header navbar">
    <a class="btn btn btn-info px-3 mx-3" href="<?=main_url?>">
        Home
    </a>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="btn btn btn-success" href="<?=main_url?>add.html">add post</a>
        </li>
    </ul>
</header>
<main class="main">
    <div class="ui-view">
        <? if (isset($posts)) { ?>
            <div>
                <div class="animated fadeIn">
                    <div class="row m-4">
                        <? if ($posts == 'empty') { ?>
                            <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3">
                                <div class="card bg-github">
                                    <div class="card-header">
                                        empty
                                    </div>
                                    <div class="card-body">
                                        no news
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        <? } elseif (count($posts)) { ?>
                            <? foreach ($posts as $item) { ?>
                                <div id="post_<?=$item['id']?>" class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3">
                                    <div class="card">
                                        <div class="card-header"><?=$item['post_name']?>
                                            <div class="float-right">
                                                <a href="#" id="<?=$item['id']?>" data-sid="<?=id_session?>" data-action="<?=main_url?>index.php" title="REMOVE" class="remove_post badge badge-danger badge-pill btn p-1"><i class="icons cui-ban"></i></a>
                                                <a href="<?=main_url?>edit_<?=$item['id']?>.html" title="EDIT" class="ml-3 badge badge-info badge-pill btn p-1"><i class="icons cui-code"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body"><?=$item['post_body']?></div>
                                        <div class="card-footer">
                                            <div class="float-left"><?=$item['date_added']?></div>
                                            <div class="float-right"><a href="<?=main_url?>post/<?=$item['id']?>.html" class="nav-link badge badge-primary badge-pill">link</a></div>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>
                        <? } ?>
                    </div>
                    <div class="card-body">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <? if (isset($paginator['first'])) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=main_url?>">first</a>
                                    </li>
                                <? } ?>
                                <? if (isset($paginator['prev'])) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=main_url?>page/<?=$paginator['prev']?>">prev</a>
                                    </li>
                                <? } ?>
                                <li class="page-item active">
                                    <span class="page-link"><?=$paginator['cur']?></span>
                                </li>
                                <? if (isset($paginator['next'])) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=main_url?>page/<?=$paginator['next']?>">next</a>
                                    </li>
                                <? } ?>
                                <? if (isset($paginator['last'])) { ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?=main_url?>page/<?=$paginator['last']?>">last</a>
                                    </li>
                                <? } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        <? } elseif ($post) { ?>
            <div class="card ml-3 mr-3">
                <div class="card-header"><?=$post['post_name']?></div>
                <div class="card-body"><?=$post['post_body']?></div>
                <div class="card-footer"><?=$post['date_added']?></div>
            </div>
        <? } else { ?>

        <? } ?>
    </div>
</main>