<?php


include 'connect.php';


class Template{

  static function getTemplateFile($file){
      if(substr_compare($file, '.php', -strlen('.php')) !== 0)
          $file .= '.php';
      return $_SERVER['DOCUMENT_ROOT'].'/'.trim($file, '/');
  }

  public function __construct($page = null, $variables = [], $headerVariables = [], $footerVariables = [])
  {
    if($page)
      $this->render($page, $variables, $headerVariables, $footerVariables);
  }

  private function component($_pageName, $variables = []){
      $_pageName = '/components/'.trim($_pageName, '/');
      $this->renderTemplateFile($_pageName, $variables);
  }

  private function renderTemplateFile($_pageName, $variables = []){
      $_templateFile = self::getTemplateFile($_pageName);
      if (!file_exists($_templateFile) || !is_file($_templateFile))
          return;
      extract($variables);
      include $_templateFile;
  }
  private function renderPage($_pageName, $variables=[]){

      try {
          if (substr_compare($_pageName, '.php', -strlen('.php')) !== 0)
              $_pageName .= '.php';
          $_pageName = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . trim($_pageName, '/');
          $notFoundPage = $_SERVER['DOCUMENT_ROOT'] . '/pages/not_found.php';
          if (!isset($_pageName))
              $_pageName = $notFoundPage;
          if (!file_exists($_pageName) || !is_file($_pageName))
              $_pageName = $notFoundPage;
          extract($variables);
          include $_pageName;
      } catch (Throwable $ex){
          throw $ex;
      }
  }

  function render($page, $variables = [], $headerVariables = [], $footerVariables = [])
  {
      try {
          ob_start();
          echo "<!doctype><html>";
          $this->renderTemplateFile('/components/htmlHeader.php', $headerVariables);
          echo  "<body>";
          $this->renderPage($page,$variables);
          $this->renderTemplateFile('/components/htmlFooter.php', $footerVariables);
          echo  "</body>";
          echo  "</html>";
          $result = ob_get_clean();
          echo $result;
      } catch (Throwable  $ex){
          $this->render('error', ['ex'=>$ex]);
      }

  }
}