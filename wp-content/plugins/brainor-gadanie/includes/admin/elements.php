<?php
/*
Элементы гадания
*/

?>
<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>
    <?php global $wpdb; ?>
    <?php if($_POST['type'] == 'taro-import'):?>
        <?php
            $table = $wpdb->get_blog_prefix().'br_divination_elements';
            $place_holders = array( '%s', '%s', '%s', '%s', '%s', '%s');
            $handle = fopen($_FILES['myFile']['tmp_name'], "r");
            $isFirstLine = true;
            while (($row = fgetcsv($handle, 10000, ';')) !== false) {
//                $row = str_replace('\n', '<br>', $row);
//                var_dump($row);
                if($isFirstLine) {
                    $isFirstLine = false;
                    continue;
                }



                $wpdb->insert(
                    $table,
                    array(
                        'name' => $row[0],
                        'class' => 'taro',
                        'slug' => sanitize_title($row[0]),
                        'description' => $row[1],
                        'thumb' => $row[2],
                        'option_1' => $row[3]
                    ),
                    $place_holders
                );
            }
            fclose($handle);
        ?>
    <?php endif;?>
    <?php if(isset($_GET['type'])):?>
        <?php if($_GET['type'] == 'edit'):?>
            <?php
                if(isset($_POST['action'])) {
                    if($_POST['action'] == 'insert'){
                        $divinationElementsTable = $wpdb->get_blog_prefix() . 'br_divination_elements';
                        $wpdb->insert(
                            $divinationElementsTable,
                            array(
                                'name' => $_POST['name'],
                                'slug' => sanitize_title($_POST['name']),
                                'class' => $_POST['class'],
                                'description' => $_POST['description'],
                                'thumb' => $_POST['thumb'],
                                'created_at' => date("Y-m-d H:i:s"),
                            ),
                            array('%s', '%s', '%s', '%s', '%s', '%s')
                        );
                        $lastServiceId = $wpdb->insert_id;
                        $url = get_site_url() . '/wp-admin/admin.php?page=br_divination_elements&type=edit&id=' . $lastServiceId;
                    }
                    if($_POST['action'] == 'update'){
                        $divinationElementsTable = $wpdb->get_blog_prefix() . 'br_divination_elements';

                        if(isset($_GET['id'])){ $id = $_GET['id']; }
                        $wpdb->update(
                            $divinationElementsTable,
                            array(
                                'name' => $_POST['name'],
                                'slug' => sanitize_title($_POST['name']),
                                'class' => $_POST['class'],
                                'description' => $_POST['description'],
                                'thumb' => $_POST['thumb'],
                                'created_at' => date("Y-m-d H:i:s"),
                            ),
                            array(
                                'id' => $id,
                            ),
                            array('%s', '%s', '%s', '%s', '%s', '%s'),
                            array( '%d')
                        );
                        $url = get_site_url() . '/wp-admin/admin.php?page=br_divination_elements&type=edit&id=' . $lastServiceId;
                    }
                }
            ?>
            <?php if(isset($_GET['id']) || isset($lastServiceId)):?>
                <?php
                $divinationTable = $wpdb->get_blog_prefix().'br_divination_elements';
                if(isset($_GET['id'])){ $id = $_GET['id']; };
                if(isset($lastServiceId)){ $id = $lastServiceId; };
                $sql = "SELECT * from `$divinationTable` WHERE id = $id";
                $result = $wpdb->get_row( $sql , ARRAY_A );
                ?>
                <form action="/wp-admin/admin.php?page=br_divination_elements&type=edit<?php if(isset($id)){ echo "&id=$id"; }?>" method="post">
                    <input type="hidden" hidden="hidden" name="action" value="update">
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Название" <?php if(isset($result['name'])){ echo "value=$result[name]"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="name">Ярлык</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Ярлык" <?php if(isset($result['slug'])){ echo "value=$result[slug]"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="class">Класс</label>
                        <input type="text" class="form-control" id="class" name="class" placeholder="Класс" <?php if(isset($result['class'])){ echo "value=$result[class]"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="thumb">Миниатюра</label>
                        <input type="text" class="form-control" id="thumb" name="thumb" placeholder="Миниатюра" <?php if(isset($result['thumb'])){ echo "value=$result[thumb]"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Дата создания</label>
                        <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Дата создания" <?php if(isset($result['created_at'])){ echo "value=$result[created_at]"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <?php
                        $settings = array(
                            'teeny' => true,
                            'textarea_rows' => 15,
                            'tabindex' => 1
                        );
                        wp_editor($result['description'],'description', $settings);
                        ?>
                    </div>
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
            <?php else:?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <span>Не указан ID</span>
                </div>
            <?php endif;?>
        <?php endif;?>
        <?php if($_GET['type'] == 'add'):?>
            <form action="/wp-admin/admin.php?page=br_divination_elements&type=edit" method="post">
                <input type="hidden" hidden="hidden" name="action" value="insert">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Название">
                </div>
                <div class="form-group">
                    <label for="class">Класс</label>
                    <input type="text" class="form-control" id="class" name="class" placeholder="Класс">
                </div>
                <div class="form-group">
                    <label for="thumb">Миниатюра</label>
                    <input type="text" class="form-control" id="thumb" name="thumb" placeholder="Миниатюра">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <?php
                    $settings = array(
                        'teeny' => true,
                        'textarea_rows' => 15,
                        'tabindex' => 1
                    );
                    wp_editor('','description', $settings);
                    ?>
                </div>
                <button type="submit" class="btn btn-success">Создать</button>
            </form>
        <?php endif;?>
    <?php else:?>
        <a href="?page=br_divination_elements&type=add">
            <button class="btn btn-primary my-4">Создать</button>
        </a>

        <button type="button" class="btn btn-info my-4" data-toggle="modal" data-target="#importModal">Импорт</button>

        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModal">Импорт</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input name="myFile" type="file">
                            <input type="hidden" name="type" value="taro-import">
                            <input type="hidden" name="page" value="br_divination_elements">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Импортировать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $divinationTable = $wpdb->get_blog_prefix().'br_divination_elements';

        $sql = "SELECT * from `$divinationTable` ORDER BY `id` DESC ";
        $divinationElements = $wpdb->get_results( $sql , ARRAY_A );
        ?>

        <table class="table table-striped table-hover table-responsive table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Название</th>
                <th scope="col">Ярлык</th>
                <th scope="col">Класс</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($divinationElements as $divinationElement): ?>
                <tr>
                    <td><?php echo $divinationElement['id']; ?></td>
                    <td><?php echo $divinationElement['name']; ?></td>
                    <td><?php echo $divinationElement['slug']; ?></td>
                    <td><?php echo $divinationElement['class']; ?></td>
                    <td><a href="?page=br_divination_elements&type=edit&id=<?php echo $divinationElement['id']; ?>"><button class="btn btn-success">Изменить</button></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif;?>
</div>

