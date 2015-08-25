<?php
/**
 * functionClass
 *
 * @package Wordpress iosys
 * @version 1.0.1
 * @since iosys.
 * @author KJN(Y.S)
 */
/**
 * テーマカスタマイズ用オプションをロード
 */
/* --------------------------------------------------------- */
require_once ( dirname(__FILE__) . '/inc/theme-options.php' );
// インスタンス生成
new themeOptions();

class setOption {

  /**
   * オプションオブジェクト
   */
  protected $options;

  /**
   * インスタンス
   *
   * @static
   * @access private
   * @var setOption
   */
  private static $_instance = null;

  /**
   * コンストラクタ
   * WPフック・ショートタグなどの登録
   *
   * @access public
   */
  public function __construct() {
    // 初期設定処理
    add_action('init', array(&$this, 'init_header_option'));
    add_action('init', array(&$this, 'load_style'));

    // カスタム投稿タイム
//    add_action('init', array(&$this, 'thxnews_init'));

    // バージョン表記削除
    add_filter('script_loader_src', array(&$this, 'remove_cssjs_ver'));
    add_filter('style_loader_src', array(&$this, 'remove_cssjs_ver'));

    add_filter('option_page_capability_iosys_options', array(&$this, 'iosys_option_page_capability'));
    // オプション設定情報セット
    $this->options = self::get_options();

    // フィルター登録
    add_filter('get_logo', array(&$this, 'get_logo'));
    add_filter('get_about', array(&$this, 'get_about'));
    add_filter('get_service', array(&$this, 'get_service'));
    add_filter('get_recruit', array(&$this, 'get_recruit'));
    add_filter('get_company', array(&$this, 'get_company'));

    add_filter('meta_description', array(&$this, 'meta_description'));
    add_filter('meta_key_word', array(&$this, 'meta_key_word'));
    add_filter('iosys_googleAnalytics', array(&$this, 'iosys_googleAnalytics'));
    add_filter('iosys_footerCopyRight', array(&$this, 'iosys_footerCopyRight'));
  }

  /**
   * インスタンス取得
   *
   * @static
   * @access public
   * @return setOption
   */
  public static function get_instance() {
    if (self::$_instance == null) {
      self::$_instance = new self;
    }

    return self::$_instance;
  }

  /**
   * テーマ設定で設定した値を取得
   *
   * @static
   * @access public
   * @return array
   */
  public static function get_options() {
    return self::iosys_get_theme_options();
  }

  /**
   * header整理
   */
  /* --------------------------------------------------------- */
  public function init_header_option() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'rel_canonical');
    remove_action('wp_head', 'rsd_link');
  }

  /**
   * StyleSheet関連
   *
   * @hook init
   */
  public function load_style() {
    if (!is_admin()) {
      /** Style表示 */
      wp_enqueue_style('default', get_bloginfo('stylesheet_url'));
    }
    /** jsは表裏共通 */
//    wp_enqueue_script('jquery');
//    wp_enqueue_script('masterjs', get_template_directory_uri() . '/js/master.js', array(), '', true);
//    wp_enqueue_script('modal', get_template_directory_uri() . '/js/jquery.modal.js', array(), '', true);
//    wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array(), '', true);
  }

  /**
   * バージョン表記削除
   *
   * @filter script_loader_src
   * @filter style_loader_src
   */
  public function remove_cssjs_ver($src) {
    if (strpos($src, '?ver='))
      $src = remove_query_arg('ver', $src);

    return $src;
  }

  /**
   * テーマオプション情報の取得
   *
   * @return array
   */
  public static function iosys_get_theme_options() {
    return get_option('iosys_theme_options', array());
  }

  /**
   * 初期設定
   *
   * @return void
   */
  public function iosys_option_page_capability($capability) {
    return 'edit_theme_options';
  }

  /**
   * ロゴの読み込み
   * 
   * @return html
   */
  public function get_logo() {
    $logo = $this->options['logo'];
    
    echo esc_attr($logo);
  }

  /**
   * ご挨拶設定の読み込み
   * 
   * @return html
   */
  public function get_about() {

    $body = nl2br($this->options['aboutBody']);
    $logo = $this->options['aboutLogo'];
    
    ?>
    <?php if (!empty($body)) : ?>

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-push-2 clearfix">
            <div class="section-heading scrollpoint sp-effect3">
                <h1>ご挨拶<!--span>y</span-->
                </h1>
                <h4><?php echo $body; ?></h4>
                <!--<span class="divider"></span>-->
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12 scrollpoint sp-effect4">
                  <img src="<?php echo esc_attr($logo)?>" class="img-responsive img-center" alt="<?php echo bloginfo('name'); ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

  <?php
  }
  
  /**
   * イオシスでやっていること設定の読み込み
   * 
   * @return html
   */
  public function get_service() {

    $serviceBody = nl2br($this->options['serviceBody']);
    $serviceNumLeft = $this->options['serviceNumLeft'];
    $serviceNumRight = $this->options['serviceNumRight'];

    ?>

    <section id="services">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-push-2 clearfix">
          <div class="section-heading scrollpoint sp-effect3">
              <h1>イオシスでやっていること<!--span>y</span--></h1>
              <h4><?php echo $serviceBody; ?></h4>
              <!--<span class="divider"></span>-->
          </div>
        </div>
        
        <div class="col-md-6">
    <?php
      for ($s = 1; $s <= $serviceNumLeft; $s++) :
        $serviceLinkLeft = $this->options['serviceLinkLeft'.$s];
        $serviceTitleLeft = $this->options['serviceTitleLeft'.$s];
        $serviceCommentLeft = $this->options['serviceCommentLeft'.$s];
        $serviceIconLeft = $this->options['serviceIconLeft'.$s];
    ?>
          <div class="media scrollpoint sp-effect2">
            <a class="pull-left" href="#">
              <i class="media-object fa <?php echo $serviceIconLeft; ?> fa-4x"></i>
            </a>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $serviceTitleLeft; ?></h4>
              <p><?php echo $serviceCommentLeft; ?></p>
            </div>
          </div>
    <?php endfor; ?>
        </div>
          
        <div class="col-md-6">
    <?php
      for ($s = 1; $s <= $serviceNumRight; $s++) :
        $serviceLinkRight = $this->options['serviceLinkRight'.$s];
        $serviceTitleRight = $this->options['serviceTitleRight'.$s];
        $serviceCommentRight = $this->options['serviceCommentRight'.$s];
        $serviceIconRight = $this->options['serviceIconRight'.$s];
    ?>
          <div class="media right scrollpoint sp-effect1">
            <a class="pull-right" href="#">
              <i class="media-object fa <?php echo $serviceIconRight; ?> fa-4x"></i>
            </a>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $serviceTitleRight; ?></h4>
              <p><?php echo $serviceCommentRight; ?></p>
            </div>
          </div>
    <?php endfor; ?>
        </div>
      </div>
    </div>
    </section>

  <?php
  }
  
  /**
   * 一緒に働きませんか設定の読み込み
   * 
   * @return html
   */
  public function get_recruit() {

    $recruitBody = nl2br($this->options['recruitBody']);
    $recruitSalary = nl2br($this->options['recruitSalary']);
    $recruitBonus = nl2br($this->options['recruitBonus']);
    $recruitAllowance = nl2br($this->options['recruitAllowance']);
    $recruitWorkingHours = nl2br($this->options['recruitWorkingHours']);
    $recruitVacation = nl2br($this->options['recruitVacation']);
    $recruitWelfare = nl2br($this->options['recruitWelfare']);

    ?>

    <section id="recruit">
    <div class="container">
      <div class="row">
        <div class="col-md-6 scrollpoint sp-effect2">
          <img src="img/samples/macbook-bl.png" alt="<?php echo bloginfo('name'); ?>" class="img-responsive macbook-image img-center">
        </div>
          <div class="col-md-6 scrollpoint sp-effect1">
          <h1>一緒に働きませんか<!--span>y</span--></h1>
          <p><?php echo $recruitBody; ?></p>
          <table id="tablepress">
              <tr class="row-1 odd">
                <th class="column-1"><div>応募書類</div></th>
                <td class="column-2"><div>履歴書（写真貼付）／経歴書／その他弊社指定の書類</div></td>
              </tr>
              <tr class="row-2 even">
                <th class="column-1">給与</th>
                <td class="column-2"><?php echo $recruitSalary; ?></td>
              </tr>
              <tr class="row-3 odd">
                <th class="column-1">賞与</th>
                <td class="column-2"><?php echo $recruitBonus; ?></td>
              </tr>
              <tr class="row-4 even">
                <th class="column-1">手当</th>
                <td class="column-2"><?php echo $recruitAllowance; ?></td>
              </tr>
              <tr class="row-5 odd">
                <th class="column-1">勤務時間</th>
                <td class="column-2"><?php echo $recruitWorkingHours; ?></td>
              </tr>
              <tr class="row-6 even">
                <th class="column-1">休日・休暇</th>
                <td class="column-2"><?php echo $recruitVacation; ?></td>
              </tr>
              <tr class="row-7 odd">
                <th class="column-1">福利厚生</th>
                <td class="column-2"><?php echo $recruitWelfare; ?></td>
              </tr>
          </table>
          <a href="#" class="btn btn-primary btn-lg">お問い合わせ</a>
        </div>
      </div>
    </div>
  </section>

  <?php
  }

  /**
   * 会社概要設定の読み込み
   * 
   * @return html
   */
  public function get_company() {

    $companyInfo = nl2br($this->options['companyInfo']);
    $companyEstablish = nl2br($this->options['companyEstablish']);
    $companyCapital = nl2br($this->options['companyCapital']);
    $companyStaff = nl2br($this->options['companyStaff']);
    $companyBusiness = nl2br($this->options['companyBusiness']);
    $companyClient = nl2br($this->options['companyClient']);
    $companyApproval = nl2br($this->options['companyApproval']);

    ?>

    <section id="company">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-push-2 clearfix">
          <div class="section-heading scrollpoint sp-effect3">
            <h1>会社概要</h1>
            <h4></h4>
            <!--<span class="divider"></span>-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-push-3 ">
          <div class="row">
            <div class="member scrollpoint sp-effect5">
              <table id="tablepress" class="tablepress tablepress">
                <thead>
                  <tr class="row-1 odd">
                    <th class="column-1"><div>商号</div></th>
                    <td class="column-2"><div><?php echo bloginfo('name'); ?></div></td>
                  </tr>
                </thead>
                <tbody class="row-hover">
                  <tr class="row-2 even">
                    <th class="column-1">本社</th>
                    <td class="column-2"><?php echo $companyInfo; ?></td>
                  </tr>
                  <tr class="row-3 odd">
                    <th class="column-1">設立</th>
                    <td class="column-2"><?php echo $companyEstablish; ?></td>
                  </tr>
                  <tr class="row-4 even">
                    <th class="column-1">資本金</th>
                    <td class="column-2"><?php echo $companyCapital; ?>円</td>
                  </tr>
                  <tr class="row-5 odd">
                    <th class="column-1">従業員数</th>
                    <td class="column-2"><?php echo $companyStaff; ?></td>
                  </tr>
                  <tr class="row-6 even">
                    <th class="column-1">事業内容</th>
                    <td class="column-2"><?php echo $companyBusiness; ?></td>
                  </tr>
                  <tr class="row-7 odd">
                    <th class="column-1">主要取引先<br />（敬称略、順不同）</th>
                    <td class="column-2"><?php echo $companyClient; ?></td>
                  </tr>
                  <tr class="row-8 even">
                    <th class="column-1">認可</th>
                    <td class="column-2"><?php echo $companyApproval; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php
  }


  /**
   * meta用descriptionを返す
   *
   * @param $view true:echo  false:return
   * @return string
   */
  public function meta_description($view = true) {

    $des = $this->options['metaDes'];
    if (is_single() || is_page()) { //記事詳細ページ
      global $post;
      $ret = strip_tags($post->post_content);
      $ret = preg_replace("(\\\r\\\n|\\\r|\\\n)", "", $ret);
      $ret = mb_substr($ret, 0, 80) . "…";
    } elseif (is_404()) {
      $ret = '申し訳ございません。こちらのページは削除された、またはURL（ページアドレス）が変更された可能性があります。';
    } else {
      $ret = $des;
    }
    if ($view) {
      echo esc_html($ret);
    } else {
      return esc_html($ret);
    }
  }

  /**
   * meta用キーワードを返す
   *
   * @param $view true:echo  false:return
   * @return string
   */
  public function meta_key_word($view = true) {

    $key = $this->options['metaKeyWord'];

    if (is_single() || is_page()) { //記事詳細ページ
      $ret = $this->stripSpaces(wp_title(',', false, 'right')) . $key;
    } else {
      $ret = $key;
    }
    if ($view) {
      echo esc_html($ret);
    } else {
      return esc_html($ret);
    }
  }

  /**
   * GoogleAnalyticsを表示する
   *
   * @param $view true:echo  false:return
   * @return string
   */
  public function iosys_googleAnalytics() {
    $gaID = $this->options['gaID'];
    $gaType = $this->options['gaType'];
    if ($gaID) {

      if ((!$gaType) || ($gaType == 'gaType_normal') || ($gaType == 'gaType_both')) {
        ?>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-<?php echo $gaID ?>']);
          _gaq.push(['_trackPageview']);

          (function () {
              var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
          })();

        </script>
      <?php
      }
      if (($gaType == 'gaType_both') || ($gaType == 'gaType_universal')) {
        $domainUrl = site_url();
        $delete = array("http://", "https://");
        $domain = str_replace($delete, "", $domainUrl);
        ?>
        <script>
          (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                  (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                      m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
          })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

          ga('create', 'UA-<?php echo $gaID ?>', '<?php echo $domain ?>');
          ga('send', 'pageview');
        </script>
        <?php
      }
    }
  }

  
  /**
   * TOP用記事の内容を表示する
   *
   * @param string $post_content 記事内容
   * @param bool $esc エスケープフラグ
   * @param bool $excerpt 省略フラグ
   * @param bool $show 表示フラグ true:echo false:return
   *
   */
  public function get_info_content($post_content, $max_length, $esc = true, $excerpt = true, $show = true) {

    if (isset($post_content)) {
      // scriptは必ずエスケープ
      $html_rep = array(
        '<script' => '&lt;script',
        ']]>' => ']]&gt;',
        ' />' => '>',
      );
      foreach ($html_rep as $key => $val) {
        $post_content = str_replace($key, $val, $post_content);
      }

      // 80文字以上は省略
      if ($excerpt && mb_strlen($post_content) > $max_length) {
        $post_content = mb_substr($post_content, 0, $max_length) . "…";
      }

      if ($show) {
        if ($esc) { // その他全タグをエスケープ
          echo esc_html($post_content);
        } else {
          echo $post_content;
        }
      } else {
        return $post_content;
      }
    }
  }

  
  /**
   * コピーライトを表示する
   *
   * @return html
   */
  public function iosys_footerCopyRight() {
    
    print '<div id="copy">Copyright &copy;'.date('Y').'<a href="'.home_url('/').'">';
    bloginfo('name');
    print '</a> All Rights Reserved.</div>';

    $footerPowerd = apply_filters('footerPowerdCustom', $footerPowerd);
    echo $footerPowerd;
  }

  /**
   * 半角/全角スペースを取り除く
   *
   * @param string $str
   * @return string
   */
  public function stripSpaces($str = '') {
    $ret = str_replace(array(' ', '　'), array('', ''), $str);
    return $ret;
  }

  /**
   * get_posts用クエリ取得
   *
   * @param $query
   * @return string
   */
//  public function get_iosys_query($query, $posts_per_page = '1') {
//    if ($query != '') {
//      $ret = array(
//        'post_type' => $query,
//        'post_status' => 'publish',
//        'posts_per_page' => $posts_per_page
//      );
//    } else {
//      $ret = array(
//        'post_status' => 'publish',
//        'posts_per_page' => $posts_per_page
//      );
//    }
//    return $ret;
//  }

}

// グローバル変数にsetOptionインスタンスを生成
$setOption = new setOption();

/**
 * 各テンプレートクエリ作成
 */
//function change_posts_per_page($query) {
//  if (is_admin() || !$query->is_main_query())
//    return;
//  if ($query->is_category() || $query->is_archive()) {
//    $query->set('posts_per_page', '10');
//    $query->set('post_status', 'publish');
//  } elseif ($query->is_search()) {
//    $query->set('posts_per_page', '10');
//    $query->set('post_status', 'publish');
//    $query->set('post_type', 'post');
//  }
//}
//
//add_action('pre_get_posts', 'change_posts_per_page');

/**
 * 指定した画像URLを表示する
 *
 * @param string $image 画像パス
 * @param int $width 横px
 * @param int $height 縦px
 * @param string $alt 画像名
 * @return string imgタグ
 *
 */
/* ------------------------------------------- */
function set_image($image, $width, $height, $alt = '') {
  echo get_image($image, $width, $height, $alt);
}

/**
 * 指定した画像URLを返す
 *
 * @param string $image 画像パス
 * @param int $width 横px
 * @param int $height 縦px
 * @param string $alt 画像名
 * @return string imgタグ
 *
 */
/* ------------------------------------------- */
function get_image($image, $width = '', $height = '', $alt = '') {
  return sprintf('<img src="%s" width="%dpx" height="%dpx" alt="%s" >', $image, $width, $height, $alt);
}

/**
 * 管理画面カスタマイズ
 */

/**
 * カスタムナビゲーションを追加
 */
/* --------------------------------------------------------- */
register_nav_menus(array(
  'primary' => 'Main Navigation',
  'FooterNavi' => 'Footer Navigation',
  'FooterSiteMap' => 'Footer SiteMap',
));


/**
 * サムネイル画像
 */
/* --------------------------------------------------------- */
add_theme_support('post-thumbnails');
add_image_size('size1', 265, 100);

/**
 * ダッシュボードウィジェット非表示
 */
function example_remove_dashboard_widgets() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // 最近のコメント
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // プラグイン
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // クイック投稿
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // 最近の下書き
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPressブログ
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // WordPressフォーラム
}

add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');

/**
 * 投稿画面用スタイルシート
 */
add_editor_style();


/* ------------------------------------------- */
/* 	投稿画面にAdd to headウィジェットを作成
  /*------------------------------------------- */
add_action('admin_menu', 'add_head_hooks');
add_action('save_post', 'save_add_head');
add_action('wp_head', 'insert_add_head');

function add_head_hooks() {
  add_meta_box('add_head', 'Add to head', 'add_head_input', 'post', 'normal', 'high');
  add_meta_box('add_head', 'Add to head', 'add_head_input', 'page', 'normal', 'high');
}

function add_head_input() {
  global $post;
  echo '<input type="hidden" name="add_head_noncename" id="add_head_noncename" value="' . wp_create_nonce('add-head') . '" />';
  echo '<textarea name="add_head" id="add_head" rows="5" cols="30" style="width:100%;">' . get_post_meta($post->ID, '_add_head', true) . '</textarea>';
}

function save_add_head($post_id) {
  if (!wp_verify_nonce($_POST['add_head_noncename'], 'add-head'))
    return $post_id;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
    return $post_id;
  $add_head = $_POST['add_head'];
  update_post_meta($post_id, '_add_head', $add_head);
}

function insert_add_head() {
  if (is_page() || is_single()) {
    if (have_posts()) : while (have_posts()) : the_post();
        echo '<!--Add to head-->' . get_post_meta(get_the_ID(), '_add_head', true) . '<!--/Add to head-->';
      endwhile;
    endif;
    rewind_posts();
  }
}

/* jQuery の読み込み */
function add_my_scripts() {
if(is_admin()) return; //管理画面ではスクリプトは読み込まない
wp_deregister_script( 'jquery'); //デフォルトの jQuery は読み込まない
//CDN から読み込む
wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.4/jquery.min.js', array(), '1.11.4', false);
wp_enqueue_script( 'jquery-mig', '//cdnjs.cloudflare.com/ajax/libs/jquery-migrate/1.2.1/jquery-migrate.min.js', array(), '1.2.1', false);
}

//add_action('wp_print_scripts', 'add_my_scripts');

// バージョン更新を非表示にする
add_filter('pre_site_transient_update_core', '__return_zero');
// APIによるバージョンチェックの通信をさせない
remove_action('wp_version_check', 'wp_version_check');
remove_action('admin_init', '_maybe_update_core');

// フッターWordPressリンクを非表示に
function custom_admin_footer() {
echo '<a href="mailto:suzuki@io-sys.co.jp">お問い合わせ</a>';
}
add_filter('admin_footer_text', 'custom_admin_footer');