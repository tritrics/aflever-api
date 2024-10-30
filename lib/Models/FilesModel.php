<?php

namespace Tritrics\Ahoi\v1\Models;

use Kirby\Cms\File;
use Tritrics\Ahoi\v1\Data\Collection;
use Tritrics\Ahoi\v1\Helper\BlueprintHelper;

/**
 * Model for Kirby's fields: files
 */
class FilesModel extends BaseModel
{
  /**
   * Nodename for files.
   */
  protected $valueNodeName = 'entries';

  /**
   * Create a child entry instance
   */
  public function createEntry(
    ?File $model = null,
    ?Collection $blueprint = null,
    ?string $lang = null,
    array|string $addFields = 'all'
  ): Collection {
    return new FileModel($model, $blueprint, $lang, $addFields);
  }

  /**
   * Get additional field data (besides type and value)
   */
  protected function getProperties(): Collection
  {
    $res = new Collection();
    $meta = $res->add('collection');
    $meta->add('count', $this->model->toFiles()->count());
    return $res;
  }

  /**
   * Get the value of model.
   */
  protected function getValue (): Collection
  {
    $addFields = []; // no fields added on default, must be explizit set.
    if ($this->blueprint->node('api')->has('fields')) {
      $addFields = $this->blueprint->node('api')->node('fields')->get();
    }
    $res = new Collection();
    foreach ($this->model->toFiles() as $file) {
      $blueprint = BlueprintHelper::get($file);
      $model = $this->createEntry($file, $blueprint, $this->lang, $addFields);
      $res->push($model);
    }
    return $res;
  }
}