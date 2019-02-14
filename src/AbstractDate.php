<?php namespace Valentine;

/**
 * @property-read int $year
 * @property-read int $month
 * @property-read string $month00
 * @property-read int $day
 * @property-read string $day00
 * @property-read int $dayOfWeek
 * @property-read int $dayOfWeekISO
 * @property-read int $dayOfWeekM0
 * @property-read int $dayOfWeekM1
 * @property-read int $dayOfWeekS0
 * @property-read int $dayOfWeekS1
 * @property-read int $yearOfWeek
 * @property-read int $week
 * @property-read bool $isLeapYear
 * @property-read int $dayOfYear
 * @property-read int $days
 */
abstract class AbstractDate {

	/** @var \DateTime */
	protected $date;

	public function __construct(string $date = 'today', $format = 'Y-m-d') {
		$this->date = $date === 'today' ? new \DateTime() : \DateTime::createFromFormat($format, $date);
		$this->resetTime();
	}

	public function copyMutable(): Date { return Date::createFromDateTime($this->date);}
	public function copyImmutable(): DateImmutable { return DateImmutable::createFromDateTime($this->date); }

	public function format($format):string { return $this->date->format($format); }
	public function __toString():string { return $this->date->format('Y-m-d'); }
	abstract public function getDate():\DateTime;

	public function diff(AbstractDate $diff):\DateInterval { return $this->date->diff($diff->getDate()); }
	public function diffDays(AbstractDate $diff):int { return (($diff = $this->date->diff($diff->getDate()))->invert ? -1 : 1) * $diff->days; }

	protected function resetTime() { $this->date->setTime(0, 0, 0, 0); }

	public function __get($name) {
		switch ($name) {
			case 'year':
				return intval($this->date->format('Y'));
				break;
			case 'month':
				return intval($this->date->format('n'));
				break;
			case 'month00':
				return $this->date->format('m');
				break;
			case 'day':
				return intval($this->date->format('j'));
				break;
			case 'day00':
				return $this->date->format('d');
				break;
			case 'dayOfWeekISO':
				return intval($this->date->format('N'));
				break;
			case 'dayOfWeek':
				return intval($this->date->format('w'));
				break;
			case 'dayOfWeekS0':
				return intval($this->date->format('w'));
				break;
			case 'dayOfWeekM0':
				return intval($this->date->format('N'));
				break;
			case 'dayOfWeekS1':
				return intval($this->date->format('w')) + 1;
				break;
			case 'dayOfWeekM1':
				return intval($this->date->format('N')) - 1;
				break;
			case 'week':
				return intval($this->date->format('W'));
				break;
			case 'yearOfWeek':
				return intval($this->date->format('o'));
				break;
			case 'isLeapYear':
				return (bool)intval($this->date->format('L'));
				break;
			case 'dayOfYear':
				return (bool)intval($this->date->format('z'));
				break;
			case 'days':
				return (bool)intval($this->date->format('t'));
				break;
		}
	}


}