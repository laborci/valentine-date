<?php namespace Valentine;


class Date extends AbstractDate {

	public static function createFromDateTime(\DateTime $date): self { return new static($date->format('Y-m-d')); }
	public static function createFromFormat(string $date = 'today', $format = 'Y-m-d'): self { return new static($date, $format); }
	public static function createFromWeek($year, $week, $day = 1): self { return static::createFromDateTime((new \DateTime())->setISODate($year, $week, $day)); }

	public function copy(): Date { return $this->copyMutable(); }

	public function getDate(): \DateTime { return $this->date; }

	public function modify($modify): Date {
		$this->date->modify($modify);
		$this->resetTime();
		return $this;
	}

	public function add(int $year = 0, int $month = 0, int $day = 0, int $week = 0): Date {
		$this->date->add(\DateInterval::createFromDateString("P" . ($year ? $year . 'Y' : '') . ($month ? $month . 'M' : '') . ($day ? $day . 'D' : '') . ($week ? $week . 'W' : '')));
		return $this;
	}

	public function sub(int $year = 0, int $month = 0, int $day = 0, int $week = 0): Date {
		$this->date->sub(\DateInterval::createFromDateString("P" . ($year ? $year . 'Y' : '') . ($month ? $month . 'M' : '') . ($day ? $day . 'D' : '') . ($week ? $week . 'W' : '')));
		return $this;
	}

	public function setDate($year = null, $month = null, $day = null): Date {
		$this->date->setDate(
			$year ?: $this->year,
			$month ?: $this->month,
			$day ?: $this->day
		);
		return $this;
	}

	public function setWeek($week = null, $day = null, $year = null): Date {
		$this->date->setISODate(
			$year ?: $this->year,
			$week ?: $this->week,
			$day ?: $this->dayOfWeekISO
		);
		return $this;
	}

}