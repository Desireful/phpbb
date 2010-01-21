#!/usr/bin/php
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
 * @package   phpBB
 * @author    Nils Adermann <naderman@phpbb.com>
 * @copyright 2010 phpBB Ltd.
 * @license   http://www.gnu.org/licenses/gpl.txt
 *            GNU General Public License
 * @version   Release: @package_version@
 */

// Uses http://michelf.com/projects/php-markdown/extra/ (installable with pear)
include('markdown.php');
//include('../../../markdown/markdown.php');

define('USAGE_MESSAGE', "Usage:
	markdown2html.php [-h|--help]
		Displays this help message
	markdown2html.php \"Document Title\" source.markdown
		Outputs the markdown to HTML translation result. Pipe into file to save result.
");

if ($argc < 3 || in_array('--help', $argv) || in_array('-h', $argv))
{
	fwrite(STDERR, USAGE_MESSAGE);
	exit;
}

function include_html($name)
{
	if (file_exists($name . '.html'))
	{
		echo file_get_contents($name . '.html');
	}
	else
	{
		fwrite(STDERR, "Could not find file $name.html => skipped\n");
	}
}

function menu($headers)
{
	$prev = 0;
	$current = 0;
	$result = '';
	foreach ($headers as $header)
	{
		if (strlen($header['counter']) > 0)
		{
			$prev = $current;
			$current = (int) $header['level'];

			for ($i = ($prev - $current); $i > 0; $i--)
			{
				$result .= "</li>\n</ol>\n</li>\n";
			}

			if ($prev < $current)
			{
				$result .= "<ol>\n";
			}
			else if ($prev == $current)
			{
				$result .= "</li>\n";
			}

			$result .= "<li><a href=\"#{$header['id']}\">{$header['header']}</a>\n";
		}
	}

	while ($current > 1)
	{
		$result .= "</li>\n</ol>\n";
		$current--;
	}

	return $result . "</li>\n</ol>\n";
}

function markdown_menu($text)
{
	$parser_class = MARKDOWN_PARSER_CLASS;
	$parser = new $parser_class;

	# Transform text using parser.
	$result = $parser->transform($text);

	if (isset($parser->headers)) // modified markdown code for table of contents
	{
		return menu($parser->headers) . $result;
	}
	else // regular code
	{
		return $result;
	}
}

include_html('header');
echo '<h1>' . htmlspecialchars($argv[1]) . '</h1>';
echo markdown_menu(file_get_contents($argv[2]));
include_html('footer');
