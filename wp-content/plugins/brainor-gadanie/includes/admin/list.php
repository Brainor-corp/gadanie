<?php
/*
Список всех гаданий
*/

?>
<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>
    <?php global $wpdb; ?>
    <?php if(isset($_GET['type'])):?>
        <?php if($_GET['type'] == 'edit'):?>
            <?php
            if(isset($_POST['name'])){
                $divinationTable = $wpdb->get_blog_prefix().'br_divinations';
                $divinationPivotTable = $wpdb->get_blog_prefix().'br_divination_elements_pivot';
                $wpdb->update(
                    $divinationTable,
                    array(
                        'name' => $_POST['name'],
                        'slug' => $_POST['slug'],
                        'description' => $_POST['description'],
                        'thumb' => $_POST['thumb'],
                        'created_at' => date("Y-m-d H:i:s"),
                    ),
                    array(
                        'id' => $_GET['id'],
                    ),
                    array( '%s', '%s', '%s','%s', '%s'),
                    array( '%d')
                );
                $lastServiceId = $wpdb->insert_id;

                //Обрабатываем пивот

                $wpdb->delete( $divinationPivotTable,
                    array( 'divination_id' => $_GET['id'] ),
                    array( '%d' )
                );

                $values = array();
                $place_holders = array( '%s', '%s');
                if(isset($_POST['elements'])){
                    foreach ($_POST['elements'] as $element){
                        $wpdb->insert(
                            $divinationPivotTable,
                            array(
                                'divination_id' => $_GET['id'],
                                'divination_element_id' => $element['id'],
                                'description' => $element['description'],
                                'thumb' => $element['thumb']
                            ),
                            $place_holders
                        );
                    }
                }

            }
            ?>
            <?php if(isset($_GET['id'])):?>
                <?php
                $divinationTable = $wpdb->get_blog_prefix().'br_divinations';
                $divinationElementsTable = $wpdb->get_blog_prefix().'br_divination_elements';
                $divinationPivotTable = $wpdb->get_blog_prefix().'br_divination_elements_pivot';
                $id = $_GET['id'];
//                $sql = "SELECT * from `$divinationTable` WHERE id = $id";
                $wpdb->query('SET SESSION group_concat_max_len = 1000000;');
                $sql = '
                    SELECT 
                        D.id,
                        D.name,
                        D.slug,
                        D.description,
                        D.thumb,
                        D.created_at,
                        group_concat("{\"id\":\"",IFNULL(DE.id, "NULL"),"\",\"name\":\"",IFNULL(DE.name, "NULL"),"\",\"slug\":\"",IFNULL(DE.slug, "NULL"),"\",\"class\":\"",IFNULL(DE.class, "NULL"),"\",\"description\":\"",IFNULL(DE.description, "NULL"),"\",\"thumb\":\"",IFNULL(DE.thumb, "NULL"),"\",\"created_at\":\"",IFNULL(DE.created_at, "NULL"),"\",\"pivot_thumb\":\"",IFNULL(DP.thumb, "NULL"),"\",\"pivot_description\":\"",IFNULL(DP.description, "NULL"),"\"}") as elements 
                    from '.$divinationTable.' D
                    LEFT JOIN '.$divinationPivotTable.' DP on DP.divination_id = D.id
                    LEFT JOIN '.$divinationElementsTable.' DE on DP.divination_element_id = DE.id
                    ORDER BY D.id DESC';
                $divination = $wpdb->get_row( $sql , ARRAY_A );
//                var_dump($divination);

                $str3 = str_replace("\n","", str_replace("\r","", $divination['elements']));
                $divination['elements'] = json_decode('['.$str3.']',true);

                $sql = "SELECT id,name from `$divinationElementsTable`";
                $divinationElements = $wpdb->get_results( $sql , ARRAY_A );
                ?>
                <form action="/wp-admin/admin.php?page=br_divination_list&type=edit<?php if(isset($_GET['id'])){ echo "&id=$_GET[id]"; }?>" method="post">
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Название" <?php if(isset($divination['name'])){ echo "value='$divination[name]'"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <?php
                        $settings = array(
                            'teeny' => 0,
                            'textarea_rows' => 5,
                            'tabindex' => 1,
                            'textarea_name' => 'description',
                        );
                        wp_editor($divination['description'],'divination_description', $settings);
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="name">Метка</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Метка" <?php if(isset($divination['slug'])){ echo "value='$divination[slug]'"; }?>>
                    </div>

                    <div class="form-group">
                        <label>Элементы</label>
                        <?php if ('NULL' !== $divination['elements'][0]['id']):?>
                        <?php foreach ($divination['elements'] as $element): ?>
                            <div class="element" id="element_<?php echo $element['id']; ?>" data-element-id="<?php echo $element['id']; ?>"  style="border: 1px #cccccc dashed; padding: 15px; margin-bottom: 15px">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="thumb">Связанный элемент</label>
                                            <select class="form-control" id="elements[<?php echo $element['id']; ?>][id]" name="elements[<?php echo $element['id']; ?>][id]">
                                                <option selected disabled value="">Выберите пункт</option>
                                                <?php foreach ($divinationElements as $divinationElement): ?>
                                                    <option value="<?php echo $divinationElement['id']; ?>" <?php if($divinationElement['id']== $element['id']){ echo 'selected';}?>>
                                                        <?php echo $divinationElement['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="thumb">Миниатюра</label>
                                            <input type="text" class="form-control" id="thumb" name="elements[<?php echo $element['id']; ?>][thumb]" placeholder="Миниатюра" <?php if(isset($element['pivot_thumb'])){ echo "value='$element[pivot_thumb]'"; }?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="description">Описание</label>
                                            <?php
                                            $settings = array(
                                                'teeny' => 0,
                                                'textarea_rows' => 5,
                                                'tabindex' => 1,
                                                'textarea_name' => 'elements['.$element['id'].'][description]',
                                            );
                                            wp_editor($element['pivot_description'],''.$element['id'].'_description', $settings);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-danger del-element-btn" data-element-id="<?php echo $element['id']; ?>">Удалить элемент</button>
                            </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <button id="add-element-btn" class="btn btn-primary">Добавить элемент</button>
                    </div>

                    <div class="form-group">
                        <label for="thumb">Миниатюра</label>
                        <input type="text" class="form-control" id="thumb" name="thumb" placeholder="Миниатюра" <?php if(isset($divination['thumb'])){ echo "value='$divination[thumb]'"; }?>>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <?php
                        $settings = array(
                            'teeny' => true,
                            'textarea_rows' => 5,
                            'tabindex' => 1
                        );
                        wp_editor($divination['description'],'description', $settings);
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
    <?php else:?>
        <?php
        $divinationTable = $wpdb->get_blog_prefix().'br_divinations';

        $sql = "SELECT * from `$divinationTable` ORDER BY `id` DESC ";
        $divinations = $wpdb->get_results( $sql , ARRAY_A );
        ?>

        <table class="table table-striped table-hover table-responsive table-bordered">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Надвание</th>
                <th scope="col">Ярлык</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($divinations as $divination): ?>
                <tr>
                    <td><?php echo $divination['id']; ?></td>
                    <td><?php echo $divination['name']; ?></td>
                    <td><?php echo $divination['slug']; ?></td>
                    <td><a href="?page=br_divination_list&type=edit&id=<?php echo $divination['id']; ?>"><button class="btn btn-success">Изменить</button></a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif;?>
</div>

