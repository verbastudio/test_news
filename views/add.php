<main class="main ">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?=main_url?>">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span><?=$action?></span>
        </li>
    </ol>
    <div class="ui-view">
        <div class="card mx-5">
            <div id="add_result" class="alert text-center text-white mb-0" style="display:none;">
                <span class=" d-block p-3 m-3">result</span>
            </div>
            <form action="index.php" id="add_form">
                <input type="hidden" name="addpost" value="<?=id_session?>">
                <input type="hidden" name="id" value="<?=$id?>">
                <div class="card-header"><?=$action?> post</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Text Input</label>
                        <div class="col-md-9">
                            <input class="form-control" required type="text" value="<?=(($post_name)??'')?>" name="post_name">
                            <span class="help-block">post name</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Text Input</label>
                        <div class="col-md-9">
                            <textarea class="form-control" required name="post_body" id="" cols="30" rows="10"><?=(($post_body)??'')?></textarea>
                            <span class="help-block">post body</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Text Input</label>
                        <div class="col-md-9">
                            <select name="status">
                                <option <?=((!isset($status) || (int)$status == 0) ? 'selected':'')?> value="0">Off</option>
                                <option <?=((isset($status) || (int)$status != 0) ? 'selected':'')?> value="1">On</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="button" id="add_post" class="btn btn-sm btn-primary">add post</button>
                </div>
            </form>

        </div>
    </div>
</main>