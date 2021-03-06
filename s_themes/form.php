<?php
/*
 *      form.php
 *      
 *      Copyright 2011 Indra Sutriadi Pipii <indra@sutriadi.web.id>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

if (!defined('MODULES_WEB_ROOT_DIR')) {
	exit();
}

$params = '?theme=' . $theme;
$defconf = defconf_theme();
$theme_conf = variable_get('theme_' . $theme . '_settings', $defconf, 'serial');
$theme_info = drupal_parse_info_file($theme_dir . '/tpl.info');
$theme_info = isset($theme_info['features']) ? $theme_info['features'] : array_keys($defconf);
$css_names = isset($theme_conf['css_names']) ? $theme_conf['css_names'] : '';
foreach ($defconf as $feature => $turn)
{
	$var = 'perm_' . $feature;
	$$var = in_array($feature, $theme_info) ? '' : 'disabled';
	$$feature = (${$var} != 'disabled' AND isset($theme_conf[$feature]) AND $theme_conf[$feature] == 'on') ? 'checked' : '';
}
?>

<form name="mainForm" id="mainForm" enctype="multipart/form-data" method="POST" action="<?php echo $dir . "/setup.php" . $params;?>" target="submitExec">
	<table cellspacing="0" cellpadding="3" style="width: 100%; background-color: #dcdcdc;">
		<tr>
			<td>
				<input type="submit" name="saveData" value="<?php echo __('Save');?>" class="button" />
			</td>
			<td align="right">
			</td>
		</tr>
	</table>
	<table width="100%" cellpadding="5" cellspacing="0" style="border-collapsed: collapsed;" id="dataList">
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold; width: 100px;"><label for="theme" style="cursor: pointer;"><?php echo __('Theme');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="theme" name="theme" type="text" size="50" value="<?php echo $theme;?>" readonly />
				<br />
				<span><?php echo __('A theme name.');?></span>
			</td>
		</tr>
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold;"><label for="main_links" style="cursor: pointer;"><?php echo __('Main Links');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="main_links" name="main_links" type="checkbox" size="50" <?php echo $main_links;?> <?php echo $perm_main_links;?> />
					<label for="main_links" style="cursor: pointer;"><?php echo __('Show');?></label>
				<br />
				<span><?php echo __('Check it if you want to display main links.');?></span>
			</td>
		</tr>
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold;"><label for="search" style="cursor: pointer;"><?php echo __('Search');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="search" name="search" type="checkbox" size="50" <?php echo $search;?> <?php echo $perm_search;?> />
					<label for="search" style="cursor: pointer;"><?php echo __('Show');?></label>
				<br />
				<span><?php echo __('Check it if you want to display search box.');?></span>
			</td>
		</tr>
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold;"><label for="logo" style="cursor: pointer;"><?php echo __('Logo');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="logo" name="logo" type="checkbox" size="50" <?php echo $logo;?> <?php echo $perm_logo;?> />
					<label for="logo" style="cursor: pointer;"><?php echo __('Show');?></label>
				<br />
				<span><?php echo __('Check it if you want to display logo.');?></span>
			</td>
		</tr>
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold;"><label for="title" style="cursor: pointer;"><?php echo __('Title');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="title" name="title" type="checkbox" size="50" <?php echo $title;?> <?php echo $perm_title;?> />
					<label for="title" style="cursor: pointer;"><?php echo __('Show');?></label>
				<br />
				<span><?php echo __('Check it if you want to display title.');?></span>
			</td>
		</tr>
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold;"><label for="subtitle" style="cursor: pointer;"><?php echo __('Subtitle');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="subtitle" name="subtitle" type="checkbox" size="50" <?php echo $subtitle;?> <?php echo $perm_subtitle;?> />
					<label for="subtitle" style="cursor: pointer;"><?php echo __('Show');?></label>
				<br />
				<span><?php echo __('Check it if you want to display subtitle.');?></span>
			</td>
		</tr>
		<tr valign="top">
			<td class="alterCell" style="font-weight: bold;"><label for="css_names" style="cursor: pointer;"><?php echo __('Additional Style');?></label></td>
			<td class="alterCell" style="font-weight: bold; width: 1%;">:</td>
			<td class="alterCell2">
				<input id="css_names" name="css_names" type="text" size="50" value="<?php echo $css_names;?>" />
				<br />
				<span>
					<?php echo __('Type the CSS class names that will be added to theme globally.');?>
					<?php echo __('You may define multiples classes separated by spaces.');?>
				</span>
			</td>
		</tr>
	</table>
	<table cellspacing="0" cellpadding="3" style="width: 100%; background-color: #dcdcdc;">
		<tr>
			<td>
				<input type="submit" name="saveData" value="<?php echo __('Save');?>" class="button" />
			</td>
			<td align="right">
			</td>
		</tr>
	</table>
</form>
<iframe name="submitExec" class="noBlock" style="visibility: visible; width: 100%; height: 10;"></iframe>
