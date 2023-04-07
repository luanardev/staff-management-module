<?php

namespace Lumis\StaffManagement\Observers;

use Exception;
use Lumis\StaffManagement\Entities\Document;
use Storage;

class DocumentObserver
{

    /**
     * Handle the "updated" event.
     *
     * @param Document $document
     * @return void
     */
    public function updated(Document $document): void
    {
        if ($document->wasChanged('path')) {
            $this->removeAttachment($document);
        }
    }

    /**
     * Remove file
     *
     * @param Document $document
     * @return void
     */
    protected function removeAttachment(Document $document): void
    {
        try {
            $path = $document->getOriginal('path');
            if (!empty($path) && file_exists(storage_path('app/public/' . $path))) {
                unlink(storage_path('app/public/' . $path));
            }
        } catch (Exception $ex) {
        }
    }

    /**
     * Handle the Document "deleted" event.
     *
     * @param Document $document
     * @return void
     */
    public function deleted(Document $document): void
    {
        try {
            $path = $document->path;
            if (!empty($path) && file_exists(storage_path('app/public/' . $path))) {
                unlink(storage_path('app/public/' . $path));
            }
        } catch (Exception $ex) {
        }

    }

}
