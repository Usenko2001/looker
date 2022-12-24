<?php


include $_SERVER['DOCUMENT_ROOT'] . '/components/connect.php';


class Template{

  static function getTemplateFile($file){
    return $_SERVER['DOCUMENT_ROOT'].'/'.trim($file, '/');
  }

  public function __construct($page = null, $variables = [], $headerVariables = [], $footerVariables = [])
  {
    if($page)
      $this->render($page, $variables, $headerVariables, $footerVariables);
  }

  private function renderTemplateFile($file, $variables = []){
      $templateFile = self::getTemplateFile($file);
      if (!file_exists($templateFile) || !is_file($templateFile))
          return;
      extract($variables);
      include $templateFile;
  }
  private function renderPage($_pageName, $variables=[]){

      if(substr_compare($_pageName, '.php', -strlen('.php')) !== 0)
          $_pageName .= '.php';
      $_pageName = $_SERVER['DOCUMENT_ROOT'].'/pages/'.trim($_pageName, '/');
      $notFoundPage = $_SERVER['DOCUMENT_ROOT'] . '/pages/not_found.php';
      if (!isset($_pageName))
          $_pageName = $notFoundPage;
      if (!file_exists($_pageName) || !is_file($_pageName))
          $_pageName = $notFoundPage;
      extract($variables);
      include $_pageName;
  }

  function render($page, $variables = [], $headerVariables = [], $footerVariables = [])
  {
      echo "<!doctype><html>";
      $this->renderTemplateFile('/components/htmlHeader.php', $headerVariables);
      echo "<body>";
      $this->renderPage($page,$variables);
      $this->renderTemplateFile('/components/htmlFooter.php', $footerVariables);
      echo "</body>";
      echo "</html>";
  }
}