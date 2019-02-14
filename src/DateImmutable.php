<?php namespace Valentine;

class DateImmutable extends AbstractDate {

	public static function createFromDateTime(\DateTime $date): self { return new static($date->format('Y-m-d')); }
	public static function createFromFormat(string $date = 'today', $format = 'Y-m-d'): self { return new static($date, $format); }
	public static function createFromWeek($year, $week, $day = 1): self { return static::createFromDateTime((new \DateTime())->setISODate($year, $week, $day)); }

	public function copy(): self { return $this->copyImmutable(); }

	public function getDate(): \DateTime { return (new \DateTime())->setDate($this->year, $this->month, $this->day); }
}