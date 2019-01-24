<?php

require_once( '../../../../../wp-load.php' );

global $wpdb;

$divinationElementsTable = $wpdb->get_blog_prefix().'br_divination_elements';

$sql = "SELECT id,name from `$divinationElementsTable`";
$divinationElements = $wpdb->get_results( $sql , ARRAY_A );

$sql = "SELECT * from `$divinationElementsTable` WHERE class='$_POST[groupOfElements]'";
$elementGroups = $wpdb->get_results( $sql , ARRAY_A );

foreach ($elementGroups as $element): ?>
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