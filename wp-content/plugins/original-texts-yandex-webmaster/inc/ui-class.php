<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Запчасти для фронта
 */
class OrtextUi {

    /**
     * Отобразит кнопку отправки текста в Я
     * @param int $post_id
     * @param array $arg
     */
    public static function buttonSentText($post_id, $arg = array()) {
        ?>
        <button data-postid="<?php echo $post_id; ?>" class="btn btn-success sentOriginalText"><img src="<?php echo plugins_url() . '/' . OrTextBase::PATCH_PLUGIN . '/img/load.gif'; ?>" class="view"> </i>  Отправить</button>
        <?php
    }

}
