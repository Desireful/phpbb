# Editor Settings

## Tabs vs Spaces
In order to make this as simple as possible, we will be using **tabs, not spaces**. You need to set your tab width, the amount of spaces a tab is displayed with, four (4) spaces in your editor. Make sure that when you **save** the file, it saves tabs and not spaces.

Tabs in front of lines cause no problems. Tabs in the middle of a line can be a problem if you have not set your tab width to four, the amount of spaces every one of us uses. Here is a short example of what it should look like:

	{TAB}$mode{TAB}{TAB}= request_var('mode', '');
	{TAB}$search_id{TAB}= request_var('search_id', '');

If you replace {TAB} with actual tabs and they are displayed correctly both equal signs need to be on the same column:

	____$mode_______= request_var('mode', '');
	____$search_id__= request_var('search_id', '');

## Line Breaks
Ensure that your editor is saving files in the UNIX (LF) line ending format. This means that lines are terminated with a newline, not with Windows Line endings (CR/LF combo) as they are on Windows or Classic Mac (CR) Line endings. Any decent editor should be able to do this, but it might not always be the default setting. Know your editor. If you want advice on an editor for your Operating System, just ask one of the developers. Some of them do their editing on Windows.

## Trailing Spaces
There should not be any whitespace in the end of a line. If your editor has an option to auomatically delete such whitespace, turn it on.

## End of File
The last line of the file should end with a line feed (LF), meaning it ends with an empty line. This is necessary so that appending a line will not mark the previous line as changed in a diff for the addition of a newline character.

# File Header

## Standard File Header
This template of the header must be included at the beginning of all phpBB files:

	<?php
	/**
	 * This file is part of phpBB
	 *
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * any later version accepted by phpBB Ltd. in accordance with section
	 * 14 of the GNU General Public License.
	 *
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 *
	 * @package   <PACKAGENAME>
	 * @copyright 2010 phpBB Ltd.
	 * @license   http://www.gnu.org/licenses/gpl.txt
	 *            GNU General Public License
	 * @version   Release: @package_version@
	 */

The macro `@package_version@` is automatically replaced when generating documentation. The `PACKAGENAME` depends on what part of phpBB this file belongs to, more on this can be found in the directory structure document. The default package name is `phpBB`.

If an author has not signed a Fiduciary License Agreement (FLA) and does not intend to do so he needs to be listed in the copyright notice, too. This is only an option if the person has only contributed to a very small number of files. It does however require at least one significant contribution to the file (not a one line bug fix). The author will not separately be listed in the AUTHORS file listing all contributors who have signed the FLA.

	 * @copyright 2010 phpBB Ltd.
	 * @copyright 2010 AUTHORNAME

Or if he is the only author:

	 * @copyright 2010 AUTHORNAME

## Files containing inline code
In these files you have to place an empty comment directly after the header to prevent the documentor from assigning the header to the first code element found.

	/**
	 * {HEADER}
	 */

	/**
	 */
	{CODE}

## Files containing only classes or functions
Every class and method or function must be preceded by a docblock documenting with at least one sentence what it does, all of its parameters the return value and respectively their types. If the function does not return a value the type should be specified as `void`. Classes require that you specify an `@package` annotation, it is the same as the header package name. Additional documentation is optional.

## Code following the header but otherwise only classes or functions
The best method to avoid documentation confusions in this case is adding an ignore command, for example:

	/**
	 * {HEADER}
	 */

	/**
	 * @ignore
	 */
	Small code snipped, mostly one or two defines or an if statement

	/**
	 * {DOCUMENTATION}
	 */
	class ...

# File Footer
PHP files should not be closed with a closing PHP tag (`?>`) to avoid issues with whitespace inserted after it.

*****

# Code Structure & Style
Please note that these Guidelines applies to all PHP, HTML, Javascript and CSS files as far as that makes sense for the language.

## Naming Conventions
We use camel-case for all identifiers but constants. When using an abbreviation you should use multiple upper-case characters, e.g. `someDOMFunction`. We do not use any form of hungarian notation in our naming conventions. Many of us believe that hungarian naming is one of the primary code obfuscation techniques currently in use.

### Variable Names
Variable and attribute names should start with a lower-case character. Each following word in the name should begin with an upper-case character. Example:</p>

`$currentUser` is right, but `$currentuser` and `$current_user` are not.

Names should be descriptive, but concise. We don't want huge sentences as our variable names, but typing an extra couple of characters is always better than wondering what exactly a certain variable is for.

### Loop Indices
The *only* situation where a one-character variable name is allowed is when it's the index for some looping construct. In this case, the index of the outer loop should always be $i. If there's a loop inside that loop, its index should be $j, followed by $k, and so on. If the loop is being indexed by some already-existing variable with a meaningful name, this guideline does not apply, example:

	for ($i = 0; $i < $outerSize; $i++)
	{
		for ($j = 0; $j < $innerSize; $j++)
		{
			foo($i, $j);
		}
	}

### Method & Function Names
Functions should also be named descriptively. We're not programming in C here, we don't want to write functions called things like `stristr()`. Again, always begin with lower case character, words start with a single upper-case character, the rest lower-case. Function names should preferably have a verb in them somewhere. Good method names are `printLoginStatus()`, `getUserData()`, etc.

### Method Parameters
Parameters are subject to the same guidelines as variable names. We don't want a bunch of methods like: `doStuff($a, $b, $c)`. In most cases, we'd like to be able to tell how to use a function by just looking at its declaration.

### Classes and Interfaces
There should only be one class or interface in one file. The filename should be identical to the class or interface name. Class and interface names start with an upper-case character, words start with an upper-case character, and the rest is lower-case. A classname could be `SessionStorage` and should then be saved in a file named `SessionStorage.php`. All Interface names should end in `Interface`.

### Namespaces
All files in the phpBB library need to begin with a namespace declaration matching their path. For example `lib/phpBB/Session/StorageInterface.php` would begin with the following after the file header:

	namespace phpBB\Session;

	/**
	* StorageInterface comment.
	*/
	interface StorageInterface
	{

### Summary
The basic philosophy here is to not hurt code clarity for the sake of laziness. This has to be balanced by a little bit of common sense, though; `printLoginStatusForAGivenUser()` goes too far, for example -- that function would be better named `printUserLoginStatus()`, or just `print_login_status()`.

### Special Terms
For all emoticons use the term `smiley` in singular and `smilies` in plural.

## Code Layout

###Always include the braces
This is another case of being too lazy to type 2 extra characters causing problems with code clarity. Even if the body of some construct is only one line long, do *not* drop the braces. Just don't, examples:

These are all wrong:

	if (condition) doStuff(); // Wrong

	if (condition) // Wrong
		doStuff();

	while (condition) // Wrong
		doStuff();

	for ($i = 0; $i < size; $i++) // Wrong
		doStuff($i);

These are all right:

	if (condition) // Right
	{
		doStuff();
	}

	while (condition) // Right
	{
		doStuff();
	}

	for ($i = 0; $i < size; $i++) // Right
	{
		doStuff();
	}

### Where to put the braces
This one is a bit of a holy war, but we're going to use a style that can be summed up in one sentence: Braces always go on their own line. The closing brace should also always be at the same column as the corresponding opening brace, examples:

	if (condition)
	{
		while (condition2)
		{
			...
		}
	}
	else
	{
		...
	}

	for ($i = 0; $i < $size; $i++)
	{
		...
	}

	while (condition)
	{
		...
	}

	function doStuff()
	{
		...
	}

### Use spaces between tokens
This is another simple, easy step that helps keep code readable without much effort. Whenever you write an assignment, expression, etc.. Always leave *one* space between the tokens. Basically, write code as if it was English. Put spaces between variable names and operators. Don't put spaces just after an opening bracket or before a closing bracket. Don't put spaces just before a comma or a semicolon. This is best shown with a few examples, examples:</p>

Each pair shows the wrong way followed by the right way.

	$i=0;
	$i = 0;

	if($i<7) ...
	if ($i < 7) ...

	if ( ($i < 7)&&($j > 8) ) ...
	if ($i < 7 && $j > 8) ...

	doStuff( $i, 'foo', $b );
	doStuff($i, 'foo', $b);

	for($i=0; $i<$size; $i++) ...
	for ($i = 0; $i < $size; $i++) ...

	$i=($j < $size)?0:1;
	$i = ($j < $size) ? 0 : 1;

### Operator precedence
Do you know the exact precedence of all the operators in PHP? Neither do I. Don't guess. Always make it obvious by using brackets to force the precedence of an equation so you know what it does. Remember to not over-use this, as it may harden the readability. Basically, do not enclose single expressions. Examples:

What's the result? Who knows.

	$bool = ($i < 7 && $j > 8 || $k == 4); // Bad

Now you can be certain what I'm doing here.

	$bool = ((($i < 7) && ($j < 8)) || ($k == 4));

But this one is even better, because it is easier on the eye but the intention is preserved.

	$bool = (($i < 7 && $j < 8) || $k == 4);

### Quoting strings
There are two different ways to quote strings in PHP - either with single quotes or with double quotes. The main difference is that the parser does variable interpolation in double-quoted strings, but not in single quoted strings. Because of this, you should *always* use single quotes *unless* you specifically need variable interpolation to be done on that string.

Also, if you are using a string variable as part of a function call, you do not need to enclose that variable in quotes. Again, this will just make unnecessary work for the parser. Note, however, that nearly all of the escape sequences that exist for double-quoted strings will not work with single-quoted strings. Be careful, and feel free to break this guideline if it's making your code easier to read, examples:

Wrong:

	$string = "This is a really long string with no variables.";
	doStuff("$string");

Right:

	$string = 'This is a really long string with no variables.';
	doStuff($string);

Sometimes single quotes are just not right

	$post_url = $phpbb_root_path . 'posting.' . $phpEx . '?mode=' . $mode . '&amp;start=' . $start;

Double quotes are sometimes needed to not overcroud the line with concentinations

	$post_url = "{$phpbb_root_path}posting.$phpEx?mode=$mode&amp;start=$start";

### Associative array keys
In PHP, it's legal to use a literal string as a key to an associative array without quoting that string. We don't want to do this -- the string should always be quoted to avoid confusion. Note that this is only when we're using a literal, not when we're using a variable, examples:</p>

Wrong:

	$foo = $assoc_array[blah];

Right:

	$foo = $assoc_array['blah'];

Wrong:

	$foo = $assoc_array["$var"];

Right:

	$foo = $assoc_array[$var];

### Comments
Every class, method and function must be preceded by a docblock that tells a programmer everything they need to know to use it. The meaning of every parameter, the expected input, and the output are required as a minimal comment. The function's behaviour in error conditions (and what those error conditions are) should also be present.

Especially important to document are any assumptions the code makes, or preconditions for its proper operation. Any one of the developers should be able to look at any part of the application and figure out what's going on in a reasonable amount of time.

Avoid using `/* */` comment blocks for one-line comments, `//` should be used for one/two-liners.

Example:

	/**
	 * Returns the first character of the given string.
	 *
	 * @param    string $string  An arbitrary string
	 * @return   string          Single character
	 */
	function firstCharacter($text)
	{
		// the first character is at index 0
		return $text[0];
	}

### Typecasting
Typecast variables where it is needed, do not rely on the correct variable type (PHP is currently very loose on typecasting which can lead to security problems if a developer does not have a very close eye to it). Never use the same variable with two different types.

Wrong:
	$input = (int) $input;

Right:
	$number = (int) $input;

### Type Hinting
Make use of type hinting in method declarations whenever you can. Type hinting should be used for object and array parameters. Try to always use an interface for type hinting rather than a concrete class.

Wrong:

	function parseFiles(MyParserClass $parser, $files);

Right:

	function parseFiles(ParserInterface $parser, array $files);

### Magic Numbers
Don't use them. Use named constants for any literal value other than obvious special cases. Basically, it's ok to check if an array has 1 element by using the literal 1. It's not ok to assign some special meaning to a number and then use it everywhere as a literal. This hurts readability AND maintainability. The constants `true` and `false` should be used in place of the literals 1 and 0 -- even though they have the same values (but not type!), it's more obvious what the actual logic is when you use the named constants.

### Shortcut operators
The only shortcut operators that cause readability problems are the shortcut increment `$i++` and decrement `$j--` operators. These operators should not be used as part of an expression. They can, however, be used on their own line. Using them in expressions is just not worth the headaches when debugging, examples:

Wrong:

	$array[++$i] = $j;
	$array[$i++] = $k;

Right:
	$i++;
	$array[$i] = $j;

	$array[$i] = $k;
	$i++;

### Inline conditionals
Inline conditionals should only be used to do very simple things. Preferably, they will only be used to do assignments, and not for function calls or anything complex at all. They can be harmful to readability if used incorrectly, so don't fall in love with saving typing by using them, examples:

Bad place to use them:

	($i < $size && $j > $size) ? doStuff($foo) : doStuff($bar);

Good place to use them

	$min = ($i < $j) ? $i : $j;

### Never use uninitialised variable
Develop with the highest level of run-time error reporting. This will report the use of an uninitialized variables as a notice. These notices can be avoided by using the built-in isset() function to check whether a variable has been set - but preferably the variable is always initialised. For checking if an array has a key set this can come in handy though, examples:

Wrong:

	if ($forum) ...

Right:

	if (isset($forum)) ...

Also possible:
if (isset($forum) && $forum == 5)

The `empty()` function is useful if you want to check if a variable is not set or empty (an empty string, 0 as an integer or string, NULL, false or an empty array). Therefore empty should be used in favor of `isset($array) && sizeof($array) > 0` - this can be written in a shorter way as `!empty($array)`.

### Switch statements
Switch/case code blocks can get a bit long sometimes. To have some level of notice and being in-line with the opening/closing brace requirement (where they are on the same line for better readability), this also applies to switch/case code blocks and the breaks. An example:

Wrong:

	switch ($mode)
	{
		case 'mode1':
			// I am doing something here
			break;
		case 'mode2':
			// I am doing something completely different here
			break;
	}

Good:

	switch ($mode)
	{
		case 'mode1':
			// I am doing something here
		break;

		case 'mode2':
			// I am doing something completely different here
		break;

		default:
			// Always assume that a case was not caught
		break;
	}

Also good, if you have more code between the case and the break

	switch ($mode)
	{
		case 'mode1':

			// I am doing something here

		break;

		case 'mode2':

			// I am doing something completely different here

		break;

		default:

			// Always assume that a case was not caught

		break;
	}

Even if the break for the default case is not needed, it is sometimes better to include it just for readability and completeness.

If no break is intended, please add a comment instead. An example:

Example with no break

	switch ($mode)
	{
		case 'mode1':
			// I am doing something here
		// no break here

		case 'mode2':
			// I am doing something completely different here
		break;

		default:
			// Always assume that a case was not caught
		break;
	}

## Optimizations

### Operations in loop definition
Always try to optimize your loops if operations are going on at the comparing part, since this part is executed every time the loop is passed through. For assignments a descriptive name should be chosen. Example:

Bad, on every iteration the sizeof function is called

	for ($i = 0; $i < sizeof($postData); $i++)
	{
		doSomething();
	}

Good, you are able to assign the (not changing) result within the loop itself

	for ($i = 0, $size = sizeof($postData); $i < $size; $i++)
	{
		doSomething();
	}

### Use of in_array()
Try to avoid using `in_array()` on huge arrays, and try not to place them into loops if the array to check consists of more than 20 entries. `in_array()` can be very time consuming and uses a lot of cpu processing time. For little checks it is not noticable, but if checked against a huge array within a loop those checks alone can take a lot of time. If you need this functionality, try using isset() on the arrays keys instead. You can shift the values into keys and vice versa. A call to `isset($array[$var])` is a lot faster than `in_array($var, array_keys($array))` for example.


## Other Guidelines

### User Input
Never trust user input. Use the filtering functionality provided by the framework to sanitize user input before use.

### PHP Identifier Preferences
Some of these choices are arbitrary and have no benefit other than to be consistant over the code.

* Use `static public` instead of `public static`, also applies for private and protected.
* Use `sizeof` instead of `count`.
* Use `strpos` instead of `strstr` to determine if a substring occurs within a string.
* Use `else if` instead of `elseif`.
* Use `false` (lowercase) instead of `FALSE`.
* Use `true` (lowercase) instead of `TRUE`.
* Use `null` (lowercase) instead of `NULL`.

# Character Sets and Encodings

## What are Unicode, UCS and UTF-8?
The [Universal Character Set (UCS)](http://en.wikipedia.org/wiki/Universal_Character_Set) described in ISO/IEC 10646 consists of a large amount of characters. Each of them has a unique name and a code point which is an integer number. [Unicode](http://en.wikipedia.org/wiki/Unicode) - which is an industry standard - complements the Universal Character Set with further information about the characters' properties and alternative character encodings. More information on Unicode can be found on the [Unicode Consortium's website](http://www.unicode.org/). One of the Unicode encodings is the [8-bit Unicode Transformation Format (UTF-8)](http://en.wikipedia.org/wiki/UTF-8). It encodes characters with up to four bytes aiming for maximum compatibility with the [American Standard Code for Information Interchange](http://en.wikipedia.org/wiki/ASCII) which is a 7-bit encoding of a relatively small subset of the UCS.

## phpBB's use of Unicode
Unfortunately PHP does not faciliate the use of Unicode prior to version 6. Most functions simply treat strings as sequences of bytes assuming that each character takes up exactly one byte. This behaviour still allows for storing UTF-8 encoded text in PHP strings but many operations on strings have unexpected results. To circumvent this problem we have created some alternative functions to PHP's native string operations which use code points instead of bytes. A lot of native PHP functions still work with UTF-8 as long as you stick to certain restrictions. For example `explode` still works as long as the first and the last character of the delimiter string are ASCII characters.

phpBB only uses the ASCII and the UTF-8 character encodings. Still all Strings are UTF-8 encoded because ASCII is a subset of UTF-8. The only exceptions to this rule are code sections which deal with external systems which use other encodings and character sets. Such external data should be converted to UTF-8.

## Unicode Normalization
If you retrieve user input with multibyte characters you should additionally normalize the string before you work with it. This is necessary to make sure that equal characters can only occur in one particular binary representation. For example the character &#197; can be represented either as `U+00C5` (LATIN CAPITAL LETTER A WITH RING ABOVE) or as `U+212B` (ANGSTROM SIGN). phpBB uses Normalization Form Canonical Composition (NFC) for all text.

## Case Folding

Case insensitive comparison of strings is no longer possible with `strtolower` or `strtoupper` as some characters have multiple lower case or multiple upper case forms depending on their position in a word. Since `utf8_strtolower` and `utf8_strtoupper` functions suffer from the same problem they can only be used to display upper/lower case versions of a string but they cannot be used for case insensitive comparisons either. Instead you should use case folding which gives you a case insensitive version of the string which can be used for case insensitive comparisons.

*****

# License and copyright
This application is opensource software released under the <a href="http://opensource.org/licenses/gpl-license.php">GPL</a>. Please see source code and the docs directory for more details. This package and its contents are Copyright (c) 2000, 2002, 2005, 2007, 2010 <a href="http://www.phpbb.com/">phpBB Ltd.</a>.
