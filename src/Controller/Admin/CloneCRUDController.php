<?php

namespace App\Controller\Admin;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CloneCRUDController extends CRUDController
{
    public function cloneAction(int $id)
    {
        $object = $this->admin->getSubject();

        if (!$object) {
            throw new NotFoundHttpException(sprintf('Невозможно найти объект с таким id: %s', $id));
        }

        $clonedObject = clone $object;
        $object = $this->admin->create($clonedObject);

        $this->addFlash('sonata_flash_success', 'Копия успешно создана.');

        return new RedirectResponse($this->admin->generateObjectUrl('edit', $object));
    }
}