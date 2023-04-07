<?php

namespace Lumis\StaffManagement\Entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Lumis\StaffManagement\Concerns\WithFinder;
use Storage;

/**
 * @property mixed $id
 * @property mixed $staff_id
 * @property string $name
 * @property string $type
 * @property string $size
 * @property string $mime
 * @property string $path
 * @property Staff $staff
 * @property DocumentType $documentType
 */
class Document extends Model
{
    use WithFinder, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_employees_staff_documents';

    /**
     * The primary key associated with the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['staff_id', 'name', 'type', 'size', 'mime', 'path'];


    /**
     * @return BelongsTo
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    /**
     * @return BelongsTo
     */
    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class, 'type');
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->documentType->name;
    }

    /**
     *
     * @param string $rootPath
     * @return string
     */
    public function filePath(string $rootPath): string
    {
        return Storage::path($rootPath . DIRECTORY_SEPARATOR . $this->path);
    }

    /**
     * @return string
     */
    public function fileName(): string
    {
        return $this->name . '.' . $this->mime;
    }

    /**
     * @return int|string
     */
    public function readableSize(): int|string
    {
        return $this->formatBytes($this->size, 0);
    }

    /**
     * @param int $size
     * @param int $precision
     * @return string
     */
    private function formatBytes(int $size, int $precision = 2): string
    {
        if ($size > 0) {
            $size = (int)$size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
}
