<?php
class LibertyTemplate extends BaseTemplate {

	function execute() {
		global $wgRequest;
        $request = $this->getSkin()->getRequest();
        $action = $request->getVal( 'action', 'view' );
		$title = $this->getSkin()->getTitle();
		$curid = $this->getSkin()->getTitle()->getArticleID();

		wfSuppressWarnings();

		$this->html( 'headelement' );
		?>
		<div class="nav-wrapper navbar-fixed-top">
            <?php $this->nav_menu(); ?>
        </div>
        <div class="content-wrapper">
            <div class="container-fluid liberty-content">
                <div class="liberty-content-header">
                    <?php if ( $this->data['sitenotice'] && $_COOKIE['alertcheck'] != "yes" ) { ?>
                        <div class="alert alert-dismissible fade in alert-info liberty-notice" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php $this->html( 'sitenotice' ) ?>
                        </div>
                    <?php } ?>
                    <?php $this->contents_toolbox(); ?>
                    <div class="title">
                        <h1>
                            <?php $this->html( 'title' ) ?>
                        </h1>
                    </div>
                    <div class="contentSub"<?php $this->html( 'userlangattributes' ) ?>>
                        <?php $this->html( 'subtitle' ) ?>
                    </div>
                </div>
                <div class="liberty-content-main">
                    <?php if ( $title->getNamespace() != NS_SPECIAL && $action != "edit" && $action != "history") { ?>
                    <?php } ?>
                    <?php if ( $this->data['catlinks'] ) {
                        $this->html( 'catlinks' );
                    } ?>
                    <?php $this->html( 'bodycontent' ) ?>
                </div>
            </div>
        </div>
		<?php
		$this->printTrail();
		$this->html('debughtml');
		echo Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
		echo "\n";
		wfRestoreWarnings();
	} // end of execute() method

	/*************************************************************************************************/

    function nav_menu() {
    ?>
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="/"></a>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Recentchanges', null ), '<span class="fa fa-exchange-alt">', array( 'class' => 'nav-link', 'title' => '뭔가 바뀐거 같은 문서를 불러올꺼 같습니다. [알+쉬+h]', 'accesskey' => 'c') ); ?>
            </li>
            <li class="nav-item">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Randompage', null ), '<span class="fa fa-sync-alt fa-spin">', array( 'class' => 'nav-link', 'title' => '당신의 운을 시험해볼꺼 같습니다. [알+쉬+r]', 'accesskey' => 'r' ) ); ?>
            </li>
            <li class="nav-item">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'LongPages', null ), '<span class="fa fa-sort-amount-up">', array( 'class' => 'nav-link', 'title' => '크고 아름다운 문서들을 불러올꺼 같습니다. [알+쉬+k]', 'accesskey' => 'k' ) ); ?>
            </li>
            <li class="nav-item">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'ShortPages', null ), '<span class="fa fa-sort-amount-down">', array( 'class' => 'nav-link', 'title' => '작고 아름다운 문서들을 불러올꺼 같습니다. [알+쉬+m]', 'accesskey' => 'm' ) ); ?>
            </li>
            <li class="nav-item">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'SpecialPages', null ), '<span class="fa fa-star"></span>', array( 'class' => 'nav-link', 'title' => '뭔가 특별한거 같은 문서를 불러올꺼 같습니다. [알+쉬+s]', 'accesskey' => 's') ); ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://tes.dothome.co.kr/%ED%85%8C%EC%8A%A4%EC%9C%84%ED%82%A4:%EC%97%85%EB%8D%B0%EC%9D%B4%ED%8A%B8_%EB%A1%9C%EA%B7%B8" title="테스위키의 소프트웨어적 업데이트를 모아보았습니다!"><i class="fab fa-angellist"></i></a>
            </li>
            <?php global $wgUser, $wgRequest;
            if ($wgUser->isLoggedIn()) { ?>
                    <li class="nav-item" style="align-content: right;">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'upload', null ), '<span class="fa fa-cloud-upload-alt"></span>', array( 'class' => 'nav-link', 'title' => '뭔가 업로드 하는거랑 관련된 특수문서 같은걸 불러올꺼 같습니다. [알+쉬+p]', 'accesskey' => 'p') ); ?>
            </li>
                    <li class="nav-item" style="align-content: right;">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( '환경설정', null ), '<span class="fa fa-cogs"></span>', array( 'class' => 'nav-link', 'title' => '흠... 뭐가 맘에 안드나요? 그럼, 바꾸세요! [알+쉬+o]', 'accesskey' => 'o') ); ?>
            </li>
                    <li class="nav-item" style="float: right;">
                        <?=Linker::linkKnown( SpecialPage::getTitleFor( 'logout', null ), '<span class="fa fa-sign-out-alt"></span>', array( 'class' => 'nav-link', 'title' => '장비를 정지합니다! [알+쉬+u]', 'accesskey' => 'u') ); ?>
                    </li>

            <?php } else { ?>
            <li class="nav-item" style="float: right;">
                <?=Linker::linkKnown( SpecialPage::getTitleFor( 'login', null ), '<span class="fa fa-sign-in-alt"></span>', array( 'class' => 'nav-link', 'title' => '남조선들이 흔히 부르는 로그인이라는 기능인거 같습네다. [알+쉬+l]', 'accesskey' => 'l') ); ?>
            </li>
        <?php } ?>

        </ul>
        <?php $this->getNotification(); ?>
        <?php $this->searchBox(); ?>
    </nav>
    <?php
    }

	function searchBox() {
    ?>
        <form action="<?php $this->text( 'wgScript' ) ?>" id="searchform" class="form-inline">
            <input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
            <div class="input-group">
                <?php echo $this->makeSearchInput( array( "class" => "form-control", "id" => "searchInput") ); ?>
                <span class="input-group-btn">
                    <button type="submit" name="go" value="보기" id="searchGoButton" class="btn btn-secondary" type="button"><span class="fa fa-eye"></span></button>
                    <button type="submit" name="fulltext" value="검색" id="mw-searchButton" class="btn btn-secondary" type="button"><span class="fa fa-search"></span></button>
                </span>
            </div>
        </form>
    <?php
	}

	function contents_toolbox() {
	    global $wgUser;
        $title = $this->getSkin()->getTitle();
        $revid = $this->getSkin()->getRequest()->getText( 'oldid' );
        $watched = $this->getSkin()->getUser()->isWatched( $this->getSkin()->getRelevantTitle() ) ? 'unwatch' : 'watch';
        $user = ( $wgUser->isLoggedIn() ) ? array_shift($userLinks) : array_pop($userLinks);

	    if ( $title->getNamespace() != NS_SPECIAL ) {
            $companionTitle = $title->isTalkPage() ? $title->getSubjectPage() : $title->getTalkPage();
            ?>
            <div class="content-tools">
                <div class="btn-group" role="group" aria-label="content-tools">
                    <?=Linker::linkKnown( $title, '읽기', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서 캐쉬를 새로 지정하여 문서를 불러옵니다. [alt+shift+p]', 'accesskey' => 'p' ), array( 'action' => 'purge' ) ); ?>
                    <?php
                    if ($revid) {
                        $editaction = array( 'action' => 'edit', 'oldid' => $revid );
                    } else {
                        $editaction = array( 'action' => 'edit' );
                    }
                    ?>
                    <?=Linker::linkKnown( $title, '편집', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 편집합니다. [alt+shift+e]', 'accesskey' => 'e' ), $editaction ); ?>
                    <?=Linker::linkKnown( $title, '추가', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '새 문단을 추가합니다. [alt+shift+n]', 'accesskey' => 'n' ), array( 'action' => 'edit', 'section' => 'new' ) ); ?>
                    <?=Linker::linkKnown( $title, '기록', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서의 편집 기록을 불러옵니다. [alt+shift+h]', 'accesskey' => 'h' ), array( 'action' => 'history' ) ); ?>
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'WhatLinksHere', $title ), '역링크', array('class' => 'btn btn-secondary tools-btn')  ); ?>
                    <?=Linker::linkKnown( SpecialPage::getTitleFor( 'Movepage', $title ), '옮기기', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 옮깁니다. [alt+shift+b]', 'accesskey' => 'b' )); ?>
                    <?php
                        if ( $title->quickUserCan( 'protect', $user ) ) { ?>
                            <?=Linker::linkKnown( $title, '/', array ('class' => 'btn btn-secondary tools-btn')); ?>
                            <?=Linker::linkKnown( $title, '보호', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 보호합니다. [alt+shift+q]', 'accesskey' => 'q' ), array( 'action' => 'protect' ) ); ?>
                        <?php } ?>
                        <?php if ( $title->quickUserCan( 'delete', $user ) ) { ?>
                            <?=Linker::linkKnown( $title, '삭제', array( 'class' => 'btn btn-secondary tools-btn', 'title' => '문서를 삭제합니다. [alt+shift+d]', 'accesskey' => 'd' ), array( 'action' => 'delete' ) ); ?>
                        <?php }
                     ?>
                </div>
            </div>
        <?php
        }
	}

    function footer() {
        foreach ( $this->getFooterLinks() as $category => $links ) {
            ?>
            <ul class="footer-<?=$category;?>">
                <?php foreach ( $links as $link ) {
                ?>
                    <li class="footer-<?=$category;?>-<?=$link;?>"><?php $this->html( $link ); ?></li>
                <?php
                }
                ?>
            </ul>
            <?php
        }
        $footericons = $this->getFooterIcons( "icononly" );
        if ( count( $footericons ) > 0 ) {
        ?>
            <ul class="footer-icons">
                <?php
                    foreach ( $footericons as $blockName => $footerIcons ) {
                    ?>
                        <li class="footer-<?=htmlspecialchars( $blockName );?>ico">
                        <?php
                            foreach ( $footerIcons as $icon ) {
                                echo $this->getSkin()->makeFooterIcon( $icon );
                            }
                        ?>
                        </li>
                    <?php
                    }
                ?>
            </ul>
        <?php
        }
    }

    function getNotification() {
        $personalTools = $this->getPersonalTools();
        $noti_count = $personalTools['notifications']['links']['0']['text'];
        if ($noti_count != "0") {
            ?>
            <div id="pt-notifications" class="navbar-notification">
                <a href="#"><span class="label label-danger"><?=$noti_count;?></span></a>
            </div>
            <?php
        }
    }
} // end of class
