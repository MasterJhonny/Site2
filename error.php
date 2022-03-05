<?php

defined('_JEXEC') or die;

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';

JHtml::_('bootstrap.framework');

$app = JFactory::getApplication();
$config = JFactory::getConfig();

$defaultLogo = getLogoInfo(array('src' => "/images/default-logo.png"));

// Create alias for $this object reference:
$documentError = $this;
$document = JFactory::getDocument();

if ($app::getRouter()->getMode() == JROUTER_MODE_SEF)
{
    $document->setBase(JUri::getInstance()->toString());
}

$metaGeneratorContent = 'Nicepage 4.6.5, nicepage.com';
if ($metaGeneratorContent) {
    $document->setMetaData('generator', $metaGeneratorContent);
}

$templateUrl = $documentError->baseurl . '/templates/' . $documentError->template;
$faviconPath = "" ? $templateUrl . '/images/' . "" : '';

Core::load("Core_Page");
// Initialize $view:
$this->view = new CorePage($this);
$indexDir = dirname(__FILE__);

$app = JFactory::getApplication();
$themeOptions = $app->getTemplate(true)->params;
$fileName = $themeOptions->get('page404', '');
if ($fileName) {
    include_once $indexDir . '/views/' . $fileName . '.php';
}

$bodyClass = 'class="' . (isset($document->bodyClass) ? $document->bodyClass : '') . '"';
$bodyStyle = isset($document->bodyStyle) && $document->bodyStyle ? ' style="' . $document->bodyStyle . '"' : '';
$backToTop = isset($document->backToTop) && $document->backToTop ? $document->backToTop : '';
$showHeader = isset($document->hideHeader) && $document->hideHeader ? false : true;
$showFooter = isset($document->hideFooter) && $document->hideFooter ? false : true;
$pageContent = isset($document->pageContent) && $document->pageContent ? $document->pageContent : '';
$pageStyles = isset($document->pageStyles) && $document->pageStyles ? $document->pageStyles : '';
$document->pageType = '404';
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <?php if ($faviconPath) : ?>
        <link href="<?php echo $faviconPath; ?>" rel="icon" type="image/x-icon" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <meta name="theme-color" content="#478ac9">
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/default.css" media="screen" type="text/css" />
    <?php if($this->view->isFrontEditing()) : ?>
        <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/frontediting.css" media="screen" type="text/css" />
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/media.css" id="theme-media-css" media="screen" type="text/css" />
    <?php if (isset($document->localFontsFile)) : ?><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/<?php echo $document->localFontsFile; ?>" media="screen" type="text/css" /><?php else : ?><?php endif; ?><link id="u-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <?php include_once "$indexDir/styles.php"; ?>
    <script src="<?php echo $templateUrl; ?>/scripts/jquery.js"></script>
    <script src="<?php echo $templateUrl; ?>/scripts/script.js"></script>
    <?php echo $pageStyles; ?>
    
    
    
</head>
<body <?php echo $bodyClass . $bodyStyle; ?>>
<?php
if ($showHeader) {
    $this->view->renderHeader($indexDir);
}
?>
<?php echo $pageContent; ?>
<?php
if ($showFooter) {
    $this->view->renderFooter($indexDir);
}
?>
<section class="u-backlink u-clearfix u-grey-80">
            <a class="u-link" href="https://nicepage.com/joomla-templates" target="_blank">
        <span>Joomla Template</span>
            </a>
        <p class="u-text"><span>created with</span></p>
        <a class="u-link" href="https://nicepage.com/joomla-page-builder" target="_blank"><span>Joomla Page Builder</span></a>.
    </section>

<?php echo $backToTop; ?>
</body>
</html>
