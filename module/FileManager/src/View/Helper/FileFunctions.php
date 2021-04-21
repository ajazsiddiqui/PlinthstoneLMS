<?php
namespace FileManager\View\Helper;

use Zend\View\Helper\AbstractHelper;
use FileManager\Entity\Folders;

class FileFunctions extends AbstractHelper
{
    private $entityManager;
    
    public function __construct($authService, $entityManager)
    {
        $this->authService = $authService;
        $this->entityManager = $entityManager;
    }
    
    public function formatSizeUnits($path)
    {
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public function get_file_icon($path)
    {
        // get extension
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        switch ($ext) {
                case 'ico': case 'gif': case 'jpg': case 'jpeg': case 'jpc': case 'jp2':
                case 'jpx': case 'xbm': case 'wbmp': case 'png': case 'bmp': case 'tif':
                case 'tiff': case 'psd': case 'a1': case 'eps':
                    $img = 'fa fa-file-image-o';
                    break;
                case 'txt': case 'css': case 'ini': case 'conf': case 'log': case 'htaccess':
                case 'passwd': case 'ftpquota': case 'sql': case 'js': case 'json': case 'sh':
                case 'config': case 'twig': case 'tpl': case 'md': case 'gitignore':
                case 'less': case 'sass': case 'scss': case 'c': case 'cpp': case 'cs': case 'py':
                case 'map': case 'lock': case 'dtd':
                    $img = 'fa fa-file-o';
                    break;
                case 'zip': case 'rar': case 'gz': case 'tar': case '7z':
                    $img = 'fa fa-file-zip-o';
                    break;
                case 'php': case 'php4': case 'php5': case 'phps': case 'phtml':
                    $img = 'fa fa-file-code-o';
                    break;
                case 'htm': case 'html': case 'shtml': case 'xhtml':
                    $img = 'fa fa-file-code-o';
                    break;
                case 'xlsx': case 'xsl': case 'csv':
                    $img = 'fa fa-file-excel-o';
                    break;
                case 'wav': case 'mp3': case 'mp2': case 'm4a': case 'aac': case 'ogg':
                case 'oga': case 'wma': case 'mka': case 'flac': case 'ac3': case 'tds':
                case 'm3u': case 'm3u8': case 'pls': case 'cue':
                    $img = 'fa fa-file-audio-o';
                    break;
                case 'avi': case 'mpg': case 'mpeg': case 'mp4': case 'm4v': case 'flv':
                case 'f4v': case 'ogm': case 'ogv': case 'mov': case 'mkv': case '3gp':
                case 'asf': case 'wmv':
                    $img = 'fa fa-file-video-o';
                    break;
                case 'doc': case 'docx':
                    $img = 'fa fa-file-word-o';
                    break;
                case 'ppt': case 'pptx':
                    $img = 'fa fa-file-powerpoint-o';
                    break;
                case 'pdf':
                    $img = 'fa fa-file-pdf-o';
                    break;
                case 'exe': case 'msi':
                    $img = 'fa fa-terminal';
                    break;
                case 'bat':
                    $img = 'fa fa-terminal';
                    break;
                default:
                    $img = 'fa file-o';
            }
        return $img;
    }
        
    public function getFolderName($id)
    {
        $folder = $this->entityManager->getRepository(Folders::class)
               ->findOneBy(['id' => $id]);
        return $folder->getFolderName();
    }
}
