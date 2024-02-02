<?php

class Str
{
	/**
	 * Determine if a given string contains a given substring.
	 * @param  string  $haystack
	 * @param  string|iterable<string>  $needles
	 * @param  bool  $ignoreCase
	 * @return bool
	 */
	public static function contains($hayStack, $needles, $ignoreCase = false)
	{
		if ($ignoreCase) {
			$hayStack = mb_strtolower($hayStack);
		}

		if (!is_iterable($needles)) {
			$needles = (array)$needles;
		}

		foreach ($needles as $needle) {
			if ($ignoreCase) {
				$needle = mb_strtolower($needle);
			}

			if ($needle !== '' && str_contains($hayStack, $needle)) {
				return true;
			}
		}
		return false;
	}

	/**
	* Return the remainder of a string after the first occurrence of a given value.
	*
	* @param  string  $subject
	* @param  string  $search
	* @return string
	*/
	public static function after(string $subject, string $search) : string 
	{
		return $search === '' ? $subject : array_reverse(explode($search, $subject, 2))[0];
	}

	/**
	* Return the remainder of a string after the last occurrence of a given value.
	*
	* @param  string  $subject
	* @param  string  $search
	* @return string
	*/
	public static function afterLast(string $subject, string $search) : string 
	{
		if ($search === '') return $subject;

		$position = strrpos($subject, (string)$search);
	
		if($position === false) return $subject;

		return substr($subject, $position + strlen($search));
	}
}

// $repo = "www.github.comHTTPS://";
// $needles = ['https', 'http'];
// if (Str::contains($repo, $needles , true)) {
// 	print "Yup it's contained";
// } else { 
// 	print "Nope, it's not contained";
// }

print Str::after('stringToBeSearch', 'string') . PHP_EOL; // ToBeSearch
print Str::afterLast('stringToBeSearch', 'string') . PHP_EOL; // Search
