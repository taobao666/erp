<?php

class UploadController extends ControllerBase
{

    public function IndexAction()
    {

    }

    /**
     * 异步上传处理，接受Callback参数
     */
    public function asyncAction()
    {
//        var_dump($_POST);die();
        try {
            $path           = $this->request->getPost('path', 'string', 'tmp');
            $this->fileName = $this->request->getPost('fileName', 'string', '');
            $uploadFile = $this->_getUploadFile();
//            var_dump($uploadFile);die();
            if ($uploadFile != null) {
                $tempFile                 = $this->_mkTempFileNameWithPath($uploadFile, $path);
                $filename                 = $this->_mvUploadFileToTemp($uploadFile, $tempFile);
                $data['data']['tempFile'] = $filename;
                $data['data']['path']     = $path;
                $data['code']             = 1;
            } else {
                $data['code'] = -1;
                $data['msg']  = '没有收到文件';
            }
        } catch (\Phalcon\Exception $e) {
            $data['code'] = $e->getCode();
            $data['msg']  = $e->getMessage();

        }
        echo json_encode($data);
        die();
    }

    /**
     * 获得上传的临时文件
     * @return null|\Phalcon\Http\Request\FileInterface
     */
    private function _getUploadFile()
    {
        $uploadFile = null;
        if ($this->request->hasFiles() == true) {
            foreach ($this->request->getUploadedFiles() as $file) {
                $uploadFile = $file;
                break;
            }
        }
        return $uploadFile;
    }

    /**
     * 根据文件名、路径生成临时文件名
     * @param $uploadFile
     * @param $path
     * @return string
     */
    private function _mkTempFileNameWithPath($uploadFile, $path = '')
    {
        $filename = $uploadFile->getName();
        $ext      = $this->getExtNameByFilename($filename);
        if (empty($this->fileName)) {
            $file = "/" . $path . "/" . date("Y/m/d") . "/" . md5($filename) . "." . $ext;
        } else {
            if (strpos($this->fileName, '.') !== false) {
                $file = "/" . $path . "/" . date("Y/m/d") . "/" . $this->fileName;
            } else {
                $file = "/" . $path . "/" . date("Y/m/d") . "/" . $this->fileName . "." . $ext;
            }
        }

        return $file;
    }

    /**
     * 保存上传文件到临时目录
     * @param $uploadFile
     * @param $tempFile
     * @return mixed
     */
    private function _mvUploadFileToTemp($uploadFile, $tempFile)
    {
        $realFile = UPLOAD_PATH . $tempFile;
        $path     = dirname($realFile);
        $this->loopMakeDir($path);
        $uploadFile->moveTo($realFile);
        return $tempFile;
    }

    private function getExtNameByFilename($filename)
    {
        if (false === stripos($filename, ".")) {
            return "";
        }
        $tmpArr = explode(".", $filename);
        return array_pop($tmpArr);
    }

    private function loopMakeDir($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) {
            chmod($dir, $mode);
            return true;
        }
        if (!$this->loopMakeDir(dirname($dir), $mode)) {
            return false;
        }
        return @mkdir($dir, $mode);
    }
}
