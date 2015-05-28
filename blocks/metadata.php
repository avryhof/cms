	<meta name="description" content="<?= $metadata['desc']; ?>" />
    <meta name="author" content="<?= $metadata['author']; ?>" />    
    <META NAME="keywords" CONTENT="<?= $metadata['keywords']; ?>" />
    <meta name="news_keywords" CONTENT="<?= $metadata['keywords']; ?>" />
    <META NAME="robot" CONTENT="index,follow" />
    <META NAME="language" CONTENT="<?= $metadata['location']['lang']; ?>" />
    <meta name="geo.region" content="<?= $metadata['location']['country']; ?>-<?= $metadata['region']; ?>" />
    <meta name="geo.placename" content="<?= $metadata['city']; ?>" />
    <meta name="geo.position" content="<?= $metadata['location']['coords']['latitude']; ?>;<?= $metadata['location']['coords']['longitude']; ?>" />
    <meta name="ICBM" content="<?= $metadata['location']['coords']['latitude']; ?>, <?= $metadata['location']['coords']['longitude']; ?>" />
    
    <? if (!empty($metadata['google']['publisher'])) { ?>
    <link rel="publisher" href="<?= $metadata['google']['publisher']; ?>" />
    <? } ?>
    <? if (!empty($metadata['google']['author'])) { ?>
    <link rel="author" href="https://plus.google.com/+<?= $metadata['google']['author']; ?>" />
    <? } ?>
    <link rel="icon" type="image/png" href="<?= $metadata['images']['favicon']; ?>" />
    
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?= $metadata['name']; ?>" />
    <meta itemprop="description" content="<?= $metadata['desc']; ?>" />
    <meta itemprop="image" content="<?= $metadata['images']['logo']; ?>" />
    
    <!-- Twitter Card data -->
    <meta name="twitter:card" value="<?= $metadata['name']; ?>" />
    <meta name="twitter:title" content="<?= $metadata['name']; ?>" />
    <meta name="twitter:description" content="<?= $metadata['desc']; ?>" />
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="<?= $metadata['images']['logo']; ?>" />
    <? if (!empty($metadata['twitter']['username'])) { ?>
    <meta name="twitter:site" content="@<?= $metadata['twitter']['username']; ?>" />
    <meta name="twitter:creator" content="@<?= $metadata['twitter']['username']; ?>" />
    <? } ?>
    
    <!-- Open Graph data -->
    <meta property="og:title" content="<?= $metadata['name']; ?>" />
    <meta property="og:site_name" content="<?= $metadata['name']; ?>" />
    <meta property="og:description" content="<?= $metadata['desc']; ?>" /> 
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= $baseurl; ?>" />
    <meta property="og:image" content="<?= $metadata['images']['logo']; ?>" />
    <meta property="og:locale" content="<?= $metadata['location']['lang']; ?>_<?= strtolower($metadata['location']['country']); ?>" />
    <? if (!empty($metadata['facebook']['username'])) { ?>
    <meta property="article:author" content="<?= $metadata['facebook']['username']; ?>" />
    <? } ?>
    <? if (!empty($metadata['facebook']['pagename'])) { ?>
    <meta property="article:publisher" content="<?= $metadata['facebook']['pagename']; ?>" />
    <? } ?>
    <meta property="article:published_time" content="<?= date("c",filectime(__FILE__)); ?>" />
    <meta property="article:modified_time" content="<?= date("c",filemtime(__FILE__)); ?>" />
    <meta property="article:section" content="Article Section" />
    <!-- <meta property="article:tag" content="Article Tag" /> -->
    <meta property="fb:admins" content="" /> 
    <? if (!empty($metadata['facebook']['appid'])) { ?>
    <meta property="fb:app_id" content="<?= $metadata['facebook']['appid']; ?>" />   
    <? } ?>