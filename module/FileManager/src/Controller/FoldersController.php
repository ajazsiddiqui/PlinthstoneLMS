<?php

namespace FileManager\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use FileManager\Form\UploadForm;
use FileManager\Entity\Files;

class FoldersController extends AbstractActionController
{
    private $_dir;
    private $authService;
    private $entityManager;
    private $logManager;
    private $LMSUtilities;
    private $logger;

    public function __construct($dir, $authService, $entityManager, $logManager, $LMSUtilities, $logger)
    {
        $this->_dir = $dir;
        $this->authService = $authService;
        $this->entityManager = $entityManager;
        $this->logManager = $logManager;
        $this->LMSUtilities = $LMSUtilities;
        $this->logger = $logger;
    }

    public function init()
    {
        $dir = $this->_dir;
        if ($user = $this->identity()) {
        } else {
            return $this->redirect()->toRoute('login');
        }

        if (!is_dir($dir)) {
            mkdir($_dir, 0777);
        }
        $this->dir = realpath($dir) . DIRECTORY_SEPARATOR . '';
    }


    public function createFolder($folder_name)
    {
        if (!empty($folder_name)) {
            if (!file_exists($this->_dir. DIRECTORY_SEPARATOR . $folder_name)) {
                mkdir($this->_dir. DIRECTORY_SEPARATOR . $folder_name, 0777, true);

                try {
                    $folder = new Folders();
                    $folder->setFolderName($folder_name);
                    $this->entityManager->persist($folder);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $log = $this->logManager;
                $log->setlog('New Folder Created', $folder_name, $this->authService->getIdentity());

                $this->flashMessenger()->addSuccessMessage('New Folder Created ', $folder_name);
            } else {
                $this->flashMessenger()->addErrorMessage('Folder already exist ', $folder_name);
            }
        }
        return $this->redirect()->toRoute('folders');
    }

    public function indexAction()
    {
        $this->init();
        $form = new UploadForm($this->_dir, 'upload-form');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($post);

            if ($form->isValid()) {
                $data = $form->getData();
                $this->setFileNames($data, $this->_dir. DIRECTORY_SEPARATOR . 'Files'. DIRECTORY_SEPARATOR);
            } else {
                $this->logger->info('form validator: ', $form->getMessages(), "\n");
            }
            $this->flashMessenger()->addErrorMessage($form->getMessages());
            return $this->redirect()->toRoute('folders');
        }

        $files = $this->entityManager->getRepository(Files::class)
                   ->findBy([], ['id'=>'ASC']);

        return new ViewModel(array('form' => $form, 'files' => $files, 'dir' => $this->_dir));
    }

    public function deleteAction()
    {
        $this->init();
        $file = urldecode($this->params()->fromRoute('file'));

        $files = $this->entityManager->getRepository(Files::class)
                ->find($file);
        $this->entityManager->remove($files);
        $this->entityManager->flush();

        unlink($this->_dir . DIRECTORY_SEPARATOR .'Files'. DIRECTORY_SEPARATOR .$files->getName());

        $log = $this->logManager;
        $log->setlog('File Deleted', $files->getName(), $this->authService->getIdentity());

        $this->flashMessenger()->addSuccessMessage($files->getName(). ' deleted successfully');
        return $this->redirect()->toRoute('folders');
    }


    public function downloadAction()
    {
        $id = $this->params()->fromRoute('file');

        $file = $this->entityManager->getRepository(Files::class)
                ->findOneBy(['id'=>$id]);

        $path = $this->_dir . DIRECTORY_SEPARATOR .'Files'. DIRECTORY_SEPARATOR .$file->getName();

        if (!is_readable($path)) {
            // Set 404 Not Found status code
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Get file size in bytes
        $fileSize = filesize($path);

        // Write HTTP headers
        $response = $this->getResponse();
        $headers = $response->getHeaders();
        $headers->addHeaderLine(
                "Content-type: application/octet-stream"
       );
        $headers->addHeaderLine(
                "Content-Disposition: attachment; filename=\"" .
               $file->getName() . "\""
       );
        $headers->addHeaderLine("Content-length: $fileSize");
        $headers->addHeaderLine("Cache-control: private");

        // Write file content
        $fileContent = file_get_contents($path);
        if ($fileContent!=false) {
            $response->setContent($fileContent);
        } else {
            // Set 500 Server Error status code
            $this->getResponse()->setStatusCode(500);
            return;
        }
        // Return Response to avoid default view rendering
        return $this->getResponse();
    }


    //function modified for ajax upload

    protected function setFileNames($data, $path)
    {
        unset($data['submit']);
        foreach ($data as $file) {
            if (file_exists($path. DIRECTORY_SEPARATOR . $file['name'])) {
                $this->flashMessenger()->addErrorMessage($file['name'] . ' File already exist');
            } else {
                rename($file['tmp_name'], $path. $file['name']);

                try {
                    $newfile = new Files();
                    $newfile->setName($file['name']);
                    $this->entityManager->persist($newfile);
                    $this->entityManager->flush();
                } catch (Exception $e) {
                    $this->logger->info('Caught exception: ', $e->getMessage(), "\n");
                }

                $this->flashMessenger()->addSuccessMessage($file['name'] . ' File Uploaded');

                $log = $this->logManager;
                $log->setlog('File Uploaded', $file['name'], $this->authService->getIdentity());
            }
        }
    }
}
