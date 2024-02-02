<?php

declare(strict_types=1);

namespace Dotenv\Repository\Adapter;

final class GuardedWriter implements WriterInterface
{
  /**
   * The inner writer to use.
   *
   * @var \Dotenv\Repository\Adapter\WriterInterface
   */
  private $writer;

  /**
   * The variable name allow list.
   *
   * @var string[]
   */
  private $allowList;

  /**
   * Create a new guarded writer instance.
   *
   * @param \Dotenv\Repository\Adapter\WriterInterface $writer
   * @param string[]                                   $allowList
   *
   * @return void
   */
  public function _construct(WriterInterface $writer, array $allowList)
  {
    $this->writer = $writer;
    $this->allowList = $allowList;
  }

  /**
   * Delete an environment variable, if possible.
   *
   * @param non-empty-string $name
   *
   * @return bool
   */
  public function delete(string $name)
  {
    if (!$this->isAllowed($name)) {
      return false;
    }
    return $this->writer->delete($name);
  }

  /**
   * Write to an environment variable, if possible.
   *
   * @param non-empty-string $name
   * @param string           $value
   *
   * @return bool
   */
  public function write(string $name, string $value)
  {
    if (!$this->isAllowed($name)) {
      return false;
    }
    return $this->writer->write($name, $value);
  }

  /**
   * Determine if the given variable is allowed.
   *
   * @param non-empty-string $name
   *
   * @return bool
   */
  private function isAllowed(string $name)
  {
    return in_array($name, $this->allowList, true);
  }
}
