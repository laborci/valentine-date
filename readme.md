# Valentine date

Implementation of the missing Date class

## Read only properties

```
int $year
int $month
int $day

string $month00
	// the month with leading zeroes (01-12)
string $day00
	// the day with leading zeroes (01-31)

int $dayOfWeek
	// starts with Sunday indexed from 0
int $dayOfWeekISO
	// starts with Monday indexed from 0
int $dayOfWeekM0
	// starts with Monday indexed from 0
int $dayOfWeekM1
	// starts with Monday indexed from 1
int $dayOfWeekS0
	// starts with Sunday indexed from 0
int $dayOfWeekS1
	// starts with Sunday indexed from 1

int $week
	// ISO-8601 week number of year, weeks starting on Monday
int $yearOfWeek
	// the year of week can be different from the date’s year

bool $isLeapYear
	// whether it's a leap year
int $dayOfYear
	// the day of the year (starting from 0)
int $days
	// number of days in the given month
```

## Instantiation

```
public function __construct(string $date = 'today', $format = 'Y-m-d')
	// http://php.net/manual/en/datetime.createfromformat.php

static createFromFormat(string $date = 'today', $format = 'Y-m-d'): self
static createFromDateTime(\DateTime $date): self
static createFromWeek($year, $week, $day = 1): self
```
## Creating Copies

```
copyMutable(): Date
copyImmutable(): DateImmutable
copy(): self
```

## Stringify
```
format($format):string
__toString():string // Y-m-d
```

## Diff two dates

```
diff(Date|DateImmutable $diff):\DateInterval
diffDays(Date|DateImmutable $diff):int
	// returns signed integer
```

## Get the \DateTime object

- Date returns the embedded \DateTime object
- DateImmutable returns a copy of the \DateTime object

```
getDate(): \DateTime;
```

## Modify Dates (not available in DateImmutable)

```
modify($modify): $this;
	// http://php.net/manual/en/datetime.modify.php

add(int $year = 0, int $month = 0, int $day = 0, int $week = 0): $this;
sub(int $year = 0, int $month = 0, int $day = 0, int $week = 0): $this;
	// adds and subtracts years, months, days, weeks from/to the current date

setDate($year = null, $month = null, $day = null): $this
setWeek($week = null, $day = null, $year = null): $this;
	// if any argument’s value is null, it refers the current year, day, week, month

```
