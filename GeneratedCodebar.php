<?php
/**
 * TODO 测试版，请不下下载使用
 */
namespace barcode\barcode;

use yii\base\Exception;

require_once('class' . DIRECTORY_SEPARATOR . 'BCGColor.php');
require_once('class' . DIRECTORY_SEPARATOR . 'BCGBarcode.php');
require_once('class' . DIRECTORY_SEPARATOR . 'BCGDrawing.php');
require_once('class' . DIRECTORY_SEPARATOR . 'BCGFontFile.php');
include_once('class' . DIRECTORY_SEPARATOR . 'BCGcode128.barcode.php');

/**
 *
 * Class GeneratedCodebar
 * @package barcode\barcode
 */
class GeneratedCodebar extends \yii\base\Widget
{
    public $message;

    public function init()
    {
        parent::init();
        if ($this->message == null) {
            throw new Exception('wrong message');
        }
    }

    public function run()
    {
/*        $className = 'BCGcodabar';
        $baseClassFile = 'BCGBarcode1D.php';
        $codeVersion = '5.0.2';*/

        $color_black = new \BCGColor(0, 0, 0);
        $color_white = new \BCGColor(255, 255, 255);

        $filetypes = array('PNG' => \BCGDrawing::IMG_FORMAT_PNG, 'JPEG' => \BCGDrawing::IMG_FORMAT_JPEG, 'GIF' => \BCGDrawing::IMG_FORMAT_GIF);

        $code_generated = new \BCGcode128();

        $this->baseCustomSetup($code_generated);

        $code_generated->setScale(max(1, min(4, 4)));
        $code_generated->setBackgroundColor($color_white);
        $code_generated->setForegroundColor($color_black);
        $code_generated->parse($this->message);

        $drawing = new \BCGDrawing('', $color_white);
        $drawing->setBarcode($code_generated);
        $drawing->setRotationAngle(0);
        $drawing->setDPI(72);
        $drawing->draw();
        header('Content-Type: image/png');
        $drawing->finish($filetypes['PNG']);
        return "Hello!";
    }

    public function baseCustomSetup($barcode)
    {
        $font_dir =  'font';

        $barcode->setThickness(max(9, min(90, 25)));
        $font = new \BCGFontFile(__DIR__.'/font/Arial.ttf', 15);

        $barcode->setFont($font);
    }

/*    public function customSetup($barcode, $get) {
        if (isset($get['checksum'])) {
            $barcode->setChecksum($get['checksum'] === '1' ? true : false);
        }
    }*/
}
