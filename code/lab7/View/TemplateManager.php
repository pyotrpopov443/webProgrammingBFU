<?php

class TemplateManager
{

	public static function renderTemplate(string $templateName, array $templateParams): string
	{
		$templatePath = "View/$templateName";
		if (file_exists($templatePath))
		{
			ob_start();
			extract($templateParams, EXTR_OVERWRITE);
			require_once $templatePath;
			return ob_get_clean();
		}
		return '';
	}

}