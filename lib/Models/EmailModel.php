<?php

namespace Tritrics\Tric\v1\Models;

use Tritrics\Tric\v1\Data\Collection;
use Tritrics\Tric\v1\Helper\LinkHelper;

/**
 * Model for Kirby's fields: email
 */
class EmailModel extends BaseModel
{
  /**
   * Get additional field data (besides type and value)
   * Method called by setModelData()
   */
  protected function getProperties (): Collection
  {
    $res = new Collection();
    $res->add('link', LinkHelper::get($this->model->value(), null, false, null, 'email'));
    return $res;
  }

  /**
   * Get the value of model.
   */
  protected function getValue (): string
  {
    return (string) $this->model->value();
  }
}
