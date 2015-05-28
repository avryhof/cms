<div class="panel panel-default">
    <div class="panel-heading">Get Connected</div>
    <div class="panel-body">
    	
		<? if (!empty($metadata['facebook']['pagename'])) { ?>
        <a href="https://www.facebook.com/pages/<?= $metadata['facebook']['pagename']; ?>/<?= $metadata['facebook']['pageid']; ?>" class="btn btn-facebook" data-toggle="tooltip" data-placement="top" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
        <? } ?>
		
        <? if (!empty($metadata['twitter']['username'])) { ?>
        <a href="https://twitter.com/<?= $metadata['twitter']['username']; ?>" class="btn btn-twitter" data-toggle="tooltip" data-placement="top" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
        <? } ?>
        
        <? if (!empty($metadata['google']['author'])) { ?>
        <a href="https://plus.google.com/+<?= $metadata['google']['author']; ?>" class="btn btn-google" data-toggle="tooltip" data-placement="top" title="Google+" target="_blank"><i class="fa fa-google-plus"></i></a>
        <? } ?>
        
        <? if (!empty($metadata['youtube'])) { ?>
        <a href="https://www.youtube.com/user/<?= $metadata['youtube']; ?>" class="btn btn-youtube" data-toggle="tooltip" data-placement="top" title="Youtube" target="_blank"><i class="fa fa-youtube-play"></i></a>
        <? } ?>
        
        <? if (!empty($metadata['instagram'])) { ?>
        <a href="https://instagram.com/<?= $metadata['instagram']; ?>/" class="btn btn-instagram" data-toggle="tooltip" data-placement="top" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>
        <? } ?>
        
        <? if (!empty($metadata['flickr'])) { ?>
        <a href="<?= $metadata['flickr']; ?>" class="btn btn-flickr" data-toggle="tooltip" data-placement="top" title="Flickr" target="_blank"><i class="fa fa-flickr"></i></a>
        <? } ?>
        
        <a href="contact.php" class="btn btn-email" data-toggle="tooltip" data-placement="top" title="Email"><i class="fa fa-envelope-o"></i></a>
    </div>
</div>