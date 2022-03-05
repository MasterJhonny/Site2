<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();

$blogStyles = <<<STYLES
<style>
.u-section-1 .u-sheet-1 {
  min-height: 561px;
}
.u-section-1 .u-repeater-1 {
  margin-top: 60px;
  margin-bottom: 60px;
  min-height: 441px;
  grid-template-columns: calc(33.3333% - 15px) calc(33.3333% - 15px) calc(33.3333% - 15px);
  height: auto;
  grid-gap: 22px;
}
.u-section-1 .u-repeater-item-1 {
  background-image: none;
}
.u-section-1 .u-container-layout-1 {
  padding: 30px 20px;
}
.u-section-1 .u-text-1 {
  margin-top: 0;
  margin-bottom: 0;
}
.u-section-1 .u-image-1 {
  height: 222px;
  margin-top: 17px;
  margin-bottom: 0;
}
.u-section-1 .u-text-2 {
  margin-top: 20px;
  margin-bottom: 0;
}
.u-section-1 .u-btn-1 {
  background-image: none;
  border-style: none none solid;
  margin: 17px auto 0 0;
  padding: 0;
}
.u-section-1 .u-container-layout-2 {
  padding: 30px 20px;
}
.u-section-1 .u-text-3 {
  margin-top: 0;
  margin-bottom: 0;
}
.u-section-1 .u-image-2 {
  height: 222px;
  margin-top: 17px;
  margin-bottom: 0;
}
.u-section-1 .u-text-4 {
  margin-top: 20px;
  margin-bottom: 0;
}
.u-section-1 .u-btn-2 {
  background-image: none;
  border-style: none none solid;
  margin: 17px auto 0 0;
  padding: 0;
}
.u-section-1 .u-container-layout-3 {
  padding: 30px 20px;
}
.u-section-1 .u-text-5 {
  margin-top: 0;
  margin-bottom: 0;
}
.u-section-1 .u-image-3 {
  height: 222px;
  margin-top: 17px;
  margin-bottom: 0;
}
.u-section-1 .u-text-6 {
  margin-top: 20px;
  margin-bottom: 0;
}
.u-section-1 .u-btn-3 {
  background-image: none;
  border-style: none none solid;
  margin: 17px auto 0 0;
  padding: 0;
}
@media (max-width: 1199px) {
  .u-section-1 .u-sheet-1 {
    min-height: 484px;
  }
  .u-section-1 .u-repeater-1 {
    min-height: 364px;
    grid-template-columns: repeat(3, calc(33.333333333333336% - 15px));
  }
}
@media (max-width: 991px) {
  .u-section-1 .u-sheet-1 {
    min-height: 956px;
  }
  .u-section-1 .u-repeater-1 {
    min-height: 836px;
    grid-template-columns: repeat(2, calc(50% - 11.25px));
  }
}
@media (max-width: 767px) {
  .u-section-1 .u-repeater-1 {
    grid-template-columns: 100%;
  }
  .u-section-1 .u-container-layout-1 {
    padding-left: 10px;
    padding-right: 10px;
  }
  .u-section-1 .u-image-1 {
    height: 278px;
  }
  .u-section-1 .u-container-layout-2 {
    padding-left: 10px;
    padding-right: 10px;
  }
  .u-section-1 .u-image-2 {
    height: 278px;
  }
  .u-section-1 .u-container-layout-3 {
    padding-left: 10px;
    padding-right: 10px;
  }
  .u-section-1 .u-image-3 {
    height: 278px;
  }
}

</style>
STYLES;
JFactory::getDocument()->addCustomTag($blogStyles);

$document->hideHeader = false;
$document->hideFooter = false;
$document->bodyClass = 'u-body u-xl-mode';
$document->bodyStyle = "";
$document->localFontsFile = "";
$document->backToTop=<<<BACKTOTOP

BACKTOTOP;

?>
<?php

$funcsInfo = array(
   array('repeatable' => true, 'name' => 'blogTemplate_0_blog_1', 'itemsExists' => true),

);

$funcsStaticInfo = array(

);

echo $component->pageHeading();

if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) {
    echo '<section class="u-clearfix"><div class="u-clearfix u-sheet"><h2>';
    echo $this->params->get('page_subheading');
    if ($this->params->get('show_category_title')) {
        echo ' <span class="subheading-category">' . $this->category->title . '</span>';
    }
    echo '</h2></div></section>';
}

if (count($funcsInfo)) {
    foreach ($funcsInfo as $funcInfo) {
        if (!$funcInfo['itemsExists']) {
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
            continue;
        }
        if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_start.php')) {
            include $themePath . '/views/' . $funcInfo['name'] . '_start.php';
        }

        $imagesEtalonItems = array();
        $imagesJsonPath = $themePath . '/views/images.json';
        if (file_exists($imagesJsonPath)) {
            ob_start();
            include_once $imagesJsonPath;
            $imagesEtalonItems = json_decode(ob_get_clean(), true);
        }
        $imagesEtalonItem = isset($imagesEtalonItems[$funcInfo['name']]) ? $imagesEtalonItems[$funcInfo['name']] : array();

        foreach ($allItems as $itemIndex => $item) {
            $j = 0;
            $article = $component->article('category', $item, $item->params);
            $beforeDisplayContent = $item->event->beforeDisplayContent;
            ${'title' . $j} = strlen($article->title) ? $this->escape($article->title) : '';
            ${'titleLink' . $j} = strlen($article->titleLink) ? $article->titleLink : '';
            ${'readmore' . $j} = strlen($article->readmore) ? $article->readmore : '';
            ${'readmoreLink' . $j} = strlen($article->readmoreLink) ? $article->readmoreLink : '';
            ${'shareLink' . $j} = strlen($article->shareLink) ? $article->shareLink : '';
            ${'content' . $j} = $beforeDisplayContent . $article->intro(funcBalanceTags($article->intro));

            if ($article->images['intro']['image']) {
                $image = $article->images['intro']['image'];
            } else {
                $imagesPostItem = property_exists($item, 'pageIntroImgStruct') ? $item->pageIntroImgStruct : array();
                $image = getProportionImage($imagesPostItem, $imagesEtalonItem);
            }

            ${'postItemInvisible' . $j} = !$image ? true : false;
            ${'image' . $j} = $image;
            ${'tags' . $j} = count($article->tags) > 0 ? implode('', $article->tags) : '';

            ${'metadata' . $j} = array();
            if (strlen($article->author)) {
                ${'metadata' . $j}['author'] = $article->authorInfo($article->author, $article->authorLink);
            }
            if (strlen($article->published)) {
                ${'metadata' . $j}['date'] = $article->publishedDateInfo($article->published);
            }
            if (strlen($article->category)) {
                ${'metadata' . $j}['category'] = $article->categories($article->parentCategory, $article->parentCategoryLink, $article->category, $article->categoryLink);
            }
            if ($item->params->get('access-edit')) {
                ${'metadata' . $j}['edit'] = $article->editIcon();
            }
            include $themePath . '/views/' . $funcInfo['name'] . '.php';
        }
        if (file_exists($themePath . '/views/' . $funcInfo['name'] . '_end.php')) {
            include $themePath . '/views/' . $funcInfo['name'] . '_end.php';
        }
    }
}

if (count($funcsStaticInfo)) {
    for ($i = 0; $i < count($funcsStaticInfo); $i++) {
        include_once $themePath . '/views/' . $funcsStaticInfo[$i]['name'] . '.php';
    }
}